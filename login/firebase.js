firebase.auth().onAuthStateChanged(function(user) {
	if (user) {
		// User is signed in.
		var displayName = user.displayName;
		var email = user.email;
		var emailVerified = user.emailVerified;
		var photoURL = user.photoURL;
		var isAnonymous = user.isAnonymous;
		var uid = user.uid;
		var refreshToken = user.refreshToken;
		var providerData = user.providerData;
		console.log(displayName);
		$('.editoremail').val(email);
	} else {
		// No user is signed in.
		var provider = new firebase.auth.GoogleAuthProvider();
		firebase.auth().signInWithPopup(provider).then(function(result) {
			// This gives you a Google Access Token. You can use it to access the Google API.
			var token = result.credential.accessToken;
			// The signed-in user info.
			var user = result.user;
			// ...
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", "login/updateLogin.php?email=" + user.email + "&username=" + user.displayName + "&userimg=" + user.photoURL + "&mode=web", true);
				xmlhttp.send();
				return false;
			}
		}).catch(function(error) {
			// Handle Errors here.
			var errorCode = error.code;
			var errorMessage = error.message;
			// The email of the user's account used.
			var email = error.email;
			// The firebase.auth.AuthCredential type that was used.
			var credential = error.credential;
			// ...
		});
	}
});

function userStatus() {
	var user = firebase.auth().currentUser;
	if(user){return 'user';}else{return 'guest';}
}
function userEmail() {
	var user = firebase.auth().currentUser;
	if(user){return user.email;}
}
