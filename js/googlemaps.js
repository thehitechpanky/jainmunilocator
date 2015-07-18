	//var markers = [];
	var map = new google.maps.Map(document.getElementById('map-canvas'), {
	zoom: 5,
	center: new google.maps.LatLng(23.2836,79.2318),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  //var defaultBounds = new google.maps.LatLngBounds(
      //new google.maps.LatLng(-33.8902, 151.1759),
      //new google.maps.LatLng(-33.8474, 151.2631));
  //map.fitBounds(defaultBounds);

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
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

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
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

// Slider Menu code
$(function(){
  var menuwidth  = 240; // pixel value for sliding menu width
  var menuspeed  = 400; // milliseconds for sliding menu animation time
  
  var $bdy       = $('body');
  var $container = $('#pgcontainer');
  var $burger    = $('#menu');
  var negwidth   = "-"+menuwidth+"px";
  var poswidth   = menuwidth+"px";
  
  $('.menubtn').on('click',function(e){
    if($bdy.hasClass('openmenu')) {
      jsAnimateMenu('close');
    } else {
      jsAnimateMenu('open');
    }
  });
  
  $('.overlay').on('click', function(e){
    if($bdy.hasClass('openmenu')) {
      jsAnimateMenu('close');
    }
  });
  
  $('a[href$="#"]').on('click', function(e){
    e.preventDefault();
  });
  
  function jsAnimateMenu(tog) {
    if(tog == 'open') {
      $bdy.addClass('openmenu');
      
      $container.animate({marginRight: negwidth, marginLeft: poswidth}, menuspeed);
      $burger.animate({width: poswidth}, menuspeed);
      $('.overlay').animate({left: poswidth}, menuspeed);
    }
    
    if(tog == 'close') {
      $bdy.removeClass('openmenu');
      
      $container.animate({marginRight: "0", marginLeft: "0"}, menuspeed);
      $burger.animate({width: "0"}, menuspeed);
      $('.overlay').animate({left: "0"}, menuspeed);
    }
  }
});


// Insert Delay
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
  clearTimeout (timer);
  timer = setTimeout(callback, ms);
 };
})();


$(document).ready(function(){
	
	var listOption = null;
	
	// If guru's guru is changed
	$('#aguru').change(function()
					  {
						  var index = 0;
						  var val = $('#aguru').val();
						  for(var i = 0; listOption && i < listOption.length; i++) {
							  if(listOption[i].name === val) {
								  $("#aguruHidden").val(listOption[i].id);
								  break;
							  }
						  }
					  });
	
	// This is keyup
	$('#aguru').keyup(function()
					  {delay(function(){
						  $.ajax({url: "./getGuruOptions.php?guruNameInput=" + $('#aguru').val(), success: function(result)
								  	{
									  if(result && result.length)
									  {
											//console.log(result);
											listOption = JSON.parse(result);
											var str = "";
											for(var i = 0 ; listOption && i < listOption.length; i++) {
												str += '<option value="' + listOption[i].name + '" />'; // Storing options in variable
											}
											$("#aguruList").html(str);
									   }
						  			}
							 },2000);
					  		});
						  
						});

	// If Upadhi is changed
	$('#upadhi').change(function() {
		if($('#upadhi').val() == 1) {
			// Show following fields in form
			$('#addacharyadate').attr('type', 'text');
			$('#addacharyaguru').attr('type', 'text');
			$('#addmunidate').attr('type', 'text');
			$('#addmuniguru').attr('type', 'text');
			// Hide following fields from form
			$('#addaryikadate').attr('type', 'hidden');
			$('#addaryikaguru').attr('type', 'hidden');
		} else if($('#upadhi').val() == 4) {
			// Show following fields in form
			$('#addmunidate').attr('type', 'text');
			$('#addmuniguru').attr('type', 'text');
			// Hide following fields from form
			$('#addacharyadate').attr('type', 'hidden');
			$('#addacharyaguru').attr('type', 'hidden');
			$('#addaryikadate').attr('type', 'hidden');
			$('#addaryikaguru').attr('type', 'hidden');
		} else {
			// Show following fields in form
			$('#addaryikadate').attr('type', 'text');
			$('#addaryikaguru').attr('type', 'text');
			// Hide following fields in form
			$('#addacharyadate').attr('type', 'hidden');
			$('#addacharyaguru').attr('type', 'hidden');
			$('#addmunidate').attr('type', 'hidden');
			$('#addmuniguru').attr('type', 'hidden');
		}
	});

}); // End Document ready


// Show Prefix and Suffix based on Upadhi
function showPrefix(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		varprefix = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		varprefix = new ActiveXObject("Microsoft.XMLHTTP");
	}
	varprefix.onreadystatechange = function() {
		if (varprefix.readyState == 4 && varprefix.status == 200) {
			document.getElementById("prefix_here").innerHTML = varprefix.responseText;
		}
	}
	varprefix.open("GET","./getPrefix.php?q="+str,true);
	varprefix.send();
}
function showSuffix(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		varsuffix = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		varsuffix = new ActiveXObject("Microsoft.XMLHTTP");
	}
	varsuffix.onreadystatechange = function() {
		if (varsuffix.readyState == 4 && varsuffix.status == 200) {
			document.getElementById("suffix_here").innerHTML = varsuffix.responseText;
		}
	}
	varsuffix.open("GET","./getSuffix.php?q="+str,true);
	varsuffix.send();
}
