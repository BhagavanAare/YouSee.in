<?php $thispage = "registrationResult"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<?php include 'header_navbar.php';?>
<?php 


	include("prod_conn.php");
	$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 	//establishes database connection
	if (!$con) // if connection fails
	{
  		die('Could not connect: ' . mysql_error()); // error is shown
  	}

 	mysql_select_db("$dbdatabase");


	
	$registrationType = $_POST['formName']; // formName contains a value 
	if($registrationType=="donorReg")
	{

		echo "donor";
		registerDonor();
		
		
	}
	elseif($registrationType="NGOReg")
	{
		echo "ngo";
		registerNGO();
	}
	
	echo "Your information is submitted, You will recieve a confirmation email from YouSee..";
	
	function registerDonor()
	{
		include("tableObjects/donorTable.php");

		//$insertUserQuery="INSERT INTO user($userInsertAtts) VALUES ('donor')";
		//die("user inserted , id=".$mysql_insert_id);
		include("tableObjects/userTable.php");		
		


		$userValues="'D','defaultUsername','defaultPassword','P'";
		$insertUserQuery="INSERT INTO users($userInsertAtts) VALUES($userValues)";

		if (!mysql_query($insertUserQuery))
		{
			//die('Error: ' . mysql_error());
			showError();
			exit();
		}
		
		
		
		include ("upload/uploadfile.php");
		$userid = mysql_insert_id();	
		//$imagePath="images/".$userid;
		$imagePath="image/";
		$defaultDisplayName=$_POST['fname']." ".$_POST['lname'];

		
		$donorValues="'".$_POST['type']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['dob']."','".$_POST['gender']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."','".$_POST['country']."','".$_POST['pincode']."','".$_POST['occupation']."','".$_POST['designation']."','".$_POST['phno']."','".$_POST['personalEmail']."','".$_POST['officialEmail']."','".$_POST['preferredEmail']."','".$_POST['pan']."','".$_POST['featurePermission']."','".$_POST['featureQuote']."','".$defaultDisplayName."','".$imagePath."','".$_POST['orgName']."','".$_POST['orgType']."','".$_POST['orgDesc']."','".$userid."'";
		
		
		
		$insertDonorQuery="INSERT INTO donors($donorInsertAtts) VALUES($donorValues)";
		
		//echo "".$donorValues;
		if (!mysql_query($insertDonorQuery))
  		{
  			//die('Error: ' . mysql_error());
			showError();
			exit();
  		}
	}
	
	function registerNGO()
	{
		include("tableObjects/userTable.php");		
		
		
		include("tableObjects/userTable.php");		
		
		$userValues="'N','defaultUsername','defaultPassword','P'";
		$insertUserQuery="INSERT INTO users($userInsertAtts) VALUES($userValues)";

		if (!mysql_query($insertUserQuery))
		{
			die('Error: ' . mysql_error());
			showError();
			exit();
		}
		
		
		
		include ("upload/uploadfile.php");
		$userid = mysql_insert_id();	

		


		$userValues="'D','defaultUsername','defaultPassword','P'";
		$insertUserQuery="INSERT INTO users($userInsertAtts) VALUES($userValues)";
		if (!mysql_query($insertUserQuery))
		{
			die('Error: ' . mysql_error());
			showError();
			exit();
			
		}

		$sql = "INSERT INTO project_partners(name, type, partner_email, address, hq_town_city, hq_state, hq_country, hq_pin_code, contact_first_name, contact_last_name, contact_person_gender, contact_person_designation, contact_person_phone, contact_person_email, website_url,user_id) VALUES ('$_POST[partnerName]', '$_POST[partnerType]', '$_POST[partnerEmailId]', '$_POST[address]', '$_POST[hqcity]', '$_POST[hqstate]', '$_POST[hqcountry]', '$_POST[hqpincode]', '$_POST[fname]', '$_POST[lname]', '$_POST[gender]', '$_POST[designation]', '$_POST[phno]', '$_POST[personalEmail]', '$_POST[website]','$userid')";
				//$sql = "INSERT INTO project_partners(name, type, partner_email, hq_town_city, hq_state, hq_country, hq_pin_code, contact_first_name, contact_last_name, contact_person_gender, contact_person_designation, contact_person_email) VALUES ('$_POST[partnerName]', '$_POST[partnerType]', '$_POST[partnerEmailId]', '$_POST[hqcity]', '$_POST[hqstate]', '$_POST[hqcountry]', '$_POST[hqpincode]', '$_POST[fname]', '$_POST[lname]', '$_POST[gender]', '$_POST[designation]', '$_POST[personalEmail]')";
		

  		if (!mysql_query($sql))
  		{
  			die('Error: ' . mysql_error());
			showError();
			exit();
  		}
	}
	function showError()
	{
		echo "Registration failed.. Please re-submit Information..";
	}
	
?>
<div style="position:absolute; bottom:0; width:100%">
<?php include 'footer.php' ; ?>
</div>
</body>
</html>