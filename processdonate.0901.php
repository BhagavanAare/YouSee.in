<?
//include("conn.php");
include("prod_conn.php");
$First_Name = $_POST['First_Name'];
$Last_Name = $_POST['Last_Name'];
$Father_Husband_Name = $_POST['Father_Husband_Name'];
$DOB = $_POST['DOB'];
$Gender = $_POST['Gender'];
$Title_Designation = $_POST['Title_Designation'];
$address_line_1 = $_POST['add_line_1'];
$address_line_2 = $_POST['add_line_2'];
$address_city = $_POST['city'];
$address_state = $_POST['state'];
$address_zipcode = $_POST['zipcode'];
$address_country = $_POST['country'];
$emailid = $_POST['Official_EMail_ID'];
$Official_EMail_ID = $emailid;
$Personal_EMail_ID = $emailid;
$PAN = $_POST['PAN'];
$Feature_Permission = $_POST['Feature_Permission']; 
$Feature_Quote = $_POST['Feature_Quote'];
$Image_url = $_POST['Image_url'];
$Certificate_ID = $_POST['Certificate_ID'];
$Mobile_Phone_No = $_POST['Mobile_Phone_No'];
$Donation_Amt = $_POST['Donation_Amt'];

//For payment gateway
$name = "$First_Name $Last_Name";
$email = $emailid;
$mobile = $Mobile_Phone_No;
$address = "$address_line_1 $address_line_2 $address_city $address_state $address_zipcode $address_country";
$amt = $Donation_Amt;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Confirm details -- Donation form</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="css/view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Confirm details - Donation</a></h1>
		<form id="form_87639" class="appnitro"  method="post" action="/pg/payment.php">
					<div class="form_description">
			<h2>Confirm details - Donation</h2>
			<p>Please confirm the details below before making the donation. The information below will be used while generating the project certificates and also while preparing the Income tax exemption documents. please click on back button in your browser if you want to correct anything.</p>
		</div>		
		
		<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Name </label>
		<span>
			<p><input id="element_1_1" type="hidden" name="First_Name" class="element text"  value="<? echo "$First_Name"?>"/>
			<input id="element_1_1" type="hidden" name="Last_Name" class="element text"  value="<? echo "$Last_Name"?>"/>
			<? echo "$First_Name $Last_Name"?></p>
		</span>
		</li>
		

		<li id="li_1" >
		<label class="description" for="element_1">Father's/Husband's Name </label>
		<span>
			<p><input id="element_1_1" type="hidden"  name="Father_Husband_Name" class="element text"  value="<? echo "$Father_Husband_Name"?>"/><? echo "$Father_Husband_Name"?></p>
		</span>
		</li>

		<li id="li_1" >
		<label class="description" for="element_1">Your Date of Birth (DOB) </label>
		<span>
			<p><input id="element_1_1" type="hidden"  name="DOB" class="element text"  value="<? echo "$DOB"?>"/><? echo "$DOB"?></p>
		</span>
		</li>

		<li id="li_1" >
		<label class="description" for="element_1">Title/Designation </label>
		<span>
			<p><? echo "$Title_Designation"?></p>
		</span>
		</li>

		<li id="li_2" >
		<label class="description" for="element_2">Address </label>
		<span>
			<p><? echo "$address_line_1" ?></p>
			<p><? echo "$address_line_2" ?></p>
			<p><? echo "$address_city" ?></p>
			<p><? echo "$address_state" ?></p>
			<p><? echo "$address_zipcode" ?></p>
			<p><? echo "$address_country" ?></p>
			
		</span>
		
		<li id="li_3" >
		<label class="description" for="element_3">Email </label>
		<span>
			<p><? echo "$emailid"?></p>
		</span>

		</li>

		<li id="li_6" >
		<label class="description" for="element_6">Your phone number</label>
		<span>
			<p><? echo "$Mobile_Phone_No"?></p>
		</span>
		</li>

		<li id="li_6" >
		<label class="description" for="element_6">Your PAN number</label>
		<span>
			<p><? echo "$PAN"?></p>
		</span>
		</li>

		<li id="li_5" >
		<label class="description" for="element_5">Amount that you are donating (in Indian Rupees)</label>
		<span>
			<p><? echo "$Donation_Amt"?></p>
		</span>
	 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Project to which you are making donation </label>
		<span>
			<p><?
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query = "SELECT TITLE
FROM PROJECT_CERTIFICATES
WHERE CERTIFICATE_ID=$Certificate_ID";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$TITLE = $row['TITLE'];
	echo $TITLE;
	}
?></p>
</span>

<input id="element_1_1" type="hidden"  name="Certificate_ID" class="element text"  value="<? echo "$Certificate_ID"?>"/>
<input id="element_1_1" type="hidden"  name="Donation_Amt" class="element text"  value="<? echo "$Donation_Amt"?>"/>
<input id="element_1_1" type="hidden"  name="PAN" class="element text"  value="<? echo "$PAN"?>"/>
<input id="element_1_1" type="hidden"  name="Mobile_Phone_No" class="element text"  value="<? echo "$Mobile_Phone_No"?>"/>
<input id="element_1_1" type="hidden"  name="Gender" class="element text"  value="<? echo "$Gender"?>"/>
<input id="element_1_1" type="hidden"  name="Title_Designation" class="element text"  value="<? echo "$Title_Designation"?>"/>
<input id="element_1_1" type="hidden"  name="address" class="element text"  value="<? echo "$address"?>"/>
<input id="element_1_1" type="hidden"  name="Official_EMail_ID" class="element text"  value="<? echo "$Official_EMail_ID"?>"/>
<input id="element_1_1" type="hidden"  name="Personal_EMail_ID" class="element text"  value="<? echo "$Personal_EMail_ID"?>"/>
<input id="element_1_1" type="hidden"  name="Feature_Permission" class="element text"  value="<? echo "$Feature_Permission"?>"/>
<input id="element_1_1" type="hidden"  name="Feature_Quote" class="element text"  value="<? echo "$Feature_Quote"?>"/>
<input id="element_1_1" type="hidden"  name="Image_url" class="element text"  value="<? echo "$Image_url"?>"/>
<input id="element_1_1" type="hidden"  name="Donation_Amt" class="element text"  value="<? echo "$Donation_Amt"?>"/>
<input id="element_1_1" type="hidden"  name="address_line_1" class="element text"  value="<? echo "$address_line_1"?>"/>
<input id="element_1_1" type="hidden"  name="address_line_2" class="element text"  value="<? echo "$address_line_2"?>"/>
<input id="element_1_1" type="hidden"  name="address_city" class="element text"  value="<? echo "$address_city"?>"/>
<input id="element_1_1" type="hidden"  name="address_state" class="element text"  value="<? echo "$address_state"?>"/>
<input id="element_1_1" type="hidden"  name="address_zipcode" class="element text"  value="<? echo "$address_zipcode"?>"/>
<input id="element_1_1" type="hidden"  name="address_country" class="element text"  value="<? echo "$address_country"?>"/>


<li class="buttons">
   <!--  <input type="hidden" name="form_id" value="87639" /> -->
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Donate" />
</li>
</ul>
	</form>	

<div id="footer">Generated by <a href="http://www.phpform.org">pForm</a></div>

</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>