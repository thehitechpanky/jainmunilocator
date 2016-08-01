<?php

include 'config.php';

$id = (int)$_GET['id'];

$q = $db->prepare('SELECT * FROM munishri, upadhis, kshullika, aryika, ganini, bhramcharya, kshullak, ailak, muni, upadhyay, ailacharya, acharya,
muni_location, history, contact WHERE id=? AND uid=upadhi AND kshullikaid=? AND aryikaid=? AND ganiniid=? AND bhramcharyaid=? AND kid=? AND ailakid=?
AND muniid=? AND upadhyayid=? AND ailacharyaid=? AND acharyaid=? AND mid=? AND historyid=? AND contactid=?');
$q->execute(array($id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id));

if ($q->rowCount() == 1) {
	
	include 'isMobile.php';
	include 'munis/getMuni.php';
	include 'munis/getGuru.php';
	include 'munis/getImg.php';
	include 'munis/getImgName.php';
	include 'munis/getName.php';
	include 'munis/getUpadhi.php';
	include 'munis/getsanghalocation.php';
	include 'munis/getsanghatimestamp.php';
	
	// When an id is entered in the url
	$getinfo = $q->fetch(PDO::FETCH_ASSOC);
	$upadhi = $getinfo['upadhi'];
	$uname = $getinfo['uname'];
	$sangha = $getinfo['sangha'];
	$birthname = $getinfo['birthname'];
	$dob = $getinfo['dob'];
	$father = $getinfo['father'];
	$mother = $getinfo['mother'];
	$spouse = $getinfo['spouse'];
	$education = $getinfo['education'];
	$dos = $getinfo['dos'];
	
	$location=$getinfo['location'];
	$lat=$getinfo['lat'];
	$lng=$getinfo['lng'];
	$locality=$getinfo['locality'];
	
	$birthplace = $getinfo['birthplace'];
	$birthlat = $getinfo['birthlat'];
	$birthlng = $getinfo['birthlng'];
	
	$website = $getinfo['website'];
	$phone = $getinfo['phone'];
	$email = $getinfo['email'];
	$facebook = $getinfo['facebook'];
	$gplus = $getinfo['gplus'];
	$youtube = $getinfo['youtube'];
	$wikipedia = $getinfo['wikipedia'];
	
	$acharyadate=$getinfo['adate'];
	$acharyaguru=$getinfo['aguru'];
	$acharyaplace=$getinfo['aplace'];
	$acharyalat=$getinfo['alat'];
	$acharyalng=$getinfo['alng'];
	
	$upadhyayadate = $getinfo['upadhyaydate'];
	$upadhyayaguru = $getinfo['upadhyayguru'];
	$upadhyayaplace = $getinfo['upadhyayplace'];
	
	$elakdate = $getinfo['ailakdate'];
	$elakguru = $getinfo['ailakguru'];
	$elakplace = $getinfo['ailakplace'];
	
	$kdate = $getinfo['kdate'];
	$kguru = $getinfo['kguru'];
	$kplace = $getinfo['kplace'];
	
	$ganinidate = $getinfo['ganinidate'];
	$ganiniguru = getmuni($getinfo['ganiniguru']);
	$ganiniplace = $getinfo['ganiniplace'];
	
	$aryikadate = $getinfo['aryikadate'];
	$aryikaguru = getmuni($getinfo['aryikaguru']);
	$aryikaplace = $getinfo['aryikaplace'];
	
	$spouse = $getinfo['spouse'];
	
	$title = getmuni($id);
	$imgName = getImgName($id);
	
	$img = "munis/uploads/{$imgName}.jpg";
	if (file_exists($img)) {} else { $img = $getinfo['img']; }
	
?>


<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<?php include 'meta.php'; ?>
		
		<title><?php echo $title; ?></title>
		
		<?php include 'stylesheets.php'; ?>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		
		<!-- Navigation -->
		<?php
	
	$navLinks = '<li><a href="/">Home</a></li>
	<li><a href="#about">'.$uname.' Shri</a></li>';
	
	if ($upadhi == 1) {
		$navLinks = $navLinks.'<li><a href="#team">Disciples</a></li>';
	}
	
	$navLinks = $navLinks.'<li><a href="#lineage">Lineage</a></li>
	<li><a href="munis/editMuni.php?id='.$id.'">Update Location / Details</a></li>
	<li><a href="munis.php">Other Monks &amp; Nuns</a></li>
	<li><a href="map.php">Map</a></li>
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
							<tr><th colspan="2"><input type="checkbox" id="follow" name="follow">&nbsp;&nbsp;Follow</th></tr>
							<?php if($dos=="0000-00-00") { ?>
							<tr><td>Last known Location</td><td>
								<div itemscope itemtype="http://schema.org/Place">
									<dialog id="setloc" class="set">
										<form action="munis/setloc.php" method="post" enctype="multipart/form-data">
											<input type="hidden" name="locid" value="<?php echo $id; ?>">
											<input type="text" id="location" name="location" value="<?php echo $location; ?>">
											<input type="hidden" id="lat" name="lat" value="<?php echo $lat; ?>">
											<input type="hidden" id="lng" name="lng" value="<?php echo $lng; ?>">
											<input type="hidden" id="locality" name="locality" value="<?php echo $locality; ?>">
											<input type="hidden" name="loceditor" class="editoremail">
											<input type="hidden" name="locmode" value="web">
											<input type="submit" value="Save">
										</form>
									</dialog>
									<?php
														  echo '<a href="../map.php"><span itemprop="address">';
														  if ($sangha > 0) {
															  echo getsanghalocation($sangha).'</span></a>';
														  } else {
															  echo $getinfo['location'].'</span></a>&nbsp;
											<a id="asetloc" href="#"><i class="material-icons">create</i></a>';
														  }
									?>
								</div>
								</td></tr>
							<tr><td>As on (date)</td><td>
								<?php  if ($sangha > 0) { echo getsanghatimestamp($sangha); } else { echo $getinfo['timestamp']; } ?></td></tr>
							<?php } if ($upadhi > 3 && $dos == '0000-00-00' && $sangha > 0) { ?>
							<tr><td>Currently with</td><td><a href="?id=<?php echo $sangha; ?>"><?php echo getmuni($sangha); ?></a></td></tr>
							<?php } if($dos=="0000-00-00") { ?>
							<dialog id="setcontact" class="set">
								<form action="munis/setcontact.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="contactid" value="<?php echo $id; ?>">
									<input type="hidden" name="contacteditor" class="editoremail">
									<input type="hidden" name="contactmode" value="web">
									<input type="submit" value="Save">
								</form>
							</dialog>
							<tr><th colspan="2" align="left">Contact&nbsp;<a id="asetcontact" href="#"><i class="material-icons">create</i></a></th></tr>
							<?php if ($website != "#" && $website != "") { ?>
							<tr><td><i class="fa fa-link"></i> Website</td>
								<td><a href="<?php echo $website; ?>" target="_blank" itemprop="url"><?php echo $website; ?></a></td></tr>
							<?php } if ($phone > 0) { ?>
							<tr><td><i class="fa fa-phone"></i> Phone</td><td><?php echo $phone; ?></td></tr>
							<?php } if ($email != 'N/A' && $email != '') { ?>
							<tr><td><i class="fa fa-envelope-o"></i> Email</td><td><a title="Email" target="" href="mailto:<?php echo $email; ?>" itemprop="email"><?php echo $email; ?></a></td></tr>
							<?php } if ($wikipedia != '#' && $wikipedia != '') { ?>
							<tr><td><i class="fa fa-wikipedia-w"></i> Wikipedia</td><td><a title="Wikipedia" target="_blank" href="<?php echo $wikipedia; ?>"><?php echo $wikipedia; ?></a></td></tr>
							<?php } ?>
							<tr><td>Social Links</td><td>
								<?php if ($facebook != '#' && $facebook != '') { ?>
								<a title="Facebook" target="_blank" href="<?php echo $facebook; ?>"><i class="fa fa-facebook fa-2x"></i></a>&nbsp;&nbsp;
								<?php } if ($gplus != '#' && $gplus != '') { ?>
								<a title="Google Plus" target="_blank" href="<?php echo $gplus; ?>"><i class="fa fa-google-plus fa-2x"></i></a>&nbsp;&nbsp;
								<?php } if ($youtube != '#' && $youtube != '') { ?>
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
	
	if($getinfo['upadhi']=="1") {echo
		'<tr><td colspan="2"></td></tr>
		<tr><dialog id="setacharya" class="set">
								<form action="munis/setpad.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="pad" value="acharya">
									<input type="hidden" name="acharyaid" value="'.$id.'">
									Date&nbsp;<input type="text" name="acharyadate" value="'.$acharyadate.'"><br />
									Guru&nbsp;<input type="text" name="acharyaguru" value="'.$acharyaguru.'"><br />
									Place&nbsp;<input type="text" id="acharyaplace" name="acharyaplace" value="'.$acharyaplace.'">
									<input type="hidden" id="acharyalat" name="acharyalat" value="'.$acharyalat.'">
									<input type="hidden" id="acharyalng" name="acharyalng" value="'.$acharyalng.'">
									<input type="hidden" name="acharyaeditor" class="editoremail">
									<input type="hidden" name="acharyamode" value="web">
									<input type="submit" value="Save">
								</form>
							</dialog></tr>
					<tr><th colspan="2" align="left">Acharya Pad Details&nbsp;<a id="asetacharya" href="#"><i class="material-icons">create</i></a></th></tr>
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
	
	if($upadhyayadate != '0000-00-00' || $upadhyayaguru > 0) {echo
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
	
	if($elakdate != '0000-00-00' || $elakguru > 0) {echo
		'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Elak Deeksha Details</th></tr>';
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
	
	if ($upadhi == 7) {
							?>
							<tr><td colspan="2"></td></tr>
							<tr><th colspan="2" align="left">Ganini Aryika Pad Details</th></tr>
							<tr><td>Date</td><td><time datetime="<?php echo $ganinidate; ?>"><?php echo $ganinidate; ?></time></td></tr>
							<tr><td>Guru</td><td><?php echo $ganiniguru; ?></td></tr>
							<tr><td>Place</td><td><?php echo $ganiniplace; ?></td></tr>
							
							<?php } if($upadhi > 6) { ?>
							
							<tr><td colspan="2"></td></tr>
							<tr><th colspan="2" align="left">Aryika Deeksha Details</th></tr>
							<tr><td>Date</td><td><?php echo $aryikadate; ?></td></tr>
							<tr><td>Guru</td><td><?php echo $aryikaguru; ?></td></tr>
							<tr><td>Place</td><td><?php echo $aryikaplace; ?></td></tr>
							
							<?php }
	
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
		<tr><dialog id="sethistory" class="set">
								<form action="munis/sethistory.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="historyid" value="'.$id.'">
									Birthname&nbsp;<input type="text" name="birthname" value="'.$birthname.'"><br />
									Date of Birth&nbsp;<input type="text" name="dob" value="'.$dob.'"><br />
									Birth Place&nbsp;<input type="text" id="birthplace" name="birthplace" value="'.$birthplace.'">
									<input type="hidden" id="birthlat" name="birthlat" value="'.$birthlat.'">
									<input type="hidden" id="birthlng" name="birthlng" value="'.$birthlng.'">
									<input type="text" name="father" value="'.$father.'">
									<input type="text" name="mother" value="'.$mother.'">
									<input type="text" name="education" value="'.$education.'">
									<input type="hidden" name="historyeditor" class="editoremail">
									<input type="hidden" name="historymode" value="web">
									<input type="submit" value="Save">
								</form>
							</dialog></tr>
				<tr><th colspan="2" align="left">History&nbsp;<a id="asethistory" href="#"><i class="material-icons">create</i></a></th></tr>
				<tr><td>Birthname</td><td><span itemprop="name">'.$getinfo['birthname'].'</span></td></tr>
				<tr><td>Date of Birth</td><td><span itemprop="birthDate">'.$getinfo['dob'].'</span></td></tr>
				<tr><td>Birth Place</td><td><span itemprop="birthPlace">'.$getinfo['birthplace'].'</span></td></tr>
				<tr><td>Father</td><td itemprop="parent">'.$getinfo['father'].'</td></tr>
				<tr><td>Mother</td><td itemprop="parent">'.$getinfo['mother'].'</td></tr>';
	if ($spouse == "") {} else {
		echo '<tr><td>Spouse</td><td>'.$getinfo['spouse'].'</td><tr>';
	}
	echo '<tr><td>Education</td><td>'.$getinfo['education'].'</td></tr>';
	
							?>							
							<tr><td colspan="2"></td></tr>
							<tr><th colspan="2" align="left">Chaturmas</th></tr>
							<?php
	$c = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? ORDER BY chaturmasyear DESC");
	$c->execute(array($id));
	while($crow = $c->fetch(PDO::FETCH_ASSOC)) {
		echo '<tr><td>'.$crow['chaturmasyear'].'</td><td>
					<div itemscope itemtype="http://schema.org/Place"><span itemprop="address">
					'.$crow['chaturmasplace'].'</span></div></td></tr>';
	}
							?>	
							
						</table>
						
						<hr>
						
						<!-- Facebook Comments Started -->
						<div id="fb-root"></div>
						<div class="fb-like" data-href="http://jainmunilocator.org/munis.php?id=<?php echo $id; ?>" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
						<div class="fb-comments" data-href="http://jainmunilocator.org/munis.php?id=<?php echo $id; ?>" data-numposts="5"></div>
						<!-- Facebook Comments Ended -->
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="sidebar">
							<div id="picright">
								<a class="btn btn-default btn-lg" href="munis/editMuni.php?id=<?php echo $id; ?>">UPDATE LOCATION / DETAILS</a><br />
								<figure>
									<img alt="Photo of <?php echo $title; ?>" src="<?php echo $img; ?>" />
								</figure>
							</div><br />
							<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
								<blockquote cite="https://www.facebook.com/jainmunilocator" class="fb-xfbml-parse-ignore">
									<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
								</blockquote>
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
						<p>Monks &amp; Nuns initiated by <?php echo $title; ?></p>
					</div><!-- /.col-md-12 -->
					
					<div class="container">
						<div class="row">
							<?php
								 $r2 = $db->query("SELECT * FROM munishri, aryika, kshullak, ailak, upadhyay, ailacharya, acharya, upadhis
								 WHERE approved=1 AND id=aryikaid AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid
								 AND upadhi=uid ORDER BY upadhi, name ASC");
								 while($row = $r2->fetch(PDO::FETCH_ASSOC)) {
									 $guruid = getguru($row["id"]);
									 if($guruid==$getinfo["id"]) {
							?>
							<div itemscope itemtype="http://schema.org/Person" class="inline">
								<a href="?id=<?php echo $row["id"]; ?>">
									<figure>
										<img src="<?php echo getImg($row["id"]); ?>" alt="<?php echo getmuni($row["id"]); ?>" height="200px" width="150px" itemprop="image">
										<figcaption><span itemprop="honorificPrefix"><?php echo $row['uname']; ?></span><br />
											<span itemprop="name"><?php echo $row['name']; ?></span></figcaption>
									</figure>
								</a>
							</div>
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
						<p>Lineage of <?php echo $title; ?></p>
					</div><!-- /.col-md-12 -->
					
					<div class="container">
						<div class="row">
							<?php
	$guruid = $id;
	while ($guruid > 0) {
		echo '<div itemscope itemtype="http://schema.org/Person" class="inline">
		<a href="?id='.$guruid.'">
		<figure>
		<img src="'.getImg($guruid).'" alt="'.getmuni($guruid).'" height="250px" width="180px" itemprop="image">
		<figcaption><span itemprop="honorificPrefix">'.getUpadhi($guruid).'</span><br /><span itemprop="name">'.getName($guruid).'</span></figcaption>
		</figure>
		</a>
		</div>';
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
	include 'map/autocomplete.php';
		?>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script type="text/javascript" src="munis/pic.js"></script>
		<script type="text/javascript" src="munis/profile.js"></script>
		<script type="text/javascript" src="munis/follow.js"></script>
		
	</body>
	
</html>

<?php } else { include 'munis/list.php'; } ?>
