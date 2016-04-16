<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include 'meta.php'; ?>
		
		<title>Digambara Monks &amp; Nuns | Jain Muni Locator</title>
		
		<?php include 'stylesheets.php'; ?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="#about">Digambara Monks &amp; Nuns</a></li>
	<li><a href="#contact">Contact us</a></li>';
include 'nav.php';
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container">
				<div class="row">
					<h1>Digambara Monks &amp; Nuns</h1>
					<div class="col-md-6">
						<input id="searchMunis" type="text" class="fullWidth" placeholder="Search by typing here... Click on any name below to know more...">
						<div id="searchResults"></div>
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
							<div class="fb-xfbml-parse-ignore">
								<blockquote cite="https://www.facebook.com/jainmunilocator">
									<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
								</blockquote></div>
						</div>
						<?php include 'adsense.php'; ?>
					</div><!-- /.col-md-6 -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.section -->
		
		<?php
include 'contact.php';
include 'footer2.php';
include 'scripts.php';
		?>
		
		<script type="text/javascript" src="munis/search.js"></script>
		
	</body>
	
</html>
