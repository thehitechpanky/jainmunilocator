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
	
		<div class="container">

		<div class="page-title">
			<h1><?php echo $title; ?></h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div>
			<p><?php if(!$showmuni){ ?>
				<form method="post" action="">
					<div>
						<label>Search : </label>
						 <input type="text" value="" id="name" name="name" class="name"> <input type="submit" value="Search" name="submitsearch">
					</div>
				</form>	
				<?php
				$showshow = true;
				if(isset($_POST['submitsearch']))
				{
					$r = $db->prepare("SELECT * FROM munishri WHERE name LIKE ? ORDER BY upadhi, name ASC");
					$r->execute(array("%".$_POST["name"]."%"));
					if($r->rowCount() != 0)
					{
					$showshow = false;
						while($row = $r->fetch(PDO::FETCH_ASSOC))
						{
							$i++;
							echo '<div class="hoverImg"><a href="?id='.$row["id"].'">'.$i.': '.getmuni($row["id"]).'<span><img class="smallLight" src="'.$row["img"].'" alt="'.getmuni($row["id"]).'" /></span></a></div>';
						}
					}
					else
					{
						echo  "<span style='color:red'>Our records don't have an entry for the Munishri you searched. If you have any kind of information about that muni please help us to collect the data by adding information <a href='http://jainmunilocator.org/add.php'>here</a></span><br /><br />";
					}
				}
				if($showshow){
			?>
				<strong>List of All Digambar Jain Munis is given Below. Click on the name to see more information</strong><br /><br />
			<?php
				while($row = $t->fetch(PDO::FETCH_ASSOC))
					{
						$i++;
						echo '<div class="hoverImg"><a href="?id='.$row["id"].'">'.$i.': '.getmuni($row["id"]).'<span><img class="smallLight" src="'.$row["img"].'" alt="'.getmuni($row["id"]).'" /></span></a></div>';
					}
				}
			}
			else{
				
				//Gurudev Profile Details
				echo
				'<div style="float:left;width:50%"><table style="width:100%">'
				;
					
				if($getinfo['dos']=="0000-00-00") {echo
				'<tr><td>Current Location</td><td>'.$getinfo['location'].'</td></tr>'
					;}
				
				if ($getinfo['website']!="#") {echo
					'<tr><td>Website</td>
					<td><a href="'.$getinfo['website'].'" target="_blank">'.$getinfo['website'].'</a></td></tr>'
					;}
				
				if($getinfo['dos']=="0000-00-00") {echo
				'<tr><td>Contact</td><td>
					<a title="Phone" target="" href="#">
						<img width="25" height="25" title="'.$getinfo['phone'].'" alt="Phone | Jain Muni Locator" src="./images/icons/phone30x30.png" />
					</a>
					<a title="Email" target="" href="#">
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
				</td></tr>'
				;}
				
				if($getinfo['dos']!="0000-00-00") {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Samadhi Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['dos'].'</td></tr>
				<tr><td>Place</td><td>'.$getinfo['samadhiplace'].'</td></tr>'
				;}
				
				echo
					'<tr><td colspan="2"></td></tr>
					<tr><th colspan="2" align="left">Books</th></tr>'
					;
				$b = $db->prepare("SELECT * FROM books WHERE bguru = '$id'");
				$b->execute();
				while($brow = $b->fetch(PDO::FETCH_ASSOC)) {
					$i++;
					echo '<tr><td colspan="2">'.$i.' '.$brow['bname'].'</td></tr>';
					}
				
				echo
					'<tr><td colspan="2"></td></tr>
					<tr><th colspan="2" align="left">Chaturmas</th></tr>'
					;
				$c = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni='$id' AND chaturmasplace!='N/A'");
				$c->execute();
				while($crow = $c->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr><td>'.$crow['chaturmasyear'].'</td><td>'.$crow['chaturmasplace'].'</td></tr>';
					}
				
				if($getinfo['upadhi']=="1") {echo
					'<tr><td colspan="2"></td></tr>
					<tr><th colspan="2" align="left">Acharya Pad Details</th></tr>
					<tr><td>Date</td><td>'.$getinfo['adate'].'</td></tr>
					<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['aguru'].'">'.getmuni($getinfo['aguru']).'</a></td></tr>
					<tr><td>Place</td><td>'.$getinfo['aplace'].'</td></tr>'
					;}
				
				if($getinfo['ailacharyaguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Ailacharya Pad Details</th></tr>';
					if($getinfo['ailacharyaname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['ailacharyaname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['ailacharyadate'].'</td></tr>
				<tr><td>Guru</td><td class="hoverImg"><a href ="munis.php?id='.$getinfo['ailacharyaguru'].'">'
					.getmuni($getinfo['ailacharyaguru']).
					'<span><img class="smallLight" src="'.$getinfo["img"].'" alt="'.getmuni($getinfo['ailacharyaguru']).'" /></span>
					</a></td></tr>
				<tr><td>Place</td><td>'.$getinfo['ailacharyaplace'].'</td></tr>'
				;}
				
				if($getinfo['upadhyayguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Upadhyay Pad Details</th></tr>';
					if($getinfo['upadhyayname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['upadhyayname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['upadhyaydate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['upadhyayguru'].'">'.getmuni($getinfo['upadhyayguru']).'</a></td></tr>
				<tr><td>Place</td><td>'.$getinfo['upadhyayplace'].'</td></tr>'
				;}
				
				if($getinfo['upadhi']<5) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Muni Deeksha Details</th></tr>';
					if($getinfo['muniname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['muniname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['munidate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['muniguru'].'">'.getmuni($getinfo['muniguru']).'</a></td></tr>
				<tr><td>Place</td><td>'.$getinfo['muniplace'].'</td></tr>'
				;}
				
				if($getinfo['ailakguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Ailak Deeksha Details</th></tr>';
					if($getinfo['ailakname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['ailakname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['ailakdate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['ailakguru'].'">'.getmuni($getinfo['ailakguru']).'</a></td></tr>
				<tr><td>Place</td><td>'.$getinfo['ailakplace'].'</td></tr>'
				;}
					
				if($getinfo['kguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Kshullak Deeksha Details</th></tr>';
					if($getinfo['ailacharyaname']!="") {echo '<tr><td>Name</td><td>'.$getinfo['kname'].'</td></tr>';}
				echo '<tr><td>Date</td><td>'.$getinfo['kdate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['kguru'].'">'.getmuni($getinfo['kguru']).'</a></td></tr>
				<tr><td>Place</td><td>'.$getinfo['kplace'].'</td></tr>'
				;}
				
				if($getinfo['upadhi']==7) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Aryika Deeksha Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['aryikadate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['aryikaguru'].'">'.getmuni($getinfo['aryikaguru']).'</a></td></tr>
				<tr><td>Place</td><td>'.$getinfo['aryikaplace'].'</td></tr>'
				;}
				
				if($getinfo['kshullikaguru']>0) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Kshullika Deeksha Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['kshullikadate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['kshullikaguru'].'">'.getmuni($getinfo['kshullikaguru']).'</a></td></tr>
				<tr><td>Place</td><td>'.$getinfo['kshullikaplace'].'</td></tr>'
				;}
				
				if($getinfo['bhramcharyadate']!="0000-00-00" or $getinfo['bhramcharyaguru']>0 or $getinfo['bhramcharyaplace']!="N/A") {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Bhramcharya Vrat Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['bhramcharyadate'].'</td></tr>'
					;}
				
				if($getinfo['bhramcharyaguru']>0) {echo
				'<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['bhramcharyaguru'].'">'.getmuni($getinfo['bhramcharyaguru']).'</a></td></tr>'
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
				<tr><td>Birthname</td><td>'.$getinfo['birthname'].'</td></tr>
				<tr><td>Date of Birth</td><td>'.$getinfo['dob'].'</td></tr>
				<tr><td>Father</td><td>'.$getinfo['father'].'</td></tr>
				<tr><td>Mother</td><td>'.$getinfo['mother'].'</td></tr>
				<tr><td>Birth Place</td><td>'.$getinfo['birthplace'].'</td></tr>
				<tr><td>Education</td><td>'.$getinfo['education'].'</td></tr>'
				;
				
				if($getinfo['upadhi']<4) {echo
				'<tr><td colspan="2"></td></tr>
				<tr><th colspan="2" align="left">Shishyawali</th></tr>';
				$r2 = $db->query("SELECT * FROM munishri, aryika, kshullak, ailak, upadhyay, ailacharya, acharya WHERE approved=1 AND id=aryikaid AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid ORDER BY upadhi, name ASC");
				while($row = $r2->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$guruid = getguru($row["id"]);
					if($guruid==$getinfo["id"])
					{$j++; echo '<tr><td colspan="2"><a href="?id='.$row["id"].'">'.$j.': '.getmuni($row["id"]).'</a></td></tr>';}
				}}
				
				echo '</table></div>';
			
			?>
			
			<div style="float:right;width:40%">
				<img alt="<?php echo getmuni($getinfo['id']); ?>" width="315px" src="<?php echo $getinfo['img'] ?>" /><br /><br />
				<center><input type="button" value="EDIT DETAILS" onclick="location.href='./editform.php?id=<?php echo $getinfo['id']; ?>';" /></center>
			</div>
			
				<?php
			}
				?>
			</p>
		</div>
		
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
