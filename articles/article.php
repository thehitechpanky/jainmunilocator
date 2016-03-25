<?php
include 'config.php';
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
		
		<title><?php echo $title; ?></title>
		
		<!-- Bootstrap Core CSS -->
		<?php
include 'bootstrap.php';
include 'stylesheets.php';
		?>
		
		
		<!-- Custom Fonts -->
		<?php include 'font-awesome.php'; ?>
		<link href='http://fonts.googleapis.com/css?family=Raleway:100,600' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
		<?php include 'login/login.php'; ?>
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script>
document.createElement('video');
</script>
<![endif]-->
		
	</head>
	
	<body id="home">
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="/">Home</a></li>
<li><a href="#team">'.$title.'</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include 'nav.php';
		?>
		
		
		<!-- Our team Section -->
		<section id="team" class="team content-section">
			<div class="container">
				<div class="g-signin2" data-onsuccess="onSignIn"></div>
				<div id="edit" class="hidden"><a class="btn btn-default btn-lg" href="articles/editor.php?id=<?php echo $id; ?>">Edit</a></div>
				<div class="row text-center">
					<div class="col-md-12">
						<h2><?php echo $title; ?></h2>
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
				<div class="content"><?php echo $content; ?></div>
				
				<!-- Facebook Comments Started -->
				<hr>
				<div id="fb-root"></div>
				<div class="fb-like" data-href="http://jainmunilocator.org/ekadash-pratima.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
				<div class="fb-comments" data-href="http://jainmunilocator.org/<?php echo $alias; ?>.php" data-numposts="5"></div>
				<!-- Facebook Comments Ended -->
				
			</div><!-- /.container -->
		</section><!-- /.our-team -->
		
		
		
		<!-- Contact section -->
		<?php include 'contact.php'; ?>			
		
		<!-- Footer -->
		<?php include 'footer2.php'; ?>		
		
		<!-- Facebook -->
		<script type='text/javascript' src='js/facebook.js'></script>
		
		<?php
include 'scripts.php';
include 'login/loginscripts.php';
		?>
		
	</body>
	
</html>
