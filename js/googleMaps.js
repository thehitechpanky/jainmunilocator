//var markers = [];

var mapOptions = {
	zoom: 6,
	center: new google.maps.LatLng(23.2836,79.2318),
	//panControl: false,
	//zoomControl: false,
	mapTypeControl: false,
	//scaleControl: false,
	streetViewControl: false,
	//overviewMapControl: false
}

var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

// Create the search box and link it to the UI element.
var input = /** @type {HTMLInputElement} */(
	document.getElementById('pac-input'));
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

var searchBox = new google.maps.places.SearchBox(
	/** @type {HTMLInputElement} */(input));

// [START region_getplaces]
// Listen for the event fired when the user selects an item from the pick list. Retrieve the matching places for that item.
google.maps.event.addListener(searchBox, 'places_changed', function() {
	var places = searchBox.getPlaces();
	
	if (places.length == 0) {
		return;
	}
	//for (var i = 0, marker2; marker2 = markers[i]; i++) {
	//marker2.setMap(null);
	//}
	
	// For each place, get the icon, place name, and location.
	markers = [];
	var bounds = new google.maps.LatLngBounds();
	for (var i = 0, place; place = places[i]; i++) {
		var image = {
			url: place.icon,
			size: new google.maps.Size(71, 71),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(17, 34),
			scaledSize: new google.maps.Size(25, 25)
		};
		
		// Create a marker for each place.
		var marker2 = new google.maps.Marker({
			map: map,
			icon: image,
			title: place.name,
			position: place.geometry.location
		});
		
		markers.push(marker2);
		
		bounds.extend(place.geometry.location);
	}
	
	map.fitBounds(bounds);
});
// [END region_getplaces]

// Bias the SearchBox results towards places that are within the bounds of the current map's viewport.
google.maps.event.addListener(map, 'bounds_changed', function() {
	var bounds = map.getBounds();
	searchBox.setBounds(bounds);
});


var infowindow = new google.maps.InfoWindow();
var marker, i;
//Populate Markers and their respective infowindows
for (i = 0; i < locations.length; i++) {
	marker = new google.maps.Marker({
		position: new google.maps.LatLng(locations[i][1], locations[i][2]),
		map: map
	});
	
	google.maps.event.addListener(marker, 'click', (function(marker, i) {
		return function() {
			infowindow.setContent(locations[i][0]);
			infowindow.open(map, marker);
		}
	})(marker, i));
}

//Usermarkers and their infowindows
var usermarker;
var userlocations = JSON.parse($("#userlocations").val());
var image = 'http://maps.google.com/mapfiles/ms/icons/blue-pushpin.png';
for (i = 0; i < userlocations.length; i++) {
	//Markers
	usermarker = new google.maps.Marker({
		position: new google.maps.LatLng(userlocations[i]['userlat'], userlocations[i]['userlng']),
		map: map,
		icon: image
	});
	//User Infowindow
	google.maps.event.addListener(usermarker, 'click', (function(usermarker, i) {
		return function() {
			content = '<center><img src="' + userlocations[i]['userimg'];
			content += '" /><p>' + userlocations[i]['username'] + '</p></center>';
			infowindow.setContent(content);
			infowindow.open(map, usermarker);
		}
	})(usermarker, i));
}
