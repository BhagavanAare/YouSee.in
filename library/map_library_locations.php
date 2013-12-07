<?php
require_once("classes/LocationQuery.php");
require_once("classes/Location.php");
require_once("classes/StaffQuery.php");
require_once("classes/Staff.php");

$locq = new LocationQuery();
$staffq = new StaffQuery();
$cityq = new CityQuery();

//if a city is clicked on the map its locations are shown
//if a location is clicked this map it is refreshed
//if a location is chosen from the search bar and submit is pressed
if ( isset($chosencity) && ($chosencity!= '') && ($chosencity!= ' '))	{
	$locations = $locq->getLocationsForCity($chosencity);
} else if ( isset($chosenlocationid) && ($chosenlocationid!= '') && ($chosenlocationid!= ' '))	{
	$locations = $locq->getLocationsInTheSameCityAs($chosenlocationid);
	$chosencity = $cityq->getCityOfLocation($chosenlocationid);
}

?>
<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
    </script>
<script type="text/javascript">
	var points = [
			<?php 	
				$points="";
				foreach($locations as $location) {
				$staff =  $staffq->getDetailsForStaff($location->getStaffid());
				$points.="['";
				$points.=$location->getAddressOne()."-".$location->getAddressTwo();
				$points.="',";
				$points.=$location->getLatitude();
				$points.=",";
				$points.=$location->getLongitude();
				$points.=",";
				$points.="5";
				$points.=",";
				$points.="'index.php?locationid=";
				$points.=$location->getLocationid();
				$points.="&lat=";
				$points.=$_GET['lat'];
				$points.="&long=";
				$points.=$_GET['long'];
				$points.="','";
				$points.=$staff->getFirstName()." ".$staff->getLastName();
				$points.="','";
				$points.=$staff->getContactNumber();
				$points.="','";
				$points.=$staff->getEmail();
				$points.="','";
				$points.=$location->getDays();
				$points.="','";
				$points.=$location->getTime();
				$points.="'],";
				}
				$points=substr($points,0,-1);
				echo $points;
			?>
		   ];
	function setMarkers(map, locations) {
    var shape = {
        coord: [1, 1, 1, 20, 18, 20, 18, 1],
        type: 'poly'
    };
    for (var i = 0; i < locations.length; i++) {
        var flag = new google.maps.MarkerImage(
            'http://googlemaps.googlermania.com/google_maps_api_v3/en/Google_Maps_Marker.png',
        new google.maps.Size(37, 34),
        new google.maps.Point(0, 0),
        new google.maps.Point(0, 19));
        var place = locations[i];
        var myLatLng = new google.maps.LatLng(place[1], place[2]);
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: flag,
            shape: shape,
            title: "Address : "+place[0] + "\nLibrarian : " + place[5] + "\nMobile : " + place[6] + "\nEmail : " + place[7] + "\nDays Open : " + place[8] + "\nTimings : " +  place[9],
            zIndex: place[3],
            url: place[4]
        });
        google.maps.event.addListener(marker, 'click', function () {
        window.location.href = this.url;
        });
    }
}
function initialize() {
var lat=<?php echo $_GET['lat'];?>;
var long= <?php echo $_GET['long'];?>;
    var myOptions = {
    center: new google.maps.LatLng(lat,long),
        zoom: 10,
   mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID ]
    }    };

    var map = new google.maps.Map(document.getElementById("map_locations"), myOptions);
    map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});
    setMarkers(map, points);

}
        google.maps.event.addDomListener(window,'load',initialize);
</script>
	<div id="map_locations" style="width: 800px; height: 500px"></div>
