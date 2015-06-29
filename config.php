<?php
//Database Connection
$db = new PDO('mysql:host=localhost;dbname=database_name;charset=utf8', 'username', 'password', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$link = mysqli_connect("localhost","username","password","database_name"); 
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
		$t = ltrim($t,",");
		return $t;
	}
	else
	{
		return "N/A";
	}
}

//Code below represents code for markers
$array = array();
$sql = "SELECT * FROM muni_location,munishri WHERE mid=id AND lat<>0 ";
$result=mysqli_query($link,$sql);
$i=0;
while($row = mysqli_fetch_assoc($result)){
if(isset($row)){
$array[$i][0]='<a href="/munis.php?id='.$row['id'].'">'.getmuni($row['id']).'<img src="'.$row['img'].'" />'.'</a>';
$array[$i][1]=$row['lat'];
$array[$i][2]=$row['lng'];
$i++;
}
}
//$json = json_encode($array);
?>
