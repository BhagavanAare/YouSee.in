<?php require_once('login_auth.php');?>
<?php
$activetab="ngoLoginLogTab";
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
<link rel="stylesheet" type="text/css" href="css/tabs.css">

<title>My UC | NGO Login Logs</title>

</head>
<body >

<div id="wrapper" >
<?php include("header_navbar.php"); ?>
<div id="content-main">
<table>
<tr>
<td valign="top">
<?php include 'adminUcTabs.php';?>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >

<?php include('admin/ngoLoginInfo.php');?>

</div>
</td>
</tr>
</table>
<!--footer-->
<br />
</div>
<?php include 'footer.php' ; ?>
</div>
<!--#footer-->
</body>
</html>
