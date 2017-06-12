import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { ModalController } from 'ionic-angular';
import { ModalPage } from './ModalContentPage';
import { Utilisateurs } from '../../providers/utilisateurs/utilisateurs';



@Component({
  selector: 'page-liste',
  templateUrl: 'contact.html'
})
export class ContactPage {
  utilisateur = [];

  constructor(public navCtrl: NavController, public modalCtrl: ModalController, private utilisateurs: Utilisateurs)
  {
      utilisateurs.load().subscribe(utilisateurs => { 
      this.utilisateur = utilisateurs;

      console.log(this.utilisateur);

  });
  }

  openModal(utilisateurNum) {
    let modal = this.modalCtrl.create(ModalPage, utilisateurNum);
    modal.present();
  }


}

