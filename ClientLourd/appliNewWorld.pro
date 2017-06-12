#-------------------------------------------------
#
# Project created by QtCreator 2017-03-10T13:13:55
#
#-------------------------------------------------

QT       += core gui sql

greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = appliNewWorld
TEMPLATE = app


SOURCES += main.cpp\
        mainwindow.cpp \
    dlgConnexion.cpp \
    mainwindowcontroleur.cpp

HEADERS  += mainwindow.h \
    dlgConnexion.h \
    mainwindowcontroleur.h

FORMS    += mainwindow.ui \
    dlgConnexion.ui \
    mainwindowcontroleur.ui
