<?php
// configuration
include('functionsCreated.php');
 
$guruNameInput=$_REQUEST['guruNameInput'];

if(isset($guruNameInput) == false) {
	echo "Invalid Access";
	return;
}

$testCondition = "%".$guruNameInput."%";

$q=$db->prepare("SELECT * FROM munishri, upadhis, muni_location WHERE
														( name LIKE '$testCondition' OR
														uname LIKE '$testCondition' OR
														prefix LIKE '$testCondition' OR
														suffix LIKE '$testCondition' OR
														alias LIKE '$testCondition' ) AND
														upadhi = uid AND
														id = mid AND
														dos = '0000-00-00' AND
														location = 'N/A'
														ORDER BY upadhi, name");
$q->execute();

if($q->rowCount() != 0) {
	echo '<ol>';
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		echo '<li><a href="./editform.php?id='.$row['id'].'">'.getmuni($row['id']).'<img src="'.$row['img'].'" class="smallLight" /></a></li>';
	}
	echo '</ol>';
}

?>
