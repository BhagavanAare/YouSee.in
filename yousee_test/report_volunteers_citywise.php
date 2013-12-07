<?php
//query for counting volunteer hours citywise
$query = "SELECT VILLAGE_TOWN,
         COUNT(donor_id) volunteers
         FROM(SELECT donor_id
                     FROM volunteering
                     GROUP BY donor_id)INFO
         LEFT OUTER JOIN donors USING (donor_id)
         GROUP BY VILLAGE_TOWN";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

//variables for generating data string for google chart api
$data="t:";
$marker_data="|";

//variables for generating labels string for google chart api
$value_label="0:|";
$category_label="1:|";

$total_volunteers=0;

//loop for generating the complete data string for google chart api
while ($row = mysql_fetch_assoc($result)) {
		$data .= $row['volunteers'] . ",";
                $marker_data .= "0" . ",";
                $value_label .= $row['volunteers'] . "|";
                $category_label .= $row['VILLAGE_TOWN'] . "|";
                $total_volunteers += $row['volunteers'];
}

$data = substr($data, 0, -1);
$marker_data = substr($marker_data, 0, -1);
$category_label = substr($category_label, 0, -1);

$data.= $marker_data;
$label= $value_label.$category_label;

?>

<img src="http://chart.apis.google.com/chart
?cht=bvg
&chtt=Total-+<?php echo $total_volunteers;?>+Volunteers
&chxt=x,x
&chd=<?php echo $data;?>
&chxl=<?php echo $label;?>
&chs=350x250
&chds=a
&chbh=a
&chco=FFFFFF
&chem=y;s=cm_repeat;ds=1;dp=all;d=glyphish_walk,0,10,V,16,FF6600,000000,2,hb
">
