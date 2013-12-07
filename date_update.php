<?php
session_start();
if(isset($_SESSION['SESS_USER_ID']))
{
include("prod_conn.php");

// this section generates query for donor info
$query = "SELECT *
          FROM users
          WHERE user_id=".$_SESSION['SESS_USER_ID'];

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
//Display donor info
while($row = mysql_fetch_assoc($result)) { 
$replace_date="UPDATE users SET past_login_time='$row[present_login_time]', past_login_date='$row[present_login_date]'
			WHERE user_id='$_SESSION[SESS_USER_ID]'";
$replace = mysql_query($replace_date);}

date_default_timezone_set('Asia/Kolkata');
$date=date('y-m-d'); 
$time=date('H:i:s');

			$update_users = "UPDATE users SET present_login_time='$time', present_login_date='$date'
			WHERE user_id='$_SESSION[SESS_USER_ID]'";
			$update = mysql_query($update_users);

header("location:redirect.php");
exit();
}
else
{
header("location: login-failed.php");
			exit();
}

?>
