<?php

include '../config.php';

$input=$_REQUEST['input'];

if(isset($input) == false) {
	echo "Invalid Access";
	return;
}

$input = "%".$input."%";

$q=$db->prepare("SELECT * FROM temples WHERE tname LIKE ? OR tadd LIKE ?");
$q->execute(array($input, $input));

if($q->rowCount() != 0) {
	
	echo '<ol>';
	
	while($row = $q->fetch(PDO::FETCH_ASSOC)) {
		
		$id = $row['tid'];
		$name = $row['tname'];
		$address = $row['tadd'];
		
		if (file_exists("temples/uploads/{$name}.jpg")) {
			$img = "temples/uploads/{$name}.jpg";
		} else {
			$img = 'na.png';
		}
		
		echo '<li><a href="?id='.$id.'">'.$name.'<br />('.$address.')<img src="'.$img.'" class="smallLight" alt="Photo of '.$name.'"></a></li>';
	}
	
	echo '</ol>';
	
} else {
	echo "<span style='color:red'>Your search input is invalid. To add a new temple please click <a href='/temples/add.php'>here</a>.</span>";
}

?>
