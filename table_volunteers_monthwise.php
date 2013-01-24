<?
//query for testing output
$query = "SELECT
         YEAR(FROM_DATE) year,
         MONTH(FROM_DATE) month_number,
         SUBSTR((MONTHNAME(FROM_DATE)),1,3) month_name,
         COUNT(DISTINCT DONOR_ID) volunteers
         FROM volunteering
         GROUP BY month_number
         ORDER BY year, month_number ASC";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

//loop thru the field names to print the correct headers
$i = 0;
echo "Report - Active Volunteers Monthwise.";
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
foreach ($rows as $data){echo "<td align=\"right\">".$data ."</td>";}
echo "</tr>";
$i++;
}

echo "</table>";

?>
