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
		<?php include 'meta.php'; ?>		
		<title><?php echo $title; ?></title>
		
		<?php
include 'stylesheets.php';
		?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="/">Home</a></li>
			<li><a href="#team">'.$title.'</a></li>
			<li><a href="#portfolio">Good Reads</a></li>
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
						<h2><span itemprop="name"><?php echo $title; ?></span></h2>
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
		
		
		<?php
include 'goodreads.php';
include 'contact.php';
include 'footer2.php';
include 'scripts.php';
		?>
		
	</body>
	
</html>
