<?php
if(isset($_GET['year'])) {
	include 'chaturmas/yearly.php';
} else {
	include 'chaturmas/total.php';
}
?>
