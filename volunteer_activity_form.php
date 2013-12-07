<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
?>

<html>
<head>
<title>UC Volunteering Activities</title>
</head>
<body>

<?php
if (isset($_REQUEST['Submit'])) {
//this section inserts user data into table
$sql = "INSERT INTO VOLUNTEERING(DONOR_ID, FROM_DATE, TO_DATE, FROM_TIME, TO_TIME, HOURS, DONATION_TYPE, AREA, ACTIVITY_DONE, ONSITE_OFFSITE, LOCATION, NOTES) VALUES
('".mysql_real_escape_string(stripslashes($_REQUEST['DONOR_ID'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['FROM_DATE'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['TO_DATE'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['FROM_TIME'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['TO_TIME'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['HOURS'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['DONATION_TYPE'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['AREA'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['ACTIVITY_DONE'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['ONSITE_OFFSITE'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['LOCATION'])).
"','".mysql_real_escape_string(stripslashes($_REQUEST['NOTES']))."')";

if($result = mysql_query($sql)) {
echo '<h3>Thank you</h3>The record has been updated. Thank You!<br>';
} else {
echo "ERROR: ".mysql_error();
}
} else {
?>
<h3>Post a new volunteering activity contribution</h3>

<!-- user input form -->
<form method="post" action="">
Volunteer(Donor):<input type="text" name="DONOR_ID"><br><br>
From Date:<input type="text" name="FROM_DATE"><br><br>
To Date:<input type="text" name="TO_DATE"><br><br>
From Time:<input type="text" name="FROM_TIME"><br><br>
To Time:<input type="text" name="TO_TIME"><br><br>
Hours Volunteered:<input type="text" name="HOURS"><br><br>
Donation Type:<br>
<input type="radio" name="DONATION_TYPE" value="ShramDaan" /> ShramDaan<br />
<input type="radio" name="DONATION_TYPE" value="GyanDaan" /> GyanDaan<br />
<input type="radio" name="DONATION_TYPE" value="Both" /> Both
<br><br>
Volunteering Area:<input type="text" name="AREA"><br><br>
Activity Undertaken:<input type="text" name="ACTIVITY_DONE"><br><br>
Activity Location: <br>
<input type="radio" name="ONSITE_OFFSITE" value="Onsite" /> Onsite<br />
<input type="radio" name="ONSITE_OFFSITE" value="Offsite" /> Offsite
<br><br>
Location:<input type="text" name="LOCATION"><br><br>
Notes:<input type="text" name="NOTES"><br><br>

<input type="submit" name="Submit" value="Submit">
</form>

<?php
}
?>
</body>
</html>

