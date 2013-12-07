<?php

include("prod_conn.php");

//query for selecting all Donation Camps 
$query = "SELECT place_type, city, location, organisation, donation_date, donation_time, address
		  FROM places
          WHERE place_type='Donation Camp'
		  ORDER BY place_type, city";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

 //loop thru the field names to print the correct headers
$i = 0;
echo "<table style='font-size:12px'>";
echo "<thead><tr>";
while ($i < mysql_num_fields($result)){
echo "<th bgcolor=\"CCCCFF\">". mysql_field_name($result, $i) . "</th>";
$i++;
}
echo "</thead></tr>";

//display the data
$i = 1;
while ($rows = mysql_fetch_array($result,MYSQL_ASSOC)){
// variable for coloring oddeven rows
$oddeven = $i & 1;
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}

echo "<tr bgcolor=\"$color\">";
foreach ($rows as $data){echo "<td align=\"left\">".$data ."</td>";}
echo "</tr>";
$i++;
}

echo "</table>";

?>

