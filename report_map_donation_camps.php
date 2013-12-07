<?php
//query for selecting all Children Homes at Hyderabad
$city = "Hyderabad";
$query = "SELECT city, location, organisation, donation_date, donation_time, address, latitude, longitude
		  FROM places
          WHERE place_type='Compost Center' AND place_type='Donation Camp'";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$rows = mysql_num_rows($result);

//dispaly as a table the map pointers data
include 'display_table.php';
?>

