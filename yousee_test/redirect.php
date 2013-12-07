<?php
session_start();
//echo "dfksdkfjksdfsdfsdf";
//echo $_POST['formname'];
/*
 elseif($formname="donorApproveRegistration" || $formname="ngoApproveRegistration")
 {
 $_SESSION['activeTab']="regApprovalsTab";
 }
 */
if (isset($_POST))
{
	$_SESSION['POST_DATA']=$_POST;
}
if ($_SESSION['SESS_USER_TYPE']=="D")
{
	//echo "<script>alert(".$_POST['formname'].")</script>";
	if(isset($_POST['formname']))
	{
		$_SESSION['activeTab']=$_POST['formname'];
	}
	header("Location: myuc.php");
	exit();
}
if ($_SESSION['SESS_USER_TYPE']=="N")
{
	header("Location: ngoHomescreen.php");
}
elseif ($_SESSION['SESS_USER_TYPE']=="A")
{
	if(isset($_POST['formname']))
	{
		//echo "dfksdkfjksdfsdfsdf";
		$formname=$_POST['formname'];
		//echo $formname;
		if($formname=="donorApproveRegistration" || $formname=="ngoApproveRegistration")
		{
			$_SESSION['activeTab']="regApprovalsTab";
			
			/*if($_SESSION['SESS_USER_TYPE']=="A")
				{
				// Redirect to a different page in the current directory that was requested
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'adminHomescreen.php';
				header("Location: http://$host$uri/$extra");
				echo "dfksdkfjksdfsdfsdf";
					
				exit;
				}*/
		}
		if($formname=="volunteeringApprovalForm")
		{
			$_SESSION['activeTab']="volApprovalsTab";

		}
	}
	header("Location: adminHomescreen.php");
}
?>