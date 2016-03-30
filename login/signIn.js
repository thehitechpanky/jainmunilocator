$('#edit').attr('class', 'hidden');
$('#content').attr('class', 'hidden');
$('#save').attr('class', 'hidden');
$('#reset').attr('class', 'hidden');
$('#cancel').attr('class', 'hidden');

navigator.geolocation.getCurrentPosition(function(position) {
	userlat = position.coords.latitude;
	userlng = position.coords.longitude;
});

$(document).ready(function(){
	setTimeout(function() { 
		//alert(userlat);
	}, 2000);
});

function onSignIn(googleUser) {
	// Useful data for your client-side scripts:
	var profile = googleUser.getBasicProfile();
	// The ID token you need to pass to your backend:
	var id_token = googleUser.getAuthResponse().id_token;
	var username = profile.getName();
	var email = profile.getEmail();
	$('#editoremail').val(email);
	var userimg = profile.getImageUrl();
	
	if (email === 'capankajjain@smilyo.com' || email === 'cloudjain@gmail.com' || email === 'djtarun550@gmail.com') {
		$('#edit').removeClass('hidden');
		$('#content').removeClass('hidden');
		$('#save').removeClass('hidden');
		$('#reset').removeClass('hidden');
		$('#cancel').removeClass('hidden');
		$('#author').val(username);		
	} else {
		$('#edit').attr('class', 'hidden');
		$('#content').attr('class', 'hidden');
		$('#save').attr('class', 'hidden');
		$('#reset').attr('class', 'hidden');
		$('#cancel').attr('class', 'hidden');
	}
	
	if (email.length === 0) {
		var message = 'Welcome to Jain Muni Locator!\nPlease sign-in using the button on top right of your screen to know updated locations of Muni-shri via email.';
		alert(message);
	}
	
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", "login/updateLogin.php?email=" + email + "&username=" + username + "&userimg=" + userimg, true);
		xmlhttp.send();
		setTimeout(function() { 
			xmlhttp2 = new XMLHttpRequest();
			xmlhttp2.open("GET", "../updateLocation.php?email=" + email + "&username=" + username + "&userimg=" + userimg + "&userlat=" + userlat + "&userlng=" + userlng, true);
			xmlhttp2.send();
		}, 2000);
		return false;
	}
};
