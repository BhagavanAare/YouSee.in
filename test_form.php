<?php
include("connect_activity.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
?>


<html>
<head>
<title>UC Volunteering Activities</title>
</head>
<body>
<div>
<table border=1>
<?php
//code of selection of equipment
$query4 = "SELECT * FROM users";

$result4 = mysql_query($query4);
while($row4 = mysql_fetch_array($result4)){
  echo "<tr><td>".$row4['username']."</td><td>".$row4['password']."</td></tr>";
}
?>
</table>
<div>
<?php
if (isset($_REQUEST['Submit'])) {
# THIS CODE TELL MYSQL TO INSERT THE DATA FROM THE FORM INTO YOUR MYSQL TABLE
$sql = "INSERT INTO activity(activity_code,activity) VALUES ('".mysql_real_escape_string(stripslashes($_REQUEST['activity_id']))."','".mysql_real_escape_string(stripslashes($_REQUEST['activity_brief']))."')";

if($result = mysql_query($sql)) {
echo '<h3>Thank you</h3>Your information has been entered into our database<br>';
} else {
echo "ERROR: ".mysql_error();
}
} else {
?>
<h3>Post a new volunteering activity </h3>
<form method="post" action="">
Activity Code:<br>
<input type="text" name="activity_id">
<br>
Activity: <br>
<input type="text" name="activity_brief">
<br><br>
<input type="submit" name="Submit" value="Submit">
</form>
<?php
} 
?>
</body>
</html>

