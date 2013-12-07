<?php
//query for testing output
$query = "SELECT
         YEAR(FROM_DATE) year,
         MONTH(FROM_DATE) month_number,
         SUBSTR((MONTHNAME(FROM_DATE)),1,3) month_name,
         SUM(hours) totalhours
         FROM volunteering
         GROUP BY year, month_number
         ORDER BY year, month_number ASC";

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
		$data .= $row['totalhours'] . ",";
                $marker_data .= "0" . ",";
                $month_label .= $row['month_name'] . "|";
                $year_label .= $row['year'] . "|";
                $total_hours += $row['totalhours'];
}

$data = substr($data, 0, -1);
$marker_data = substr($marker_data, 0, -1);
$year_label = substr($year_label, 0, -1);

$data.= $marker_data;
$label= $month_label.$year_label;
?>

<img src="http://chart.apis.google.com/chart
?cht=lc
&chtt=Volunteer+Hours+Donated+by+Month
&chxt=x,x,y
&chd=<?php echo $data;?>
&chxl=<?php echo $label;?>
&chs=350x250
&chds=a
&chco=99CC00
&chem=y;s=cm_color;ds=0;dp=all;d=glyphish_clock,0,6699FF,6699FF,6699FF,16,000,hb
">
