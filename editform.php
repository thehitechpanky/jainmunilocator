<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" >
<div id="editcloc" style="background-color:#00ffff">Loading Editing page...</div>
	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
		
	<!--start menu wrapper -->
	<div class="menu-wrapper clearfix">
		<!-- start logo -->
		<div class="logo">
			
		</div>
		<!-- end logo -->
		
		<!-- start navigation -->
		<div class="main-nav">
			<ul class="menu">
				<?php include('menu.php'); ?>
			</ul>		
		</div>
		<!-- end navigation -->
	</div>
	<!-- end menu wrapper -->
	
	 <!-- start content wrapper -->	

		<div class="container">

		<div class="page-title">
			<h1><?php echo 'Edit Guru Details'; ?></h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div>
			<?php
				$id=$_GET['id'];
				$result = $db->prepare("SELECT * FROM munishri, acharya, ailacharya, upadhyay, muni, ailak, kshullak WHERE id= :userid AND id=acharyaid AND id=ailacharyaid AND id=upadhyayid AND id=muniid AND id=ailakid AND id=kid");
				$result->bindParam(':userid', $id);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<div style="float:left;width:50%">				
				<form action="edit.php" method="POST">
					
					<input type="hidden" name="ids" value="<?php echo $id; ?>" />
					Upadhi	<select name="upadhi">
							<option value="1">Acharya</option>
							<option value="2">Ailacharya</option>
							<option value="3">Upadhyay</option>
							<option value="4">Muni</option>
							<option value="5">Ailak</option>
							<option value="6">Kshullak</option>
							<option value="7">Aryika</option>
							</select><br />
					Name<input type="text" name="name" value="<?php echo $row['name']; ?>" /><br />
					Website<input type="text" name="website" value="<?php echo $row['website']; ?>" /><br />
					Image Link<input type="text" name="img" value="<?php echo $row['img']; ?>" /><br />
					Date of Samadhi (If applicable)<input type="text" name="dos" value="<?php echo $row['dos']; ?>" /><br /><br />
					
					<b>Acharya Pad Details</b><br />
					Date<input type="text" name="adate" value="<?php echo $row['adate']; ?>" /><br /><br />
					
					<b>Ailacharya Pad Details</b><br />
					Date<input type="text" name="ailacharyadate" value="<?php echo $row['ailacharyadate']; ?>" /><br /><br />
					
					<b>Upadhyay Pad Details</b><br />
					Date<input type="text" name="upadhyaydate" value="<?php echo $row['upadhyaydate']; ?>" /><br /><br />
					
					<b>Muni Deeksha Details</b><br />
					Date<input type="text" name="munidate" value="<?php echo $row['munidate']; ?>" /><br /><br />
					
					<b>Ailak Pad Details</b><br />
					Date<input type="text" name="ailakdate" value="<?php echo $row['ailakdate']; ?>" /><br /><br />
					
					<b>Kshullak Pad Details</b><br />
					Date<input type="text" name="kdate" value="<?php echo $row['kdate']; ?>" /><br /><br />
					
					<b>History</b><br />
					Birthname<input type="text" name="birthname" value="<?php echo $row['birthname']; ?>" /><br />
					Date of Birth<input type="text" name="birthname" value="<?php echo $row['dob']; ?>" /><br />
					Father<input type="text" name="birthname" value="<?php echo $row['father']; ?>" /><br />
					Mother<input type="text" name="birthname" value="<?php echo $row['mother']; ?>" /><br /><br />
					<input type="submit" value="Save" />
					
				</form>
			</div>
			<div style="float:right;width:40%"><img width="315px" src="<?php echo $row['img']; ?>" /></div>
			<?php } ?>
		</div>
		
	</div>
	
	<!--  end content wrapper  -->
 	
 	<?php include('footer.php'); ?>
