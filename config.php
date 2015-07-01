<?php
//Database Connection
$db = new PDO('mysql:host=localhost;dbname=databasename;charset=utf8', 'username', 'password', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$link = mysqli_connect("localhost","username","password","databasename"); 
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//Function to find location details
function getlocation($id)
{
	global $db;
	$x = $db->prepare("SELECT * FROM location WHERE lid = ?");
	$x->execute(array($id));
	if($x->rowCount() == 1)
	{
		$y = $x->fetch(PDO::FETCH_ASSOC);
		$t= "";
		if($y['place'] != "") $t = $t.', '.$y['place'];
		if($y['district'] != "") $t = $t.', '.$y['district'];
		if($y['state'] != "") $t = $t.', '.$y['state'];
		$t = ltrim($t,",");
		return $t;
	}
	else
	{
		return "N/A";
	}
}

//Function to find muni details
function getmuni($id)
{
	global $db;
	$m = $db->prepare("SELECT * FROM munishri, upadhis WHERE id = ? AND approved=1 AND uid=upadhi");
	$m->execute(array($id));
	if($m->rowCount() == 1)
	{
		$n = $m->fetch(PDO::FETCH_ASSOC);
		$t= "";
		if($n['uname'] != "") $t = $t.' '.$n['uname'];
		if($n['prefix'] != "") $t = $t.' '.$n['prefix'];
		if($n['name'] != "") $t = $t.' '.$n['name'];
		if($n['suffix'] != "") $t = $t.' '.$n['suffix'];
		return $t;
	}
	else
	{
		return "N/A";
	}
}

//Function to get the guru details
function getguru($id)
{
	global $db;
	$m = $db->prepare("SELECT * FROM munishri, kshullak, ailak, upadhyay, ailacharya, acharya WHERE id = ? AND approved=1 AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid");
	$m->execute(array($id));
	if($m->rowCount() == 1)
	{
		$n = $m->fetch(PDO::FETCH_ASSOC);
		if($n['upadhi'] == 1) $t = $n['aguru'];
		if($n['upadhi'] == 2) $t = $n['ailacharyaguru'];
		if($n['upadhi'] == 3) $t = $n['upadhyayguru'];
		if($n['upadhi'] == 4) $t = $n['munidikshaguru'];
		if($n['upadhi'] == 5) $t = $n['ailakguru'];
		if($n['upadhi'] == 6) $t = $n['kguru'];
		return $t;
	}
	else
	{
		return "N/A";
	}
}
?>
