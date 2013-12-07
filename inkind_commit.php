<?php 
/*inkind commit begin*/
 session_start();
 $thispage="inkind";
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel 
  Philanthropic Resources to Education, Health and Environmental services sectors,
   in order to improve access to these services especially for the poor. These 
   sectors need a much larger infusion of capital of various kinds including 
   Financial, Intellectual and Social Capital.">
   <TITLE>Make an In-Kind Commitment | YouSee</TITLE>
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/div.css">
  <script src="scripts/jquery.min.js"></script>
 
</HEAD>
<BODY>
<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->

<?php include 'header_navbar.php';?>

<!--maincontentarea-->

<div id="uccertificate-main">
 <?php
if(!isset($_SESSION['SESS_USER_ID'])){  
 /*If user is not logged in, display registration and login forms. */
?>
<?php
$msg=" "; ?>

<link rel="stylesheet" href="scripts/jquery-ui.css">
<script src="scripts/jquery.ui.core.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker.js"></script>
<script src="scripts/reg_validatorv4.js" type="text/javascript"></script>
<script type="text/javascript">
		$(function() {
		$("#donor_type").change(function(){
			if(this.value=="Group")
			$("#orginfo").show();
			else{
			$("#orginfo").hide();}
			});
	<?php if(isset($_POST['offer_quantity'])){ ?>
		$("#loginarea").prepend("<legend>Donor Login</legend>");
		$( "#dob" ).datepicker();
		$(".donorRegScreen").show();				
		$(".ngoRegScreen").hide();				
	<?php } 
	else if(isset($_POST['request_quantity'])){?>
			$("#loginarea").prepend("<legend>NGO Login</legend>");
		$(".donorRegScreen").hide();
		$(".ngoRegScreen").show();
	<?php
	}
	?>
	});
	</script>


	<?php
if(( isset($_SESSION['donation_id']) && (isset($_SESSION['offer_quantity']) || isset($_SESSION['request_quantity'])))){
					$_POST['id']=$_SESSION['donation_id'];
					if(isset($_SESSION['offer_quantity'])) {
					$_POST['offer_quantity']=$_SESSION['offer_quantity'];
					unset($_SESSION['offer_quantity']);
					}
					if(isset($_SESSION['request_quantity'])) {
					$_POST['request_quantity']=$_SESSION['request_quantity'];
					unset($_SESSION['request_quantity']);
					}
					unset($_SESSION['donation_id']);
					}
				?>
<div style="float:right;width:30%;margin-right:2em;">
<h3> Already Registered?</H3>
<fieldset id="loginarea">
 
<form  id="loginform" action="inkind_commit_exec.php" method="POST">
  <table border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td><b>Username</b></td>  <td><input name="username" type="text" title="Username" class="textfield" id="username" /></td></tr>
	 <tr> <td><b>Password</b></td>
       <td><input name="password" type="password" title="Password" class="textfield" id="password" /></td>
       <td><input name="id" type="text" value="<?php echo $_POST['id']; ?>" id="id" hidden /></td>
       <td><input name="<?php if(isset($_POST['offer_quantity'])) echo "offer_quantity"; elseif(isset($_POST['request_quantity'])) echo "request_quantity"; ?>"  value="<?php if(isset($_POST['offer_quantity'])) echo $_POST['offer_quantity']; elseif(isset($_POST['request_quantity'])) echo $_POST['request_quantity']; ?>" type="text" id="offer_quantity" hidden /></td>
    </tr>
    <tr>
      <td><input type="submit" name="login" value="Login" id="login"/></td>
    </tr>
  </table>
 </form>
</fieldset></div>
<div class="donorRegScreen" style="width:50%;" hidden>
<div style="min-height:300px; margin-left:100px;" >
<h3>Register</h3>
<fieldset>
<form name="donor" id="donorregform" action="/inkind_commit.php" method="POST">

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
	<td><label for="Gender">Gender</label></td>
	 <td><input name="gender" type="radio" id="male" value="M"/>
       <label for="male">Male</label>
       <input name="gender" type="radio" id="female" value="F"/>
	<label for="female">Female</label></td>
	        <td><div class="error" id="donor_gender_errorloc"></div></td>

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
      <td><label>Date of Birth</label></td>
        <td><input name="dob" type="text" id="dob" /></td>
        </tr>     
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
					<input type="text" name="state" id="donor_state" value="" />
				</td>
				<td>
					<div class="error" id="donor_state_errorloc"></div>
				</td>
			</tr>
				<td>
					<label for="donor_country">Country*</label>
				</td>
				<td>
					<input type="text" name="country" value="India" id="donor_country" />
				</td>
				<td>
					<div class="error" id="donor_country_errorloc"></div>
				</td>
				 <td><input name="id" type="text" value="<?php echo $_POST['id']; ?>" id="id" hidden /></td>
       <td><input name="<?php if(isset($_POST['offer_quantity'])) echo "offer_quantity"; elseif(isset($_POST['request_quantity'])) echo "request_quantity"; ?>"  value="<?php if(isset($_POST['offer_quantity'])) echo $_POST['offer_quantity']; elseif(isset($_POST['request_quantity'])) echo $_POST['request_quantity']; ?>" type="text" id="offer_quantity" hidden /></td>
    
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
		<img src="/captcha/captcha.php" content="no-cache" id="captcha" /><br/>
		<a style="color:blue;text-decoration:underline;cursor:pointer" onclick="
		document.getElementById('captcha').src='/captcha/captcha.php?'+Math.random();
		document.getElementById('captcha-form').focus();"
		id="change-image">Not readable? Change text.</a><br/><br/>	
		<input type="text" name="captcha" value=""  id="captcha-form" autocomplete="off"/><br/>
		</td>
		<td style="color:red;"><?php echo $msg; ?></td>
    </tr> 		
</table>
  <script type="text/javascript">
	$(function(){
	
		$("#donorregform").submit(function(){
		
 	var frmvalidator  = new Validator("donor");
	frmvalidator.EnableFocusOnError(true);
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("fname","req","please enter first name");
	frmvalidator.addValidation("lname","req","please enter last name");
	frmvalidator.addValidation("phno", "req", "	*Please enter  your Phone Number");
			frmvalidator.addValidation("preferredEmail", "email", "	*Please enter your Email properly");
			frmvalidator.addValidation("preferredEmail", "req", "	*Please enter your Email.");
			frmvalidator.addValidation("state", "req", "	*Please enter  State");
			frmvalidator.addValidation("state", "alpha_s", "	*State must only contain characters");
			frmvalidator.addValidation("country", "req", "	*Please enter Country");
			frmvalidator.addValidation("country", "alpha_s", "	*Country must  only contain characters");
			frmvalidator.addValidation("password", "req", "	please enter your password");
	frmvalidator.addValidation("cpassword", "req", "	retype Password cannot be empty");
	frmvalidator.addValidation("password", "minlen=6", "	password should have atleast 6 characters");
	frmvalidator.addValidation("password","eqelmnt=cpassword","The confirmed password is not same as your new password");	


		});	
	});
	
	
  </script>
</div>
<div style="margin-left: 200px;">

<input id="register" style="visibility: visible" name="donorSubmit" form="donorregform" type="submit" value="Register" />
</div>
</form>
</fieldset>

<br />
<br />
</div>

<div class="ngoRegScreen" style="width:50%;" hidden>
<fieldset>
<p> You need to be registered as a NGO at YouSee to make requests to in-kind donations. You may <a href="registration.php">Register here</a>.</p>
</fieldset>
</div>

 <?php
		} 
		else    /* If user is logged in already, display confirm message. */
			{
				require_once('prod_conn.php');
				$link = mysql_connect("$dbhost","$dbuser","$dbpass");
				if(!$link) {
					die('Failed to connect to server: ' . mysql_error());
				}

				//Select database
				$db = mysql_select_db("$dbdatabase");
				if(!$db) {
					die("Unable to select database");
				}
				
				/* If a donor commits to a requet. */
			if($_SESSION['SESS_USER_TYPE']=="D"){
			if(isset($_POST['request_quantity']))
				{echo "Requests can only be made by NPOs"; exit();}
					if(isset($_SESSION['donation_id']) && isset($_SESSION['offer_quantity'])){
					$_POST['id']=$_SESSION['donation_id'];
					$_POST['offer_quantity']=$_SESSION['offer_quantity'];
					unset($_SESSION['offer_quantity']);
					unset($_SESSION['donation_id']);
					}
					$donorquery="SELECT donor_id,displayname,preferred_email,address,village_town from donors WHERE donors.user_id=".$_SESSION['SESS_USER_ID'];
					$donorresult=mysql_query($donorquery);
					$donor_id = mysql_fetch_array($donorresult);
					$quantquery="SELECT * from kind_donations JOIN items ON kind_donations.item_id=items.item_id 
								JOIN project_partners ON kind_donations.partner_id=project_partners.partner_id 
								WHERE donation_id=".$_POST['id'];
					$quantity=mysql_fetch_array(mysql_query($quantquery));
				if(isset($_POST['offer_quantity']) ) {  
				?>
				<h3 align='center'>  Please confirm the below donation-commitment details.</h3>
					<form name="confirm_form" action="inkind_commit.php" method="POST">
						<table id="table-search" align='center'>
						<th colspan='2'> Offer Committed  </th>
						<tr>
							<td> Request ID </td>
							<td> <?php echo $quantity['donation_id']; ?></td>
						</tr>
						<tr>
							<td> Item  </td>
							<td> <?php echo $quantity['donationitem']; ?> </td>
						</tr>
						<tr>
							<td> Purpose  </td>
							<td> <?php echo $quantity['note']; ?> </td>
						</tr>
						<tr>
							<td> Offer Quantity </td>
							<td>
								 <input type="text" value="<?php echo $_POST['offer_quantity']; ?>" name="commit_confirm" id="confirm_quantity" size="2" /><?php echo $quantity['units_type'] ?></td>
						</tr>
						<tr>
							<td> Requested By </td>
							<td> <?php echo $quantity['name']; ?></td>
						</tr>
						<tr>
							<td> Request Address</td>
							<td><?php echo $quantity['request_address'].", ".$quantity['request_city']; ?> </td>
						</tr>
						<tr>
							<td> Offer Address</td>
							<td><input type="text" name="address" value="<?php echo $donor_id['address']; ?>" id="offer_address" /></td>
						</tr>
						<tr>
							<td>Offer City</td>
							<td><input type="text" name="city" value="<?php echo $donor_id['village_town']; ?>" id="offer_city" /></td>
						</tr>
						<tr>
						<td colspan="3" align="center"><input type="submit" value="Confirm" id="confirm" />
						<input type="text" value="<?php echo $_POST['id']; ?>" name="id" hidden />
					
						</td>
						</tr>
						</table>
							</form>	
				<?php
				}
				elseif(isset($_POST['commit_confirm'])){
				
					if($quantity['request_quantity']>$_POST['commit_confirm']){
						$newquantity=$quantity['request_quantity'] - $_POST['commit_confirm'];
						$commitquery="UPDATE kind_donations SET donor_id='".$donor_id['donor_id']."',offer_address='".$_POST['address']."', offer_city='".$_POST['city']."', offer_quantity='".$_POST['commit_confirm']."',offer_date='".date("Y-m-d")."',status='Connected' WHERE donation_id='".$_POST['id']."'";					
						$newrequestquery="INSERT INTO kind_donations (sub_id, initiative_type, partner_id, item_id, units_type, request_quantity, request_address, request_city, request_date, request_expiry_date,status, transport, note) 
						SELECT sub_id, initiative_type, partner_id, item_id, units_type, $newquantity, request_address, request_city, request_date, request_expiry_date,status, transport,note from kind_donations
						WHERE donation_id=".$_POST['id'];
						mysql_query($newrequestquery);
					}
					elseif($quantity['request_quantity']<=$_POST['commit_confirm']){
						$commitquery="UPDATE kind_donations SET donor_id='".$donor_id['donor_id']."',offer_address='".$_POST['address']."',offer_city='".$_POST['city']."',offer_quantity='".$_POST['commit_confirm']."',offer_date='".date("Y-m-d")."',status='Connected' WHERE donation_id='".$_POST['id']."'";
					}
					if(mysql_query($commitquery)) {
						
						$eventquery="SELECT ep.event_id,tb.donation_id FROM event_participants ep
									JOIN ( SELECT donation_id,partner_id 
									FROM kind_donations WHERE donation_id = $quantity[donation_id]) tb
									ON ep.partner_id = tb.partner_id 
									JOIN events e ON ep.event_id = e.event_id 
									WHERE 
									DATEDIFF(CURDATE(),event_from_date) IN (-2,-1,0) 
									OR DATEDIFF(CURDATE(),event_to_date) IN (0,1,2) 
									OR (CURDATE() 
									BETWEEN event_from_date AND event_to_date)";
						$eventresult=mysql_query($eventquery);
						if(mysql_num_rows($eventresult)>0){
							$event_id=mysql_fetch_array($eventresult);
							$equery="INSERT INTO event_link (event_id,donation_id,donation_type) VALUES ($event_id[event_id],$quantity[donation_id],'In-Kind')";
							mysql_query($equery);
						}
						echo "<h3 align='center'> 
						Thank you $_SESSION[SESS_DISPLAYNAME], your commitment has 
						been recieved. We will contact you soon.</h3>";
						$table="<table style='padding:5px;margin:5px;border-collapse:
						collapse;' border='1'>
						<th colspan='2'> Offer Made! </th>
						<tr>
							<td> Request ID </td>
							<td> $quantity[donation_id]</td>
						</tr>
						<tr>
							<td> Item  </td>
							<td> $quantity[donationitem] </td>
						</tr>
						<tr>
							<td> Purpose  </td>
							<td> $quantity[note]</td>
						</tr>
						<tr>
							<td> Offer Quantity </td>
							<td> $_POST[commit_confirm] $quantity[units_type]</td>
						</tr>
						<tr>
							<td> Requested By </td>
							<td> $quantity[name]</td>
						</tr>
						<tr>
							<td> Request Address </td>
							<td> $quantity[request_address], $quantity[request_city] </td>
						</tr>";
						echo $table;
						 include "Email/sendemail.php";
						$paramsngo=
						array(
						$email=$quantity['partner_email'],
						$subject="Ackowledgement - Donation offer made",
						$displayname=$quantity['contact_first_name']." ".$quantity['contact_last_name'],
						$mailtext="We wish to inform you that the following In-Kind Donation request made on $quantity[request_date] on UC site www.yousee.in has received a commitment from a Donor today. You may now connect with the Donor to receive the In-Kind donation material. On delivery of the material, please do update its status in NGO account on UC website.
You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table."<tr>
							<td> Offered By </td>
							<td> $donor_id[displayname] </td>
						</tr>
						<tr>
							<td> Offer City </td>
							<td> $_POST[city] </td>
						</tr>
						<tr>
							<td> Donor Email </td>
							<td> $donor_id[preferred_email] </td>
						</tr>
						</table>",
						);
						call_user_func_array('sendEmail',$paramsngo);
						$paramsdonor=
						array(
						$email=$donor_id['preferred_email'],
						$subject="Ackowledgement - Donation offer made",
						$displayname=$donor_id['displayname'],
						$mailtext="We would like to thank you for making an offer to the following In-Kind Donation request on UC site www.yousee.in . You may now connect with the NPO to send the In-Kind donation material.
You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table."
						<tr>
							<td> NPO Email </td>
							<td> $quantity[partner_email] </td>
						</tr></table>",
						);
						call_user_func_array('sendEmail',$paramsdonor);
						echo "</table>";
					?>
					<!-- Google Code for Donation commitment Conversion Page -->
					<script type="text/javascript">
					/* <![CDATA[ */
					var google_conversion_id = 1017317607;
					var google_conversion_language = "en";
					var google_conversion_format = "1";
					var google_conversion_color = "ffffff";
					var google_conversion_label = "GmiWCLnR0AQQ55GM5QM";
					var google_conversion_value = 0;
					/* ]]> */
					</script>
					<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
					</script>
					<noscript>
					<div style="display:inline;">
					<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1017317607/?value=0&amp;label=GmiWCLnR0AQQ55GM5QM&amp;guid=ON&amp;script=0"/>
					</div>
					</noscript>
<?php
					}
				}
			}
						

						/* If an NGO commits to an offer. */
				if(($_SESSION['SESS_USER_TYPE']=="N")){
							if(isset($_POST['offer_quantity'])){echo "Only donors can make offers."; exit();}

					if(isset($_SESSION['donation_id']) && isset($_SESSION['request_quantity'])){
					$_POST['id']=$_SESSION['donation_id'];
					$_POST['request_quantity']=$_SESSION['request_quantity'];
					unset($_SESSION['request_quantity']);
					unset($_SESSION['donation_id']);
					}
							$ngoquery="SELECT partner_id,name,contact_first_name,contact_last_name,website_url,partner_email,address,hq_town_city from project_partners WHERE project_partners.user_id=".$_SESSION['SESS_USER_ID'];
					$ngoresult=mysql_query($ngoquery);
					$ngo_id = mysql_fetch_array($ngoresult);
					$ngoname=$ngo_id['contact_first_name']." ".$ngo_id['contact_last_name'];
					$quantquery="SELECT * from kind_donations JOIN items ON kind_donations.item_id=items.item_id 
								JOIN donors ON kind_donations.donor_id=donors.donor_id 
								WHERE donation_id=".$_POST['id'];
					$quantity=mysql_fetch_array(mysql_query($quantquery));
					if(isset($_POST['request_quantity']) ) {  
				?>
				<h3 align='center'> Please confirm the below donation-request details.</h3>
						<table id="table-search" align='center'>
						<th colspan='2'> Request Committed  </th>
						<tr>
							<td> Offer ID </td>
							<td> <?php echo $quantity['donation_id']; ?></td>
						</tr>
						<tr>
							<td> Item  </td>
							<td> <?php echo $quantity['donationitem']; ?> </td>
						</tr>
						<tr>
							<td> Purpose  </td>
							<td> <?php echo $quantity['note']; ?> </td>
						</tr>
						<tr>
							<td> Request Quantity </td>
							<td><form name="confirm_form" method="POST" action="/inkind_commit.php">
								<input type="text" value="<?php echo $_POST['request_quantity']; ?>" name="commit_confirm" id="confirm_quantity" size="2" /><?php echo $quantity['units_type']; ?></td>
						</tr>
						<tr>
							<td> Offered By </td>
							<td> <?php echo $quantity['displayname']; ?></td>
						</tr>
						<tr>
							<td> Offer Address</td>
							<td><?php echo $quantity['offer_address'].", ".$quantity['offer_city']; ?> </td>
						</tr>
						<tr>
							<td> Request Address</td>
							<td><input type="text" name="address" value="<?php echo $ngo_id['address']; ?>" id="request_address" /></td>
						</tr>
						<tr>
							<td>Request City</td>
							<td><input type="text" name="city" value="<?php echo $ngo_id['hq_town_city']; ?>" id="request_city" /></td>
						</tr>
						<tr>
						<td colspan="3" align="center"><input type="submit" value="Confirm" id="confirm" />
						<input type="text" value="<?php echo $_POST['id']; ?>" name="id" hidden />
						</form></td>
						</tr>
						</table>	
				<?php
				}
				elseif(isset($_POST['commit_confirm'])){
				
					if($quantity['offer_quantity']>$_POST['commit_confirm']){
						$newquantity=$quantity['offer_quantity'] - $_POST['commit_confirm'];
						$commitquery="UPDATE kind_donations SET partner_id='".$ngo_id['partner_id']."',request_address='".$_POST['address']."', request_city='".$_POST['city']."', request_quantity='".$_POST['commit_confirm']."',request_date='".date("Y-m-d")."',status='Connected' WHERE donation_id='".$_POST['id']."'";
						$newrequestquery="INSERT INTO kind_donations (sub_id, initiative_type, donor_id, item_id, units_type, offer_quantity, offer_address, offer_city, offer_date, offer_expiry_date,status, transport,note) 
						SELECT sub_id, initiative_type, donor_id, item_id, units_type, $newquantity, offer_address, offer_city, offer_date, offer_expiry_date,status, transport,note from kind_donations
						WHERE donation_id=".$_POST['id'];
						mysql_query($newrequestquery);
					}
					elseif($quantity['offer_quantity']<=$_POST['commit_confirm']){
						$commitquery="UPDATE kind_donations SET partner_id='".$ngo_id['partner_id']."',request_address='".$_POST['address']."', request_city='".$_POST['city']."',request_quantity='".$_POST['commit_confirm']."',request_date='".date("Y-m-d")."',status='Connected' WHERE donation_id='".$_POST['id']."'";
					}
					if(mysql_query($commitquery)) {
						$eventquery="SELECT ep.event_id,tb.donation_id FROM event_participants ep
									JOIN ( SELECT donation_id,partner_id 
									FROM kind_donations WHERE donation_id = $quantity[donation_id]) tb
									ON ep.partner_id = tb.partner_id 
									JOIN events e ON ep.event_id = e.event_id 
									WHERE 
									DATEDIFF(CURDATE(),event_from_date) IN (-2,-1,0) 
									OR DATEDIFF(CURDATE(),event_to_date) IN (0,1,2) 
									OR (CURDATE() 
									BETWEEN event_from_date AND event_to_date)";
						$eventresult=mysql_query($eventquery);
						if(mysql_num_rows($eventresult)>0){
							$event_id=mysql_fetch_array($eventresult);
							$equery="INSERT INTO event_link (event_id,donation_id,donation_type) VALUES ($event_id[event_id],$quantity[donation_id],'In-Kind')";
							mysql_query($equery);
						}
						echo "<h3 align='center'> Thank you $_SESSION[SESS_DISPLAYNAME], your request has been recieved. We will contact you soon.</h3>";
						$table="<table style='padding:5px;margin:5px;border-collapse:collapse;' border='1'>
						<th colspan='2'> Request Made! </th>
						<tr>
							<td> Offer ID </td>
							<td> $quantity[donation_id]</td>
						</tr>
						<tr>
							<td> Item  </td>
							<td> $quantity[donationitem] </td>
						</tr>
						<tr>
							<td> Purpose  </td>
							<td> $quantity[note] </td>
						</tr>
						<tr>
							<td> Request Quantity </td>
							<td> $_POST[commit_confirm] $quantity[units_type]</td>
						</tr>
						<tr>
							<td> Offered By </td>
							<td> $quantity[displayname]</td>
						</tr>
						<tr>
							<td> Offer Address </td>
							<td> $quantity[offer_address], $quantity[offer_city] </td>
						</tr>
						<tr>
							<td> Requested by </td>
							<td> $ngo_id[name]</td>
						</tr>
						<tr>
							<td> Request Address </td>
							<td> $_POST[address], $_POST[city] </td>
						</tr>
						";
						echo $table;
						 include "Email/sendemail.php";
						$paramsdonor=
						array(
						$email=$quantity['preferred_email'],
						$subject="Ackowledgement - Donation request made",
						$displayname=$quantity['displayname'],
						$mailtext="We wish to inform you that the following In-Kind Donation offer made on $quantity[offer_date] on UC site www.yousee.in has received a request from <a href=\"$ngo_id[website_url]\">$ngo_id[name]</a> today. You may now connect with the NPO to send the In-Kind donation material.
You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table."<tr>
							<td> NPO Email </td>
							<td> $ngo_id[partner_email] </td>
						</tr>
						</table>",
						);
						call_user_func_array('sendEmail',$paramsdonor);
						$paramsngo=
						array(
						$email=$ngo_id['partner_email'],
						$subject="Ackowledgement - Donation request made",
						$displayname=$ngoname,
						$mailtext="We wish to inform you that the following In-Kind Donation request has been recieved on UC site www.yousee.in . You may now connect with the donor to recieve the In-Kind donation material.
You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table."<tr>
							<td> Donor Email </td>
							<td> $quantity[preferred_email] </td>
						</tr></table>",
						);
						call_user_func_array('sendEmail',$paramsngo);
						echo "</table>";
					}
				}
			}
			
		}			
		?>
	</div>
	 <?php include 'footer.php' ; ?>
</div>
</BODY>
</HTML>
<?php
/* Change log

02-Jun-2013 - Vivek - Change of NGO name in email.

*/
?>	
