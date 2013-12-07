<?php require_once('login_auth.php');?>
<?php
if (isset($_POST['request_submit'])){

 //connect to database
 include_once("prod_conn.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
	$_POST['req_exp_date']=date("Y-m-d",strtotime($_POST['req_exp_date']));
	$partnerquery="SELECT partner_id,partner_email,contact_first_name,contact_last_name from project_partners WHERE user_id=".$_SESSION['SESS_USER_ID'];
	$partner=mysql_fetch_array(mysql_query($partnerquery));
	$insert_inkind = "INSERT INTO kind_donations(initiative_type,partner_id,item_id,units_type,request_quantity,request_city, request_address, request_date, request_expiry_date, transport,note)
			  VALUES ('0','$partner[partner_id]','$_POST[item]','$_POST[units_type]', '$_POST[request_quantity]', '$_POST[request_city]', '$_POST[request_address]', '".date("Y-m-d")."', '".date("Y-m-d",strtotime($_POST['req_exp_date']))."', '$_POST[transport]','$_POST[notes]')";
	$registration = mysql_query($insert_inkind);
	$subid=mysql_insert_id();
	$update=mysql_query("UPDATE kind_donations set sub_id=$subid WHERE donation_id=$subid");

	$item=mysql_fetch_array(mysql_query("SELECT donationitem,note,category from items INNER JOIN item_category on items.category_id=item_category.category_id INNER JOIN kind_donations ON items.item_id=kind_donations.item_id  WHERE kind_donations.donation_id=$subid"));

?>
<?php $thispage = "req_inkind_exec";
if (!$_SESSION['SESS_USER_TYPE']=="N")
{
	header("Location: login_failed");
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
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->

<table style="margin-bottom:40px;">
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<?php include "ngo_uc_tabs.php"; ?>
</div>
</td>
<td>
<h3 align="center">You have successfully made the request.</h3>
<?php
 $table="
  <table style='border-collapse:collapse' border='1'>
  <tr>
  <th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Request Details</th>
  </tr>
  <tr>
  <td>Category</td>
  <td>" . $item['category'] . "</td>
  </tr>
  <tr>
  <td>Item </td>
  <td>" . $item['donationitem'] . "</td>
  </tr>
  <tr>
  <td>Purpose </td>
  <td>" . $item['note'] . "</td>
  </tr>
  <tr>
  <td>Request Quantity</td>
  <td>" . $_POST['request_quantity']." ". $_POST['units_type'] . "</td>
  </tr>

  <tr>
  <td>Request Location</td>
  <td>" . $_POST['request_address'] . "</td>
  </tr>

  <tr>
  <td>Request Expiry Date</td>
  <td>" . date("d-M-y",strtotime($_POST['req_exp_date'])) . "</td>
  </tr>
  </table>";
 echo $table;
  include "Email/sendemail.php";
	$params=
	array(
	$email=$partner['partner_email'],
	$subject="Ackowledgement - Donation request submission",
	$displayname=$partner['contact_first_name']." ".$partner['contact_last_name'],
	$mailtext="We acknowledge the following In-Kind Donation request made on UC site www.yousee.in. You will receive a confirmation email once this request has been activated on UC site.You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table,
	);
	call_user_func_array('sendEmail',$params);
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
<?php } ?>


<?php
if (isset($_POST['offer_submit'])){

 //connect to database
 include_once("prod_conn.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
	$donorquery="SELECT donor_id,displayname,preferred_email from donors WHERE user_id=".$_SESSION['SESS_USER_ID'];
	$donor=mysql_fetch_array(mysql_query($donorquery));
	$insert_inkind = "INSERT INTO kind_donations(initiative_type,donor_id,item_id,units_type,offer_quantity,offer_city,offer_address,offer_date,offer_expiry_date, transport,note)
			  VALUES ('1','$donor[donor_id]','$_POST[item]','$_POST[units_type]', '$_POST[offer_quantity]', '$_POST[offer_city]', '$_POST[offer_address]','".date("Y-m-d")."' , '".date("Y-m-d",strtotime($_POST['offer_exp_date']))."', '$_POST[transport]','$_POST[notes]')";
	
	$registration = mysql_query($insert_inkind);
	
	$subid=mysql_insert_id();
	$update=mysql_query("UPDATE kind_donations set sub_id=$subid WHERE donation_id=$subid");
		$item=mysql_fetch_array(mysql_query("SELECT donationitem,category,note from items INNER JOIN item_category on items.category_id=item_category.category_id INNER JOIN kind_donations ON items.item_id=kind_donations.item_id WHERE kind_donations.donation_id=$subid"));



?>
<?php $thispage = "offer_inkind_exec";
if (!$_SESSION['SESS_USER_TYPE']=="D")
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

<table style="margin-bottom:40px;">
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<?php include "myucTabs.php"; ?>
</div>
</td>
<td>
<h3 align="center">You have successfully made the offer.</h3>
<?php
  $table="
  <table style='border-collapse:collapse' border='1' >
  <tr>
  <th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Offer Details</th>
  </tr>

  <tr>
  <td>Category</td>
  <td>" . $item['category'] . "</td>
  </tr>
  <tr>
  <td>Item</td>
  <td>" . $item['donationitem'] . "</td>
  </tr>
  <tr>
  <td>Purpose</td>
  <td>" . $item['note'] . "</td>
  </tr>
  <tr>
  <td>Offer Quantity</td>
  <td>" . $_POST['offer_quantity']." ". $_POST['units_type'] . "</td>
  </tr> 

  <tr>
  <td>Offer City</td>
  <td>" . $_POST['offer_city'] . "</td>
  </tr>
 
  <tr>
  <td>Offer Address</td>
  <td>" . $_POST['offer_address'] . "</td>
  </tr> 

  <tr>
  <td>Offer Expiry Date</td>
  <td>" . date("d-M-y",strtotime($_POST['offer_exp_date'])) . "</td>
  </tr>

  </table>";
 echo $table;
 include "Email/sendemail.php";
	$params=
	array(
	$email=$donor['preferred_email'],
	$subject="Ackowledgement - Donation offer submission",
	$displayname=$donor['displayname'],
	$mailtext="We acknowledge the following In-Kind Donation offer made on UC site www.yousee.in. You will receive a confirmation email once this offer has been activated on UC site.You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table,
	);
	call_user_func_array('sendEmail',$params);
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
<?php } 
/*
02July2013 - Vivek - Change of name in email from partner name to contact person name and some typo corrections.
*/
?>

