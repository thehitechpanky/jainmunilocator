<?php
include '../config.php';
$q=$db->prepare('select * from muni_location loc, munishri muni, 
		upadhis up where (loc.lat>0 or loc.lng>0) and loc.mid = muni.id and muni.upadhi=up.uid');
$q->execute();
$muni = array();
$info["muni"] = array();
if($q->rowCount() != 0) {
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		$result[]=$row;
	}
}
print(json_encode($result));
?>
