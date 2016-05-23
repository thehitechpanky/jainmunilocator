var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 23.2836, lng: 79.2318},
		zoom: 6,
		mapTypeControl: false
	});
	
	//Marker and their infowindow Code Starts for locating munis
	var locations;
	$.ajax({url: 'map/munimarkers.php', success: function(result) {
		locations = JSON.parse(result);
	}});
	var munimarker, i, content;
	var infowindow = new google.maps.InfoWindow();
	var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/info.png';
	
	setTimeout(function() { 
		for (i = 0; i < locations.length; i++) {
			//Markers
			munimarker = new google.maps.Marker({
				position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
				map: map,
			});
			//Infowindow
			google.maps.event.addListener(munimarker, 'click', (function(munimarker, i) {
				return function() {
					var uname = locations[i]['uname'];
					var name = locations[i]['name'];
					var img = uname + '_' + name;
					var img = img.toLowerCase();
					img = img.replace(/\s/g, "");
					img = 'munis/uploads/' + img + '.jpg';
					content = '<a href="munis.php?id=' + locations[i]['id'] + '"><center><img width="200px" src="' + img;
					content += '" onError="this.onerror=null;this.src=';
					content += '&#39;na.png&#39;;" /><p>' + locations[i]['uname'] + ' ' + locations[i]['prefix'] + ' ';
					content += name + ' ' + locations[i]['suffix'] + '</p><p>';
					content += locations[i]['location'] + '</p></center></a>';
					infowindow.setContent(content);
					infowindow.open(map, munimarker);
				}
			})(munimarker, i));
		}
	}, 1000);
	
	//Usermarkers and their infowindows
	var usermarker;
	var userlocations;
	$.ajax({url: 'map/usermarkers.php', success: function(result) {
		userlocations = JSON.parse(result);
	}});
	var usericon = 'http://maps.google.com/mapfiles/ms/icons/blue-pushpin.png';
	setTimeout(function() { 
		var email = $('#editoremail').val();
		if (email.length === 0) {} else {
			for (i = 0; i < userlocations.length; i++) {
				//Markers
				usermarker = new google.maps.Marker({
					position: new google.maps.LatLng(userlocations[i]['userlat'], userlocations[i]['userlng']),
					map: map,
					icon: usericon
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
		}
	}, 2000);
	
	// Temple markers and their infowindows
	var templemarker;
	var templelocation;
	$.ajax({url: 'map/templemarkers.php', success: function(result) {
		templelocation = JSON.parse(result);
	}});
	var templeicon = 'http://maps.google.com/mapfiles/kml/pal3/icon31.png';
	setTimeout(function() { 
		for (i = 0; i < templelocation.length; i++) {
			//Markers
			templemarker = new google.maps.Marker({
				position: new google.maps.LatLng(templelocation[i]['tlat'], templelocation[i]['tlng']),
				map: map,
				icon: templeicon
			});
			//User Infowindow
			google.maps.event.addListener(templemarker, 'click', (function(templemarker, i) {
				return function() {
					var img = 'temples/uploads/' + templelocation[i]['tid'] + '.jpg';
					content = '<center><img src="' + img;
					content += '" /><p>' + templelocation[i]['tname'] + '</p></center>';
					infowindow.setContent(content);
					infowindow.open(map, templemarker);
				}
			})(templemarker, i));
		}
	}, 1000);
	
	// Create the search box and link it to the UI element.
	var input = document.getElementById('pac-input');
	var searchBox = new google.maps.places.SearchBox(input);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	
	// Bias the SearchBox results towards current map's viewport.
	map.addListener('bounds_changed', function() {
		searchBox.setBounds(map.getBounds());
	});
	
	var markers = [];
	// Listen for the event fired when the user selects a prediction and retrieve
	// more details for that place.
	searchBox.addListener('places_changed', function() {
		var places = searchBox.getPlaces();
		
		if (places.length == 0) {
			return;
		}
		
		// Clear out the old markers.
		markers.forEach(function(marker) {
			marker.setMap(null);
		});
		markers = [];
		
		// For each place, get the icon, name and location.
		var bounds = new google.maps.LatLngBounds();
		places.forEach(function(place) {
			var icon = {
				url: place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(25, 25)
			};
			
			// Create a marker for each place.
			markers.push(new google.maps.Marker({
				map: map,
				icon: icon,
				title: place.name,
				position: place.geometry.location
			}));
			
			if (place.geometry.viewport) {
				// Only geocodes have viewport.
				bounds.union(place.geometry.viewport);
			} else {
				bounds.extend(place.geometry.location);
			}
		});
		map.fitBounds(bounds);
	});
	
}
