<?php
// configuration
include('config.php');
 
$guruNameInput=$_REQUEST['guruNameInput'];
if(isset($guruNameInput) == false)
{
	echo "Invalid Access";
	return;
}

$q=$db->prepare("SELECT id, name, alias, uid, prefix, uname, suffix FROM munishri, upadhis WHERE name LIKE ? AND upadhi=uid");
$q->execute(array("%".$guruNameInput."%"));

if($q->rowCount() != 0)
{
	while($row = $q->fetch(PDO::FETCH_ASSOC))
	{
		
		$guruNameOutput[]=$row;
	}
}
 
print(json_encode($guruNameOutput));
?>
