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
			<h1>References</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">
			<p>We have obtained our data from various sources including individuals, facebook pages, facebook groups and websites. Some of the websites are as listed below:</p>
			<ul>
				<li><a href="http://jainreligion.in">http://jainreligion.in</a></li>
				<li><a href="http://jinaagamsaar.com">http://jinaagamsaar.com</a></li>
				<li><a href="http://worldofjainism.com">http://worldofjainism.com</a></li>
				<li><a href="http://www.digambarjainonline.com">http://www.digambarjainonline.com</a></li>
				<li><a href="http://www.jaincyclopedia.org">http://www.jaincyclopedia.org</a></li>
				<li><a href="http://www.jinvaani.org">http://www.jinvaani.org</a></li>
				
				<?php
				$t = $db->prepare('SELECT approved, website FROM munishri where approved=1 AND NOT(website="") AND NOT(website="N/A")');
				$t->execute();
				while($row = $t->fetch(PDO::FETCH_ASSOC)) {
					echo '<li><a href="'.$row['website'].'">'.$row['website'].'</a></li>';
					}
				?>
			</ul>
		</div>
		<div class="sidebar">
		<img alt="Acharya Kundkund | Jain Muni Locator" src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" style="width:200px;margin-right:5px">
		</div>
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
