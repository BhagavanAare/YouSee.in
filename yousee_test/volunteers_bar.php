<?php
include("prod_conn.php");
// this section generates query for volunteering contributions summary
$query = "SELECT COUNT(DISTINCT DONOR_ID) VOLUNTEERS FROM volunteering";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
		$totalvolunteers = $row['VOLUNTEERS'];
		}
//echo  $totalvolunteers;

?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.css"/>
    <script type="text/javascript" src="http://yousee.in/scripts/bos.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  </head>
  <body>
    <div id="chartdiv" style="width: 300px"></div>
    <script type="text/javascript">
      google.load("visualization", "1");
      google.setOnLoadCallback(drawChart);
      var chart;
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Label');
        data.addColumn('number', 'Value');
        data.addRows(2);
        data.setCell(0, 0, 'Volunteers');
        data.setCell(0, 1, <? echo $totalvolunteers; ?>, "<? echo $totalvolunteers; ?>");
        var chartDiv = document.getElementById('chartdiv');
        var options = {type: 'volunteer'};
        chart = new BarsOfStuff(chartDiv);
        chart.draw(data, options);
        //google.visualization.events.addListener(chart, 'select', handleSelect);
       }
    </script>


  </body>
</html>
