<?php
//query for selecting all Children Homes at Hyderabad
$city = "Hyderabad";
$query = "SELECT * FROM places
          WHERE city='".$city."' AND place_type='Children Home'";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$rows = mysql_num_rows($result);

// create the data string for exporting data to map API
$datastring = "[";
while ($row = mysql_fetch_assoc($result)) {
$latitude = $row['latitude'];
$longitude = $row['longitude'];
$location = $row['place_description'] . ", " . $row['organisation'] . ", " . $row['location'];
$datastring = $datastring . $latitude . ", " . $longitude . ", '" . $location . "'], [";
}
$datastring = substr($datastring, 0, -3);
$latlng = $latitude . ", " . $longitude;
?>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	 
      google.setOnLoadCallback(drawMap1);
      	function drawMap1() {
        var domNode = document.getElementById('cont-1-map');
	if(!domNode.isMapLoaded){
	var data = google.visualization.arrayToDataTable([
        ['Lat', 'Lon', 'Name'],
        <?php echo $datastring; ?> 
        ]);
        var map = new google.visualization.Map(domNode);
        map.draw(data, {showTip: true});
	domNode.isMapLoaded = true;
	}
      }

    </script>

    <div id="cont-1-map" style="width: 900px; height: 500px"></div>
    <br>
<?php 
//dispaly as a table the map pointers data
include 'display_table.php';
?>

