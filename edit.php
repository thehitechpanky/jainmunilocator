<?php
// configuration
include('config.php');
 
// new data
$name = $_POST['name'];
$website = $_POST['website'];
$img = $_POST['img'];
$dos = $_POST['dos'];
$adate = $_POST['adate'];
$ailacharyadate = $_POST['ailacharyadate'];
$upadhyaydate = $_POST['upadhyaydate'];
$munidate = $_POST['munidate'];
$ailakdate = $_POST['ailakdate'];
$kdate = $_POST['kdate'];
$birthname = $_POST['birthname'];
$dob = $_POST['dob'];
$father = $_POST['father'];
$mother = $_POST['mother'];
$id = $_POST['ids'];

// query
$sqlmunishri = "UPDATE munishri SET name=?, website=?, img=?, dos=?, birthname=?, dob=?, father=?, mother=? WHERE id=?";	
$q = $db->prepare($sqlmunishri);
$q->execute(array($name,$website,$img,$dos,$birthname,$dob,$father,$mother,$id));

$sqlacharya = "UPDATE acharya SET adate=? WHERE acharyaid='$id'";
$q = $db->prepare($sqlacharya);
$q->execute(array($adate));

$sqlailacharya = "UPDATE ailacharya SET ailacharyadate=? WHERE ailacharyaid='$id'";
$q = $db->prepare($sqlailacharya);
$q->execute(array($ailacharyadate));

$sqlupadhyay = "UPDATE upadhyay SET upadhyaydate=? WHERE upadhyayid='$id'";
$q = $db->prepare($sqlupadhyay);
$q->execute(array($upadhyaydate));

$sqlmuni = "UPDATE muni SET munidate=? WHERE muniid='$id'";
$q = $db->prepare($sqlmuni);
$q->execute(array($munidate));

$sqlailak = "UPDATE ailak SET ailakdate=? WHERE ailakid='$id'";
$q = $db->prepare($sqlailak);
$q->execute(array($ailakdate));

$sqlkshullak = "UPDATE kshullak SET kdate=? WHERE kid='$id'";
$q = $db->prepare($sqlkshullak);
$q->execute(array($kdate));

header('location: munis.php?id='.$id);
 
?>
