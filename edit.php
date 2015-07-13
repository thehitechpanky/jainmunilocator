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
//$lat = $_POST['lat'];
//$lng = $_POST['lng'];
$id = $_POST['ids'];
$location = $_POST['location'];
$lat = getlatitude($location);
$lng = getlongtitude($location);
function getlatitude($address)
{
$address= preg_replace('/\s+/', '+', $address);
$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
$response_a = json_decode($response);
return $response_a->results[0]->geometry->location->lat;
}
function getlongtitude($address)
{
$address= preg_replace('/\s+/', '+', $address);
$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);
$response_a = json_decode($response);
return $response_a->results[0]->geometry->location->lng;

}



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

$sqllocation = "UPDATE muni_location SET lat=?, lng=? WHERE mid='$id'";
$q = $db->prepare($sqllocation);
$q->execute(array($lat,$lng));

header('location: munis.php?id='.$id);

// Muni Location
//if(isset($_POST['muniid']))
//{
//	$id = (int)$_POST['muniid'];
//	$q = $db->prepare("SELECT * FROM muni_location WHERE mid = ?");
//	$q->execute(array($id));
//	if($q->rowCount() == 1)
//	{
//		$f = $q->fetch(PDO::FETCH_ASSOC);
//		echo '<input type="hidden" id="lat" style="display:none" value="'.$f['lat'].'"><input type="hidden" id="lng" style="display:none" value="'.$f['lng'].'"><table><tr><td>Address</td><td><input type="text" id="x"></td></tr>';
//		echo '</table><input type="button" id="wow" value="Submit"><input type="button" id="cancel" value="Cancel" onclick="history.back();">';
//	}
//}
//if(isset($_POST['mid']))
//{
//	$id = (int)$_POST['mid'];
//	$q = $db->prepare("UPDATE muni_location SET lat = ?,lng = ? WHERE mid=?");
//	$q->execute(array($_POST['lat'],$_POST['lng'],$id));
//	echo $_POST['lat'].'-'.$_POST['lng'].'-'.$id;
//}

?>
