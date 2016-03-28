<?php

include '../config.php';
include '../meta.php';

//setting character set
mysql_set_charset('utf8');

$id = $_POST['id'];
$title = $_POST['title'];
$alias = $_POST['alias'];
$content = $_POST['content'];
$author = $_POST['author'];

$sqlarticles = "UPDATE articles SET title=?, content=?, author=? WHERE id=?";	
$q = $db->prepare($sqlarticles);
$q->execute(array($title,$content,$author,$id));

$sqlarticlelog = "INSERT INTO articlelog (id, title, content, author) VALUES (?,?,?,?)";
$q = $db->prepare($sqlarticlelog);
$q->execute(array($id,$title,$content,$author));

header('location: ../'.$alias.'.php');

?>
