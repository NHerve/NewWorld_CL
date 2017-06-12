import { NgModule } from '@angular/core';
import { CartePage } from './carte';
import { IonicPageModule } from 'ionic-angular';

@NgModule({
  declarations: [CartePage,],
  imports: [IonicPageModule.forChild(CartePage)],
  exports: [CartePage]
})
export class CarteModule {}
