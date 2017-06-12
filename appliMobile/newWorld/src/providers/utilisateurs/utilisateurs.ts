import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { Observable } from 'rxjs/Rx';
import 'rxjs/add/operator/map';

import { ModelUtilisateurs } from '../../models/ModelUtilisateurs';

/*
  Generated class for the UtilisateursProvider provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/

@Injectable()
export class Utilisateurs {

  jsonApiUrl = 'http://172.29.56.2/~haymes/NewWorld/appliMobileNW/newWorld/php/utilisateurVisiteJson.php';

  constructor(public http: Http) {  }

  load(): Observable<ModelUtilisateurs[]>
  {
 		return this.http.get(`${this.jsonApiUrl}`).map(res => <ModelUtilisateurs[]>res.json());

 	}

}
