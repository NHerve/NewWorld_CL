import { Component, ViewChild, ElementRef } from '@angular/core';
import { IonicPage } from 'ionic-angular';
import { NavController } from 'ionic-angular';

//import { ModelVisite } from '../../models/ModelVisite';
import { ControleurVisite } from '../../providers/controleur-visite/controleur-visite';

declare var google;

@IonicPage()
@Component(
{
	selector: 'page-carte',
	templateUrl: 'carte.html'
})
export class CartePage 
{

	@ViewChild('map') mapElement: ElementRef;
	map: any;
	start = 'gap, france';
	end = 'gap, france';
	directionsService = new google.maps.DirectionsService;
	directionsDisplay = new google.maps.DirectionsRenderer;

	constructor(public navCtrl: NavController, private controleurVisite : ControleurVisite) 
	{
		controleurVisite.load().subscribe(waypts => {
			this.waypts = waypts;
			this.calculateAndDisplayRoute();
			});
	}

	ionViewDidLoad()
	{
	   	this.initMap();
	}

	initMap() 
	{
	   	this.map = new google.maps.Map(this.mapElement.nativeElement, 
	   	{
	    	zoom: 11,
	     	center: {lat: 44.556, lng: 6.079}
	    });
	    this.directionsDisplay.setMap(this.map);

	}
	//tableau des points de passage
  	waypts = [];

	calculateAndDisplayRoute() 
	{
	    this.directionsService.route(
	    {
	    	origin: this.start,
	    	destination: this.end,
	    	waypoints: this.waypts,
      		optimizeWaypoints: true,
	    	travelMode: 'DRIVING',
	    	drivingOptions: {departureTime: new Date(Date.now() + 1000*60*60),trafficModel: 'optimistic'}
	    }, (response, status) => 
	    {
	    	if (status === 'OK') 	
	    	{
	        	this.directionsDisplay.setDirections(response);
	      	} 
	      	else 
	      	{
	      		window.alert('Directions request failed due to ' + status);
	      	}
	    });
	 }
}
