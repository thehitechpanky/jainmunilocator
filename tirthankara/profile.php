<?php

include 'config.php';

$id = (int)$_GET['id'];

$q = $db->prepare("SELECT * FROM tirthankara, garbha, birth, diksha, kg, moksha WHERE tirthankaraid=? AND garbhaid=tirthankaraid AND birthid=tirthankaraid AND dikshaid=tirthankaraid AND kgid=tirthankaraid AND mokshaid=tirthankaraid");
$q->execute(array($id));

if ($q->rowCount() == 1) {
	
	include 'isMobile.php';
	
	// When an id is entered in the url
	$row = $q->fetch(PDO::FETCH_ASSOC);
	$name = $row['tirthankaraname'];
	$title = 'Lord '.$name;
	$height = $row['tirthankaraheight'];
	$metre = $height * 3;
	$garbhadate = $row['garbhamonth'].' '.$row['garbhahalf'].' '.$row['garbhaday'];
	$birthdate = $row['birthmonth'].' '.$row['birthhalf'].' '.$row['birthday'];
	$dikshadate = $row['dikshamonth'].' '.$row['dikshahalf'].' '.$row['dikshaday'];
	$kgdate = $row['kgmonth'].' '.$row['kghalf'].' '.$row['kgday'];
	$mokshadate = $row['mokshamonth'].' '.$row['mokshahalf'].' '.$row['mokshaday'];
	
	if (file_exists('tirthankara/uploads/'.$name.'.jpg')) {
		$img = 'tirthankara/uploads/'.$name.'.jpg';
	} else {
		$img = 'na.png';
	}
	
?>


<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<?php include 'meta.php'; ?>
		
		<title><?php echo $title; ?></title>
		
		<?php include 'stylesheets.php'; ?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		
		<!-- Navigation -->
		<?php
	$navLinks = '<li><a href="/">Home</a></li>
	<li><a href="#about">'.$title.'</a></li>';
	$navLinks = $navLinks.'<li><a href="tirthankara.php">Tirthankara list</a></li>
	<li><a href="map.php">Map</a></li>
	<li><a href="#contact">Contact us</a></li>';
	include 'nav.php';
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container" itemscope itemtype="http://schema.org/Person">
				<div class="row">
					<h1><center>Lord <span itemprop="name"><?php echo $name; ?></span></center></h1>
					<hr>
					<div class="col-md-6">
						<div class="sidebar">
							<div id="pic">
								<figure>
									<img alt="Photo of <?php echo $title; ?>" src="<?php echo $img; ?>" itemprop="image" />
								</figure>
							</div>
						</div>
						<table style="width:100%">
							<tr><td>Symbol</td><td><?php echo $row['tirthankarasymbol']; ?></td></tr>
							<tr><td>Color</td><td><?php echo $row['tirthankaracolor']; ?></td></tr>
							<tr><td>Height</td><td><?php echo $height; ?> bows (<?php echo $metre; ?> metres)</td></tr>
							<tr><td><td></tr>
							<tr><th colspan="2">Panchkalyanaka</th></tr>
							<tr><td>Garbha</td><td><?php echo $garbhadate; ?></td></tr>
							<tr><td>Janma</td><td><?php echo $birthdate; ?></td></tr>
							<tr><td>Diksha</td><td><?php echo $dikshadate; ?></td></tr>
							<tr><td>Kevala Gyan</td><td><?php echo $kgdate; ?></td></tr>
							<tr><td>Moksha</td><td><?php echo $mokshadate; ?></td></tr>
						</table>
						
						<hr>
						
						<!-- Facebook Comments Started -->
						<div id="fb-root"></div>
						<div class="fb-like" data-href="http://jainmunilocator.org/tirthankara.php?id='.$row["id"].'" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
						<div class="fb-comments" data-href="http://jainmunilocator.org/tirthankara.php?id='.$row["id"].'" data-numposts="5"></div>
						<!-- Facebook Comments Ended -->
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="sidebar">
							<div id="picright">
								<figure>
									<img alt="Photo of <?php echo $title; ?>" src="<?php echo $img; ?>" itemprop="image" />
								</figure>
							</div><br />
							<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
								<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
									<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
									</blockquote></div>
							</div>
							<?php include 'adsense.php'; ?>
						</div>
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.section -->
		
		<?php
	include 'contact.php';
	include 'footer2.php';
	include 'scripts.php';
		?>
		
		<script type="text/javascript" src="munis/pic.js"></script>
	</body>
	
</html>

<?php } else { include 'tirthankara/list.php'; } ?>
