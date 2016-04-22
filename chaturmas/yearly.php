<?php
$year = (int)$_GET['year'];
include 'config.php';
include 'munis/getMuni.php';

$q = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasyear=? AND NOT (chaturmasplace='N/A') ORDER BY chaturmasplace");
$q->execute(array($year));
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include 'meta.php'; ?>
		<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
		<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
		<meta name="keywords" content="Jain Muni Locator, Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, list of all digamabar jain munis">
		
		<title>Chaturmas <?php echo $year; ?> | Jain Muni Locator</title>
		
		<?php
include 'stylesheets.php';
		?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="/">Home</a></li>
<li><a href="map.php">Map</a></li>
<li><a href="munis.php">Digambara Monks &amp; Nuns</a></li>
<li><a href="#about">Chaturmas</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include 'nav.php';
		?>
		
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container">
				<div class="row">
					<h1>Chaturmas</h1>
					<div class="col-md-6">
						<h2><?php echo $year; ?></h2>
						<?php
$c = "N/A";
while($row = $q->fetch(PDO::FETCH_ASSOC)) {
	$d = $row['chaturmasplace'];
	if ($c == $d) {
		//This is intentionally left blank because only unique records are to fetched
	} else {
		$c = $d;
		$i++;
		echo '<br /><h3>'.$i.'. '.$c.'</h3>';
		$q2 = $db->prepare("SELECT * FROM munishri, chaturmas WHERE approved=1 AND id=chaturmasmuni AND chaturmasplace='$c' AND chaturmasyear=? ORDER BY upadhi, name");
		$q2->execute(array($year));
		$j = 0;
		while($row2 = $q2->fetch(PDO::FETCH_ASSOC)) {
			$j++;
			echo '<div class="hoverImg"><a href="./munis.php?id='.$row2["id"].'">'.$j.'. '.getmuni($row2["id"]).'<span><img class="smallLight" src="'.$row2["img"].'" alt="'.getmuni($row2["id"]).'" /></span></a></div>';
		}
	}
}
						?>
						
						<hr>
						
						<!-- Facebook Comments Started -->
						<div id="fb-root"></div>
						<div class="fb-like" data-href="http://jainmunilocator.org/chaturmas.php?year=<?php echo $year; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
						<div class="fb-comments" data-href="http://jainmunilocator.org/chaturmas.php?year=<?php echo $year; ?>" data-numposts="5"></div>
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
