#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QDebug>
#include <QSqlQuery>
#include <QTime>
#include <QDate>
#include <QListWidget>
#include <QMessageBox>
#include <QInputDialog>

MainWindow::MainWindow(QString qsLogin,QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{

    ui->setupUi(this);
    m_qsLogin = qsLogin;
    loadEmployer();
    loadRayon();
    loadControleur();
    loadProducteur();
    loadVisite();
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

    QSqlQuery reqInsert;

    if(reqInsert.exec(qsReqInsert))
    {
        qDebug()<<"ajout a la base"<<endl;
        statusBar()->showMessage("contact ajouter" );
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

        int ret = QMessageBox::question(this,tr("Gestion Employer"),tr("voulez vous supprimmer l'employer' ?"),
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
        QSqlQuery reqInfo(qsReqInfo);
        QString qsNom;
        QString qsPrenom;
        //qDebug()<<qsReqInfo<<endl;
        if(reqInfo.first())
        {
            qsNom = reqInfo.value(0).toString();
            qsPrenom = reqInfo.value(1).toString();

        }

        int ret = QMessageBox::question(this,"Gestion Employer","voulez vous modifier le mot de passe de"+ qsNom +" " + qsPrenom,
                                        QMessageBox::Yes | QMessageBox::No,QMessageBox::No);
        if(ret == QMessageBox::Yes)
        {
            QString qsMdp = GetRandomString();
            QString qsReqMdp = "update employer set mdp = '" + qsMdp + "' where login = '" + qsLogin +"'";

            //qDebug()<<qsReqMdp<<endl;
            QSqlQuery reqMdp(qsReqMdp);

            if(reqMdp.exec())
            {
                statusBar()->showMessage("le mot de passe a "+ qsNom + " " +qsPrenom + " a etait modifie" );
            }

        }

    }
}

void MainWindow::on_butUpdate_clicked()
{
    qDebug()<<"void MainWindow::on_butUpdate_clicked()"<<endl;

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



        int ret = QMessageBox::question(this,"Gestion Employer","voulez vous modifier l'employer "+ qsNom +" " + qsPrenom,
                                        QMessageBox::Yes | QMessageBox::No,QMessageBox::No);
        if(ret == QMessageBox::Yes)
        {
            QString qsReqUP = "update employer set login = '" + qsPseudo + "', nom = '"+ qsNom +"', prenom = '"+ qsPrenom +"', tel_fixe = '"+qsTelFixe+"', tel_portable = '"+qsTelPort+"', mail = '"+qsMail+"', adresse = '"+qsAdresse+"', code_postal = '"+qsCP+"', ville = '"+qsVille+"', type_utilisateur = '"+qsTypeUser+"', iban = '"+qsIban+"'" +" where login = '" + qsLoginCurrent +"'";
            //qDebug()<<qsReqUP<<endl;
            QSqlQuery reqUp(qsReqUP);


            if(reqUp.exec())
            {
                statusBar()->showMessage("l'employer "+ qsNom + " " +qsPrenom + " a etait modifie" );
            }

        }

    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

void MainWindow::loadRayon()
{
    qDebug()<<"void MainWindow::loadRayon()"<<endl;

    ui->cbRayon->clear();

    QString qsReqLoadRay = "select libelle from rayon where etat_rayon <> 'supprime'";
    QSqlQuery reqLoadRay(qsReqLoadRay);

    while(reqLoadRay.next())
    {
        ui->cbRayon->addItem(reqLoadRay.value(0).toString());
    }
}

void MainWindow::loadCategorie()
{
    qDebug()<<"void MainWindow::loadCategorie()"<<endl;
    ui->comboBoxCat->clear();
    QString qsReqGetIdRay = "select noRayon from rayon where libelle ='"+m_qsRayon+"'";
    QSqlQuery reqGetIdRay(qsReqGetIdRay);
    reqGetIdRay.first();
    QString qsRayon = reqGetIdRay.value(0).toString();
    //qDebug()<<qsRayon<<endl;

    QString qsReqLoadCat = "select libelle from categorie where noRayon="+qsRayon+" and etat_categorie <> 'supprime'";
    //qDebug()<<qsReqLoadCat<<endl;
    QSqlQuery reqLoadCat(qsReqLoadCat);
    while(reqLoadCat.next())
    {
        ui->comboBoxCat->addItem(reqLoadCat.value(0).toString());
    }
}

void MainWindow::loadProduit()
{
    qDebug()<<"void MainWindow::loadProduit()"<<endl;
    ui->listWidgetProduit->clear();
    QString qsReqGetIdCat = "select noCat from categorie where libelle ='"+m_qsCategorie+"'";
    QSqlQuery reqGetIdCat(qsReqGetIdCat);
    reqGetIdCat.first();
    QString qsCat = reqGetIdCat.value(0).toString();
    //qDebug()<<qsCat<<endl;

    QString qsReqLoadProd = "select libelle, numero from produit where noCat ='"+qsCat+"' and etat_produit <> 'supprime'";
    QSqlQuery reqLoadProd(qsReqLoadProd);

    while(reqLoadProd.next())
    {
        QString qsNomProd = reqLoadProd.value(0).toString();
        QString qsNumProd = reqLoadProd.value(1).toString();

        QListWidgetItem *Item = new QListWidgetItem(qsNomProd);
        Item->setData(32,qsNumProd);
        //qDebug()<<Item->data(32).toString()<<endl;

        ui->listWidgetProduit->addItem(Item);
    }

}


void MainWindow::on_cbRayon_currentIndexChanged(int index)
{
    qDebug()<<"void MainWindow::on_cbRayon_currentIndexChanged(int index)"<<endl;
    m_qsRayon = ui->cbRayon->currentText();
    loadCategorie();
    if(ui->comboBoxCat->currentText().isEmpty())
    {
        m_qsCategorie="";
    }
    loadProduit();

}

void MainWindow::on_comboBoxCat_currentIndexChanged(const QString &arg1)
{
    if(!ui->comboBoxCat->currentText().isEmpty())
    {
        qDebug()<<"void MainWindow::on_comboBoxCat_currentIndexChanged(const QString &arg1)"<<endl;
        m_qsCategorie=ui->comboBoxCat->currentText();
        loadProduit();
    }
}


void MainWindow::on_pushButtonAddRayon_clicked()
{
    qDebug()<<"void MainWindow::on_pushButtonAddRayon_clicked()"<<endl;

    bool ok;
    QString qsNomRayon = QInputDialog::getText(this,tr("Ajouter Rayon"),tr("Nom du rayon"),QLineEdit::Normal,"rayon",&ok);
    if(ok && !qsNomRayon.isEmpty()){
        int poss = ui->cbRayon->findText(qsNomRayon);
        if(poss==-1){
            QString qsReqLastIdRay = "select max(noRayon+1)from rayon";
            QSqlQuery reqLastIdRay(qsReqLastIdRay);
            reqLastIdRay.first();
            QString qsLastIdRay = reqLastIdRay.value(0).toString();

            QString qsReqInsertRayon = "insert into rayon(noRayon,libelle,etat_rayon) values ("+qsLastIdRay+", '"+qsNomRayon+"' , 'valide')";

            qDebug()<<qsReqInsertRayon<<endl;

            QSqlQuery reqInsertRayon;
            if(reqInsertRayon.exec(qsReqInsertRayon))
            {
                //qDebug()<<"Rayon ajouté"<<endl;
                statusBar()->showMessage("Rayon ajoute");
            }else
            {
                //qDebug()<<"Erreur lors de l'ajout du rayon"<<endl;
                statusBar()->showMessage("Erreur lors de l'ajout du rayon");
            }

        }else{
            statusBar()->showMessage("Ce rayon existe deja");
        }
    }

    loadRayon();
}


void MainWindow::on_pushButtonAddCat_clicked()
{
    qDebug()<<"void MainWindow::on_pushButtonAddCat_clicked()"<<endl;
    bool ok;

    QString qsNomCategorie = QInputDialog::getText(this,tr("Ajouter Categorie"),tr("Nom de la categorie"),QLineEdit::Normal,"categorie",&ok);
    if(ok && !qsNomCategorie.isEmpty()){
        int poss = ui->comboBoxCat->findText(qsNomCategorie);
        if(poss==-1){
            QString qsReqLastIdCat = "select max(noCat+1)from categorie";
            QSqlQuery reqLastIdCat(qsReqLastIdCat);
            reqLastIdCat.first();
            QString qsLastIdCat = reqLastIdCat.value(0).toString();

            QString qsReqGetIdRay = "select noRayon from rayon where libelle ='"+m_qsRayon+"'";
            QSqlQuery reqGetIdRay(qsReqGetIdRay);
            reqGetIdRay.first();
            QString qsRayon = reqGetIdRay.value(0).toString();

            QString qsReqInsertCat = "insert into categorie(noCat,libelle,noRayon,etat_categorie) values ("+qsLastIdCat+", '"+qsNomCategorie+"', "+qsRayon+", 'valide')";
            //qDebug()<<qsReqInsertCat<<endl;

            QSqlQuery reqInsertCat;
            if(reqInsertCat.exec(qsReqInsertCat))
            {
                //qDebug()<<"Rayon ajouté"<<endl;
                statusBar()->showMessage("Categorie ajoute");
            }else
            {
                //qDebug()<<"Erreur lors de l'ajout du rayon"<<endl;
                statusBar()->showMessage("Erreur lors de l'ajout de la categorie");
            }

        }else{
            statusBar()->showMessage("Cette Categorie existe deja");
        }
    }
    loadCategorie();
}

void MainWindow::on_pushButtonAdd_clicked()
{
    qDebug()<<"void MainWindow::on_pushButtonAdd_clicked()"<<endl;

    ui->listWidgetProduit->clear();
    QString qsReqGetIdCat = "select noCat from categorie where libelle ='"+m_qsCategorie+"'";
    QSqlQuery reqGetIdCat(qsReqGetIdCat);
    reqGetIdCat.first();
    QString qsCat = reqGetIdCat.value(0).toString();

    if(!ui->lineEditNomProd->text().isEmpty())
    {
        QString qsReqLastIdProd = "select max(numero+1)from produit";
        QSqlQuery reqLastIdProd(qsReqLastIdProd);
        reqLastIdProd.first();

        QString qsLastIdProd = reqLastIdProd.value(0).toString();
        QString qsNomProd = ui->lineEditNomProd->text();
        QString qsEtatValidation = "valide";

        QString qsReqInsertProd = "insert into produit(numero,libelle,etat_produit,noCat) values('"+qsLastIdProd+"','"+qsNomProd+"','"+qsEtatValidation+"','"+qsCat+"')";
        //qDebug()<<qsReqInsertProd<<endl;

        QSqlQuery reqInsertProd;
        if(reqInsertProd.exec(qsReqInsertProd))
        {
            statusBar()->showMessage("Produit ajouter");
        }
        else
        {
            statusBar()->showMessage("echec lors de l'ajout de produit");
        }


        loadProduit();
    }
}


void MainWindow::on_pushButtonDel_clicked()
{
    qDebug()<<"void MainWindow::on_pushButtonDel_clicked()"<<endl;

    if(ui->listWidgetProduit->currentItem())
    {
        int ret = QMessageBox::question(this,"Gestion Produit","voulez vous supprimer le produit",
                                        QMessageBox::Yes | QMessageBox::No,QMessageBox::No);
        if(ret == QMessageBox::Yes)
        {
            QString qsNumProd = ui->listWidgetProduit->currentItem()->data(32).toString();
            QString qsDelProd = "update produit set etat_produit = 'supprime' where numero = "+qsNumProd;
            //qDebug()<<qsDelProd<<endl;
            QSqlQuery reqDelProd;
            if(reqDelProd.exec(qsDelProd))
            {
                statusBar()->showMessage("Produit supprimer");
                loadProduit();
            }
            else
            {
                statusBar()->showMessage("Echec lors de la suppression");
            }
        }
    }
}


void MainWindow::on_pushButtonDelCat_clicked()
{
    qDebug()<<"void MainWindow::on_pushButtonDelCat_clicked()"<<endl;

    if(!ui->comboBoxCat->currentText().isEmpty())
    {
        int ret = QMessageBox::question(this,"Gestion Produit","voulez vous supprimer la categorie",
                                        QMessageBox::Yes | QMessageBox::No,QMessageBox::No);
        if(ret == QMessageBox::Yes)
        {
            QString qsReqGetIdRay = "select noRayon from rayon where libelle ='"+m_qsRayon+"'";
            QSqlQuery reqGetIdRay(qsReqGetIdRay);
            reqGetIdRay.first();
            QString qsRayon = reqGetIdRay.value(0).toString();

            QString qsNomCat = ui->comboBoxCat->currentText();
            //qDebug()<<qsNomCat<<endl;

            QString qsReqDelCat = "update categorie set etat_categorie = 'supprime' where libelle = '"+qsNomCat+"' and noRayon = "+qsRayon;
            qDebug()<<qsReqDelCat<<endl;

            QSqlQuery reqDelCat;
            if(reqDelCat.exec(qsReqDelCat))
            {
                statusBar()->showMessage("Categorie supprimer");
            }
            else
            {
                statusBar()->showMessage("Echec lors de la suppression");
            }
        }
        loadCategorie();
        loadProduit();
    }
}

void MainWindow::on_pushButtonDelRayon_clicked()
{
    qDebug()<<"void MainWindow::on_pushButtonDelRayon_clicked()"<<endl;

    if(!ui->cbRayon->currentText().isEmpty())
    {
        int ret = QMessageBox::question(this,"Gestion Rayon","voulez vous supprimer le rayon",
                                        QMessageBox::Yes | QMessageBox::No,QMessageBox::No);
        if(ret == QMessageBox::Yes)
        {
            QString qsReqGetIdRay = "select noRayon from rayon where libelle ='"+m_qsRayon+"'";
            QSqlQuery reqGetIdRay(qsReqGetIdRay);
            reqGetIdRay.first();
            QString qsRayon = reqGetIdRay.value(0).toString();

            QString qsReqDelRay = "update rayon set etat_rayon = 'supprime' where noRayon = "+qsRayon;
            qDebug()<<qsReqDelRay<<endl;

            QSqlQuery reqDelRay;
            if(reqDelRay.exec(qsReqDelRay))
            {
                statusBar()->showMessage("Rayon supprimer");
            }
            else
            {
                statusBar()->showMessage("Echec lors de la suppression");
            }
        }
        loadCategorie();
        loadProduit();
        loadRayon();
    }
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

void MainWindow::loadControleur()
{
    qDebug()<<"void MainWindow::loadControleur()"<<endl;

    QString qsReqLoadControleur = "select login,nom,prenom from employer where type_utilisateur='controleur'";
    QSqlQuery reqLoadControleur(qsReqLoadControleur);

    while(reqLoadControleur.next())
    {

        QString qsLogin = reqLoadControleur.value(0).toString();
        QString qsNom = reqLoadControleur.value(1).toString();
        QString qsPrenom = reqLoadControleur.value(2).toString();
        QListWidgetItem *Item = new QListWidgetItem(qsNom + " " + qsPrenom);
        Item->setData(32,qsLogin);
        //qDebug()<<Item->data(32).toString()<<endl;

        ui->listWidgetControleur->addItem(Item);

    }

}

void MainWindow::loadProducteur()
{
    qDebug()<<"void MainWindow::loadProducteur()"<<endl;

    QString qsReqLoadProd = "select utilisateurs.nom, utilisateurs.prenom, dateVisite from visiteProd inner join utilisateurs on visiteProd.login = utilisateurs.login inner join visite on visiteProd.id = visite.id where type_utilisateur='producteur' OR type_utilisateur='PDV' and dateVisite<NOW()";
    QSqlQuery reqLoadProd(qsReqLoadProd);

    while(reqLoadProd.next())
    {

        QString qsLogin = reqLoadProd.value(0).toString();
        QString qsNom = reqLoadProd.value(1).toString();
        QString qsPrenom = reqLoadProd.value(2).toString();
        QListWidgetItem *Item = new QListWidgetItem(qsNom + " " + qsPrenom);
        Item->setData(32,qsLogin);
        //qDebug()<<Item->data(32).toString()<<endl;

        ui->listWidgetProducteur->addItem(Item);

    }

}

void MainWindow::loadVisite()
{
    qDebug()<<"void MainWindow::loadVisite()"<<endl;

    QString qsReqLoadVisite = "select visite.id, dateVisite, employer.nom, employer.prenom, utilisateurs.nom, utilisateurs.prenom from visite inner join visiteProd on visite.id=visiteProd.id inner join utilisateurs on visiteProd.login=utilisateurs.login inner join employer on visite.controlleur = employer.login  where dateVisite>NOW()";
    QSqlQuery reqLoadVisite(qsReqLoadVisite);

    while(reqLoadVisite.next())
    {
        QString qsNumVisite = reqLoadVisite.value(0).toString();
        QString qsDate = reqLoadVisite.value(1).toString();
        QString qsControleurNom = reqLoadVisite.value(2).toString();
        QString qsControleurPrenom = reqLoadVisite.value(3).toString();
        QString qsNom = reqLoadVisite.value(4).toString();
        QString qsPrenom = reqLoadVisite.value(5).toString();
        QListWidgetItem *Item = new QListWidgetItem(qsDate+" "+qsControleurNom+" "+qsControleurPrenom+" "+qsNom + " " + qsPrenom);
        Item->setData(32,qsNumVisite);
        qDebug()<<Item->data(32).toString()<<endl;

        ui->listWidgetVisite->addItem(Item);

    }

}


void MainWindow::on_addVisite_clicked()
{
    qDebug()<<"void MainWindow::on_addVisite_clicked()"<<endl;

    QString qsIdVisite;
    QString qsControlleur;
    QString qsProducteur;
    QString qsDate;
    QString qsHDebut;
    QString qsHFin;
    QString qsCommentaire;


    if(ui->listWidgetControleur->currentItem())
    {
        qsControlleur = ui->listWidgetControleur->currentItem()->data(32).toString();
    }
    if(ui->listWidgetProducteur->currentItem())
    {
        qsProducteur = ui->listWidgetProducteur->currentItem()->data(32).toString();
    }

    QString qsReqLastIdVisite = "select max(id+1) from visite";
    QSqlQuery reqLastIdVisite;
    if(reqLastIdVisite.exec(qsReqLastIdVisite))
    {
        reqLastIdVisite.first();
        qsIdVisite = reqLastIdVisite.value(0).toString();
    }
    qsDate = ui->dateEdit->date().toString("yyyy-MM-dd");
    //qDebug()<<qsDate<<endl;
    qsHDebut = ui->timeEditDebut->text();
    qsHFin = ui->timeEditFin->text();
    qsCommentaire = ui->textEdit->toPlainText();
    //qDebug()<<qsCommentaire<<endl;

    QString qsReqInsert = "insert into visite(id,dateVisite,hDeb,hFin,controlleur,gestionnaire, commentaire) values('"+ qsIdVisite +"','"+ qsDate +"','"+ qsHDebut +"','"+qsHFin+"','"+qsControlleur+"','"+m_qsLogin+"','"+qsCommentaire+"')";
    qDebug()<<qsReqInsert<<endl;
    QSqlQuery reqInsert;

    QString qsReqInsertVisiteProd = "insert into visiteProd(login,id,etat) values('"+qsProducteur+"','"+qsIdVisite+"','enAttente')";
    qDebug()<<qsReqInsertVisiteProd<<endl;
    QSqlQuery reqInsertVisiteProd;

    if(reqInsert.exec(qsReqInsert) && reqInsertVisiteProd.exec(qsReqInsertVisiteProd))
    {
        statusBar()->showMessage("Visite Ajouter");
    }
    loadVisite();
}

