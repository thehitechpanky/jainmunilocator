// Load Function
$(document).ready(function(){
	
	showSearchIdolResults($('#searchIdols').val());
	
	$('#searchIdols').keyup(function() {
		showSearchIdolResults(this.value);
	});
	
	$('#searchIdols').bind('input propertychange', function() {
		showSearchIdolResults(this.value);
	});
	
}); // End Document ready

function showSearchIdolResults(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		SearchIdolResults = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		SearchIdolResults = new ActiveXObject("Microsoft.XMLHTTP");
	}
	SearchIdolResults.onreadystatechange = function() {
		if (SearchIdolResults.readyState == 4 && SearchIdolResults.status == 200) {
			document.getElementById("searchResults").innerHTML = SearchIdolResults.responseText;
		}
	}
	SearchIdolResults.open("GET","./searchIdols.php?searchInput="+str,true);
	SearchIdolResults.send();
}
