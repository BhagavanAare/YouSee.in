<?php
// this file generates Horisontal Bar graph for Waste Donations Received by Items Category in Rs
include("prod_conn.php");
$query = "SELECT donationitemcategory, SUM(donationvalue) donation_value
FROM items JOIN donatewaste USING (item_id)
WHERE donor_id=".$_SESSION['SESS_DONOR_ID']."
GROUP BY donationitemcategory";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

$result = mysql_query($query);
$data = "t:";
$labels = "|";
$total_donation = 0;

while ($row = mysql_fetch_assoc($result)) {
/*
echo $row['donationitemcategory'] . "," . $row['donation_value'];
                echo "<br />";
below line reverses the order of data as against labels,
to ensure realignment of data and labels in horisontal bar display.
*/
   $data .= $row['donation_value'] . ",";
   $labels = $row['donationitemcategory'] . $labels;
   $labels = "|" . $labels; 
   $total_donation += $row['donation_value'];}
   $data = substr($data, 0, -1);
   $labels = "1:" . $labels;
   $ptotal_donation = number_format($total_donation, 0, '.', ',');
?>

<img src="http://chart.apis.google.com/chart
?cht=bhs
&chtt=Donations+by+Items+-Total+INR+<?php echo $ptotal_donation;?>
&chxt=x,y
&chd=<?php echo $data;?>
&chxl=<?php echo $labels;?>
&chds=a
&chbh=a
&chco=99CC00
&chs=350x150
">