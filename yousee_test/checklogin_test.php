<?php

// Connect to server and select databse.
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase")or die("cannot select DB");

// username and password sent from form
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$query="SELECT * FROM users WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($query);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
//fetch donor id
while ($row = mysql_fetch_assoc($result)){ $donor_id=$row['donor_id'];}

if($donor_id==0){
// Register $myusername, $mypassword and redirect to data entry file "login_success.php"
session_register("myusername");
session_register("mypassword");
header("location:login_success.php"); }
else {
//direct to donor login page
session_register("myusername");
session_register("mypassword");
$_SESSION['myusername'] = $_POST['myusername'];
header("location:myuc.php"); }
}

else {
echo "Wrong Username or Password";
}
?>