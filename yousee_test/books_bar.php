<html>
  <head>
    <link rel="stylesheet" type="text/css" href="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.css"/>
    <script type="text/javascript" src="http://yousee.in/scripts/bos.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  </head>
  <body>
  
    <p align="center"><b>Category of Books Donated</b></p>
    <div id="chartdiv" style="width: 300px"></div>
    <script type="text/javascript">
      google.load("visualization", "1");
      google.setOnLoadCallback(drawChart);
      var chart;
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Label');
        data.addColumn('number', 'Value');

<?php
include("prod_conn.php");

$query = "SELECT categoryid, categoryname, COUNT(bookid) books
         FROM uc_bookdonations LEFT OUTER JOIN uc_category USING (categoryid)
         GROUP BY categoryid";

$query2 = "SELECT SUM(books) totalbooks
          FROM(SELECT categoryid, COUNT(bookid) books
               FROM uc_bookdonations
               GROUP BY categoryid)INFO";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$result2 = mysql_query($query2);

        $jsrow = 0;
        $column1 = "";
        $column2 = "";
        while ($row2 = mysql_fetch_assoc($result2)) {
        $totalbooks = $row2['totalbooks'];
        }
        while ($row = mysql_fetch_assoc($result)) {
        $category = $row['categoryname'];
        $books = $row['books'];
        $bookspct = round((($books/$totalbooks)*100),0);
        $fetchcolumn1 = "data.setCell(" . $jsrow . ", 0, '" . $category ."');";
        $fetchcolumn2 = "data.setCell(" . $jsrow . ", 1, " . $books . ", '" . $books . "(" . $bookspct ."%)');";
        $jsrow++;
        $column1 = $column1 . $fetchcolumn1 ;
        $column2 = $column2 . $fetchcolumn2 ;
        }
?>
        data.addRows(<?php echo $jsrow; ?>);
        <?php echo $column1 . $column2; ?>
        <?php echo $totalbooks; ?>

        var chartDiv = document.getElementById('chartdiv');
        var options = {type: 'book'};
        chart = new BarsOfStuff(chartDiv);
        chart.draw(data, options);
        //google.visualization.events.addListener(chart, 'select', handleSelect);
       }
    </script>

  </body>
</html>

