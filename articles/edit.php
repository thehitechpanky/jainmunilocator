<?php

include '../config.php';
include '../meta.php';

//setting character set
mysql_set_charset('utf8');

$id = $_POST['id'];
$title = $_POST['title'];
$alias = $_POST['alias'];
$content = $_POST['content'];
$keywords = $_POST['keywords'];
$author = $_POST['author'];

$sqlarticles = "UPDATE articles SET title=?, content=?, keywords=?, author=? WHERE id=?";	
$q = $db->prepare($sqlarticles);
$q->execute(array($title,$content,$keywords,$author,$id));

$sqlarticlelog = "INSERT INTO articlelog (id, title, alias, content, keywords, author) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sqlarticlelog);
$q->execute(array($id,$title,$alias,$content,$keywords,$author));

header('location: ../'.$alias.'.php');

?>
