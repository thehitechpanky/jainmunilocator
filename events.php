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
			<h1>Events</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">	
			
			<?php

echo "<h3>Today's Events</h3>
<table class='sub'>
<tr><th colspan='2' align='left'>Muni Deeksha Diwas</th></tr>";
$i = 0;
$t = $db->prepare("SELECT * FROM munishri, muni WHERE id=muniid AND DAY(munidate)='$currentDay' AND MONTH(munidate)='$currentMonth' ORDER BY upadhi");
$t->execute();
while($row = $t->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	echo '<tr><td>'.$i.'.</td><td><a href="./munis.php?id='.$row['id'].'">'.getmuni($row['id']).'</a></td></tr>';
}

echo "<tr><th colspan='2' align='left'>Aryika Deeksha Diwas</th></tr>";
$i = 0;
$t = $db->prepare("SELECT * FROM munishri, aryika WHERE id=aryikaid AND DAY(aryikadate)='$currentDay' AND MONTH(aryikadate)='$currentMonth' ORDER BY upadhi");
$t->execute();
while($row = $t->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	echo '<tr><td><a href="./munis.php?id='.$row['id'].'">'.$i.': '.getmuni($row['id']).'</a></td></tr>';
}

echo "</table>
<div>&nbsp;</div>
<h3>This Month's Events</h3>
<table class='sub'>
<tr><th colspan='3' align='left'>Muni Deeksha Diwas</th></tr>
<tr><td>S. No.</td><td>Date</td><td>Muni-Shri</td>";
$i = 0;
$t = $db->prepare("SELECT * FROM munishri, muni WHERE id=muniid AND MONTH(munidate)='$currentMonth' ORDER BY DAY(munidate), upadhi");
$t->execute();
while($row = $t->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	$muniDate = $row['munidate'];
	echo '<tr><td>'.$i.'</td><td>'.date('d', strtotime($muniDate)).'</td><td><a href="./munis.php?id='.$row['id'].'">'.getmuni($row['id']).'</a></td></tr>';
}

echo "</table>";

			?>
			
			<br />
			<hr>
			
			<!-- Facebook Comments Started -->
			<div id="fb-root"></div>
			<div class="fb-like" data-href="http://jainmunilocator.org/events.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<div class="fb-comments" data-href="http://jainmunilocator.org/events.php" data-numposts="5"></div>
			<!-- Facebook Comments Ended -->
			
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			
		</div>
		
		<div class="sidebar">
			
			<div class="today">Current Date: <?php echo $today; ?></div><br />
			
			<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
				<div class="fb-xfbml-parse-ignore">
					<blockquote cite="https://www.facebook.com/jainmunilocator">
						<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
					</blockquote>
				</div>
			</div>
			
		</div>
		<!-- end widgets -->
		
	</div>
	
	<!--  end content wrapper  -->
	
	<?php include('footer.php'); ?>
