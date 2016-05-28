<?php

include '../config.php';
include 'getMuni.php';
include 'getImgName.php';

$id = $_GET['id'];

if (!isset($id))
{
	header("Location: http://jainmunilocator.org/"); /* Redirect browser */
	exit();
}

$q = $db->prepare("SELECT * FROM munishri, upadhis, muni_location, history, contact, acharya, ailacharya, upadhyay, muni, ailak, kshullak, ganini,
aryika, kshullika, bhramcharya WHERE id=? AND upadhi=uid AND mid=? AND historyid=? AND contactid=? AND acharyaid=? AND ailacharyaid=? AND upadhyayid=?
AND muniid=? AND ailakid=? AND kid=? AND ganiniid=? AND aryikaid=? AND kshullikaid=? AND bhramcharyaid=?");
$q->execute(array($id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id));

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
								<option value="7" <?php if($upadhi==7) { echo "selected"; } ?>>Ganini Aryika</option>
								<option value="8" <?php if($upadhi==8) { echo "selected"; } ?>>Aryika</option>
								<option value="9" <?php if($upadhi==9) { echo "selected"; } ?>>Kshullika</option>
							</select>
							<div id="prefix_here" class="inline"></div>
							<input type="text" id="name" name="name" class="smallBox" placeholder="Name" value="<?php echo $row['name']; ?>" />
							<div id="suffix_here" class="inline"></div>
							<input type="text" id="alias" name="alias" class="verySmallBox" placeholder="Alias" value="<?php echo $row['alias']; ?>" /><br /><br />
							
							<?php if($row['dos']=="0000-00-00") { ?>
							<strong>Current Location</strong><br />
							<input type="hidden" name="oldlocation" value="<?php echo $row['location']; ?>">
							<input type="text" id="location" name="location" class="longBox" value="<?php echo $row['location']; ?>" /><br /><br />
							<input type="hidden" id="locationlat" name="locationlat" value="<?php echo $row['lat']; ?>" >
							<input type="hidden" id="locationlng" name="locationlng" value="<?php echo $row['lng']; ?>" >
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
							<input type="hidden" id="samadhilat" name="samadhilat" value="<?php echo $row['samadhilat']; ?>">
							<input type="hidden" id="samadhilng" name="samadhilng" value="<?php echo $row['samadhilng']; ?>">
							
							<div id="acharya" class="">
								<b>Acharya Pad Details</b><br />
								Date in YYYY-MM-DD <input type="text" id="adate" name="adate" class="smallBox" value="<?php echo $row['adate']; ?>" /><br />
								Guru <input type="text" id="aguru" value="<?php echo getmuni($row['aguru']); ?>" list="aguruList" >
								<datalist id="aguruList">
								</datalist>
								<input type="hidden" name="aguru" id="aguruHidden" value="<?php echo $row['aguru']; ?>" /><br />
								Place <input type="text" id="aplace" name="aplace" class="longBox" value="<?php echo $row['aplace']; ?>"/><br /><br />
								<input type="hidden" id="alat" name="alat" value="<?php echo $row['alat']; ?>">
								<input type="hidden" id="alng" name="alng" value="<?php echo $row['alng']; ?>">
							</div>
							
							<div id="ailacharya" class="">
								<b>Elacharya Pad Details</b><br />
								Name<input type="text" id="ailacharyaname" name="ailacharyaname" value="<?php echo $row['ailacharyaname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="ailacharyadate" name="ailacharyadate" class="smallBox" value="<?php echo $row['ailacharyadate']; ?>" /><br />
								Guru ID<input type="text" id="ailacharyaguru" name="ailacharyaguru" value="<?php echo $row['ailacharyaguru']; ?>" /><br />
								Place<input type="text" id="ailacharyaplace" name="ailacharyaplace" class="longBox" value="<?php echo $row['ailacharyaplace']; ?>"/><br /><br />
								<input type="hidden" id="ailacharyalat" name="ailacharyalat" value="<?php echo $row['ailacharyalat']; ?>">
								<input type="hidden" id="ailacharyalng" name="ailacharyalng" value="<?php echo $row['ailacharyalng']; ?>">
							</div>
							
							<div id="upadhyay" class="">
								<b>Upadhyay Pad Details</b><br />
								Name<input type="text" id="upadhyayname" name="upadhyayname" value="<?php echo $row['upadhyayname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="upadhyaydate" name="upadhyaydate" class="smallBox" value="<?php echo $row['upadhyaydate']; ?>" /><br />
								Guru ID<input type="text" id="upadhyayguru" name="upadhyayguru" value="<?php echo $row['upadhyayguru']; ?>" /><br />
								Place<input type="text" id="upadhyayplace" name="upadhyayplace" class="longBox" value="<?php echo $row['upadhyayplace']; ?>"/><br /><br />
								<input type="hidden" id="upadhyaylat" name="upadhyaylat" value="<?php echo $row['upadhyaylat']; ?>">
								<input type="hidden" id="upadhyaylng" name="upadhyaylng" value="<?php echo $row['upadhyaylng']; ?>">
							</div>
							
							<div id="muni" class="">
								<b>Muni Deeksha Details</b><br />
								Name<input type="text" id="muniname" name="muniname" value="<?php echo $row['muniname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="munidate" name="munidate" class="smallBox" value="<?php echo $row['munidate']; ?>" /><br />
								Guru ID<input type="text" id="muniguru" name="muniguru" value="<?php echo $row['muniguru']; ?>" /><br />
								Place<input type="text" id="muniplace" name="muniplace" class="longBox" value="<?php echo $row['muniplace']; ?>"/><br /><br />
								<input type="hidden" id="munilat" name="munilat" value="<?php echo $row['munilat']; ?>">
								<input type="hidden" id="munilng" name="munilng" value="<?php echo $row['munilng']; ?>">
							</div><br />
							
							<div id="ailak" class="">
								<b>Elak Deeksha Details</b><br />
								Name<input type="text" id="ailakname" name="ailakname" value="<?php echo $row['ailakname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="ailakdate" name="ailakdate" class="smallBox" value="<?php echo $row['ailakdate']; ?>" /><br />
								Guru ID<input type="text" id="ailakguru" name="ailakguru" value="<?php echo $row['ailakguru']; ?>" /><br />
								Place<input type="text" id="ailakplace" name="ailakplace" class="longBox" value="<?php echo $row['ailakplace']; ?>"/><br /><br />
								<input type="hidden" id="ailaklat" name="ailaklat" value="<?php echo $row['ailaklat']; ?>">
								<input type="hidden" id="ailaklng" name="ailaklng" value="<?php echo $row['ailaklng']; ?>">
							</div>
							
							<div id="kshullak" class="">
								<b>Kshullak Deeksha Details</b><br />
								Name<input type="text" id="kname" name="kname" value="<?php echo $row['kname']; ?>" /><br />
								Date in YYYY-MM-DD<input type="text" id="kdate" name="kdate" class="smallBox" value="<?php echo $row['kdate']; ?>" /><br />
								Guru ID<input type="text" name="kguru" id="kguru" value="<?php echo $row['kguru']; ?>" /><br />
								Place<input type="text" id="kplace" name="kplace" class="longBox" value="<?php echo $row['kplace']; ?>" /><br /><br />
								<input type="hidden" id="klat" name="klat" value="<?php echo $row['klat']; ?>">
								<input type="hidden" id="klng" name="klng" value="<?php echo $row['klng']; ?>">
							</div>
							
							<div id="ganini" class="">
								<strong>Ganini Aryika Pad Details</strong><br />
								Date in YYYY-MM-DD<input type="text" id="ganinidate" name="ganinidate" class="smallBox" value="<?php echo $row['ganinidate']; ?>"><br />
								Guru ID<input type="text" id="ganiniguru" name="ganiniguru" value="<?php echo $row['ganiniguru']; ?>"><br />
								Place<input type="text" id="ganiniplace" name="ganiniplace" class="longBox" value="<?php echo $row['ganiniplace']; ?>"><br /><br />
								<input type="hidden" id="ganinilat" name="ganinilat" value="<?php echo $row['ganinilat']; ?>">
								<input type="hidden" id="ganinilng" name="ganinilng" value="<?php echo $row['ganinilng']; ?>">
							</div>
							
							<div id="aryika" class="">
								<strong>Aryika Deeksha Details</strong><br />
								Date in YYYY-MM-DD<input type="text" id="aryikadate" name="aryikadate" class="smallBox" value="<?php echo $row['aryikadate']; ?>"><br />
								Guru ID<input type="text" id="aryikaguru" name="aryikaguru" value="<?php echo $row['aryikaguru']; ?>"><br />
								Place<input type="text" id="aryikaplace" name="aryikaplace" class="longBox" value="<?php echo $row['aryikaplace']; ?>"><br /><br />
								<input type="hidden" id="aryikalat" name="aryikalat" value="<?php echo $row['aryikalat']; ?>">
								<input type="hidden" id="aryikalng" name="aryikalng" value="<?php echo $row['aryikalng']; ?>">
							</div>
							
							<div id="kshullika" class="">
								<strong>Kshullika Deeksha Details</strong><br />
								Date in YYYY-MM-DD<input type="text" id="kshullikadate" name="kshullikadate" class="smallBox" value="<?php echo $row['kshullikadate']; ?>"><br />
								Guru ID<input type="text" id="kshullikaguru" name="kshullikaguru" value="<?php echo $row['kshullikaguru']; ?>"><br />
								Place<input type="text" id="kshullikaplace" name="kshullikaplace" class="longBox" value="<?php echo $row['kshullikaplace']; ?>"><br /><br />
								<input type="hidden" id="kshullikalat" name="kshullikalat" value="<?php echo $row['kshullikalat']; ?>">
								<input type="hidden" id="kshullikalng" name="kshullikalng" value="<?php echo $row['kshullikalng']; ?>">
							</div>
							
							<b>Bhramcharya (Seventh Pratima) Vrat Details</b><br />
							Date in YYYY-MM-DD<input type="text" id="bhramcharyadate" name="bhramcharyadate" class="smallBox" value="<?php echo $row['bhramcharyadate']; ?>"><br />
							Guru ID<input type="text" id="bhramcharyaguru" name="bhramcharyaguru" value="<?php echo $row['bhramcharyaguru']; ?>"><br />
							Place<input type="text" id="bhramcharyaplace" name="bhramcharyaplace" class="longBox" value="<?php echo $row['bhramcharyaplace']; ?>"><br /><br />
							<input type="hidden" id="bhramcharyalat" name="bhramcharyalat" value="<?php echo $row['bhramcharyalat']; ?>">
							<input type="hidden" id="bhramcharyalng" name="bhramcharyalng" value="<?php echo $row['bhramcharyalng']; ?>">
							
							Vairagya Date in YYYY-MM-DD<input type="text" id="vairagya" name="vairagya" class="smallBox" value="<?php echo $row['vairagya']; ?>"><br />
							Grahtyag Date in YYYY-MM-DD<input type="text" id="grahtyag" name="grahtyag" class="smallBox" value="<?php echo $row['grahtyag']; ?>"><br /><br />
							
							<b>History</b><br />
							Birthname <input type="text" id="birthname" name="birthname" value="<?php echo $row['birthname']; ?>"><br />
							Date of Birth <input type="text" id="dob" name="dob" class="smallBox" value="<?php echo $row['dob']; ?>"><br />
							Father <input type="text" id="father" name="father" value="<?php echo $row['father']; ?>"><br />
							Mother <input type="text" id="mother" name="mother" value="<?php echo $row['mother']; ?>"><br />
							Spouse <input type="text" id="spouse" name="spouse" value="<?php echo $row['spouse']; ?>"><br />
							Birthplace <input type="text" id="birthplace" name="birthplace" class="longBox" value="<?php echo $row['birthplace']; ?>" /><br />
							<input type="hidden" id="birthlat" name="birthlat" value="<?php echo $row['birthlat']; ?>">
							<input type="hidden" id="birthlng" name="birthlng" value="<?php echo $row['birthlng']; ?>">
							Education <input type="text" id="education" name="education" value="<?php echo $row['education']; ?>"><br /><br />
							
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
							<input type="text" id="chaturmasplace" name="chaturmasplace" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>"><br />
							<input type="hidden" id="chaturmaslat" name="chaturmaslat" value="<?php echo $row2['chaturmaslat']; ?>">
							<input type="hidden" id="chaturmaslng" name="chaturmaslng" value="<?php echo $row2['chaturmaslng']; ?>">
							<input type="hidden" id="chaturmasid" name="chaturmasid" value="<?php echo $row2['chaturmasid']; ?>">
							<input type="hidden" id="latestChaturmasYear" name="latestChaturmasYear" value="<?php echo $latestChaturmasYear; ?>">							
							<?php
$year = $latestChaturmasYear;
$i = 1;
$firstChaturmasYear = $firstChaturmasYear - 1;

while($year > 0) {
	$i++;
	$year = $year - 1;
	if ($year > $firstChaturmasYear) {
		echo $year.'&nbsp;';
		$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni=? AND chaturmasyear=?");
		$q->execute(array($id,$year));
		$row2 = $q->fetch(PDO::FETCH_ASSOC);
		echo '<input type="text" id="chaturmasplace'.$i.'" name="chaturmasplace'.$i.'" class="longBox" value="'.$row2['chaturmasplace'].'"><br />
							<input type="hidden" id="chaturmaslat'.$i.'" name="chaturmaslat'.$i.'" value="'.$row2['chaturmaslat'].'">
							<input type="hidden" id="chaturmaslng'.$i.'" name="chaturmaslng'.$i.'" value="'.$row2['chaturmaslng'].'">
							<input type="hidden" name="chaturmasid'.$i.'" value="'.$row2['chaturmasid'].'">';
	} else { $year = 0; }
}
							?>
							<br />
							
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
