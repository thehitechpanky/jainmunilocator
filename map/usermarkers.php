<?php

include 'config.php';

// User Markers from SQL for map
$q = $db->prepare("SELECT * FROM user WHERE userlat>0");
$q->execute();
if($q->rowCount() > 0) {
	$rows = array();
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		$rows[] = $row;
	}
}

echo json_encode($rows);

?>
