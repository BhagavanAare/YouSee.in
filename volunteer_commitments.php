<?php require_once('login_auth.php');?>
<?php
$activetab="volunteerCommitmentsTab";
 $thispage ="adminHomescreen";
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
<link href="css/table.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="test/test.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">
<link rel="stylesheet" type="text/css" href="scripts/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="scripts/datetimepicker.css">
<script src="scripts/tabscripts.js"></script> 
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery.ui.core.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker.js"></script>

<title>My UC | Volunteering Commits</title>

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

<?php include('admin/volunteeringCommitments.php');?>

</div>
</td>
</tr>
</table>
</div>
<!--footer-->
<br />
<?php include 'footer.php' ; ?>
</div>
<!--#footer-->
</body>
</html>
