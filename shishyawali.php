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
		$t = $db->prepare("SELECT * FROM munishri, upadhis, kshullak, ailak, upadhyay, ailacharya, acharya WHERE id = ? AND approved=1 AND uid=upadhi AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid");
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
			<div style="float:left;width:50%">
				<?php
				// List of Shishyas to be loaded below
				$i = 0;
				$j = 0;
				$r2 = $db->query("SELECT * FROM munishri, kshullak, ailak, upadhyay, ailacharya, acharya WHERE approved=1 AND id=kid AND id=ailakid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid");
					
				while($row = $r2->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$guruid = getguru($row["id"]);
					if($guruid==$getinfo["id"])
					{$j++; echo $j.': '.getmuni($row["id"]).'<a href="munis.php?id='.$row["id"].'">  Profile  </a><a href="?id='.$row["id"].'">Shishyawali</a><br />';}
				}
			}
				?>
			</div>
			<div style="float:right;width:40%"><a href="munis.php?id=<?php echo $getinfo['id'] ?>"><img width="315px" src="<?php echo $getinfo['img'] ?>" /><br /><br /><h1>View Gurudev Profile</h1></a></div>
			</p>
		</div>
		
	</div>
	
	<!--  end content wrapper  -->
 	
 	<?php include('footer.php'); ?>
