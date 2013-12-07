<?
//connect to database
include("connect_activity.php");

//query for retreving maximum number of equipments among departments
$query = "SELECT
          department,
          MAX(num_equipment) max_equipment
          FROM
          (SELECT
          department,
          COUNT(equipment) num_equipment
          FROM equipments
          WHERE equipment='Ventilator'
          GROUP BY department
          ORDER BY department)INFO";

//query for retreving departments
$query2 = "SELECT
          department,
          COUNT(equipment) num_equipment
          FROM equipments
          WHERE equipment='Ventilator'
          GROUP BY department
          ORDER BY department";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$result2 = mysql_query($query2);

//table title

echo "Status of Ventilators at Gandhi Hospital";

//assign max equipment for a department to number of columns in table
while ($row = mysql_fetch_assoc($result)) {
		$col_num = $row['max_equipment'];
}
//echo $col_num;

//loop thru the column headings limiting to max number of equipment
$i = 1;
echo "<table style='font-size:12px'>";
echo "<thead><tr><th bgcolor=\"CCCCFF\">S-No</th><th bgcolor=\"CCCCFF\">Department</th>";
while ($i <= $col_num){
echo "<th bgcolor=\"CCCCFF\">". $i . "</th>";
$i++;
}
echo "</thead></tr>";

//diplay each department name
$i = 1;
$sno = 1;
while ($row2 = mysql_fetch_assoc($result2)) {

// variable for coloring oddeven rows
$oddeven = $i & 1;
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}
echo "<tr bgcolor=\"$color\"><td>".$sno."</td><td>".$row2['department']."</td>";
$department = $row2['department'];
$i++;
$sno++;

//diplay equipment data for each department

//query for retreving equipment info
$query3 = "SELECT
          equipment_id,
          equipment,
          make,
          model,
          asset_number,
          amc_status,
          maintenance_status,
          status,
          department,
          usage_status
          FROM equipments
          WHERE equipment='Ventilator'
          ORDER BY status";
$result3 = mysql_query($query3);

while ($row3 = mysql_fetch_assoc($result3)) {
if ($department == $row3['department']) {
if ($row3['status']=='W'){$color = "00FF00";}
else {$color = "FF0000";}
echo "<td bgcolor=\"$color\"><img src=\"images/ventilator.jpg\" border=\"0\" /></td>";}
}
//end of diplay equipment data for each department

echo "</tr>";
}
//end of diplay each department name

echo "</table>";

?>