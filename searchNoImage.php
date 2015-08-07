<?php
// configuration
include('functionsCreated.php');
 
$guruNameInput=$_REQUEST['guruNameInput'];

if(isset($guruNameInput) == false) {
	echo "Invalid Access";
	return;
}

$testCondition = "%".$guruNameInput."%";

$q=$db->prepare("SELECT * FROM munishri, upadhis WHERE
														( name LIKE '$testCondition' OR
														uname LIKE '$testCondition' OR
														prefix LIKE '$testCondition' OR
														suffix LIKE '$testCondition' OR
														alias LIKE '$testCondition' ) AND
														upadhi = uid AND
														img = 'na.png'
														ORDER BY upadhi, name");
$q->execute();

if($q->rowCount() != 0) {
	echo '<ol>';
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		echo '<li><a href="./editform.php?id='.$row['id'].'">'.getmuni($row['id']).'</a></li>';
	}
	echo '</ol>';
}

?>
