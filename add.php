<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" >

	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
	
	<!-- start navigation -->
	<?php include('menu.php'); ?>
	<!-- end navigation -->
	
	<!-- start content wrapper -->	
	
	<div class="content page-content">
	
		<div class="page-title">
			<h1>Add Information About Munis</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">	
		<?php
		if(isset($_POST['submit']))
		{
			foreach($_POST as $key => $con)
			{
				if($con == "")
					$con = "N/A";
				$$key = htmlentities(strip_tags($con));				
			}
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcXYP8SAAAAAH7WUPMtiHoEiTnev6ofbzsuRY4U&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR'];
			$text = file_get_contents($url);
		if(strpos($text,'true'))
		{
			$t = $db->prepare('INSERT INTO munishri (upadhi,name,website,img,birthname,dob,father,mother) VALUES (?,?,?,?,?,?,?,?)');
			if(!$t->execute(array($upadhi,$name,$website,$photo,$birthname,$dob,$father,$mother)))
			{
				echo "<div style='color:red'>Some error encountered.Please Contact the website administrator<br /></div>";
			}
			else
			{
				echo "<div style='color:green'>Information Submitted successfully. It will appear on the website once approved by the administrator<br /></div>";
			}
			
		}
		else
		{
			echo "no";
		}
		}
		?>
			<fieldset><center>
				<form method="post" action="">
					<div>
						<input type="text" value="" placeholder="Upadhi" name="upadhi"><br />
						<input type="text" value="" placeholder="Name" name="name"><br />
						<input type="text" value="" placeholder="Website" name="website"><br />
						<input type="text" value="" placeholder="Photo Link" name="photo"><br />
						<input type="text" value="" placeholder="Birth Name" name="birthname"><br />
						<input type="text" value="" placeholder="Date of Birth in YYYY-MM-DD" name="dob"><br />
						<input type="text" value="" placeholder="Father" name="father"><br />
						<input type="text" value="" placeholder="Mother" name="mother"><br />
						<div class="g-recaptcha" data-sitekey="6LcXYP8SAAAAAM8199rOJV8yoCWS4mI5FHb5Q70Q"></div><br />
						<input type="submit" name="submit" value="Submit" />
					</div>
				</form>	</center>
			</fieldset>
	
		</div>
		<div class="sidebar">
		<img src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" style="width:200px;margin-right:5px">
		</div>
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
