<?php
include '../config.php';
include 'serverkey.php';
include 'getAddress.php';
include 'locality.php';
$useremail = $_GET['email'];
$userlat = $_GET['userlat'];
$userlng = $_GET['userlng'];
$userlocation = getaddress($userlat,$userlng);
echo 'User address is '.$userlocation.'.<br />';
$userlocality = getlocality($userlat,$userlng);
echo 'User locality is '.$userlocality.'.';

// fileds of editlog
$u = $db->prepare("SELECT * FROM userlocation WHERE userlocationemail=?");
$u->execute(array($useremail));
if($u->rowCount() == 1) {
	$q = $db->prepare("UPDATE userlocation SET userlat=?, userlng=?, userlocation=?, userlocality=? WHERE userlocationemail=?");
	$q->execute(array($userlat,$userlng,$userlocation,$userlocality,$useremail));
} else {
	$q = $db->prepare("INSERT INTO userlocation (userlocationemail,userlat,userlng,userlocation,userlocality) VALUES (?,?,?,?,?)");
	$q->execute(array($useremail,$userlat,$userlng,$userlocation,$userlocality));
}

if (strlen($useremail) == 0 || $useremail = 'capankajjain@smilyo.com' || $useremail == 'rachna424.rj@gmail.com') {} else {
	$to = 'capankajjain@smilyo.com';
	$from = $useremail;
	$subject = 'New Login to Jain Muni Locator with location';
	$msg = 'I just logged in to Jain Muni Locator from '.$userlocation.'.<br /><br />Thanks &amp; Regards<br />';
	require("../sendgrid-php/sendgrid-php.php");
	include '../sendgridkey.php';
	$email = new SendGrid\Email();
	$email
		->addTo($to)
		->setFrom($from)
		->setSubject($subject)
		->setHtml($msg)
		;
	$sendgrid->send($email);
	
}

?>
