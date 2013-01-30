<?php require_once('login_auth.php');?>
<?php $thispage ="adminHomescreen"; 
if (!($_SESSION['SESS_USER_TYPE']=='A'))
{
		header("location: login_access_denied.php");
		exit();
}
	//session_start();
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link href="css/table.css" rel="stylesheet" type="text/css" />
<script src="scripts/tabscripts.js"></script>

<script language="javascript" >
var group="adminTabs";
createGroup(group);
registerTab(group,"regApprovalsTab","regApprovalsDiv");
registerTab(group,"volunteeringApprovalsTab","volunteeringApprovalsDiv");

</script>



<title>Homescreen - YouSee</title>

</head>
<body>
<?php include("header_navbar.php"); 
if (!$_SESSION['SESS_USER_TYPE']=="A")
{
	header(header("Location: login_failed"));
}
?>


<div id="tab" class="tab"   >
<ul  class="tabContainer" >  
<div id="tabs" class="tab-box">
    <a onclick="showTab('adminTabs','regApprovalsTab')" class="tabLink" id="regApprovalsTab">Registration Approvals</a>
    <a onclick="showTab('adminTabs','volunteeringApprovalsTab')" class="tabLink" id="volunteeringApprovalsTab">Registration</a>
</div>
</ul>
</div>

<div style="display:block;" id="regApprovalsDiv"><?php include('admin/registrationApprovalForm.php'); ?></div>
<div style="display:none;" id="volunteeringApprovalsDiv"><?php include('admin/volunteeringApprovalForm.php'); ?></div>
<?php

/*Restore Active tab after reloading the page*/
	if(isset($_SESSION['activeTab']))
	{
		//echo "neeeeeeeeeeeeeeeeeeeeee";
		if($_SESSION['activeTab']=="regApprovalsTab")
		{
			echo "<script> showTab('adminTabs','regApprovalsTab')</script>";
		}
		else
		{
			echo "<script> showTab('adminTabs','regApprovalsTab1')</script>";
		}
		
	}
	else
		{
			echo "<script> showTab('adminTabs','regApprovalsTab1')</script>";
		}
	
?>


<!--footer-->
<br />
<?php include 'footer.php' ; ?>
<!--#footer-->
</body>
</html>