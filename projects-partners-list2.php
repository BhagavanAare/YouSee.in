<?php

include("prod_conn.php");

$query = " SELECT PROJECT_AREA, PROJECT_TITLE, NAME, LOCATION, PROJECT_STATUS
FROM(SELECT PROJECT_ID, PROJECT_TITLE, LOCATION, PROJECT_AREA, PROJECT_STATUS, PARTNER_ID
FROM PROJECTS LEFT OUTER JOIN PROJECT_CERTIFICATES USING (PROJECT_ID)
WHERE PROJECT_STATUS = 'Active'
GROUP BY PARTNER_ID)INFO LEFT OUTER JOIN PROJECT_PARTNERS USING (PARTNER_ID)";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$sno = 1;


echo "<table border='1'><tr><th>S-No</th><th>Area</th><th>Location</th><th>Implementing-Partner</th><th>Project</th></tr>";
while ($row = mysql_fetch_assoc($result)) {
                echo "<tr><td>" . $sno . "</td><td>" . $row['PROJECT_AREA'] . "</td><td>" . $row['LOCATION'] . "</td><td>" . $row['NAME'] . "</td><td>". $row['PROJECT_TITLE'] . "</td></tr>";
                $sno++;
                }
echo "</table>";


?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["map"]});
      google.setOnLoadCallback(drawMap);
      function drawMap() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Lat');
        data.addColumn('number', 'Lon');
        data.addColumn('string', 'Name');
        data.addRows(4);
        data.setCell(0, 0, 17.2231);
        data.setCell(0, 1, 78.2827);
        data.setCell(0, 2, 'Hyderabad');
        data.setCell(1, 0, 22.4300);
        data.setCell(1, 1, 75.5000);
        data.setCell(1, 2, 'Indore');
        data.setCell(2, 0, 20.1400);
        data.setCell(2, 1, 85.5000);
        data.setCell(2, 2, 'Bhubaneswar');
        data.setCell(3, 0, 10.5000);
        data.setCell(3, 1, 78.4600);
        data.setCell(3, 2, 'TamilNadu');

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {showTip: true});
      }
    </script>
  </head>

  <body>
    <div id="map_div" style="width: 400px; height: 300px"></div>
  </body>
</html>
