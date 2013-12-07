<?php
include("prod_conn.php");
// this section generates query for volunteering contributions summary
$query = "SELECT DATE_FORMAT(MIN(from_date),'%d-%b-%Y') FROMDATE,
                 DATE_FORMAT(MAX(to_date),'%d-%b-%Y') TODATE,
                 SUM(hours) TOTALHOURS,
                 COUNT(DISTINCT DONOR_ID) VOLUNTEERS
          FROM volunteering";

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
  <table border="0" width="450" style='table-layout:fixed; font-family:"arial"; font-size:12px'><th width="25%"></th><th width="20%"></th><th width="10%"></th><th width="20%"></th><th width="25%"></th>
  <tr>
  <td colspan="5" align="center"><b>1. Volunteering Contributions</b><br>(a conservative account)<br>from <?php echo  $fromdate; ?> to <?php echo  $todate; ?></td>
  </tr>
  <tr>
  <td align="right"><img src="images/time-image.jpg" border="0" /></td>
  <td align="left"><h2><?php echo $totalhours; ?> Volunteer Hours</h2></td>
  <td align="center">from</td>
  <td align="right"><img src="images/volunteer-image.jpg" border="0" /></td>
  <td align="left"><h2><?php echo $totalvolunteers; ?> Volunteers</h2></td>
  </tr>
  </table>
  </div>

  </body>
</html>
