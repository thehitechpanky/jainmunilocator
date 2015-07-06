<?php
// configuration
include('config.php');
 
// new data
$name = $_POST['name'];
$website = $_POST['website'];
$img = $_POST['img'];
$dos = $_POST['dos'];
$adate = $_POST['adate'];
$ailacharyaname = $_POST['ailacharyaname'];
$ailacharyadate = $_POST['ailacharyadate'];
$upadhyayname = $_POST['upadhyayname'];
$upadhyaydate = $_POST['upadhyaydate'];
$muniname = $_POST['muniname'];
$munidate = $_POST['munidate'];
$ailakname = $_POST['ailakname'];
$ailakdate = $_POST['ailakdate'];
$kname = $_POST['kname'];
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

$sqlailacharya = "UPDATE ailacharya SET ailacharyadate=?, ailacharyaname=? WHERE ailacharyaid='$id'";
$q = $db->prepare($sqlailacharya);
$q->execute(array($ailacharyadate,$ailacharyaname));

$sqlupadhyay = "UPDATE upadhyay SET upadhyaydate=?, upadhyayname=? WHERE upadhyayid='$id'";
$q = $db->prepare($sqlupadhyay);
$q->execute(array($upadhyaydate,$upadhyayname));

$sqlmuni = "UPDATE muni SET munidate=?, muniname=? WHERE muniid='$id'";
$q = $db->prepare($sqlmuni);
$q->execute(array($munidate,$muniname));

$sqlailak = "UPDATE ailak SET ailakdate=?, ailakname=? WHERE ailakid='$id'";
$q = $db->prepare($sqlailak);
$q->execute(array($ailakdate,$ailakname));

$sqlkshullak = "UPDATE kshullak SET kdate=?, kname=? WHERE kid='$id'";
$q = $db->prepare($sqlkshullak);
$q->execute(array($kdate,$kname));

header('location: munis.php?id='.$id);
 
?>
