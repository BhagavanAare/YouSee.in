<?php
include("prod_conn.php");
// this section generates query for volunteering contributions summary
$query = "SELECT DATE_FORMAT(MIN(FROM_DATE),'%d-%b-%Y') FROMDATE, 
                 DATE_FORMAT(MAX(TO_DATE),'%d-%b-%Y') TODATE, 
                 SUM(HOURS) TOTALHOURS, 
                 COUNT(DISTINCT DONOR_ID) VOLUNTEERS 
          FROM VOLUNTEERING";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
		$fromdate = $row['FROMDATE'];
		$todate = $row['TODATE'];
		$totalhours = $row['TOTALHOURS'];
		$totalvolunteers = $row['VOLUNTEERS'];
		}
//echo  $fromdate . "," . $todate . "," . $totalhours;

?>

<html>
  <head>  </head>
  <body>
  <div align="center">
  <table border="0" width="450" style='table-layout:fixed; font-family:"arial"; font-size:12px'><th width="30%"></th><th width="15%"></th><th width="10%"></th><th width="15%"></th><th width="30%"></th>
  <tr><td colspan="5" align="center"><b>Total Volunteering Contributions Received</b><br>(a conservative account)<br>from <? echo  $fromdate; ?> to <? echo  $todate; ?></td></tr>
  <tr><td rowspan="2" align="right"><img src="images/time-image.jpg" border="0" /></td><td align="left"><h1><? echo $totalhours; ?></h1></td><td rowspan="2" align="center">from</td><td rowspan="2" align="right"><img src="images/volunteer-image.jpg" border="0" /></td><td align="left"><h1><? echo $totalvolunteers; ?></h1></td></tr>
  <tr><td align="left"><b>Volunteer Hours</b></td><td align="left"><b>Volunteers</b></td></tr>
  </table>
  </div>

  </body>
</html>
