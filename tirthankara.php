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
			$t = $db->prepare("SELECT * FROM tirthankara WHERE tirthankaraid = '$id'");
			$t->execute();
			if($t->rowCount() == 1) {
				$row = $t->fetch(PDO::FETCH_ASSOC);
				$name = $row['tirthankaraname'];
				$img = $row['tirthankaraimg'];
				$title = 'Lord '.$name;
				$metre = $row['tirthankaraheight'] * 3;
			} else {
				$title = 'Tirthankara';
			}
		} else {
			$title = 'Tirthankara';
	}
	?>
		
		<div class="page-title">
			<h1><span><?php echo $title; ?></span></h1>
		</div>
		
		<div class="divider clear"></div>
			
		<div class="profile">
			
			<?php if ($title == 'Tirthankara') { ?>
			
			<h4>List of all Jain Tirthankara is given below. Click on the name to see more information</h4>
			<input id="searchTirthankara" name="searchBox" type="text" class="fullWidth" />
			<div id="searchResults" class="hoverImg"></div>			
			<script type="text/javascript" src="tirthankara/searchTirthankara.js"></script>
			
			<?php
			} else {
				echo '<table>
				<tr><td>Symbol</td><td>'.$row['tirthankarasymbol'].'</td></tr>
				<tr><td>Color</td><td>'.$row['tirthankaracolor'].'</td></tr>
				<tr><td>Height</td><td>'.$row['tirthankaraheight'].' bows ('.$metre.' metres)</td></tr>
				</table><br />';
					
				$t2 = $db->prepare("SELECT * FROM idols WHERE idoltirthankaraid = '$id'");
				$t2->execute();
				echo '<h2>Idols</h2>
				<ol>';
				while($row2 = $t2->fetch(PDO::FETCH_ASSOC)) {
					echo '<li><a href="idols.php?id='.$row2['idolid'].'">'.$name.'</a></li>';
				}
				echo '</ol>';
			}
			?>
			
		</div>
		
		<div class="muniPageSidebar">
			<center><input type="button" value="UPDATE DETAILS" onclick="location.href='#'"/>
			</center><br /><br />
			
			<img alt="Photo of <?php echo $name; ?>" width="315px" src="<?php echo $img; ?>" itemprop="image" />
			<br /><br />
				
			<div class="fb-page" data-href="https://www.facebook.com/jainmunilocator" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
				<div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jainmunilocator">
					<a href="https://www.facebook.com/jainmunilocator">Jain Muni Locator</a>
				</blockquote></div>
			</div>
			
		</div>
		
	</div><!--  end content wrapper  -->

<?php include 'footer.php'; ?>
