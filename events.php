<?php
include 'config.php';
include 'munis/getMuni.php';
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include 'meta.php'; ?>
		<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
		<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
		<meta name="keywords" content="Jain Muni Locator, Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, list of all digamabar jain munis">
		
		<title>Events | Jain Muni Locator</title>
		
		<?php include 'stylesheets.php'; ?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="/">Home</a></li>
<li><a href="map.php">Map</a></li>
<li><a href="munis.php">Digambara Monks &amp; Nuns</a></li>
<li><a href="#about">Events</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include 'nav.php';
		?>
		
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container">
				<div class="row">
					<h1>Events</h1>
					<div class="col-md-6">
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
						
						<hr>
						
						<!-- Facebook Comments Started -->
						<div id="fb-root"></div>
						<div class="fb-like" data-href="http://jainmunilocator.org/events.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
						<div class="fb-comments" data-href="http://jainmunilocator.org/events.php" data-numposts="5"></div>
						<!-- Facebook Comments Ended -->
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
							<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
								<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
								</blockquote></div>
						</div>
						<?php include 'adsense.php'; ?>
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.section -->
		
		
		<?php
include 'contact.php';
include 'footer2.php';
include 'scripts.php';
		?>
		
	</body>
	
</html>
