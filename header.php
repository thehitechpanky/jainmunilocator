<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<!-- Load Configuration File and created functions -->
<?php

include('functionsCreated.php');

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
	$metaKeywords = $titletag.', Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, list of all digamabar jain munis';
	$keywords = $metaKeywords.', Elacharya, Upadhyay, Elak, Kshullak, Aryika, Kshullika, Bhramcharya';
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
	<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
	<meta name="keywords" content="<?php echo $metaKeywords ?>">
	<meta name="author" content="Jain Muni Locator">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="alexaVerifyID" content="GfQ7YYpZjrH6gB9GuRuLa8OXMFA"/>

	<!-- styles -->
	<link href="./css/minified.css.php" rel="stylesheet" type="text/css" media="screen" />
	<!-- end styles -->
	
	<!-- Start Search Controls -->
	<input id="pac-input" class="controls" type="text" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search" />
	<!-- End Search Controls -->
	
	<!-- Load Map -->
	<div id="customcon"><div id="map-canvas" style="z-index:0;"></div></div>

</head>
<!-- End Head -->

<!-- start jquery scripts -->
<script type='text/javascript' src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
<script type='text/javascript' src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
<!-- load slider menu here, just after jquery, because it won't work after other scripts -->
<script type='text/javascript' src='js/sliderMenu.js'></script>
<!-- end jquery scripts -->
