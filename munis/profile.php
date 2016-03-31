<?php

include 'config.php';

$id = (int)$_GET['id'];

$q = $db->prepare('SELECT * FROM munishri, upadhis, kshullika, aryika, bhramcharya, kshullak, ailak, muni, upadhyay, ailacharya, acharya, muni_location, history, contact
						WHERE id = ? AND approved=1 AND uid=upadhi AND id=kshullikaid AND id=aryikaid AND id=bhramcharyaid AND id=kid AND id=ailakid AND id=muniid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid AND id=mid AND id=historyid AND id=contactid');
$q->execute(array($id));

if ($q->rowCount() == 1) {
	// When an id is entered in the url
	$row = $q->fetch(PDO::FETCH_ASSOC);
	$dos = $row['dos'];
	$website = $row['website'];
	
	include 'munis/getMuni.php';
	$title = getmuni($id);
?>


<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<?php include 'meta.php'; ?>
		
		<title><?php echo $title; ?></title>
		
		<?php include 'stylesheets.php'; ?>
		
	</head>
	
	<body id="home">
		
		<!-- Navigation -->
		<?php
	$navLinks = '<li><a href="#about">'.$title.'</a></li>
	<li><a href="editMuni.php?id='.$id.'"></a>Update Location / Details</li>
	<li><a href="#contact">Contact us</a></li>';
	include 'nav.php';
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container" itemscope itemtype="http://schema.org/Person">
				<div class="row">
					<h1><center><span itemprop="name"><?php echo $title; ?></span></center></h1>
					<div class="col-md-6">
						<table style="width:100%">
							<?php if($dos=="0000-00-00") { ?>
							<tr><th>Current Location</th><td>
								<div itemscope itemtype="http://schema.org/Place"><a href="../map.php"><span itemprop="address"><?php echo $row['location']; ?></span></a></div>
								</td></tr>
							<?php } if ($website != "#") { ?>
							<tr><th>Website</th>
								<td><a href="<?php echo $website; ?>" target="_blank" itemprop="url"><?php echo $website; ?></a></td></tr>
							<?php } ?>
						</table>
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<a class="btn btn-default btn-lg" href="editform.php?id=<?php echo $id; ?>">UPDATE LOCATION / DETAILS</a>
						<img alt="Photo of <?php echo $title; ?>" width="315px" src="<?php echo $row['img']; ?>" itemprop="image" />
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

<?php } else { include 'munis/list.php'; } ?>
