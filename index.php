<?php include('header.php'); ?>
<!-- start body -->
<body class="page-template-template-homepage-php" onunload="" >

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
			<ul >
				<?php include('menu.php'); ?>
			</ul>		
		</div>
		<!-- end navigation -->
	</div>
	<!--end menu wrapper -->
	<div id="map" style="width: 100%; height: 570px;"></div>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
  
 	<?php include('footer.php'); ?>
