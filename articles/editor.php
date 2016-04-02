<?php

include '../config.php';

$id = $_GET['id'];
$q = $db->prepare('SELECT * FROM articles WHERE id=?');
$q->execute(array($id));
if($q->rowCount() == 1) {
	$row = $q->fetch(PDO::FETCH_ASSOC);
	$title = $row['title'];
	$alias = $row['alias'];
	$content = $row['content'];
	$keywords = $row['keywords'];
}

?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include '../meta.php'; ?>
		<title><?php $title; ?></title>
		
		<?php include '../stylesheets.php'; ?>
		
		<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
		
	</head>
	
	<body id="home">
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="/">Home</a></li>
<li><a href="#team">'.$title.'</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include '../nav.php';
		?>
		
		
		<!-- Our team Section -->
		<section id="team" class="team content-section">
			<div class="container">
				<form id="editForm" action="edit.php" method="POST" class="hidden">
					<div class="row text-center">
						<div class="col-md-12">
							<h2>Editing <?php echo $title; ?></h2>
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<h3>Title <input type="text" name="title" value="<?php echo $title; ?>"></h3>
					<input type="hidden" name="alias" value="<?php echo $alias; ?>">
					<textarea name="content" id="content" rows="10" cols="80" class="hidden"><?php echo $content; ?></textarea>
					<input type="text" id="keywords" name="keywords" value="<?php echo $keywords; ?>">
					<input type="hidden" id="author" name="author">
					<input id="save" type="submit" value="Save">&nbsp;&nbsp;&nbsp;
					<input id="reset" type="reset" value="Reset">&nbsp;&nbsp;&nbsp;
					<input id="cancel" type="button" value="Cancel" onclick="location.href='./munis.php?id=<?php echo $id; ?>';">
				</form>
			</div><!-- /.container -->
		</section><!-- /.our-team -->
		
		
		<?php
include '../contact.php';
include '../footer2.php';
include '../scripts.php';
		?>
		<script>
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			CKEDITOR.replace( 'content' );
		</script>
	</body>
	
</html>
