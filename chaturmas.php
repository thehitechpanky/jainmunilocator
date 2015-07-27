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
			<h1>Chaturmas 2015</h1>
		</div>
		
		<div class="divider clear"></div>
		
		<div class="inner-content">
<?php
$q = $db->prepare("SELECT * FROM chaturmas WHERE chaturmasyear=2015 AND NOT (chaturmasplace='N/A') ORDER BY chaturmasplace");
$q->execute();
$c = "N/A";
while($row = $q->fetch(PDO::FETCH_ASSOC)) {
	$d = $row['chaturmasplace'];
	if ($c == $d) {
		$j = 0;
	} else {
		$c = $d;
		$i++;
		echo '<br /><h3>'.$i.'. '.$c.'</h3>';
		$q2 = $db->prepare("SELECT * FROM munishri, chaturmas WHERE approved=1 AND id=chaturmasid AND chaturmasplace='$c' AND chaturmasyear=2015 ORDER BY upadhi, name");
		$q2->execute();
		while($row2 = $q2->fetch(PDO::FETCH_ASSOC)) {
			$j++;
			echo '<div class="hoverImg"><a href="?id='.$row2["id"].'">'.$j.'. '.getmuni($row2["id"]).'<span><img class="smallLight" src="'.$row2["img"].'" alt="'.getmuni($row2["id"]).'" /></span></a></div>';
		}
	}
}
?>
					
		</div>
		<div class="sidebar">
		<img alt="Acharya Kundkund | Jain Muni Locator" src="http://www.vitragvani.com/m/jeevan_parichay/pics/Aarcharya_kundkund.jpg" class="sidebar">
		</div>
	</div>
	
	<!--  end content wrapper  -->
 	
<?php include('footer.php'); ?>
