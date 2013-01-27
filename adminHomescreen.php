<?php //require_once('login_auth.php');?>
<?php $thispage ="adminHomescreen"; 
	session_start();
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
registerTab(group,"regApprovalsTab","regApprovalsDiv1");

</script>



<title>Homescreen - YouSee</title>
</head>

<body>
<?php include("header_navbar.php"); ?>


<?php


	if(!isset($_SESSION['formname']))
	{
		if(!isset($_POST['ngoApprovalRegistration']))
		{
			echo "<script> showTab('adminTabs','regApprovalsTab')</script>";
		}
	}
	else
	{
		echo "<script> showTab('adminTabs','regApprovalsTab1')</script>";
	}

?>

<div id="tab" class="tab"   >
<ul  class="tabContainer" >  
<div id="tabs" class="tab-box">
    <a onClick="showTab('adminTabs','regApprovalsTab')" class="tabLink" id="regApprovalsTab">Registration Approvals</a>
    <a onClick="showTab('adminTabs','regApprovalsTab1')" class="tabLink" id="regApprovalsTab1">Registration</a>
</div>
</ul>
</div>

<div style="display:block;" id="regApprovalsDiv"><?php include('admin/registrationApprovalForm.php'); ?></div>
<div style="display:block;" id="regApprovalsDiv1">kdjfhskdfkdsjgkhjdkfngkjdhfjgdj</div>



<!--footer-->
<br />
<?php include 'footer.php' ; ?>
<!--#footer-->
</body>
</html>