<?php
//query for calculating volunteer hours received by onsite-offsite categorisation
$query = "SELECT SUM(hours) totalhours, onsite_offsite
         FROM volunteering
         GROUP BY onsite_offsite";

//query for calculating voluneer hours received by onsite-offsite categorisation
$query2 = "SELECT SUM(hours) totalhours FROM volunteering";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$result2 = mysql_query($query2);

//variables for generating data string for google chart api
$data="t:";
$marker_data="|";

//variables for generating labels string for google chart api
$value_label="0:|";
$category_label="1:|";

//loop for calculating total volunteering hours
$hours=0;
while ($row2 = mysql_fetch_assoc($result2)) {
                $hours += $row2['totalhours'];
}

//loop for generating the complete data string for google chart api
while ($row = mysql_fetch_assoc($result)) {
		$data .= $row['totalhours'] . ",";
                $marker_data .= "0" . ",";
                $hourspct = round((($row['totalhours']/$hours)*100),0);
                $value_label .= $row['totalhours'] . "(".$hourspct."%)"."|";
                $category_label .= $row['onsite_offsite'] . "|";
}

$data = substr($data, 0, -1);
$marker_data = substr($marker_data, 0, -1);
$category_label = substr($category_label, 0, -1);

$data.= $marker_data;
$label= $value_label.$category_label;
?>

<img src="http://chart.apis.google.com/chart
?cht=bvg
&chtt=Volunteer+Hours+Donated-+<?php echo $hours;?>+Hrs
&chxt=x,x
&chd=<?php echo $data;?>
&chxl=<?php echo $label;?>
&chs=350x250
&chds=a
&chbh=a
&chco=FFFFFF
&chem=y;s=cm_repeat;ds=1;dp=all;d=glyphish_clock,0,10,V,16,6699FF,000000,2,hb
">
