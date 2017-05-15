#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QDebug>
#include <QSqlQuery>
#include <QTime>
#include <QDate>
#include <QListWidget>
#include <QMessageBox>

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{
    ui->setupUi(this);
    loadEmployer();
}

MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::loadEmployer()
{
    qDebug()<<"MainWindow::loadEmployer()"<<endl;

    QSqlQuery reqLoadEmployer("select nom,prenom,login from employer where etat_validation <> 'suprimmer'");
    ui->listWidgetPersonnels->clear();

    while(reqLoadEmployer.next())
    {

        QString qsNom = reqLoadEmployer.value(0).toString();
        QString qsPrenom = reqLoadEmployer.value(1).toString();
        QString qsLogin = reqLoadEmployer.value(2).toString();
        QListWidgetItem *Item = new QListWidgetItem(qsNom + " " + qsPrenom);
        Item->setData(32,qsLogin);
        //qDebug()<<Item->data(32).toString()<<endl;

        ui->listWidgetPersonnels->addItem(Item);

    }


}

void MainWindow::on_butAdd_clicked()
{
    qDebug()<<"void MainWindow::on_butAdd_clicked()"<<endl;

    QDate dateInscription;
    QString qsDateInscription = dateInscription.currentDate().toString("yyyy-MM-dd");
    QString qsPseudo = ui->lineEditPseudo->text();
    QString qsNom = ui->lineEditNom->text();
    QString qsMDP = GetRandomString();
    QString qsPrenom = ui->lineEditPrenom->text();
    QString qsTelFixe = ui->lineEditTelFixe->text();
    QString qsTelPort = ui->lineEditTelPort->text();
    QString qsMail = ui->lineEditMail->text();
    QString qsAdresse = ui->lineEditAdresse->text();
    QString qsCP = ui->lineEditCP->text();
    QString qsVille = ui->lineEditVille->text();
    QString qsIban = ui->lineEditIban->text();
    QString qsTypeUser;
    QString qsEtatValidation = "valide";

    if(ui->radioButtonController->isChecked())
    {
        qsTypeUser = "controleur";
    }

    if(ui->radioButtonManager->isChecked())
    {
        qsTypeUser = "gestionnaire";
    }

    QString qsReqInsert("insert into employer(login,mdp,nom,prenom,tel_fixe,tel_portable,mail,adresse,code_postal,ville,type_utilisateur,iban,etat_validation,date_inscription) VALUES ('");
    qsReqInsert += qsPseudo +"', '";
    qsReqInsert += qsMDP +"', '";
    qsReqInsert += qsNom +"', '";
    qsReqInsert += qsPrenom +"', '";
    qsReqInsert += qsTelFixe +"', '";
    qsReqInsert += qsTelPort +"', '";
    qsReqInsert += qsMail +"', '";
    qsReqInsert += qsAdresse +"', '";
    qsReqInsert += qsCP +"', '";
    qsReqInsert += qsVille +"', '";
    qsReqInsert += qsTypeUser +"', '";
    qsReqInsert += qsIban +"', '";
    qsReqInsert += qsEtatValidation +"', '";
    qsReqInsert += qsDateInscription +"')";

    QSqlQuery reqInsert(qsReqInsert);

    if(reqInsert.exec())
    {
        qDebug()<<"ajout a la base"<<endl;
    }
    else
    {
        //qDebug()<<qsReqInsert<<endl;
        statusBar()->showMessage("le contact n'a pas etait ajouter" );
    }


    loadEmployer();

}

QString MainWindow::GetRandomString() const
{
    const QString possibleCharacters("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789");
    const int randomStringLength = 12;

    QTime time;
    qsrand(time.currentTime().msec());
    QString randomString;
    for(int i=0; i<randomStringLength; ++i)
    {
        int index = qrand() % possibleCharacters.length();
        QChar nextChar = possibleCharacters.at(index);
        randomString.append(nextChar);
    }
    return randomString;
}

void MainWindow::on_butDel_clicked()
{
    qDebug()<<"void MainWindow::on_butDel_clicked()"<<endl;

    if(ui->listWidgetPersonnels->currentItem())
    {
        QString qsPseudo = ui->listWidgetPersonnels->currentItem()->data(32).toString();
        QString qsReqDel("update employer set etat_validation = 'suprimmer' where login = '" +qsPseudo+ "'");

        int ret = QMessageBox::question(this,tr("GestContact"),tr("voulez vous supprimmer l'employer' ?"),
                                        QMessageBox::Yes | QMessageBox::No,QMessageBox::No);
        if(ret == QMessageBox::Yes)
        {
            QSqlQuery reqDel(qsReqDel);
        }

        loadEmployer();
    }

}

void MainWindow::on_listWidgetPersonnels_itemClicked(QListWidgetItem *item)
{
    qDebug()<<"MainWindow::on_listWidgetPersonnels_currentRowChanged(int currentRow)"<<endl;


    QString qsEmployer = ui->listWidgetPersonnels->currentItem()->text();
    QStringList list = qsEmployer.split(" ");
    QString qsPrenom = list.value(1);
    QString qsNom = list.value(0);
    QString qsLogin = ui->listWidgetPersonnels->currentItem()->data(32).toString();

    QString qsReq("select login, nom, prenom, tel_fixe, tel_portable, mail, adresse, code_postal, ville, type_utilisateur, iban from employer where nom = '" + qsNom + "' AND prenom = '" + qsPrenom + "' AND login = '" + qsLogin +"'");
    QSqlQuery reqLoadInfo(qsReq);

    //qDebug()<<qsReq<<endl<<qsLogin<<endl;

    if(reqLoadInfo.first())
    {
        ui->lineEditPseudo->setText(reqLoadInfo.value(0).toString());
        ui->lineEditNom->setText(reqLoadInfo.value(1).toString());
        ui->lineEditPrenom->setText(reqLoadInfo.value(2).toString());
        ui->lineEditTelFixe->setText(reqLoadInfo.value(3).toString());
        ui->lineEditTelPort->setText(reqLoadInfo.value(4).toString());
        ui->lineEditMail->setText(reqLoadInfo.value(5).toString());
        ui->lineEditAdresse->setText(reqLoadInfo.value(6).toString());
        ui->lineEditCP->setText(reqLoadInfo.value(7).toString());
        ui->lineEditVille->setText(reqLoadInfo.value(8).toString());
        ui->lineEditIban->setText(reqLoadInfo.value(10).toString());

        if(reqLoadInfo.value(9).toString() == "controleur")
        {
            ui->radioButtonController->setChecked(true);
        }
        else if(reqLoadInfo.value(9).toString() == "gestionnaire")
        {
            ui->radioButtonManager->setChecked(true);
        }
    }
}

void MainWindow::on_pushButton_clicked() // boutton ResetPassword
{
    qDebug()<<"void MainWindow::on_pushButton_clicked() ResetPassword"<<endl;

    if(ui->listWidgetPersonnels->currentItem())
    {
        QString qsLogin = ui->listWidgetPersonnels->currentItem()->data(32).toString();
        QString qsReqInfo = "select nom, prenom from employer where login ='" + qsLogin + "'";
        QSqlQuery reqInfo = qsReqInfo;
        QString qsNom;
        QString qsPrenom;
        //qDebug()<<qsReqInfo<<endl;
        if(reqInfo.first())
        {
            qsNom = reqInfo.value(0).toString();
            qsPrenom = reqInfo.value(1).toString();

        }

        int ret = QMessageBox::question(this,"GestContact","voulez vous modifier le mot de passe de"+ qsNom +" " + qsPrenom,
                                        QMessageBox::Yes | QMessageBox::No,QMessageBox::No);
        if(ret == QMessageBox::Yes)
        {
            QString qsMdp = GetRandomString();
            QString qsReqMdp = "update employer set mdp = '" + qsMdp + "' where login = '" + qsLogin +"'";

            //qDebug()<<qsReqMdp<<endl;
            QSqlQuery reqMdp = qsReqMdp;

            if(reqMdp.exec())
            {
                statusBar()->showMessage("le mot de passe a "+ qsNom + " " +qsPrenom + " a etait modifie" );
            }

        }

    }
}

void MainWindow::on_butUpdate_clicked()
{
    if(ui->listWidgetPersonnels->currentItem())
    {
        QString qsLoginCurrent = ui->listWidgetPersonnels->currentItem()->data(32).toString();

        QString qsPseudo = ui->lineEditPseudo->text();
        QString qsNom = ui->lineEditNom->text();
        QString qsPrenom = ui->lineEditPrenom->text();
        QString qsTelFixe = ui->lineEditTelFixe->text();
        QString qsTelPort = ui->lineEditTelPort->text();
        QString qsMail = ui->lineEditMail->text();
        QString qsAdresse = ui->lineEditAdresse->text();
        QString qsCP = ui->lineEditCP->text();
        QString qsVille = ui->lineEditVille->text();
        QString qsTypeUser;
        QString qsIban = ui->lineEditIban->text();

        if(ui->radioButtonController->isChecked())
        {
            qsTypeUser = "controleur";
        }

        if(ui->radioButtonManager->isChecked())
        {
            qsTypeUser = "gestionnaire";
        }
        // suite ici pour la prochaine fois
        //QString qsReqUP = "update employer set login = '" + qsPseudo + "'"+ " mdp = '"+ +"' nom = '"+ +"' prenom = '"+ +"'" +" where login = '" + qsLoginCurrent +"'";



    }
}
