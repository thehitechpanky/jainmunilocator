<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<!-- start head -->
<head>

	<!-- start title -->
	<title>Jain Muni Locator</title>

	<!-- start meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- styles -->
 	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/isotope.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/layout.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/prettyPhoto.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/supersized.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/light-style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/googlemaps.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/style.min.css" type="text/css" media="all" >
	
	<!--[if lte IE 9]>
	<link rel='stylesheet' href='css/ie9.css' type='text/css' media='all' />
	<![endif]-->

	<!-- end styles -->
	
	<!-- start script -->
	<script type='text/javascript' src='js/slider-menu.min.js'></script>
	<script src='js/jquery-1.11.1.min.js'></script>
	<!-- end script -->

	
<!-- Load Configuration File -->
<?php include('config.php'); ?>
	<?php
		$r = $db->query('SELECT * FROM quotes ORDER BY RAND() LIMIT 1');
		$row = $r->fetch(PDO::FETCH_ASSOC);
	?>
	
	<!-- background slides -->
	<div id="customcon"><div id="map-canvas" style="z-index:0;"></div></div>
	
	<!-- <script type = "text/javascript">
		jQuery(function ($) {
			jQuery.supersized({
				slides :
					[
						{image:'',title:'<?php echo $row["quote"]." - ".$row["author"]; ?>'}					
					]
			});
		});
	</script > -->	
	
	<!-- end background slides -->
</head>
<!-- end head -->
