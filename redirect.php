<?php
session_start();


if (isset($_POST))
{
	$_SESSION['POST_DATA']=$_POST;
	
}
if (isset($_GET['activeTab']))
{
	
	$_SESSION['activeTab']=$_GET['activeTab']; 
	//echo "<script>alert('".$_SESSION['activeTab']."');</script>";
}
if ($_SESSION['SESS_USER_TYPE']=="D")
{
	//echo "<script>alert(".$_POST['formname'].")</script>";
	if(isset($_POST['formname']))
	{
		
		//$_SESSION['activeTab']=$_POST['formname'];
		if ($_POST['formname']=="updateInfo")
		{
			$_SESSION['activeTab']="myInfoTab";
		}
		if ($_POST['formname']=="updateActivity")
		{
			$_SESSION['activeTab']="updateVolunteeringTab";
		}
		if ($_POST['formname']=="changePassword")
		{
			$_SESSION['activeTab']="settingsTab";
		}
		
		
		
	}
	header("Location: myucSummary.php");
	exit();
}
if ($_SESSION['SESS_USER_TYPE']=="N")
{
	
	if(isset($_POST['formname']))
	{
		
		$formname=$_POST['formname'];		
		
		if($formname=="reportNgoFinancialDonations")
		{
			$_SESSION['activeTab']="financialTab";
			
			//exit();
			
		}
		elseif($formname=="reportNgoVolunteerHours")
		{
			$_SESSION['activeTab']="volunteerHoursTab";
			
			//exit();
		}
	}
	header("Location: ngo_uc_donation_summary.php");
	exit();
}
elseif ($_SESSION['SESS_USER_TYPE']=="A")
{
	if(isset($_POST['formname']))
	{
		$formname=$_POST['formname'];		
		if($formname=="donorApproveRegistrationForm")
		{

			$_SESSION['activeTab']="donorRegApprovalsTab";

		}
		elseif($formname=="ngoApproveRegistrationForm")
		{
			$_SESSION['activeTab']="ngoRegApprovalsTab";

		}
		elseif($formname=="volunteeringApprovalForm")
		{
			$_SESSION['activeTab']="volunteeringApprovalsTab";

		}
		elseif($formname=="donorLoginLog")
		{
			$_SESSION['activeTab']="donorLoginLogTab";
			
		}
		elseif($formname=="ngoLoginLog")
		{
			$_SESSION['activeTab']="ngoLoginLogTab";

		}
		echo "<script>alert(".$_SESSION['activeTab'].")</script>";
	}
	//echo "<script>alert('".$_SESSION['activeTab']."');</script>";exit();
	//header("Location: adminHomescreen.php");
	header("Location: adminUcVolunteeringApprovals.php");
	
}
?>
