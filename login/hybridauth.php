<?php
session_start();
$config=dirname(dirname(__FILE__)) . '/hybridauth/config.php';
require_once('../hybridauth/Hybrid/Auth.php');
try{
	$hybridauth=new Hybrid_Auth( $config );
	$google=$hybridauth->authenticate( "Google" );
	$user_profile=$google->getUserProfile();	
	$name=$user_profile->displayName;
	$result="Login Successful";
	$u = $db->prepare("SELECT * FROM user WHERE email=?");
	$u->execute(array($email));	
	if($u->rowCount()==1){
		$row=$u->fetch(PDO::FETCH_ASSOC);
		$q = $db->prepare("UPDATE user SET username=?, userimg=?, lastlogin=?, mode=?, logincount=?, userip=? WHERE email=?");
		$q->execute(array($name,$userimg,$row['usertimestamp'],'web',$row['logincount']+1,$_SERVER['REMOTE_ADDR'],$email));
		$result = 'Updated';
	} else {
		$q = $db->prepare("INSERT INTO user (email,username,userimg,mode,logincount,userip) VALUES (?,?,?,?,?,?)");
		$q->execute(array($email,$name,$userimg,'web',1,$_SERVER['REMOTE_ADDR']));
		$result = 'Inserted';
	}
}
catch(Exception $e){
	$result=$e->getMessage();
	echo "Ooophs, we got an error: ".$result;
}

if (strlen($email) == 0 || $email == 'capankajjain@smilyo.com' || $email == 'sanky812@gmail.com') {} else {
	$to = 'capankajjain@smilyo.com';
	$from = $email;
	$subject = 'New '.$mode.' Login to Jain Muni Locator';
	$msg = 'I just logged in to Jain Muni Locator.<br /><br />Thanks &amp; Regards<br />'.$username;
	include '../email.php';
}
?>
