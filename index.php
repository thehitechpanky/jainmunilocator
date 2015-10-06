<!DOCTYPE html>
<html dir="ltr" lang="en-US">
	
<?php include('functionsCreated.php'); ?>

<!-- Start Head -->
<head>
	
	<!-- start title - should be 57 characters max as suggested by http://seorch.eu -->
	<title>Jain Muni Locator - Details Digambar Jain Sadhus Sadhvis</title>
	
	<!-- start meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Jain Muni Locator - Details Digambar Jain Sadhus Sadhvis, Jain Muni Locator is about building a global database to locate all the Digambar Jain Muni-shris in world, freely accessible to all the Jainism followers.">
	<!-- Meta Keywords should be 8 only for optimum SEO results as suggested by http://www.seoworkers.com/tools/analyzer.html -->
	<meta name="keywords" content=", Jainism, Jain Sadhu, Jain Acharya, Jain Guru, Meaning of 108, Mahagun, list of all digamabar jain munis">
	<meta name="author" content="Jain Muni Locator">
	<meta name=viewport content="width=device-width, initial-scale=1">
	
	<?php include 'alexa.php'; include 'css.php'; ?>
	
	<!-- Start Search Controls -->
	<input id="pac-input" class="controls" type="text" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search" />
	<!-- End Search Controls -->
	
	<!-- Load Map -->
	<div id="customcon"><div id="map-canvas" style="z-index:0;"></div></div>
	
</head>
<!-- End Head -->
	
<?php include 'jquery.php' ?>
	
<!-- Start Body -->
<body class="page-template-template-homepage-php" onunload="" itemscope itemtype="http://schema.org/WebPage">

<!-- start dotted pattern -->
<div class="bg-overlay"></div>
<!-- end dotted pattern -->

<!-- start navigation -->	
<?php include('menu.php'); ?>
<!-- end navigation -->
	
<!-- Text length should be more than 400 words as suggested by http://seorch.eu -->
	
	<header>
	<h1><strong><em><i><cite><blockquote><u><span itemprop="headline">Jain Muni Locator Home Page</span></u></blockquote></cite></i></em></strong></h1>
	<h2><span itemprop="description">Find location of all Digambar Jain Acharyas, Upadhyas, Munis, Sadhus, Aryikas and Sadhvis in a single map on any device along with their details.</span></h2>
	<h3><span itemprop="text">
		The initiative taken is about building a global database to locate all the Digambar Jain Muni-shris in world. The database is freely accessible to all the Jainism followers on this website. As time is eternal and formless, this initiative will help the modern jainism followers to be informed about Munishris just by an instant search which can be done on various smart phones.<br />
		Jain Muni Locator will expand and reach to Munishri's and Aryika's, who are bondless spiritual souls, will teach us the importance of being self-disciplined.<br />
		The initiative  is to preserve the beliefs and practices of Jainism and this regularly updated website will help jain community to stay in touch with their religion in this trendy scenario.<br />
		Thus, advancing will establish oneself in moral values  and will bring spiritual revolution.
	</span></h3>
	
	<h4>Note: This is an Opensource Project. To view code files or contribute in coding, please visit <a href="http://github.com/thehitechpanky/jainmunilocator" title="Github Link">http://github.com/thehitechpanky/jainmunilocator</a></h4>
	<h5>At present we have:
		<ol>
			<li>A list of sixty-two Digambar Jain Acharyas.</li>
			<li>A list of one Digambar Jain Elacharyas.</li>
			<li>A list of two Digambar Jain Upadhyas.</li>
			<li>A list of one hundred and sixty-eight Digambar Jain Munis.</li>
			<li>A list of six Digambar Jain Ailaks.</li>
			<li>A list of six Digambar Jain Kshullaks.</li>
			<li>A list of one hundred and thirty Digambar Jain Aryikas.</li>
			<li>A list of zero Digambar Jain Kshullikas.</li>
		</ol>
	</h5>
	<h6>Further we also have:
		<ol>
			<li>Descrition about Meaning of 108.</li>
			<li>Descrition about Mahagun.</li>
			<li>Descrition about Uttargun.</li>
			<li>Descrition about Events.</li>
			<li>Descrition about Chaturmas.</li>
		</ol>
	</h6>
	</header>
	<aside>Main menu which has been transformed into a small button slides out from left on clicking that button thereby making the user experience better.</aside>
	<article></article>
	<section></section>
	<footer></footer>
	<nav>The Main Menu of the website has been transformed into a small button in searchbox for better accessibility to the locations in map.</nav>
	<details>
	<p>Muni Profile at present shows the following details</p>
		<ol>
			<li>Name of the muni</li>
			<li>Image of the muni</li>
			<li>Current Location of the muni</li>
			<li>Books written by the muni</li>
			<li>Chaturmas of the muni</li>
			<li>Guru of Muni linked to his profiles showing his image on hover.</li>
			<li>History about the muni</li>
			<li>Shishawali of Acharya linked to profiles of shishyas showing the images on hover.</li>
		</ol>
	</details>

<?php include('footer.php'); ?>
