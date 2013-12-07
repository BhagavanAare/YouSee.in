<?php require_once('login_auth.php');?>
<?php $thispage ="adminHomescreen";
$activetab="activityApprovalsTab";
if (!($_SESSION['SESS_USER_TYPE']=='A'))
{
	header("location: login_access_denied.php");
	exit();
	
}
//session_start();
if(!isset($_SESSION['activeTab']))
{
	
	$_SESSION['activeTab']="donorRegApprovalsTab";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/div.css">
<link href="css/table.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="test/test.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">
<script src="scripts/jquery.min.js"></script>



<title>Homescreen - YouSee</title>

</head>

<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">
<?php
if (!$_SESSION['SESS_USER_TYPE']=="A")
{
	header(header("Location: login_failed"));
}
?>
<?php
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$activityQuery="SELECT name,activity,activity_details,skills,onsite_offsite,location,city,num_volunteers,opportunity_id FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='P' GROUP BY o.activity_id";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;
?>
<table>
<tr>
<td valign="top">
<?php include 'adminUcTabs.php'; ?>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >
<div style="display: block;" ><?php include('admin/activity_approval_form.php');?></div>
</div>
</td>
</tr>
</table>
<?php 
if(isset($_POST['activityApprove'])){
		$query="UPDATE volunteering_opportunities SET approval_status='A' WHERE opportunity_id='".$_POST['opp_id']."'";
		$result=mysql_query($query);
		header("location:activityApproval.php");
		exit();
		}
		if(isset($_POST['activityReject'])){
		$query="UPDATE volunteering_opportunities SET approval_status='R' WHERE opportunity_id='".$_POST['opp_id']."'";
		$result=mysql_query($query);
		header("location:activityApproval.php");
		exit();
		}
?>



<!--footer-->
<br />
</div>
<?php include 'footer.php' ; ?>
<!--#footer-->
</div>
</body>
</html>
