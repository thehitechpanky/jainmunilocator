<?php

include '../config.php';

$id = $_GET['id'];

if (!isset($id))
{
	header("Location: http://jainmunilocator.org/"); /* Redirect browser */
	exit();
}

$q = $db->prepare("SELECT * FROM temples, temple_links WHERE tid=? AND tlid=?");
$q->execute(array($id,$id));

if($q->rowCount() == 1) {
	$row = $q->fetch(PDO::FETCH_ASSOC);
	$name = $row['tname'];
	$title = $name;
	
	$lat = $row['tlat'];
	$lat = $row['tlng'];
	$address = $row['tadd'];
	$year = $row['tyear'];
	$cat = $row['tcat'];
	$creator = $row['tcreator'];
	
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
}
?>


<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include '../meta.php'; ?>
		
		<title><?php echo $title; ?></title>
		
		<?php
include '../stylesheets.php';
		?>
		
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="/">Home</a></li>
<li><a href="#about">Edit Page</a></li>
<li><a href="../temples.php">Temples list</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include '../nav.php'
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container">
				<div class="row">
					<h2>Edit <?php echo $name; ?> details</h2>
					
					<div class="col-md-6">						
						
						<dialog id="uploadbox" style="z-index: 10000;">
							<form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="imgId" value="<?php echo $id; ?>">
								<input type="hidden" name="imgName" value="<?php echo $name; ?>">
								<input type="file" name="fileToUpload" id="fileToUpload">
								<input type="submit" value="Upload Image" name="submit">
								<a href="#" id="closeupload">Close</a>
							</form>
						</dialog>
						
						<form id="editForm" action="edit.php" method="POST" class="hidden">
							
							<div class="image">
								<figure>
									<img id="pic" src="<?php echo $img; ?>" alt="<?php echo $title; ?>">
									<figcaption>
										<p><a href="#" title="Change Image" class="camera"><i class='fa fa-camera fa-5x'></i></a></p>
									</figcaption>
								</figure>
							</div>
							
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
							Name <input type="text" name="name" class="longBox" value="<?php echo $name; ?>" /><br /><br />
							
							<input type="hidden" name="oldaddress" value="<?php echo $address; ?>">
							Address <input type="text" id="address" name="address" class="longBox" value="<?php echo $address; ?>" /><br /><br />
							<input type="hidden" name="lat" value="<?php echo $lat; ?>">
							<input type="hidden" name="lng" value="<?php echo $lng; ?>">							
							
							Category <select name="cat" class="longBox">
							<option value="Atishay Kshetra" <?php if($cat=='Atishay Ksetra') { echo "selected"; } ?>>Atishay Ksetra</option>
							</select><br /><br />
							
							<strong>Contact Info.</strong><br />
							Phone <input type="text" name="phone" value="<?php echo $phone; ?>" /><br />
							Email <input type="text" name="email" value="<?php echo $email; ?>" /><br /><br />
							
							<strong>Links</strong><br />
							Website <input type="text" id="website" name="website" value="<?php echo $website; ?>" /><br />
							Facebook <input type="text" name="facebook" value="<?php echo $facebook; ?>" /><br />
							Wikipedia <input type="text" name="wikipedia" value="<?php echo $wikipedia; ?>" /><br /><br />
							
							<b>History</b><br />
							Year <input type="text" name="year" value="<?php echo $year; ?>" /><br />
							Creator <input type="text" name="creator" value="<?php echo $creator; ?>" /><br /><br />
							
							<input type="hidden" id="editoremail" name="editoremail">
							
							<input type="submit" value="Save" />&nbsp;&nbsp;&nbsp;
							<input type="reset" value="Reset" />&nbsp;&nbsp;&nbsp;
							<input type="button" value="Cancel" onclick="location.href='../munis.php?id=<?php echo $id; ?>';" />
							
						</form>
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="image">
							<figure>
								<img id="picright" src="<?php echo $img; ?>" alt="<?php echo $title; ?>">
								<figcaption>
									<p><a href="#" title="Change Image" class="camera"><i class='fa fa-camera fa-5x'></i></a></p>
								</figcaption>
							</figure>
						</div><div class="image">
						<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
							<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
								<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
								</blockquote>
							</div>
						</div>
						</div><div class="image">
						
						<?php include '../adsense.php'; ?>
						
						</div>
						
					</div><!-- /.col-md-6 -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
			
		</section><!-- /.section -->
		
		
		<?php
include '../contact.php';
include '../footer2.php';
include '../scripts.php';
include '../map/autocomplete.php';
		?>
		
		<script type='text/javascript' src='../munis/pic.js'></script>
		<script type='text/javascript' src='formActions.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		
	</body>
	
</html>
