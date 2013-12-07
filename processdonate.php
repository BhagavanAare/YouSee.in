<?php 
$thispage = "uccertificates"; ?>
<?php
//include("conn.php");
//echo $_SERVER['HTTP_X_FORWARDED_FOR'];
//$strResponseIPAdd = getenv('REMOTE_ADDR');
//echo $strResponseIPAdd;
//exit;
/* Check whether the IP Address from where response is received is PG IP */
//if($strResponseIPAdd != "70.39.176.68" && $strResponseIPAdd != "221.134.101.174" && $strResponseIPAdd != "221.134.101.169" && $strResponseIPAdd != "205.178.146.20" && $strResponseIPAdd != "198.64.129.10" && $strResponseIPAdd != "198.64.133.213"){
//echo "This page cannot be called from outside this environment.<BR>";
//echo "Please return to the <a href=\"http://www.yousee.in/donate.php\">donation page</a> and try again.";
//exit;
//}
include "login_auth.php";
 if($_SESSION['SESS_USER_TYPE']!="D"){
	echo "This page can only be accessed by donors";
	exit();
}

if(isset($_SERVER['HTTP_REFERER'])) {
    $refurl = $_SERVER['HTTP_REFERER'];
//|| $refurl != "http://www.yousee.in/donate.php";
    if ( ($refurl != "http://www.yousee.in/donate.php") && ($refurl != "http://yousee.in/donate.php") && ($refurl != "yousee.in/donate.php") && ($refurl != "www.yousee.in/donate.php" )){
echo "Direct access to this page is not allowed.<BR>";
echo "Please use the <a href=\"http://www.yousee.in/donate.php\">donation page</a>.";
exit;
}
}

include("prod_conn.php");
$first_name = $_POST['First_Name'];
$last_name = $_POST['Last_Name'];
$display_name = $first_name.$last_name;
$address_line_1 = $_POST['add_line_1'];
$address_line_2 = $_POST['add_line_2'];
$address_city = $_POST['city'];
$address_state = $_POST['state'];
$state= $address_state;
$address_zipcode = $_POST['zipcode'];
$pincode= $address_zipcode;
$address_country = $_POST['country'];
$country = $address_country;
$village_town = $address_city;
$address = "$address_line_1 $address_line_2 $address_city $address_state $address_zipcode $address_country";
$emailid = $_POST['Official_EMail_ID'];
$official_email_id = $emailid;
$personal_email_id = $emailid;
isset($_POST['PAN'])?$pan =$_POST['PAN']:$pan ='';
isset($_POST['newPAN'])?$newpan = $_POST['newPAN']:$newpan = '';
$project_id = $_POST['project_id'];
$certificate_id=$_SESSION['keys'];
$mobile_phone_no = $_POST['Mobile_Phone_No'];
$donation_amt = $_POST['Donation_Amt'];
$trans_status = "INITIALISED";
$sess_id = session_id();
$query="INSERT INTO ONLINE_PAYMENTS
(`FIRST_NAME`,`LAST_NAME`,`ADDRESS`,`MOBILE_PHONE_NO`,
`PERSONAL_EMAIL_ID`,`OFFICIAL_EMAIL_ID`,`certificate_id`,`DONATION_AMT`,`TRANS_STATUS`,`donor_id`,`sess_id`)
VALUES
('".$first_name."','".$last_name."','".$address."','".$mobile_phone_no."','".$personal_email_id."','".$official_email_id."','".$certificate_id."','".$donation_amt."','".$trans_status."','".$_SESSION['SESS_DONOR_ID']."','".$sess_id."')";
$db_open = mysql_connect("$dbhost", "$dbuser", "$dbpass");
$db = mysql_select_db("$dbdatabase");

$result = mysql_query($query) or die (mysql_error());
$TRANSACTION_ID = mysql_insert_id();

//For payment gateway
$name = "$first_name $last_name";
$email = $emailid;
$mobile = $mobile_phone_no;
$address = "$address_line_1 $address_line_2 $address_city $address_state $address_zipcode $address_country";
$amt = $donation_amt;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Confirm details -- Donation form</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="css/view.js"></script>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body id="main_body">

<div id="wrapper">
 

<!--navbar-->
<?php include 'header_navbar.php' ;?>
<!--#navbar-->

<!--maincontentarea-->
<div id="content-main"> 

<!-- 	<img id="top" src="css/top.png" alt=""> -->
	<div id="form_container">
	
			<form id="form_87639" class="appnitro"  method="post" action="https://secure.netsolhost.com/yousee.in/pg/SendPerformREQuest.php">
					<div class="form_description">
			<h2>Confirm details - Donation</h2>
			<p>Please confirm the details below before making the donation. The information below will be used while generating the project certificates and also while preparing the Income tax exemption documents. please click on back button in your browser if you want to correct anything.</p>
		</div>		
		
		<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Name </label>
		<span>
			<input id="element_1_1" type="hidden" name="First_Name" class="element text"  value="<?php echo "$first_name"?>"/>
			<input id="element_1_1" type="hidden" name="Last_Name" class="element text"  value="<?php echo "$last_name"?>"/>
			<?php echo "$first_name $last_name"?>
		</span>
		</li>
		<li id="li_2" >
		<label class="description" for="element_2">Address </label>
		<span>
			<?php echo "$address_line_1" ?>,
			<?php if($address_line_2!='')echo "$address_line_2," ?>
			<?php echo "$address_city" ?>,
			<?php echo "$address_state" ?>,
			<?php if($address_zipcode!='') echo "$address_zipcode," ?>
			<?php echo "$address_country" ?>.
			
		</span>
		
		<li id="li_3" >
		<label class="description" for="element_3">Email </label>
		<span>
		<?php echo "$emailid"?>
		</span>

		</li>

		<li id="li_6" >
		<label class="description" for="element_6">Your phone number</label>
		<span>
		<?php echo "$mobile_phone_no"?>
		</span>
		</li>
<?php if($newpan!='' && $newpan!=NULL){
		$panquery="UPDATE donors set pan='$newpan' WHERE donor_id=$_SESSION[SESS_DONOR_ID]";
		$panupdate=mysql_query($panquery);
		$pan=$newpan; }?>
		<li id="li_6" >
		<label class="description" for="element_6">Your PAN number</label>
		<span>
		<?php echo "$pan"?>
		</span>
		</li>

		<li id="li_5" >
		<label class="description" for="element_5">Amount that you are donating (in Indian Rupees)</label>
		<span>
			<?php echo $_SESSION['total_amt'];?>
		</span>
	 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Projects to which you are making donation </label>
		<span>
		<?php
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query = "SELECT TITLE
FROM project_certificates
WHERE project_id=$project_id GROUP BY project_id";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$TITLE = $row['TITLE'];
	echo $TITLE;
	}
?>
</span>

<input id="element_1_1" type="hidden"  name="Donation_Amt" class="element text"  value="<?php echo "$donation_amt"?>"/>
<input id="element_1_1" type="hidden"  name="PAN" class="element text"  value="<?php echo "$pan"?>"/>
<input id="element_1_1" type="hidden"  name="Mobile_Phone_No" class="element text"  value="<?php echo "$mobile_phone_no"?>"/>
<input id="element_1_1" type="hidden"  name="address" class="element text"  value="<?php echo "$address"?>"/>
<input id="element_1_1" type="hidden"  name="Official_EMail_ID" class="element text"  value="<?php echo "$official_email_id"?>"/>
<input id="element_1_1" type="hidden"  name="Personal_EMail_ID" class="element text"  value="<?php echo "$personal_email_id"?>"/>
<input id="element_1_1" type="hidden"  name="TRANSACTION_ID" class="element text"  value="<?php echo "$TRANSACTION_ID"?>"/>


<li class="buttons">
   <!--  <input type="hidden" name="form_id" value="87639" /> -->
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Donate" />
</li>
</ul>
	</form>	

	</div> 

</div>
<!--#maincontentarea-->

<!--footer-->
<?php include 'footer.php' ; ?>
<!--#footer-->

</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>