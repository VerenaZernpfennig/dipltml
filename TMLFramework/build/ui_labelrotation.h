/********************************************************************************
** Form generated from reading UI file 'labelrotation.ui'
**
** Created by: Qt User Interface Compiler version 5.11.1
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_LABELROTATION_H
#define UI_LABELROTATION_H

#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QComboBox>
#include <QtWidgets/QDoubleSpinBox>
#include <QtWidgets/QFrame>
#include <QtWidgets/QGridLayout>
#include <QtWidgets/QGroupBox>
#include <QtWidgets/QLabel>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QSlider>
#include <QtWidgets/QSpinBox>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QToolBar>
#include <QtWidgets/QVBoxLayout>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_LabelRotation
{
public:
    QWidget *centralWidget;
    QVBoxLayout *verticalLayout_2;
    QFrame *scenesFrame;
    QGridLayout *gridLayout;
    QGroupBox *groupBox;
    QGridLayout *gridLayout_2;
    QGroupBox *groupBox_2;
    QGridLayout *gridLayout_3;
    QSlider *stepSlider;
    QDoubleSpinBox *stepSpinner;
    QPushButton *playButton;
    QPushButton *stopButton;
    QLabel *totalStepsLabel;
    QGroupBox *groupBox_3;
    QGridLayout *gridLayout_4;
    QPushButton *runHeuristicButton;
    QPushButton *poiSelectButton;
    QPushButton *routeButton;
    QDoubleSpinBox *angleSpinBox;
    QSpinBox *seedSpinBox;
    QSpinBox *speedSpinBox;
    QSpinBox *routeStartBox;
    QSpinBox *routeEndBox;
    QSpinBox *deviationBox;
    QComboBox *heuristicComboBox;
    QPushButton *saveButton;
    QGroupBox *groupBox_4;
    QGridLayout *gridLayout_5;
    QLabel *label;
    QLabel *label_2;
    QLabel *label_cur_angle;
    QLabel *label_cur_zoom;
    QLabel *label_speed;
    QLabel *label_start_route;
    QLabel *label_end_route;
    QLabel *label_deviation;
    QMenuBar *menuBar;
    QToolBar *mainToolBar;
    QStatusBar *statusBar;

    void setupUi(QMainWindow *LabelRotation)
    {
        if (LabelRotation->objectName().isEmpty())
            LabelRotation->setObjectName(QStringLiteral("LabelRotation"));
        LabelRotation->resize(814, 538);
        centralWidget = new QWidget(LabelRotation);
        centralWidget->setObjectName(QStringLiteral("centralWidget"));
        verticalLayout_2 = new QVBoxLayout(centralWidget);
        verticalLayout_2->setSpacing(6);
        verticalLayout_2->setContentsMargins(11, 11, 11, 11);
        verticalLayout_2->setObjectName(QStringLiteral("verticalLayout_2"));
        scenesFrame = new QFrame(centralWidget);
        scenesFrame->setObjectName(QStringLiteral("scenesFrame"));
        QSizePolicy sizePolicy(QSizePolicy::Expanding, QSizePolicy::MinimumExpanding);
        sizePolicy.setHorizontalStretch(0);
        sizePolicy.setVerticalStretch(0);
        sizePolicy.setHeightForWidth(scenesFrame->sizePolicy().hasHeightForWidth());
        scenesFrame->setSizePolicy(sizePolicy);
        scenesFrame->setAutoFillBackground(true);
        scenesFrame->setFrameShape(QFrame::StyledPanel);
        scenesFrame->setFrameShadow(QFrame::Raised);
        gridLayout = new QGridLayout(scenesFrame);
        gridLayout->setSpacing(6);
        gridLayout->setContentsMargins(11, 11, 11, 11);
        gridLayout->setObjectName(QStringLiteral("gridLayout"));

        verticalLayout_2->addWidget(scenesFrame);

        groupBox = new QGroupBox(centralWidget);
        groupBox->setObjectName(QStringLiteral("groupBox"));
        QSizePolicy sizePolicy1(QSizePolicy::Preferred, QSizePolicy::Minimum);
        sizePolicy1.setHorizontalStretch(0);
        sizePolicy1.setVerticalStretch(0);
        sizePolicy1.setHeightForWidth(groupBox->sizePolicy().hasHeightForWidth());
        groupBox->setSizePolicy(sizePolicy1);
        gridLayout_2 = new QGridLayout(groupBox);
        gridLayout_2->setSpacing(6);
        gridLayout_2->setContentsMargins(11, 11, 11, 11);
        gridLayout_2->setObjectName(QStringLiteral("gridLayout_2"));
        groupBox_2 = new QGroupBox(groupBox);
        groupBox_2->setObjectName(QStringLiteral("groupBox_2"));
        gridLayout_3 = new QGridLayout(groupBox_2);
        gridLayout_3->setSpacing(6);
        gridLayout_3->setContentsMargins(11, 11, 11, 11);
        gridLayout_3->setObjectName(QStringLiteral("gridLayout_3"));
        stepSlider = new QSlider(groupBox_2);
        stepSlider->setObjectName(QStringLiteral("stepSlider"));
        stepSlider->setOrientation(Qt::Horizontal);

        gridLayout_3->addWidget(stepSlider, 2, 0, 1, 1);

        stepSpinner = new QDoubleSpinBox(groupBox_2);
        stepSpinner->setObjectName(QStringLiteral("stepSpinner"));
        stepSpinner->setSingleStep(0.01);

        gridLayout_3->addWidget(stepSpinner, 0, 0, 1, 1);

        playButton = new QPushButton(groupBox_2);
        playButton->setObjectName(QStringLiteral("playButton"));
        stopButton = new QPushButton(groupBox_2);
        stopButton->setObjectName(QStringLiteral("stopButton"));

        gridLayout_3->addWidget(playButton, 0, 2, 1, 1);
        gridLayout_3->addWidget(stopButton, 1, 2, 1, 1);

        totalStepsLabel = new QLabel(groupBox_2);
        totalStepsLabel->setObjectName(QStringLiteral("totalStepsLabel"));

        gridLayout_3->addWidget(totalStepsLabel, 0, 1, 1, 1);


        gridLayout_2->addWidget(groupBox_2, 5, 0, 1, 2);

        groupBox_3 = new QGroupBox(groupBox);
        groupBox_3->setObjectName(QStringLiteral("groupBox_3"));
        gridLayout_4 = new QGridLayout(groupBox_3);
        gridLayout_4->setSpacing(6);
        gridLayout_4->setContentsMargins(11, 11, 11, 11);
        gridLayout_4->setObjectName(QStringLiteral("gridLayout_4"));
        runHeuristicButton = new QPushButton(groupBox_3);
        runHeuristicButton->setObjectName(QStringLiteral("runHeuristicButton"));

        gridLayout_4->addWidget(runHeuristicButton, 2, 0, 1, 1);

        poiSelectButton = new QPushButton(groupBox_3);
        poiSelectButton->setObjectName(QStringLiteral("poiSelectButton"));

        gridLayout_4->addWidget(poiSelectButton, 0, 0, 1, 1);

        routeButton = new QPushButton(groupBox_3);
        routeButton->setObjectName(QStringLiteral("routeButton"));

        gridLayout_4->addWidget(routeButton, 1, 0, 1, 1);

        angleSpinBox = new QDoubleSpinBox(groupBox_3);
        angleSpinBox->setObjectName(QStringLiteral("angleSpinBox"));
        angleSpinBox->setDecimals(4);
        angleSpinBox->setMinimum(-3.1416);
        angleSpinBox->setMaximum(3.1416);
        angleSpinBox->setSingleStep(0.01);
        angleSpinBox->setValue(0);

        gridLayout_4->addWidget(angleSpinBox, 0, 1, 1, 1);

        seedSpinBox = new QSpinBox(groupBox_3);
        seedSpinBox->setObjectName(QStringLiteral("seedSpinBox"));
        seedSpinBox->setMinimum(0);
        seedSpinBox->setMaximum(2147483647);

        gridLayout_4->addWidget(seedSpinBox, 1, 1, 1, 1);

        heuristicComboBox = new QComboBox(groupBox_3);
        heuristicComboBox->setObjectName(QStringLiteral("heuristicComboBox"));

        gridLayout_4->addWidget(heuristicComboBox, 2, 1, 1, 1);

        saveButton = new QPushButton(groupBox_3);
        saveButton->setObjectName(QStringLiteral("saveButton"));

        gridLayout_4->addWidget(saveButton, 3, 0, 1, 1);
        
        //Speed-Label
        label_speed  = new QLabel(groupBox_3);
        label_speed->setObjectName(QStringLiteral("label_speed"));
        gridLayout_4->addWidget(label_speed, 4, 0, 1, 1);
        
        //Speed-Spinbox
        speedSpinBox = new QSpinBox(groupBox_3);
        speedSpinBox->setObjectName(QStringLiteral("speedSpinBox"));
        speedSpinBox->setMinimum(0);
        speedSpinBox->setSingleStep(5);
        speedSpinBox->setMaximum(70);
        gridLayout_4->addWidget(speedSpinBox, 4, 1, 1, 1);
        
        //Startpoint-Label
        label_start_route  = new QLabel(groupBox_3);
        label_start_route->setObjectName(QStringLiteral("label_start_route"));
        gridLayout_4->addWidget(label_start_route, 5, 0, 1, 1);
        
        //Startpoint-Spinbox
        routeStartBox = new QSpinBox(groupBox_3);
        routeStartBox->setObjectName(QStringLiteral("routeStartBox"));
        routeStartBox->setMinimum(0);
        routeStartBox->setMaximum(2147483647);
        gridLayout_4->addWidget(routeStartBox, 5, 1, 1, 1);
        
        //Endpoint-Label
        label_end_route  = new QLabel(groupBox_3);
        label_end_route->setObjectName(QStringLiteral("label_end_route"));
        gridLayout_4->addWidget(label_end_route, 6, 0, 1, 1);
        
        //Endpoint-Spinbox
        routeEndBox = new QSpinBox(groupBox_3);
        routeEndBox->setObjectName(QStringLiteral("routeEndBox"));
        routeEndBox->setMinimum(0);
        routeEndBox->setMaximum(2147483647);
        gridLayout_4->addWidget(routeEndBox, 6, 1, 1, 1);
        
        //Deviation-Label
        label_deviation  = new QLabel(groupBox_3);
        label_deviation->setObjectName(QStringLiteral("label_deviation"));
        gridLayout_4->addWidget(label_deviation, 7, 0, 1, 1);
        
        //Deviation-Spinbox
        deviationBox = new QSpinBox(groupBox_3);
        deviationBox->setObjectName(QStringLiteral("deviationBox"));
        deviationBox->setMinimum(1);
        deviationBox->setSingleStep(1);
        deviationBox->setMaximum(5);
        gridLayout_4->addWidget(deviationBox, 7, 1, 1, 1);

        poiSelectButton->raise();
        routeButton->raise();
        runHeuristicButton->raise();
        angleSpinBox->raise();
        seedSpinBox->raise();
        heuristicComboBox->raise();
        saveButton->raise();

        gridLayout_2->addWidget(groupBox_3, 0, 0, 1, 1);

        groupBox_4 = new QGroupBox(groupBox);
        groupBox_4->setObjectName(QStringLiteral("groupBox_4"));
        gridLayout_5 = new QGridLayout(groupBox_4);
        gridLayout_5->setSpacing(6);
        gridLayout_5->setContentsMargins(11, 11, 11, 11);
        gridLayout_5->setObjectName(QStringLiteral("gridLayout_5"));
        label = new QLabel(groupBox_4);
        label->setObjectName(QStringLiteral("label"));

        gridLayout_5->addWidget(label, 0, 0, 1, 1);

        label_2 = new QLabel(groupBox_4);
        label_2->setObjectName(QStringLiteral("label_2"));

        gridLayout_5->addWidget(label_2, 1, 0, 1, 1);

        label_cur_angle = new QLabel(groupBox_4);
        label_cur_angle->setObjectName(QStringLiteral("label_cur_angle"));

        gridLayout_5->addWidget(label_cur_angle, 0, 1, 1, 1);

        label_cur_zoom = new QLabel(groupBox_4);
        label_cur_zoom->setObjectName(QStringLiteral("label_cur_zoom"));

        gridLayout_5->addWidget(label_cur_zoom, 1, 1, 1, 1);


        gridLayout_2->addWidget(groupBox_4, 0, 1, 1, 1);


        verticalLayout_2->addWidget(groupBox);

        LabelRotation->setCentralWidget(centralWidget);
        menuBar = new QMenuBar(LabelRotation);
        menuBar->setObjectName(QStringLiteral("menuBar"));
        menuBar->setGeometry(QRect(0, 0, 814, 19));
        LabelRotation->setMenuBar(menuBar);
        mainToolBar = new QToolBar(LabelRotation);
        mainToolBar->setObjectName(QStringLiteral("mainToolBar"));
        LabelRotation->addToolBar(Qt::TopToolBarArea, mainToolBar);
        statusBar = new QStatusBar(LabelRotation);
        statusBar->setObjectName(QStringLiteral("statusBar"));
        LabelRotation->setStatusBar(statusBar);

        retranslateUi(LabelRotation);

        QMetaObject::connectSlotsByName(LabelRotation);
    } // setupUi

    void retranslateUi(QMainWindow *LabelRotation)
    {
        LabelRotation->setWindowTitle(QApplication::translate("LabelRotation", "LabelRotation", nullptr));
        groupBox->setTitle(QApplication::translate("LabelRotation", "GroupBox", nullptr));
        groupBox_2->setTitle(QApplication::translate("LabelRotation", "Route Control", nullptr));
        playButton->setText(QApplication::translate("LabelRotation", "Play Route", nullptr));
        stopButton->setText(QApplication::translate("LabelRotation", "Stop Route", nullptr));
        totalStepsLabel->setText(QApplication::translate("LabelRotation", "No Route", nullptr));
        groupBox_3->setTitle(QApplication::translate("LabelRotation", "Controls", nullptr));
        runHeuristicButton->setText(QApplication::translate("LabelRotation", "Run Heuristic", nullptr));
        poiSelectButton->setText(QApplication::translate("LabelRotation", "Select POI", nullptr));
        routeButton->setText(QApplication::translate("LabelRotation", "Create Route", nullptr));
        saveButton->setText(QApplication::translate("LabelRotation", "Save Camera View", nullptr));
        groupBox_4->setTitle(QApplication::translate("LabelRotation", "Information", nullptr));
        label->setText(QApplication::translate("LabelRotation", "Current Angle: ", nullptr));
        label_2->setText(QApplication::translate("LabelRotation", "Current Zoom: ", nullptr));
        label_cur_angle->setText(QApplication::translate("LabelRotation", "---", nullptr));
        label_cur_zoom->setText(QApplication::translate("LabelRotation", "---", nullptr));
        label_speed->setText(QApplication::translate("LabelRotation", "Speed", nullptr));
        label_start_route->setText(QApplication::translate("LabelRotation", "Starting point", nullptr));
        label_end_route->setText(QApplication::translate("LabelRotation", "Endpoint", nullptr));
        label_deviation->setText(QApplication::translate("LabelRotation", "max. Occurrence", nullptr));
    } // retranslateUi

};

namespace Ui {
    class LabelRotation: public Ui_LabelRotation {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_LABELROTATION_H
