// Load Function
$(document).ready(function(){
	
	// Load Form based on upadhi selection
	showPrefix($('#upadhi').val());
	showSuffix($('#upadhi').val());
	if($('#upadhi').val() == 1) {$('#acharya').attr('class', '');} else {$('#acharya').attr('class', 'hidden');}
	if($('#upadhi').val() < 3) {$('#ailacharya').attr('class', '');} else {$('#ailacharya').attr('class', 'hidden');}
	if($('#upadhi').val() < 4) {$('#upadhyay').attr('class', '');} else {$('#upadhyay').attr('class', 'hidden');}
	if($('#upadhi').val() < 5) {$('#muni').attr('class', '');} else {$('#muni').attr('class', 'hidden');}
	if($('#upadhi').val() < 6) {$('#ailak').attr('class', '');} else {$('#ailak').attr('class', 'hidden');}
	if($('#upadhi').val() < 7) {$('#kshullak').attr('class', '');} else {$('#kshullak').attr('class', 'hidden');}
	if($('#upadhi').val() == 7) {$('#ganini').attr('class', '');} else {$('#ganini').attr('class', 'hidden');}	
	if($('#upadhi').val() > 6) {$('#aryika').attr('class', '');} else {$('#aryika').attr('class', 'hidden');}	
	if($('#upadhi').val() > 6) {$('#kshullika').attr('class', '');} else {$('#kshullika').attr('class', 'hidden');}
	
	// If Upadhi is changed
	$('#upadhi').change(function() {
		showPrefix(this.value);
		showSuffix(this.value);
		if($('#upadhi').val() == 1) {$('#acharya').attr('class', '');} else {$('#acharya').attr('class', 'hidden');}
		if($('#upadhi').val() < 3) {$('#ailacharya').attr('class', '');} else {$('#ailacharya').attr('class', 'hidden');}
		if($('#upadhi').val() < 4) {$('#upadhyay').attr('class', '');} else {$('#upadhyay').attr('class', 'hidden');}
		if($('#upadhi').val() < 5) {$('#muni').attr('class', '');} else {$('#muni').attr('class', 'hidden');}
		if($('#upadhi').val() < 6) {$('#ailak').attr('class', '');} else {$('#ailak').attr('class', 'hidden');}
		if($('#upadhi').val() < 7) {$('#kshullak').attr('class', '');} else {$('#kshullak').attr('class', 'hidden');}
		if($('#upadhi').val() == 7) {$('#ganini').attr('class', '');} else {$('#ganini').attr('class', 'hidden');}	
		if($('#upadhi').val() > 6) {$('#aryika').attr('class', '');} else {$('#aryika').attr('class', 'hidden');}	
		if($('#upadhi').val() > 6) {$('#kshullika').attr('class', '');} else {$('#kshullika').attr('class', 'hidden');}
	});
	
	var listOption = null;
	
	// If guru's guru is changed
	$('#aguru').change(function() {
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
	$('#aguru').on('change keydown paste input', function() {
		delay(function(){
			$.ajax({url: "getGuruOptions.php?term=" + $('#aguru').val(), success: function(result) {
					if(result && result.length) {
					console.log(result);
					listOption = JSON.parse(result);
					var str="";
					for(var i = 0 ; listOption && i < listOption.length; i++) {
					str += '<option value="' + listOption[i].name + '"/>'; // Storing options in variable
				   } //end for
				   //alert(str)
				   $("#aguruList").html(str);
		} //end if
			  } // end result function
			  },2000); //end AJAX
	}); // end delay
	
}); //end aguru keyup

// Insert Delay for guru options
var delay = (function(){
	var timer = 0;
	return function(callback, ms){
		clearTimeout (timer);
		timer = setTimeout(callback, ms);
	};
})();

setTimeout(function() {
	var email = $('#editoremail').val();
	if (email.length === 0) {
		alert('You need to login to gain access to editing.');
	}
}, 6100);

(function() {  
	var dialog = document.getElementById('uploadbox');  
	$('.camera').click(function() {
		dialog.show();  
	});  
	document.getElementById('closeupload').onclick = function() {  
		dialog.close();  
	};  
})();

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
	varprefix.open("GET","getPrefix.php?q="+str,true);
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
	varsuffix.open("GET","getSuffix.php?q="+str,true);
	varsuffix.send();
}


// Autocomplete for places
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#locationlat').val(place.geometry.location.lat());
		$('#locationlng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('samadhiplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#samadhilat').val(place.geometry.location.lat());
		$('#samadhilng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('aplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#alat').val(place.geometry.location.lat());
		$('#alng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('ailacharyaplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#ailacharyalat').val(place.geometry.location.lat());
		$('#ailacharyalng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('upadhyayplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#upadhyaylat').val(place.geometry.location.lat());
		$('#upadhyaylng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('muniplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#munilat').val(place.geometry.location.lat());
		$('#munilng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('ailakplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#ailaklat').val(place.geometry.location.lat());
		$('#ailaklng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('kplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#klat').val(place.geometry.location.lat());
		$('#klng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('ganiniplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#ganinilat').val(place.geometry.location.lat());
		$('#ganinilng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('aryikaplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#aryikalat').val(place.geometry.location.lat());
		$('#aryikalng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('kshullikaplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#kshullikalat').val(place.geometry.location.lat());
		$('#kshullikalng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('bhramcharyaplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#bhramcharyalat').val(place.geometry.location.lat());
		$('#bhramcharyalng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('birthplace'));
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		var place = autocomplete.getPlace();
		$('#birthlat').val(place.geometry.location.lat());
		$('#birthlng').val(place.geometry.location.lng());
	});
});
google.maps.event.addDomListener(window, 'load', function () {
	var cPlace1 = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace'));
	google.maps.event.addListener(cPlace1, 'place_changed', function () {
		var place = cPlace1.getPlace();
		$('#chaturmaslat').val(place.geometry.location.lat());
		$('#chaturmaslng').val(place.geometry.location.lng());
	});
});
for (var i = 1; i < 100; i++) {
	window['cPlace' + i] = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace' + i));
	google.maps.event.addListener(window['cPlace' + i], 'place_changed', function () {
		var place = window['cPlace' + i].getPlace();
		$('#chaturmaslat' + i).val(place.geometry.location.lat());
		$('#chaturmaslng' + i).val(place.geometry.location.lng());
	});
}
