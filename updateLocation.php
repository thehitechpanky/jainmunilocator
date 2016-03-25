<?php
include 'functionsCreated.php';
$email = $_GET['email'];
$username = $_GET['username'];
$userimg = $_GET['userimg'];
$userlat = $_GET['userlat'];
$userlng = $_GET['userlng'];
$userlocation = getaddress($userlat,$userlng);
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
