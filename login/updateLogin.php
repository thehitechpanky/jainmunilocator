<?php

include '../config.php';
$email = $_GET['email'];
$username = $_GET['username'];
$userimg = $_GET['userimg'];

$u = $db->prepare("SELECT * FROM user WHERE email=?");
$u->execute(array($email));

if ($email == '') {
	$result = 'Error: email not provided.';
} else {
	if($u->rowCount() == 1) {
		$row = $u->fetch(PDO::FETCH_ASSOC);
		$lastlogin = $row['usertimestamp'];
		//echo $lastlogin;
		$q = $db->prepare("UPDATE user SET username=?, userimg=?, lastlogin=?, userip=? WHERE email=?");
		$q->execute(array($username,$userimg,$lastlogin,$_SERVER['REMOTE_ADDR'],$email));
		$result = 'Updated';
	} else {
		$q = $db->prepare("INSERT INTO user (email,username,userimg,userip) VALUES (?,?,?,?)");
		$q->execute(array($email,$username,$userimg,$_SERVER['REMOTE_ADDR']));
		$result = 'Inserted';
	}
}

echo 'Email: '.$email.'<br />Username: '.$username.'<br />Userimg: '.$userimg.'<br />Result: '.$result;


if (strlen($email) == 0 || $email == 'capankajjain@smilyo.com' || $email == 'rachna424.rj@gmail.com') {} else {
	$to = 'capankajjain@smilyo.com';
	$from = $email;
	$subject = 'New Login to Jain Muni Locator';
	$msg = 'I just logged in to Jain Muni Locator.<br /><br />Thanks &amp; Regards<br />'.$username;
	include '../email.php';
}

?>
