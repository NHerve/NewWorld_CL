import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
 
import { ModelConnexion } from '../../models/ModelConnexion';

export class User {
  id: string;
  nom: string;
  prenom:string;
  email: string;
  username:string;
  password:string;
 
  constructor(nom: string, prenom:string, email: string, id: string, username: string, password: string) {
    this.nom = nom;
    this.prenom = prenom;
    this.email = email;
    this.id = id;
    this.username = username;
    this.password = password;
  }
}
 
@Injectable()
export class AuthService {
  
  jsonApiUrl = 'http://172.29.56.2/~haymes/NewWorld/appliMobileNW/newWorld/php/connexion.php';

  currentUser: User;

  constructor(public http: Http) {
    console.log('Hello VisiteServiceProvider Provider 2');
  }
 
  public login(credentials,usrData) {
      if (credentials.username === null || credentials.password === null) {
      return Observable.throw("Please insert credentials");
    } else {
      return Observable.create(observer => {
        console.log("login",usrData);
        var nom="bonjour"; //a compléter;
        var prenom="bonjour"; //a compléter;
        var email="bonjour"; //a compléter;
        var id="bonjour"; //a compléter;
        var username="jdupont";
        var password="123456789";

        this.currentUser = new User(nom, prenom, email, id, username, password);

        let access = (credentials.username === username && credentials.password === password);

        observer.next(access);
        observer.complete();
      });
    }
  }
 
  public getUserInfo() : User {
    return this.currentUser;
  }
 
  public logout() {
    return Observable.create(observer => {
      this.currentUser = null;
      observer.next(true);
      observer.complete();
    });
  }

  load(usr,passwd): Observable<ModelConnexion[]>{
    return this.http.get(`${this.jsonApiUrl}?username=${usr}&password=${passwd}`).map(res => <ModelConnexion[]>res.json());

   
  }
}



