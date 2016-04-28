<?php

include 'config.php';

$id = (int)$_GET['id'];

$q = $db->prepare("SELECT * FROM temples, temple_links WHERE tid=? AND tlid=tid");
$q->execute(array($id));

if ($q->rowCount() == 1) {
	
	include 'isMobile.php';
	
	// When an id is entered in the url
	$row = $q->fetch(PDO::FETCH_ASSOC);
	$name = $row['tname'];
	$title = $name;
	
	$phone = $row['tphone'];
	$email = $row['temail'];
	$website = $row['twebsite'];
	$facebook = $row['tfacebook'];
	$wikipedia = $row['twikipedia'];
	
	if (file_exists('temples/uploads/'.$name.'.jpg')) {
		$img = 'temples/uploads/'.$name.'.jpg';
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
	$navLinks = $navLinks.'<li><a href="temples.php">Digambara Temples list</a></li>
	<li><a href="map.php">Map</a></li>
	<li><a href="#contact">Contact us</a></li>';
	include 'nav.php';
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container" itemscope itemtype="http://schema.org/PlaceOfWorship">
				<div class="row">
					<h1 itemprop="name"><center><?php echo $name; ?></center></h1>
					<hr>
					<div class="col-md-6">
						<div class="sidebar">
							<div id="pic">
								<figure>
									<img alt="Photo of <?php echo $title; ?>" src="<?php echo $img; ?>" itemprop="photo" />
								</figure>
							</div>
						</div>
						<table style="width:100%">
							<tr><td>Address</td><td itemprop="address"><?php echo $row['tadd']; ?></td></tr>
							<tr><td>Category</td><td><?php echo $row['tcat']; ?></td></tr>
							<tr><th colspan="2" align="left">Contact</th></tr>
							<?php if ($website != "") { ?>
							<tr><td><i class="fa fa-link"></i> Website</td>
								<td><a href="<?php echo $website; ?>" target="_blank" itemprop="url"><?php echo $website; ?></a></td></tr>
							<?php } if ($phone > 0) { ?>
							<tr><td><i class="fa fa-phone"></i> Phone</td><td itemprop="telephone"><?php echo $phone; ?></td></tr>
							<?php } if ($email != '') { ?>
							<tr><td><i class="fa fa-envelope-o"></i> Email</td><td><a title="Email" target="" href="mailto:<?php echo $email; ?>" itemprop="email"><?php echo $email; ?></a></td></tr>
							<?php } if ($wikipedia != '') { ?>
							<tr><td><i class="fa fa-wikipedia-w"></i> Wikipedia</td><td><a title="Wikipedia" target="_blank" href="<?php echo $wikipedia; ?>"><?php echo $wikipedia; ?></a></td></tr>
							<?php } ?>
							<tr><td>Social Links</td><td>
								<?php if ($facebook != '') { ?>
								<a title="Facebook" target="_blank" href="<?php echo $facebook; ?>"><i class="fa fa-facebook fa-2x"></i></a>&nbsp;&nbsp;
								</td></tr>
							<?php } ?>
							<tr><th colspan=2>History</th></tr>
							<tr><td>Year</td><td><?php echo $row['tyear']; ?></td></tr>
							<tr><td>Creator</td><td><?php echo $row['tcreator']; ?></td></tr>
						</table>
						
						<hr>
						
						<!-- Facebook Comments Started -->
						<div id="fb-root"></div>
						<div class="fb-like" data-href="http://jainmunilocator.org/temples.php?id='.$row["id"].'" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
						<div class="fb-comments" data-href="http://jainmunilocator.org/temples.php?id='.$row["id"].'" data-numposts="5"></div>
						<!-- Facebook Comments Ended -->
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="sidebar">
							<div id="picright">
								<figure>
									<img alt="Photo of <?php echo $title; ?>" src="<?php echo $img; ?>" />
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

<?php } else { include 'temples/list.php'; } ?>
