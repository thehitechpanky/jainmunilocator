<?php
// configuration
include('config.php');

// fields of munishri
$upadhi = $_POST['upadhi'];
$name = $_POST['name'];
$alias = $_POST['alias'];
$website = $_POST['website'];
$img = $_POST['img'];
$dos = $_POST['dos'];
$vairagya = $_POST['vairagya'];
$birthname = $_POST['birthname'];
$dob = $_POST['dob'];
$father = $_POST['father'];
$mother = $_POST['mother'];
$birthplace = $_POST['birthplace'];
if($birthplace=="N/A") {
	$birthlat = 0;
	$birthlng = 0;
} else {
	$birthlat = getlatitude($birthplace);
	$birthlng = getlongitude($birthplace);
}

// fields of acharya
$adate = $_POST['adate'];
$aguru = $_POST['aguru'];
$aplace = $_POST['aplace'];
if($aplace=="N/A") {
	$alat = 0;
	$alng = 0;
} else {
	$alat = getlatitude($aplace);
	$alng = getlongitude($aplace);
}

// fields of ailacharya
$ailacharyaname = $_POST['ailacharyaname'];
$ailacharyadate = $_POST['ailacharyadate'];
$ailacharyaguru = $_POST['ailacharyaguru'];
$ailacharyaplace = $_POST['ailacharyaplace'];
if($ailacharyaplace=="N/A") {
	$ailacharyalat = 0;
	$ailacharyalng = 0;
} else {
	$ailacharyalat = getlatitude($ailacharyaplace);
	$ailacharyalng = getlongitude($ailacharyaplace);
}

// fields of upadhyay
$upadhyayname = $_POST['upadhyayname'];
$upadhyaydate = $_POST['upadhyaydate'];
$upadhyayguru = $_POST['upadhyayguru'];
$upadhyayplace = $_POST['upadhyayplace'];
if($upadhyayplace=="N/A") {
	$upadhyaylat = 0;
	$upadhyaylng = 0;
} else {
	$upadhyaylat = getlatitude($upadhyayplace);
	$upadhyaylng = getlongitude($upadhyayplace);
}

// fields of muni
$muniname = $_POST['muniname'];
$munidate = $_POST['munidate'];
$muniguru = $_POST['muniguru'];
$muniplace = $_POST['muniplace'];
if($muniplace=="N/A") {
	$munilat = 0;
	$munilng = 0;
} else {
	$munilat = getlatitude($muniplace);
	$munilng = getlongitude($muniplace);
}

// fields of ailak
$ailakname = $_POST['ailakname'];
$ailakdate = $_POST['ailakdate'];
$ailakguru = $_POST['ailakguru'];
$ailakplace = $_POST['ailakplace'];
if($ailakplace=="N/A") {
	$ailaklat = 0;
	$ailaklng = 0;
} else {
	$ailaklat = getlatitude($ailakplace);
	$ailaklng = getlongitude($ailakplace);
}

// fields of kshullak
$kname = $_POST['kname'];
$kdate = $_POST['kdate'];
$kguru = $_POST['kguru'];
$kplace = $_POST['kplace'];
if($kplace=="N/A") {
	$klat = 0;
	$klng = 0;
} else {
	$klat = getlatitude($kplace);
	$klng = getlongitude($kplace);
}

// fields of aryika
$aryikadate = $_POST['aryikadate'];
$aryikaguru = $_POST['aryikaguru'];
$aryikaplace = $_POST['aryikaplace'];
if($aryikaplace=="N/A") {
	$aryikalat = 0;
	$aryikalng = 0;
} else {
	$aryikalat = getlatitude($aryikaplace);
	$aryikalng = getlongitude($aryikaplace);
}

// fields of kshullika
$kshullikadate = $_POST['kshullikadate'];
$kshullikaguru = $_POST['kshullikaguru'];
$kshullikaplace = $_POST['kshullikaplace'];
if($kshullikaplace=="N/A") {
	$kshullikalat = 0;
	$kshullikalng = 0;
} else {
	$kshullikalat = getlatitude($kshullikaplace);
	$kshullikalng = getlongitude($kshullikaplace);
}

// fields of bhramcharya
$bhramcharyadate = $_POST['bhramcharyadate'];
$bhramcharyaguru = $_POST['bhramcharyaguru'];

// fields of muni_location
$location = $_POST['location'];
if($location=="N/A") {
	$lat = 0;
	$lng = 0;
} else {
	$lat = getlatitude($location);
	$lng = getlongitude($location);
}

$id = $_POST['ids'];

// Captcha Check
$url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcXYP8SAAAAAH7WUPMtiHoEiTnev6ofbzsuRY4U&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR'];
$text = file_get_contents($url);

	if(strpos($text,'true')) {
		
		// Edit Database
		$sqlmunishri = "UPDATE munishri SET upadhi=?, name=?, alias=?, website=?, img=?, dos=?, vairagya=?, birthname=?, dob=?, father=?, mother=?, birthlat=?, birthlng=? WHERE id=?";	
		$q = $db->prepare($sqlmunishri);
		$q->execute(array($upadhi,$name,$alias,$website,$img,$dos,$vairagya,$birthname,$dob,$father,$mother,$birthlat,$birthlng,$id));
		
		$sqlacharya = "UPDATE acharya SET adate=?, aguru=?, alat=?, alng=? WHERE acharyaid='$id'";
		$q = $db->prepare($sqlacharya);
		$q->execute(array($adate,$aguru,$alat,$alng));
		
		$sqlailacharya = "UPDATE ailacharya SET ailacharyaname=?, ailacharyadate=?, ailacharyaguru=?, aliacharyalat=?, ailacharyalng=? WHERE ailacharyaid='$id'";
		$q = $db->prepare($sqlailacharya);
		$q->execute(array($ailacharyaname,$ailacharyadate,$ailacharyaguru,$ailacharyalat,$ailacharyalng));
		
		$sqlupadhyay = "UPDATE upadhyay SET upadhyayname=?, upadhyaydate=?, upadhyayguru=?, upadhyaylat=?, upadhyaylng=? WHERE upadhyayid='$id'";
		$q = $db->prepare($sqlupadhyay);
		$q->execute(array($upadhyayname,$upadhyaydate,$upadhyayguru,$upadhyaylat,$upadhyaylng));
		
		$sqlmuni = "UPDATE muni SET muniname=?, munidate=?, muniguru=?, munilat=?, munilng=? WHERE muniid='$id'";
		$q = $db->prepare($sqlmuni);
		$q->execute(array($muniname,$munidate,$muniguru,$munilat,$munilng));
		
		$sqlailak = "UPDATE ailak SET ailakname=?, ailakdate=?, ailakguru=?, ailaklat=?, ailaklng=? WHERE ailakid='$id'";
		$q = $db->prepare($sqlailak);
		$q->execute(array($ailakname,$ailakdate,$ailakguru,$ailaklat,$ailaklng));
		
		$sqlkshullak = "UPDATE kshullak SET kname=?, kdate=?, kguru=?, klat=?, klng=? WHERE kid='$id'";
		$q = $db->prepare($sqlkshullak);
		$q->execute(array($kname,$kdate,$kguru,$klat,$klng));
		
		$sqlaryika = "UPDATE aryika SET aryikadate=?, aryikaguru=?, aryikalat=?, aryikalng=? WHERE aryikaid='$id'";
		$q = $db->prepare($sqlaryika);
		$q->execute(array($aryikadate,$aryikaguru,$aryikalat,$aryikalng));
		
		$sqlkshullika = "UPDATE kshullika SET kshullikadate=?, kshullikaguru=?, kshullikalat=?, kshullikalng=? WHERE kshullikaid='$id'";
		$q = $db->prepare($sqlkshullika);
		$q->execute(array($kshullikadate,$kshullikaguru,$kshullikalat,$kshullikalng));
		
		$sqlbhramcharya = "UPDATE bhramcharya SET bhramcharyadate=?, bhramcharyaguru=? WHERE bhramcharyaid='$id'";
		$q = $db->prepare($sqlbhramcharya);
		$q->execute(array($bhramcharyadate,$bhramcharyaguru));
		
		$sqllocation = "UPDATE muni_location SET lat=?, lng=? WHERE mid='$id'";
		$q = $db->prepare($sqllocation);
		$q->execute(array($lat,$lng));
		
	} else {
	
		echo "Wrong Recaptcha, Please try again!";
	
	}

header('location: ./munis.php?id='.$id);

?>
