<?php

//Function to get muni name
function getUpadhi($id) {
	global $db;
	$m = $db->prepare("SELECT * FROM munishri, upadhis WHERE id = ? AND uid=upadhi");
	$m->execute(array($id));
	if($m->rowCount() == 1) {
		$row = $m->fetch(PDO::FETCH_ASSOC);		
		$uname = $row['uname'];
		return $uname;
	}
}

?>
