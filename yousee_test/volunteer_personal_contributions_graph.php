<?php
include("prod_conn.php");
// this section generates query for volunteering contributions summary
$query = "SELECT DATE_FORMAT(MIN(from_date),'%d-%b-%Y') FROMDATE,
                 DATE_FORMAT(MAX(to_date),'%d-%b-%Y') TODATE,
                 SUM(hours) TOTALHOURS
          FROM volunteering
          WHERE donor_id=".$_SESSION['SESS_DONOR_ID'];

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
		$fromdate = $row['FROMDATE'];
		$todate = $row['TODATE'];
		$totalhours = $row['TOTALHOURS'];
		}

?>

<div align="center">
	<table border="0"  style='font-family:"arial"; font-size:12px; width:330px;'>
		<th width="50%"></th><th width="50%"></th>
		<tr>
			<td colspan="2" align="center"><b>My Volunteering Time Contributions</b><br>(a conservative account)<br>from <?php echo  $fromdate; ?> to <?php echo  $todate; ?></td></tr>
		<tr>
			<td rowspan="2" align="right"><img src="images/time-image.jpg" border="0" /></td>
			<td align="left"><h2><?php echo $totalhours; ?> Hours</h2></td>
		</tr>
	</table>
</div>
