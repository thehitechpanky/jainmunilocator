<?php

function getlocality($lat,$lng) {
	
	$geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false');
	
	$output= json_decode($geocode);
	
	for($j=0;$j<count($output->results[0]->address_components);$j++){
		$cn=array($output->results[0]->address_components[$j]->types[0]);
		if(in_array("locality", $cn))
		{
			$locality= $output->results[0]->address_components[$j]->long_name;
			return $locality;
		}
	}
}
?>
