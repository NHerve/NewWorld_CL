#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include <QListWidget>

namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
    Q_OBJECT
    
public:
    explicit MainWindow(QString qsLogin, QWidget *parent = 0);
    ~MainWindow();
    
    void loadEmployer();
    void loadRayon();
    void loadCategorie();
    void loadProduit();
    void loadControleur();
    void loadProducteur();
    void loadVisite();

    QString GetRandomString() const;
    QString m_qsRayon;
    QString m_qsCategorie;
    QString m_qsLogin;
private slots:

    void on_butAdd_clicked();

    void on_butDel_clicked();

    void on_listWidgetPersonnels_itemClicked(QListWidgetItem *item);

    void on_pushButton_clicked();

    void on_butUpdate_clicked();


    void on_cbRayon_currentIndexChanged(int index);

    void on_pushButtonAddRayon_clicked();

    void on_pushButtonAddCat_clicked();

    void on_pushButtonAdd_clicked();

    void on_comboBoxCat_currentIndexChanged(const QString &arg1);

    void on_pushButtonDel_clicked();

    void on_pushButtonDelCat_clicked();

    void on_pushButtonDelRayon_clicked();

    void on_addVisite_clicked();

private:
    Ui::MainWindow *ui;
};

#endif // MAINWINDOW_H
