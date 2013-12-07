<?php
//query for selecting all donated assets
$query = "SELECT * FROM interns";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

//display output table
include ("display_table.php");
?>

