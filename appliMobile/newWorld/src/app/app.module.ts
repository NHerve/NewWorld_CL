import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';
import { HttpModule } from '@angular/http';

import { ConnexionPage } from '../pages/connexion/connexion';
import { CartePage } from '../pages/carte/carte';
import { ContactPage } from '../pages/contact/contact';
import { ModalPage } from '../pages/contact/ModalContentPage';
import { InfoPage } from '../pages/info/info';
import { TabsPage } from '../pages/tabs/tabs';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { ControleurVisite } from '../providers/controleur-visite/controleur-visite';

import { AsyncLocalStorageModule } from 'angular-async-local-storage';
import { AuthService } from './../providers/auth-service/auth-service';
import { Utilisateurs } from '../providers/utilisateurs/utilisateurs';

@NgModule({
  declarations: [
    MyApp,
    ConnexionPage,
    CartePage,
    ContactPage,
    ModalPage,
    InfoPage,
    TabsPage
  ],
  imports: [
    BrowserModule,
    HttpModule,
    AsyncLocalStorageModule,
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    ConnexionPage,
    CartePage,
    ModalPage,
    ContactPage,
    InfoPage,
    TabsPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    AuthService,
    ControleurVisite,
    Utilisateurs
  ]
})
export class AppModule {}
