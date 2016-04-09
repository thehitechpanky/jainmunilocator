<?php

include '../config.php';
include '../munis/getMuni.php';

function month($month_int) {
	$month_int = (int)$month_int;
	$months = array('' ,'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	return $months[$month_int];
}

$today = date("y-m-d");
$currentmonth = date("m");
$nextmonth = 3; //$currentmonth + 1;

$i = 0;
$q = $db->prepare("SELECT * FROM munishri");
$q->execute();
while($q->fetch(PDO::FETCH_ASSOC)) {
	$i++;
}

$msg = '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-GB" xml:lang="en-GB">
<p>Jai Jinendra _______ Ji!</p>
	<p>With your support and help, we have been able to gather information about '.$i.' monks &amp; nuns.&nbsp;
	As a token of gratitude, we have compiled a small update for you highlighting the upcoming events of next month.</p><br />
	<h2>Upcoming Events in '.month($nextmonth).'</h2>';

$i = 0;
$j = 0;
$q = $db->prepare("SELECT * FROM munishri, acharya WHERE id=acharyaid AND upadhi=1 AND MONTH(adate)=?");
$q->execute(array($nextmonth));

while ($q->fetch(PDO::FETCH_ASSOC)) {
	$i++;
}

if ($i > 0) {
	
	$msg = $msg.'<h3>Promotion Anniversary (पदारोहण दिवस)</h3>
	<table>
	<tr><th>S.No.</th><th>Date</th><th>Name</th></tr>';
	
	$t = $db->prepare("SELECT * FROM munishri, acharya WHERE id=acharyaid AND upadhi=1 AND MONTH(adate)=? ORDER BY adate");
	$t->execute(array($nextmonth));
	while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
		$j++;
		$msg = $msg.'<tr><td>'.$j.'</td><td>'.date('d',strtotime($row['adate'])).'</td><td><a href="http://jainmunilocator.org/munis.php?id='.$row['id'].'">'
			.getmuni($row['id']).'</a></td></tr>';
	}
	
	$msg = $msg.'</table>';
	
}

$i = 0;
$j = 0;
$q = $db->prepare("SELECT * FROM munishri, muni, aryika WHERE id=muniid AND id=aryikaid AND (upadhi=4 OR upadhi=7) AND (MONTH(munidate)=? OR MONTH(aryikadate)=?)");
$q->execute(array($nextmonth,$nextmonth));

while ($q->fetch(PDO::FETCH_ASSOC)) {
	$i++;
}

if ($i > 0) {
	
	$msg = $msg.'<h3>Intitiation Anniversary (दीक्षा दिवस)</h3>
	<table>
	<tr><th>S.No.</th><th>Date</th><th>Name</th></tr>';
	
	$t = $db->prepare("SELECT id, upadhi, muniid, munidate FROM muni, munishri WHERE id=muniid AND (upadhi=4 OR upadhi=7) AND MONTH(munidate)=? UNION
	SELECT id, upadhi, aryikaid, aryikadate FROM aryika, munishri WHERE id=aryikaid AND (upadhi=4 OR upadhi=7) AND MONTH(aryikadate)=?");
	$t->execute(array($nextmonth,$nextmonth));
	while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
		$j++;
		$msg = $msg.'<tr><td>'.$j.'</td><td>'.$row['munidate'].'</td>
		<td><a href="http://jainmunilocator.org/munis.php?id='.$row['id'].'">'.getmuni($row['id']).'</a></td></tr>';
	}
	
	$msg = $msg.'</table>';
	
}

$msg = $msg.'<br /><h3>We would like to hear from you.</h3>
	<p>Tell us what you think of our initiative. Let us know if you want more from us.</p>
	
	<br />
	Thanks &amp; Regards<br />
	Pankaj Jain<br />
	Administrator<br />
	<a href="http://jainmunilocator.org">Jain Muni Locator</a>
	</html>';

echo $msg;

?>
