// Insert Delay
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
  clearTimeout (timer);
  timer = setTimeout(callback, ms);
 };
})();

$(document).ready(function(){
	
	var listOption = null;
	
	// If guru's guru is changed
	$('#aguru').change(function()
					  {
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
	$('#aguru').keyup(function()
					  {delay(function(){
						  $.ajax({url: "./getGuruOptions.php?guruNameInput=" + $('#aguru').val(), success: function(result)
								  	{
									  if(result && result.length)
									  {
											//console.log(result);
											listOption = JSON.parse(result);
											var str = "";
											for(var i = 0 ; listOption && i < listOption.length; i++) {
												str += '<option value="' + listOption[i].name + '" />'; // Storing options in variable
											}
											$("#aguruList").html(str);
									   }
						  			}
							 },2000);
					  		});
						  
						});

	// If Upadhi is changed
	$('#upadhi').change(function() {
		if($('#upadhi').val() == 1) {
			// Show following fields in form
			$('#acharya').attr('class', '');
			$('#ailacharya').attr('class', '');
			$('#upadhyay').attr('class', '');
			$('#muni').attr('class', '');
			$('#ailak').attr('class', '');
			$('#kshullak').attr('class', '');
			// Hide following fields from form
			$('#aryika').attr('class', 'hidden');
			$('#kshullika').attr('class', 'hidden');
		} else if($('#upadhi').val() == 2) {
			// Show following fields in form
			$('#ailacharya').attr('class', '');
			$('#upadhyay').attr('class', '');
			$('#muni').attr('class', '');
			$('#ailak').attr('class', '');
			$('#kshullak').attr('class', '');
			// Hide following fields from form
			$('#acharya').attr('class', 'hidden');
			$('#aryika').attr('class', 'hidden');
			$('#kshullika').attr('class', 'hidden');
		} else if($('#upadhi').val() == 3) {
			// Show following fields in form
			$('#upadhyay').attr('class', '');
			$('#muni').attr('class', '');
			$('#ailak').attr('class', '');
			$('#kshullak').attr('class', '');
			// Hide following fields from form
			$('#acharya').attr('class', 'hidden');
			$('#ailacharya').attr('class', 'hidden');
			$('#aryika').attr('class', 'hidden');
			$('#kshullika').attr('class', 'hidden');
		} else if($('#upadhi').val() == 4) {
			// Show following fields in form
			$('#muni').attr('class', '');
			$('#ailak').attr('class', '');
			$('#kshullak').attr('class', '');
			// Hide following fields from form
			$('#acharya').attr('class', 'hidden');
			$('#ailacharya').attr('class', 'hidden');
			$('#upadhyay').attr('class', 'hidden');
			$('#aryika').attr('class', 'hidden');
			$('#kshullika').attr('class', 'hidden');
		} else if($('#upadhi').val() == 5) {
			// Show following fields in form
			$('#ailak').attr('class', '');
			$('#kshullak').attr('class', '');
			// Hide following fields from form
			$('#acharya').attr('class', 'hidden');
			$('#ailacharya').attr('class', 'hidden');
			$('#upadhyay').attr('class', 'hidden');
			$('#muni').attr('class', 'hidden');
			$('#aryika').attr('class', 'hidden');
			$('#kshullika').attr('class', 'hidden');
		} else if($('#upadhi').val() == 6) {
			// Show following fields in form
			$('#kshullak').attr('class', '');
			// Hide following fields from form
			$('#acharya').attr('class', 'hidden');
			$('#ailacharya').attr('class', 'hidden');
			$('#upadhyay').attr('class', 'hidden');
			$('#muni').attr('class', 'hidden');
			$('#ailak').attr('class', 'hidden');
			$('#aryika').attr('class', 'hidden');
			$('#kshullika').attr('class', 'hidden');
		} else if($('#upadhi').val() == 7) {
			// Show following fields in form
			$('#aryika').attr('class', '');
			$('#kshullika').attr('class', '');
			// Hide following fields in form
			$('#acharya').attr('class', 'hidden');
			$('#ailacharya').attr('class', 'hidden');
			$('#upadhyay').attr('class', 'hidden');
			$('#muni').attr('class', 'hidden');
			$('#ailak').attr('class', 'hidden');
			$('#kshullak').attr('class', 'hidden');
		} else {
			// Show following fields in form
			$('#kshullika').attr('class', '');
			// Hide following fields in form
			$('#acharya').attr('class', 'hidden');
			$('#ailacharya').attr('class', 'hidden');
			$('#upadhyay').attr('class', 'hidden');
			$('#muni').attr('class', 'hidden');
			$('#ailak').attr('class', 'hidden');
			$('#kshullak').attr('class', 'hidden');
			$('#aryika').attr('class', 'hidden');
		}
	});

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
	varprefix.open("GET","./getPrefix.php?q="+str,true);
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
	varsuffix.open("GET","./getSuffix.php?q="+str,true);
	varsuffix.send();
}
