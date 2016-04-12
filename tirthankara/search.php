<?php

include '../config.php';

$input=$_REQUEST['input'];

if(isset($input) == false) {
	echo "Invalid Access";
	return;
}

$testCondition = "%".$input."%";

$q=$db->prepare("SELECT * FROM tirthankara WHERE tirthankaraname LIKE ? ORDER BY tirthankaraid");
$q->execute(array($testCondition));

if($q->rowCount() != 0) {
	
	echo '<ol>';
	
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		
		$id = $row['tirthankaraid'];
		$name = $row['tirthankaraname'];
		
		if (file_exists("tirthankara/uploads/{$name}.jpg")) {
			$img = "tirthankara/uploads/{$name}.jpg";
		} else {
			$img = 'na.png';
		}
		
		echo '<li><a href="?id='.$id.'" title="Details of '.$name.'" >'.$name.'<img src="'.$img.'" class="smallLight" alt="Photo of '.$name.'" /></a></li>';
	}
	
	echo '</ol>';
	
} else {
	echo "<span style='color:red'>Your search input is invalid. There are only 24 Tirthankara as per Jain Tradition. Please try again!</span>";
}

?>
