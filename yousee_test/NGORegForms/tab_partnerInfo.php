<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table border="0">
  <tr>
    <td><label for="partner_name">Organisation Name*</label></td>
    <td>
      
      <input type="text" name="partnerName" style="text-transform:capitalize" id="partner_name" />
    </td>
    <td><div class="error" id="NGO_partnerName_errorloc"></td>
  </tr>
  <tr>
    <td><label for="partner_type">Organisation Type*</label></td>
    <td>
      <select name="partnerType" id="partner_type">
        <option value="Government">Government Institution</option >
        <option value="Company">Section 25 Company</option>
        <option value="Society">Society</option>
        <option value="Trust">Trust</option>
        <option value="Unregistered Organisation">Unregistered Organisation</option>
      </select></td>
    <td></td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><label for="partner_email_id">Email ID*</label></td>
    <td><span style="vertical-align:top;">
      <input type="text" placeholder"example@yourdomain.com"  name="partnerEmailId" id="partner_email_id" />
    </span></td>
    <td><div class="error" id="NGO_partnerEmailId_errorloc"></td>
    <tr>
    <td><label for="hqaddress">Office Address:</label></td>
    <td><input type="text" name="address" id="hqaddress" /></td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><label for="city">City</label></td>
    <td><input type="text" name="hqcity" id="city" style="text-transform:capitalize"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="partnerstate">State*</label></td>
    <td><input type="text" name="hqstate" id="partnerstate" style="text-transform:capitalize"/></td>
    <td><div class="error" id="NGO_hqstate_errorloc"></td>
  </tr>
    <tr>
      <td><label for="partnercountry">Country*</label></td>
      <td><input type="text" name="hqcountry" style="text-transform:capitalize" id="partnercountry" value="India" /></td>
      <td><div class="error" id="NGO_hqcountry_errorloc"></td>
    </tr>
    <tr>
      <td><label for="partnerpin_code">Pin code</label></td>
      <td><input type="text" name="hqpincode" id="partnerpin_code" /></td>
      <td>&nbsp;</td>
    </tr>
	    <tr>
      <td><label for="website">Website</label></td>
      <td><input type="text" name="website" id="website" /></td>
      <td>&nbsp;</td>
    </tr>
  
  </tr>
  <!--
  <tr>
    <td style="vertical-align:top;"><label for="partner_desc">Partner Description</label>
      </td>
    <td><textarea name="partnerDesc" id="partner_desc" cols="45" rows="5"></textarea></td>
    <td>&nbsp;</td>
  </tr>
  -->
  
  
  
  <script type="text/javascript">

 	var ngovalidator  = new Validator("NGO");
	ngovalidator.EnableFocusOnError(true);
	ngovalidator.EnableOnPageErrorDisplay();
	ngovalidator.EnableMsgsTogether();

	ngovalidator.addValidation("partnerName","req","please enter NGO name");
	ngovalidator.addValidation("partnerEmailId","req","please enter NGO name");
	ngovalidator.addValidation("hqstate","req","please enter Head Quarter's state");
	ngovalidator.addValidation("hqstate","alpha_s","state should only contain alphabets");
	ngovalidator.addValidation("hqcountry","req","please enter Head Quarter's country");
	ngovalidator.addValidation("hqcountry","alpha_s","country should only contain alphabets");
	

	
	
  </script>

</table>

</body>
</html>