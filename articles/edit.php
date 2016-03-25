<?php

include '../config.php';

$id = $_POST['id'];
$title = $_POST['title'];
$alias = $_POST['alias'];
$content = $_POST['content'];
$author = $_POST['author'];

$sqlarticles = "UPDATE articles SET title=?, content=?, author=? WHERE id=?";	
$q = $db->prepare($sqlarticles);
$q->execute(array($title,$content,$author,$id));

header('location: ../'.$alias.'.php');

?>
