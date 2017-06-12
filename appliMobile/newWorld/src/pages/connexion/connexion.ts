import { Component } from '@angular/core';
import { NavController, AlertController, LoadingController, Loading, IonicPage } from 'ionic-angular';
import { AuthService } from '../../providers/auth-service/auth-service';
import { TabsPage } from '../../pages/tabs/tabs';

@IonicPage()
@Component({
  selector: 'page-connexion',
  templateUrl: 'connexion.html',
})
export class ConnexionPage {

  loading: Loading;
  registerCredentials = { username: '', password: '' };
  usrData = [];

  constructor(public navCtrl: NavController, private auth: AuthService, private alertCtrl: AlertController, private loadingCtrl: LoadingController) {
  }

  ionViewDidLoad() {
  }

    public login() {

	this.auth.load(this.registerCredentials.username,this.registerCredentials.password).subscribe(usrData =>{
      this.usrData = usrData;
    })

    this.auth.login(this.registerCredentials,this.usrData).subscribe(allowed => {

      if (allowed) {        
       this.navCtrl.push(TabsPage);
      } else {
        console.log("test2",this.usrData);
        this.showError("Access Denied");
      }
    },
      error => {
        this.showError(error);
      });
  }
 
  showError(text) {
    this.loading.dismiss();
 
    let alert = this.alertCtrl.create({
      title: 'Fail',
      subTitle: text,
      buttons: ['OK']
    });
    alert.present(prompt);
  }

}
