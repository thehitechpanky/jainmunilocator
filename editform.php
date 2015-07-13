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
			<h1><?php echo 'Edit Guru Details'; ?></h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div>
			<?php
				$id=$_GET['id'];
				$result = $db->prepare("SELECT * FROM munishri, upadhis, muni_location, acharya, ailacharya, upadhyay, muni, ailak, kshullak, aryika WHERE id= :userid AND upadhi=uid AND id=mid AND id=acharyaid AND id=ailacharyaid AND id=upadhyayid AND id=muniid AND id=ailakid AND id=kid AND id=aryikaid");
				$result->bindParam(':userid', $id);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<div style="float:left;width:50%">				
				<form action="edit.php" method="POST">
					
					Current Location
					<input type="text" name="location" placeholder="Location" value="<?php echo getaddress($row['lat'],$row['lng']); ?>"/><br />
					
					<input type="hidden" name="ids" value="<?php echo $id; ?>" />
					Upadhi	<select name="upadhi">
							<option name="upadhi" value="<?php echo $row['upadhi']; ?>"><?php echo $row['uname']; ?></option>
							</select><br />
					Name<input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" /><br />
					Website Link<input type="text" name="website" placeholder="Website Link" value="<?php echo $row['website']; ?>" /><br />
					Image Link<input type="text" name="img" placeholder="Image Link" value="<?php echo $row['img']; ?>" /><br />
					Date of Samadhi (if applicable) in YYYY-MM-DD<input type="text" name="dos" placeholder="Date of Samadhi (if applicable) in YYYY-MM-DD" value="<?php echo $row['dos']; ?>" /><br /><br />
					
					<b>Acharya Pad Details</b><br />
					Date in YYYY-MM-DD<input type="text" name="adate" placeholder="Date in YYYY-MM-DD" value="<?php echo $row['adate']; ?>" /><br /><br />
					
					<b>Ailacharya Pad Details</b><br />
					Name<input type="text" name="ailacharyaname" placeholder="Name" value="<?php echo $row['ailacharyaname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" name="ailacharyadate" placeholder="Date in YYYY-MM-DD" value="<?php echo $row['ailacharyadate']; ?>" /><br /><br />
					
					<b>Upadhyay Pad Details</b><br />
					Name<input type="text" name="upadhyayname" placeholder="Name" value="<?php echo $row['upadhyayname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" name="upadhyaydate" placeholder="Date in YYYY-MM-DD" value="<?php echo $row['upadhyaydate']; ?>" /><br /><br />
					
					<b>Muni Deeksha Details</b><br />
					Name<input type="text" name="muniname" placeholder="Name" value="<?php echo $row['muniname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" name="munidate" placeholder="Date in YYYY-MM-DD" value="<?php echo $row['munidate']; ?>" /><br /><br />
					
					<b>Ailak Deeksha Details</b><br />
					Name<input type="text" name="ailakname" placeholder="Name" value="<?php echo $row['ailakname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" name="ailakdate" placeholder="Date in YYYY-MM-DD" value="<?php echo $row['ailakdate']; ?>" /><br /><br />
					
					<b>Kshullak Deeksha Details</b><br />
					Name<input type="text" name="kname" placeholder="Name" value="<?php echo $row['kname']; ?>" /><br />
					Date in YYYY-MM-DD<input type="text" name="kdate" placeholder="Date in YYYY-MM-DD" value="<?php echo $row['kdate']; ?>" /><br /><br />
					
					<b>Aryika Deeksha Details</b><br />
					Date in YYYY-MM-DD<input type="text" name="aryikadate" placeholder="Date in YYYY-MM-DD" value="<?php echo $row['aryikadate']; ?>" /><br /><br />
					
					<b>History</b><br />
					Birthname<input type="text" name="birthname" placeholder="Birthname" value="<?php echo $row['birthname']; ?>" /><br />
					Date of Birth<input type="text" name="dob" placeholder="Date of Birth in YYYY-MM-DD" value="<?php echo $row['dob']; ?>" /><br />
					Father<input type="text" name="father" placeholder="Father" value="<?php echo $row['father']; ?>" /><br />
					Mother<input type="text" name="mother" placeholder="Mother" value="<?php echo $row['mother']; ?>" /><br /><br />
					
					<div class="g-recaptcha" data-sitekey="6LcXYP8SAAAAAM8199rOJV8yoCWS4mI5FHb5Q70Q"></div><br />
					<input type="submit" value="Save" />&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" />&nbsp;&nbsp;&nbsp;<input type="button" value="Back" onclick="history.back();" />
					
				</form>
			</div>
			<div style="float:right;width:40%"><img alt="<?php echo getmuni($row['id']); ?>" width="315px" src="<?php echo $row['img']; ?>" /></div>
			<?php } ?>
		</div>
		
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
