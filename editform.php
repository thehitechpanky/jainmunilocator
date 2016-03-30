<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" >
	
	<div class="g-signin2" data-onsuccess="onSignIn" style="float: right;"></div>
	
	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
	
	<!-- start navigation -->
	<?php include('menu.php'); ?>
	<!-- end navigation -->
	
	<!-- start content wrapper -->
	
	<div class="container">
		
		<div class="page-title">
			<h1><?php echo 'Edit Guru Details'; ?></h1>
		</div>
		
		<div class="divider clear"></div>
		
		<?php
$id=$_GET['id'];
$result = $db->prepare("SELECT * FROM munishri, upadhis, muni_location, history, contact, acharya, ailacharya, upadhyay, muni, ailak, kshullak, aryika, kshullika, bhramcharya
				WHERE id= :userid AND upadhi=uid AND id=mid AND id=historyid AND id=contactid AND id=acharyaid AND id=ailacharyaid AND id=upadhyayid AND id=muniid AND id=ailakid AND id=kid AND id=aryikaid AND id=kshullikaid AND id=bhramcharyaid");
$result->bindParam(':userid', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++) {
		?>
		
		<div style="float:left;width:60%">				
			<form id="editForm" action="munis/edit.php" method="POST">
				
				<input type="hidden" name="ids" value="<?php echo $id; ?>" />
				
				<b>Name</b><br />
				<select id="upadhi" name="upadhi" class="mediumBox">
					<option value="0" disabled selected>Upadhi</option>
					<option value="1" <?php if($row['upadhi']==1) { echo "selected"; } ?> >Acharya</option>
					<option value="2" <?php if($row['upadhi']==2) { echo "selected"; } ?> >Ailacharya</option>
					<option value="3" <?php if($row['upadhi']==3) { echo "selected"; } ?> >Upadhyay</option>
					<option value="4" <?php if($row['upadhi']==4) { echo "selected"; } ?> >Muni</option>
					<option value="5" <?php if($row['upadhi']==5) { echo "selected"; } ?> >Ailak</option>
					<option value="6" <?php if($row['upadhi']==6) { echo "selected"; } ?> >Kshullak</option>
					<option value="7" <?php if($row['upadhi']==7) { echo "selected"; } ?> >Aryika</option>
					<option value="8" <?php if($row['upadhi']==8) { echo "selected"; } ?> >Kshullika</option>
				</select>
				<div id="prefix_here" class="inline"></div>
				<input type="text" id="name" name="name" class="smallBox" placeholder="Name" value="<?php echo $row['name']; ?>" />
				<div id="suffix_here" class="inline"></div>
				<input type="text" id="alias" name="alias" class="verySmallBox" placeholder="Alias" value="<?php echo $row['alias']; ?>" /><br /><br />
				
				<?php if($row['dos']=="0000-00-00") { ?>
				<strong>Current Location</strong><br />
				<input type="hidden" name="oldlocation" value="<?php echo $row['location']; ?>">
				<input type="text" id="location" name="location" class="longBox" value="<?php echo $row['location']; ?>" /><br /><br />
				<?php } ?>
				
				Image Link<input type="text" id="img" name="img" class="longBox" value="<?php echo $row['img']; ?>" /><br />
				Website Link<input type="text" id="website" name="website" value="<?php echo $row['website']; ?>" /><br /><br />
				
				<strong>Contact Info</strong><br />
				Contact No.<input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" /><br />
				Email ID<input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" /><br />
				Facebook<input type="text" id="facebook" name="facebook" value="<?php echo $row['facebook']; ?>" /><br />
				GPlus<input type="text" id="gplus" name="gplus" value="<?php echo $row['gplus']; ?>" /><br />
				Youtube<input type="text" id="youtube" name="youtube" value="<?php echo $row['youtube']; ?>" /><br />
				Wikipedia<input type="text" id="wikipedia" name="wikipedia" value="<?php echo $row['wikipedia']; ?>" /><br /><br />
				
				<strong>Samadhi Details (If applicable)</strong><br />
				Date in YYYY-MM-DD<input type="text" id="dos" name="dos" class="smallBox" value="<?php echo $row['dos']; ?>" /><br />
				Place<input type="text" id="samadhiplace" name="samadhiplace" class="longBox" value="<?php echo $row['samadhiplace']; ?>"/><br /><br />
				
				<strong>Chaturmas</strong><br />
				<?php
	if($getinfo['dos']=="0000-00-00") {
		$latestChaturmasYear = $currentYear;
	} else {
		
		$latestChaturmasYear = date('Y', strtotime($getinfo['dos']));
	}
	echo $latestChaturmasYear;
	$q=$db->prepare("SELECT * FROM chaturmas WHERE chaturmasmuni='$id' AND chaturmasyear='$latestChaturmasYear'");
	$q->execute();
	$row2 = $q->fetch(PDO::FETCH_ASSOC);
				?>
				<input type="text" id="chaturmasplace" name="chaturmasplace" class="longBox" value="<?php echo $row2['chaturmasplace']; ?>" /><br /><br />
				<input type="hidden" id="chaturmasid" name="chaturmasid" value="<?php echo $row2['chaturmasid']; ?>" />
				<input type="hidden" id="latestChaturmasYear" name="latestChaturmasYear" value="<?php echo $latestChaturmasYear; ?>" />
				
				<div id="acharya" class="">
					<b>Acharya Pad Details</b><br />
					Date in YYYY-MM-DD<input type="text" id="adate" name="adate" class="smallBox" value="<?php echo $row['adate']; ?>" /><br />
					Guru<input type="text" id="aguru" value="<?php echo getmuni($row['aguru']); ?>" list="aguruList"/>
					<datalist id="aguruList">
					</datalist>
					<input type="hidden" name="aguru" id="aguruHidden" value="" /><br />
					Place<input type="text" id="aplace" name="aplace" class="longBox" value="<?php echo $row['aplace']; ?>"/><br /><br />
				</div>
				
				<div id="ailacharya" class="">
					<b>Ailacharya Pad Details</b><br />
					Name<input type="text" id="ailacharyaname" name="ailacharyaname" value="<?php echo $row['ailacharyaname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" id="ailacharyadate" name="ailacharyadate" class="smallBox" value="<?php echo $row['ailacharyadate']; ?>" /><br />
					Guru ID<input type="text" id="ailacharyaguru" name="ailacharyaguru" value="<?php echo $row['ailacharyaguru']; ?>" /><br />
					Place<input type="text" id="ailacharyaplace" name="ailacharyaplace" class="longBox" value="<?php echo $row['ailacharyaplace']; ?>"/><br /><br />
				</div>
				
				<div id="upadhyay" class="">
					<b>Upadhyay Pad Details</b><br />
					Name<input type="text" id="upadhyayname" name="upadhyayname" value="<?php echo $row['upadhyayname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" id="upadhyaydate" name="upadhyaydate" class="smallBox" value="<?php echo $row['upadhyaydate']; ?>" /><br />
					Guru ID<input type="text" id="upadhyayguru" name="upadhyayguru" value="<?php echo $row['upadhyayguru']; ?>" /><br />
					Place<input type="text" id="upadhyayplace" name="upadhyayplace" class="longBox" value="<?php echo $row['upadhyayplace']; ?>"/><br /><br />
				</div>
				
				<div id="muni" class="">
					<b>Muni Deeksha Details</b><br />
					Name<input type="text" id="muniname" name="muniname" value="<?php echo $row['muniname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" id="munidate" name="munidate" class="smallBox" value="<?php echo $row['munidate']; ?>" /><br />
					Guru ID<input type="text" id="muniguru" name="muniguru" value="<?php echo $row['muniguru']; ?>" /><br />
					Place<input type="text" id="muniplace" name="muniplace" class="longBox" value="<?php echo $row['muniplace']; ?>"/><br /><br />
				</div><br />
				
				<div id="ailak" class="">
					<b>Ailak Deeksha Details</b><br />
					Name<input type="text" id="ailakname" name="ailakname" value="<?php echo $row['ailakname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" id="ailakdate" name="ailakdate" class="smallBox" value="<?php echo $row['ailakdate']; ?>" /><br />
					Guru ID<input type="text" id="ailakguru" name="ailakguru" value="<?php echo $row['ailakguru']; ?>" /><br />
					Place<input type="text" id="ailakplace" name="ailakplace" class="longBox" value="<?php echo $row['ailakplace']; ?>"/><br /><br />
				</div>
				
				<div id="kshullak" class="">
					<b>Kshullak Deeksha Details</b><br />
					Name<input type="text" id="kname" name="kname" value="<?php echo $row['kname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" id="kdate" name="kdate" class="smallBox" value="<?php echo $row['kdate']; ?>" /><br />
					Guru ID<input type="text" name="kguru" id="kguru" value="<?php echo $row['kguru']; ?>" /><br />
					Place<input type="text" id="kplace" name="kplace" class="longBox" value="<?php echo $row['kplace']; ?>" /><br /><br />
				</div>
				
				<div id="aryika" class="">
					<b>Aryika Deeksha Details</b><br />
					Date in YYYY-MM-DD<input type="text" id="aryikadate" name="aryikadate" class="smallBox" value="<?php echo $row['aryikadate']; ?>" /><br />
					Guru ID<input type="text" id="aryikaguru" name="aryikaguru" value="<?php echo $row['aryikaguru']; ?>" /><br />
					Place<input type="text" id="aryikaplace" name="aryikaplace" class="longBox" value="<?php echo $row['aryikaplace']; ?>" /><br /><br />
				</div>
				
				<div id="kshullika" class="">
					<b>Kshullika Deeksha Details</b><br />
					Date in YYYY-MM-DD<input type="text" id="kshullikadate" name="kshullikadate" class="smallBox" value="<?php echo $row['kshullikadate']; ?>" /><br />
					Guru ID<input type="text" id="kshullikaguru" name="kshullikaguru" value="<?php echo $row['kshullikaguru']; ?>" /><br />
					Place<input type="text" id="kshullikaplace" name="kshullikaplace" class="longBox" value="<?php echo $row['kshullikaplace']; ?>" /><br /><br />
				</div>
				
				<b>Bhramcharya (Seventh Pratima) Vrat Details</b><br />
				Date in YYYY-MM-DD<input type="text" id="bhramcharyadate" name="bhramcharyadate" class="smallBox" value="<?php echo $row['bhramcharyadate']; ?>" /><br />
				Guru ID<input type="text" id="bhramcharyaguru" name="bhramcharyaguru" value="<?php echo $row['bhramcharyaguru']; ?>" /><br />
				Place<input type="text" id="bhramcharyaplace" name="bhramcharyaplace" class="longBox" value="<?php echo $row['bhramcharyaplace']; ?>" /><br /><br />
				
				Vairagya Date in YYYY-MM-DD<input type="text" id="vairagya" name="vairagya" class="smallBox" value="<?php echo $row['vairagya']; ?>" /><br />
				Grahtyag Date in YYYY-MM-DD<input type="text" id="grahtyag" name="grahtyag" class="smallBox" value="<?php echo $row['grahtyag']; ?>" /><br /><br />
				
				<b>History</b><br />
				Birthname<input type="text" id="birthname" name="birthname" value="<?php echo $row['birthname']; ?>" /><br />
				Date of Birth<input type="text" id="dob" name="dob" class="smallBox" value="<?php echo $row['dob']; ?>" /><br />
				Father<input type="text" id="father" name="father" value="<?php echo $row['father']; ?>" /><br />
				Mother<input type="text" id="mother" name="mother" value="<?php echo $row['mother']; ?>" /><br />
				Birthplace<input type="text" id="birthplace" name="birthplace" class="longBox" value="<?php echo $row['birthplace']; ?>" /><br />
				Education<input type="text" id="education" name="education" value="<?php echo $row['education']; ?>" /><br /><br />
				
				<input type="hidden" id="editoremail" name="editoremail">
				
				<?php include 'captcha.php'; ?>
				<br />
				
				<input type="submit" value="Save" />&nbsp;&nbsp;&nbsp;
				<input type="reset" value="Reset" />&nbsp;&nbsp;&nbsp;
				<input type="button" value="Cancel" onclick="location.href='./munis.php?id=<?php echo $id; ?>';" />
				
			</form>
		</div>
		
		<div class="muniPageSidebar">
			
			<img alt="<?php echo getmuni($row['id']); ?>" width="315px" src="<?php echo $row['img']; ?>" /><br /><br />
			
			<div class="fb-page" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
				<div class="fb-xfbml-parse-ignore">
					<blockquote cite="https://www.facebook.com/jainmunilocator">
						<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
					</blockquote>
				</div>
			</div>
			
		</div>
		
		<?php } ?>
		
	</div><!--  end content wrapper  -->
	
	<?php
include 'login/loginscripts.php';
$loadFormActionsScript = "Yes";
include('footer.php');
	?>
