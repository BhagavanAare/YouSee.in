
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Untitled Document</title>

<style type="text/css">
</style>
</head>

<body>


  <div >
					
    <table   border="0">
      <tr>
        <td><label for="firstName">First name*</label></td>
        <td><input name="fname" type="text" id="firstName" value=""/></td>
        <td><div class="error" id="donor_fname_errorloc"></div></td>
      </tr>
      <tr>
        <td><label for="lastName">Last name*</label></td>
        <td><input name="lname" type="text" id="lastName" value=""/></td>
        <td><div class="error" id="donor_lname_errorloc"></div></td>
      </tr>
	  
      <tr>
          <td><label for="donor_type">Individual/Group*</label></td>
          <td>
            <select name="type" id="donor_type">
              <option value="Individual">Individual</option>
              <option value="Group">Group</option>
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
      <tr>
				<td style="vertical-align:top;">
					<label for="quote">Quote <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>For featuring your photo and Quote on YouSee website,we request you to write a brief (1-3 lines) quote about your thoughts on volunteering,donations and overall about UC (max 300 characters)</span>
						</a>
						</span>
					</label>
				</td>
				<td><span style="vertical-align:top;">
					<textarea placeholder="Please write a brief (1-3 lines) quote about your thoughts on volunteering,donations or overall about UC" name="featureQuote" id="quote" cols="45" rows="5"></textarea>
				</span>
				</td>
				<td>&nbsp;</td>
		</tr>
		<tr> <td>&nbsp</td><td >
		<p><strong>Write the following word:</strong></p>
		<img src="captcha/captcha.php" id="captcha" /><br/>
		<a href="#" onclick="
		document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
		document.getElementById('captcha-form').focus();"
		id="change-image">Not readable? Change text.</a><br/><br/>	
		<input type="text" name="captcha" id="captcha-form" autocomplete="off" /><br/>
		</td>
		<td style="color:red;"><?php echo $msg; ?></td>
    </tr>      
  </table>
  </fieldset>
  </div>
  
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
<?php
if(isset($_POST))
{
	$old=$_POST;
	setOldValues($old);
}
function setOldValues($old)
{
	
}
?>
