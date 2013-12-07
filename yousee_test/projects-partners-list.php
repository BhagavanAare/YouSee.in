<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

if ( isset($_REQUEST['sort']) )
{ $selection = $_REQUEST['sort']; }

else
{ $selection = "area"; }

if ( $selection == "area" )
{
$query = "SELECT AREA, TOWN_CITY, NAME, DESCRIPTION
FROM PROJECT_CERTIFICATES JOIN PROJECT_PARTNERS USING (PARTNER_ID)
ORDER BY AREA";

$result = mysql_query($query);
echo "<table border='1'><tr><th>Area</th><th>Town-City</th><th>Partner-Organisation</th><th>Project-Description</th></tr>";
while ($row = mysql_fetch_assoc($result)) {
                echo "<tr><td>" . $row['AREA'] . "</td><td>" . $row['TOWN_CITY'] . "</td><td>" . $row['NAME'] . "</td><td>". $row['DESCRIPTION'] . "</td></tr>";}
echo "</table>";
}
else
{
$query = "SELECT AREA, TOWN_CITY, NAME, DESCRIPTION
FROM PROJECT_CERTIFICATES JOIN PROJECT_PARTNERS USING (PARTNER_ID)
ORDER BY TOWN_CITY";

$result = mysql_query($query);
echo "<table border='1'><tr><th>Area</th><th>Town-City</th><th>Partner-Organisation</th><th>Project-Description</th></tr>";
while ($row = mysql_fetch_assoc($result)) {
                echo "<tr><td>" . $row['AREA'] . "</td><td>" . $row['TOWN_CITY'] . "</td><td>" . $row['NAME'] . "</td><td>". $row['DESCRIPTION'] . "</td></tr>";}
echo "</table>";
}
?>

