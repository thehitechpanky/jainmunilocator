<?php
include '../config.php';
$email = $_GET['email'];
$username = $_GET['username'];
$userimg = $_GET['userimg'];
$userlat = 0;
$userlng = 0;
$userlocation = 'N/A';
// fileds of editlog
$userip = $_SERVER['REMOTE_ADDR'];
$u = $db->prepare("SELECT * FROM user WHERE email=?");
$u->execute(array($email));
if($u->rowCount() == 1) {
	$q = $db->prepare("UPDATE user SET username=?, userimg=?, userlat=?, userlng=?, userlocation=?, userip=? WHERE email=?");
	$q->execute(array($username,$userimg,$userlat,$userlng,$userlocation,$userip,$email));
} else {
	$q = $db->prepare("INSERT INTO user (email,username,userimg,userlat,userlng,userlocation,userip) VALUES (?,?,?,?,?,?,?)");
	$q->execute(array($email,$username,$userimg,$userlat,$userlng,$userlocation,$userip));
}
?>
