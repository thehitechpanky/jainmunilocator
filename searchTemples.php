<?php
// configuration
include('functionsCreated.php');
 
$searchInput=$_REQUEST['searchInput'];

if(isset($searchInput) == false) {
	echo "Invalid Access";
	return;
}

$testCondition = "%".$searchInput."%";

$q=$db->prepare("SELECT * FROM temples WHERE tname LIKE '$testCondition'");
$q->execute();

if($q->rowCount() != 0) {
	echo '<ol>';
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		echo '<li><a href="?id='.$row['tid'].'" title="Details of '.$row['tname'].' temple at '.$row['tadd'].'" >'.$row['tname'].'<img src="'.$row['timg'].'" class="smallLight" alt="Photo of '.$row['tname'].'" /></a></li>';
	}
	echo '</ol>';
} else {
	echo "<span style='color:red'>Our records don't have an entry for the temple you searched. 
	If you have any kind of information about that temple please help us to collect the data by adding information 
	<a href='#'>here</a></span><br /><br />";
}

?>
