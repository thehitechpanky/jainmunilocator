<?php
if(isset($_GET['id'])) {
	include 'munis/profile.php';
} else {
	include 'munis/list.php';
}
