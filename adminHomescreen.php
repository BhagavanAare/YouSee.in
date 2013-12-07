<?php require_once('login_auth.php');?>
<?php $thispage ="adminHomescreen";
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
<link href="css/table.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="test/test.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">
<script src="scripts/tabscripts.js"></script> <script
	language="javascript">
var group="adminTabs";
createGroup(group);

registerTab(group,"donorRegApprovalsTab","donorApprovalsDiv");
registerTab(group,"ngoRegApprovalsTab","ngoApprovalsDiv");
registerTab(group,"volunteeringApprovalsTab","volunteeringApprovalsDiv");
registerTab(group,"donorLoginLogTab","donorLoginLogDiv");
registerTab(group,"ngoLoginLogTab","ngoLoginLogDiv");
//registerTab(group,"ngoRegApprovalsTab","regApprovalsDiv");

</script>



<title>Homescreen - YouSee</title>

</head>
<body class="wrapper" style="background:#eeeeee; " >
<div style="background:white;" >
<?php include("header_navbar.php");
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
				WHERE o.approval_status='P'";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;
?>
<table>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<ul  class="tree" >  
	<li class="tree">
		<label for="folder1" class="menu_first">> Approvals</label> 
		<input type="checkbox" checked id="folder1" />
		<ul  class="tree" >  
			<li class="tree">
				<label for="folder2" class="menu_first">> Registration</label> 
				<input type="checkbox" checked id="folder2" />
				
				<ul>
					<li class="tabLink"><a  class="file" onclick="showTab('adminTabs','donorRegApprovalsTab')"	id="donorRegApprovalsTab">Donors</a></li> 
					<li class="tabLink"><a class="file" onclick="showTab('adminTabs','ngoRegApprovalsTab')" id="ngoRegApprovalsTab">NGOs</a></li>					
					
				</ul>
			</li>
			<li class="tabLink"><a  class="file" onclick="showTab('adminTabs','volunteeringApprovalsTab')" id="volunteeringApprovalsTab">Volunteering</a></li>
			<li class="tabLink"><a  href="activityApproval.php" class="file" id="activityApprovalsTab">Activities <?php if($resultCount>0) {?><span style="color:#fE0606">(<?php echo $resultCount; ?>)</span><?php } ?></a></li>
		</ul>
	</li>
	<li class="tree"> 
		<label for="folder3" class="menu_first">> Logs</label> 
		<input type="checkbox" checked id="folder3" />
		<ul  class="tree" >  
			<li class="tabLink"><a  class="file" onclick="showTab('adminTabs','donorLoginLogTab')"	id="donorLoginLogTab">Donors</a></li>
			<li class="tabLink"><a class="file" onclick="showTab('adminTabs','ngoLoginLogTab')"	id="ngoLoginLogTab">NGOs</a></li>
			
		</ul>
	</li>
</ul>
</div>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >
<div style="display: block;" id="regApprovalsDiv"><?php include('admin/registrationApprovalForm.php');?></div>
<div style="display: none;" id="volunteeringApprovalsDiv"><?php include('admin/volunteeringApprovalForm.php');?></div>
<div style="display: none;" id="donorLoginLogDiv"><?php include('admin/donorLoginInfo.php');?></div>
<div style="display: none;" id="ngoLoginLogDiv"><?php include('admin/ngoLoginInfo.php');?></div>
</div>
</td>
</tr>
</table>
<?php
/*
// functions to include tab content only if needed
function includeRegistrationApprovalForm()
{
	//if($_SESSION['activeTab']=="regApprovalsTab")
		
		include('admin/registrationApprovalForm.php'); 
	
}
function includeVolunteeringApprovalForm()
{
	//if($_SESSION['activeTab']=="volunteeringApprovalsTab")
		
		include('admin/volunteeringApprovalForm.php');
	
} 
?>
<?php

/*Restore Active tab after reloading the page*/
if(isset($_SESSION['activeTab']))
{
	echo "<script> showTab('adminTabs','".$_SESSION['activeTab'] ."')</script>";
	

}
?>




<!--footer-->
<br />
<?php include 'footer.php' ; ?>
<!--#footer-->
</body>
</html>
