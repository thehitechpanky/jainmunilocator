<?php
// configuration
include('config.php');

$q = intval($_GET['q']);

mysqli_select_db($link,"ajax_demo");
$sql="SELECT * FROM upadhis WHERE uid = '".$q."'";
$result = mysqli_query($link,$sql);

while($row = mysqli_fetch_array($result)) {
	echo $row['prefix'];
}
mysqli_close($link);
?>
