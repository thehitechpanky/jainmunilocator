<!-- Google Map Markers -->
<?php
$array = array();
$sql = "SELECT * FROM muni_location, munishri WHERE mid=id AND lat<>0 AND dos='0000-00-00' ORDER BY upadhi DESC";
$result=mysqli_query($link,$sql);
$i=0;
while($row = mysqli_fetch_assoc($result)) {
	if(isset($row)){
		$array[$i][0]='<center>
		<a href="./munis.php?id='.$row['id'].'">
		<img style="opacity:0.5" width="200px" src="'.$row['img'].'" />
		<br />'.getmuni($row['id']).'<br />'.$row['location'].'</a></center>';
		$array[$i][1]=$row['lat'];
		$array[$i][2]=$row['lng'];
		$i++;
	}
}
?>
