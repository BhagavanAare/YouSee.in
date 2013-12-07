<?php require_once('login_auth.php');?>
<?php 
$activetab="inkindCommitmentsTab";
$thispage ="adminhomescreen";
if (!($_SESSION['SESS_USER_TYPE']=='A'))
{
	header("location: login_access_denied.php");
	exit();
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/div.css">
<link rel="stylesheet" type="text/css" href="test/test.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">
<link rel="stylesheet" type="text/css" href="css/inkind_items.css">

<?php
include('prod_conn.php');
$link = mysql_connect("$dbhost","$dbuser","$dbpass");
if(!$link) {
	die('Failed to connect to server: ' . mysql_error());
	}
//Select database
$db = mysql_select_db("$dbdatabase");
if(!$db) {
	die("Unable to select database");
}
if(isset($_POST['id'])){
	$query=mysql_query("SELECT * from kind_donations LEFT OUTER JOIN project_partners on kind_donations.partner_id=project_partners.partner_id LEFT OUTER JOIN donors on kind_donations.donor_id=donors.donor_id JOIN items ON kind_donations.item_id=items.item_id JOIN item_category ON items.category_id=item_category.category_id WHERE donation_id=".$_POST['id']);
	$result=mysql_fetch_array($query);
}
if(isset($_POST['activate_request'])){
	mysql_query("UPDATE kind_donations SET status='Open' WHERE donation_id=".$_POST['id']);
	$table="
  <table style='padding:5px;margin:5px;border-collapse:collapse' border='1'>
  <tr>
  <th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Request Details</th>
  </tr>
  <tr>
  <td>Category</td>
  <td>" . $result['category'] . "</td>
  </tr>
  <tr>
  <td>Item </td>
  <td>" . $result['donationitem'] . "</td>
  </tr>
  <tr>
  <td> Purpose  </td>
  <td>" . $result['note'] . "</td>
  </tr>
  <tr>
  <td>Request Quantity</td>
  <td>" . $result['request_quantity']." ". $result['units_type'] . "</td>
  </tr>

  <tr>
  <td>Request Location</td>
  <td>" . $result['request_address'] . "</td>
  </tr>

  <tr>
  <td>Request Expiry Date</td>
  <td>" . date("d-M-y",strtotime($result['request_expiry_date'])) . "</td>
  </tr>
  </table>";
  include "Email/sendemail.php";
	$params=
	array(
	$email=$result['partner_email'],
	$subject="Ackowledgement - Donation request posted",
	$displayname=$result['contact_first_name']." ".$result['contact_last_name'],
	$mailtext="This is to inform you that the following In-kind donation request made on <a href='www.yousee.in'>YouSee</a> has been activated and is now available for donors to commit.You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table,
	);
	call_user_func_array('sendEmail',$params);
}
if(isset($_POST['stall_request'])){
	mysql_query("UPDATE kind_donations SET status='Stalled' WHERE donation_id=".$_POST['id']);
}
if(isset($_POST['activate_offer'])){
	mysql_query("UPDATE kind_donations SET status='Open' WHERE donation_id=".$_POST['id']);
	$table="
  <table style='padding:5px;margin:5px;border-collapse:collapse' border='1'>
  <tr>
  <th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Offer Details</th>
  </tr>
  <tr>
  <td>Category</td>
  <td>" . $result['category'] . "</td>
  </tr>
  <tr>
  <td>Item </td>
  <td>" . $result['donationitem'] . "</td>
  </tr>
  <tr>
  <td>Purpose </td>
  <td>" . $result['note'] . "</td>
  </tr>
  <tr>
  <td>Offer Quantity</td>
  <td>" . $result['offer_quantity']  ." ". $result['units_type'] . "</td>
  </tr>

  <tr>
  <td>Offer Location</td>
  <td>" . $result['offer_address'] . "</td>
  </tr>

  <tr>
  <td>Offer Expiry Date</td>
  <td>" . date("d-M-y",strtotime($result['offer_expiry_date'])) . "</td>
  </tr>
  </table>";
  include "Email/sendemail.php";
	$params=
	array(
	$email=$result['preferred_email'],
	$subject="Ackowledgement - Donation offer posted",
	$displayname=$result['displayname'],
	$mailtext="This is to inform you that the following In-kind donation offer made on <a href='www.yousee.in'>YouSee</a> has been activated and is now available for NPO's to make a request.You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table,
	);
	call_user_func_array('sendEmail',$params);
}
if(isset($_POST['stall_offer'])){
	mysql_query("UPDATE kind_donations SET status='Stalled' WHERE donation_id=".$_POST['id']);
}
if(isset($_POST['deliver'])){
	$ddate=date('Y-m-d',strtotime($_POST['delivery_date']));
	if(mysql_query("UPDATE kind_donations SET status='Delivered',delivery_date='$ddate',offer_quantity=$_POST[quantity] WHERE donation_id=".$_POST['id'])){
	$table="
	  <table style='padding:5px;margin:5px;border-collapse:collapse' border='1'>
	  <tr>
	  <th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Donation Details</th>
	  </tr>
	  <tr>
	  <td>Item </td>
	  <td>" . $result['donationitem'] . "</td>
	  </tr>
	  <tr>
	  <td> Purpose  </td>
	  <td>" . $result['note'] . "</td>
	  </tr>
	  <tr>
	  <td>Delivered Quantity</td>
	  <td>" . $_POST['quantity']." ". $result['units_type'] . "</td>
	  </tr>
	  <tr>
	  <td>Recipient</td>
	  <td>" . $result['name']."</td>
	  </tr>
	  <tr>
	  <td>Delivery Date</td>
	  <td>" . date("d-M-y",strtotime($ddate)) . "</td>
	  </tr>
	  </table>";
	 include "Email/sendemail.php";
	$params=
	array(
	$email=$result['preferred_email'],
	$subject="Thank you for the donation",
	$displayname=$result['displayname'],
	$mailtext="We would like to thank you for the In-kind donation made through <a href='www.yousee.in'>YouSee</a> .You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table,
	$ngoemail=$result['partner_email']
	);
	call_user_func_array('sendEmail',$params);
	}
}
?>
<script src="scripts/tabscripts.js"></script> 
<script src="scripts/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$("#pending_requests_button").click(function(){
		$("#pending_requests").show();
		$("#pending_offers").hide();
		$("#connected").hide();
		$("#delivered").hide();

	});
	$("#pending_offers_button").click(function(){
		$("#pending_requests").hide();
		$("#pending_offers").show();
		$("#connected").hide();	
		$("#delivered").hide();

	});
	$("#connected_button").click(function(){
		$("#pending_requests").hide();
		$("#pending_offers").hide();
		$("#connected").show();
		$("#delivered").hide();
	});
	$("#delivered_button").click(function(){
		$("#pending_requests").hide();
		$("#pending_offers").hide();
		$("#connected").hide();
		$("#delivered").show();
	});
});
</script>
<title>My UC | Inkind Commits</title>

</head>
<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">

<table>
<tr>
<td valign="top">
<?php include 'adminUcTabs.php';?>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >

<?php include('admin/inkindCommitments.php');?>

</div>
</td>
</tr>
</table>
<!--footer-->
<br />
</div>
<?php include 'footer.php' ; ?>
<!--#footer-->
</div>
</body>
</html>
