/********************************************************************************
** Form generated from reading UI file 'poifilterchooser.ui'
**
** Created by: Qt User Interface Compiler version 5.11.1
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_POIFILTERCHOOSER_H
#define UI_POIFILTERCHOOSER_H

#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QDialog>
#include <QtWidgets/QDialogButtonBox>
#include <QtWidgets/QGridLayout>
#include <QtWidgets/QHeaderView>
#include <QtWidgets/QTreeView>

QT_BEGIN_NAMESPACE

class Ui_POIFilterChooser
{
public:
    QGridLayout *gridLayout;
    QDialogButtonBox *buttonBox;
    QTreeView *treeView;

    void setupUi(QDialog *POIFilterChooser)
    {
        if (POIFilterChooser->objectName().isEmpty())
            POIFilterChooser->setObjectName(QStringLiteral("POIFilterChooser"));
        POIFilterChooser->resize(400, 300);
        gridLayout = new QGridLayout(POIFilterChooser);
        gridLayout->setObjectName(QStringLiteral("gridLayout"));
        buttonBox = new QDialogButtonBox(POIFilterChooser);
        buttonBox->setObjectName(QStringLiteral("buttonBox"));
        buttonBox->setOrientation(Qt::Horizontal);
        buttonBox->setStandardButtons(QDialogButtonBox::Cancel|QDialogButtonBox::Ok);

        gridLayout->addWidget(buttonBox, 1, 0, 1, 1);

        treeView = new QTreeView(POIFilterChooser);
        treeView->setObjectName(QStringLiteral("treeView"));

        gridLayout->addWidget(treeView, 0, 0, 1, 1);


        retranslateUi(POIFilterChooser);

        QMetaObject::connectSlotsByName(POIFilterChooser);
    } // setupUi

    void retranslateUi(QDialog *POIFilterChooser)
    {
        POIFilterChooser->setWindowTitle(QApplication::translate("POIFilterChooser", "Dialog", nullptr));
    } // retranslateUi

};

namespace Ui {
    class POIFilterChooser: public Ui_POIFilterChooser {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_POIFILTERCHOOSER_H
