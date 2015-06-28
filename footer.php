<!-- start footer -->

//Analytics Included
<?php include_once("analyticstracking.php") ?>
<?php

$connection = mysqli_connect("localhost","username","password","database name"); 
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
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

<!-- start scripts -->
<script type='text/javascript' src='js/jquery-1.7.1.min.js'></script>
<script type='text/javascript' src='js/jquery.custom.js'></script>
<script type='text/javascript' src='js/jquery.supersized.js'></script>
<script type='text/javascript' src='js/jquery.supersized.shutter.min.js'></script>
<script type='text/javascript' src='js/jquery-ui-1.8.18.custom.min.js'></script>
<script type='text/javascript' src='js/jquery.tipsy.js'></script>
<script type='text/javascript' src='js/jquery.form.js'></script>
<script type='text/javascript' src='js/jquery.isotope.min.js'></script>
<script type='text/javascript' src='js/jquery.easing.js'></script>
<script type='text/javascript' src='js/jquery.preloader.js'></script>
<script type='text/javascript' src='js/jquery.prettyPhoto.js'></script>
<script type='text/javascript' src='js/jquery.scroll.min.js'></script>
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
<!-- end scripts -->

	<div class="space"></div>
	<div class="sub-footer clearfix">
		<div id="progress-back" class="load-item">
			<div id="progress-bar"></div>
		</div>	
		<div class="copyright">
			&copy; 2014 Developed by <a  target='_blank' href='http://dhruvjain.org'>Dhruv Jain</a>	</div>
	        <div id="fb-root"></div>
                <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-like" data-href="https://www.facebook.com/jainmunilocator"  data-layout="standard" data-align="right" data-action="like" data-show-faces="true" data-share="true"></div>
		
		<!-- start footer-menu -->
		<div class="footer-menu">
			<ul class="footer_menu">
				<li>
					<a href="tos.php">Terms and Conditions</a>
				</li>
				<li>
					<a href="disclaimer.php">Disclaimer</a>
				</li>
				
				<li>
					<a href="#">Blog</a>
				</li>
			</ul>		
		</div>
		<!-- end footer-menu -->
				
	</div>
	<!-- end footer -->
	
	<div id="slidecaption"></div>
			
	<!-- srart footer social -->
	<div class="social">
	
		<a title="Facebook" target="_blank" href="http://www.facebook.com/jainmunilocator">
			<img width="22" height="22" title="" alt="" src="images/social/facebook.png" />
		</a>
		
		<a title="Follow me" target="_blank" href="#">
			<img width="22" height="22" title="" alt="" src="images/social/twitter.png" />
		</a>
		
		<a title="Google Plus" target="_blank" href="#">
			<img width="22" height="22" title="" alt="" src="images/social/google.png" />
		</a>
		
		<a title="Flickr" target="_blank" href="#">
			<img width="22" height="22" title="" alt="" src="images/social/flickr.png" />
		</a>
		<a title="Youtube" target="_blank" href="#">
			<img width="22" height="22" title="" alt="" src="images/social/youtube.png" />
		</a>	
				
		<a title="Linkedin" target="_blank" href="#">
			<img width="22" height="22" title="" alt="" src="images/social/linkedin.png" />
		</a>
		
	</div>
	<!-- end footer social -->
	
</body>
</html>
