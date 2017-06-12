#include "mainwindowcontroleur.h"
#include "ui_mainwindowcontroleur.h"
#include <QSqlQuery>
#include <QListWidgetItem>
#include <QDebug>
#include <QDate>
#include <QTime>

MainWindowControleur::MainWindowControleur(QString qsLogin, QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindowControleur)
{
    ui->setupUi(this);
    m_qsLogin = qsLogin;
    loadVisite();
    loadComboBoxEtat();
    ui->dateEdit->setEnabled(false);
}

MainWindowControleur::~MainWindowControleur()
{
    delete ui;
}

void MainWindowControleur::loadVisite()
{
    qDebug()<<"void MainWindowControleur::loadVisite()"<<endl;

    QString qsReqLoadVisite = "select visiteProd.id, dateVisite, utilisateurs.nom, utilisateurs.prenom, visiteProd.login from visite inner join visiteProd on visite.id=visiteProd.id inner join utilisateurs on visiteProd.login=utilisateurs.login where dateVisite<NOW()";
    QSqlQuery reqLoadVisite(qsReqLoadVisite);

    while(reqLoadVisite.next())
    {
        QString qsNumVisite = reqLoadVisite.value(0).toString();
        QString qsDate = reqLoadVisite.value(1).toString();
        QString qsNom = reqLoadVisite.value(2).toString();
        QString qsPrenom = reqLoadVisite.value(3).toString();
        QString qsLogin = reqLoadVisite.value(4).toString();
        QListWidgetItem *Item = new QListWidgetItem(qsDate+" "+qsNom + " " + qsPrenom);
        Item->setData(32,qsNumVisite);
        Item->setData(33, qsLogin);
        qDebug()<<Item->data(32).toString()<<endl;

        ui->listWidgetVisite->addItem(Item);

    }

}

void MainWindowControleur::on_listWidgetVisite_itemClicked()
{
    qDebug()<<"void MainWindowControleur::on_listWidgetVisite_itemClicked(QListWidgetItem *item)"<<endl;

    QString qsVisite = ui->listWidgetVisite->currentItem()->data(32).toString();
    QString qsLogin = ui->listWidgetVisite->currentItem()->data(33).toString();
    QString qsCommmentaire;
    QTime qtHArr;
    QTime qtHFin;
    QString qsEtat;
    QDate qdDate;

    QString qsReqRemplirChamp = "select visiteProd.commentaire, visiteProd.hArr, visiteProd.hFin, visiteProd.etat, dateVisite from visiteProd inner join visite on visiteProd.id = visite.id where visiteProd.id = "+qsVisite+" and visiteProd.login ='"+qsLogin+"'";
    //qDebug()<<qsReqRemplirChamp<<endl;
    QSqlQuery reqRemplirChamp;
    if(reqRemplirChamp.exec(qsReqRemplirChamp))
    {
        reqRemplirChamp.first();
        qsCommmentaire = reqRemplirChamp.value(0).toString();
        qtHArr = reqRemplirChamp.value(1).toTime();
        qtHFin = reqRemplirChamp.value(2).toTime();
        qsEtat = reqRemplirChamp.value(3).toString();
        qdDate = reqRemplirChamp.value(4).toDate();

        if(qsEtat == "valide")
        {
            ui->comboBoxEtat->setCurrentIndex(1);
        }else
        {
            if(qsEtat == "enAttente")
            {
                ui->comboBoxEtat->setCurrentIndex(0);
            }else
            {
                ui->comboBoxEtat->setCurrentIndex(2);
            }
        }


        ui->textEditCommentaire->setText(qsCommmentaire);
        ui->dateEdit->setDate(qdDate);
        ui->timeEditDebut->setTime(qtHArr);
        ui->timeEditFin->setTime(qtHFin);

    }
}

void MainWindowControleur::loadComboBoxEtat()
{
    qDebug()<<"void MainWindowControleur::loadComboBoxEtat()"<<endl;

    QString qsEnAttente = "en attente";
    QString qsValide = "valide";
    QString qsNonValide = "non valide";
    ui->comboBoxEtat->addItem(qsEnAttente);
    ui->comboBoxEtat->addItem(qsValide);
    ui->comboBoxEtat->addItem(qsNonValide);

}

void MainWindowControleur::on_pushButtonModifier_clicked()
{
    qDebug()<<"void MainWindowControleur::on_pushButtonModifier_clicked()"<<endl;

    QString qsCommentaire = ui->textEditCommentaire->toPlainText();
    QString qsHArr = ui->timeEditDebut->text();
    QString qsHFin = ui->timeEditFin->text();
    QString qsEtatCb = ui->comboBoxEtat->currentText();
    QString qsEtat;

    QString qsLogin = ui->listWidgetVisite->currentItem()->data(33).toString();
    QString qsId = ui->listWidgetVisite->currentItem()->data(32).toString();

    if(qsEtatCb == "en attente")
    {
        qsEtat = "enAttente";
    }
    if(qsEtatCb == "valide")
    {
        qsEtat = "valide";
    }
    if(qsEtatCb == "non valide")
    {
        qsEtat = "nonValide";
    }

    QString qsReqUpdate = "update visiteProd set hArr='"+qsHArr+"', hFin='"+qsHFin+"', etat='"+qsEtat+"', commentaire='"+qsCommentaire+"' where login='"+qsLogin+"' and id='"+qsId+"'";
    qDebug()<<qsReqUpdate<<endl;


    if(reqUpdate.exec(qsReqUpdate))
    {
    statusBar()->showMessage("Visite mise a jour");
    }




}
