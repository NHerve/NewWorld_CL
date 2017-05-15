#include "dlgConnexion.h"
#include "ui_dlgConnexion.h"
#include <QSqlDatabase>
#include <QDebug>
#include <QSqlError>
#include <QMessageBox>
#include <QSqlQuery>


DlgConnexion::DlgConnexion(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::DlgConnexion)
{
    ui->setupUi(this);
    enableButConnexion();
}

DlgConnexion::~DlgConnexion()
{
    delete ui;
}

//avtive ou désactive le bouton connexion en fonction du remplissage des champs.
void DlgConnexion::enableButConnexion()
{
    qDebug()<<"void DlgConnexion::enableButConnexion()"<<endl;

    if(ui->lineEditUser->text()=="")
    {
        ui->butConnexion->setEnabled(false);
    }
    else
    {
        if(ui->lineEditPassword->text()=="")
        {
            ui->butConnexion->setEnabled(false);
        }
        else
        {
            ui->butConnexion->setEnabled(true);
        }
    }
}

void DlgConnexion::on_lineEditUser_textChanged(const QString &arg1)
{
    ui->butConnexion->setEnabled(true);
}

void DlgConnexion::on_lineEditPassword_textChanged(const QString &arg1)
{
    ui->butConnexion->setEnabled(true);
}

void DlgConnexion::on_butConnexion_clicked()
{
    qDebug()<<"void DlgConnexion::on_butConnexion_clicked()"<<endl;
    QString qsUser =  ui->lineEditUser->text();
    QString qsMdp = ui->lineEditPassword->text();
    QString qsReq="select type_utilisateur from employer where login = '"+qsUser + "' AND mdp = '"+qsMdp + "'";
    //qDebug()<<qsReq;
    QSqlQuery reqConnexion(qsReq);

    if(reqConnexion.exec())
    {
       reqConnexion.first();
       m_typeUser = reqConnexion.value(0).toString();
       accept();


    }else
    {
        qDebug()<<"connection a la base a echoué"<<endl;
        qDebug()<<reqConnexion.isValid()<<endl<<endl;


    }

}
QString DlgConnexion::getTypeUser()
{
    qDebug()<<"QString DlgConnexion::getTypeUser()"<<endl;
    return m_typeUser;
}

void DlgConnexion::on_butCancel_clicked()
{
    QDialog::reject();
}
