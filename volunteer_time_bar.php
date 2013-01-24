<html>
  <head>
    <link rel="stylesheet" type="text/css" href="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.css"/>
    <script type="text/javascript" src="http://yousee.in/scripts/bos.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  </head>
  <body>
    <p align="center"><b>Onsite & Offsite Volunteering Time Contributed (in Hours)</b></p>
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

$query = "SELECT SUM(hours) TOTALHOURS, onsite_offsite
         FROM volunteering
         GROUP BY onsite_offsite";

$query2 = "SELECT SUM(TOTALHOURS) ALLHOURS
          FROM(SELECT SUM(hours) TOTALHOURS, onsite_offsite
         FROM volunteering
         GROUP BY onsite_offsite)INFO";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$result2 = mysql_query($query2);

        $jsrow = 0;
        $column1 = "";
        $column2 = "";
        while ($row2 = mysql_fetch_assoc($result2)) {
        $allhours = $row2['ALLHOURS'];
        }
        while ($row = mysql_fetch_assoc($result)) {
        $site = $row['onsite_offsite'];
        $hours = $row['TOTALHOURS'];
        $hourspct = round((($hours/$allhours)*100),0);
        $fetchcolumn1 = "data.setCell(" . $jsrow . ", 0, '" . $site ."');";
        $fetchcolumn2 = "data.setCell(" . $jsrow . ", 1, " . $hours . ", '" . $hours . "(" . $hourspct ."%)');";
        $jsrow++;
        $column1 = $column1 . $fetchcolumn1 ;
        $column2 = $column2 . $fetchcolumn2 ;
        }
        echo $column1 . $column2;
        echo $allhours;

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

