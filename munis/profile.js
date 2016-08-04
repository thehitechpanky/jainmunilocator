$(document).ready(function(){
	(function(){
		$('a#asetloc').click(function(){
			document.getElementById('setloc').show();
			return false;
		});
		$('a#asetcontact').click(function(){
			document.getElementById('setcontact').show();
			return false;
		});
		$('a#asetacharya').click(function(){
			document.getElementById('setacharya').show();
			return false;
		});
		$('a#asetmuni').click(function(){
			document.getElementById('setmuni').show();
			return false;
		});
		$('a#asethistory').click(function(){
			document.getElementById('sethistory').show();
			return false;
		});
	})();//close function
});//close document ready

google.maps.event.addDomListener(window,'load',function(){
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'));
	google.maps.event.addListener(autocomplete,'place_changed',function(){
		var place = this.getPlace();
		$('#lat').val(place.geometry.location.lat());
		$('#lng').val(place.geometry.location.lng());
		var locality = extractFromAddress(place.address_components,'locality');
		$('#locality').val(locality);
	});
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('acharyaplace'));
	google.maps.event.addListener(autocomplete,'place_changed',function(){
		var place = this.getPlace();
		$('#acharyalat').val(place.geometry.location.lat());
		$('#acharyalng').val(place.geometry.location.lng());
	});
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('muniplace'));
	google.maps.event.addListener(autocomplete,'place_changed',function(){
		var place = this.getPlace();
		$('#munilat').val(place.geometry.location.lat());
		$('#munilng').val(place.geometry.location.lng());
	});
	var autocomplete = new google.maps.places.Autocomplete(document.getElementById('birthplace'));
	google.maps.event.addListener(autocomplete,'place_changed',function(){
		var place = this.getPlace();
		$('#birthlat').val(place.geometry.location.lat());
		$('#birthlng').val(place.geometry.location.lng());
	});
});

function extractFromAddress(components,type){
	for(var i=0; i<components.length; i++)
		for(var j=0; j<components[i].types.length; j++)
			if(components[i].types[j]==type) return components[i].long_name;
	return '';
}
