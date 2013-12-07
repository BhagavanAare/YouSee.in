<?
include("prod_conn.php");
$query = "SELECT * FROM places 
          WHERE city='".$city."' AND place_type='Compost Center'";
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$rows = mysql_num_rows($result);
?>



    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["map"]});
      google.setOnLoadCallback(drawMap);
      function drawMap() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Lat');
        data.addColumn('number', 'Lon');
        data.addColumn('string', 'Name');
        data.addRows(<? echo $rows; ?>);

        <?
        $jsrow = 0;
        while ($row = mysql_fetch_assoc($result)) {
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
        $location = $row['organisation'] . ", " . $row['location'];
        echo "data.setCell($jsrow, 0, $latitude); data.setCell($jsrow, 1, $longitude); data.setCell($jsrow, 2, '$location');";
        $jsrow++;
        }
        ?>

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {showTip: true});
      }
    </script>



    <div id="map_div" style="width: 900px; height: 500px"></div>


