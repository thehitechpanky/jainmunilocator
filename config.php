<?php
$db = new PDO('mysql:host=localhost;dbname=smilyo_jainmunilocator;charset=utf8', 'smilyo_jainmuni', '2273062@', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$link = mysqli_connect("localhost","smilyo_pankaj","4043755","smilyo_jainmunilocator"); 
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
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
?>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TNP6GC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TNP6GC');</script>
<!-- End Google Tag Manager -->
