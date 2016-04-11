<?php
include 'config.php';
include 'munis/getMuni.php';
include 'calendar/month.php';
$today = date('d M Y');
$currentday = date('d');
$currentmonth = date('m');
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
						<h2>Today's Events</h2>
						
						<?php
$i = 0;
$j = 0;
$q = $db->prepare("SELECT * FROM munishri, muni, aryika WHERE id=muniid AND id=aryikaid AND (upadhi=2 OR upadhi=4 OR upadhi=7) AND (DAY(munidate)=? OR DAY(aryikadate)=?) AND (MONTH(munidate)=? OR MONTH(aryikadate)=?)");
$q->execute(array($currentday,$currentday,$currentmonth,$currentmonth));

while ($q->fetch(PDO::FETCH_ASSOC)) { $i++; }

if ($i > 0) {
						?>					
						
						<h3>Intitiation Anniversary (दीक्षा दिवस)</h3>
						<table>
							<tr><th>S.No.</th><th>Name</th></tr>
							
							<?php
	$t = $db->prepare("SELECT id, upadhi, muniid, munidate FROM muni, munishri WHERE id=muniid AND (upadhi=2 OR upadhi=4 OR upadhi=7) AND DAY(munidate)=? AND MONTH(munidate)=? UNION
	SELECT id, upadhi, aryikaid, aryikadate FROM aryika, munishri WHERE id=aryikaid AND (upadhi=2 OR upadhi=4 OR upadhi=7) AND DAY(aryikadate)=? AND MONTH(aryikadate)=?");
	$t->execute(array($currentday,$currentmonth,$currentday,$currentmonth));
	while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
		$j++;
		echo '<tr><td>'.$j.'</td><td><a href="munis.php?id='.$row['id'].'">'.getmuni($row['id']).'</a></td></tr>';
	}
							?>
							
						</table><br /><br />
						
						<?php } ?>
						
						<h2>This Month's Events</h2>
						
						<?php
$i = 0;
$j = 0;
$q = $db->prepare("SELECT * FROM munishri, acharya WHERE id=acharyaid AND upadhi=1 AND MONTH(adate)=?");
$q->execute(array($currentmonth));

while ($q->fetch(PDO::FETCH_ASSOC)) { $i++; }

if ($i > 0) {
						?>
						
						<h3>Promotion Anniversary (पदारोहण दिवस)</h3>
						<table>
							<tr><th>S.No.</th><th>Date</th><th>Name</th></tr>
							
							<?php		
	$t = $db->prepare("SELECT * FROM munishri, acharya WHERE id=acharyaid AND upadhi=1 AND MONTH(adate)=? ORDER BY DAY(adate)");
	$t->execute(array($currentmonth));
	while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
		$j++;
		echo '<tr><td>'.$j.'</td><td>'.date('d',strtotime($row['adate'])).'</td><td><a href="munis.php?id='.$row['id'].'">'
			.getmuni($row['id']).'</a></td></tr>';
	}
							?>
							
						</table><br />
						
						<?php
}
$i = 0;
$j = 0;
$q = $db->prepare("SELECT * FROM munishri, muni, aryika WHERE id=muniid AND id=aryikaid AND (upadhi=2 OR upadhi=4 OR upadhi=7) AND (MONTH(munidate)=? OR MONTH(aryikadate)=?)");
$q->execute(array($currentmonth,$currentmonth));

while ($q->fetch(PDO::FETCH_ASSOC)) { $i++; }

if ($i > 0) {
						?>
						<h3>Intitiation Anniversary (दीक्षा दिवस)</h3>
						<table>
							<tr><th>S.No.</th><th>Date</th><th>Name</th></tr>
							
							<?php
	$t = $db->prepare("SELECT id, upadhi, muniid, munidate FROM muni, munishri WHERE id=muniid AND (upadhi=2 OR upadhi=4 OR upadhi=7) AND MONTH(munidate)=? UNION
	SELECT id, upadhi, aryikaid, aryikadate FROM aryika, munishri WHERE id=aryikaid AND (upadhi=2 OR upadhi=4 OR upadhi=7) AND MONTH(aryikadate)=? ORDER BY DAY(munidate)");
	$t->execute(array($currentmonth,$currentmonth));
	while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
		$j++;
		echo '<tr><td>'.$j.'</td><td>'.date('d',strtotime($row['munidate'])).'</td>
		<td><a href="munis.php?id='.$row['id'].'">'.getmuni($row['id']).'</a></td></tr>';
	}
							?>			
							
						</table>
						
						<?php } ?>
						
						<hr>			
						<!-- Facebook Comments Started -->
						<div id="fb-root"></div>
						<div class="fb-like" data-href="http://jainmunilocator.org/events.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
						<div class="fb-comments" data-href="http://jainmunilocator.org/events.php" data-numposts="5"></div>
						<!-- Facebook Comments Ended -->
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6 text-center">
						<h1><?php echo $today; ?></h1>
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
