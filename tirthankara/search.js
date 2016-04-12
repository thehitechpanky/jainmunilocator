// Load Function
$(document).ready(function(){
	
	setTimeout(function() {
		showSearchResults($('#search').val());
	}, 1000);
	
	$('#search').keyup(function() {
		showSearchResults(this.value);
	});
	
	$('#search').bind('input propertychange', function() {
		showSearchResults(this.value);
	});
	
}); // End Document ready

function showSearchResults(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("searchResults").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","tirthankara/search.php?input=" + str,true);
	xmlhttp.send();
	//	return false;
}
