<?php
// this file generates Horisontal Bar graph for Waste Donations Received by Items Category in Rs
include("prod_conn.php");
$query = "SELECT 
         FORMAT(SUM(donationquantity),0) donation_kg,
         DATE_FORMAT(MIN(dateofdonation),'%d-%b-%Y') from_date,
         DATE_FORMAT(MAX(dateofdonation),'%d-%b-%Y') to_date
         FROM donatewaste
         WHERE DONOR_ID=".$_SESSION['SESS_DONOR_ID']." AND donationunit=1";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
$totaldonation_kg= $row['donation_kg'];
$from_date= $row['from_date'];
$to_date= $row['to_date'];
}

?>

<html>
  <head>  </head>
  <body>
  <div align="center">
  <table border="0" width="450" style='table-layout:fixed; font-family:"arial"; font-size:12px'><th width="50%"></th><th width="50%"></th>
  <tr><td colspan="2" align="center"><b>My Waste Donations</b><br>from <? echo  $from_date; ?> to <? echo  $to_date; ?></tr>
  <tr><td align="right"><img src="images/wastebin.jpg" border="0" /></td><td align="left"><h2><? echo $totaldonation_kg; ?> Kgs</h2></td></tr>
  </table>
  </div>

  </body>
</html>