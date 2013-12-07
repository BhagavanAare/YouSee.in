<?php session_start();
if(!isset($_SESSION[ 'SESS_USER_ID']))
{ ?>
				<?php $thispage ="more";
?>

<?php
$msg=" ";
$error_msg="";
$login_error="";
/** Validate captcha */

if (isset($_POST['newDonorCommit'])) 
{
	   if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['captcha']) {	
        $captcha_message = "Invalid captcha";
        $style = "background-color: #FF606C";
		$msg="Captcha entered is incorrect";	 
    } 
    else{
		include "prod_conn.php";
		
        $captcha_message = "Valid captcha";
        $style = "background-color: #CCFF99";
        $user_query="INSERT INTO 
        users(registration_status,user_type_id,username,password) 
        VALUES ('A','D','$_POST[preferredEmail]',md5('$_POST[password]'))";
        if(mysql_query($user_query)){
			$user_id=mysql_insert_id();
			$displayname=$_POST['fname']." ".$_POST['lname'];
			$donor_query="INSERT INTO donors(type_of_donor,first_name,
			last_name,dob,gender,village_town,state,country,mobile_phone_no,
			preferred_email,displayname,org_grp_name,org_grp_type,
			org_grp_description,user_id,registration_date) VALUES
			('$_POST[type]','$_POST[fname]','$_POST[lname]','$_POST[dob]'
			,'$_POST[gender]','$_POST[city]','$_POST[state]','$_POST[country]',
			'$_POST[phno]','$_POST[preferredEmail]','$displayname','$_POST[orgName]',
			'$_POST[orgType]',
			'$_POST[orgDesc]','$user_id',NOW())";
			echo $donor_query;
			if(mysql_query($donor_query)){
					include "Email/sendemail.php";
					$params=array(
					$email=$donor_email,
					$subject="Acknowledgement-Information Submission",
					$displayname=$displayname,
					$mailtext="This is to acknowledge that we have 
					received information submitted by you as shown below
					 and we thank you for Registering at 
					 <a href=\"www.yousee.in\">YouSee</a>.
					  <br /><br />You may reply to this email or call 
					  +91-8008-884422 for any futher information you 
					  may like to have from 
					  <a href=\"www.yousee.in\">YouSee</a>");
					call_user_func_array(sendEmail,$params);
					$login_query="SELECT username,user_type_id,users.user_id,
					displayname,donor_id 
					FROM
					users 
					JOIN donors ON users.user_id = donors.user_id
					WHERE users.user_id=$user_id";
					$user=mysql_fetch_array(mysql_query($login_query));
					$_SESSION['SESS_USER_TYPE']='D';
					$_SESSION['SESS_USER_ID']=$user['user_id'];
					$_SESSION['SESS_USERNAME']=$user['username'];
					$_SESSION['SESS_DISPLAYNAME']=$user['displayname'];
					$_SESSION['SESS_DONOR_ID']=$user['donor_id'];
					if(mysql_query("UPDATE users SET present_login_date=CURDATE(),
					present_login_time=CURTIME() WHERE user_id=$user_id"))
					header("Location: doctor_details.php");
					exit();
			}
			else {
				mysql_query("DELETE FROM users WHERE user_id=$user_id");
				$error_msg.="Error in registration.<br /> Note:Mobile no. 
				should be unique.";
			}
		}
		else{
			$error_msg="Error in registration.<br />
			Note : Preferred Email should be unique.";
		}
    }
}
else if(isset($_POST['Submit'])){
					include "prod_conn.php";
					$login_query="SELECT username,user_type_id,users.user_id,
					displayname,donor_id 
					FROM
					users 
					JOIN donors ON users.user_id = donors.user_id
					WHERE users.username=trim('$_POST[username]') AND 
					password=md5(trim('$_POST[password]'))";
					if($user=mysql_fetch_array(mysql_query($login_query))){
					$_SESSION['SESS_USER_TYPE']=$user['user_type_id'];
					$_SESSION['SESS_USER_ID']=$user['user_id'];
					$_SESSION['SESS_USERNAME']=$user['username'];
					$_SESSION['SESS_DISPLAYNAME']=$user['displayname'];
					$_SESSION['SESS_DONOR_ID']=$user['donor_id'];
					if(mysql_query("UPDATE users SET present_login_date=CURDATE(),
					present_login_time=CURTIME() WHERE user_id=$user[user_id]")){
					if($_SESSION['SESS_USER_TYPE']=='D'){
					header("Location: doctor_details.php");
					exit();
					}
					else $login_error="Only for donors.";
					}
					}
					else $login_error="Incorrect username or password.";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<title>People's Doctor Registration | YouSee</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/css/main.css">
<link rel="stylesheet" href="/scripts/jquery-ui.css">
<script src="/scripts/jquery.min.js"></script>
<script src="/scripts/jquery.ui.core.js"></script>
<script src="/scripts/jquery.ui.widget.js"></script>
<script src="/scripts/datepicker.js"></script>
<script type="text/javascript">
		$(function() {
		$( "#dob" ).datepicker();
		$("#donor_type").change(function(){
			if(this.value=="Group")
			$("#orginfo").show();
			else{
			$("#orginfo").hide();}
			});
		
		$("#regform").submit(function(e){
			if($("#regpassword").val()!=$("#confirm_password").val()){
				$("#regpassword").parent().find("div").replaceWith("<font color='red'>Passwords mismatch, please recheck.</font>");
				return false;
			}
			else{
				return true;
			}
		});
		});
	</script>
</head>
<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div style="float:right;width:30%;margin-right:2em;">
<h3> Already Registered?</H3>
<fieldset>
<legend> Login </legend><form id="loginForm" name="loginForm" method="post" action="register_doctor.php">
  <table border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td><b>Username</b></td>  <td><input name="username" type="text" title="Username" class="textfield" id="username" required /></td></tr>
	 <tr> <td><b>Password</b></td>
       <td><input name="password" type="password" title="Password" class="textfield" id="lpassword" required /></td>
    </tr>
    <tr>
      <td><input type="submit" name="Submit" value="Login" /></td>
    </tr>
  </table>
</form></fieldset>
<font color="red"><?php echo $login_error;?></font>
</div>
<div id="donorRegScreen" style="width:50%;">
<form name="donor" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="regform"><input
	type="hidden" name="formName" value="donorReg" /> 
<br />
<div style="min-height:300px; margin-left:100px;" >
<h3>Register</h3>
<font color="red">
<?php echo $error_msg;?></font>
<fieldset>
 <table   border="0">
      <tr>
        <td><label for="firstName">First name*</label></td>
        <td><input name="fname" type="text" id="firstName" value="" required /></td>
      </tr>
      <tr>
        <td><label for="lastName">Last name*</label></td>
        <td><input name="lname" type="text" id="lastName" value="" required /></td>
      </tr>
	    <tr>
	<td><label for="Gender">Gender</label></td>
	 <td><input name="gender" type="radio" id="male" value="M" required />
       <label for="male">Male</label>
       <input name="gender" type="radio" id="female" value="F" required />
	<label for="female">Female</label></td>

      </tr>
	  
      <tr>
          <td><label for="donor_type">Individual/Group*</label></td>
          <td>
            <select name="type" id="donor_type"  required>
              <option value="Individual">Individual</option>
              <option value="Group">Group</option>
            </select></td>
      </tr>
      <tr>
      <td><label>Date of Birth</label></td>
        <td><input name="dob" type="text" id="dob" /></td>
        </tr>     
  
			<tr>
				<td>
					<label for="phone_number">Phone number*</label>
				</td>
				<td>
					<input placeholder="Enter your 10 digit Mobile no.. " type="text" maxlength="10"
					name="phno" id="phone_number" value=""  required />
				</td>
			</tr>
			<tr>
				<td>
					<label for="personal_emailid">Preferred Email ID*<br /><span style="font-size:10px">(Default Login username)</label>
				</td>
				<td>
					<input type="email" placeholder="example@yourdomain.com" value="" name="preferredEmail"
					id="preferred_emailid" required />
				</td>
			</tr>
			<tr>
				<td ><label for="password">Password*</label> </td>
                <td><input type="password" name="password" id="regpassword" value="" required />
                <div></div></td>
		</tr>	
        <tr>
                <td ><label for="password">Retype Password*</label></td>
                <td><input type="password" name="repassword" id="confirm_password" value="" required /></td>
		</tr>	
					<tr>
				<td>
					<label for="donor_city">City</label>
				</td>
				<td>
					<input type="text" name="city" id="donor_city" value="" />
				</td>
			</tr>
			<tr>
			<tr>
				<td>
					<label for="donor_state">State*</label>
				</td>
				<td>
					<input type="text" name="state" id="donor_state" value=""  required />
				</td>
			</tr>
				<td>
					<label for="donor_country">Country*</label>
				</td>
				<td>
					<input type="text" name="country" value="India" id="donor_country"  required />
				</td>

			</tr>
			<tbody id="orginfo" hidden>
  <tr>
    <td><label for="group_name">Org/Group Name</label></td>
    <td>
      
      <input type="text" name="orgName" id="group_name" />
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="group_type">Org/Group Type</label></td>
    <td>
      <select name="orgType" id="group_type">
	          <option value="">--Select--</option>
        <option value="Company">Company</option>
        <option value="Society">Cooperative Society</option>
        <option value="Family">Family</option>
        <option value="Informal">Trust</option>
        <option value="Unregistered Organisation">Unregistered Organisation</option>
      </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><label for="group_desc">Org/Group Description <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Please enter the details of your Group/Organisation(max 500 characters</span></label>
      </td>
    <td><textarea placeholder="Please enter the details of your Group/Organisation(max 500 characters)" name="orgDesc" id="group_desc" cols="45" rows="5"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  </tbody>
		<tr> <td>&nbsp</td><td >
		<p><strong>Write the following word:</strong></p>
		<img src="captcha/captcha.php" id="captcha" alt="captcha" /><br/>
		<a  onclick="
		document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
		document.getElementById('captcha-form').focus();"
		id="change-image">Not readable? Change text.</a><br/><br/>	
		<input type="text" name="captcha" id="captcha-form" autocomplete="off" /><br/>
		</td>
		<td style="color:red;"><?php echo $msg; ?></td>
    </tr> 		
</table>
</div>
<div style="margin-left: 200px;">
<input id="register" style="visibility: visible" name="newDonorCommit" type="submit" value="Register" /></div>
</form>
</fieldset>

<br />
<br />
</div>
</form>


<br />
<br />
</div><?php include("footer.php"); ?>
	</div>
</body>
</html>
 <?php
			} 
			else
			{
			
			} 
		?>
		
