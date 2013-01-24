<?php
// this file generates Horisontal Bar graph for Waste Donations Received by Donor in Rs in a particular City
include("prod_conn.php");
$query = "SELECT DONOR_ID, DISPLAYNAME, SUM(donationvalue) donation_value
FROM donatewaste LEFT OUTER JOIN donors USING (donor_id)
WHERE city='".$city."'
GROUP BY donor_id
ORDER BY DISPLAYNAME ASC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

$result = mysql_query($query);
$data = "t:";
$labels = "|";
$total_donation = 0;

while ($row = mysql_fetch_assoc($result)) {
/*
echo $row['donor'] . "," . $row['donation_value'];
                echo "<br />";
below line reverses the order of data as against labels,
to ensure realignment of data and labels in horizntal bar display.
*/
		$data .= $row['donation_value'] . ",";
                $labels = $row['DISPLAYNAME'] . $labels;
                $labels = "|" . $labels; 
                $total_donation += $row['donation_value'];}
                $data = substr($data, 0, -1);
                $labels = "1:" . $labels;
                $ptotal_donation = number_format($total_donation, 0, '.', ',');
?>

<img src="http://chart.apis.google.com/chart
?cht=bhs
&chtt=Donations+by+Donor+-Total+INR+<?php echo $ptotal_donation;?>
&chxt=x,y
&chd=<?php echo $data;?>
&chxl=<?php echo $labels;?>
&chds=a
&chbh=a
&chco=99CC00
&chs=500x250
">
