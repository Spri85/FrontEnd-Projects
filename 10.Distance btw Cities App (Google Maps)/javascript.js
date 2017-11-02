 //set map options
 var myLatLng = {
   lat: 50.3485083,
   lng: 28.4710329
 };
 var mapOptions = {
   center: myLatLng,
   zoom: 7,
   mapTyoeId: google.maps.MapTypeId.ROADMAP
 };

 //create map
 var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

 //create a Direction service object to use the route method and get a result for our request
 var directionService = new google.maps.DirectionsService();

 //Create a DirectionsRenderer object which we will use to display the route
 var directionsDisolay = new google.maps.DirectionsRenderer();

 //bind the directionsRenderer to the map
 directionsDisolay.setMap(map);

 //define calcRoute function
 function calcRoute() {
   //definitions
   let from = document.getElementById("from").value;
   let to = document.getElementById("to").value
   //create request

   var request = {
     origin: from,
     destination: to,
     travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
     unitSystem: google.maps.UnitSystem.METRIC
   }

   //pass the request to the route method
   directionService.route(request, function (result, status) {
     if (status == google.maps.DirectionsStatus.OK) {
       
       //Get distance & time
       $("#output").html(`<div class='alert-info'>From: ${from}.<br>To: ${to}.<br> Driving distrance: ${result.routes[0].legs[0].distance.text}.<br>Duration: ${result.routes[0].legs[0].duration.text}.</div>`);

       //display route
       directionsDisolay.setDirections(result);
     } else {
       
       //delete route from map
       directionsDisplay.setDirections({
         routes: []
       
       });
       //center map in Ukraine
       map.setCenter(myLatLng);

       //show error message
       $("output").html(`<div class="alert alert-danger">Could not retrieve driving distance.</div>`)
     }
   });


 }


 //create autocomplete objects for all inputs
 var options = {
   types: ['(cities)']
 }
 var autocomplete1 = new google.maps.places.Autocomplete(from, options);
 autocomplete1.addListener('place_changed', onPlaceChanged);

 var autocomplete2 = new google.maps.places.Autocomplete(to, options);
 autocomplete2.addListener('place_changed', onPlaceChanged);

 function onPlaceChanged() {
   var place = autocomplete.getPlace();
   map.panTo(place.geometry.location);
 }
