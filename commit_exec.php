<?php
session_start();
if(isset($_POST['Submit'])){
//Start session
//Include database connection details
include('prod_conn.php');
//Array to store validation errors
$errmsg_arr = array();
//Validation error flag
$errflag = false;
//Connect to mysql server
$link = mysql_connect("$dbhost","$dbuser","$dbpass");
if(!$link) {
	die('Failed to connect to server: ' . mysql_error());
}
//Select database
$db = mysql_select_db("$dbdatabase");
if(!$db) {
	die("Unable to select database");
}

//Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
	$str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}

//Sanitize the POST values
$username = clean($_POST['username']);
$password = md5(clean($_POST['password']));

//Input Validations
if($username == '') {
	$errmsg_arr[] = 'Username missing';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}

//If there are input validations, redirect back to the login form
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: login-form.php");
	exit();
}

//Create query
$query="SELECT * FROM users WHERE username='$username' AND password='$password'";

$result=mysql_query($query);
//Check whether the query was successful or not
if ($result) {
	if(mysql_num_rows($result) == 1) {
		//Login Successful
		session_regenerate_id();
		$user = mysql_fetch_assoc($result);
		$_SESSION['SESS_USER_ID'] = $user['user_id'];
		$_SESSION['SESS_USER_TYPE'] = $user['user_type_id'];
		$_SESSION['SESS_USERNAME'] = $user['username'];
		if($_SESSION['SESS_USER_TYPE']=='N' || $_SESSION['SESS_USER_TYPE']=='A'){
			header('Location:donate_time.php');
			}
		//if($result['regStatus']=="A")
		// this section generates query for donor info
$usersquery = "SELECT *
          FROM users
          WHERE user_id=".$_SESSION['SESS_USER_ID'];
$usersresult=mysql_query($usersquery);		 
		$row=mysql_fetch_array($usersresult);
$replace_date="UPDATE users SET past_login_time='$row[present_login_time]', past_login_date='$row[present_login_date]'
			WHERE user_id='$_SESSION[SESS_USER_ID]'";
$replace = mysql_query($replace_date);

date_default_timezone_set('Asia/Kolkata');
$date=date('y-m-d'); 
$time=date('H:i:s');
			$update_users = "UPDATE users SET present_login_time='$time', present_login_date='$date'
			WHERE user_id='$_SESSION[SESS_USER_ID]'";
			$update = mysql_query($update_users);	
			$donorquery="SELECT donor_id from donors WHERE donors.user_id=".$_SESSION['SESS_USER_ID'];
				$donorresult=mysql_query($donorquery);
				$donor_id = mysql_fetch_array($donorresult);
	if ($_SESSION['SESS_USER_TYPE'] == "D")
	{
	
		$query = "SELECT displayname, donor_id
          				FROM donors
          				WHERE user_id=".$_SESSION['SESS_USER_ID'];
		$result=mysql_query($query);
		if ($result)
		{
			if(mysql_num_rows($result) == 1)
			{
				$donor = mysql_fetch_assoc($result);
				$_SESSION['SESS_DONOR_ID'] = $donor['donor_id'];
				$_SESSION['SESS_DISPLAYNAME'] = $donor['displayname'];
							session_write_close();

				
			}
					
		}
	}
				foreach($_SESSION['opp_id'] as $opp){
				$commitquery="INSERT INTO volunteer_commits(opportunity_id,donor_id) values ('$opp','$donor_id[donor_id]')";
				mysql_query($commitquery);
				}

	commit_mail($_SESSION['SESS_USERNAME'],$_SESSION['SESS_DISPLAYNAME']);
	header('Location: donate_time.php?commit='.$_POST['activity_id']);
				exit();
	}
	else 
	{
		//Login failed
		header("location: login_failed.php");
		exit();
	}
}else {
	die("Query failed");
}
}
function setRequiredInfo()
{
	if ($_SESSION['SESS_USER_TYPE'] == "D")
	{
	
		$query = "SELECT displayname, donor_id
          				FROM donors
          				WHERE user_id=".$_SESSION['SESS_USER_ID'];
		$result=mysql_query($query);
		if ($result)
		{
			if(mysql_num_rows($result) == 1)
			{
				$donor = mysql_fetch_assoc($result);
				$_SESSION['SESS_DONOR_ID'] = $donor['donor_id'];
				$_SESSION['SESS_DISPLAYNAME'] = $donor['displayname'];
				
			}
					
		}
	}
	if ($_SESSION['SESS_USER_TYPE'] == "N")
	{
		$query = "SELECT name
          				FROM project_partners
          				WHERE user_id=".$_SESSION['SESS_USER_ID'];
		$result=mysql_query($query);
		if ($result)
		{
			if(mysql_num_rows($result) == 1)
			{
				$ngo = mysql_fetch_assoc($result);
				$_SESSION['SESS_DISPLAYNAME'] = $ngo['name'];
				session_write_close();
			}
		}
	}
	if ($_SESSION['SESS_USER_TYPE'] == "A")
	{
		$_SESSION['SESS_DISPLAYNAME'] = $user['username'];
	}
}
?>
<?php
$string; // Information of Registration  
if(isset($_SESSION['POST']))
{
$_POST=$_SESSION['POST'];
unset($_SESSION['POST']);
require_once("prod_conn.php");
$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 	//establishes database connection
if (!$con) // if connection fails
{
	die('Could not connect: ' . mysql_error()); // error is shown
}

mysql_select_db("$dbdatabase");

	//echo "donor";
	$defaultUsername=$_POST['preferredEmail'];
	$mailText="This is to acknowledge that we have received information submitted by you as shown below and we thank you for Registering at <a href=\"www.yousee.in\">YouSee</a>. <br /><br />You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a>";
	registerDonor();
	$username=$defaultUsername;
	$password=md5($_POST['password']);
	$query="SELECT * FROM users WHERE username='$username' AND password='$password'";

	$result=mysql_query($query);
	//Check whether the query was successful or not
	if ($result) {
		if(mysql_num_rows($result) == 1) {
		//Login Successful
		session_regenerate_id();
		$user = mysql_fetch_assoc($result);
		$_SESSION['SESS_USER_ID'] = $user['user_id'];
		$_SESSION['SESS_USER_TYPE'] = $user['user_type_id'];
		$_SESSION['SESS_USERNAME'] = $user['username'];
		if($_SESSION['SESS_USER_TYPE']=='N' || $_SESSION['SESS_USER_TYPE']=='A'){
			header('Location:donate_time.php');
			}
		//if($result['regStatus']=="A")
		// this section generates query for donor info
$usersquery = "SELECT *
          FROM users
          WHERE user_id=".$_SESSION['SESS_USER_ID'];
$usersresult=mysql_query($usersquery);		 
		$row=mysql_fetch_array($usersresult);
$replace_date="UPDATE users SET past_login_time='$row[present_login_time]', past_login_date='$row[present_login_date]'
			WHERE user_id='$_SESSION[SESS_USER_ID]'";
$replace = mysql_query($replace_date);

date_default_timezone_set('Asia/Kolkata');
$date=date('y-m-d'); 
$time=date('H:i:s');
			$update_users = "UPDATE users SET present_login_time='$time', present_login_date='$date'
			WHERE user_id='$_SESSION[SESS_USER_ID]'";
			$update = mysql_query($update_users);	
			$donorquery="SELECT donor_id from donors WHERE donors.user_id=".$_SESSION['SESS_USER_ID'];
				$donorresult=mysql_query($donorquery);
				$donor_id = mysql_fetch_array($donorresult);
				foreach($_SESSION['opp_id'] as $opp){
				$commitquery="INSERT INTO volunteer_commits(opportunity_id,donor_id) values ('$opp','$donor_id[donor_id]')";
				mysql_query($commitquery);
				}
	if ($_SESSION['SESS_USER_TYPE'] == "D")
	{
	
		$query = "SELECT displayname, donor_id
          				FROM donors
          				WHERE user_id=".$_SESSION['SESS_USER_ID'];
		$result=mysql_query($query);
		if ($result)
		{
			if(mysql_num_rows($result) == 1)
			{
				$donor = mysql_fetch_assoc($result);
				$_SESSION['SESS_DONOR_ID'] = $donor['donor_id'];
				$_SESSION['SESS_DISPLAYNAME'] = $donor['displayname'];
							session_write_close();

				
			}
					
		}
	}
	commit_mail($_SESSION['SESS_USERNAME'],$_SESSION['SESS_DISPLAYNAME']);
	header('Location: donate_time.php?commit='.$_POST['activity_id'].'&gawt=1');
	exit();
	}
	else 
	{
		//Login failed
		header("location: login_failed.php");
		exit();
	}
}else {
	die("Query failed");
}

echo "Your information is submitted. You will recieve a confirmation email from YouSee.";
}
function sendEmail($email,$displayName)
{
	global $string, $mailText;
	require_once "Email/class.phpmailer.php";
	include 'Email/config.php';
	try{
		$to = $email;
		$mail->AddAddress($to);
		$mail->AddBCC("contact@yousee.in");
		$subject= "Acknowledgement-Information Submission";

		$body =  "Dear  " .$displayName. ",<br><br>".$mailText;
		$body.=$string;
		$body.="<br><br><br> From YouSee  (+91-8008-884422) <br /> <a href=\"www.yousee.in\">www.yousee.in</a>";
		$mail->Subject = $subject;
		$mail->Body = $body;
		if($mail->Send())
		{
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
			$mail->ClearCustomHeaders();
		}
		else{
			echo "<script>alert('email failed');</script>";
			$mail->ErrorInfo;
			showError();
		}
	}
	catch (phpmailerException $e) {
		echo $e->errorMessage();
		echo "<script>alert('Message failed');</script>";
		//showError();
	}
}






//----------------------------------------------------------------------------------------------------
function registerDonor()
{
	global $defaultDisplayName,$defaultUsername;
	include("tableObjects/donorTable.php");

	//$insertUserQuery="INSERT INTO user($userInsertAtts) VALUES ('donor')";
	//die("user inserted , id=".$mysql_insert_id);
	include("tableObjects/userTable.php");
include("prod_conn.php");
$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 
mysql_select_db("$dbdatabase");
	$insertUserQuery="INSERT INTO users(user_type_id,username,password,registration_status) VALUES('D','$_POST[preferredEmail]','".md5($_POST['password'])."','A')";
	//echo $insertUserQuery;
	if (!mysql_query($insertUserQuery))
	{
		//die('Error: ' . mysql_error());
		echo "Error";
		showError();
		exit();
	}




	$userid = mysql_insert_id();
	
	$imagePath="images/".$userid;
	$imagePath="image/";
	//header('Content-Type:image/jpeg');
	//file_put_contents('umages/.jpg');
	//include ("upload/uploadfile.php");
	
	/* Capitalize first letter of a word in Strings*/
	$_POST['fname']=ucwords($_POST['fname']);
	$_POST['lname']=ucwords($_POST['lname']);
	$_POST['state']=ucwords($_POST['state']);
	$_POST['country']=ucwords($_POST['country']);
	$_POST['orgName']=ucwords($_POST['orgName']);
	
	$defaultDisplayName=$_POST['fname']." ".$_POST['lname']; //Sets Display Name
	$_POST['featurePermission']="N";
	if(isset($_POST['dob']))
	{
		$_POST['dob']=date_format(new DateTime($_POST['dob']),'Y-m-d');
	}
	$insertDonorQuery="INSERT INTO donors(first_name,last_name,gender,displayname,type_of_donor,dob,village_town,state,country,mobile_phone_no,preferred_email,org_grp_name,org_grp_type,org_grp_description,user_id) 
						VALUES('$_POST[fname]','$_POST[lname]','$_POST[gender]','$defaultDisplayName','$_POST[type]','$_POST[dob]','$_POST[city]','$_POST[state]','$_POST[country]','$_POST[phno]','$_POST[preferredEmail]','$_POST[orgName]','$_POST[orgType]','$_POST[orgDesc]','$userid')";
	//echo $insertDonorQuery;
	buildDonorTable();

	//echo "".$donorValues;
	if (!mysql_query($insertDonorQuery))
	{
		//die('Error: ' . mysql_error());
		showError();
		exit();
	}


	sendEmail($defaultUsername,$defaultDisplayName);
}



function showError()
{
	echo "Registration failed.. Please re-submit Information..";
}

function buildDonorTable()
{ 
	global $string;
$string  = "<div style=\"position: absolute; bottom: 0; width: 100%\">
  
</div>
<br /><br /><span style=\"margin-left:50px\"><b>Information Submitted</b></span>
<br /><br />
<table style=\"border-collapse:collapse;\" border=\"0\" bordercolor=\"#999999\">
	<tr style=\"background-color:#CCCFFF;\">
    <td>First Name</td>
    <td> ".$_POST['fname']." </td>
  </tr>
  <tr >
    <td>Last Name</td>
    <td> ". $_POST['lname']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Registered as</td>
    <td>  ".$_POST['type']." </td>
  </tr>
  <tr >
    <td>Gender</td>
    <td>  ".$_POST['gender']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Contact Number</td>
    <td>  ".$_POST['phno'] ."</td>
  </tr>
  <tr >
    <td>Email/Username</td>
    <td>  ".$_POST['preferredEmail']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>State</td>
    <td> ".$_POST['state']." </td>
  </tr>
  <tr >
    <td>Country</td>
    <td> ".$_POST['country']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Organisation Name</td>
    <td> ".$_POST['orgName']." </td>
  </tr >
  <tr >
    <td>Organisation Type</td>
    <td> ".$_POST['orgType']." </td>
  </tr >
</table>";
} 

function commit_mail($email,$displayName)
{		
	global $commit_msg, $commit_mail_text;
	$commit_mail_text.="<p>Thank you for committing to volunteer for the below mentioned activity on <a href='www.yousee.in/donate_time.php'>YouSee</a> website. We look forward to your support and participation. Please do call us or write to us for any further information you may like to have regarding this activity. </p><br />";
	require_once "Email/class.phpmailer.php";
	include 'Email/config.php';
	include('prod_conn.php');

$link = mysql_connect("$dbhost","$dbuser","$dbpass");
if(!$link) {
	die('Failed to connect to server: ' . mysql_error());
}
//Select database
$db = mysql_select_db("$dbdatabase");
if(!$db) {
	die("Unable to select database");
}
			$act_query="SELECT * from volunteering_activity va 
			JOIN project_partners p on va.partner_id=p.partner_id 
			JOIN volunteering_opportunities vo ON va.activity_id=vo.activity_id 
			WHERE va.activity_id=".$_POST['activity_id']." GROUP BY va.activity_id";
			$act_result=mysql_query($act_query);
			while($row=mysql_fetch_array($act_result)){
				$commit_msg.="<table style='font-color:black;width:100%;border:1px solid black;border-radius:5px;padding:10px;background-color:#eee;'>
					<tr><td><h3>".$row['activity']."</h3></td></tr>
					<tr><td>".$row['activity_details']." </td></tr>
					<tr><td><h4>Organized by : <a href='".$row['website_url']."'>".$row['name']."</a></h4></td></tr></table><br /><br /><h4>Schedule</h4><table style='width:100%;font-color:black;border:1px solid black;background-color:#eee;'>";
					$mail->AddBCC($row['partner_email']);
					}
			$oppr_query="SELECT * from volunteer_commits vc 
			JOIN volunteering_opportunities vo ON vc.opportunity_id=vo.opportunity_id
			JOIN volunteering_activity va ON vo.activity_id=va.activity_id
			WHERE va.activity_id=".$_POST['activity_id']." AND vc.donor_id=".$_SESSION['SESS_DONOR_ID']." GROUP BY vc.opportunity_id";
			$oppr_result=mysql_query($oppr_query);
			$commit_msg.="<th style='background-color:#ccc'>From Date</th><th style='background-color:#ccc'>To Date</th><th style='background-color:#ccc'>Timings</th><th style='background-color:#ccc'>Location</th><th style='background-color:#ccc'>City</th>";
			while($record=mysql_fetch_array($oppr_result)){
				$commit_msg.="
					<tr style='text-align:center;'><td>".$record['from_date']."</td>
					<td>".$record['to_date']."</td>
					<td>".$record['from_time']." - ".$record['to_time']."</td>
					<td>". $record['location']."</td>
					<td>". $record['city']."</td></tr>";
				}	
					$commit_msg.="</table>";
	try{
		$to = $email;
		$mail->AddBCC("contact@yousee.in");
		$mail->AddAddress($to);
		$subject= "Acknowledgement-Volunteering Commitment";

		$body =  "Dear  " .$displayName. ",<br><br>".$commit_mail_text;
		$body.=$commit_msg;
		$body.="<br><br><br> From YouSee  (+91-8008-884422) <br /> <a href=\"www.yousee.in\">www.yousee.in</a>";
		$mail->Subject = $subject;
		$mail->Body = $body;
		if($mail->Send())
		{
			$mail->ClearAllRecipients();
			$mail->ClearAttachments();
			$mail->ClearCustomHeaders();
		}
		else{
			echo "<script>alert('email failed');</script>";
			$mail->ErrorInfo;
			showError();
		}
	}
	catch (phpmailerException $e) {
		echo $e->errorMessage();
		echo "<script>alert('Message failed');</script>";
		//showError();
	}
} 

?>
<?php
/* Change log

02-Jun-2013 - Vivek - Password Encryption.

*/
?>	