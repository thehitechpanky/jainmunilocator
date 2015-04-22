<?php
include('config.php');
if(isset($_POST['muniid']))
{
	$id = (int)$_POST['muniid'];
	$q = $db->prepare("SELECT * FROM muni_location WHERE mid = ?");
	$q->execute(array($id));
	if($q->rowCount() == 1)
	{
		$f = $q->fetch(PDO::FETCH_ASSOC);
		echo '<input type="hidden" id="lat" style="display:none" value="'.$f['lat'].'"><input type="hidden" id="lng" style="display:none" value="'.$f['lng'].'"><table><tr><td>Address</td><td><input type="text" id="x"></td></tr>';
		echo '</table>
<input type="button" id="wow" value="Submit">
<input type="button" id="cancel" value="Cancel" onclick="history.back();">';
	}
}
if(isset($_POST['mid']))
{
	$id = (int)$_POST['mid'];
	$q = $db->prepare("UPDATE muni_location SET lat = ?,lng = ? WHERE mid=?");
	$q->execute(array($_POST['lat'],$_POST['lng'],$id));
	echo $_POST['lat'].'-'.$_POST['lng'].'-'.$id;
}
?>
