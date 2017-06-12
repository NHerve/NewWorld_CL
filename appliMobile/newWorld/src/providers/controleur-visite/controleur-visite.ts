import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import { Observable } from 'rxjs/Rx';
import 'rxjs/add/operator/map';

import { ModelVisite } from '../../models/ModelVisite';

/*
  Generated class for the ControleurVisiteProvider provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/

@Injectable()
export class ControleurVisite {

	jsonApiUrl = 'http://172.29.56.2/~haymes/NewWorld/appliMobileNW/newWorld/php/visiteJson.php';

  constructor(public http: Http) {  }
  	
 	load(): Observable<ModelVisite[]>
  {
 		return this.http.get(`${this.jsonApiUrl}?idControleur='controleur'`).map(res => <ModelVisite[]>res.json());

 	}
}
