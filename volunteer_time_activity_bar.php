<html>
  <head>
    <link rel="stylesheet" type="text/css" href="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.css"/>
    <script type="text/javascript" src="http://yousee.in/scripts/bos.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  </head>
  <body>
    <p>Volunteering time contributed by Onsite & Offsite (in Hrs)</p>
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

<?
include("prod_conn.php");

$query = "SELECT SUM(HOURS) TOTALHOURS, AREA
         FROM VOLUNTEERING
         GROUP BY AREA";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

        $jsrow = 0;
        $column1 = "";
        $column2 = "";
        while ($row = mysql_fetch_assoc($result)) {
        $area = $row['AREA'];
        $totalhours = $row['TOTALHOURS'];
        //echo "data.setCell($jsrow, 0, '$site');";
        $fetchcolumn1 = "data.setCell(" . $jsrow . ", 0, '" . $area ."');";
        $fetchcolumn2 = "data.setCell(" . $jsrow . ", 1, " . $totalhours . ", '" . $totalhours . "');";
        $jsrow++;
        $column1 = $column1 . $fetchcolumn1 ;
        $column2 = $column2 . $fetchcolumn2 ;
        }
        echo $column1 . $column2;

?>

        var chartDiv = document.getElementById('chartdiv');
        var options = {type: 'time'};
        chart = new BarsOfStuff(chartDiv);
        chart.draw(data, options);
        //google.visualization.events.addListener(chart, 'select', handleSelect);
       }
    </script>

  </body>
</html>

