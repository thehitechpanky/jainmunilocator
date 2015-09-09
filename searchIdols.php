<?php
// configuration
include('functionsCreated.php');
 
$searchInput=$_REQUEST['searchInput'];

if(isset($searchInput) == false) {
	echo "Invalid Access";
	return;
}

$testCondition = "%".$searchInput."%";

$q=$db->prepare("SELECT * FROM idols, temples WHERE tirthankar LIKE '$testCondition' AND templeid = tid ORDER BY tirthankar");
$q->execute();

if($q->rowCount() != 0) {
	echo '<ol>';
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		echo '<li><a href="?id='.$row['idolid'].'" title="Details of '.$row['tirthankar'].' Idol at '.$row['tname'].'" >'.$row['tirthankar'].'<img src="'.$row['idolimg'].'" class="smallLight" alt="Photo of '.$row['tirthankar'].'" /></a></li>';
	}
	echo '</ol>';
} else {
	echo "<span style='color:red'>Our records don't have an entry for the idol you searched. 
	If you have any kind of information about that idol please help us to collect the data by adding information 
	<a href='#'>here</a></span><br /><br />";
}

?>
