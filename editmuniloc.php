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
		echo '<div id="lat" style="display:none">'.$f['lat'].'</div><div id="lng" style="display:none">'.$f['lng'].'</div><table><tr><td>Address</td><td><input type="text" id="x"></td></tr>';
	}
}
?>
</table>
<input type="button" id="wow" value="Submit">
<input type="button" id="cancel" value="Cancel" onclick="history.back();">
