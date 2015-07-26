<?php
// configuration
include('functionsCreated.php');

$id = $_POST['ids'];

// fields of munishri
$upadhi = $_POST['upadhi'];
$name = $_POST['name'];
$alias = $_POST['alias'];
$website = $_POST['website'];
$email = $_POST['email'];
$contact = $_POST['contact'];
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
$samadhiplace = $_POST['samadhiplace'];
if($samadhiplace=="N/A") {
	$samadhilat = 0;
	$samadhilng = 0;
} else {
	$samadhilat = getlatitude($samadhiplace);
	$samadhilng = getlongitude($samadhiplace);
}

// fields of chaturmas
$chaturmasid = $_POST['chaturmasid'];
$latestChaturmasYear = $_POST['latestChaturmasYear'];
$chaturmasplace = $_POST['chaturmasplace'];
$chaturmaslat = getlatitude($chaturmasplace);
$chaturmaslng = getlongitude($chaturmasplace);


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
$bhramcharyaplace = $_POST['bhramcharyaplace'];
if($bhramcharyaplace=="N/A") {
	$bhramcharyalat = 0;
	$bhramcharyalng = 0;
} else {
	$bhramcharyalat = getlatitude($bhramcharyaplace);
	$bhramcharyalng = getlongitude($bhramcharyaplace);
}

// fields of muni_location
$location = $_POST['location'];
if($location=="N/A") {
	$lat = 0;
	$lng = 0;
} else {
	$lat = getlatitude($location);
	$lng = getlongitude($location);
}


// Captcha Check
$url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcXYP8SAAAAAH7WUPMtiHoEiTnev6ofbzsuRY4U&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR'];
$text = file_get_contents($url);

	if(strpos($text,'true')) {
		
		// Edit Database
		$sqlmunishri = "UPDATE munishri SET upadhi=?, name=?, alias=?, website=?, contact=?, email=?, img=?, dos=?, vairagya=?, birthname=?, dob=?, father=?, mother=? WHERE id=?";	
		$q = $db->prepare($sqlmunishri);
		$q->execute(array($upadhi,$name,$alias,$website,$contact,$email,$img,$dos,$vairagya,$birthname,$dob,$father,$mother,$id));
		
		$sqlhistory = "UPDATE history SET birthlat=?, birthlng=?, birthplace=?, samadhilat=?, samadhilng=?, samadhiplace=? WHERE historyid='$id'";	
		$q = $db->prepare($sqlhistory);
		$q->execute(array($birthlat,$birthlng,$birthplace,$samadhilat,$samadhilng,$samadhiplace));
		
		if($chaturmasid>0) {
			$sqlchaturmas = "UPDATE chaturmas SET chaturmaslat=?, chaturmaslng=?, chaturmasplace=? WHERE chaturmasid='$chaturmasid'";
			$q = $db->prepare($sqlchaturmas);
			$q->execute(array($chaturmaslat,$chaturmaslng,$chaturmasplace));
		} elseif ($chaturmasplace!="" && $chaturmasplace!="N/A") {
			$sqlchaturmas = "INSERT INTO chaturmas (chaturmasmuni,chaturmasyear,chaturmaslat,chaturmaslng,chaturmasplace) VALUES (?,?,?,?,?)";
			$q = $db->prepare($sqlchaturmas);
			$q->execute(array($id,$latestChaturmasYear,$chaturmaslat,$chaturmaslng,$chaturmasplace));
		} else {
			//Nothing to be done here if user hasn't specified a chaturmas place
		}
		
		$sqlacharya = "UPDATE acharya SET adate=?, aguru=?, alat=?, alng=?, aplace=? WHERE acharyaid='$id'";
		$q = $db->prepare($sqlacharya);
		$q->execute(array($adate,$aguru,$alat,$alng,$aplace));
		
		$sqlailacharya = "UPDATE ailacharya SET ailacharyaname=?, ailacharyadate=?, ailacharyaguru=?, ailacharyalat=?, ailacharyalng=?, ailacharyaplace=? WHERE ailacharyaid='$id'";
		$q = $db->prepare($sqlailacharya);
		$q->execute(array($ailacharyaname,$ailacharyadate,$ailacharyaguru,$ailacharyalat,$ailacharyalng,$ailacharyaplace));
		
		$sqlupadhyay = "UPDATE upadhyay SET upadhyayname=?, upadhyaydate=?, upadhyayguru=?, upadhyaylat=?, upadhyaylng=?, upadhyayplace=? WHERE upadhyayid='$id'";
		$q = $db->prepare($sqlupadhyay);
		$q->execute(array($upadhyayname,$upadhyaydate,$upadhyayguru,$upadhyaylat,$upadhyaylng,$upadhyayplace));
		
		$sqlmuni = "UPDATE muni SET muniname=?, munidate=?, muniguru=?, munilat=?, munilng=?, muniplace=? WHERE muniid='$id'";
		$q = $db->prepare($sqlmuni);
		$q->execute(array($muniname,$munidate,$muniguru,$munilat,$munilng,$muniplace));
		
		$sqlailak = "UPDATE ailak SET ailakname=?, ailakdate=?, ailakguru=?, ailaklat=?, ailaklng=?, ailakplace=? WHERE ailakid='$id'";
		$q = $db->prepare($sqlailak);
		$q->execute(array($ailakname,$ailakdate,$ailakguru,$ailaklat,$ailaklng,$ailakplace));
		
		$sqlkshullak = "UPDATE kshullak SET kname=?, kdate=?, kguru=?, klat=?, klng=?, kplace=? WHERE kid='$id'";
		$q = $db->prepare($sqlkshullak);
		$q->execute(array($kname,$kdate,$kguru,$klat,$klng,$kplace));
		
		$sqlaryika = "UPDATE aryika SET aryikadate=?, aryikaguru=?, aryikalat=?, aryikalng=?, aryikaplace=? WHERE aryikaid='$id'";
		$q = $db->prepare($sqlaryika);
		$q->execute(array($aryikadate,$aryikaguru,$aryikalat,$aryikalng,$aryikaplace));
		
		$sqlkshullika = "UPDATE kshullika SET kshullikadate=?, kshullikaguru=?, kshullikalat=?, kshullikalng=?, kshullikaplace=? WHERE kshullikaid='$id'";
		$q = $db->prepare($sqlkshullika);
		$q->execute(array($kshullikadate,$kshullikaguru,$kshullikalat,$kshullikalng,$kshullikaplace));
		
		$sqlbhramcharya = "UPDATE bhramcharya SET bhramcharyadate=?, bhramcharyaguru=?, bhramcharyalat=?, bhramcharyalng=?, bhramcharyaplace=? WHERE bhramcharyaid='$id'";
		$q = $db->prepare($sqlbhramcharya);
		$q->execute(array($bhramcharyadate,$bhramcharyaguru,$bhramcharyalat,$bhramcharyalng,$bhramcharyaplace));
		
		$sqllocation = "UPDATE muni_location SET lat=?, lng=?, location=? WHERE mid='$id'";
		$q = $db->prepare($sqllocation);
		$q->execute(array($lat,$lng,$location));
		
	} else {
	
		echo "Wrong Recaptcha, Please try again!";
	
	}

header('location: ./munis.php?id='.$id);

?>
