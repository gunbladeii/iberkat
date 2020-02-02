<?php session_start();?>
<?php
    require('conn.php');
    $longitude = $_GET['longitude'];
    $latitude = $_GET['latitude'];
    
?>
   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDloX9GMN9TNA1bTknKg8fODZPeBZistSw&callback=initMap">
    </script>
<script>
function showPosition2() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showMap, showError);
    } else {
        alert("Sorry, your browser does not support HTML5 geolocation.");
    }
}
 
// Define callback function for successful attempt
function showMap(position) {
    // Get location data
    lat = <?php echo $latitude;?>;
    long = <?php echo $longitude;?>;
    var latlong = new google.maps.LatLng(lat, long);
    
    var myOptions = {
        center: latlong,
        zoom: 16,
        mapTypeControl: true,
        navigationControlOptions: {
            style:google.maps.NavigationControlStyle.SMALL
        }
    }
    
    var map = new google.maps.Map(document.getElementById("embedMap"), myOptions);
    var marker = new google.maps.Marker({ position:latlong, map:map, title:"You are clock-in here!" });
}
 
// Define callback function for failed attempt
function showError(error) {
    if(error.code == 1) {
        result.innerHTML = "You've decided not to share your position, but it's OK. We won't ask you again.";
    } else if(error.code == 2) {
        result.innerHTML = "The network is down or the positioning service can't be reached.";
    } else if(error.code == 3) {
        result.innerHTML = "The attempt timed out before it could get the location data.";
    } else {
        result.innerHTML = "Geolocation failed due to unknown error.";
    }
}
</script>

    <div class="card">
      <div id="embedMap" style="width: 100px; height: 200px;">
        <!--Google map will be embedded here-->
      </div>
    </div>
    
 

