<?php $thispage = "registrationResult"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/table.css">
</head>

<body>
<?php include 'header_navbar.php';?>
<?php
$string; // Information of Registration  


include_once("prod_conn.php");
$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 	//establishes database connection
if (!$con) // if connection fails
{
	die('Could not connect: ' . mysql_error()); // error is shown
}

mysql_select_db("$dbdatabase");



$registrationType = $_POST['formName']; // formName contains a value
$defaultUsername;
$userid;

if($registrationType=="donorReg")
{

	//echo "donor";
	if($_POST['preferredEmail']=="P")
	$defaultUsername=$_POST['personalEmail'];
	elseif($_POST['preferredEmail']=="O")
	$defaultUsername=$_POST['officialEmail'];

	registerDonor();


}
elseif($registrationType="NGOReg")
{
	//echo "ngo";
	$defaultUsername=$_POST['partnerEmailId'];
	registerNGO();
}

echo "Your information is submitted, You will recieve a confirmation email from YouSee..";
function sendEmail($email,$displayName)
{
	global $string;
	include_once ("Email/class.phpmailer.php");
	include 'Email/config.php';
	try{
		$to = $email;
		$mail->AddAddress($to);
		$mail->AddBCC("gunaranjan@yousee.in");
		$subject= "Acknowledgement-Information Submission";

		$body =  "Dear  " .$displayName. "<br><br>

			This is to acknowldge that we have received information submitted by you as shown below.We 					shall reply to you again on the completion of registration.You may reply to this email or call +91-8008-884422 for any futher information you may like to have from UC (www.yousee.in).";
		$body.=$string;
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






//----------------------------------------------------------------------------------------------------
function registerDonor()
{
	global $defaultDisplayName,$defaultUsername;
	include("tableObjects/donorTable.php");

	//$insertUserQuery="INSERT INTO user($userInsertAtts) VALUES ('donor')";
	//die("user inserted , id=".$mysql_insert_id);
	include("tableObjects/userTable.php");



	$userValues="'D','$defaultUsername','defaultPassword','P'";
	$insertUserQuery="INSERT INTO users($userInsertAtts) VALUES($userValues)";

	if (!mysql_query($insertUserQuery))
	{
		//die('Error: ' . mysql_error());
		showError();
		exit();
	}




	$userid = mysql_insert_id();
	$imagePath="images/".$userid;
	$imagePath="image/";
	//header('Content-Type:image/jpeg');
	//file_put_contents('umages/.jpg');
	//include ("upload/uploadfile.php");
	$defaultDisplayName=$_POST['fname']." ".$_POST['lname'];


	$donorValues="'".$_POST['type']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['dob']."','".$_POST['gender']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."','".$_POST['country']."','".$_POST['pincode']."','".$_POST['occupation']."','".$_POST['designation']."','".$_POST['phno']."','".$_POST['personalEmail']."','".$_POST['officialEmail']."','".$_POST['preferredEmail']."','".$_POST['pan']."','".$_POST['featurePermission']."','".$_POST['featureQuote']."','".$defaultDisplayName."','".$imagePath."','".$_POST['orgName']."','".$_POST['orgType']."','".$_POST['orgDesc']."','".$userid."'";



	$insertDonorQuery="INSERT INTO donors($donorInsertAtts) VALUES($donorValues)";

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

function registerNGO()
{
	global $defaultUsername,$userid,$defaultDisplayName;
	include("tableObjects/userTable.php");


	include("tableObjects/userTable.php");




	//include ("upload/uploadfile.php");





	$userValues="'D','".$defaultUsername."','defaultPassword','P'";
	$insertUserQuery="INSERT INTO users($userInsertAtts) VALUES($userValues)";
	if (!mysql_query($insertUserQuery))
	{
		die('Error: ngo ' . mysql_error());
		showError();
		exit();
			
	}

	$defaultDisplayName=$_POST['fname']." ".$_POST['lname'];

	$userid = mysql_insert_id();

	$sql = "INSERT INTO project_partners(name, type, partner_email, address, hq_town_city, hq_state, hq_country, hq_pin_code, contact_first_name, contact_last_name, contact_person_gender, contact_person_designation, contact_person_phone, contact_person_email, website_url,user_id) VALUES ('$_POST[partnerName]', '$_POST[partnerType]', '$_POST[partnerEmailId]', '$_POST[address]', '$_POST[hqcity]', '$_POST[hqstate]', '$_POST[hqcountry]', '$_POST[hqpincode]', '$_POST[fname]', '$_POST[lname]', '$_POST[gender]', '$_POST[designation]', '$_POST[phno]', '$_POST[personalEmail]', '$_POST[website]','".$userid."')";


	if (!mysql_query($sql))
	{
		die('Error: ' . mysql_error());
		showError();
		exit();
	}
	buildNgoTable();
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
    <td>Registration For</td>
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
    <td>Personal Email ID</td>
    <td>  ".$_POST['personalEmail']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Official Email ID</td>
    <td> ".$_POST['officialEmail']." </td>
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

function buildNgoTable()
{ 
	global $string;
$string  = "<div style=\"position: absolute; bottom: 0; width: 100%\">
  
</div>
<br /><br /><span style=\"margin-left:50px\"><b>Information Submitted</b></span>
<br /><br />
<table style=\"border-collapse:collapse;\" border=\"0\" bordercolor=\"#999999\">
	<tr style=\"background-color:#CCCFFF;\">
    <td>Organisation Name</td>
    <td> ".$_POST['partnerName']." </td>
  </tr>
  <tr >
    <td>Organisation Type</td>
    <td> ". $_POST['partnerType']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Partner Website URL</td>
    <td> ".$_POST['website']." </td>
  </tr >
    <tr >
    <td>Partner Email ID</td>
    <td>  ".$_POST['partnerEmailId']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>HQ City</td>
    <td>  ".$_POST['hqcity'] ."</td>
  </tr>
  <tr >
    <td>HQ State</td>
    <td>  ".$_POST['hqstate']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>HQ Country</td>
    <td> ".$_POST['hqcountry']." </td>
  </tr>
  <tr >
    <td>Contact Person First Name</td>
    <td> ".$_POST['fname']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Contact Person Last Name</td>
    <td> ".$_POST['lname']." </td>
  </tr>
  <tr >
    <td>Contact Person Phone Number</td>
    <td> ".$_POST['phno']." </td>
  </tr >

</table>";


} 
?>

<br />
<br />

<?php include 'footer.php' ; ?>
</body>
</html>
