function latlngtoadd(lat,lng)
{

var geozcoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(lat, lng);
   geozcoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        return results[1].formatted_address;
  
      } 
    } 
  }); 
}
function addtolatlng(address)
{
alert("X");
var geozcoder = new google.maps.Geocoder();
geozcoder.geocode( { 'address': address}, function(results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
       alert("D");
             } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    }); 
}
