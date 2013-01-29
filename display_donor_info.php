<?php

include("prod_conn.php");

// this section generates query for donor info
$query = "SELECT username
          FROM users
          WHERE user_id=".$_SESSION['SESS_USER_ID'];
//echo "\n".$_SESSION['SESS_USER_ID'];
//echo $query;
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);


//Display donor info
while ($row = mysql_fetch_assoc($result)) { echo $row['username'];}

?>

