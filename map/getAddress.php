<?php
//Function to find location address from coordinates
function getaddress($lat,$lng) {
	global $serverkey;
	$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false&key='.$serverkey);
	$data = json_decode($geocode);
	$status = $data->status;
	if($status=="OK") {
		return $data->results[0]->formatted_address;
	} else { return "N/A"; }
}
?>
