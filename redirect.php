<?php
	session_start();
	//echo "dfksdkfjksdfsdfsdf";
	//echo $_POST['formname'];
	if(isset($_POST['formname']))
	{
		//echo "dfksdkfjksdfsdfsdf";
		$formname=$_POST['formname'];
		//echo $formname;
		if($formname=="donorApproveRegistration" || $formname=="ngoApproveRegistration")
		{
			//$x= isset($_SESSION['SESS_USER_TYPE']);
			//echo "<script>alert($x);</script>";
			$_SESSION['activeTab']="regApprovalsTab";
			if($_SESSION['SESS_USER_TYPE']=="A")
			{
				/* Redirect to a different page in the current directory that was requested */
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'adminHomescreen.php';
				header("Location: http://$host$uri/$extra");
				echo "dfksdkfjksdfsdfsdf";
				exit;
			}
		}
		/*
		elseif($formname="donorApproveRegistration" || $formname="ngoApproveRegistration")
		{
			$_SESSION['activeTab']="regApprovalsTab";
		}
		*/
	}
?>