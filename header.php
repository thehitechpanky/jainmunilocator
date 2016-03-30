<!DOCTYPE html>
<html dir="ltr" lang="en-US">
	
	<!-- Load Configuration File and created functions -->
	<?php

include 'functionsCreated.php';

//Find Muni Name and Details
$showmuni = false;
// When an id is entered in the url
if(isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	$t = $db->prepare('SELECT * FROM munishri, upadhis, kshullika, aryika, bhramcharya, kshullak, ailak, muni, upadhyay, ailacharya, acharya, muni_location, history, contact
						WHERE id = ? AND approved=1 AND uid=upadhi AND id=kshullikaid AND id=aryikaid AND id=bhramcharyaid AND id=kid AND id=ailakid AND id=muniid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid AND id=mid AND id=historyid AND id=contactid');
	$t->execute(array($id));
	// For the page showing muni details
	if($t->rowCount() == 1) {
		$getinfo = $t->fetch(PDO::FETCH_ASSOC);
		$title = getmuni($id);
		$titletag = $title.' | Jain Muni Locator';
		$showmuni = true;
		$schemaOrgBody = 'itemscope itemtype="http://schema.org/ProfilePage"';
		$schemaOrg = 'itemprop="about" itemscope itemtype="http://schema.org/Person"';
	}
	// For general pages on the website
	else{
		$title = 'Jain Muni Locator';
		$titletag = $title.' - Details Digambar Jain Sadhus Sadhvis';
		$schemaOrgBody = 'itemscope itemtype="http://schema.org/WebPage"';
		$schemaOrg = '';
	}
}
// When no id is entered in the url it will show the list of munis.
else{
	$title = "Jain Muni Locator";
	$titletag = $title.' - Details Digambar Jain Sadhus Sadhvis';
	$t = $db->prepare('SELECT * FROM munishri, upadhis, aryika, kshullak, ailak, muni, upadhyay, ailacharya, acharya WHERE approved=1 AND uid=upadhi AND id=aryikaid AND id=kid AND id=ailakid AND id=muniid AND id=upadhyayid AND id=ailacharyaid AND id=acharyaid ORDER BY uid, name ASC');
	$t->execute();
	$schemaOrgBody = 'itemscope itemtype="http://schema.org/WebPage"';
	$schemaOrg = '';
}

	?>
	
	<!-- Start Head -->
	<head>
		
		<!-- start title - should be 57 characters max as suggested by http://seorch.eu -->
		<title><?php echo $titletag; ?></title>
		
		<!-- start meta -->
		<?php
include 'meta.php';
$metaKeywords = $titletag.', Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, list of all digamabar jain munis';
$keywords = $metaKeywords.', Elacharya, Upadhyay, Elak, Kshullak, Aryika, Kshullika, Bhramcharya';
		?>
		<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
		<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
		<meta name="keywords" content="<?php echo $metaKeywords ?>">
		
		<?php
			include 'alexa.php';
include 'css.php';
if(isMobile()){}else{
		?>
		
		<!-- Start Search Controls -->
		<input id="pac-input" class="controls" type="text" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search" />
		<!-- End Search Controls -->
		
		<!-- Load Map -->
		<div id="customcon"><div id="map-canvas" style="z-index:0;"></div></div>
		<?php } ?>
		
	</head>
	<!-- End Head -->
	
	<?php include 'jquery.php'; ?>
