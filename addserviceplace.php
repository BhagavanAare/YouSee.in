<?php $thispage = "myuc"; 
 $activetab="serviceplaceTab";	 
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
 
</head>

<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">

<table>
<tr>
<td valign="top">
<?php include 'adminUcTabs.php'; ?>
</td>
<td>
<form name="addserviceplace" method="POST" action="addserviceplace.php">
	<table id="table-search">
		<th>Add a service place</th>
		<tr><td><select name="place_category_id">
		<option value="">Select</option>
			<?php
			include "prod_conn.php";
			$query="SELECT place_category_id,place_category from place_category";
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result)){
			echo "<option value='$row[place_category_id]'>$row[place_category]</option>";
		}
		?>
		</select></td></tr>
		<tr><td><input type="text" name="place_title" placeholder="place title" required /></td></tr>
		<tr><td><textarea name="place_description" placeholder="place description" required></textarea></td></tr>
		<tr><td><input type="text" name="address" placeholder="Address" required /></td></tr>
		<tr><td><input type="text" name="location" placeholder="Location" required /></td></tr>
		<tr><td><input type="text" name="city" placeholder="City" required /></td></tr>
		<tr><td><input type="text" name="latitude" placeholder="Latitude" required /></td></tr>
		<tr><td><input type="text" name="longitude" placeholder="Longitude" required /></td></tr>
		<tr><td><select name="partner_id">
		<option value="">Select</option>
		<?php 
		$query="SELECT partner_id,name from project_partners JOIN users ON project_partners.user_id = users.user_id WHERE registration_status='A' ORDER BY name ASC";
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result)){
			echo "<option value='$row[partner_id]'>$row[name]</option>";
		}
		?>
		</select></td></tr>
		<tr><td><input type="text" name="contact_person" placeholder="Contact name" required /></td></tr>
		<tr><td><input type="text" name="contact_no" placeholder="Contact Number" required /></td></tr>
		<tr><td><input type="text" name="contact_email" placeholder="Contact Email" required /></td></tr>
		<tr><td><input type="submit" name="addplace" value="Submit" /></td></tr>
	</table>
</form>
</td>
</tr>
</table>
<?php
if(isset($_POST['addplace'])){
	$query="INSERT INTO places (place_category_id,place_title,place_description,address,location,city,latitude,longitude,partner_id,contact_person,contact_no,contact_email)
	VALUES ('$_POST[place_category_id]','$_POST[place_title]','$_POST[place_description]','$_POST[address]','$_POST[location]','$_POST[city]','$_POST[latitude]','$_POST[longitude]','$_POST[partner_id]','$_POST[contact_person]','$_POST[contact_no]','$_POST[contact_email]')";
	if(mysql_query($query)){
		echo "<h1>Service place added!</h1>";
	}
	else {
		echo "Error in adding,please try again";
	}
}
?>
</div>
<?php include 'footer.php' ; ?>
</div>
</body>
</html>

