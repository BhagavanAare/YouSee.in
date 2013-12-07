<?php require_once('login_auth.php');?>
<?php $thispage = "ngoHomescreen"; 
$activetab="passwordTab";

if (!$_SESSION['SESS_USER_TYPE']=="N")
{
	header(header("Location: login_failed"));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>My UC | Update Password</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
	    <script src="scripts/gen_validatorv4.js"></script>

</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<div id="content-main">
<!--maincontentarea begin-->

<table>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
	<?php include 'ngo_uc_tabs.php'; ?>
</div>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >

<?php

//Establish output variable - For displaying Error Messages
$msg = "";

//Connect to the Database Server
    include_once("prod_conn.php");
	$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 	//establishes database connection
	if (!$con) // if connection fails
	{
		die('Could not connect: ' . mysql_error()); // error is shown
	}
	mysql_select_db("$dbdatabase");
	
	$username=$_SESSION['SESS_USERNAME'];
	
	
?>



    <body>
	<?php if(isset($_POST['submit'])){ 
			echo $msg; 
		}?>
            <form method="POST" name="changePassword" action="ngo_uc_update_password.php">
				<input type="hidden" name="formname" value="changePassword" />
                <table border="0">
                    <tr>
                        <td align="right">Current Password: </td>
							<td><input type="password" id="password" name="password" value=""/></td>
						
						
						
							<td colspan="2"><div class="error" id="changePassword_password_errorloc"></div></td>
						
                    </tr>
                    <tr>
                        <td align="right">New Password: </td>
                        <td><input type="password" name="npassword" id="npassword" value=""/></td>
                    
					
							<td colspan="2"><div class="error" id="changePassword_npassword_errorloc"></div></td>
					</tr>	
                    <tr>
                        <td align="right">Confirm New Password: </td>
                        <td><input type="password" name="cpassword" id="cpassword" value=""/></td>
                    
					
							<td colspan="2"><div class="error" id="changePassword_cpassword_errorloc"></div></td>
					</tr>	
                    <tr><td></td><td align="middle">
                        <input type="submit" name="submit" value="Submit"/>
                        </td>
                    </tr>
					
                </table>
            </form>
        <br>
<?php		
//Check to see if the form has been submitted
if(isset($_POST['submit']))
{
	if (mysql_real_escape_string($_POST['submit']))
	{
		if ($_POST['formname']=="changePassword")
		{
			//Establish Post form variables
    
			//echo $username;
			$password = md5($_POST['password']);
			//echo $password;
			$npassword = md5($_POST['npassword']);
			$rpassword = md5($_POST['cpassword']);



		// Query the database - To find which user we're working with
			$sql = "SELECT * FROM users WHERE username = '$username' ";
			$query = mysql_query($sql);
			$numrows = mysql_num_rows($query);

		//Gather database information
			while ($rows = mysql_fetch_array($query))
			{
				//$dbusername = $rows['username'];
				$dbpassword = $rows['password'];
			}	

		

    //Validate The Form
			if (empty($password) || empty($npassword) || empty($rpassword))

				$msg = "All fields are required";

			elseif ($password != $dbpassword)

				$msg = "The CURRENT password you entered is incorrect.";

			elseif ($npassword != $rpassword)

				$msg = "Your new passwords do not match";

			elseif ($npassword == $password)

				$msg = "Your new password matches your old password.Please enter a new passowrd";

			else
			{
			//$msg = "Your Password has been changed.";
				mysql_query("UPDATE users SET password = '$npassword' WHERE username = '$username'");
				echo "<p style=\"color:green\">Password changed successfully. </p>" ;
			}
		}
    }
}


?>		
<script type="text/javascript">
	var frmvalidator  = new Validator("changePassword");
	frmvalidator.EnableFocusOnError(true);
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	
			frmvalidator.addValidation("password", "req", "	*Please enter your current password");
			frmvalidator.addValidation("npassword", "req", "	*New Password cannot be empty");
			frmvalidator.addValidation("cpassword", "req", "	*Confirm Password cannot be empty");
			frmvalidator.addValidation("npassword", "minlen=6", "	*Password should have atleast 6 characters");
			//frmvalidator.addValidation("password","eqelmnt=npassword","Old password is same as your new pssword");
			frmvalidator.addValidation("npassword","eqelmnt=cpassword","The confirmed password is not same as your new password");
			
</script>
<p style="color:red"><?php echo $msg; ?></p>
</div>
</td>
</tr>
</table>
<!--footer-->
</div>
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
<?php
/* Change log

02-Jun-2013 - Vivek - Password Encryption.

*/
?>	