<?php
include '../config.php';
include 'getGuru.php';
include 'getMuni.php';
include 'getUpadhi.php';
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include '../meta.php'; ?>
		
		<title>Digambara Monks &amp; Nuns | Jain Muni Locator</title>
		
		<?php include '../stylesheets.php'; ?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="#about">Digambara Monks &amp; Nuns</a></li>
	<li><a href="#contact">Contact us</a></li>';
include '../nav.php';
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container">
				<div class="row">
					<h1>Digambara Monks &amp; Nuns</h1>
					<div class="col-md-6">
						<?php
$r2 = $db->query("SELECT * FROM munishri, upadhis WHERE upadhi=uid ORDER BY upadhi, name");
while($row = $r2->fetch(PDO::FETCH_ASSOC)) {
	$id = $row['id'];
	$alias = $row['alias'];
	$img = $row['uname'].'_'.$row['name'];
	if ($alias == '') {} else { $img = $img.'_'.str_replace(array( '(', ')' ), '', $alias); }
	$img = strtolower($img);
	$img = preg_replace('/\s+/', '', $img);
	$img = 'uploads/'.$img.'.jpg';
	//if (file_exists($img)) {} else { $img = 'na.png'; }
	$guruid = getguru($id);
	if($guruid == 0) {
						?>
						<div itemscope itemtype="http://schema.org/Person" class="inline">
							<a href="../munis.php?id=<?php echo $id; ?>">
								<figure>
									<img src="<?php echo $img; ?>" alt="<?php echo getmuni($id); ?>" height="200px" width="150px" itemprop="image">
									<figcaption><span itemprop="honorificPrefix"><?php echo getupadhi($id); ?></span><br />
										<span itemprop="name"><?php echo $row['name']; ?></span></figcaption>
								</figure>
							</a>
						</div>
						<?php
	}
}
						?>
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
							<div class="fb-xfbml-parse-ignore">
								<blockquote cite="https://www.facebook.com/jainmunilocator">
									<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
								</blockquote></div>
						</div>
						<?php include '../adsense.php'; ?>
					</div><!-- /.col-md-6 -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.section -->
		
		<?php
include '../contact.php';
include '../footer2.php';
include '../scripts.php';
		?>
		
	</body>
	
</html>
