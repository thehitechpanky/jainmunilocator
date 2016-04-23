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
	if($('#upadhi').val() == 7) {$('#aryika').attr('class', '');} else {$('#aryika').attr('class', 'hidden');}	
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
		if($('#upadhi').val() == 7) {$('#aryika').attr('class', '');} else {$('#aryika').attr('class', 'hidden');}	
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
var autoCompleteLocation = new google.maps.places.Autocomplete(document.getElementById('location'));
var autoCompleteSamadhiPlace = new google.maps.places.Autocomplete(document.getElementById('samadhiplace'));
var autoCompleteAPlace = new google.maps.places.Autocomplete(document.getElementById('aplace'));
var autoCompleteAilacharyaPlace = new google.maps.places.Autocomplete(document.getElementById('ailacharyaplace'));
var autoCompleteUpadhyayPlace = new google.maps.places.Autocomplete(document.getElementById('upadhyayplace'));
var autoCompleteMuniPlace = new google.maps.places.Autocomplete(document.getElementById('muniplace'));
var autoCompleteAilakPlace = new google.maps.places.Autocomplete(document.getElementById('ailakplace'));
var autoCompleteKPlace = new google.maps.places.Autocomplete(document.getElementById('kplace'));
var autoCompleteAryikaPlace = new google.maps.places.Autocomplete(document.getElementById('aryikaplace'));
var autoCompleteKshullikaPlace = new google.maps.places.Autocomplete(document.getElementById('kshullikaplace'));
var autoCompleteBhramcharyaPlace = new google.maps.places.Autocomplete(document.getElementById('bhramcharyaplace'));
var autoCompleteBirthPlace = new google.maps.places.Autocomplete(document.getElementById('birthplace'));

function initialize() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
function initialize2() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace2'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat2').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng2').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize2);
function initialize3() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace3'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat3').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng3').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize3);
function initialize4() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace4'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat4').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng4').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize4);
function initialize5() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace5'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat5').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng5').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize5);
function initialize6() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace6'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat6').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng6').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize6);
function initialize7() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace7'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat7').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng7').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize7);
function initialize8() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace8'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat8').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng8').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize8);
function initialize9() {
	var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace9'));
	google.maps.event.addListener(autoCompleteChaturmasPlace, 'place_changed', function () {
		var place = autoCompleteChaturmasPlace.getPlace();
		document.getElementById('chaturmaslat9').value = place.geometry.location.lat();
		document.getElementById('chaturmaslng9').value = place.geometry.location.lng();
	});
}
google.maps.event.addDomListener(window, 'load', initialize9);
