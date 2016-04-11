<?php
//Function to get the guru details
function getguru($id)
{
	global $db;
	$m = $db->prepare("SELECT * FROM munishri, aryika, kshullak, ailak, muni, upadhyay, ailacharya, acharya WHERE id = ? AND approved=1 AND id=aryikaid AND id=kid AND id=ailakid AND id=muniid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid");
	$m->execute(array($id));
	if($m->rowCount() == 1)
	{
		$n = $m->fetch(PDO::FETCH_ASSOC);
		if($n['upadhi'] == 1) $t = $n['aguru'];
		if($n['upadhi'] == 2) $t = $n['ailacharyaguru'];
		if($n['upadhi'] == 3) $t = $n['upadhyayguru'];
		if($n['upadhi'] == 4) $t = $n['muniguru'];
		if($n['upadhi'] == 5) $t = $n['ailakguru'];
		if($n['upadhi'] == 6) $t = $n['kguru'];
		if($n['upadhi'] == 7) $t = $n['aryikaguru'];
		return $t;
	}
	else
	{
		return "N/A";
	}
}
?>
