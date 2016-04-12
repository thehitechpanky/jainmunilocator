<?php
include '../config.php';
include 'getAddress.php';
include 'locality.php';
$useremail = $_GET['email'];
$username = $_GET['username'];
$userimg = $_GET['userimg'];
$userlat = $_GET['userlat'];
$userlng = $_GET['userlng'];
$userlocation = getaddress($userlat,$userlng);
$userlocality = getlocality($userlat,$userlng);

// fileds of editlog
$userip = $_SERVER['REMOTE_ADDR'];
$u = $db->prepare("SELECT * FROM user WHERE email=?");
$u->execute(array($useremail));
if($u->rowCount() == 1) {
	$q = $db->prepare("UPDATE user SET username=?, userimg=?, userlat=?, userlng=?, userlocation=?, userlocality=?, userip=? WHERE email=?");
	$q->execute(array($username,$userimg,$userlat,$userlng,$userlocation,$userlocality,$userip,$useremail));
} else {
	$q = $db->prepare("INSERT INTO user (email,username,userimg,userlat,userlng,userlocation,userlocality,userip) VALUES (?,?,?,?,?,?,?,?)");
	$q->execute(array($useremail,$username,$userimg,$userlat,$userlng,$userlocation,$userlocality,$userip));
}

if (strlen($useremail) == 0 || $useremail = 'capankajjain@smilyo.com' || $useremail == 'rachna424.rj@gmail.com') {} else {
	$to = 'capankajjain@smilyo.com';
	$from = $useremail;
	$subject = 'New Login to Jain Muni Locator with location';
	$msg = 'I just logged in to Jain Muni Locator from '.$userlocation.'.<br /><br />Thanks &amp; Regards<br />'.$username;
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
