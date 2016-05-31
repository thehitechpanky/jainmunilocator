<?php

function getlocality($lat,$lng) {
	global $serverkey;
	$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false&key='.$serverkey);
	$output = json_decode($geocode);
	//var_dump($output); //This will explain the error
	if ($lat == 0 || $lng == 0) { return 'N/A'; } else {
		for($j=0; $j<count($output->results[0]->address_components); $j++) {
			$cn = array($output->results[0]->address_components[$j]->types[0]);
			if (in_array("locality", $cn)) {
				$locality= $output->results[0]->address_components[$j]->long_name;
				return $locality;
			}
		}
	}
}

?>
