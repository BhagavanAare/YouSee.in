<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
input.button_add {
	background-image: url(/images/profilePic.png); /* 16px x 16px */
	background-color: transparent; /* make the button transparent */
	background-repeat: no-repeat;
	/* make the background image appear only once */
	background-position: 0px 0px; /* equivalent to 'top left' */
	border: none; /* assuming we don't want any borders */
	cursor: pointer;
	/* make the cursor like hovering over an <a> element */
	height: 100px; /* make this the size of your image */
	padding-left: 0px; /* make text start to the right of the image */
	vertical-align: middle; /* align the text vertically centered */
}
</style>

</head>

<body>


<div>
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
		<p><label> <input type="radio" checked name="gender" value="M"
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
</div>
<div></div>



</body>
<script type="text/javascript">

	ngovalidator.addValidation("fname","req","please enter first name");
	ngovalidator.addValidation("lname","req","please enter last name");
	ngovalidator.addValidation("personalEmail","email","please enter email properly");
	ngovalidator.addValidation("phno","req","please enter your Phone number");
	ngovalidator.addValidation("phno","num","please enter numbers only");

	
	
  </script>
</html>
