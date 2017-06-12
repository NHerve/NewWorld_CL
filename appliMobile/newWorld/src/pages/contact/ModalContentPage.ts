import { Component } from '@angular/core';
import { Platform, NavParams, ViewController } from 'ionic-angular';
import { Utilisateurs } from '../../providers/utilisateurs/utilisateurs';

@Component({
templateUrl: 'modal-content.html'
})

export class ModalPage {
  user = [];
  utilisateur = [];

  constructor(
    public platform: Platform, public params: NavParams, public viewCtrl: ViewController, private utilisateurs: Utilisateurs) 
  {
    utilisateurs.load().subscribe(user => {
			this.user = user;
      this.utilisateur = this.user[this.params.get('utilisateurNum')];
      console.log("Fenetre Modal ",this.utilisateur);
			});
  
  }

  dismiss() {
    this.viewCtrl.dismiss();
  }
}
