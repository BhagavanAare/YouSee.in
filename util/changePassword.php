<?php
/*
Page/Script Created by Shawn Holderfield
*/

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



<html>
    <head>
        <title>Change Password</title>
    </head>
    <body>
	<?php if(isset($_POST['submit'])){ 
			echo $msg; 
		}?>
            <form method="POST" name="changePassword" action="redirect.php">
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
                    <tr><td>
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
			$password = $_POST['password'];
			//echo $password;
			$npassword = $_POST['npassword'];
			$rpassword = $_POST['cpassword'];



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
    </body>
</html>