<?php require_once('login_auth.php');?>
<?php
if (isset($_POST['submit'])){

 //connect to database
 include_once("prod_conn.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
	$partnerquery="SELECT partner_id from project_partners WHERE user_id=".$_SESSION['SESS_USER_ID'];
	$partner=mysql_fetch_array(mysql_query($partnerquery));
	$insert_inkind = "INSERT INTO kind_donations(initiative_type,partner_id,item_id,units_type,unit_quantity,request_quantity,request_city,request_address,request_expiry_date, transport)
			  VALUES ('0','$partner[partner_id]','$_POST[item]','$_POST[units_type]','$_POST[unit_quantity]', '$_POST[request_quantity]', '$_POST[request_city]', '$_POST[request_address]', '$_POST[req_exp_date]', '$_POST[transport]')";
	
	$registration = mysql_query($insert_inkind);
}

?>
<?php $thispage = "req_inkind_exec";
if (!$_SESSION['SESS_USER_TYPE']=="N")
{
	header(header("Location: login_failed"));
}
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
  <link rel="stylesheet" type="text/css" href="test/test.css">
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->
<script src="scripts/tabscripts.js"></script>


<table style="margin-bottom:40px;">
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<ul  class="tree" >  
	<li class="tree">
		<label for="folder1" class="menu_first">+ Donations Received</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>
			<li class="tabLink"><a class="file" id="summaryTab">Summary</a></li>					
			<li class="tabLink"><a class="file" id="volunteerHoursTab" onclick="showTab('ngoTabs','volunteerHoursTab')" >Volunteering </a></li>					
			<li class="tabLink"><a class="file" id="inKindTab">In Kind</a></li>					
			<li class="tabLink"><a class="file" id="financialTab" onclick="showTab('ngoTabs','financialTab')" >Financial </a></li> 

			
		</ul>
	</li>
	<li class="tree">
		<label for="folder1" class="menu_first"> Make Requests</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>
			
			<li><a href="req_volunteering.php" class="file" id="volunteerReqTab">Volunteering </a></li>					
			<li class="tabLink"><a class="file" id="inKindReqTab">In Kind Donations </a></li> 

			
		</ul>
	</li>
	<li class="tree">
		<label for="folder1" class="menu_first">> Update</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>
			<li class="tabLink"><a  class="file" id="orgTabTab">Org Info</a></li>					
			<li class="tabLink"><a  class="file" id="settingsTab">Settings</a></li>					

			
		</ul>
	</li>
</ul>
</div>
</td>
<td>
<h3 align="center">You have successfully made the request.</h3>
<?php
 echo "<table><tr><td>";
 echo "<table border=\"1\" >";
 echo "<tr>";
 echo "<th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Request Details</th>";
 echo "</tr>";

 echo "<tr>";
 echo "<td>Category Id</td>";
 echo "<td>" . $_POST['category'] . "</td>";
 echo "</tr>";

 echo "<tr>";
 echo "<tr>";
 echo "<td>Item Id</td>";
 echo "<td>" . $_POST['item'] . "</td>";
 echo "</tr>";

 echo "<tr>";
 echo "<tr>";
 echo "<td>Units Type</td>";
 echo "<td>" . $_POST['units_type'] . "</td>";
 echo "</tr>";

 echo "<tr>";
 echo "<td>Additional Unit Info</td>";
 echo "<td>" . $_POST['unit_quantity'] . "</td>";
 echo "</tr>";

 echo "<tr>";
 echo "<td>Request Quantity</td>";
 echo "<td>" . $_POST['request_quantity'] . "</td>";
 echo "</tr>"; 

 echo "<tr>";
 echo "<td>Request Location</td>";
 echo "<td>" . $_POST['request_location'] . "</td>";
 echo "</tr>"; 

 echo "<tr>";
 echo "<td>Request Expiry Date</td>";
 echo "<td>" . $_POST['req_exp_date'] . "</td>";
 echo "</tr>"; 

 echo "</table>";
 echo "</table>";
?>
</td>
</tr>
</table>
<!--footer-->

<?php include 'footer.php' ; ?>
</div>

<!--wrapper end-->

 </BODY>
</HTML>


