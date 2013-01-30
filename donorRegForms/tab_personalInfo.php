<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
</style>
</head>

<body>

<div >


  
</div>

  <div >
					
    <table   border="0">
      <tr>
        <td><label for="firstName">First name*</label></td>
        <td><input name="fname" type="text" id="firstName" /></td>
        <td><div class="error" id="donor_fname_errorloc"></div></td>
      </tr>
      <tr>
        <td><label for="lastName">Last name*</label></td>
        <td><input name="lname" type="text" id="lastName" /></td>
        <td><div class="error" id="donor_lname_errorloc"></div></td>
      </tr>
      <tr>
          <td><label for="donor_type">Individual/Group*</label></td>
          <td>
            <select name="type" id="donor_type">
              <option value="Individual">individual</option>
              <option value="Group">group</option>
            </select></td>
          <td><div class="error" id="type_fname_errorloc"></div></td>
      </tr>
      <tr>
      <tr>
        <td>Gender</td>
        <td><p>
          <label>
            <input type="radio" name="gender" value="M" id="radio_m" checked />
            Male</label>
          
          <label>
            <input type="radio" name="gender"  value="F" id="radio_f" />
            Female</label>
          <br />
        </p></td>
        <td><div class="error" id="donor_fname_errorloc"></div></td>
      </tr>
      <td><label>Date of Birth</label></td>
        <td><input name="dob" type="text" id="dob" /></td>
        <td>&nbsp;</td>
        <tr>
          <td><label for="occupation">Occupation</label>
          </td>
          <td><input type="text" name="occupation" id="occupation" /></td>
          <td>&nbsp;</td>
        </tr>
        <td><label for="donor_designation">Designation</label></td>
        <td><input type="text" name="designation" id="donor_designation" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><label for="pan">PAN card no.</label>
        </td>
        <td><input type="text" name="pan" id="pan" /></td>
        <td>&nbsp;</td>
      </tr>
      
      <!-- Upload Image.. skipped for now..
      <tr >
      	<td colspan="3">
        <p>
<?//php define ('MAX_FILE_SIZE', 1024 * 1024); ?>
  <input type="hidden" name="MAX_FILE_SIZE" 
    value="<?//php MAX_FILE_SIZE; ?>" />
  <label for="image">Upload image:</label>
  <input type="file" name="image" id="image" value="choose image" />
</p>
</td>
      </tr>
       -->
  </table>
  </fieldset>
  </div>
  <div></div>
  
    <script type="text/javascript">

 	var frmvalidator  = new Validator("donor");
	frmvalidator.EnableFocusOnError(true);
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("fname","req","please enter first name");
	frmvalidator.addValidation("lname","req","please enter last name");

	
	
  </script>

</body>
</html>
