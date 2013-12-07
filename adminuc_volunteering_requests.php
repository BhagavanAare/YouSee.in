<?php require_once('login_auth.php');?>
<?php $thispage ="adminHomescreen";
$activetab="requests-volunteering";
if (!($_SESSION['SESS_USER_TYPE']=='A'))
{
	header("location: login_access_denied.php");
	exit();
	
}
//session_start();
if(!isset($_SESSION['activeTab']))
{
	
	$_SESSION['activeTab']="requests-volunteering";
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
<link rel="stylesheet" type="text/css" href="scripts/jquery-ui.css">
<script src="scripts/jquery.min.js"></script>
<script src="scripts/custom_jquery.js"></script>
<script src="scripts/datepicker_ngo.js"></script>
<script src="scripts/jquery.timeentry.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
<script>
$(function(){
	var url='expired_volunteering_requests.php';
	$("#expired_opp").click(function(){
			$(".right_div").load(url);
			if(url=='expired_volunteering_requests.php'){
				url='existing_volunteering_requests.php';
				$(this).text("View Active opportunities.");
			}
			else{
				url='expired_volunteering_requests.php';
				$(this).text("View Expired opportunities.");
			}

	});
});
</script>


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
<table>
<tr>
<td valign="top">
<?php include 'adminUcTabs.php'; ?>
</td>
<td>
		<span style="float:right;color:#369;text-decoration:underline;cursor:pointer" id="expired_opp">View Expired Opportunities.</span>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >
<?php include "existing_volunteering_requests.php"; ?>
</div>
</td>
</tr>
</table>
</div>
<?php include 'footer.php' ; ?>
</div>
