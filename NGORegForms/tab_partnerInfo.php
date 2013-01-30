<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table border="0">
  <tr>
    <td><label for="partner_name">Partner name*</label></td>
    <td>
      
      <input type="text" name="partnerName" id="partner_name" />
    </td>
    <td><div class="error" id="NGO_partnerName_errorloc"></td>
  </tr>
  <tr>
    <td><label for="partner_type">Partner type*</label></td>
    <td>
      <select name="partnerType" id="partner_type">
        <option value="govt">Government Institution</option >
        <option value="company">Section 25 Company</option>
        <option value="socetiey">Society</option>
        <option value="trust">Trust</option>
      </select></td>
    <td></td>
  </tr>
  <tr>
    <td style="vertical-align:top;"><label for="partner_email_id">Partner Email ID*</label></td>
    <td><span style="vertical-align:top;">
      <input type="text" placeholder"example@yourdomain.com"  name="partnerEmailId" id="partner_email_id" />
    </span></td>
    <td><div class="error" id="NGO_partnerEmailId_errorloc"></td>
    <tr>
    <td><label for="hqaddress">HQ Address:</label></td>
    <td><input type="text" name="address" id="hqaddress" /></td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td><label for="city">HQ City</label></td>
    <td><input type="text" name="hqcity" id="city" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="partnerstate">HQ State*</label></td>
    <td><input type="text" name="hqstate" id="partnerstate" /></td>
    <td><div class="error" id="NGO_hqstate_errorloc"></td>
  </tr>
    <tr>
      <td><label for="partnercountry">HQ Country*</label></td>
      <td><input type="text" name="hqcountry" id="partnercountry" value="India" /></td>
      <td><div class="error" id="NGO_hqcountry_errorloc"></td>
    </tr>
    <tr>
      <td><label for="partnerpin_code">HQ Pin code</label></td>
      <td><input type="text" name="hqpincode" id="partnerpin_code" /></td>
      <td>&nbsp;</td>
    </tr>
	    <tr>
      <td><label for="website">website URL</label></td>
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