<?php

include '../config.php';

$title = $_POST['title'];
$alias = $_POST['alias'];
$content = $_POST['content'];
$author = $_POST['author'];

$sqlarticles = "UPDATE articles SET content=?, author=? WHERE title=?";	
$q = $db->prepare($sqlarticles);
$q->execute(array($content,$author,$title));

header('location: ../'.$alias.'.php');

?>
