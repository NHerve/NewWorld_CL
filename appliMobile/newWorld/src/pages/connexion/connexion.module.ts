import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { ConnexionPage } from './connexion';

@NgModule({
  declarations: [
    ConnexionPage,
  ],
  imports: [
    IonicPageModule.forChild(ConnexionPage),
  ],
  exports: [
    ConnexionPage
  ]
})
export class ConnexionModule {}
