<?php include('header.php'); ?>

<!-- start body -->
<body onunload="" <?php echo $schemaOrgBody; ?>>
	<div class="g-signin2" data-onsuccess="onSignIn" style="float:right; z-index:10000;"></div>	
	
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
		//This is intentionally left blank because only unique records are to fetched
	} else {
		$c = $d;
		$i++;
		echo '<br /><h3>'.$i.'. '.$c.'</h3>';
		$q2 = $db->prepare("SELECT * FROM munishri, chaturmas WHERE approved=1 AND id=chaturmasmuni AND chaturmasplace='$c' AND chaturmasyear=2015 ORDER BY upadhi, name");
		$q2->execute();
		$j = 0;
		while($row2 = $q2->fetch(PDO::FETCH_ASSOC)) {
			$j++;
			echo '<div class="hoverImg"><a href="./munis.php?id='.$row2["id"].'">'.$j.'. '.getmuni($row2["id"]).'<span><img class="smallLight" src="'.$row2["img"].'" alt="'.getmuni($row2["id"]).'" /></span></a></div>';
		}
	}
}

			?>
			
			<br />
			<hr>
			
			<!-- Facebook Comments Started -->
			<div id="fb-root"></div>
			<div class="fb-like" data-href="http://jainmunilocator.org/chaturmas.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<div class="fb-comments" data-href="http://jainmunilocator.org/chaturmas.php" data-numposts="5"></div>
			<!-- Facebook Comments Ended -->
			
			<br /><br /><br /><br /><br /><br /><br /><br /><br />
			
		</div>
		
		<div class="fb-page sidebar" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="https://www.facebook.com/jainmunilocator">
					<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
				</blockquote>
			</div>
		</div>
		
	</div>
	
	<!--  end content wrapper  -->
	
	<?php include('footer.php'); ?>
