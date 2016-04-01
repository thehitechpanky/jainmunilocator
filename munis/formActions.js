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
	$('#aguru').keyup(function() {
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
}, 5000);

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
var autoCompleteChaturmasPlace = new google.maps.places.Autocomplete(document.getElementById('chaturmasplace'));
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
