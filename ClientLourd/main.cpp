#include <QApplication>
#include <QSqlDatabase>
#include <QDebug>
#include "dlgConnexion.h"
#include "mainwindow.h"
#include <QTranslator>
#include <QLibraryInfo>
#include <QSqlQuery>
#include <QMessageBox>
#include "mainwindowcontroleur.h"

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);

    QSqlDatabase maBase=QSqlDatabase::addDatabase("QMYSQL");
    maBase.setHostName("localhost");
    maBase.setDatabaseName("dbNewWorld2");
    maBase.setUserName("adminDBNW");
    maBase.setPassword("@42Bz8ai");

    if(maBase.open())
    {
        DlgConnexion login;

        while(login.exec()==QDialog::Accepted)
        {
            QString qsTypeUser = login.getTypeUser();
            QString qsLoginUser = login.getLogin();

            if(qsTypeUser == "gestionnaire")
            {
                MainWindow w(qsLoginUser);
                w.show();
                return a.exec();
            }
            else if(qsTypeUser == "controleur")
            {
                MainWindowControleur w(qsLoginUser);
                w.show();
                return a.exec();
            }
            else
            {
                qDebug()<<"pas les droits"<<endl;
            }

        }
    }
}
