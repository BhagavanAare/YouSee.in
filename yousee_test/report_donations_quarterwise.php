<?php
//query for testing output
$query = "SELECT
         YEAR(payment_date) year,
         QUARTER(payment_date) donation_quarter,
         SUM(instrument_amount) donation
         FROM payments
         GROUP BY year, donation_quarter
         ORDER BY year, donation_quarter ASC";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

//variables for generating data string for google chart api
$data="t:";
$marker_data="|";

//variables for generating labels string for google chart api
$month_label="0:|";
$year_label="1:|";

$total_hours=0;

//loop for generating the complete data string for google chart api
while ($row = mysql_fetch_assoc($result)) {
		$data .= $row['donation'] . ",";
                $marker_data .= "0" . ",";
                $month_label .= $row['donation_quarter'] . "|";
                $year_label .= $row['year'] . "|";
                $total_hours += $row['donation'];
}

$data = substr($data, 0, -1);
$marker_data = substr($marker_data, 0, -1);
$year_label = substr($year_label, 0, -1);

$data.= $marker_data;
$label= $month_label.$year_label;
?>

<img src="http://chart.apis.google.com/chart
?cht=lc
&chtt=Pospay+Donations+received+Quarterwise+-in+INR
&chxt=x,x,y
&chd=<?php echo $data;?>
&chxl=<?php echo $label;?>
&chs=600x350
&chds=a
&chco=99CC00
">
