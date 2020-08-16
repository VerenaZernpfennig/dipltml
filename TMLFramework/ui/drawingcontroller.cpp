#include "ui/drawingcontroller.h"

#include <QPainterPath>
#include <QDebug>
#include <QGraphicsItemGroup>
#include <QList>
#include <QVector>
#include <QPen>
#include <QGraphicsTextItem>
#include <ctime>
#include <QSvgGenerator>

#include "util/coordinateutil.h"
#include "map/router.h"
#include "checks/nooverlapschecker.h"

#include "../ilp/adapter.h"
#include "../heuristics/greedyheuristic.h"
#include "conflicts/conflictgraph.h"

#include <cmath>

#include "config.h"

DrawingController::DrawingController(Map *map):
    play_timer(nullptr),
    map(map),
    trajectory(nullptr),
    camera(nullptr),
    selected(nullptr)
{
  QFont labelFont = LABEL_FONT;
  //labelFont.setStyleStrategy(QFont::NoAntialias);
  this->scene.setFont(labelFont);
  this->scene.setItemIndexMethod(QGraphicsScene::NoIndex);
  this->cameraScene.setFont(labelFont);
  this->cameraScene.setItemIndexMethod(QGraphicsScene::NoIndex);

  this->camera = new Camera(CAMERA_WIDTH, CAMERA_HEIGHT, nullptr, this->map, this->scene.font());
  this->play_point = 0.0;
}


void DrawingController::attach(QGraphicsView *view, QGraphicsView *cameraView)
{
    this->view = view;
    this->view->scale(1, -1);
    this->view->setScene(&(this->scene));

    this->cameraView = cameraView;
    this->cameraView->scale(1, -1);
    this->cameraView->setScene(&(this->cameraScene));

    this->redraw();
}

void
DrawingController::save_camera(const char * filename)
{
  this->save_camera_svg(filename);
}

void
DrawingController::save_camera_svg(const char *filename)
{
   QSvgGenerator svgGen;

   svgGen.setFileName(filename);

   QRectF target(0.0, 0.0, CAMERA_WIDTH,CAMERA_HEIGHT);

    std::cout <<  target.width() << " " << target.height() << std::endl;
   svgGen.setSize(QSize(target.width(),target.height()));

   QPainter painter( &svgGen );

   this->cameraView->render(&painter, target, this->cameraView->rect(), Qt::KeepAspectRatio); 
}

void DrawingController::new_route(int seed,double speed,int startpoint, int endpoint)
{
    std::cout << "Drawing a new route...";
    Router router(this->map, seed,startpoint,endpoint);

    std::vector<std::pair<edge_t, bool>> route = router.get_random_route();

    std::vector<Position> route_waypoints;
    std::vector<double> route_speeds;

    for (auto edge : route) {
        std::vector<Position> waypoints = this->map->get_waypoints(edge.first);
        //attempts to allocate memory for at least route_points + waypoints elements
        route_waypoints.reserve(route_waypoints.size() + waypoints.size());
        //insert the next route_speed at the end of the vector
        //if there is no speed set in the form
        if (speed == 0){
            route_speeds.insert(route_speeds.end(), waypoints.size(), this->map->get_way_speed(edge.first));
        }
        //if there is a speed set in the form
        else{
            route_speeds.insert(route_speeds.end(), waypoints.size(), speed);        
        }
        std::cout << "Running the camera..";

        if (edge.second) { // Traversing in edge direction..
            route_waypoints.insert(route_waypoints.end(), waypoints.begin(), waypoints.end());
        } else { // Traversing against edge direction
            route_waypoints.insert(route_waypoints.end(), waypoints.rbegin(), waypoints.rend());
        }
    }

    //this->draw_route(route_waypoints);

    TrajectoryFactory tFac(&route_waypoints, &route_speeds, CAMERA_WIDTH, CAMERA_HEIGHT, this->map);

    if (this->trajectory != nullptr)
        delete this->trajectory;
    this->trajectory = tFac.getTrajectory();
    this->draw_trajectory();

    if (this->camera != nullptr)
        delete this->camera;
    this->camera = new Camera(CAMERA_WIDTH, CAMERA_HEIGHT, this->trajectory, this->map, this->scene.font());
    std::cout << "Running the camera..";
    this->camera->compute();

    if (this->selected != nullptr) {
      delete this->selected;
      this->selected = nullptr;
    }

    this->play_point = 0.0;
    Q_EMIT step_changed(0, int(this->trajectory->getLength()), 0.0);
}

void DrawingController::set_poi_filter(std::map<std::string, std::set<std::string> > filter)
{
    this->map->set_poi_filter(filter);
    this->redrawPOI();
}

void DrawingController::start_play()
{
    this->play_point = 0.0;
    this->prev_angle = 0.0;
    this->loc_angle = 0.0;
    if (this->play_timer != nullptr) {
        this->play_timer->stop();
        delete this->play_timer;
    }

    this->play_timer = new QTimer();
    connect(this->play_timer, SIGNAL(timeout()), this, SLOT(update_play_point()));
    //Zeit, wie schnell der Timer der Route läuft
    this->play_timer->start(1000);

}

void DrawingController::stop_play()
{
  if (this->play_timer != nullptr){
      this->play_timer->stop();
      delete this->play_timer;
  }  
}

void DrawingController::force_angle(double angle)
{
    this->forced_angle = angle;
    this->redrawPOI();
}

/**
 * @brief during the animation this method is called to set the new position
 * @param point
 */
void DrawingController::set_play_point(double point) {
     if (point == this->play_point) {
         return;
     }

     if (this->play_timer != nullptr) {
         this->play_timer->stop();
         delete this->play_timer;
     }
     this->forced_angle = std::nan("");
     this->play_point = point;
     update();
}


void DrawingController::compute_heuristic(int heuristic_tag, int k, int deviation)
{
    if (this->selected != nullptr) {
        delete this->selected;
    }

    TIME_LIMIT = std::numeric_limits<int>::max();

    switch (heuristic_tag) {
    case HEU_ILP_AM1_TAG: {
      ILPAdapter ilp(this->map, this->camera->getVisibilityIntervals(), this->camera->getConflictIntervals(), Heuristic::AM1, k, deviation);
      ilp.run();
      this->selected = ilp.getLabelIntervals();
      }
      break;
    case HEU_ILP_AM2_TAG: {
      ILPAdapter ilp(this->map, this->camera->getVisibilityIntervals(), this->camera->getConflictIntervals(), Heuristic::AM2, k, deviation);
      ilp.run();
      this->selected = ilp.getLabelIntervals();
      }
      break;
    case HEU_ILP_AM3_TAG: {
      ILPAdapter ilp(this->map, this->camera->getVisibilityIntervals(), this->camera->getConflictIntervals(), Heuristic::AM3, k, deviation);
      ilp.run();
      this->selected = ilp.getLabelIntervals();
      }
      break;
    case HEU_ILP_AM4_TAG: {
      ILPAdapter ilp(this->map, this->camera->getVisibilityIntervals(), this->camera->getConflictIntervals(), Heuristic::AM4, k, deviation);
      ilp.run();
      this->selected = ilp.getLabelIntervals();
      }
      break;
    case HEU_GREEDY_AM1_TAG: {
        ExpandedConflictGraph *ecg = ExpandedConflictGraph::fromConflicts(this->camera->getConflictIntervals(), this->camera->getVisibilityIntervals(), Heuristic::AM1, false);
        if (ecg != nullptr) {
          GreedyHeuristic gh(*ecg, k);
          gh.run();
          this->selected = gh.getLabelIntervals();
          delete ecg;
        } else {
          this->selected->clear();
        }
      }
      break;
    case HEU_GREEDY_AM2_TAG: {
        ExpandedConflictGraph *ecg = ExpandedConflictGraph::fromConflicts(this->camera->getConflictIntervals(), this->camera->getVisibilityIntervals(), Heuristic::AM2, false);
        if (ecg != nullptr) {
          GreedyHeuristic gh(*ecg, k);
          gh.run();
          this->selected = gh.getLabelIntervals();
          delete ecg;
        } else {
          this->selected->clear();
        }
      }
      break;
    case HEU_GREEDY_AM3_TAG: {
        ExpandedConflictGraph *ecg = ExpandedConflictGraph::fromConflicts(this->camera->getConflictIntervals(), this->camera->getVisibilityIntervals(), Heuristic::AM3, false);
        if (ecg != nullptr) {
          GreedyHeuristic gh(*ecg, k);
          gh.run();
          this->selected = gh.getLabelIntervals();
          delete ecg;
        } else {
          this->selected->clear();
        }
      }
      break;
    default:
      break;
    }

    this->redrawPOI();
}

void DrawingController::update_play_point()
{
    //first move
    if (this->prev_angle == 0.0){
        this->prev_angle = this->loc_angle;
    }
    //if angles are different there is a circle
    if (this->loc_angle != this->prev_angle){
        this->play_point += 0.5; 
    }
    else{
        this->play_point += 2.0;
    }
    this->prev_angle = this->loc_angle;
    this->forced_angle = std::nan("");

    if (this->play_point > this->trajectory->getLength()) {
        this->play_timer->stop();
        delete this->play_timer;
        this->play_timer = nullptr;
    } else {
        this->showViewportAt(this->play_point);
        this->redrawPOI();

        CarPosition pos = this->trajectory->interpolatePosition(this->play_point);
        std::cout << "Sending: " << pos.angle;
        this->loc_angle = pos.angle;
        Q_EMIT step_changed(this->play_point, int(this->trajectory->getLength()), pos.angle);
    }
}

void DrawingController::redraw()
{
    this->scene.clear();
    this->cameraScene.clear();

    QGraphicsItemGroup * items = this->draw_ways();
    //this->draw_crossings();

    this->view->fitInView(items->boundingRect(), Qt::KeepAspectRatio);
    //std::cout << items->boundingRect();
    QGraphicsItemGroup * poi_items = this->redrawPOI();

    qDebug() << "Ways are in rectangle: " << items->boundingRect();
    qDebug() << "POIs are in rectangle: " << poi_items->boundingRect();

    
    // TODO not destroying these groups probably leaks memory
}

QGraphicsItemGroup * DrawingController::redrawPOI()
{
  //std::cout << ":: Redrawing POI ...\n";

  QGraphicsItemGroup *group = this->scene.createItemGroup(QList<QGraphicsItem*>());

  for (auto item : this->drawn_poi) {
    //this->scene.removeItem(item);
    delete item;
  }

  this->drawn_poi.clear();

    /* Get conflicts */
    std::set<std::set<POI *>> conflicts = this->camera->getConflictsAt(this->play_point);
    std::set<POI *> conflicting;
    for (auto conflictPair : conflicts) {
        bool dbg_enable = false;
        /*
        for (auto poi : conflictPair) {
            if (poi->getId() == 1777375778) {
                dbg_enable = true;
            }
        }
        */

        if (dbg_enable) {
            for (auto poi : conflictPair) {
                std::cout << "Schlossplatz now in conflict with " << poi->getLabel();
            }
        }
        conflicting.insert(conflictPair.begin(), conflictPair.end());
    }
    std::set<POI *> visible = this->camera->getVisibleAt(this->play_point);


    /* Get selection */
    std::set<POI *> selected_poi;
    if (this->selected != nullptr) {
        Interval lookup = make_interval(this->play_point, this->play_point);
        selected_poi = this->selected->query(bgi::intersects(lookup));
    }

    /* Do the actual drawing */

    QPen defaultPen(QColor(255, 255, 0, 255), 2, Qt::SolidLine);
    defaultPen.setCosmetic(true);
    QPen visiblePen(QColor(0, 0, 255, 255), 2, Qt::SolidLine);
    visiblePen.setCosmetic(true);
    QPen conflictPen(QColor(255, 0, 0, 255), 2, Qt::SolidLine);
    conflictPen.setCosmetic(true);
    QPen selectedPen(QColor(0, 255, 0, 255), 2, Qt::SolidLine);
    selectedPen.setCosmetic(true);

    CarPosition carpos = {Position(0.0, 0.0), 0.0, 1};
    if (! std::isnan(this->forced_angle)) {
        if (this->trajectory != nullptr) {
          CarPosition dummy_carpos = this->trajectory->interpolatePosition(this->play_point);
          carpos = {Position(0.0, 0.0), this->forced_angle,  dummy_carpos.zoom};
        } else {
          carpos = {Position(0.0, 0.0), this->forced_angle, 1};
        }
    } else if (this->trajectory != nullptr) {
        carpos = this->trajectory->interpolatePosition(this->play_point);
    }
    //std::cout << "Drawing zoom: " << carpos.zoom;

    std::vector<RotatingPOI> rpois = this->camera->getPOIsForCar(carpos);

    for (auto rpoi : rpois) {

        QPainterPath path;
        QPen *usePen;
        if (selected_poi.find(rpoi.getPoi()) != selected_poi.end()) {
          usePen = &selectedPen;
        } else if (conflicting.find(rpoi.getPoi()) != conflicting.end()) {
          usePen = &conflictPen;
        } else if (visible.find(rpoi.getPoi()) != visible.end()) {
          usePen = &visiblePen;
        } else {
          usePen = &defaultPen;
        }

        Position tl = rpoi.getCorner(true, true);
        Position tr = rpoi.getCorner(true, false);
        Position bl = rpoi.getCorner(false, true);
        Position br = rpoi.getCorner(false, false);

        path.moveTo(tl.first, tl.second);
        path.lineTo(tr.first, tr.second);
        path.lineTo(br.first, br.second);
        path.lineTo(bl.first, bl.second);
        path.lineTo(tl.first, tl.second);
        QGraphicsItem *item = this->scene.addPath(path, *usePen);
        item->setVisible(true);
        this->drawn_poi.push_back(item);

        /* Draw the anchor */
        double anchorSize = rpoi.getHeight() / 5;
        QGraphicsItem *circle = this->scene.addEllipse(rpoi.getAnchor().first - (anchorSize/2.0), rpoi.getAnchor().second - (anchorSize/2.0), anchorSize, anchorSize, *usePen);
        circle->setVisible(true);
        this->drawn_poi.push_back(circle);
        QPainterPath anchorPath;
        anchorPath.moveTo(rpoi.getAnchor().first, rpoi.getAnchor().second);
        anchorPath.lineTo(rpoi.getCenter().first, rpoi.getCenter().second);
        QGraphicsItem *anchorPathItem = this->scene.addPath(anchorPath, *usePen);
        anchorPathItem->setVisible(true);
        this->drawn_poi.push_back(anchorPathItem);
        group->addToGroup(anchorPathItem);

        /* Draw the actual text! */
        QGraphicsTextItem * text = this->scene.addText(QString::fromStdString(rpoi.getPoi()->getLabel()), LABEL_FONT);

        QTransform textTransform;
        //std::cout << "Drawing text: " << rpoi.getPoi()->getLabel() << "\n";

        textTransform.translate(tl.first, tl.second);
        textTransform.rotate(CoordinateUtil::RPOIAngleToMap(rpoi.getRotation()) / M_PI * 180);
        textTransform.scale(1.0 / carpos.zoom, -1.0 / carpos.zoom);

        text->setTransform(textTransform);
        text->setVisible(true);

        this->drawn_poi.push_back(text);

        // Draw only selected POIs on the camera
        if ((selected_poi.size() == 0) || (selected_poi.find(rpoi.getPoi()) != selected_poi.end())) {
          /* Draw the backround box         
          QPen cameraBoxPen(poi_box_outline);
          QBrush cameraBoxBrush(poi_box_background);
          QGraphicsItem * cameraBox = this->cameraScene.addPath(path, cameraBoxPen, cameraBoxBrush);
          //cameraBox->setZValue(2);
          this->drawn_poi.push_back(cameraBox);
           * */
           //draw under the labels (POI) small black points
            double anchorSize = rpoi.getHeight() / 5;
            QPen poiMarkerPen(poi_box_outline);
            QBrush poiMarkerBrush(poi_box_background);
            QGraphicsItem * poiMarker = this->cameraScene.addEllipse(rpoi.getAnchor().first - (anchorSize/2.0), rpoi.getAnchor().second - (anchorSize/2.0), anchorSize, anchorSize, poiMarkerPen, poiMarkerBrush);
            poiMarker->setVisible(true);
            this->drawn_poi.push_back(poiMarker);

          QGraphicsTextItem * cameraText = this->cameraScene.addText(QString::fromStdString(rpoi.getPoi()->getLabel()), LABEL_FONT);
          cameraText->setTransform(textTransform);
          cameraText->setVisible(true);
          cameraText->setZValue(3);
          this->drawn_poi.push_back(cameraText);
            
        /*
          double scaled_poi_box_dx = poi_box_dx * this->camera_scale_factor;
          double scaled_poi_box_dy = poi_box_dy * this->camera_scale_factor;
          double scaled_poi_box_dw = poi_box_dw * this->camera_scale_factor;
          
          QPainterPath cameraBoxPath;
          cameraBoxPath.moveTo(tl.first + scaled_poi_box_dx, tl.second + scaled_poi_box_dy);
          cameraBoxPath.lineTo(tr.first + scaled_poi_box_dx + scaled_poi_box_dw, tr.second + scaled_poi_box_dy);
          cameraBoxPath.lineTo(br.first + scaled_poi_box_dx + scaled_poi_box_dw, br.second + scaled_poi_box_dy);
          cameraBoxPath.lineTo(bl.first + scaled_poi_box_dx, bl.second + scaled_poi_box_dy);
          cameraBoxPath.lineTo(tl.first + scaled_poi_box_dx, tl.second + scaled_poi_box_dy);
          QPen cameraBoxPen(poi_box_outline);
          QBrush cameraBoxBrush(poi_box_background);
          QGraphicsItem * cameraBox = this->cameraScene.addPath(path, cameraBoxPen, cameraBoxBrush);
          cameraBox->setZValue(2);
          this->drawn_poi.push_back(cameraBox);
           */
        }
    }

    return group;
}

void
DrawingController::updateCameraTransform(RotatingPOI &viewport, CarPosition carpos)
{
  QTransform transform;
  //transform.translate(-1*carpos.pos.first, -1*carpos.pos.second);

  double widgetWidth = this->cameraView->size().width();
  this->camera_scale_factor = widgetWidth / viewport.getWidth();

  transform.rotate((carpos.angle / M_PI * 180.0) + 180);
  transform.scale(-1 * this->camera_scale_factor, 1 * this->camera_scale_factor);
  this->cameraView->setTransform(transform);
  this->cameraView->centerOn(carpos.pos.first, carpos.pos.second);
}

void DrawingController::showViewportAt(double dist)
{
  for (auto prev_item : this->viewportItems) {
      delete prev_item;
  }
  this->viewportItems.clear();

    QPen pen(QColor(255, 0, 0, 255), 2, Qt::SolidLine);
    pen.setCosmetic(true);

    RotatingPOI viewport = this->camera->getViewportAt(dist);
    CarPosition pos = this->trajectory->interpolatePosition(dist);
    //std::cout << "Zoom is now: " << pos.zoom;
    QPainterPath path;

    Position tl = viewport.getCorner(true, true);
    Position tr = viewport.getCorner(true, false);
    Position bl = viewport.getCorner(false, true);
    Position br = viewport.getCorner(false, false);


    path.moveTo(tl.first, tl.second);
    path.lineTo(tr.first, tr.second);
    path.lineTo(br.first, br.second);
    path.lineTo(bl.first, bl.second);
    path.lineTo(tl.first, tl.second);

    QGraphicsItem *item = this->scene.addPath(path, pen);
    item->setVisible(true);
    this->viewportItems.push_back(item);
    
    //path for camera view
    QPen penC(QColor(0, 0, 255, 255), 2, Qt::SolidLine);
    QBrush brush(QColor(Qt::lightGray));
    QGraphicsItem *itemCam = this->cameraScene.addPath(path, penC,brush);
    itemCam->setVisible(true);
    this->viewportItems.push_back(itemCam);

    //add ellipse to simulate the carposition
    double ellipsesize = viewport.getWidth() / 50.0;   //100.0 init value
    //QGraphicsItem *circle = this->scene.addEllipse(pos.pos.first - (ellipsesize/2.0), pos.pos.second - (ellipsesize/2.0), ellipsesize, ellipsesize, pen);
    QGraphicsItem *circle = this->cameraScene.addEllipse(pos.pos.first - (ellipsesize/2.0), pos.pos.second - (ellipsesize/2.0), ellipsesize, ellipsesize, pen);
    this->viewportItems.push_back(circle);

    QGraphicsItem *cameraPort = this->cameraScene.addPath(path, pen);
    cameraPort->setVisible(true);
    cameraPort->setZValue(5);
    this->viewportItems.push_back(cameraPort);

    this->updateCameraTransform(viewport, pos);

    Q_EMIT viewport_info(pos.angle, pos.zoom);
}

QGraphicsItemGroup * DrawingController::draw_crossings() {
    boost::graph_traits<Graph>::vertex_iterator vi;
    boost::graph_traits<Graph>::vertex_iterator vi_end;
    std::tie(vi, vi_end) = boost::vertices(this->map->get_graph());

    QGraphicsItemGroup *items = this->scene.createItemGroup(QList<QGraphicsItem*>());
    QGraphicsItem * some_item;

    QPen pen(Qt::red, 1, Qt::SolidLine);
    pen.setCosmetic(true);

    for( ; vi != vi_end ; vi++) {
        vertex_t vertex = *vi;

        Position pos = this->map->get_vertex_pos(vertex);
        some_item = this->scene.addEllipse(pos.first, pos.second, 0.01, 0.01, pen);

        items->addToGroup(some_item);
    }

    return items;
}

QGraphicsItemGroup * DrawingController::draw_ways()
{
    boost::graph_traits<Graph>::edge_iterator ei;
    boost::graph_traits<Graph>::edge_iterator ei_end;
    std::tie(ei, ei_end) = boost::edges(this->map->get_graph());

    QGraphicsItemGroup *items = this->scene.createItemGroup(QList<QGraphicsItem*>());
    QGraphicsItem * some_item;

    for( ; ei != ei_end ; ei++) {
        edge_t edge = *ei;
        std::vector<Position> waypoints = this->map->get_waypoints(edge);
        double speed = this->map->get_way_speed(edge);
        some_item = this->draw_waypoints(waypoints, speed);
        items->addToGroup(some_item);
    }

    return items;
}

QGraphicsItem * DrawingController::draw_route(std::vector<Position> waypoints)
{
    QPainterPath path;
    //pen for route in scene (green)
    QPen pen(Qt::green, 2, Qt::SolidLine);
    pen.setCosmetic(true);
    /*//pen for waypoints in cameraScene (magenta)
    QPen Wpen(Qt::magenta, 2, Qt::SolidLine);
    Wpen.setCosmetic(true);
    //pen for route in cameraScene (darkBlue)
    QPen Rpen(Qt::darkBlue, 2, Qt::SolidLine);
    Rpen.setCosmetic(true);*/
    
    //moves the current point to the given point
    path.moveTo(waypoints[0].first, waypoints[0].second);

    for (auto it : waypoints) {
        //adds a straigt line from the current position to the given it.second
        path.lineTo(it.first, it.second);
       /* QGraphicsItem *item;
        item = this->cameraScene.addEllipse(it.first, it.second,2,2,Wpen);
        item->setVisible(true);*/
    }

    //add path to scene
    QGraphicsItem *item;
    item = this->scene.addPath(path, pen);
    item->setVisible(true);

    return item;
}

void DrawingController::draw_trajectory()
{
  for (auto item: this->drawn_trajectory) {
    //this->scene.removeItem(item);
    delete item;
  }
  this->drawn_trajectory.clear();

  for (TrajectoryItem *i : this->trajectory->getItems()) {
      switch(i->getType()) {
      case TrajectoryItem::TYPE_STRAIGHT:
          //push_back = adds a new element at the end of the vector, after its current last element  
          this->drawn_trajectory.push_back(this->draw_trajectory_straight(static_cast<StraightTrajectoryItem*>(i)));
          break;
      case TrajectoryItem::TYPE_CIRCLE:
          this->drawn_trajectory.push_back(this->draw_trajectory_circle(static_cast<CircleTrajectoryItem*>(i)));
          break;
      default:
          std::cout << "Unknown item?";
      }
  }
}

/**
 * @brief color the straight segments green (concerning the scene)
 * @param i
 * @return OGraphicsItem which is the straight segment colored green
 */
QGraphicsItem *DrawingController::draw_trajectory_straight(StraightTrajectoryItem *i)
{
    QPen pen(Qt::green, 2, Qt::SolidLine);
    QPen penC(Qt::darkGray, 3, Qt::DotLine);
    pen.setCosmetic(true);

    QPainterPath path;
    path.moveTo(i->getStart().first, i->getStart().second);
    path.lineTo(i->getEnd().first, i->getEnd().second);
    this->cameraScene.addPath(path,penC)->setZValue(100000);
    return this->scene.addPath(path, pen);
}


/**
 * @brief color the circle segments blue (concerning the scene)
 * @param i
 * @return QGraphicsItem which is the circle segment colored blue
 */
QGraphicsItem *DrawingController::draw_trajectory_circle(CircleTrajectoryItem *i)
{
    QPen pen(Qt::blue, 2, Qt::SolidLine);
    QPen penC(Qt::darkGray, 3, Qt::DotLine);
    pen.setCosmetic(true);

    QPainterPath path;
    //path.moveTo(i->getCenter().first, i->getCenter().second);

    double start_angle = i->getAStart();
    double end_angle = i->getAEnd();

    /*
    if (sin(end_angle - start_angle) > 0) {
        // Rotate so that normal will be okay
        start_angle = (start_angle + M_PI);
        if (start_angle > 2*M_PI) {
            start_angle -= 2*M_PI;
        }
        end_angle = (end_angle + M_PI);
        if (end_angle > 2*M_PI) {
            end_angle -= 2*M_PI;
        }
    }

    double span = end_angle - start_angle;

    if (start_angle > end_angle) {
        double swap = start_angle;
        start_angle = end_angle;
        end_angle = swap;
        span *= -1;
    }
    */

    double qtStart = CoordinateUtil::radToQt(start_angle);
    double span = CoordinateUtil::angleDiff(end_angle, start_angle);
    double qtSpan = span / M_PI * 180.0;

    //double span = qtEnd - qtStart;

    /*
    if (span < 0) {
        double tmp = qtStart;
        qtStart = qtEnd;
        qtEnd = tmp;
        span *= -1;
    }
    */

    path.arcMoveTo(i->getCenter().first - i->getR(), i->getCenter().second - i->getR(), 2*i->getR(), 2*i->getR(), qtStart);
    path.arcTo(i->getCenter().first - i->getR(), i->getCenter().second - i->getR(), 2*i->getR(), 2*i->getR(), qtStart, qtSpan);

    //path.arcMoveTo(i->getCenter().first - i->getR(), i->getCenter().second - i->getR(), 2*i->getR(), 2*i->getR(), 135);
    //path.arcTo(i->getCenter().first - i->getR(), i->getCenter().second - i->getR(), 2*i->getR(), 2*i->getR(), 135, 10);
    this->cameraScene.addPath(path,penC)->setZValue(100000);
    return this->scene.addPath(path, pen);
}



QGraphicsItem * DrawingController::draw_waypoints(std::vector<Position> waypoints, double speed)
{
    QPainterPath path;
    path.moveTo(waypoints[0].first, waypoints[0].second);
    QPen pen(Qt::magenta, 2, Qt::SolidLine);
    pen.setCosmetic(true);

    for (auto it : waypoints) {
        path.lineTo(it.first, it.second);
        //draw waypoints on the scene (magenta)
        QGraphicsItem *item;
        item = this->scene.addEllipse(it.first, it.second,2,2,pen);
        item->setVisible(true);
    }
    
    //draw waypoints in scene
    QGraphicsItem *item;
    item = this->scene.addPath(path);
    item->setVisible(true);

    size_t i = 0;
    for ( ; i < ROAD_STYLE_COUNT - 1 ; i++) {
      if (speed <= roadstyle_speeds[i])
        break;
    }
    road_style style = roadstyle_styles[i];

    QBrush outerBrush(style.outer_color);
    QPen outerPen(outerBrush, style.outer_width, Qt::SolidLine, Qt::RoundCap, Qt::RoundJoin);
    QGraphicsItem *outerPathItem = this->cameraScene.addPath(path, outerPen);
    outerPathItem->setZValue(-1);
    outerPathItem->setVisible(true);

    QBrush innerBrush(style.inner_color);
    QPen innerPen(innerBrush, style.inner_width, Qt::SolidLine, Qt::RoundCap, Qt::RoundJoin);
    QGraphicsItem *innerPathItem = this->cameraScene.addPath(path, innerPen);
    innerPathItem->setZValue(1);
    innerPathItem->setVisible(true);

    /*
    QPainterPathStroker stroker;
    stroker.setWidth(style.outer_width);
    stroker.setCapStyle(Qt::RoundCap);
    stroker.setJoinStyle(Qt::RoundJoin);
    QPainterPath outerPath = stroker.createStroke(path);

    QBrush outerBrush(style.outer_color);
    QPen outerPen(style.outer_color);
    outerPen.setWidth(0);
    QGraphicsItem *outerPathItem = this->cameraScene.addPath(outerPath, outerPen, outerBrush);
    outerPathItem->setZValue(-1);

    stroker.setWidth(style.inner_width);
    QPainterPath innerPath = stroker.createStroke(path);

    QBrush innerBrush(style.inner_color);
    QPen innerPen(style.inner_color);
    innerPen.setWidth(0);
    QGraphicsItem *innerPathItem = this->cameraScene.addPath(innerPath, innerPen, innerBrush);
    innerPathItem->setZValue(1);

    outerPathItem->setVisible(true);
    innerPathItem->setVisible(true);
    */
    return item;
}

/*
 * update view of the red window
 */
void DrawingController::update(){
    
    //change car position
    this->showViewportAt(this->play_point);
    //change POIs position
    this->redrawPOI();
    //QPen pen(Qt::red, 2, Qt::SolidLine);
    //pen.setCosmetic(true);

    CarPosition pos = this->trajectory->interpolatePosition(this->play_point);
    Q_EMIT step_changed(this->play_point, int(this->trajectory->getLength()), pos.angle); 
}

/*
 * save actual camera view to image defined by filename
 */
void DrawingController::save_camera_image(const char *filename) {

   QRectF target(0.0, 0.0, CAMERA_WIDTH,CAMERA_HEIGHT);
   QImage image(target.width(),target.height(),QImage::Format_RGB32);
     this->cameraScene.setBackgroundBrush(QBrush(Qt::white));
   QPainter painter( &image);
   this->cameraView->render(&painter, target,
    this->cameraView->viewport()->rect(), Qt::KeepAspectRatio);
   image.save(filename);
}


