<!DOCTYPE html>
<html> 
<head> 
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
   <title>Google Maps Geocoding Demo 1</title> 
   <script src="http://maps.google.com/maps/api/js?sensor=false" 
           type="text/javascript"></script> 
</head> 
<body> 
   <div id="map" style="width: 400px; height: 300px;"></div> 

   <script type="text/javascript"> 

   var address = '<?php echo $_GET["location"] ?>';

   var map = new google.maps.Map(document.getElementById('map'), { 
       mapTypeId: google.maps.MapTypeId.TERRAIN,
       zoom: 6
   });

   var geocoder = new google.maps.Geocoder();

   geocoder.geocode({
      'address': address
   }, 
   function(results, status) {
      if(status == google.maps.GeocoderStatus.OK) {
         new google.maps.Marker({
            position: results[0].geometry.location,
            map: map
         });
         map.setCenter(results[0].geometry.location);
      }
   });

   </script> 
</body> 
</html>
