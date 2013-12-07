<?php
// this file generates Horisontal Bar graph for Waste Donations Received by Items Category in Rs
include("prod_conn.php");
$query = "SELECT
         FORMAT(SUM(donationquantity),0) donation_kg,
         DATE_FORMAT(MIN(dateofdonation),'%d-%b-%Y') from_date,
         DATE_FORMAT(MAX(dateofdonation),'%d-%b-%Y') to_date
         FROM donatewaste
         WHERE donationunit=1";

$query2 = "SELECT
         FORMAT(COUNT(bookid),0) total_books,
         DATE_FORMAT(MIN(donation_date),'%d-%b-%Y') from_date,
         DATE_FORMAT(MAX(donation_date),'%d-%b-%Y') to_date
         FROM uc_bookdonations";


mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$result2 = mysql_query($query2);

while ($row = mysql_fetch_assoc($result)) {
$totaldonation_kg= $row['donation_kg'];
$from_date= $row['from_date'];
$to_date= $row['to_date'];
}

while ($row2 = mysql_fetch_assoc($result2)) {
$total_books= $row2['total_books'];
$from_date2= $row2['from_date'];
$to_date2= $row2['to_date'];
}

?>

<html>
  <head>  </head>
  <body>
  <div align="center">
  <table border="0" width="450" style='table-layout:fixed; font-family:"arial"; font-size:12px'><th width="25%"><th width="25%"><th width="25%"></th><th width="25%"></th>
  <tr>
  <td colspan="2" align="center"><b>2. Donations in Kind</b><br>from <?php echo  $from_date2; ?> to <?php echo  $to_date2; ?></td>
  <td colspan="2" align="center"><b>3. Waste Donations</b><br>from <?php echo  $from_date; ?> to <?php echo  $to_date; ?></td>
  </tr>
  <tr>
  <td align="right"><img src="images/books1.jpg" border="0" /></td>
  <td align="left"><h2><?php echo $total_books; ?> Books</h2></td>
  <td align="right"><img src="images/wastebin.jpg" border="0" /></td>
  <td align="left"><h2><?php echo $totaldonation_kg; ?> Kgs</h2></td>
  </tr>
  </table>
  </div>

  </body>
</html>