<?php
function getmuni($id)
{
	global $db;
	$m = $db->prepare("SELECT * FROM munishri, upadhis WHERE id = ? AND approved=1 AND uid=upadhi");
	$m->execute(array($id));
	if($m->rowCount() == 1)
	{
		$n = $m->fetch(PDO::FETCH_ASSOC);
		$t = $n['uname'].' '.$n['prefix'].' '.$n['name'].' '.$n['suffix'];
		if($n['title'] == "") {} else {
			$t = $n['title'].' '.$t;
		}
		if($n['alias'] == "") {} else {
			$t = $t.' '.$n['alias'];
		}
		return $t;
	}
	else
	{
		return "N/A";
	}
}
?>
