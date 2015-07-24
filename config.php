<?php
//Database Connection
$db = new PDO('mysql:host=localhost;dbname=databasename;charset=utf8', 'username', 'password', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$link = mysqli_connect("localhost","username","password","databasename"); 
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

include('phpVariables.php');

//TO DEBUG UNCOMMENT THESE LINES
error_reporting(E_ALL);
ini_set("display_errors", 1);

?>
