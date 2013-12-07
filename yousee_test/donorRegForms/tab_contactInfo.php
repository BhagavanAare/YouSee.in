
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table  border="0">
  <tr>
    <td><label for="phone_number">Phone number*</label></td>
    <td>
      
      <input placeholder="Enter your 10 digit Mobile no.. " type="text" maxlength="10" name="phno" id="phone_number" />
    </td>
    <td><div class="error" id="donor_phno_errorloc"></div></td>
  </tr>
  <tr>
    <td><label for="personal_emailid">Preferred Email ID*</label></td>
    <td>
      <input  type="text" placeholder="example@yourdomain.com" name="preferredEmail" id="preferred_emailid" /></td>
    <td><div class="error" id="donor_preferredEmail_errorloc"></div></td>
  </tr>
  <tr>
    <td><label for="official_emailid">Alternate Email ID</label></td>
    <td><input type="text" name="alternateEmail" id="alternate_emailid" /></td>
    <td><div class="error" id="donor_alternateEmail_errorloc"></div></td>
  </tr>

  <tr>
    <td><label for="donor_address">Address</label></td>
    <td><input type="text" name="address" id="donor_address" /></td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><label for="city">City</label></td>
    <td><input type="text" name="city" id="city" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="donor_state">State*</label></td>
    <td><input type="text" name="state" id="donor_state" /></td>
    <td><div class="error" id="donor_state_errorloc" ></div></td>
  </tr>
    <tr>
      <td><label for="donor_country">Country*</label></td>
      <td><input type="text" name="country" value="India" id="donor_country" /></td>
      <td><div class="error" id="donor_country_errorloc"></div></td>
    </tr>
    <tr>
      <td><label for="donor_pin_code">Pin code</label></td>
      <td><input type="text" name="pincode" id="donor_pin_code" /></td>
      <td>&nbsp;</td>
    </tr>

    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
 	frmvalidator.addValidation("phno","req","	*Please enter  your Phone Number");
	frmvalidator.addValidation("preferredEmail","email","	*Please enter your Email properly");
	frmvalidator.addValidation("alternateEmail","email","	*Please enter your Email properly");
		frmvalidator.addValidation("preferredEmail","req","	*Please enter your Email.");
	//frmvalidator.addValidation("officialEmail","req","	 *Please enter your Email.");
	frmvalidator.addValidation("state","req","	*Please enter  State");
	frmvalidator.addValidation("state","alpha_s","	*State must only contain characters");
	frmvalidator.addValidation("country","req","	*Please enter Country");
	frmvalidator.addValidation("country","alpha_s","	*Country must  only contain characters");
  </script>


</body>
</html>