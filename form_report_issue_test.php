<html>
<head>
<title>Report Issue</title>
</head>
<body>
<?php
if(isset($_POST['add']))
{
include("connect_activity.php");
$conn = mysql_connect("$dbhost","$dbuser","$dbpass");

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

if(! get_magic_quotes_gpc() )
{
   $call_type = addslashes ($_POST['call_type']);
   $call_date = addslashes ($_POST['call_date']);
   $call_time = addslashes ($_POST['call_time']);
   $caller_gender = addslashes ($_POST['caller_gender']);
   $caller_name = addslashes ($_POST['caller_name']);
   $caller_number = addslashes ($_POST['caller_number']);
   $call_receiver = addslashes ($_POST['call_receiver']);
   $hospital_id = addslashes ($_POST['hospital_id']);
   $department = addslashes ($_POST['department']);
   $call_information = addslashes ($_POST['call_information']);
   $asset_number = addslashes ($_POST['asset_number']);
   $equipment_location = addslashes ($_POST['equipment_location']);
   $equipment_problem = addslashes ($_POST['equipment_problem']);
}
else
{
   $call_type = $_POST['call_type'];
   $call_date = $_POST['call_date'];
   $call_time = $_POST['call_time'];
   $caller_gender = $_POST['caller_gender'];
   $caller_name = $_POST['caller_name'];
   $caller_number = $_POST['caller_number'];
   $call_receiver = $_POST['call_receiver'];
   $hospital_id = $_POST['hospital_id'];
   $department = $_POST['department'];
   $call_information = $_POST['call_information'];
   $asset_number = $_POST['asset_number'];
   $equipment_location = $_POST['equipment_location'];
   $equipment_problem = $_POST['equipment_problem'];
}

$query = "INSERT INTO service_records ".
       "(call_type, call_date, call_time, caller_gender, caller_name, caller_number, call_receiver, hospital_id, department, call_information, asset_number, equipment_location, equipment_problem) ".
       "VALUES('$call_type', $call_date, $call_time,'$caller_gender', '$caller_name', $caller_number, '$call_receiver', '$hospital_id', '$department', '$call_information', '$asset_number', '$equipment_location', '$equipment_problem')";
mysql_select_db("$dbdatabase");
$retval = mysql_query( $query, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysql_close($conn);
}
else
{
?>
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
<tr><td width="200">Call Type</td>
<td><input name="call_type" type="text" id="call_type"></td>
</tr>
<tr><td width="200">Call Date</td>
<td><input name="call_date" type="text" id="call_date"></td>
</tr>
<tr><td width="200">Call Time</td>
<td><input name="call_time" type="text" id="call_time"></td>
</tr>
<tr><td width="200">Caller Gender</td>
<td><input name="caller_gender" type="text" id="caller_gender"></td>
</tr>
<tr><td width="200">Caller Name</td>
<td><input name="caller_name" type="text" id="caller_name"></td>
</tr>
<tr><td width="200">Caller Number</td>
<td><input name="caller_number" type="text" id="caller_number"></td>
</tr>
<tr><td width="200">Call Receiver</td>
<td><input name="call_receiver" type="text" id="call_receiver"></td>
</tr>
<tr><td width="200">Hospital ID</td>
<td><input name="hospital_id" type="text" id="hospital_id"></td>
</tr>
<tr><td width="200">Department</td>
<td><input name="department" type="text" id="department"></td>
</tr>
<tr><td width="200">Call Information</td>
<td><input name="call_information" type="text" id="call_information"></td>
</tr>
<tr><td width="200">Equipment Number</td>
<td><input name="asset_number" type="text" id="asset_number"></td>
</tr>
<tr><td width="200">Equipment Location</td>
<td><input name="equipment_location" type="text" id="equipment_location"></td>
</tr>
<tr><td width="200">Equipment Problem</td>
<td><input name="equipment_problem" type="text" id="equipment_problem"></td>
</tr>
<tr><td width="200"> </td>
<td> </td>
</tr>
<tr><td width="200"> </td>
<td><input name="add" type="submit" id="add" value="Submit"></td>
</tr>
</table>
</form>
<?php
}
?>
</body>
</html>