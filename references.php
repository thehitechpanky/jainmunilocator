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
				<li><a href="http://www.digambarjainonline.com">http://www.digambarjainonline.com</a></li>
				<li><a href="http://www.jaincyclopedia.org">http://www.jaincyclopedia.org</a></li>
				<li><a href="http://jinaagamsaar.com">http://jinaagamsaar.com</a></li>
				
					<?php
					$sql = 'SELECT approved, website FROM munishri where approved=1 AND NOT(website="") AND NOT(website="N/A")';
					$result = $link->query($sql);
					if ($result->num_rows > 0) {
    				// output data of each row
    				while($row = $result->fetch_assoc()) {
						echo '<li><a href="'.$row["website"].'">'.$row["website"].'</li>';
    				}
					} else {
    				echo "0 results";
					}
					$link->close();			
					?>
			</ul>
		</div>
		<div class="sidebar">
		<img src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" style="width:200px;margin-right:5px">
		</div>
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
