<?php

//Function to get muni name
function getName($id) {
	global $db;
	$m = $db->prepare("SELECT * FROM munishri WHERE id = ?");
	$m->execute(array($id));
	if($m->rowCount() == 1) {
		$row = $m->fetch(PDO::FETCH_ASSOC);		
		$name = $row['name'];
		return $name;
	}
}

?>
