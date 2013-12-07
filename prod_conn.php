<?php

//DB host
$dbhost = "localhost";

//Username with privileges to connect to database for querying purpose
$dbuser = "guna";

//Password of the above user account
$dbpass = "guna";

//Database which will be selected before performing any insertion, updation or deletion
$dbdatabase = "ucdblive";

$connectDB = mysql_connect("$dbhost", "$dbuser", "$dbpass");
	if (!$connectDB) {
		echo "ERROR: Couldn't Connect";
	} 
	mysql_select_db("$dbdatabase", $connectDB);
?>