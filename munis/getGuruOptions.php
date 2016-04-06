<?php
// configuration
include '../config.php';
include 'getMuni.php';

$term = '%'.$_GET['term'].'%';

$q=$db->prepare("SELECT * FROM munishri, upadhis WHERE (name LIKE ? OR prefix LIKE ? OR suffix LIKE ? OR alias LIKE ?)
														AND upadhi = uid AND upadhi = 1");
$q->execute(array($term,$term,$term,$term));

if($q->rowCount() != 0) {
	$data = array();
	$response = array();
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		$data['id'] = $row['id'];
		$data['name'] = getmuni($row['id']);
		array_push($response, $data); 
		//echo '<option value="'.getmuni($row['id']).'">';
	}
}

print json_encode($response);

?>
