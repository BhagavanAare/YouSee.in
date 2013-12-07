<h3 style="padding-left:0px;">Donation Camps List</h3>
<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query = "SELECT location, organisation,places.partner_id,donation_date, donation_time, places.address
          FROM places
          JOIN place_category ON places.place_category_id = place_category.place_category_id
          LEFT JOIN project_partners ON places.partner_id = project_partners.partner_id
          WHERE place_category='Donation Camp' AND LOWER(places.city)=LOWER('".$city."')";
$execute=mysql_query($query);
if(mysql_num_rows($execute)!= 0) 
{
	echo "<table style=\"margin-bottom:20px;\" id=\"table-search\">";
	echo "<thead>";
	echo "<tr><th rowspan=\"2\">S.No.</th>"; echo"<th>Location</th>";echo"<th>Organisation</th>";echo "<th>Donation Date</th>";echo "<th>Donation Time </th>";echo "<th>Address</th>";echo "</tr>"; 
	echo "</thead>";
	echo "<tbody>";
	$i=1;
	while ($record = mysql_fetch_array($execute))
	{
		echo "<tr class=\"rows\" id=\"$i\">";
				echo "<td>" . $i . "</td>";
				echo "<td>" . $record['location'] . "</td>";
				echo "<td>" . $record['organisation'] . "</td>";
				echo "<td>" . $record['donation_date'] . "</td>";
				echo "<td>" . $record['donation_time'] . "</td>";
				echo "<td>" . $record['address'] . "</td>";
				$i++;
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}
else{
echo"No Periodic Donation Camps in the City";}
?>
<h3 style="padding-left:0px;">Compost Centers List</h3>
<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query1 =  "SELECT location, organisation, places.partner_id
           FROM places
           JOIN place_category ON places.place_category_id = place_category.place_category_id
          LEFT JOIN project_partners ON places.partner_id = project_partners.partner_id
          WHERE LOWER(city)=LOWER('".$city."') AND place_category='Compost Center'";
$execute1=mysql_query($query1);
if(mysql_num_rows($execute1)!= 0) 
{
	echo "<table style=\"margin-bottom:20px;\" id=\"table-search\">";
	echo "<thead>";
	echo "<tr><th rowspan=\"2\">S.No.</th>"; echo"<th>Location</th>";echo"<th>Organisation</th>";echo "</tr>"; 
	echo "</thead>";
	echo "<tbody>";
	$i=1;
	while ($record1 = mysql_fetch_array($execute1))
	{
		echo "<tr class=\"rows\" id=\"$i\">";
				echo "<td>" . $i . "</td>";
				echo "<td>" . $record1['location'] . "</td>";
				echo "<td>" . $record1['organisation'] . "</td>";
				$i++;
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
}
else{
echo"No Data of Compost Centers ";}
?>



