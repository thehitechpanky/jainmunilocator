<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" >

	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
	
	<!-- start navigation -->
	<?php include('menu.php'); ?>
	<!-- end navigation -->
	
	<!-- start content wrapper -->	
	
	<div class="content page-content">
	
		<div class="page-title">
			<h1>Events</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">	
		
			<?php
				$today = date("Y-m-d");
				echo $today;
			?>
		
		</div>
		<div class="sidebar">
		<img alt="Acharya Kundkund | Jain Muni Locator" src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" class="sidebar">
		</div>
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
