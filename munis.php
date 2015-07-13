<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" >
<div id="editcloc" style="background-color:#00ffff">Loading Editing page...</div>
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
					$r = $db->prepare("SELECT * FROM munishri WHERE name LIKE ?");
					$r->execute(array("%".$_POST["name"]."%"));
					if($r->rowCount() != 0)
					{
					$showshow = false;
					$i = 0;
						while($row = $r->fetch(PDO::FETCH_ASSOC))
						{
							$i++;
							echo $i.': <a href="?id='.$row["id"].'">'.getmuni($row["id"]).'</a><br />';
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
						echo $i.': <a href="?id='.$row["id"].'">'.getmuni($row["id"]).'</a><br />';
					}
				}
			}
			else{
				
				//Gurudev Profile Details
				echo
				'<div style="float:left;width:50%"><table>'
				;
					
				if($getinfo['dos']=="0000-00-00") {echo
				'<tr><td>Current Location</td><td>'.getaddress($getinfo['lat'],$getinfo['lng']).'</td></tr>'
				;}

				echo
				'<tr><td>Website</td><td><a href="'.$getinfo['website'].'">'.$getinfo['website'].'</a></td></tr>
				<tr><td>Chaturmas</td><td>'.$getinfo['chaturmas'].'</td></tr>'
				;
				
				if($getinfo['dos']!="0000-00-00") {echo
				'<tr><td>Date Of Samadhi</td><td>'.$getinfo['dos'].'</td></tr>'
				;}
				
				if($getinfo['upadhi']=="1") {echo
				'<tr><th colspan="2" align="left">Acharya Pad Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['adate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['aguru'].'">'.getmuni($getinfo['aguru']).'</td></tr>'
				;}
				
				if($getinfo['ailacharyaguru']>0) {echo
				'<tr><th colspan="2" align="left">Ailacharya Pad Details</th></tr>
				<tr><td>Name</td><td>'.$getinfo['ailacharyaname'].'</td></tr>
				<tr><td>Date</td><td>'.$getinfo['ailacharyadate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['ailacharyaguru'].'">'.getmuni($getinfo['ailacharyaguru']).'</td></tr>'
				;}
				
				if($getinfo['upadhyayguru']>0) {echo
				'<tr><th colspan="2" align="left">Upadhyay Pad Details</th></tr>
				<tr><td>Name</td><td>'.$getinfo['upadhyayname'].'</td></tr>
				<tr><td>Date</td><td>'.$getinfo['upadhyaydate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['upadhyayguru'].'">'.getmuni($getinfo['upadhyayguru']).'</td></tr>'
				;}
				
				if($getinfo['upadhi']<5) {echo
				'<tr><th colspan="2" align="left">Muni Deeksha Details</th></tr>
				<tr><td>Name</td><td>'.$getinfo['muniname'].'</td></tr>
				<tr><td>Date</td><td>'.$getinfo['munidate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['muniguru'].'">'.getmuni($getinfo['muniguru']).'</td></tr>'
				;}
				
				if($getinfo['ailakguru']>0) {echo
				'<tr><th colspan="2" align="left">Ailak Deeksha Details</th></tr>
				<tr><td>Name</td><td>'.$getinfo['ailakname'].'</td></tr>
				<tr><td>Date</td><td>'.$getinfo['ailakdate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['ailakguru'].'">'.getmuni($getinfo['ailakguru']).'</td></tr>'
				;}
					
				if($getinfo['kguru']>0) {echo
				'<tr><th colspan="2" align="left">Kshullak Deeksha Details</th></tr>
				<tr><td>Name</td><td>'.$getinfo['kname'].'</td></tr>
				<tr><td>Date</td><td>'.$getinfo['kdate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['kguru'].'">'.getmuni($getinfo['kguru']).'</td></tr>'
				;}
				
				if($getinfo['aryikaguru']>0) {echo
				'<tr><th colspan="2" align="left">Aryika Deeksha Details</th></tr>
				<tr><td>Date</td><td>'.$getinfo['aryikadate'].'</td></tr>
				<tr><td>Guru</td><td><a href ="munis.php?id='.$getinfo['aryikaguru'].'">'.getmuni($getinfo['aryikaguru']).'</td></tr>'
				;}
				
				echo
				'<tr><th colspan="2" align="left">History</th><th></th></tr>
				<tr><td>Birthname</td><td>'.$getinfo['birthname'].'</td></tr>
				<tr><td>Date of Birth</td><td>'.$getinfo['dob'].'</td></tr>
				<tr><td>Father</td><td>'.$getinfo['father'].'</td></tr>
				<tr><td>Mother</td><td>'.$getinfo['mother'].'</td></tr>
				<tr><td>Birth Place</td><td>'.$getinfo['birthplace'].'</td></tr>'
				;
				
				if($getinfo['upadhi']<4) {echo
				'<tr><th colspan="2" align="left">Shishyawali</th><th></th></tr>';
				$r2 = $db->query("SELECT * FROM munishri, kshullak, ailak, upadhyay, ailacharya, acharya WHERE approved=1 AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid ORDER BY upadhi, name ASC");
				while($row = $r2->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$guruid = getguru($row["id"]);
					if($guruid==$getinfo["id"])
					{$j++; echo '<tr><td colspan="2"><a href="?id='.$row["id"].'">'.$j.': '.getmuni($row["id"]).'</a></td></tr>';}
				}}
				
				echo '</table></div>';
			
			?>
			
			<div style="float:right;width:40%"><img alt="<?php echo getmuni($getinfo['id']); ?>" width="315px" src="<?php echo $getinfo['img'] ?>" /><br /><center><a href="editform.php?id=<?php echo $getinfo['id']; ?>"> EDIT DETAILS </a></center></div>
				<?php
			}
				?>
			</p>
		</div>
		
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
