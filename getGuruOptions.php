<?php
// configuration
include('config.php');
 
$guruNameInput=$_REQUEST['guruNameInput'];
if(isset($guruNameInput) == false)
{
	echo "Invalid Access";
	return;
}

$q=$db->prepare("SELECT name,id FROM munishri WHERE name LIKE ?");
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
