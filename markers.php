<!-- Markers Populated -->
<?php
	$array = array();
	$sql = "SELECT name,id,lat,lng FROM muni_location,munishri WHERE mid=id AND lat<>0";
	$result=mysqli_query($connection,$sql);
	$i=0;

	while($row = mysqli_fetch_assoc($result)){
		if(isset($row)){
		$array[$i][0]=$row['name'];
		$array[$i][1]=$row['lat'];
		$array[$i][2]=$row['lng'];
		$i++;
		}
	}
?>
