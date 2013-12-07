<?php $thispage ="registration";
$regPage="";
?>

<?php session_start();
?>

<?php
$msg=" ";
/** Validate captcha */

if (isset($_POST['donorSubmit'])) 
{
    if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['captcha']) {
		
        $captcha_message = "Invalid captcha";
        $style = "background-color: #FF606C";
		$msg="Captcha entered is incorrect";
		 
    } else {
        $captcha_message = "Valid captcha";
        $style = "background-color: #CCFF99";
		echo "before ";
		$_SESSION['POST']=$_POST;

		echo "after ";
		echo "jfksdjg ";
		header("Location: processRegistrations.php");
		
		exit();
		
    }
	
	//header("Location: processRegistrations.php");
	

    
}
if (isset($_POST['ngoSubmit'])) 
{
	
    if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captchango'])) != $_SESSION['captcha']) {
		
        $captcha_message = "Invalid captcha";
        $style = "background-color: #FF606C";
		$msg="Captcha entered is incorrect";
		 
    } else {
        $captcha_message = "Valid captcha";
        $style = "background-color: #CCFF99";
		echo "before ";
		$_SESSION['POST']=$_POST;

		echo "after ";
		echo "jfksdjg ";
		header("Location: processRegistrations.php");
		
		exit();
		
    }
	
	//header("Location: processRegistrations.php");
	

    
}


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
  <HEAD>
<title>Registration</title>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/main.css">

<link rel="stylesheet" href="scripts/jquery-ui.css">
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery.ui.core.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker.js"></script>
<script type="text/javascript">
		$(function() {
		$( "#dob" ).datepicker();
		$( "#dobngo" ).datepicker();
	});
	</script>
<script src="scripts/tabscripts.js"></script>
<script src="scripts/reg_validatorv4.js" type="text/javascript"></script>

<script type="text/javascript">
		function showDonorReg()
		{
			//alert("d");
			
				document.getElementById("donorRegScreen").style.display="block";
				document.getElementById("NGO").style.display="none";
			
			
		}	
		function showNGOReg()
		{

				document.getElementById("donorRegScreen").style.display="none";
				document.getElementById("NGO").style.display="block";
		}	
	</script>
</head>
<body >
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<!--maincontentarea-->
<div id="content-main" >

<table>
	<tr>
		<td>
		<p><strong>Registration Form</strong></p>
		<p><input type="radio" onclick="showDonorReg();" name="userType"
			value="donor" id="donorRadio" /> <label for="donorRadio">Donor/Volunteer <span class="link" ><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span >I wish to donate or volunteer through UC platform.</span></a></span></label>
		&nbsp &nbsp <input type="radio" onclick="showNGOReg();"
			name="userType" id="NGORadio" value="ngo" /> <label for="NGORadio">NGO <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span style="margin-left:175px;">I wish to register my organisation(NGO/NPO) to mobilise resources through UC platform</span></a></span></label>
		</p>
		</td>
	</tr>
</table>
<div id="donorRegScreen" style="display: none;width:960px;margin-left:auto;margin-right:auto;">
<form name="donor" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"><input
	type="hidden" name="formName" value="donorReg" /> 



<div style="min-height:300px; margin-left:30px;" >
<fieldset><legend>Personal Info</legend>
 <div >
					
    <table   border="0">
      <tr>
        <td><label for="firstName">First name*</label></td>
        <td><input name="fname" type="text" id="firstName" value=""/></td>
        <td><div class="error" id="donor_fname_errorloc"></div></td>
      </tr>
      <tr>
        <td><label for="lastName">Last name*</label></td>
        <td><input name="lname" type="text" id="lastName" value=""/></td>
        <td><div class="error" id="donor_lname_errorloc"></div></td>
      </tr>
	  
      <tr>
          <td><label for="donor_type">Individual/Group*</label></td>
          <td>
            <select name="type" id="donor_type">
              <option value="Individual">Individual</option>
              <option value="Group">Group</option>
            </select></td>
          <td><div class="error" id="type_fname_errorloc"></div></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td><p>
          <label>
            <input type="radio" name="gender" value="M" id="radio_m"  />
            Male</label>
          
          <label>
            <input type="radio" name="gender"  value="F" id="radio_f" />
            Female</label>
          <br />
        </p></td>
        <td><div class="error" id="donor_fname_errorloc"></div></td>
      </tr>
      <tr><td><label>Date of Birth</label></td>
        <td><input name="dob" type="text" id="dob" /></td>
        <td>&nbsp;</td></tr>
        <tr>
          <td><label for="occupation">Occupation</label>
          </td>
          <td><input type="text" name="occupation" id="occupation" /></td>
          <td>&nbsp;</td>
        </tr>
       <tr> <td><label for="donor_designation">Designation</label></td>
        <td><input type="text" name="designation" id="donor_designation" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><label for="pan">PAN card no.</label>
        </td>
        <td><input type="text" name="pan" id="pan" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
				<td style="vertical-align:top;">
					<label for="quote">Quote <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>For featuring your photo and Quote on YouSee website,we request you to write a brief (1-3 lines) quote about your thoughts on volunteering,donations and overall about UC (max 300 characters)</span>
						</a>
						</span>
					</label>
				</td>
				<td><span style="vertical-align:top;">
					<textarea placeholder="Please write a brief (1-3 lines) quote about your thoughts on volunteering,donations or overall about UC" name="featureQuote" id="quote" cols="45" rows="5"></textarea>
				</span>
				</td>
				<td>&nbsp;</td>
		</tr>
  </table>
  </fieldset>
  </div>
    <script type="text/javascript">

 	var frmvalidator  = new Validator("donor");
	frmvalidator.EnableFocusOnError(true);
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("fname","req","please enter first name");
	frmvalidator.addValidation("lname","req","please enter last name");
			
	
	
	
  </script>
<fieldset style="margin-left:30px;"><legend>Contact Info</legend>	<table border="0">
			<tr>
				<td>
					<label for="phone_number">Phone number*</label>
				</td>
				<td>
					<input placeholder="Enter your 10 digit Mobile no.. " type="text" maxlength="10"
					name="phno" id="phone_number" value="" />
				</td>
				<td>
					<div class="error" id="donor_phno_errorloc"></div>
				</td>
			</tr>
			<tr>
				<td>
					<label for="personal_emailid">Preferred Email ID*<br /><span style="font-size:10px">(Default Login username)</label>
				</td>
				<td>
					<input type="text" placeholder="example@yourdomain.com" value="" name="preferredEmail"
					id="preferred_emailid" />
				</td>
				<td>
					<div class="error" id="donor_preferredEmail_errorloc"></div>
				</td>
			</tr>
			<tr>
				<td ><label for="password">Password*</label> </td>
                <td><input type="password" name="password" id="password" value=""/></td>
                <td ><div class="error" id="donor_password_errorloc"></div></td>
		</tr>	
        <tr>
                <td ><label for="password">Retype Password*</label></td>
                <td><input type="password" name="repassword" id="cpassword" value=""/></td>
                <td ><div class="error" id="donor_repassword_errorloc"></div></td>
		</tr>	

			<tr>
				<td>
					<label for="official_emailid">Alternate Email ID</label>
				</td>
				<td>
					<input type="text" name="alternateEmail" id="alternate_emailid" />
				</td>
				<td>
					<div class="error" id="donor_alternateEmail_errorloc"></div>
				</td>
			</tr>
			<tr>
				<td>
					<label for="donor_address">Address</label>
				</td>
				<td>
					<input type="text" name="address" id="donor_address" />
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
					<label for="city">City</label>
				</td>
				<td>
					<input type="text" name="city" id="city" />
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
					<label for="donor_state">State*</label>
				</td>
				<td>
					<input type="text" name="state" id="donor_state" value="" />
				</td>
				<td>
					<div class="error" id="donor_state_errorloc"></div>
				</td>
			</tr>
			<tr>
				<td>
					<label for="donor_country">Country*</label>
				</td>
				<td>
					<input type="text" name="country" value="India" id="donor_country" />
				</td>
				<td>
					<div class="error" id="donor_country_errorloc"></div>
				</td>
			</tr>
			<tr>
				<td>
					<label for="donor_pin_code">Pin code</label>
				</td>
				<td>
					<input type="text" name="pincode" id="donor_pin_code" />
				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<script type="text/javascript">
			frmvalidator.addValidation("phno", "req", "	*Please enter  your Phone Number");
			frmvalidator.addValidation("preferredEmail", "email", "	*Please enter your Email properly");
			frmvalidator.addValidation("alternateEmail", "email", "	*Please enter your Email properly");
			frmvalidator.addValidation("preferredEmail", "req", "	*Please enter your Email.");
			frmvalidator.addValidation("state", "req", "	*Please enter  State");
			frmvalidator.addValidation("state", "alpha_s", "	*State must only contain characters");
			frmvalidator.addValidation("country", "req", "	*Please enter Country");
			frmvalidator.addValidation("country", "alpha_s", "	*Country must  only contain characters");
			frmvalidator.addValidation("password", "req", "	please enter your password");
	frmvalidator.addValidation("cpassword", "req", "	retype Password cannot be empty");
	frmvalidator.addValidation("password", "minlen=6", "	password should have atleast 6 characters");
	frmvalidator.addValidation("password","eqelmnt=cpassword","The confirmed password is not same as your new password");
	
		</script></fieldset>
<fieldset style="margin-left:30px;"><legend>Organization Info</legend>
<table border="0">
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
</table></fieldset>
<fieldset style="margin-left:30px;"><table>
		<tr> <td>&nbsp</td><td >
		<p><strong>Write the following word:</strong></p>
		<img src="captcha/captcha.php" id="captcha" /><br/>
		<a href="#" onclick="
		document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
		document.getElementById('captcha-form').focus();"
		id="change-image">Not readable? Change text.</a><br/><br/>	
		<input type="text" name="captcha" id="captcha-form" autocomplete="off" /><br/>
		</td>
		<td style="color:red;"><?php echo $msg; ?></td>
    </tr> </table>
</fieldset>	
<div style="margin-left: 200px;"><input id="register"
	style="visibility: visible" name="donorSubmit" type="submit"
	value="Register" /></div>
</form>
<br />
<br />
</div>
</div>
<!--  NGO Registration forms -->
<div id="NGO" style="display: none;width:960px;margin-left:auto;margin-right:auto;">
<form name="NGO" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<input type="hidden" name="formName" value="NGOReg" /> 

<div style="min-height:300px; margin-top:20px; margin-left:30px;">
<fieldset>
<legend> Organization Info </legend>
<table border="0">
  <tr>
    <td><label for="partner_name">Organisation Name*</label></td>
    <td>
      
      <input type="text" name="partnerName" style="text-transform:capitalize" id="partner_name" />
    </td>
    <td><div class="error" id="NGO_partnerName_errorloc"></div></td>
  </tr>
  <tr>
    <td><label for="partner_type">Organisation Type*</label></td>
    <td>
      <select name="partnerType" id="partner_type">
        <option value="Government">Government Institution</option >
        <option value="Company">Section 25 Company</option>
        <option value="Society">Society</option>
        <option value="Trust">Trust</option>
        <option value="Unregistered Organisation">Unregistered Organisation</option>
      </select></td>
    <td></td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><label for="partner_email_id">Email ID*</label></td>
    <td><span style="vertical-align:top;">
      <input type="text" placeholder"example@yourdomain.com"  name="partnerEmailId" id="partner_email_id" />
    </span></td>
    <td><div class="error" id="NGO_partnerEmailId_errorloc"></div></td></tr>
    <tr>
    <td><label for="hqaddress">Office Address:</label></td>
    <td><input type="text" name="address" id="hqaddress" /></td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><label for="city">City</label></td>
    <td><input type="text" name="hqcity" id="city" style="text-transform:capitalize"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="partnerstate">State*</label></td>
    <td><input type="text" name="hqstate" id="partnerstate" style="text-transform:capitalize"/></td>
    <td><div class="error" id="NGO_hqstate_errorloc"></div></td>
  </tr>
    <tr>
      <td><label for="partnercountry">Country*</label></td>
      <td><input type="text" name="hqcountry" style="text-transform:capitalize" id="partnercountry" value="India" /></td>
      <td><div class="error" id="NGO_hqcountry_errorloc"></div></td>
    </tr>
    <tr>
      <td><label for="partnerpin_code">Pin code</label></td>
      <td><input type="text" name="hqpincode" id="partnerpin_code" /></td>
      <td>&nbsp;</td>
    </tr>
	    <tr>
      <td><label for="website">Website</label></td>
      <td><input type="text" name="website" id="website" /></td>
      <td>&nbsp;</td>
    </tr>
  
  <script type="text/javascript">

 	var ngovalidator  = new Validator("NGO");
	ngovalidator.EnableFocusOnError(true);
	ngovalidator.EnableOnPageErrorDisplay();
	ngovalidator.EnableMsgsTogether();

	ngovalidator.addValidation("partnerName","req","please enter NGO name");
	ngovalidator.addValidation("partnerEmailId","req","please enter NGO name");
	ngovalidator.addValidation("hqstate","req","please enter Head Quarter's state");
	ngovalidator.addValidation("hqstate","alpha_s","state should only contain alphabets");
	ngovalidator.addValidation("hqcountry","req","please enter Head Quarter's country");
	ngovalidator.addValidation("hqcountry","alpha_s","country should only contain alphabets");
	

	
	
  </script>

</table></fieldset>
<fieldset>
<legend> Contact Person Info </legend>
<table border="0">
	<tr>
		<td><label for="firstName">First name*</label></td>
		<td><input placeholder "Enter your First Name" name="fname"
			style="text-transform: capitalize" type="text" id="firstName" /></td>
		<td>
		<div class="error" id="NGO_fname_errorloc"></div>
		</td>
	</tr>
	<tr>
		<td><label for="lastName">Last name*</label></td>
		<td><input name="lname" style="text-transform: capitalize" type="text"
			id="lastName" /></td>
		<td>
			<div class="error" id="NGO_lname_errorloc"></div>
		</td>
	</tr>
	<tr>
		<td>Gender</td>
		<td>
		<p><label> <input type="radio" name="gender" value="M"
			id="sexRadio_0" /> Male</label> <label> <input type="radio"
			name="gender" value="F" id="sexRadio_1" /> Female</label> <br />
		</p>
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><label for="donor_designation">Designation</label></td>
		<td><input type="text" name="designation"
			style="text-transform: capitalize" id="donor_designation" /></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><label for="phone_number">Phone Number * <span class="link"><a
			href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Enter
		a valid Phone Number</span></a></span></label></td>
		<td><input type="text" name="phno" id="phone_number" /></td>
		<td><div class="error" id="NGO_phno_errorloc"></div></td>
	</tr>
	<tr>
		<td><label for="personal_emailid"> Email ID  </label></td>
		<td><input type="text" name="personalEmail" id="personal_emailid" /></td>
		<td>&nbsp;</td>
	</tr>

</table>
</fieldset>
<fieldset><table>
		<tr> <td>&nbsp</td><td >
		<p><strong>Write the following word:</strong></p>
		<img src="captcha/captchango.php" id="captchango" /><br/>
		<a href="#" onclick="
		document.getElementById('captchango').src='captcha/captchango.php?'+Math.random();
		document.getElementById('captcha-formngo').focus();"
		id="change-imagengo">Not readable? Change text.</a><br/><br/>	
		<input type="text" name="captchango" id="captcha-formngo" autocomplete="off" /><br/>
		</td>
		<td style="color:red;"><?php echo $msg; ?></td>
    </tr> </table>
</fieldset>	
<br />

<div style="margin-left: 200px;"><input id="register"
	style="visibility: visible" name="ngoSubmit" type="submit"
	value="Register" /></div>

</div>
</form>
</div>
</div>

<?php include("footer.php"); ?>
</div>

</body>
</html>
<?php
/*
Version Track
1 - 17May13 - Vivek - Registration form modified.
*/
?>