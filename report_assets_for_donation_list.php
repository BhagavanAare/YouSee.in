<?
//query for selecting all donated assets
$query = "SELECT asset_id, type, make, model, donation_type, donor_city, donor_location, donor_preference, item_image
          FROM assets
          WHERE available='Y'";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$rows = mysql_num_rows($result);

$sno = 1;
//Table heading declaration
echo "<table width=\"100%\" style='font-size:12px'><tr bgcolor=\"CCCCFF\"><th width=\"3%\">S-No</th><th width=\"7%\">Type</th><th width=\"10%\">Make</th><th width=\"10%\">Model</th><th width=\"12%\">Donation Type</th><th width=\"12%\">Donor City</th><th width=\"12%\">Donor Location</th><th width=\"12%\">Donor Preference</th><th width=\"22%\" >Image</th></tr>";
while ($row = mysql_fetch_assoc($result)) {

// variable for coloring oddeven rows
$oddeven = $sno & 1;
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}

//following section post values into a table
echo "<tr bgcolor=\"$color\" style='font-size:12px' ><td>" . $sno . "</td><td>" . $row['type'] . "</td><td>" . $row['make'] . "</td><td>" . $row['model'] . "</td><td>" . $row['donation_type'] .  "</td><td>". $row['donor_city'] . "</td><td>" . $row['donor_location'] . "</td><td>" . $row['donor_preference'] . "</td><td align=\"center\"><img src=\"" . $row['item_image'] . "\" /></td></tr>";

$sno++; }
echo "</table><br>";

?>

