<?php
$t = $db->prepare("SELECT * FROM munishri");
$t->execute();
$counttotal = 0;
$countmonks = 0;
$countnuns = 0;
$countjuniors = 0;
while($row = $t->fetch(PDO::FETCH_ASSOC)) {
	$u = $row['upadhi'];
	$counttotal = $counttotal + 1;
	if ($u < 5) { $countmonks = $countmonks + 1; }
	if ($u == 7) { $countnuns = $countnuns + 1; }
	if ($u == 5 || $u == 6 || $u == 8) { $countjuniors = $countjuniors + 1; }
}
?>

<!-- Counter Section -->
<section id="counter" class="counter-section content-section">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">
				<h2 class="white">Stats so far</h2>
				<h3 class="caption">The count is as follows and growing...</h3>
			</div><!-- /.col-md-12 -->
			
			<div class="col-sm-3 counter-wrap wow fadeInUp" data-wow-offset="10">
				<strong><span class="timer"><?php echo $countmonks; ?></span></strong>
				<span class="count-description">Monks<br />(<span itemprop="keywords">Acharya</span>, <span itemprop="keywords">Ailacharya</span>, <span itemprop="keywords">Upadhyay</span>, <span itemprop="keywords">Muni</span>)</span>
			</div><!-- /.col-sm-3 -->
			
			<div class="col-sm-3 counter-wrap wow fadeInUp" data-wow-offset="10">
				<strong><span class="timer"><?php echo $countnuns; ?></span></strong>
				<span class="count-description">Nuns<br />(<span itemprop="keywords">Aryika</span>)</span>
			</div><!-- /.col-sm-3 -->
			
			<div class="col-sm-3 counter-wrap wow fadeInUp" data-wow-offset="10">
				<strong><span class="timer"><?php echo $countjuniors; ?></span></strong>
				<span class="count-description">Juniors<br />(<span itemprop="keywords">Ailak</span>, <span itemprop="keywords">Kshullak</span>, <span itemprop="keywords">Kshullika</span>)</span>
			</div><!-- /.col-sm-3 -->
			
			<div class="col-sm-3 counter-wrap wow fadeInUp" data-wow-offset="10">
				<strong><span class="timer"><?php echo $counttotal; ?></span></strong>
				<span class="count-description">Total</span>
			</div><!-- /.col-sm-3 -->
			
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.counter-section -->


<!-- Call to action - two section -->
<section class="cta-two-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<h3>Have an idea?</h3>
				<p>Let us know what we should do more...</p>
			</div>
			<div class="col-sm-3">
				<a href="https://docs.google.com/forms/d/1sYAbfHaI6MheZWN0EKeVkiqyWD17-0RsSNJ9vEIHRK0/viewform" class="btn btn-overcolor">Get in touch</a>
			</div>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /.cta-two-section -->


<!-- Contact section -->
<section id="contact" class="contact content-section no-bottom-pad wow fadeIn" data-wow-offset="10">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12" itemscope itemtype="http://schema.org/ContactPage">
				<h2><span itemprop="name">Contact</span></h2>
				<p>Feel free to <span itemprop="keywords">get in touch</span> with us if you have a new <span itemprop="keywords">project</span> or simply something <span itemprop="keywords">awesome</span></p>
			</div><!-- /.col-md-12 -->
			
		</div><!-- /.row -->
	</div><!-- /.container -->
	
	<div class="container">
		<div class="row form-container">
			
			<div class="col-md-8 contact-form">
				<h3>Drop us a word</h3>
				<form class="ajax-form" id="contactForm" method="post" action="assets/php/contact.php">
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Your Name..." value="" required>
					</div>
					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="Your email..." value="" required>
					</div>
					<div class="form-group">
						<input type="phone" class="form-control" id="phone" name="phone" placeholder="Your phone..." value="" required>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="4" name="message" placeholder="Your message..." required></textarea>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-default"><i class="fa fa-paper-plane fa-fw"></i> Send</button>
					</div>
				</form>
			</div><!-- /.contact-form -->
			
			<div class="col-md-4 contact-address" itemscope itemtype="http://schema.org/Person">
				<h3><span itemprop="jobTitle">Administrator</span></h3>
				<div class="team-member wow fadeIn" data-wow-offset="10">
					<figure>
						<img src="../assets/images/pankaj-jain.jpg" alt="Pankaj Jain" class="img-responsive">
						<figcaption>
							<center>
								<h1><span itemprop="name">Pankaj Jain</span></h1>
								<p><i class="fa fa-envelope fa-fw"></i>&nbsp; <span itemprop="email">capankajjain@smilyo.com</span></p>
								<p><i class="fa fa-phone fa-fw"></i>&nbsp; <span itemprop="telephone">+91 9818609955</span></p>
								<ul>
									<li><a href="https://www.facebook.com/thehitechpanky"><i class="fa fa-facebook fa-2x"></i></a></li>
									<li><a href="https://twitter.com/thehitechpanky"><i class="fa fa-twitter fa-2x"></i></a></li>
									<li><a href="https://www.linkedin.com/in/thehitechpanky"><i class="fa fa-linkedin fa-2x"></i></a></li>
								</ul>
							</center>
						</figcaption>
					</figure>
				</div><!-- /.team-member -->
			</div><!-- /.contact-address -->
			
		</div><!-- /.row -->
	</div><!-- /.container -->
