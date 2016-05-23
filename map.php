<!DOCTYPE html>

<html lang="en">
	
	<head>
		
		<title>Locate Digambara Monks &amp; Nuns - Jain Muni Locator</title>
		
		<?php include 'meta.php' ?>
		<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
		<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
		<meta name="keywords" content="Jain Muni Locator, Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, list of all digamabar jain munis">
		
		<link rel="stylesheet" href="map/googleMap.css">
		<link rel="stylesheet" href="nav/sliderMenu.css">
		
	</head>
	
	<body itemscope itemtype="http://schema.org/WebPage">
		
		<div id='map' itemscope itemtype="http://schema.org/Map"></div>
		
		<input id="pac-input" class="controls" type="text" placeholder="       Search Box" />
		
		<div class="g-signin2 login" data-onsuccess="onSignIn"></div>
		
		<!-- Start Menu -->
		<div id="pgcontainer">
			<a href="#" class="menubtn" title="Menu"></a>
			<div id="menu">
				<ul>		            
					<li><a target="" href="./" title="Home">Home</a></li>
					<li><a target="" href="./map.php" title="Map">Map</a></li>
					<li><a target="" href="./munis.php" title="Munis">Munis</a></li>
				</ul>
			</div>
			<div class="overlay"></div>
		</div>
		<!-- End Menu -->
		
		<input type="hidden" id="editoremail">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="nav/sliderMenu.js" type="text/javascript"></script>
		
		<!-- Login -->
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script type='text/javascript' src='login/login.js'></script>
		<script src="map/googleMap.js" type="text/javascript"></script>
		
		<?php
	//script has to be loaded after map div and marker boxes, otherwise maps will not work
	include 'map/googleMap.php';
include 'analyticstracking.php';
		?>
		
	</body>
	
</html>
