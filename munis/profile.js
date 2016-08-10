$(document).ready(function(){
	showPrefix($('#upadhi').val());
	showSuffix($('#upadhi').val());
	$('#upadhi').on('change', function() {
		showPrefix(this.value);
		showSuffix(this.value);
	});
	(function(){
		showeditor('name');
		showeditor('image');
		showeditor('loc');
		showeditor('contact');
		showeditor('acharya');
		showeditor('muni');
		showeditor('kshullak');
		showeditor('ganini');
		showeditor('aryika');
		//showeditor('kshullika);
		showeditor('history');
		$('a#asetimage2').click(function(){
			if(userStatus()==='user'){
				$('#imageeditor').val(userEmail());
				document.getElementById('setimage').show();
				return false;
			}else{
				alert('Please login to edit');
			}
		});
	})();//close function
});//close document ready

function showeditor(pad){
	$('a#aset'+pad).click(function(){
		if(userStatus()==='user'){
			console.log(userEmail());
			$('#'+pad+'editor').val(userEmail());
			document.getElementById('set'+pad).show();
			return false;
		}else{
			alert('Please login to edit');
		}
	});
}

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
			document.getElementById("prefix").innerHTML = varprefix.responseText;
		}
	}
	varprefix.open("GET","munis/getPrefix.php?q="+str,true);
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
			document.getElementById("suffix").innerHTML = varsuffix.responseText;
		}
	}
	varsuffix.open("GET","munis/getSuffix.php?q="+str,true);
	varsuffix.send();
}

google.maps.event.addDomListener(window,'load',function(){
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'));
	google.maps.event.addListener(autocomplete,'place_changed',function(){
		var place = this.getPlace();
		$('#lat').val(place.geometry.location.lat());
		$('#lng').val(place.geometry.location.lng());
		var locality = extractFromAddress(place.address_components,'locality');
		$('#locality').val(locality);
	});
	getLatLng('acharyaplace','#acharyalat','#acharyalng');
	getLatLng('muniplace','#munilat','#munilng');
	getLatLng('kshullakplace','#kshullaklat','#kshullaklng');
	getLatLng('birthplace','#birthlat','#birthlng');
});

function getLatLng(input,lat,lng){
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById(input));
	google.maps.event.addListener(autocomplete,'place_changed',function(){
		var place = this.getPlace();
		$(lat).val(place.geometry.location.lat());
		$(lng).val(place.geometry.location.lng());
	});
}

function extractFromAddress(components,type){
	for(var i=0; i<components.length; i++)
		for(var j=0; j<components[i].types.length; j++)
			if(components[i].types[j]==type) return components[i].long_name;
	return '';
}
