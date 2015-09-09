// Load Function
$(document).ready(function(){
	
	showSearchTempleResults($('#searchTemples').val());
	
	$('#searchTemples').keyup(function() {
		showSearchTempleResults(this.value);
	});
	
	$('#searchTemples').bind('input propertychange', function() {
		showSearchTempleResults(this.value);
	});
	
}); // End Document ready

function showSearchTempleResults(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		SearchTempleResults = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		SearchTempleResults = new ActiveXObject("Microsoft.XMLHTTP");
	}
	SearchTempleResults.onreadystatechange = function() {
		if (SearchTempleResults.readyState == 4 && SearchTempleResults.status == 200) {
			document.getElementById("searchResults").innerHTML = SearchTempleResults.responseText;
		}
	}
	SearchTempleResults.open("GET","./searchTemples.php?searchInput="+str,true);
	SearchTempleResults.send();
}
