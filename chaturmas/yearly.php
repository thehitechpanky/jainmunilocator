<?php
$year = (int)$_GET['year'];
include 'config.php';
include 'munis/getMuni.php';
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include 'meta.php'; ?>
		<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
		<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
		<meta name="keywords" content="Jain Muni Locator, Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Chaturmas, Varshayog, list of all digamabar jain munis">
		
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
					<h1 itemprop="name">Chaturmas / Varshayog <?php echo $year; ?></h1>
					<div class="col-md-6">
						<?php
$q = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasyear=? AND NOT (chaturmasstate=?) ORDER BY chaturmasstate");
$q->execute(array($year,'N/A'));
$i = 1;
$oldstate='N/A';
while($row=$q->fetch(PDO::FETCH_ASSOC)){
	$state=$row['chaturmasstate'];
	if($state==$oldstate){}else{
		echo '<br /><h3 itemscope itemtype="http://schema.org/State">'.$i.'. <span itemprop="name">'.$state.'</span></h3>';
		$oldstate=$state;//change oldstate to next
		$i++;
		//display location
		$q2 = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasyear=? AND chaturmasstate=? AND NOT (chaturmasplace=?) AND NOT (chaturmasplace=?) ORDER BY chaturmasplace");
		$q2->execute(array($year,$state,'','N/A'));
		$j = 0;
		$c = "N/A";
		while($row2 = $q2->fetch(PDO::FETCH_ASSOC)) {
			$d = $row2['chaturmasplace'];
			if ($c == $d) {
				//This is intentionally left blank because only unique records are to fetched
			} else {
				$c = $d;
				$j++;
				echo '<div itemscope itemtype="http://schema.org/Place">&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$j.'. <span itemprop="address">'.$c.'</span></strong></div>';
				// display monks & nuns
				$q3 = $db->prepare("SELECT * FROM munishri, chaturmas WHERE approved=1 AND id=chaturmasmuni AND chaturmasplace=? AND chaturmasyear=? ORDER BY upadhi, name");
				$q3->execute(array($c,$year));
				$k = 0;
				while($row3 = $q3->fetch(PDO::FETCH_ASSOC)) {
					$k++;
					echo '<div class="hoverImg" itemscope itemtype="http://schema.org/Person">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="./munis.php?id='.$row3["id"].'">
					'.$k.'. <span itemprop="name">'.getmuni($row3["id"]).'</span><span><img class="smallLight" src="'.$row3["img"].'" alt="'.getmuni($row3["id"]).'" /></span>
					</a></div>';
				}
			}
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
						<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
							<blockquote cite="https://www.facebook.com/jainmunilocator" class="fb-xfbml-parse-ignore">
								<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
							</blockquote>
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
