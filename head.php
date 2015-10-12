<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>

		<!-- start title - should be 57 characters max as suggested by http://seorch.eu -->
		<title><?php echo $title; ?></title>
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
		<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
		<meta name="keywords" content="<?php echo $metaKeywords; ?>">
		<meta name="author" content="Jain Muni Locator">
		<meta name=viewport content="width=device-width, initial-scale=1">
		
		<?php include 'alexa.php';	?>
	
		<link href="./css/minified.css.php" rel="stylesheet" type="text/css" media="screen" />
		
		<?php if(isMobile()){}else{ ?>
		<!-- Load Map -->
		<div id="customcon"><div id="map-canvas" style="z-index:0;"></div></div>
		<?php } ?>
		
		<script type='text/javascript' src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
		<script type='text/javascript' src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	
	</head>

<?php include 'functions/universal.php'; ?>
