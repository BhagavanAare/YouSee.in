<?php
$thispage="inkind_exec";
session_start();
if(isset($_POST['username'])&&isset($_POST['password'])){
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



//Create query
$query="SELECT * FROM users WHERE username='$username' AND password='$password'";

$result=mysql_query($query);
//Check whether the query was successful or not
if ($result) {
	if(mysql_num_rows($result) == 1) {
		//Login Successful
		session_regenerate_id();
		$user = mysql_fetch_assoc($result);
		if($user['user_type_id']=='N' && isset($_POST['offer_quantity'])){
									
									
						$_SESSION['donation_id']=$_POST['id'];
						$_SESSION['offer_quantity']=$_POST['offer_quantity'];
						header("Location: /inkind_commit.php");
				echo "<div id='msg'>You need to be logged in as a donor to make an offer.</div>";
				exit();
		}
		if($user['user_type_id']=='D' && isset($_POST['request_quantity'])){
									include "header_navbar.php";
									
						$_SESSION['donation_id']=$_POST['id'];
						$_SESSION['request_quantity']=$_POST['request_quantity'];
						header("Location: /inkind_commit.php");
				echo
				 "<div id='msg'>You need to be logged in as an NGO to make a request.</div>";
				exit();
		}
		if($user['user_type_id']=='A'){
									
						$_SESSION['donation_id']=$_POST['id'];
						$_SESSION['request_quantity']=$_POST['request_quantity'];
						
						header("Location: /inkind_commit.php");
				exit();
		}
		
		
		$_SESSION['SESS_USER_ID'] = $user['user_id'];
		$_SESSION['SESS_USER_TYPE'] = $user['user_type_id'];
		$_SESSION['SESS_USERNAME'] = $user['username'];
	
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
						$_SESSION['donation_id']=$_POST['id'];
						$_SESSION['offer_quantity']=$_POST['offer_quantity'];
							session_write_close();
						
						header("Location: /inkind_commit.php");
			}
					
		}

	}
	if ($_SESSION['SESS_USER_TYPE'] == "N")
	{
		$query = "SELECT name, partner_id
          				FROM project_partners
          				WHERE user_id=".$_SESSION['SESS_USER_ID'];
		$result=mysql_query($query);
		if ($result)
		{
			if(mysql_num_rows($result) == 1)
			{
				$partner = mysql_fetch_assoc($result);
				$_SESSION['SESS_NGO_ID'] = $partner['donor_id'];
				$_SESSION['SESS_DISPLAYNAME'] = $partner['name'];
						$_SESSION['donation_id']=$_POST['id'];
						$_SESSION['request_quantity']=$_POST['request_quantity'];
							session_write_close();
						
						header("Location: /inkind_commit.php");
			}
					
		}

	}
				exit();
}
	else 
	{
						$_SESSION['donation_id']=$_POST['id'];
						if(isset($_POST['offer_quantity']))
						$_SESSION['offer_quantity']=$_POST['offer_quantity'];
						elseif(isset($_POST['request_quantity']))
						$_SESSION['request_quantity']=$_POST['request_quantity'];
		//Login failed
		header("location: login_failed.php");
		exit();
	}
}else {
						$_SESSION['donation_id']=$_POST['id'];
						if(isset($_POST['offer_quantity']))
						$_SESSION['offer_quantity']=$_POST['offer_quantity'];
						elseif(isset($_POST['request_quantity']))
						$_SESSION['request_quantity']=$_POST['request_quantity'];
						die("Query failed");
						
						header("Location: /inkind_commit.php");
}
}


elseif(isset($_POST['preferredEmail'])){
	echo "hello";
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
				$_SESSION['donation_id']=$_POST['id'];
				$_SESSION['offer_quantity']=$_POST['offer_quantity'];
				session_write_close();
				header("Location: /inkind_commit.php");

						}
					
		}
	}
				exit();
	}
	else 
	{				
				$_SESSION['donation_id']=$_POST['id'];
				$_SESSION['offer_quantity']=$_POST['offer_quantity'];
				echo "Error occured, Please retry";
		exit();
	}
}else {
				include "header_navbar.php";				
				$_SESSION['donation_id']=$_POST['id'];
				$_SESSION['offer_quantity']=$_POST['offer_quantity'];
	die("Query failed");
}

}
else {
						$_SESSION['donation_id']=$_POST['id'];
						if(isset($_POST['offer_quantity']))
						$_SESSION['offer_quantity']=$_POST['offer_quantity'];
						elseif(isset($_POST['request_quantity']))
						$_SESSION['request_quantity']=$_POST['request_quantity'];
	}
	
	
	/*******************************Functions***************************/
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
    <td>Registered As</td>
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
    <td>Alternate Email ID</td>
    <td> ".$_POST['alternateEmail']." </td>
  </tr>
  <tr >
    <td>State</td>
    <td> ".$_POST['state']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Country</td>
    <td> ".$_POST['country']." </td>
  </tr>
  <tr >
    <td>Organisation Name</td>
    <td> ".$_POST['orgName']." </td>
  </tr >
  <tr style=\"background-color:#CCCFFF;\">
    <td>Organisation Type</td>
    <td> ".$_POST['orgType']." </td>
  </tr >
</table>";


} 
function sendEmail($email,$displayName)
{
	global $string, $mailText;
	require_once ("Email/class.phpmailer.php");
	require_once 'Email/config.php';
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
			;
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
