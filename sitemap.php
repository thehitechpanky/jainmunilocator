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
			<h1>Sitemap</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">
			<table style="width:100%">
				<tr align="left"><th colspan="2">Main Menu</th><th colspan="2">Footer Links</th></tr>
				<tr><td>&#8226;</td><td><a href="/">Home</a></td><td>&#8226;</td><td><a href="team.php">Team</a></td></tr>
				<tr><td>&#8226;</td><td><a href="about.php">About</a></td><td>&#8226;</td><td><a href="references.php">References</a></td></tr>
				<tr><td>&#8226;</td><td><a href="munis.php">Munis</a></td><td>&#8226;</td><td><a href="sitemap.php">Sitemap</a></td></tr>
				<tr><td>&#8226;</td><td><a href="meaning-of-108.php">Meaning of 108</a></td><td>&#8226;</td><td><a href="tos.php">Terms and Conditions</a></td></tr>
				<tr><td>&#8226;</td><td><a href="mahagun.php">Mahagun</a></td><td>&#8226;</td><td><a href="disclaimer.php">Disclaimer</a></td></tr>
				<tr><td>&#8226;</td><td><a href="contact.php">Contact</a></td></tr>
				<tr><td>&#8226;</td><td><a href="donate.php">Donate</a></td></tr>
				<tr><td>&#8226;</td><td><a href="add.php">Add Information</a></td></tr>
			</table>
			<p> </p>
			<table style="width:100%">
				<tr align="left"><th colspan="2">Guru Links</th></tr>
					<?php
					$sql = 'SELECT approved, id FROM munishri where approved=1';
					$result = $link->query($sql);
					if ($result->num_rows > 0) {
    				while($row = $result->fetch_assoc())
					{echo '<tr><td>&#8226;&nbsp;</td><td><a href="munis.php?id='.$row["id"].'">'.getmuni($row["id"]).'</a></td></tr>';}
					}
					$link->close();
					?>
			</table>
					
		</div>
		<div class="sidebar">
		<img src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" style="width:200px;margin-right:5px">
		</div>
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
