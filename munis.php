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
	<?php
	$showmuni = false;
	if(isset($_GET['id']))
	{
		$id = (int)$_GET['id'];
		$t = $db->prepare("SELECT * FROM munishri, upadhis, kshullak, ailak, muni, upadhyay, ailacharya, acharya WHERE id = ? AND approved=1 AND uid=upadhi AND kid=id AND id=ailakid AND id=muniid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid");
		$t->execute(array($id));
		if($t->rowCount() == 1)
		{
			$getinfo = $t->fetch(PDO::FETCH_ASSOC);
			$title = getmuni($getinfo["id"]);
			$showmuni = true;
		}
		else
		{
			$title = "Jain Muni Locator";
		}
	}
	else
	{
		$title = "Jain Muni Locator";
	}
	?>
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
				<strong>List of All Digambar Jain Munis is given Below. Click on the name to see more information</strong>
					<br /><br />
					<?php
					$i = 0;
					$r2 = $db->query('SELECT * FROM munishri, upadhis WHERE approved=1 AND uid=upadhi ORDER BY uid, name ASC');
						
					while($row = $r2->fetch(PDO::FETCH_ASSOC))
					{
						$i++;
						echo $i.': <a href="?id='.$row["id"].'">'.getmuni($row["id"]).'</a><br />';
					}
				}
			}
			else
			{
				?>
				<style type="text/css">
					tr
					{
						padding: 10px;
					}
					td
					{
						padding-top:15px;
						padding-left:59px;
					}
				</style>
				<script src="js/gm.js"></script>
				<script>
				$(document).ready(function(){
					$(".cloc").click(function(){	
					
										$("#editcloc").css({"z-index":"1002"});$("#editcloc").show();
						$.post( 
             "editmuniloc.php",
             { "muniid": $('.cloc').attr('id') },
             function(data) {
                $('#editcloc').html(data);
 var geozcoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng($("#lat").val(), $("#lng").val());
   geozcoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
         $("#x").val(results[0].formatted_address);
  
      } 
    } 
  }); 
             });
             $(document).on("click", "#wow", function(){
     var geozcoder = new google.maps.Geocoder();
geozcoder.geocode( { 'address': $("#x").val()}, function(results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
       $.post( 
             "editmuniloc.php",
             { "lat": results[0].geometry.location.k,"lng":results[0].geometry.location.D,"mid":$('.cloc').attr('id') },
             function(datax) {
             $("#editcloc").html("<center>Location Updated Successfully. Redirecting in 3 seconds</center>");
             setTimeout(function(){
   window.location.reload(1);
}, 3000);
             });
       
       console.log(results[0].geometry.location.k);
             } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    }); 
});
					});
				});
				</script>
				<!-- Gurudev Profile Details -->
				<div style="float:left;width:50%">
				<table>
					<tr><td><?php if($getinfo['dos']=="0000-00-00") echo "Current Location" ?></td><td id="currentplace:$getinfo['currentplace']"><?php if($getinfo['dos']=="0000-00-00") echo getlocation($getinfo['currentplace']);
					if(getlocation($getinfo['curretplace']) != 'N/A')
					{
					 ?> <a href="locate.php?location=<?php echo getlocation($getinfo['currentplace']) ?>"><img src="/images/icons/map-marker.png" alt="map-marker" height="20" width="20"></a><?php } ?> <?php if($getinfo['dos']=="0000-00-00") echo "|" ?> <a href="#" id="<?php echo $getinfo['id'] ?>" class="cloc"><?php if($getinfo['dos']=="0000-00-00") echo "Edit" ?></a></td></tr>
					
					<?php echo
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
					
					echo
					'<tr><th colspan="2" align="left">History</th><th></th></tr>
					<tr><td>Birthname</td><td>'.$getinfo['birthname'].'</td></tr>
					<tr><td>Date of Birth</td><td>'.$getinfo['dob'].'</td></tr>
					<tr><td>Father</td><td>'.$getinfo['father'].'</td></tr>
					<tr><td>Mother</td><td>'.$getinfo['mother'].'</td></tr>
					<tr><td>Birth Place</td><td>'.getlocation($getinfo['birthplace']).'</td></tr>'
					;
				
					if($getinfo['upadhi']<4) {echo
					'<tr><th colspan="2" align="left">Shishyawali</th><th></th></tr>';
					$i = 0;
					$j = 0;
					$r3 = $db->query("SELECT * FROM munishri, kshullak, ailak, upadhyay, ailacharya, acharya WHERE approved=1 AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid ORDER BY upadhi, name ASC");
					while($row2 = $r3->fetch(PDO::FETCH_ASSOC))
					{
						$i++;
						$guruid = getguru($row2["id"]);
						if($guruid==$getinfo["id"])
						{$j++; echo '<tr><td colspan="2"><a href="?id='.$row2["id"].'">'.$j.': '.getmuni($row2["id"]).'</a></td></tr>';}
					}}
					?>
				
					</table>
				</div>
			<div style="float:right;width:40%"><img width="315px" src="<?php echo $getinfo['img'] ?>" /><br /><center><a href="editform.php?id=<?php echo $getinfo['id']; ?>"> EDIT DETAILS </a></center></div>
				<?php
			}
				?>
			</p>
		</div>
		
	</div>
	
	<!--  end content wrapper  -->
 	
 	<?php include('footer.php'); ?>
