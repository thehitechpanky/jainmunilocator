<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" <?php echo $schemaOrgBody; ?>>

	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
	
	<!-- start navigation -->
	<?php include('menu.php'); ?>
	<!-- end navigation -->
	
	<!-- start content wrapper -->
	
	<div class="content page-content">
	
		<div class="page-title">
			<h1>Images Required</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">
			
			<h4>Currently there are no location for following Gurus. Please provide us links to images for the following Gurus. Just click on the name to open the edit page.</h4>
			
			<input id="searchBoxNoLocation" name="searchBox" type="text" placeholder="Search" class="fullWidth" />
			
			<div id="searchResults" class="hoverImg"></div>
			
			<br />
			<hr>
			
			<!-- Facebook Comments Started -->
			<div id="fb-root"></div>
			<div class="fb-like" data-href="http://jainmunilocator.org/noLocation.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<div class="fb-comments" data-href="http://jainmunilocator.org/noLocation.php" data-numposts="5"></div>
			<!-- Facebook Comments Ended -->
			
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			
		</div>
		
		<div class="sidebar">
			<img alt="Acharya Kundkund | Jain Muni Locator" src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" class="" width="100%" />
		</div>
		
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
