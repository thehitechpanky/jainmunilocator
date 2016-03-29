<?php $metaKeywords = 'Jain Muni Locator, Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, list of all digamabar jain munis'; ?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include 'meta.php'; ?>
		
		<title>Jain Muni Locator - Home</title>
		
		<?php
include 'stylesheets.php';
		?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="#about">About us</a></li>
                                <li><a href="#services">Explore</a></li>
                                <li><a href="#products">Mobile App</a></li>
                                <li><a href="#portfolio">Good Reads</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include 'nav.php';
		?>
		
		
		<!-- Intro Header -->
		<!-- Full Page Image Background Carousel Header -->
		<header id="intro-carousel" class="carousel slide">
			<!-- Optional Indicators -->
			<!-- <ol class="carousel-indicators">
<li data-target="#intro-carousel" data-slide-to="0" class="active"></li>
<li data-target="#intro-carousel" data-slide-to="1"></li>
<li data-target="#intro-carousel" data-slide-to="2"></li>
</ol> -->
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<!-- Set the first background image using inline CSS below. -->
					<div class="fill" style="background-image:url('assets/images/mataji.jpg');"></div>
					<div class="carousel-caption">
						<h1 class="wow animated slideInDown"><span itemprop="name">Jain Muni <span class="highlight">Locator</span></span></h1>
						<p class="intro-text wow animated slideInUp">One-stop online destination for Digambara Jains. Know about Jainism and its glory.</p>
						<a href="map.php" class="btn btn-default btn-lg">Locate</a>
					</div>
					<div class="overlay-detail"></div>
				</div><!-- /.item -->
				
				<div class="item">
					<!-- Set the second background image using inline CSS below. -->
					<div class="fill" style="background-image:url('assets/images/vidyasagar.jpg');"></div>
					<div class="carousel-caption">
						<h1 class="wow animated slideInDown"><span class="highlight">Monks &amp; Nuns</span> Biography</h1>
						<p class="intro-text wow animated slideInUp">Find out about the life events and disciples of Digambara Monks &amp; Nuns.</p>
						<a href="munis.php" class="btn btn-default btn-lg">Monks &amp; Nuns</a>
					</div>
					<div class="overlay-detail"></div>
				</div><!-- /.item -->
				
				<div class="item">
					<!-- Set the second background image using inline CSS below. -->
					<div class="fill" style="background-image:url('assets/images/muni.jpg');"></div>
					<div class="carousel-caption">
						<h1 class="wow animated slideInDown">Jain Muni Locator <span class="highlight">Facebook</span> Page</h1>
						<p class="intro-text wow animated slideInUp">Get up to date information about Digambara monks &amp; Nuns and our initiatives.</p>
						<a href="https://www.facebook.com/jainmunilocator/" class="btn btn-default btn-lg">Go to Facebook</a>
					</div>
					<div class="overlay-detail"></div>
				</div><!-- /.item -->
				
			</div>
			<!-- Controls -->
			<a class="left carousel-control squared" href="#intro-carousel" data-slide="prev">
				<i class="fa fa-angle-left fa-2x"></i>
			</a>
			<a class="right carousel-control squared" href="#intro-carousel" data-slide="next">
				<i class="fa fa-angle-right fa-2x"></i>
			</a>
			<div class="mouse"></div>
		</header>
		
		
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container" itemscope itemtype="http://schema.org/AboutPage">
				<div class="row">
					<div class="col-md-6">
						<h2>Excited about <span itemprop="name">Jain Muni Locator</span></h2>
						<p><strong>Guess where does our information come from?</strong></p>
						<p>That's right, it's <strong>"YOU"</strong>. You are the one who have contributed in building this website. It's you who let us know, where monks &amp; currently are.</p>
						
						<blockquote>
							There is no enemy out of your soul. The real enemies live inside yourself, they are anger, proud, curvedness, greed, attachmentes and hate.
							<span><strong>Lord Mahavira</strong></span>
						</blockquote>
						
						<p>Thanks a lot for your continuous support. We would do our best to make your Jain Muni Locator experience better than what it is today.</p>
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
							<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
								<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
								</blockquote></div>
						</div>
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<?php include 'adsense.php'; ?>
					</div><!-- /.col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.section -->
		
		
		
		<!-- Services Section -->
		<section id="services" class="services content-section">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-12">
						<h2>Explore</h2>
						<p><strong>What would you like to do today?</strong></p>
					</div><!-- /.col-md-12 -->
					
					<div class="container">
						<div class="row text-center">
							<a href="munis.php">
								<div class="col-md-4">
									<div class="row services-item text-center wow flipInX" data-wow-offset="10">
										<i class="fa fa-male fa-3x"></i>
										<h4>Monks &amp; Nuns</h4>
										<p>Check out profile and disciples.</p>
									</div><!-- /.row -->
								</div><!-- /.col-md-4 -->
							</a>
							
							<a href="map.php">
								<div class="col-md-4">
									<div class="row services-item text-center wow flipInX" data-wow-offset="10">
										<i class="fa fa-globe fa-3x"></i>
										<h4>Map</h4>
										<p>Locate Jain Saints and Nuns on a single map.</p>
									</div><!-- /.row -->
								</div><!-- /.col-md-4 -->
							</a>
							
							<a href="">
								<div class="col-md-4">
									<div class="row services-item text-center wow flipInX" data-wow-offset="10">
										<i class="fa fa-street-view fa-3x"></i>
										<h4>Tirthankara</h4>
										<p>Check biographies of Jain Tirthankaras.</p>
									</div><!-- /.row -->
								</div><!-- /.col-md-4 -->
							</a>
							
							<a href="events.php">
								<div class="col-md-4">
									<div class="row services-item text-center wow flipInX" data-wow-offset="20">
										<i class="fa fa-calendar fa-3x"></i>
										<h4>Events</h4>
										<p>Find out whats special about today.</p>
									</div><!-- /.row -->
								</div><!-- /.col-md-4 -->
							</a>
							
							<a href="chaturmas.php">
								<div class="col-md-4">
									<div class="row services-item text-center wow flipInX" data-wow-offset="20">
										<i class="fa fa-bullhorn fa-3x"></i>
										<h4>Chaturmas</h4>
										<p>Know about the current and previous chaturmas places.</p>
									</div><!-- /.row -->
								</div><!-- /.col-md-4 -->
							</a>
							
							<a href="timeline.php">
								<div class="col-md-4">
									<div class="row services-item text-center wow flipInX" data-wow-offset="20">
										<i class="fa fa-clock-o fa-3x"></i>
										<h4>Timeline</h4>
										<p>Check out the timeline to Jainism.</p>
									</div><!-- /.row -->
								</div><!-- /.col-md-4 -->
							</a>
							
						</div><!-- /.row -->
					</div><!-- /.container -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.section -->
		
		
		
		<!-- Products Section -->
		<section id="products" class="products content-section">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<img src="assets/images/hallooou_template-iphone_white.png" class="center-block img-responsive">
					</div><!-- /.col-md-4 -->
					
					<div class="col-md-8">
						<div class="products-container">
							
							<div class="col-md-12">
								<h2>We will soon launch our mobile app!</h2>
								<h3 class="caption white">You can know about Jainism from a tap on your smartphone screen. Won't that be awesome?</h3>
							</div><!-- /.col-md-12 -->
							
							<div class="col-md-6 product-item wow fadeIn" data-wow-offset="10">
								<div class="media-left">
									<span class="icon"><i class="fa fa-arrows-alt fa-3x"></i></span>
								</div><!-- /.media-left -->
								<div class="media-body">
									<h3 class="media-heading">Responsive Layout</h3>
									<p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>
								</div><!-- /.media-body -->
							</div><!-- /.col-md-6 -->
							
							<div class="col-md-6 product-item wow fadeIn" data-wow-offset="10">
								<div class="media-left">
									<span class="icon"><i class="fa fa-eye fa-3x"></i></span>
								</div><!-- /.media-left -->
								<div class="media-body">
									<h3 class="media-heading">Retina Ready Graphics</h3>
									<p>Looks beautiful &amp; ultra-sharp on Retina Displays with Retina Icons, Fonts &amp; Images.</p>
								</div><!-- /.media-body -->
							</div><!-- /.col-md-6 -->
							
							<div class="col-md-6 product-item wow fadeIn" data-wow-offset="10">
								<div class="media-left">
									<span class="icon"><i class="fa fa-arrows-v fa-3x"></i></span>
								</div><!-- /.media-left -->
								<div class="media-body">
									<h3 class="media-heading">Parallax Sections</h3>
									<p>Comes with Parallax effect script so you can add Parallax effect to any section of the website.</p>
								</div><!-- /.media-body -->
							</div><!-- /.col-md-6 -->
							
							<div class="col-md-6 product-item wow fadeIn" data-wow-offset="10">
								<div class="media-left">
									<span class="icon"><i class="fa fa-video-camera fa-3x"></i></span>
								</div><!-- /.media-left -->
								<div class="media-body">
									<h3 class="media-heading">YouTube &amp; HTML5 Background Video</h3>
									<p>Choose to display either YouTube or HTML5 as background video.</p>
								</div><!-- /.media-body -->
							</div><!-- /.col-md-6 -->
							
							<div class="col-md-6 product-item wow fadeIn" data-wow-offset="10">
								<div class="media-left">
									<span class="icon"><i class="fa fa-toggle-on fa-3x"></i></span>
								</div><!-- /.media-left -->
								<div class="media-body">
									<h3 class="media-heading">Color Options</h3>
									<p>Choose a color that suits your brand &amp; change the color of the template with just one CSS file.</p>
								</div><!-- /.media-body -->
							</div><!-- /.col-md-6 -->
							
							<div class="col-md-6 product-item wow fadeIn" data-wow-offset="10">
								<div class="media-left">
									<span class="icon"><i class="fa fa-envelope-o fa-3x"></i></span>
								</div><!-- /.media-left -->
								<div class="media-body">
									<h3 class="media-heading">Contact form</h3>
									<p>Fully functional PHP contact form, with user input validation.</p>
								</div><!-- /.media-body -->
							</div><!-- /.col-md-6 -->
							
						</div><!-- /.products-container -->
					</div><!-- /.col-md-8 -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.products -->
		
		<?php
include 'goodreads.php';		
include 'contact.php';
include 'footer2.php';
include 'scripts.php';
		?>
		
	</body>
	
</html>
