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
}

?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php $title; ?></title>
		
		<!-- Bootstrap Core CSS -->
		<?php include '../bootstrap.php'; ?>
		
		<?php include '../stylesheets.php'; ?>		
		
		<!-- Custom Fonts -->
		<?php include '../font-awesome.php'; ?>
		<link href='http://fonts.googleapis.com/css?family=Raleway:100,600' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
		<?php include '../login/login.php'; ?>
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script>
document.createElement('video');
</script>
<![endif]-->
		
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
				<div class="g-signin2" data-onsuccess="onSignIn"></div>
				<form id="editForm" action="edit.php" method="POST">
					<div class="row text-center">
						<div class="col-md-12">
							<h2>Editing <?php echo $title; ?></h2>
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<h3>Title <input type="text" name="title" value="<?php echo $title; ?>"></h3>
					<input type="hidden" name="alias" value="<?php echo $alias; ?>">
					<textarea name="content" id="content" rows="10" cols="80" class="hidden"><?php echo $content; ?></textarea>
					<input type="hidden" id="author" name="author">
					<input id="save" type="submit" value="Save" class="hidden">&nbsp;&nbsp;&nbsp;
					<input id="reset" type="reset" value="Reset" class="hidden">&nbsp;&nbsp;&nbsp;
					<input id="cancel" type="button" value="Cancel" onclick="location.href='./munis.php?id=<?php echo $id; ?>';" class="hidden">
				</form>
			</div><!-- /.container -->
		</section><!-- /.our-team -->
		
		
		
		<!-- Contact section -->
		<?php
include '../contact.php';
include '../footer2.php';
		?>		
		
		<!-- Facebook -->
		<script type='text/javascript' src='js/facebook.js'></script>
		<?php
include '../scripts.php';
include '../login/loginscripts.php';
		?>
		<script>
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			CKEDITOR.replace( 'content' );
		</script>
	</body>
	
</html>
