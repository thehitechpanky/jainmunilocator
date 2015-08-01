<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<!-- Load Configuration File and created functions -->
<?php include('functionsCreated.php'); ?>

<!-- Start Head -->
<head>

	<!-- start title -->
	<title><?php echo $titletag; ?></title>

	<!-- start meta -->
	<?php $metaKeywords = $titletag.', Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, Muni Dincharya, list of all digamabar jain munis'; ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
	<meta name="keywords" content="<?php echo $metaKeywords ?>">
	<meta name="author" content="Jain Muni Locator">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="alexaVerifyID" content="GfQ7YYpZjrH6gB9GuRuLa8OXMFA"/>

	<!-- styles -->
	<link href="./css/minified.css.php" rel="stylesheet" type="text/css" media="screen" />
	<!-- end styles -->
	
	<!-- Start Search Controls -->
	<input id="pac-input" class="controls" type="text" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search" />
	<!-- End Search Controls -->
	
	<!-- Load Map -->
	<div id="customcon"><div id="map-canvas" style="z-index:0;"></div></div>

</head>
<!-- End Head -->
