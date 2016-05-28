<?php

$editor = $_POST['editoremail'];

// configuration
include '../config.php';
include '../map/locality.php';
include '../map/getLongitude.php';
include '../map/getLatitude.php';
include 'getMuni.php';

$id = $_POST['ids'];

$t = $db->prepare('SELECT * FROM munishri, upadhis, kshullika, aryika, ganini, bhramcharya, kshullak, ailak, muni, upadhyay, ailacharya, acharya, muni_location,
history, contact WHERE id=? AND uid=upadhi AND kshullikaid=? AND aryikaid=? AND ganiniid=? AND bhramcharyaid=? AND kid=? AND ailakid=? AND muniid=?
AND upadhyayid=? AND ailacharyaid=? AND acharyaid=? AND mid=? AND historyid=? AND contactid=?');
$t->execute(array($id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id,$id));

if ($t->rowCount() == 1) {
	$row = $t->fetch(PDO::FETCH_ASSOC);
	$oldname = $row['name'];
}

$title = getmuni($id);

// fields of munishri
$upadhi = $_POST['upadhi'];
$title = $_POST['title'];
$name = $_POST['name'];
$alias = $_POST['alias'];
//$img = $_POST['img'];
$dos = $_POST['dos'];
$vairagya = $_POST['vairagya'];
$birthname = $_POST['birthname'];
$dob = $_POST['dob'];
$father = $_POST['father'];
$mother = $_POST['mother'];
$spouse = $_POST['spouse'];
$grahtyag = $_POST['grahtyag'];
$education = $_POST['education'];

// fields of contact
$website = $_POST['website'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$facebook = $_POST['facebook'];
$gplus = $_POST['gplus'];
$youtube = $_POST['youtube'];
$wikipedia = $_POST['wikipedia'];

// fields of history
$birthplace = $_POST['birthplace'];
$birthlat = $_POST['birthlat'];
$birthlng = $_POST['birthlng'];
$samadhiplace = $_POST['samadhiplace'];
$samadhilat = $_POST['samadhilat'];
$samadhilng = $_POST['samadhilng'];


// fields of acharya
$adate = $_POST['adate'];
$aguru = $_POST['aguru'];
$aplace = $_POST['aplace'];
$alat = $_POST['alat'];
$alng = $_POST['alng'];

// fields of ailacharya
$ailacharyaname = $_POST['ailacharyaname'];
$ailacharyadate = $_POST['ailacharyadate'];
$ailacharyaguru = $_POST['ailacharyaguru'];
$ailacharyaplace = $_POST['ailacharyaplace'];
$ailacharyalat = $_POST['ailacharyalat'];
$ailacharyalng = $_POST['ailacharyalng'];

// fields of upadhyay
$upadhyayname = $_POST['upadhyayname'];
$upadhyaydate = $_POST['upadhyaydate'];
$upadhyayguru = $_POST['upadhyayguru'];
$upadhyayplace = $_POST['upadhyayplace'];
$upadhyaylat = $_POST['upadhyaylat'];
$upadhyaylng = $_POST['upadhyaylng'];

// fields of muni
$muniname = $_POST['muniname'];
$munidate = $_POST['munidate'];
$muniguru = $_POST['muniguru'];
$muniplace = $_POST['muniplace'];
$munilat = $_POST['munilat'];
$munilng = $_POST['munilng'];

// fields of ailak
$ailakname = $_POST['ailakname'];
$ailakdate = $_POST['ailakdate'];
$ailakguru = $_POST['ailakguru'];
$ailakplace = $_POST['ailakplace'];
$ailaklat = $_POST['ailaklat'];
$ailaklng = $_POST['ailaklng'];

// fields of kshullak
$kname = $_POST['kname'];
$kdate = $_POST['kdate'];
$kguru = $_POST['kguru'];
$kplace = $_POST['kplace'];
$klat = $_POST['klat'];
$klng = $_POST['klng'];

// fields of kshullika
$kshullikadate = $_POST['kshullikadate'];
$kshullikaguru = $_POST['kshullikaguru'];
$kshullikaplace = $_POST['kshullikaplace'];
$kshullikalat = $_POST['kshullikalat'];
$kshullikalng = $_POST['kshullikalng'];

// fields of bhramcharya
$bhramcharyadate = $_POST['bhramcharyadate'];
$bhramcharyaguru = $_POST['bhramcharyaguru'];
$bhramcharyaplace = $_POST['bhramcharyaplace'];
$bhramcharyalat = $_POST['bhramcharyalat'];
$bhramcharyalng = $_POST['bhramcharyalng'];

// Edit Database
$sqlmunishri = "UPDATE munishri SET upadhi=?, title=?, name=?, alias=?, dos=?, vairagya=?, birthname=?, dob=?, father=?, mother=?, spouse=?, grahtyag=?, education=? WHERE id=?";	
$q = $db->prepare($sqlmunishri);
$q->execute(array($upadhi,$title,$name,$alias,$dos,$vairagya,$birthname,$dob,$father,$mother,$spouse,$grahtyag,$education,$id));

$sqlcontact = "UPDATE contact SET website=?, phone=?, email=?, facebook=?, gplus=?, youtube=?, wikipedia=? WHERE contactid='$id'";	
$q = $db->prepare($sqlcontact);
$q->execute(array($website,$phone,$email,$facebook,$gplus,$youtube,$wikipedia));

$sqlhistory = "UPDATE history SET birthlat=?, birthlng=?, birthplace=?, samadhilat=?, samadhilng=?, samadhiplace=? WHERE historyid='$id'";	
$q = $db->prepare($sqlhistory);
$q->execute(array($birthlat,$birthlng,$birthplace,$samadhilat,$samadhilng,$samadhiplace));


// Chaturmas
$chaturmasid = $_POST['chaturmasid'];
$latestChaturmasYear = $_POST['latestChaturmasYear'];
$chaturmasplace = $_POST['chaturmasplace'];
$chaturmaslat = $_POST['chaturmaslat'];
$chaturmaslng = $_POST['chaturmaslng'];

if($chaturmasid > 0) {
	$sqlchaturmas = "UPDATE chaturmas SET chaturmaslat=?, chaturmaslng=?, chaturmasplace=? WHERE chaturmasid='$chaturmasid'";
	$q = $db->prepare($sqlchaturmas);
	$q->execute(array($chaturmaslat,$chaturmaslng,$chaturmasplace));
} elseif ($chaturmasplace!="" && $chaturmasplace!="N/A") {
	$sqlchaturmas = "INSERT INTO chaturmas (chaturmasmuni,chaturmasyear,chaturmaslat,chaturmaslng,chaturmasplace) VALUES (?,?,?,?,?)";
	$q = $db->prepare($sqlchaturmas);
	$q->execute(array($id,$latestChaturmasYear,$chaturmaslat,$chaturmaslng,$chaturmasplace));
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

$year = $latestChaturmasYear;
$i = 1;
$firstChaturmasYear = $firstChaturmasYear - 1;

while($year > 0) {
	$i++;
	$year = $year - 1;
	if ($year > $firstChaturmasYear) {
		$chaturmasid = $_POST['chaturmasid'.$i];
		$chaturmasplace = $_POST['chaturmasplace'.$i];
		$chaturmaslat = $_POST['chaturmaslat'.$i];
		$chaturmaslng = $_POST['chaturmaslng'.$i];
		if($chaturmasid > 0) {
			$q = $db->prepare("UPDATE chaturmas SET chaturmaslat=?, chaturmaslng=?, chaturmasplace=? WHERE chaturmasid=?");
			$q->execute(array($chaturmaslat,$chaturmaslng,$chaturmasplace,$chaturmasid));
		} elseif ($chaturmasplace!="" && $chaturmasplace!="N/A") {
			$q = $db->prepare("INSERT INTO chaturmas (chaturmasmuni,chaturmasyear,chaturmaslat,chaturmaslng,chaturmasplace) VALUES (?,?,?,?,?)");
			$q->execute(array($id,$year,$chaturmaslat,$chaturmaslng,$chaturmasplace));
		}
	} else { $year = 0; }
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

// fields of ganini aryika
$ganinidate = $_POST['ganinidate'];
$ganiniguru = $_POST['ganiniguru'];
$ganiniplace = $_POST['ganiniplace'];
$ganinilat = $_POST['ganinilat'];
$ganinilng = $_POST['ganinilng'];
$q = $db->prepare("UPDATE ganini SET ganinidate=?, ganiniguru=?, ganinilat=?, ganinilng=?, ganiniplace=? WHERE ganiniid=?");
$q->execute(array($ganinidate,$ganiniguru,$ganinilat,$ganinilng,$ganiniplace,$id));

// fields of aryika
$aryikadate = $_POST['aryikadate'];
$aryikaguru = $_POST['aryikaguru'];
$aryikaplace = $_POST['aryikaplace'];
$aryikalat = $_POST['aryikalat'];
$aryikalng = $_POST['aryikalng'];
$q = $db->prepare("UPDATE aryika SET aryikadate=?, aryikaguru=?, aryikalat=?, aryikalng=?, aryikaplace=? WHERE aryikaid=?");
$q->execute(array($aryikadate,$aryikaguru,$aryikalat,$aryikalng,$aryikaplace,$id));

$sqlkshullika = "UPDATE kshullika SET kshullikadate=?, kshullikaguru=?, kshullikalat=?, kshullikalng=?, kshullikaplace=? WHERE kshullikaid='$id'";
$q = $db->prepare($sqlkshullika);
$q->execute(array($kshullikadate,$kshullikaguru,$kshullikalat,$kshullikalng,$kshullikaplace));

$sqlbhramcharya = "UPDATE bhramcharya SET bhramcharyadate=?, bhramcharyaguru=?, bhramcharyalat=?, bhramcharyalng=?, bhramcharyaplace=? WHERE bhramcharyaid='$id'";
$q = $db->prepare($sqlbhramcharya);
$q->execute(array($bhramcharyadate,$bhramcharyaguru,$bhramcharyalat,$bhramcharyalng,$bhramcharyaplace));

// fields of muni_location
$oldlocation = $_POST['oldlocation'];
$location = $_POST['location'];
$lat = $_POST['locationlat'];
$lng = $_POST['locationlng'];
if($location=="N/A") { $locality = ''; } else { $locality = getlocality($lat,$lng); }

$q = $db->prepare("UPDATE muni_location SET lat=?, lng=?, location=?, locality=? WHERE mid=?");
$q->execute(array($lat,$lng,$location,$locality,$id));

// Editlog
$logip = $_SERVER['REMOTE_ADDR'];
$q = $db->prepare("INSERT INTO editlog (editor,logip,type,logmuniid,oldname,newname,oldloc,newloc) VALUES (?,?,?,?,?,?,?,?)");
$q->execute(array($editor,$logip,'muni',$id,$oldname,$name,$oldlocation,$location));

//Thank message to the editor
if($editor == 'capankajjain@smilyo.com' || $editor == 'rachna424.rj@gmail.com') {} else {
	$to = $editor;
	$from = 'capankajjain@smilyo.com';
	$subject = 'Thank you from Jain Muni Locator';
	$msg = 'Hello '.$editor.'<br />Thank you for updating the information about '.$title.' on Jain Muni Locator.<br /><br />Thanks &amp; Regards<br />Pankaj Jain<br />Administrator<br />Jain Muni Locator';
	include '../email.php';
}

$u = $db->prepare("SELECT * FROM user, userlocation WHERE email != ? AND userlocality=? AND userlocationemail=email");
$u->execute(array($editor,$locality));
require("../sendgrid-php/sendgrid-php.php");
include '../sendgridkey.php';

while ($row = $u->fetch(PDO::FETCH_ASSOC)) {
	$emailreceiver = $row['email'];
	if ($oldlocation == $location) {} else {
		$to = $row['email'];
		$from = 'capankajjain@smilyo.com';
		$subject = 'Location update from Jain Muni Locator';
		$msg = 'Jai Jinendra '.$row['username'].' Ji!<br />'.$title.' is now at '.$location.'.&nbsp;
			To find out more about Guruvar / Mataji, click <a href="http://jainmunilocator.org/munis.php?id='.$id.'">here</a>.<br />
			To see the locations of other Guruvar / Mataji, click <a href="http://jainmunilocator.org/map.php">here</a>.
			<br /><br />Thanks &amp; Regards<br />Pankaj Jain<br />Administrator<br />Jain Muni Locator';
		$email = new SendGrid\Email();
		$email
			->addTo($to)
			->setFrom($from)
			->setSubject($subject)
			->setHtml($msg)
			;
		$sendgrid->send($email);
	}
}

header('location: ../munis.php?id='.$id);

?>
