<?php
//query for testing output
$query = "SELECT asset_id, type, make, model, id_or_serial_number, donation_type, donated_by, donation_date, distribution_date, receiving_organisation
          FROM assets
          WHERE donation_type='Kind Donation'";
		 
//connect to host
include("prod_conn.php");
$con = mysql_connect("$dbhost","$dbuser","$dbpass");
if(!$con){
die("Cannot connect:" . mysql_error());
}
else{
echo "Connection Sucessful";
echo"<br>";
}

//connect to database
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

if(!$result){
die("Query Unsucessful:" . mysql_error());
}
else{
echo "Query Sucessful";
}

//display output table
include ("display_table.php");
?>
