<!-- Config File included for connection with database -->
<?php include('config.php'); ?>

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

<!-- Scripts for Markers -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcnIUTozeOU26CWZRSxQRRoTFeZtvzX6Y"></script>
<script type="text/javascript">
var locations =  <?php echo json_encode( $array ) ?>;
var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 7,
	center: new google.maps.LatLng(23.2836,79.2318),
	mapTypeId: google.maps.MapTypeId.ROADMAP
	});
var infowindow = new google.maps.InfoWindow();
var marker, i;
	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
			});
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
				}
		})(marker, i));
	}
</script>
<script type="text/javascript">google.maps.event.addDomListener(window, 'load', initialize);</script>
