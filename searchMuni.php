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
														upadhi = uid
														ORDER BY upadhi, name");
$q->execute();

if($q->rowCount() != 0) {
	echo '<ol>';
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		//if(isMobile()){
			echo '<li><a href="?id='.$row['id'].'" title="Profile of '.getmuni($row['id']).'" >'.getmuni($row['id']).'</a></li>';
		//} else {
		//echo '<li><a href="?id='.$row['id'].'" title="Profile of '.getmuni($row['id']).'" >'.getmuni($row['id']).'<img src="'.$row['img'].'" class="smallLight" alt="Photo of '.getmuni($row['id']).'" /></a></li>';
		//}
	}
	echo '</ol>';
} else {
	echo "<span style='color:red'>Our records don't have an entry for the Munishri you searched. 
	If you have any kind of information about that muni please help us to collect the data by adding information 
	<a href='./add.php'>here</a></span><br /><br />";
}

?>
