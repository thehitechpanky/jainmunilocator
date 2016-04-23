<?php

include '../config.php';
include 'getMuni.php';
include 'getImgName.php';

$id = $_GET['id'];
$q = $db->prepare("SELECT * FROM munishri, upadhis, muni_location, history, contact, acharya, ailacharya, upadhyay, muni, ailak, kshullak, aryika, kshullika, bhramcharya
				WHERE id=? AND upadhi=uid AND id=mid AND id=historyid AND id=contactid AND id=acharyaid AND id=ailacharyaid AND id=upadhyayid AND id=muniid AND id=ailakid AND id=kid AND id=aryikaid AND id=kshullikaid AND id=bhramcharyaid");
$q->execute(array($id));

if($q->rowCount() == 1) {
	$row = $q->fetch(PDO::FETCH_ASSOC);
	$id = $row['id'];
	$upadhi = $row['upadhi'];
	$title = getmuni($id);
	$imgName = getImgName($id);
	if (file_exists("uploads/{$imgName}.jpg")) {
		$img = "uploads/{$imgName}.jpg";
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
<li><a href="../munis.php">Monk list</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include '../nav.php'
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container">
				<div class="row">
					<h2>Edit <?php echo $row['uname']; ?> Shri details</h2>
					
					<div class="col-md-6">						
						
						<dialog id="uploadbox" style="z-index: 10000;">
							<form action="upload.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="imgId" value="<?php echo $id; ?>">
								<input type="hidden" name="imgUname" value="<?php echo $row['uname']; ?>">
								<input type="hidden" name="imgName" value="<?php echo $row['name']; ?>">
								<input type="hidden" name="imgAlias" value="<?php echo $row['alias']; ?>">
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
							
							<input type="hidden" name="ids" value="<?php echo $id; ?>" />
							
							<b>Name</b><br />							
							<input type="text" id="title" name="title" class="verySmallBox" placeholder="Title" value="<?php echo $row['title']; ?>">
							<select id="upadhi" name="upadhi" class="mediumBox">
								<option value="0" disabled selected>Upadhi</option>
								<option value="1" <?php if($upadhi==1) { echo "selected"; } ?>>Acharya</option>
								<option value="2" <?php if($upadhi==2) { echo "selected"; } ?>>Elacharya</option>
								<option value="3" <?php if($upadhi==3) { echo "selected"; } ?>>Upadhyay</option>
								<option value="4" <?php if($upadhi==4) { echo "selected"; } ?>>Muni</option>
								<option value="5" <?php if($upadhi==5) { echo "selected"; } ?>>Elak</option>
								<option value="6" <?php if($upadhi==6) { echo "selected"; } ?>>Kshullak</option>
								<option value="7" <?php if($upadhi==7) { echo "selected"; } ?>>Aryika</option>
								<option value="8" <?php if($upadhi==8) { echo "selected"; } ?>>Kshullika</option>
							</select>
							<div id="prefix_here" class="inline"></div>
							<input type="text" id="name" name="name" class="smallBox" placeholder="Name" value="<?php echo $row['name']; ?>" />
							<div id="suffix_here" class="inline"></div>
							<input type="text" id="alias" name="alias" class="verySmallBox" placeholder="Alias" value="<?php echo $row['alias']; ?>" /><br /><br />
							
							<?php if($row['dos']=="0000-00-00") { ?>
							<strong>Current Location</strong><br />
							<input type="hidden" name="oldlocation" value="<?php echo $row['location']; ?>">
							<input type="text" id="location" name="location" class="longBox" value="<?php echo $row['location']; ?>" /><br /><br />
							<?php } ?>
							
							Website Link<input type="text" id="website" name="website" value="<?php echo $row['website']; ?>" /><br /><br />
							
							<strong>Contact Info</strong><br />
							Contact No.<input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" /><br />
							Email ID<input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" /><br />
							Facebook<input type="text" id="facebook" name="facebook" value="<?php echo $row['facebook']; ?>" /><br />
							GPlus<input type="text" id="gplus" name="gplus" value="<?php echo $row['gplus']; ?>" /><br />
							Youtube<input type="text" id="youtube" name="youtube" value="<?php echo $row['youtube']; ?>" /><br />
							Wikipedia<input type="text" id="wikipedia" name="wikipedia" value="<?php echo $row['wikipedia']; ?>" /><br /><br />
							
							<strong>Samadhi Details (If applicable)</strong><br />
							Date in YYYY-MM-DD<input type="text" id="dos" name="dos" class="smallBox" value="<?php echo $row['dos']; ?>" /><br />
							Place<input type="text" id="samadhiplace" name="samadhiplace" class="longBox" value="<?php echo $row['samadhiplace']; ?>"/><br /><br />
							
							<strong>Chaturmas</strong><br />
							<?php
if($row['dos']=="0000-00-00") {
	$latestChaturmasYear = $currentYear;
} else {	
	$latestChaturmasYear = date('Y', strtotime($row['dos']));
}

$firstChaturmasYear = $latestChaturmasYear;
if(date('Y', strtotime($row['munidate'])) > 1000) {
	$firstChaturmasYear = date('Y', strtotime($row['munidate']));
}
if(date('Y', strtotime($row['ailakdate'])) > 1000) {
	$firstChaturmasYear = date('Y', strtotime($row['ailakdate']));
}
if(date('Y', strtotime($row['kdate'])) > 1000) {
	$firstChaturmasYear = date('Y', strtotime($row['kdate']));
}
if(date('Y', strtotime($row['aryikadate'])) > 1000) {
	$firstChaturmasYear = date('Y', strtotime($row['aryikadate']));
}
if(date('Y', strtotime($row['kshullikadate'])) > 1000) {
	$firstChaturmasYear = date('Y', strtotime($row['kshullikadate']));
}

echo $latestChaturmasYear;
$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
$q->execute(array($id,$latestChaturmasYear));
$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace" name="chaturmasplace" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid" name="chaturmasid" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="latestChaturmasYear" name="latestChaturmasYear" value="<?php echo $latestChaturmasYear; ?>" />							
							<?php
$year2 = $latestChaturmasYear - 1;
if ($year2 > $firstChaturmasYear) {
	echo $year2;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year2));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace2" name="chaturmasplace2" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid2" name="chaturmasid2" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year2" name="year2" value="<?php echo $year2; ?>" />
							<?php
}
$year3 = $latestChaturmasYear - 2;
if ($year3 > $firstChaturmasYear) {
	echo $year3;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year3));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace3" name="chaturmasplace3" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid3" name="chaturmasid3" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year3" name="year3" value="<?php echo $year3; ?>" />
							<?php
}
$year4 = $latestChaturmasYear - 3;
if ($year4 > $firstChaturmasYear) {
	echo $year4;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year4));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace4" name="chaturmasplace4" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid4" name="chaturmasid4" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year4" name="year4" value="<?php echo $year4; ?>" />
							<?php
}
$year5 = $latestChaturmasYear - 4;
if ($year5 > $firstChaturmasYear) {
	echo $year5;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year5));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace5" name="chaturmasplace5" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid5" name="chaturmasid5" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year5" name="year5" value="<?php echo $year5; ?>" />
							<?php
}
$year6 = $latestChaturmasYear - 5;
if ($year6 > $firstChaturmasYear) {
	echo $year6;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year6));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace6" name="chaturmasplace6" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid6" name="chaturmasid6" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year6" name="year6" value="<?php echo $year6; ?>" />
							<?php
}
$year7 = $latestChaturmasYear - 6;
if ($year7 > $firstChaturmasYear) {
	echo $year7;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year7));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace7" name="chaturmasplace7" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid7" name="chaturmasid7" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year5" name="year7" value="<?php echo $year7; ?>" />
							<?php
}
$year8 = $latestChaturmasYear - 7;
if ($year8 > $firstChaturmasYear) {
	echo $year8;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year8));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace8" name="chaturmasplace8" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid8" name="chaturmasid8" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year8" name="year8" value="<?php echo $year8; ?>" />
							<?php
}
$year9 = $latestChaturmasYear - 8;
if ($year9 > $firstChaturmasYear) {
	echo $year9;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
	$q->execute(array($id,$year9));
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
							?>
							<input type="text" id="chaturmasplace9" name="chaturmasplace9" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br />
							<input type="hidden" id="chaturmasid9" name="chaturmasid9" value="<?php echo $row2['chaturmasid']; ?>" />
							<input type="hidden" id="year9" name="year9" value="<?php echo $year9; ?>" />
							<?php } ?><br />
							
							<div id="acharya" class="">
								<b>Acharya Pad Details</b><br />
								Date in YYYY-MM-DD <input type="text" id="adate" name="adate" class="smallBox" value="<?php echo $row['adate']; ?>" /><br />
								Guru <input type="text" id="aguru" value="<?php echo getmuni($row['aguru']); ?>" list="aguruList" >
								<datalist id="aguruList">
								</datalist>
								<input type="hidden" name="aguru" id="aguruHidden" value="<?php echo $row['aguru']; ?>" /><br />
								Place <input type="text" id="aplace" name="aplace" class="longBox" value="<?php echo $row['aplace']; ?>"/><br /><br />
							</div>
							
							<div id="ailacharya" class="">
								<b>Elacharya Pad Details</b><br />
								Name<input type="text" id="ailacharyaname" name="ailacharyaname" value="<?php echo $row['ailacharyaname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="ailacharyadate" name="ailacharyadate" class="smallBox" value="<?php echo $row['ailacharyadate']; ?>" /><br />
								Guru ID<input type="text" id="ailacharyaguru" name="ailacharyaguru" value="<?php echo $row['ailacharyaguru']; ?>" /><br />
								Place<input type="text" id="ailacharyaplace" name="ailacharyaplace" class="longBox" value="<?php echo $row['ailacharyaplace']; ?>"/><br /><br />
							</div>
							
							<div id="upadhyay" class="">
								<b>Upadhyay Pad Details</b><br />
								Name<input type="text" id="upadhyayname" name="upadhyayname" value="<?php echo $row['upadhyayname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="upadhyaydate" name="upadhyaydate" class="smallBox" value="<?php echo $row['upadhyaydate']; ?>" /><br />
								Guru ID<input type="text" id="upadhyayguru" name="upadhyayguru" value="<?php echo $row['upadhyayguru']; ?>" /><br />
								Place<input type="text" id="upadhyayplace" name="upadhyayplace" class="longBox" value="<?php echo $row['upadhyayplace']; ?>"/><br /><br />
							</div>
							
							<div id="muni" class="">
								<b>Muni Deeksha Details</b><br />
								Name<input type="text" id="muniname" name="muniname" value="<?php echo $row['muniname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="munidate" name="munidate" class="smallBox" value="<?php echo $row['munidate']; ?>" /><br />
								Guru ID<input type="text" id="muniguru" name="muniguru" value="<?php echo $row['muniguru']; ?>" /><br />
								Place<input type="text" id="muniplace" name="muniplace" class="longBox" value="<?php echo $row['muniplace']; ?>"/><br /><br />
							</div><br />
							
							<div id="ailak" class="">
								<b>Elak Deeksha Details</b><br />
								Name<input type="text" id="ailakname" name="ailakname" value="<?php echo $row['ailakname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="ailakdate" name="ailakdate" class="smallBox" value="<?php echo $row['ailakdate']; ?>" /><br />
								Guru ID<input type="text" id="ailakguru" name="ailakguru" value="<?php echo $row['ailakguru']; ?>" /><br />
								Place<input type="text" id="ailakplace" name="ailakplace" class="longBox" value="<?php echo $row['ailakplace']; ?>"/><br /><br />
							</div>
							
							<div id="kshullak" class="">
								<b>Kshullak Deeksha Details</b><br />
								Name<input type="text" id="kname" name="kname" value="<?php echo $row['kname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="kdate" name="kdate" class="smallBox" value="<?php echo $row['kdate']; ?>" /><br />
								Guru ID<input type="text" name="kguru" id="kguru" value="<?php echo $row['kguru']; ?>" /><br />
								Place<input type="text" id="kplace" name="kplace" class="longBox" value="<?php echo $row['kplace']; ?>" /><br /><br />
							</div>
							
							<div id="aryika" class="">
								<b>Aryika Deeksha Details</b><br />
								Date in YYYY-MM-DD<input type="text" id="aryikadate" name="aryikadate" class="smallBox" value="<?php echo $row['aryikadate']; ?>" /><br />
								Guru ID<input type="text" id="aryikaguru" name="aryikaguru" value="<?php echo $row['aryikaguru']; ?>" /><br />
								Place<input type="text" id="aryikaplace" name="aryikaplace" class="longBox" value="<?php echo $row['aryikaplace']; ?>" /><br /><br />
							</div>
							
							<div id="kshullika" class="">
								<b>Kshullika Deeksha Details</b><br />
								Date in YYYY-MM-DD<input type="text" id="kshullikadate" name="kshullikadate" class="smallBox" value="<?php echo $row['kshullikadate']; ?>" /><br />
								Guru ID<input type="text" id="kshullikaguru" name="kshullikaguru" value="<?php echo $row['kshullikaguru']; ?>" /><br />
								Place<input type="text" id="kshullikaplace" name="kshullikaplace" class="longBox" value="<?php echo $row['kshullikaplace']; ?>" /><br /><br />
							</div>
							
							<b>Bhramcharya (Seventh Pratima) Vrat Details</b><br />
							Date in YYYY-MM-DD<input type="text" id="bhramcharyadate" name="bhramcharyadate" class="smallBox" value="<?php echo $row['bhramcharyadate']; ?>" /><br />
							Guru ID<input type="text" id="bhramcharyaguru" name="bhramcharyaguru" value="<?php echo $row['bhramcharyaguru']; ?>" /><br />
							Place<input type="text" id="bhramcharyaplace" name="bhramcharyaplace" class="longBox" value="<?php echo $row['bhramcharyaplace']; ?>" /><br /><br />
							
							Vairagya Date in YYYY-MM-DD<input type="text" id="vairagya" name="vairagya" class="smallBox" value="<?php echo $row['vairagya']; ?>" /><br />
							Grahtyag Date in YYYY-MM-DD<input type="text" id="grahtyag" name="grahtyag" class="smallBox" value="<?php echo $row['grahtyag']; ?>" /><br /><br />
							
							<b>History</b><br />
							Birthname <input type="text" id="birthname" name="birthname" value="<?php echo $row['birthname']; ?>" /><br />
							Date of Birth <input type="text" id="dob" name="dob" class="smallBox" value="<?php echo $row['dob']; ?>" /><br />
							Father <input type="text" id="father" name="father" value="<?php echo $row['father']; ?>" /><br />
							Mother <input type="text" id="mother" name="mother" value="<?php echo $row['mother']; ?>" /><br />
							Spouse <input type="text" id="spouse" name="spouse" value="<?php echo $row['spouse']; ?>" /><br />
							Birthplace <input type="text" id="birthplace" name="birthplace" class="longBox" value="<?php echo $row['birthplace']; ?>" /><br />
							Education <input type="text" id="education" name="education" value="<?php echo $row['education']; ?>" /><br /><br />
							
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
		
		<script type='text/javascript' src='pic.js'></script>
		<script type='text/javascript' src='formActions.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		
	</body>
	
</html>
