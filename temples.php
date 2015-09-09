<?php include 'header.php'; ?>

<!-- start body -->
<body onunload="">
	
	<!-- start dotted pattern -->
	<div class="bg-overlay"></div>
	<!-- end dotted pattern -->
		
	<!-- start navigation -->
	<?php include('menu.php'); ?>
	<!-- end navigation -->
	
	<!-- start content wrapper -->	
	<div class="content page-content">
	
	<?php
	if(isset($_GET['id'])) {
			$id = (int)$_GET['id'];
			$t = $db->prepare("SELECT * FROM temples WHERE tid = '$id'");
			$t->execute();
			if($t->rowCount() == 1) {
				$row = $t->fetch(PDO::FETCH_ASSOC);
				$title = $row['tname'];
			} else {
				$title = 'Digambara Jain Temples';
			}
		} else {
			$title = 'Digambara Jain Temples';
	}
	?>
		
		<div class="page-title">
			<h1><span><?php echo $title; ?></span></h1>
		</div>
		
		<div class="divider clear"></div>
			
		<div class="inner-content">
			
			<?php if ($title == 'Digambara Jain Temples') { ?>
			
			<h4>List of All Digambar Jain Temples is given Below. Click on the name to see more information</h4>
			<input id="searchTemples" name="searchBox" type="text" class="fullWidth" />
			<div id="searchResults" class="hoverImg"></div>			
			<script type="text/javascript" src="js/searchTemples.js"></script>
			
			<?php
			} else {
				$t2 = $db->prepare("SELECT * FROM idols WHERE templeid = '$id'");
				$t2->execute();
		echo '<h2>Idols</h2>
		<ol>';
				while($row2 = $t2->fetch(PDO::FETCH_ASSOC)) {
					echo '<li><a href="idols.php?id='.$row2['idolid'].'">'.$row2['tirthankar'].'</a></li>';
				}
				echo '</ol>';
			}
			?>
			
		</div>
		
	</div><!--  end content wrapper  -->

<?php include 'footer.php'; ?>
