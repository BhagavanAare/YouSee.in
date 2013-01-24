<!DOCTYPE html>
 <html>

 <head>
 <!-- link to css style sheet -->
 </head>

 <body>
 <!-- begin wrap contents of page  -->
 <div id="wrapper">
 <!-- page header -->
 <div id="header"></div>

 <!--menubar-->

 <!-- begin main page content -->
 <div id="content-main">
 
 <!-- begin left div content -->
 <div id="left">
 <!-- end left div content -->
 </div>
 
 <!-- begin right div content -->
 <div id="right"> 

<h3>NGO Registration</h3>
<form action="ngo_registration.php" method="post">
<table>
<tr>
<td>NGO Name</td>
<td><input type="text" name="ngoName"></td>
</tr>
<tr>
<td>Type</td>
<td><select name="ngoType">
<option value="sec25_company">Sec25 Company</option>
<option value="trust">Trust</option>
<option value="society">Society</option>
<option value="cosociety">Cooperative Society</option>
</select></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" name="address"></td>
</tr>
<tr>
<td>HeadQuarters City</td>
<td><input type="text" name="hqcity"></td>
</tr>
<tr>
<td>HeadQuarters State</td>
<td><input type="text" name="hqstate"></td>
</tr>
<tr>
<td>HeadQuarters Country</td>
<td><input type="text" name="hqcountry"></td>
</tr>
<tr>
<td>HeadQuarters Pincode</td>
<td><input type="text" name="hqpincode"></td>
</tr>
<tr>
<td>First name</td>
<td><input type="text" name="fname"></td>
</tr>
<tr>
<td>Last name</td>
<td><input type="text" name="lname"></td>
</tr>
<tr>
<td>Gender</td>
<td><input type="radio" name="gender" value="M">male<br />
<input type="radio" name="gender" value="F">Female<br />
</select></td>
</tr>

<tr>
<td>Designation</td>
<td><input type="text" name="designation"></td>
</tr>
<tr>
<td>Phone</td>
<td><input type="text" name="phone"></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" name="email"></td>
</tr>
<tr>
<td>Website</td>
<td><input type="text" name="website"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit"></td>
</tr>
</table>
</form>

<?php
if (isset($_POST['submit'])){

 //connect to database
 include("prod_conn.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");

 $sql = "INSERT INTO project_partners(name, type, hq_town_city, hq_state, hq_country, hq_pin_code, contact_first_name, contact_last_name, contact_person_gender, contact_person_designation, contact_person_phone, contact_person_email, website_url)
         VALUES ('$_POST[ngoName]', '$_POST[ngoType]', '$_POST[hqcity]', '$_POST[hqstate]', '$_POST[hqcountry]', '$_POST[hqpincode]', '$_POST[fname]', '$_POST[lname]', '$_POST[gender]', '$_POST[designation]', '$_POST[phone]', '$_POST[email]', '$_POST[website]')";

  if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error());
  }
}
?>

 <!-- end right div content -->
 </div>

 <!-- end main page content -->
 </div>

 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>







 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
