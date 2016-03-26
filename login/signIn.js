var message = 'Welcome to Jain Muni Locator!\nPlease sign-in using the button on top right of your screen to know updated locations of Muni-shri.';
//alert(message);
$('#edit').attr('class', 'hidden');
$('#content').attr('class', 'hidden');
$('#save').attr('class', 'hidden');
$('#reset').attr('class', 'hidden');
$('#cancel').attr('class', 'hidden');

navigator.geolocation.getCurrentPosition(function(position) {
	userlat = position.coords.latitude;
	userlng = position.coords.longitude;
});

function onSignIn(googleUser) {
	// Useful data for your client-side scripts:
	var profile = googleUser.getBasicProfile();
	// The ID token you need to pass to your backend:
	var id_token = googleUser.getAuthResponse().id_token;
	var username = profile.getName();
	email = profile.getEmail();	
	var userimg = profile.getImageUrl();
	if (email === 'capankajjain@smilyo.com' || email === 'cloudjain@gmail.com' || email === 'djtarun550@gmail.com') {
		$('#edit').removeClass('hidden');
		$('#content').removeClass('hidden');
		$('#save').removeClass('hidden');
		$('#reset').removeClass('hidden');
		$('#cancel').removeClass('hidden');
		$('#author').val(username);		
	} else {
		//alert('email');
		$('#edit').attr('class', 'hidden');
		$('#content').attr('class', 'hidden');
		$('#save').attr('class', 'hidden');
		$('#reset').attr('class', 'hidden');
		$('#cancel').attr('class', 'hidden');
	}
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", "login/updateLogin.php?email=" + email + "&username=" + username + "&userimg=" + userimg, true);
		xmlhttp.send();
		xmlhttp2 = new XMLHttpRequest();
		xmlhttp2.open("GET", "../updateLocation.php?email=" + email + "&username=" + username + "&userimg=" + userimg + "&userlat=" + userlat + "&userlng=" + userlng, true);
		xmlhttp2.send();
		return false;
	}
};
