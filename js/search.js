// Load Function
$(document).ready(function(){
	
	showSearchMuniResults($('#searchBoxMuni').val());
	
	$('#searchBoxMuni').keyup(function() {
		showSearchMuniResults(this.value);
	});
	
	$('#searchBoxMuni').bind('input propertychange', function() {
		showSearchMuniResults(this.value);
	});
	
	showSearchIdolResults($('#searchIdol').val());
	
	$('#searchIdol').keyup(function() {
		showSearchIdolResults(this.value);
	});
	
	$('#searchIdol').bind('input propertychange', function() {
		showSearchIdolResults(this.value);
	});
	
	showSearchNoLocationResults($('#searchBoxNoLocation').val());
	
	$('#searchBoxNoLocation').keyup(function() {
		showSearchNoLocationResults(this.value);
	});
	
	$('#searchBoxNoLocation').bind('input propertychange', function() {
		showSearchNoLocationResults(this.value);
	});
	
	showSearchNoImageResults($('#searchBoxNoImg').val());
	
	$('#searchBoxNoImg').keyup(function() {
		showSearchNoImageResults(this.value);
	});
	
	$('#searchBoxNoImg').bind('input propertychange', function() {
		showSearchNoImageResults(this.value);
	});
	
}); // End Document ready


function showSearchNoImageResults(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		SearchNoImageResults = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		SearchNoImageResults = new ActiveXObject("Microsoft.XMLHTTP");
	}
	SearchNoImageResults.onreadystatechange = function() {
		if (SearchNoImageResults.readyState == 4 && SearchNoImageResults.status == 200) {
			document.getElementById("searchResults").innerHTML = SearchNoImageResults.responseText;
		}
	}
	SearchNoImageResults.open("GET","./searchNoImage.php?guruNameInput="+str,true);
	SearchNoImageResults.send();
}

function showSearchNoLocationResults(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		SearchNoLocationResults = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		SearchNoLocationResults = new ActiveXObject("Microsoft.XMLHTTP");
	}
	SearchNoLocationResults.onreadystatechange = function() {
		if (SearchNoLocationResults.readyState == 4 && SearchNoLocationResults.status == 200) {
			document.getElementById("searchResults").innerHTML = SearchNoLocationResults.responseText;
		}
	}
	SearchNoLocationResults.open("GET","./searchNoLocation.php?guruNameInput="+str,true);
	SearchNoLocationResults.send();
}

function showSearchMuniResults(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		SearchMuniResults = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		SearchMuniResults = new ActiveXObject("Microsoft.XMLHTTP");
	}
	SearchMuniResults.onreadystatechange = function() {
		if (SearchMuniResults.readyState == 4 && SearchMuniResults.status == 200) {
			document.getElementById("searchResults").innerHTML = SearchMuniResults.responseText;
		}
	}
	SearchMuniResults.open("GET","./searchMuni.php?guruNameInput="+str,true);
	SearchMuniResults.send();
}
