<?php

header('Content-Type: application/json');

include '../config.php';

$id = $_GET['id'];

$q = $db->prepare('SELECT * FROM chaturmas WHERE chaturmasmuni=? ORDER BY chaturmasyear DESC');
$q->execute(array($id));

$result = '';

while ($row = $q->fetch(PDO::FETCH_ASSOC)) { $result[]=$row; }

print(json_encode($result));

?>
