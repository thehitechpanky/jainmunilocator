<?php include('header.php'); ?>
<script src="http://maps.google.com/maps/api/js?sensor=false" 
           type="text/javascript"></script> 
<!-- start body -->
<body onunload="" >

	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
		
	<!--start menu wrapper -->
	<div class="menu-wrapper clearfix">
		<!-- start logo -->
		<div class="logo">
			
		</div>
		<!-- end logo -->
		
		<!-- start navigation -->
		<div class="main-nav">
			<ul class="menu">
				<?php include('menu.php'); ?>
			</ul>		
		</div>
		<!-- end navigation -->
	</div>
	<!-- end menu wrapper -->
	
	 <!-- start content wrapper -->	
<div class="container">

		<div class="page-title">
			<h1>Map Locator</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div>
			<p><?php echo $_GET['location'] ?></p>
		</div>
		   <div id="map" style="width: 400px; height: 300px;"></div> 

   <script type="text/javascript"> 

   var address = '<?php echo $_GET["location"] ?>';

   var map = new google.maps.Map(document.getElementById('map'), { 
       mapTypeId: google.maps.MapTypeId.TERRAIN,
       zoom: 6
   });

   var geocoder = new google.maps.Geocoder();

   geocoder.geocode({
      'address': address
   }, 
   function(results, status) {
      if(status == google.maps.GeocoderStatus.OK) {
         new google.maps.Marker({
            position: results[0].geometry.location,
            map: map
         });
         map.setCenter(results[0].geometry.location);
      }
   });

   </script> 
		
	</div>
	<!--  end content wrapper  -->
 	
 	<?php include('footer.php'); ?>
