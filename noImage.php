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
			
		<h4>Currently there are no images for following munis, please provide us links to images for the following munis. Just click on the name to open the edit page.</h4>
		
		<input id="searchBoxNoImg" name="searchBox" type="text" placeholder="Search" class="fullWidth" />
			
			<div id="searchResults"></div>		
			
			<br />
			<hr>
			
			<!-- Facebook Comments Started -->
			<div id="fb-root"></div>
			<div class="fb-like" data-href="http://jainmunilocator.org/noImage.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<div class="fb-comments" data-href="http://jainmunilocator.org/noImage.php" data-numposts="5"></div>
			<!-- Facebook Comments Ended -->
			
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
						
		</div>
		<div class="sidebar">
			<img alt="Photo of Acharya Kundkund | Jain Muni Locator" src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" class="" width="100%" />
		</div>
		
		<!-- end widgets -->
		
	</div>
	
	<!--  end content wrapper  -->
 	
<?php
$loadSearchScript="Yes";
include('footer.php');
?>
