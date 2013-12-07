<?php
//query for selecting all donated assets
$query = "SELECT asset_id, type, make, model, id_or_serial_number, donation_type, donated_by, donation_date, distribution_date, receiving_organisation
          FROM assets
          WHERE donation_type='Kind Donation'";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

//display output table
include ("display_table.php");
?>

