<?php
/**
 * Validate captcha
 */
 session_start();
 $thispage="more";
$msg='';
$fname='';
$lname='';
$phone='';
$email='';

if (isset ( $_POST ['memSubmit'] )) {

	if (empty ( $_SESSION ['captcha'] ) || trim ( strtolower ( $_POST ['captcha'] ) ) != $_SESSION ['captcha']) {

		$captcha_message = "Invalid captcha";
		$style = "background-color: #FF606C";
		$msg = "Captcha entered is incorrect";
	} else {
		$captcha_message = "Valid captcha";
		$style = "background-color: #CCFF99";
		$_SESSION ['POST'] = $_POST;
		header ( "Location: opencityregistration.php" );
	}
}
if(isset($_SESSION['SESS_USER_ID'])){
	if($_SESSION['SESS_USER_TYPE']="A" || $_SESSION['SESS_USER_TYPE']=="D"){
		include("../prod_conn.php");
		$q="SELECT first_name fname,last_name lname,mobile_phone_no phone,preferred_email email FROM donors WHERE donor_id=$_SESSION[SESS_DONOR_ID]";
		$result=mysql_query($q);
		if(mysql_num_rows($result)==1){
				$row=mysql_fetch_array($result);
				$fname=$row['fname'];
				$lname=$row['lname'];
				$phone=$row['phone'];
				$email=$row['email'];
		}
}
}
?>


<!doctype html>
<html lang="en">
<head>
<title>Registration</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/opencity.css">
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/reg_validatorv4.js" type="text/javascript"></script>
<script type="text/javascript">
function redirectToOpenCityLibraryListing() {
	window.location.href="index.php";
}
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#regform").submit(function(e){
	e.preventDefault();
	fname=document.getElementById("firstName").value;
	lname=document.getElementById("lastName").value;
	phone=document.getElementById("phone_number").value;
	email=document.getElementById("preferred_emailid").value;
	if(fname!=''&&lname!=''&&phone!=''&&email!=''){
	$.ajax({
		type : "POST",
		data : {fname:fname,lname:lname,phone:phone,email:email},
		url  : "processregistration.php",
		success : function(returnData){
			$msgs=returnData.split(",");
			regemail = /email address has already been registered/gi;
			regphone = /Phone Number has already been registered/gi;
			regsuccess = /You have succesfully registerd/gi;
			$("#member_preferredEmail_errorloc").hide();
			$("#member_phno_errorloc").hide();
			for (var i=0; i<$msgs.length; i++) {
				if($msgs[i].match(regemail))
				{
					$("#member_preferredEmail_errorloc").replaceWith("<div id='member_preferredEmail_errorloc' class='error' style='width:300px;font-size:11px;'>"+$msgs[i]+"</div>");
					$("#member_preferredEmail_errorloc").show();
				}
				if($msgs[i].match(regphone))
				{
					$("#member_phno_errorloc").replaceWith("<div id='member_phno_errorloc' class='error' style='width:300px;font-size:11px;'>"+$msgs[i]+"</div>");
					$("#member_phno_errorloc").show();
					
				} 
				if($msgs[i].match(regsuccess))
				{
					var $msg=$msgs[i].split('^');
					$("#success_msg").replaceWith("<strong>"+$msg[1]+"</strong>");
					$("#captcha-tab").replaceWith("<br><br><a href='index.php'>Click here to go back to Book Listing Page</a>");
					$("#buttondiv").hide();
					$("#member_preferredEmail_errorloc").hide();
					$("#member_phno_errorloc").hide();

					$("#memberId").replaceWith("<font style='font-size:16px;font-family:Trebuchet MS;'>Member Id : "+$msg[0]+"</font>");					
					$("#fname").replaceWith("<font style='font-size:16px;font-family:Trebuchet MS;'>First Name : "+$("#firstName").val()+"</font>");
					$("#lname").replaceWith("<font style='font-size:16px;font-family:Trebuchet MS;'>Last Name : "+$("#lastName").val()+"</font>");
					$("#phone").replaceWith("<font style='font-size:16px;font-family:Trebuchet MS;'>Mobile No. : "+$("#phone_number").val()+"</font>");
					$("#email").replaceWith("<font style='font-size:16px;font-family:Trebuchet MS;'>Email : "+$("#preferred_emailid").val()+"</font>");
				}
			}
		}
	});
	}
});
});
</script>

</head>
<body>
	<div id="wrapper">
		<div style="background: #FFF;">
			<?php include("../header_navbar.php"); ?>
<style>
.form{
	padding:5px;
	font-weight:bold;
	font-family:Trebuchet MS;
	font-size:16px;
	width:300px;
	height:30px;
}

</style>
<div class="info" id="success_msg" style="margin:20px;"><strong style="border-bottom:1px solid #369;color:#369;font-size:18px;font-family:Trebuchet MS;">Membership Form for Open City Library</strong>
</div>

			<div id="memberRegScreen" style="display: block;margin:20px;">
				<form name="member" method="post" id="regform">
					<input type="hidden" name="formName" value="memberReg" />


					<div style="margin-left: 30px;">
						<fieldset style="font-size:16px;font-family:Trebuchet MS;color:#666;">
							<legend>Personal & Contact Info</legend>
							<div id="registration_table_data" style="margin-left: 30px;">
							
								<table border="0" align="center">
								<tr>
									<td id="memberId">
								</tr>
									<tr>
										<!-- <td><label for="firstName">First name<font color="red">*</font></label></td> -->
										<td id="fname"><input placeholder="First name" class="form" name="fname" type="text" id="firstName" value="<?php echo $fname; ?>" />
										<font color="red">*</font></td></tr>
									<tr><td><div class="error" style="width:300px;font-size:11px;" id="member_fname_errorloc"></div></td>
									</tr>
									<tr>
										<!--<td><label for="lastName">Last name<font color="red">*</font></label></td>-->
										<td id="lname"><input placeholder="Last name" class="form" name="lname" type="text" id="lastName" value="<?php echo $lname; ?>" />
										<font color="red">*</font></td>
									</tr>
									<tr>
										<td><div class="error" style='width:300px;font-size:11px;' id="member_lname_errorloc"></div></td>
									</tr>
									<tr>
									
									
									<tr>
										<!--<td><label for="phone_number">Phone number<font color="red">*</font></label></td>-->
										<td id="phone"><input placeholder="Mobile phone no." size="20" 
											type="text" maxlength="10" class="form" name="phno" id="phone_number"
											value="<?php echo $phone; ?>" />
										<font color="red">*</font></td>
									</tr>
									<tr>
										<td>
											<div class="error" style="width:300px;font-size:11px;" id="member_phno_errorloc"></div>
										</td>
									</tr>
									<tr>
										<!--<td><label for="personal_emailid">Preferred Email ID<font color="red">*</font><br />

										</label></td>-->
										<td id="email"><input size="30" type="text" class="form" placeholder="example@yourdomain.com"
											value="<?php echo $email; ?>" name="preferredEmail" id="preferred_emailid" />
										<font color="red">*</font></td>
									</tr>
									<tr>
										<td>
											<div class="error" style="width:300px;font-size:11px;" id="member_preferredEmail_errorloc"></div>
										</td>
									</tr>
								</table>		
					</div>
					
						<table id="captcha-tab" align="center">
							<tr>
								<td align="center"> <img src="../captcha/captcha.php" id="captcha" /><br /> <a
									onclick="
								document.getElementById('captcha').src='../captcha/captcha.php?'+Math.random();
								document.getElementById('captcha-form').focus();"
									id="change-image" style="cursor:pointer;text-decoration:none;color:#369;font-size:12px;">Not readable? Change text.</a><br /> <br /> <input
									type="text" class="form" placeholder="Type the word in the above image" name="captcha" id="captcha-form" autocomplete="off" /><br />
								</td>
								</tr>
								<tr>
								<td style="color: red;width:300px;font-size:11px;"><?php echo $msg; ?></td>
							</tr>
						</table>
					<div id="buttondiv"  align="center">
						<input id="register" style="visibility: visible; width:120px;height:50px;" name="memSubmit"
							type="submit" value="Register" />
						<input id="register" style="visibility: visible;width:120px;height:50px;" name="cancel"
							type="button" value="Cancel"
							onclick="redirectToOpenCityLibraryListing()">
					</div>
				</fieldset>
	<script type="text/javascript">
 	var frmvalidator  = new Validator("member");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("fname","req","Please enter first name");
	frmvalidator.addValidation("lname","req","Please enter last name");
	frmvalidator.addValidation("phno", "req", "	*Please enter  your Phone Number");
	frmvalidator.addValidation("preferredEmail", "email", "	*Please enter your Email properly");
	frmvalidator.addValidation("preferredEmail", "req", "	*Please enter your Email.");
	</script>
				</form>
				<br /> <br />
			</div>
			<br /> <br />
		</div>
	</div>
	<div style="width: 1000px; margin-right: auto; margin-left: auto;">
		<?php include("../footer.php"); ?>
	</div>
</body>
</html>
