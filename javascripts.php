<!-- start jquery scripts -->
<script type='text/javascript' src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
<script type='text/javascript' src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
<!-- load slider menu here, just after jquery, because it won't work after other scripts -->
<script type='text/javascript' src='js/sliderMenu.js'></script>
<!-- end jquery scripts -->

<!-- start jquery calender scripts -->
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.2/fullcalendar.min.js"></script>
<script type="text/javascript" src="js/eventsCalendar.js"></script>-->
<!-- end jquery calender scripts -->

<!-- start google scripts -->
<script type='text/javascript' src='https://www.google.com/recaptcha/api.js' async defer></script>
<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=________________'></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<!-- end google scripts -->

<!-- start custom scripts -->
<script type='text/javascript'>
	var locations =  <?php echo json_encode( $array ) ?>;
</script>
<script type='text/javascript' src='js/jquery.custom.js'></script>
<script type='text/javascript' src='js/jquery.supersized.js'></script>
<script type='text/javascript' src='js/jquery.supersized.shutter.min.js'></script>
<script type='text/javascript' src='js/jquery-ui-1.8.18.custom.min.js'></script>
<script type='text/javascript' src='js/jquery.tipsy.js'></script>
<script type='text/javascript' src='js/jquery.form.js'></script>
<script type='text/javascript' src='js/jquery.isotope.min.js'></script>
<script type='text/javascript' src='js/jquery.easing.js'></script>
<script type='text/javascript' src='js/jquery.preloader.js'></script>
<script type='text/javascript' src='js/jquery.prettyPhoto.js'></script>
<script type='text/javascript' src='js/jquery.scroll.min.js'></script>
<script type='text/javascript' src='js/googleMaps.js'></script>
<?php
if($loadFormActionsScript=="Yes") {
	echo "<script type='text/javascript' src='js/formActions.js'></script>";
} else {
	$loadFormActionsScript = "No";
}
?>
<script type='text/javascript' src='js/fbComments.js'></script>
<!-- end custom scripts -->
