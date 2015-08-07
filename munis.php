<?php include('header.php'); ?>

<!-- start body -->
<body <?php echo $schemaOrgBody; ?>>
	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
		
	<!-- start navigation -->
	<?php include('menu.php'); ?>
	<!-- end navigation -->
	
	<!-- start content wrapper -->	
	
		<div class="container" <?php echo $schemaOrg; ?>>

		<div class="page-title">
			<h1><span itemprop="name"><?php echo $title; ?></span></h1>
		</div>
		
		<div class="divider clear"></div>
		
		<?php
		if(!$showmuni) {echo
			'<div class="inner-content">
			<h4>List of All Digambar Jain Munis is given Below. Click on the name to see more information</h4>
			<input id="searchBoxMuni" name="searchBox" type="text" class="fullWidth" />
			<div id="searchResults" class="hoverImg"></div>
			
			<br /><hr>
			
			<!-- Facebook Comments Started -->
			<div id="fb-root"></div>
			<div class="fb-like" data-href="http://jainmunilocator.org/munis.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<div class="fb-comments" data-href="http://jainmunilocator.org/munis.php" data-numposts="5"></div>
			<!-- Facebook Comments Ended -->
			
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			
			</div>
			
			<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
				<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
					<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
				</blockquote></div>
			</div>';
						
			$loadSearchScript="Yes";
		
		} else {
				
				//Gurudev Profile Details
				echo '<div style="float:left;width:50%"><table style="width:100%">';
					
				if($getinfo['dos']=="0000-00-00") {echo
					'<tr><td>Current Location</td><td>
					<div itemscope itemtype="http://schema.org/Place"><span itemprop="address">'.$getinfo['location'].'</span></div>
					</td></tr>'
					;}
				
				if ($getinfo['website']!="#") {echo
					'<tr><td>Website</td>
					<td><a href="'.$getinfo['website'].'" target="_blank" itemprop="url">'.$getinfo['website'].'</a></td></tr>'
					;}
				
				if($getinfo['dos']=="0000-00-00") {echo
				'<tr><td>Contact</td><td>
					<a title="Phone" target="" href="#">
						<img width="25" height="25" title="'.$getinfo['phone'].'" alt="Phone | Jain Muni Locator" src="./images/icons/phone30x30.png" />
					</a>
					<a title="Email" target="" href="mailto:'.$getinfo['email'].'" itemprop="email">
						<img width="25" height="25" title="'.$getinfo['email'].'" alt="Email | Jain Muni Locator" src="./images/icons/20-social-media-icons/57x57/email-blue.png" />
					</a>
					<a title="Facebook" target="_blank" href="'.$getinfo['facebook'].'">
						<img width="25" height="25" title="Facebook Page" alt="Facebook | Jain Muni Locator" src="./images/icons/20-social-media-icons/57x57/facebook.png" />
					</a>
					<a title="Google Plus" target="_blank" href="'.$getinfo['gplus'].'">
						<img width="25" height="25" title="Google Plus Page" alt="Google Plus | Jain Muni Locator" src="./images/icons/20-social-media-icons/57x57/googleplus.png" />
					</a>
					<a title="Youtube" target="_blank" href="'.$getinfo['youtube'].'">
						<img width="25" height="25" title="Youtube Page" alt="Youtube | Jain Muni Locator" src="./images/icons/20-social-media-icons/57x57/youtube.png" />
					</a>
					<a title="Wikipedia" target="_blank" href="'.$getinfo['wikipedia'].'">
						<img width="25" height="25" title="Wikipedia Page" alt="Wikipedia | Jain Muni Locator" src="./images/icons/wiki.png" />
					</a>
				</td></tr>'
				;}
				
				if($getinfo['dos']!="0000-00-00") {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Samadhi Details</th></tr>
				<tr><td>Date</td><td><span itemprop="deathDate">'.$getinfo['dos'].'</span></td></tr>
				<tr><td>Place</td><td><span itemprop="deathPlace">'.$getinfo['samadhiplace'].'</span></td></tr>'
				;}
				
				// Publish a list of Books Written by Muni.
				echo
					'<tr><td colspan="2"></td></tr>
					<tr><th colspan="2" align="left">Books</th></tr>'
					;
				$b = $db->prepare("SELECT * FROM books WHERE bguru = '$id'");
				$b->execute();
				while($brow = $b->fetch(PDO::FETCH_ASSOC)) {
					$i++;
					echo '<tr><td colspan="2"><div class="hoverImg" itemscope itemtype="http://schema.org/Book">
					<a href="'.$brow['blink'].'" itemprop="url">'.$i.' <span itemprop="name">'.$brow['bname'].'</span>
					<img class="smallLight" src="'.$brow['bimg'].'" alt="'.$brow['bname'].'" itemprop="image" />
					</a></div></td></tr>';
					}
				
				// Publish a list of Chaturmas Held at various locations so far.
				echo
					'<tr><td colspan="2"></td></tr>
					<tr><th colspan="2" align="left">Chaturmas</th></tr>'
					;
				$c = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni='$id' AND chaturmasplace!='N/A'");
				$c->execute();
				while($crow = $c->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr><td>'.$crow['chaturmasyear'].'</td><td>
					<div itemscope itemtype="http://schema.org/Place"><span itemprop="address">
					'.$crow['chaturmasplace'].'</span></div></td></tr>';
					}
				
				if($getinfo['upadhi']=="1") {echo
					'<tr><td colspan="2"></td></tr>
					<tr><th colspan="2" align="left">Acharya Pad Details</th></tr>
					<tr><td>Date</td><td><time datetime="'.$getinfo['adate'].'">'.$getinfo['adate'].'</time></td></tr>
					<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['aguru'].'">'.getmuni($getinfo['aguru']).'
					<img class="smallLight" src="'.getImg($getinfo['aguru']).'" alt="'.getmuni($getinfo['aguru']).'" />
					</a></div></td></tr>
					<tr><td>Place</td><td>'.$getinfo['aplace'].'</td></tr>'
					;}
				
				if($getinfo['ailacharyaguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Elacharya Pad Details</th></tr>';
					if($getinfo['ailacharyaname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['ailacharyaname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['ailacharyadate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['ailacharyaguru'].'">'.getmuni($getinfo['ailacharyaguru']).'
				<img class="smallLight" src="'.getImg($getinfo['ailacharyaguru']).'" alt="'.getmuni($getinfo['ailacharyaguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['ailacharyaplace'].'</td></tr>'
				;}
				
				if($getinfo['upadhyayguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Upadhyay Pad Details</th></tr>';
					if($getinfo['upadhyayname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['upadhyayname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['upadhyaydate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['upadhyayguru'].'">'.getmuni($getinfo['upadhyayguru']).'
				<img class="smallLight" src="'.getImg($getinfo['upadhyayguru']).'" alt="'.getmuni($getinfo['upadhyayguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['upadhyayplace'].'</td></tr>'
				;}
				
				if($getinfo['upadhi']<5) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Muni Deeksha Details</th></tr>';
					if($getinfo['muniname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['muniname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['munidate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['muniguru'].'">'.getmuni($getinfo['muniguru']).'
				<img class="smallLight" src="'.getImg($getinfo['muniguru']).'" alt="'.getmuni($getinfo['muniguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['muniplace'].'</td></tr>'
				;}
				
				if($getinfo['ailakguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Ailak Deeksha Details</th></tr>';
					if($getinfo['ailakname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['ailakname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['ailakdate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['ailakguru'].'">'.getmuni($getinfo['ailakguru']).'
				<img class="smallLight" src="'.getImg($getinfo['ailakguru']).'" alt="'.getmuni($getinfo['ailakguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['ailakplace'].'</td></tr>'
				;}
					
				if($getinfo['kguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Kshullak Deeksha Details</th></tr>';
					if($getinfo['ailacharyaname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['kname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['kdate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['kguru'].'">'.getmuni($getinfo['kguru']).'
				<img class="smallLight" src="'.getImg($getinfo['kguru']).'" alt="'.getmuni($getinfo['kguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['kplace'].'</td></tr>'
				;}
				
				if($getinfo['upadhi']==7) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Aryika Deeksha Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['aryikadate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['aryikaguru'].'">'.getmuni($getinfo['aryikaguru']).'
				<img class="smallLight" src="'.getImg($getinfo['aryikaguru']).'" alt="'.getmuni($getinfo['aryikaguru']).'" />
				</a></div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['aryikaplace'].'</td></tr>'
				;}
				
				if($getinfo['kshullikaguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Kshullika Deeksha Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['kshullikadate'].'</td></tr>
				<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['kshullikaguru'].'">'.getmuni($getinfo['kshullikaguru']).'
				<img class="smallLight" src="'.getImg($getinfo['kshullikaguru']).'" alt="'.getmuni($getinfo['kshullikaguru']).'" /></a><div></td></tr>
				<tr><td>Place</td><td>'.$getinfo['kshullikaplace'].'</td></tr>'
				;}
				
				if($getinfo['bhramcharyadate']!="0000-00-00" or $getinfo['bhramcharyaguru']>0 or $getinfo['bhramcharyaplace']!="N/A") {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Bhramcharya (Seventh Pratima) Vrat Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['bhramcharyadate'].'</td></tr>'
					;}
				
				if($getinfo['bhramcharyaguru']>0) {echo
					'<tr><td>Guru</td><td><div class="hoverImg"><a href ="munis.php?id='.$getinfo['bhramcharyaguru'].'">'.getmuni($getinfo['bhramcharyaguru']).'
					<img class="smallLight" src="'.getImg($getinfo['bhramcharyaguru']).'" alt="'.getmuni($getinfo['bhramcharyaguru']).'" />
					</a></div></td></tr>'
					;}
				
				if(($getinfo['bhramcharyadate']!="0000-00-00" or $getinfo['bhramcharyaplace']!="N/A") && ($getinfo['bhramcharyaguru']==0)) {echo
				'<tr><td>Taken By</td><td>Self</td></tr>'
					;}
				
				if($getinfo['bhramcharyadate']!="0000-00-00" or $getinfo['bhramcharyaguru']>0 or $getinfo['bhramcharyaplace']!="N/A") {echo
				'<tr><td>Place</td><td>'.$getinfo['bhramcharyaplace'].'</td></tr>'
					;}
				
				if($getinfo['vairagya']!="0000-00-00" or $getinfo['grahtyag']!="0000-00-00") {echo
					'<tr><td colspan="2"></td></tr>'
					;}
				
				if($getinfo['vairagya']!="0000-00-00") {echo
					'<tr><td>Vairagya</td><td>'.$getinfo['vairagya'].'</td></tr>'
													   ;}
				
				if($getinfo['grahtyag']!="0000-00-00") {echo
					'<tr><td>Grah Tyag</td><td>'.$getinfo['grahtyag'].'</td></tr>'
													   ;}
				
				echo
					'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">History</th></tr>
				<tr><td>Birthname</td><td><span itemprop="name">'.$getinfo['birthname'].'</span></td></tr>
				<tr><td>Date of Birth</td><td><span itemprop="birthDate">'.$getinfo['dob'].'</span></td></tr>
				<tr><td>Birth Place</td><td><span itemprop="birthPlace">'.$getinfo['birthplace'].'</span></td></tr>
				<tr><td>Father</td><td>'.$getinfo['father'].'</td></tr>
				<tr><td>Mother</td><td>'.$getinfo['mother'].'</td></tr>
				<tr><td>Education</td><td>'.$getinfo['education'].'</td></tr>'
				;
				
				// Shishyawali List
				if($getinfo['upadhi']==1) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Shishyawali</th></tr>';
				$r2 = $db->query("SELECT * FROM munishri, aryika, kshullak, ailak, upadhyay, ailacharya, acharya WHERE approved=1 AND id=aryikaid AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid ORDER BY upadhi, name ASC");
				while($row = $r2->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$guruid = getguru($row["id"]);
					if($guruid==$getinfo["id"]) {
						$j++;
						echo '<tr><td colspan="2"><div class="hoverImg"><a href="?id='.$row["id"].'">'.$j.': '.getmuni($row["id"]).'
						<img class="smallLight" src="'.getImg($row["id"]).'" alt="'.getmuni($row["id"]).'" />
						</a></div></td></tr>';
					}
				}}
				
			echo '</table><br /><hr>
			
			<!-- Facebook Comments Started -->
			<div id="fb-root"></div>
			<div class="fb-like" data-href="http://jainmunilocator.org/munis.php?id='.$getinfo["id"].'" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<div class="fb-comments" data-href="http://jainmunilocator.org/munis.php?id='.$getinfo["id"].'" data-numposts="5"></div>
			<!-- Facebook Comments Ended -->
			
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			
			</div>
			
			<div class="muniPageSidebar">
				<center><input type="button" value="UPDATE LOCATION / DETAILS" onclick="location.href="./editform.php?id='.$getinfo['id'].'" />
				</center><br /><br />
				<img alt="Photo of '.getmuni($getinfo['id']).'" width="315px" src="'.$getinfo['img'].'" itemprop="image" /><br /><br />
				
				<div class="fb-page" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
					<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
						<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
					</blockquote></div>
				</div>
			
			</div>';
		}
	?>
		
	</div><!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
