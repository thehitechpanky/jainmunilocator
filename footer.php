<!-- start footer -->

<!-- Analytics Included -->
<?php include_once("analyticstracking.php") ?>

<!-- Google Map and Markers -->
<?php
	$array = array();
	$sql = "SELECT * FROM muni_location, munishri WHERE mid=id AND lat<>0 AND dos='0000-00-00'";
	$result=mysqli_query($link,$sql);
	$i=0;
	while($row = mysqli_fetch_assoc($result)){
	if(isset($row)){
	$array[$i][0]='<center><a href="/munis.php?id='.$row['id'].'"><img style="opacity:0.5" width="200px" src="'.$row['img'].'" /><br />'.getmuni($row['id']).'</a></center>';
	$array[$i][1]=$row['lat'];
	$array[$i][2]=$row['lng'];
	$i++;
	}
	}
	//$json = json_encode($array);
?>

<!-- start scripts -->
<script type='text/javascript'>var locations =  <?php echo json_encode( $array ) ?>;</script>
<script type='text/javascript' src='js/slider-menu.min.js'></script>
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
<script type='text/javascript' src='https://www.google.com/recaptcha/api.js'></script>
<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDcnIUTozeOU26CWZRSxQRRoTFeZtvzX6Y'></script>
<script type='text/javascript' src='http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js'></script>
<script type='text/javascript' src='js/googlemaps.min.js'></script>
<!-- end scripts -->

<div class="space"></div>
<div class="sub-footer clearfix">
	<div id="progress-back" class="load-item">
		<div id="progress-bar"></div>
	</div>
	<div class="copyright">&copy; 2014 Developed by <a  target='_blank' href='http://dhruvjain.org'>Dhruv Jain</a>	</div>

	<!-- start footer-menu -->
		<div class="footer-menu">
			<ul class="footer_menu">
				<li><a href="team.php">Team</a></li>
				<li><a href="references.php">References</a></li>
				<li><a href="sitemap.php">Sitemap</a></li>
				<li><a href="tos.php">Terms and Conditions</a></li>
				<li><a href="disclaimer.php">Disclaimer</a></li>
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

<!-- Sitemap -->


</body>
</html>
