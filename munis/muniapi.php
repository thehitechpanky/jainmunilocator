<?php

header('Content-Type: application/json');

include '../config.php';

$id = $_GET['id'];

$q = $db->prepare('SELECT * FROM munishri, upadhis, acharya, ailacharya, upadhyay, muni, ailak, kshullak, aryika, kshullika, bhramcharya, muni_location, contact
WHERE id=? AND acharyaid=? AND ailacharyaid=? AND upadhyayid=? AND muniid=? AND ailakid=? AND kid=?
AND aryikaid=? AND kshullikaid=? AND bhramcharyaid=? AND mid=? AND contactid=? AND uid=upadhi');
$q->execute(array($id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id));

if ($q->rowCount() == 1) {
	$row = $q->fetch(PDO::FETCH_ASSOC);
	$result[]=$row;
}

print(json_encode($result));

?>
