<?php
include("prod_conn.php");
$query = "SELECT * FROM places JOIN place_category ON 
places.place_category_id = place_category.place_category_id
          WHERE city='".$city."' AND (place_category='Compost Center' OR place_category='Donation Camp')";
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$num = mysql_num_rows($result);
?>

<html>
  <head>

  <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
  </script>
      <script type="text/javascript">
       	var points = [
				<?php 
				$i=1;
				while($row=mysql_fetch_array($result)){
					echo "['$row[place_category], $row[location]',$row[latitude],$row[longitude],1,'places/$row[place_id]']";
					if($i!=$num){
						echo ",";
					}
					else{
						$lat=$row['latitude'];
						$long=$row['longitude'];
					}
					$i++;
				}
				?>
				];
	function setMarkers(map, cities) {
	    var shape = {
	        coord: [1, 1, 1, 20, 18, 20, 18, 1],
	        type: 'poly'
	    };
	    for (var i = 0; i < cities.length; i++) {
	        var flag = new google.maps.MarkerImage(
	            'http://googlemaps.googlermania.com/google_maps_api_v3/en/Google_Maps_Marker.png',
	        new google.maps.Size(37, 34),
	        new google.maps.Point(0, 0),
	        new google.maps.Point(10, 34));
	        var place = cities[i];
	        var myLatLng = new google.maps.LatLng(place[1], place[2]);
	        var marker = new google.maps.Marker({
	            position: myLatLng,
	            map: map,
	            icon: flag,
	            shape: shape,
	            title: place[0],
	            zIndex: place[3],
	            url: place[4]
	        });
	        google.maps.event.addListener(marker, 'click', function () {
	        window.location.href = this.url;
	        });
	    }
	}
	function initialize() {
		// Create an array of styles.


	    var myOptions = {
	    center: new google.maps.LatLng(<?php echo $lat.",".$long;?>),
	        zoom: 10,
	   mapTypeControlOptions: {
	      mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID ]
	    }
	    };
		
	    var map = new google.maps.Map(document.getElementById("map_div"), myOptions);
	    map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: false});

	     setMarkers(map, points);
	}
	
	google.maps.event.addDomListener(window,'load',initialize);
    </script>
  </head>

  <body>
    <div id="map_div" style="width: 800px; height: 400px"></div>
  </body>
</html>
