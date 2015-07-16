<!DOCTYPE html>
<html dir="ltr" lang="en-US">
	
<!-- Load Configuration File -->
<?php include('config.php'); ?>

<head>

	<!-- start title -->
	<title><?php echo $titletag ?></title>

	<!-- start meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
	<meta name="keywords" content="<?php echo $titletag ?>, Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, Muni Dincharya, list of all digamabar jain munis">
	<meta name="author" content="Jain Muni Locator">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="alexaVerifyID" content="GfQ7YYpZjrH6gB9GuRuLa8OXMFA"/>

	<!-- styles -->
 	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/isotope.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/layout.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/prettyPhoto.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/supersized.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/light-style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/googlemaps.min.css" type="text/css" media="screen" />
	<!-- end styles -->
	
	<!-- Load Map -->
	<div id="customcon"><div id="map-canvas" style="z-index:0;"></div></div>	

</head>
