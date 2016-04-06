<?php

include 'config.php';

$id = (int)$_GET['id'];

$q = $db->prepare('SELECT * FROM munishri, upadhis, kshullika, aryika, bhramcharya, kshullak, ailak, muni, upadhyay, ailacharya, acharya, muni_location, history, contact
						WHERE id = ? AND approved=1 AND uid=upadhi AND id=kshullikaid AND id=aryikaid AND id=bhramcharyaid AND id=kid AND id=ailakid AND id=muniid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid AND id=mid AND id=historyid AND id=contactid');
$q->execute(array($id));

if ($q->rowCount() == 1) {
	// When an id is entered in the url
	$getinfo = $q->fetch(PDO::FETCH_ASSOC);
	$upadhi = $getinfo['upadhi'];
	$dos = $getinfo['dos'];
	$website = $getinfo['website'];
	$phone = $getinfo['phone'];
	$email = $getinfo['email'];
	$facebook = $getinfo['facebook'];
	$gplus = $getinfo['gplus'];
	$youtube = $getinfo['youtube'];
	$wikipedia = $getinfo['wikipedia'];
	
	$kdate = $getinfo['kdate'];
	$kguru = $getinfo['kguru'];
	$kplace = $getinfo['kplace'];
	
	include 'isMobile.php';
	include 'munis/getMuni.php';
	include 'munis/getGuru.php';
	include 'munis/getImg.php';
	include 'munis/getImgName.php';
	
	$title = getmuni($id);
	$imgName = getImgName($id);
	
	if (file_exists("munis/uploads/{$imgName}.jpg")) {
		$img = "munis/uploads/{$imgName}.jpg";
	} else {
		$img = $getinfo['img'];
	}
	
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
	
	$navLinks = '<li><a href="/">Home</a></li>
	<li><a href="#about">'.$title.'</a></li>
	<li><a href="munis/editMuni.php?id='.$id.'">Update Location / Details</a></li>';
	
	if ($upadhi == 1) {
		$navLinks = $navLinks.'<li><a href="#team">Disciples</a></li>';
	}
	
	$navLinks = $navLinks.'<li><a href="munis.php">Other Monks &amp; Nuns</a></li>
	<li><a href="map.php">Locate Monks &amp; Nuns</a></li>
	<li><a href="#contact">Contact us</a></li>';
	
	include 'nav.php';
	
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container" itemscope itemtype="http://schema.org/Person">
				<div class="row">
					<h1><center><span itemprop="name"><?php echo $title; ?></span></center></h1>
					<hr>
					<div class="col-md-6">
						<div class="sidebar">
							<div id="pic"><a class="btn btn-default btn-lg" href="munis/editMuni.php?id=<?php echo $id; ?>">
								UPDATE LOCATION / DETAILS</a><br />
								<figure>
									<img alt="Photo of <?php echo $title; ?>" src="<?php echo $img; ?>" itemprop="image" />
								</figure>
							</div>
						</div>
						<table style="width:100%">
							<?php if($dos=="0000-00-00") { ?>
							<tr><td>Current Location</td><td>
								<div itemscope itemtype="http://schema.org/Place"><a href="../map.php"><span itemprop="address"><?php echo $getinfo['location']; ?></span></a></div>
								</td></tr>
							<?php } if($dos=="0000-00-00") { ?>
							<tr><th colspan="2" align="left">Contact</th></tr>
							<?php if ($website != "#") { ?>
							<tr><td><i class="fa fa-link"></i> Website</td>
								<td><a href="<?php echo $website; ?>" target="_blank" itemprop="url"><?php echo $website; ?></a></td></tr>
							<?php } if ($phone > 0) { ?>
							<tr><td><i class="fa fa-phone"></i> Phone</td><td><?php echo $phone; ?></td></tr>
							<?php } if ($email != 'N/A') { ?>
							<tr><td><i class="fa fa-envelope-o"></i> Email</td><td><a title="Email" target="" href="mailto:<?php echo $email; ?>" itemprop="email"><?php echo $email; ?></a></td></tr>
							<?php } if ($wikipedia != '#') { ?>
							<tr><td><i class="fa fa-wikipedia-w"></i> Wikipedia</td><td><a title="Wikipedia" target="_blank" href="<?php echo $wikipedia; ?>"><?php echo $wikipedia; ?></a></td></tr>
							<?php } ?>
							<tr><td>Social Links</td><td>
								<?php if ($facebook != '#') { ?>
								<a title="Facebook" target="_blank" href="<?php echo $facebook; ?>"><i class="fa fa-facebook fa-2x"></i></a>&nbsp;&nbsp;
								<?php } if ($gplus != '#') { ?>
								<a title="Google Plus" target="_blank" href="<?php echo $gplus; ?>"><i class="fa fa-google-plus fa-2x"></i></a>&nbsp;&nbsp;
								<?php } if ($youtube != '#') { ?>
								<a title="Youtube" target="_blank" href="<?php echo $youtube; ?>"><i class="fa fa-youtube fa-2x"></i></a>&nbsp;&nbsp;
								<?php } ?>
								</td></tr>
							<?php } if($dos != "0000-00-00") { ?>
							<tr><td colspan="2"></td></tr>
							<tr><th colspan="2" align="left">Samadhi Details</th></tr>
							<tr><td>Date</td><td><span itemprop="deathDate"><?php echo $dos; ?></span></td></tr>
							<tr><td>Place</td><td><span itemprop="deathPlace"><?php echo $getinfo['samadhiplace']; ?></span></td></tr>
							<?php } ?>
							<tr><td colspan="2"></td></tr>
							<tr><th colspan="2" align="left">Books</th></tr>
							<?php
	$b = $db->prepare("SELECT * FROM books WHERE bguru = '$id'");
	$b->execute();
	while($brow = $b->fetch(PDO::FETCH_ASSOC)) {
		$i++;
		echo '<tr><td colspan="2"><div class="hoverImg" itemscope itemtype="http://schema.org/Book">
					<a href="'.$brow['blink'].'" itemprop="url">'.$i.' <span itemprop="name">'.$brow['bname'].'</span>
					<img class="smallLight" src="'.$brow['bimg'].'" alt="'.$brow['bname'].'" itemprop="image" />
					</a></div></td></tr>';
	}
							?>
							<tr><td colspan="2"></td></tr>
							<tr><th colspan="2" align="left">Chaturmas</th></tr>
							<?php
	$c = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni='$id' AND chaturmasplace!='N/A'");
	$c->execute();
	while($crow = $c->fetch(PDO::FETCH_ASSOC)) {
		echo '<tr><td>'.$crow['chaturmasyear'].'</td><td>
					<div itemscope itemtype="http://schema.org/Place"><span itemprop="address">
					'.$crow['chaturmasplace'].'</span></div></td></tr>';
	}
	
	if($getinfo['upadhi']=="1") {echo
		'<tr><td colspan="2"></td></tr>
					<tr><th colspan="2" align="left">Acharya Pad Details</th></tr>
					<tr><td>Date</td><td><time datetime="'.$getinfo['adate'].'">'.$getinfo['adate'].'</time></td></tr>
					<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['aguru'].'">'.getmuni($getinfo['aguru']).'
					<img class="smallLight" src="'.getImg($getinfo['aguru']).'" alt="'.getmuni($getinfo['aguru']).'" />
					</a></div></td></tr>
					<tr><td>Place</td><td>'.$getinfo['aplace'].'</td></tr>'
		;}
	
	if($getinfo['ailacharyaguru']>0) {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Elacharya Pad Details</th></tr>';
									  if($getinfo['ailacharyaname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['ailacharyaname'].'</td></tr>';}
									  echo '<tr><td>Date</td><td>'.$getinfo['ailacharyadate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['ailacharyaguru'].'">'.getmuni($getinfo['ailacharyaguru']).'
				<img class="smallLight" src="'.getImg($getinfo['ailacharyaguru']).'" alt="'.getmuni($getinfo['ailacharyaguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['ailacharyaplace'].'</td></tr>'
										  ;}
	
	if($getinfo['upadhyayguru']>0) {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Upadhyay Pad Details</th></tr>';
									if($getinfo['upadhyayname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['upadhyayname'].'</td></tr>';}
									echo '<tr><td>Date</td><td>'.$getinfo['upadhyaydate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['upadhyayguru'].'">'.getmuni($getinfo['upadhyayguru']).'
				<img class="smallLight" src="'.getImg($getinfo['upadhyayguru']).'" alt="'.getmuni($getinfo['upadhyayguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['upadhyayplace'].'</td></tr>'
										;}
	
	if($getinfo['upadhi']<5) {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Muni Deeksha Details</th></tr>';
							  if($getinfo['muniname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['muniname'].'</td></tr>';}
							  echo '<tr><td>Date</td><td>'.$getinfo['munidate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['muniguru'].'">'.getmuni($getinfo['muniguru']).'
				<img class="smallLight" src="'.getImg($getinfo['muniguru']).'" alt="'.getmuni($getinfo['muniguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['muniplace'].'</td></tr>'
								  ;}
	
	if($getinfo['ailakguru']>0) {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Ailak Deeksha Details</th></tr>';
								 if($getinfo['ailakname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['ailakname'].'</td></tr>';}
								 echo '<tr><td>Date</td><td>'.$getinfo['ailakdate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['ailakguru'].'">'.getmuni($getinfo['ailakguru']).'
				<img class="smallLight" src="'.getImg($getinfo['ailakguru']).'" alt="'.getmuni($getinfo['ailakguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['ailakplace'].'</td></tr>'
									 ;}
	
	if ($kdate != '0000-00-00' || $kguru > 0) {
		echo
			'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Kshullak Deeksha Details</th></tr>';
		if($getinfo['kname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['kname'].'</td></tr>';}
		echo '<tr><td>Date</td><td>'.$kdate.'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['kguru'].'">'.getmuni($getinfo['kguru']).'
				<img class="smallLight" src="'.getImg($getinfo['kguru']).'" alt="'.getmuni($getinfo['kguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['kplace'].'</td></tr>';
	}
	
	if($getinfo['upadhi']==7) {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Aryika Deeksha Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['aryikadate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['aryikaguru'].'">'.getmuni($getinfo['aryikaguru']).'
				<img class="smallLight" src="'.getImg($getinfo['aryikaguru']).'" alt="'.getmuni($getinfo['aryikaguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['aryikaplace'].'</td></tr>'
		;}
	
	if($getinfo['kshullikaguru']>0) {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Kshullika Deeksha Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['kshullikadate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['kshullikaguru'].'">'.getmuni($getinfo['kshullikaguru']).'
				<img class="smallLight" src="'.getImg($getinfo['kshullikaguru']).'" alt="'.getmuni($getinfo['kshullikaguru']).'" /></a><div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['kshullikaplace'].'</td></tr>'
		;}
	
	if($getinfo['bhramcharyadate']!="0000-00-00" or $getinfo['bhramcharyaguru']>0 or $getinfo['bhramcharyaplace']!="N/A") {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Bhramcharya (Seventh Pratima) Vrat Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['bhramcharyadate'].'</td></tr>'
		;}
	
	if($getinfo['bhramcharyaguru']>0) {echo
		'<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['bhramcharyaguru'].'">'.getmuni($getinfo['bhramcharyaguru']).'
					<img class="smallLight" src="'.getImg($getinfo['bhramcharyaguru']).'" alt="'.getmuni($getinfo['bhramcharyaguru']).'" />
					</a></div></td></tr>'
		;}
	
	if(($getinfo['bhramcharyadate']!="0000-00-00" or $getinfo['bhramcharyaplace']!="N/A") && ($getinfo['bhramcharyaguru']==0)) {echo
		'<tr><td>Taken By</td><td>Self</td></tr>'
		;}
	
	if($getinfo['bhramcharyadate']!="0000-00-00" or $getinfo['bhramcharyaguru']>0 or $getinfo['bhramcharyaplace']!="N/A") {echo
		'<tr><td>Place</td><td>'.$getinfo['bhramcharyaplace'].'</td></tr>'
		;}
	
	if($getinfo['vairagya']!="0000-00-00" or $getinfo['grahtyag']!="0000-00-00") {echo
		'<tr><td colspan="2"></td></tr>'
		;}
	
	if($getinfo['vairagya']!="0000-00-00") {echo
		'<tr><td>Vairagya</td><td>'.$getinfo['vairagya'].'</td></tr>'
		;}
	
	if($getinfo['grahtyag']!="0000-00-00") {echo
		'<tr><td>Grah Tyag</td><td>'.$getinfo['grahtyag'].'</td></tr>'
		;}
	
	echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">History</th></tr>
				<tr><td>Birthname</td><td><span itemprop="name">'.$getinfo['birthname'].'</span></td></tr>
				<tr><td>Date of Birth</td><td><span itemprop="birthDate">'.$getinfo['dob'].'</span></td></tr>
				<tr><td>Birth Place</td><td><span itemprop="birthPlace">'.$getinfo['birthplace'].'</span></td></tr>
				<tr><td>Father</td><td>'.$getinfo['father'].'</td></tr>
				<tr><td>Mother</td><td>'.$getinfo['mother'].'</td></tr>
				<tr><td>Spouse</td><td>'.$getinfo['spouse'].'</td><tr>
				<tr><td>Education</td><td>'.$getinfo['education'].'</td></tr>';
	
							?>
							
						</table>
						
						<hr>
						
						<!-- Facebook Comments Started -->
						<div id="fb-root"></div>
						<div class="fb-like" data-href="http://jainmunilocator.org/munis.php?id='.$getinfo["id"].'" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
						<div class="fb-comments" data-href="http://jainmunilocator.org/munis.php?id='.$getinfo["id"].'" data-numposts="5"></div>
						<!-- Facebook Comments Ended -->
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="sidebar">
							<div id="picright">
								<a class="btn btn-default btn-lg" href="munis/editMuni.php?id=<?php echo $id; ?>">UPDATE LOCATION / DETAILS</a><br />
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
		
		<?php if ($upadhi == 1) { ?>
		<!-- Our team Section -->
		<section id="team" class="team content-section">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-12">
						<h2>Disciples</h2>
						<p>Monks &amp; Nuns initiated by <?php echo $title; ?><p>
						</div><!-- /.col-md-12 -->
					<div class="container">
						<div class="row">
							<?php
								 $r2 = $db->query("SELECT * FROM munishri, aryika, kshullak, ailak, upadhyay, ailacharya, acharya WHERE approved=1 AND id=aryikaid AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid ORDER BY upadhi, name ASC");
								 while($row = $r2->fetch(PDO::FETCH_ASSOC)) {
									 $guruid = getguru($row["id"]);
									 if($guruid==$getinfo["id"]) {
							?>
							&nbsp;<a href="?id=<?php echo $row["id"]; ?>">
							<img src="<?php echo getImg($row["id"]); ?>" alt="<?php echo getmuni($row["id"]); ?>" height="200px" width="150px">
							</a>&nbsp;
							<?php
									 }
								 }
							?>
						</div><!-- /.row -->
					</div><!-- /.container -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.our-team -->
		
		<?php } ?>
		
		<!-- Our team Section -->
		<section id="lineage" class="team content-section">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-12">
						<h2>Lineage</h2>
						<p>Lineage of <?php echo $title; ?><p>
						</div><!-- /.col-md-12 -->
					<div class="container">
						<div class="row">
							<?php
	$guruid = $id;
	while ($guruid > 0) {
		echo '&nbsp;<a href="?id='.$guruid.'"><img src="'.getImg($guruid).'" alt="'.getmuni($guruid).'" title="'.getmuni($guruid).'" height="250px" width="180px"></a>&nbsp;';
		$guruid = getguru($guruid);
	}
	
							?>
						</div><!-- /.row -->
					</div><!-- /.container -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.our-team -->
		
		<?php
	include 'contact.php';
	include 'footer2.php';
	include 'scripts.php';
		?>
		
		<script type="text/javascript" src="munis/pic.js"></script>
	</body>
	
</html>

<?php } else { include 'munis/list.php'; } ?>
