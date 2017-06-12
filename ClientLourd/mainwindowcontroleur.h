#ifndef MAINWINDOWCONTROLEUR_H
#define MAINWINDOWCONTROLEUR_H

#include <QMainWindow>

namespace Ui {
class MainWindowControleur;
}

class MainWindowControleur : public QMainWindow
{
    Q_OBJECT

public:
    explicit MainWindowControleur(QString qsLogin, QWidget *parent = 0);
    ~MainWindowControleur();
    QString m_qsLogin;
    void loadVisite();
    void loadComboBoxEtat();

private slots:
    void on_listWidgetVisite_itemClicked();

    void on_pushButtonModifier_clicked();

private:
    Ui::MainWindowControleur *ui;
};

#endif // MAINWINDOWCONTROLEUR_H
