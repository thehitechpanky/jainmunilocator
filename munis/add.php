<?php include '../config.php'; ?>


<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php include '../meta.php'; ?>
		
		<title>Add Monk / Nun | Jain Muni Locator</title>
		
		<?php include '../stylesheets.php';	?>
		
	</head>
	
	<body id="home" itemscope itemtype="http://schema.org/WebPage">
		
		<!-- Navigation -->
		<?php
$navLinks = '<li><a href="/">Home</a></li>
<li><a href="#about">Add</a></li>
<li><a href="../munis.php">Monk list</a></li>
                                <li><a href="#contact">Contact us</a></li>';
include '../nav.php'
		?>
		
		<!-- About Section -->
		<section id="about" class="about content-section alt-bg-light wow fadeInUp" data-wow-offset="10">
			<div class="container">
				<div class="row">
					<h2>Add Monk / Nun</h2>
					
					<div class="col-md-6">
						
						<?php
	if (isset($_POST['submit'])) {
	foreach($_POST as $key => $con) {
		$$key = htmlentities(strip_tags($con));				
	}
	$t = $db->prepare('INSERT INTO munishri (upadhi,name,vairagya,birthname,dob,father,mother) VALUES (?,?,?,?,?,?,?)');
	if(!$t->execute(array($upadhi,$name,$vairagya,$birthname,$dob,$father,$mother))) {
		echo "<div style='color:red'>Some error encountered.Please Contact the website administrator<br /></div>";
	} else {
		echo "<div style='color:green'>Information Submitted successfully. It will appear on the website once approved by the administrator<br /></div>";
	}
}
						?>
						
						<form id="editForm" action="" method="POST" class="hidden">
							<select id="upadhi" name="upadhi" class="mediumBox">
								<option value="0" disabled selected>Upadhi</option>
								<option value="1">Acharya</option>
								<option value="2">Ailacharya</option>
								<option value="3">Upadhyay</option>
								<option value="4" selected>Muni</option>
								<option value="5">Ailak</option>
								<option value="6">Kshullak</option>
								<option value="7">Aryika</option>
								<option value="8">Kshullika</option>
							</select>
							
							<div id="prefix_here" class="inline"></div>
							<input type="text" value="" placeholder="Name" name="name" class="smallBox" />
							<div id="suffix_here" class="inline"></div>
							<input type="text" value="" placeholder="Alias" name="alias" class="verySmallBox" /><br />						
							<input type="text" value="" placeholder="Current Location" name="location" class="longBox" /><br />						
							<input type="text" value="" placeholder="Website" name="website" /><br />
							<input type="text" value="" placeholder="Image Link" name="img" /><br />
							
							<div id="acharya" class="hidden">
								<input type="text" value="" placeholder="Acharya Pad Date in YYYY-MM-DD" id="adate" name="adate" />
								<input type="text" value="" placeholder="Acharya Pad Given by" id="aguru" name="aguru" class="longBox" />
							</div>
							
							<div id="ailacharya" class="hidden">
								<input type="text" value="" placeholder="Ailacharya Pad Date in YYYY-MM-DD" id="ailacharyadate" name="ailacharyadate" />
								<input type="text" value="" placeholder="Ailacharya Pad Given by" id="ailacharyaguru" name="ailacharyaguru" class="longBox" />
							</div>
							
							<div id="upadhyay" class="hidden">
								<input type="text" value="" placeholder="Upadhyay Pad Date in YYYY-MM-DD" id="upadhyaydate" name="upadhyaydate" />
								<input type="text" value="" placeholder="Upadhyay Pad Given by" id="upadhyayguru" name="upadhyayguru" class="longBox" />
							</div>
							
							<div id="muni" class="hidden">
								<input type="text" value="" placeholder="Muni Deeksha Date in YYYY-MM-DD" id="munidate" name="munidate" />
								<input type="text" value="" placeholder="Muni Deeksha Given by" id="muniguru" name="muniguru" class="longBox" />
							</div>
							
							<div id="ailak" class="hidden">
								<input type="text" value="" placeholder="Ailak Deeksha Date in YYYY-MM-DD" id="ailakdate" name="ailakdate" />
								<input type="text" value="" placeholder="Ailak Deeksha Given by" id="ailakguru" name="ailakguru" class="longBox" />
							</div>
							
							<div id="kshullak" class="hidden">
								<input type="text" value="" placeholder="Kshullak Deeksha Date in YYYY-MM-DD" id="kdate" name="kdate" />
								<input type="text" value="" placeholder="Kshullak Deeksha Given by" id="kguru" name="kguru" class="longBox" />
							</div>
							
							<div id="aryika" class="hidden">
								<input type="text" value="" placeholder="Aryika Deeksha Date in YYYY-MM-DD" id="aryikadate" name="aryikadate" />
								<input type="text" value="" placeholder="Aryika Deeksha Given by" id="aryikaguru" name="aryikaguru" class="longBox" />
							</div>
							
							<div id="kshullika" class="hidden">
								<input type="text" value="" placeholder="Kshullika Deeksha Date in YYYY-MM-DD" id="kshullikadate" name="kshullikadate" />
								<input type="text" value="" placeholder="Kshullika Deeksha Given by" id="kshullikaguru" name="kshullikaguru" class="longBox" />
							</div>
							
							<input type="text" value="" placeholder="Vairagya Date in YYYY-MM-DD" name="vairagya"><br />
							
							<input type="text" value="" placeholder="Birth Name" name="birthname"><br />
							<input type="text" value="" placeholder="Date of Birth in YYYY-MM-DD" name="dob"><br />
							<input type="text" value="" placeholder="Father" name="father"><br />
							<input type="text" value="" placeholder="Mother" name="mother"><br />
							<input type="submit" name="submit" value="Submit" />
							
						</form>
						
					</div><!-- /.col-md-6 -->
					
					<div class="col-md-6">
						<div class="sidebar">
							<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
								<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
									<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
									</blockquote>
								</div>
							</div>
							<?php include '../adsense.php'; ?>
						</div>
					</div><!-- /.col-md-6 -->
					
				</div><!-- /.row -->
			</div><!-- /.container -->
			
		</section><!-- /.section -->
		
		
		<?php
include '../contact.php';
include '../footer2.php';
include '../scripts.php';
		?>
		
		<script type='text/javascript' src='formActions.js'></script>
		
	</body>
	
</html>
