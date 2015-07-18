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
			$t = $db->prepare('INSERT INTO munishri (upadhi,name,alias,website,img,birthname,dob,father,mother) VALUES (?,?,?,?,?,?,?,?,?)');
			if(!$t->execute(array($upadhi,$name,$alias,$website,$photo,$birthname,$dob,$father,$mother)))
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
			<fieldset>
				<form method="post" action="">
					<div>
						<select id="upadhi" name="upadhi" class="mediumBox" onchange="showPrefix(this.value); showSuffix(this.value);">
							<option value="" style='display:none;' disabled selected>Upadhi</option>
							<option value="1">Acharya</option>
							<option value="2">Ailacharya</option>
							<option value="3">Upadhyay</option>
							<option value="4">Muni</option>
							<option value="5">Ailak</option>
							<option value="6">Kshullak</option>
							<option value="7">Aryika</option>
						</select>
						<div id="prefix_here" class="inlineDiv"></div>
						<input type="text" value="" placeholder="Name" name="name" class="smallBox" />
						<div id="suffix_here" class="inlineDiv"></div>
						<input type="text" value="" placeholder="Alias" name="alias" class="verySmallBox" /><br />						
						<input type="text" value="" placeholder="Current Location" name="location" class="longBox" /><br />						
						<input type="text" value="" placeholder="Website" name="website"><br />
						<input type="text" value="" placeholder="Image Link" name="photo"><br />
						<input type="hidden" value="" placeholder="Acharya Pad Date in YYYY-MM-DD" id="addacharyadate" name="adate" />
						<input type="hidden" value="" placeholder="Acharya Pad Given by" id="addacharyaguru" name="aguru" class="longBox" />
						<input type="hidden" value="" placeholder="Muni Deeksha Date in YYYY-MM-DD" id="addmunidate" name="munidate" />
						<input type="hidden" value="" placeholder="Muni Deeksha Given by" id="addmuniguru" name="muniguru" class="longBox" />
						<input type="hidden" value="" placeholder="Aryika Deeksha Date in YYYY-MM-DD" id="addaryikadate" name="aryikadate" />
						<input type="hidden" value="" placeholder="Aryika Deeksha Given by" id="addaryikaguru" name="aryikaguru" class="longBox" />
						<input type="text" value="" placeholder="Birth Name" name="birthname"><br />
						<input type="text" value="" placeholder="Date of Birth in YYYY-MM-DD" name="dob"><br />
						<input type="text" value="" placeholder="Father" name="father"><br />
						<input type="text" value="" placeholder="Mother" name="mother"><br />
						<div class="g-recaptcha" data-sitekey="6LcXYP8SAAAAAM8199rOJV8yoCWS4mI5FHb5Q70Q"></div><br />
						<input type="submit" name="submit" value="Submit" />
					</div>
				</form>
			</fieldset>
	
		</div>
		<div class="sidebar">
			<img alt="Acharya Kundkund | Jain Muni Locator" src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" style="width:200px;margin-right:5px">
		</div>
		<!-- end widgets -->
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
