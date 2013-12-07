<?php
 $thispage = "uccertificates";
 include "login_auth.php";
 if($_SESSION['SESS_USER_TYPE']!="D"){
	echo "This page can only be accessed by donors";
	exit();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donation Form</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <link rel="stylesheet" type="text/css" href="css/view.css" media="all">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery.validate.min.js"></script>
<script type="text/javascript">
		$(function() {
		$("#form_87639").validate({
			rules : {
				PAN : {
					minlength : 10,
					maxlength : 10
				},
				add_line_1 : {
					required : true
				},
				city : {
					required : true
				},
				state : {
					required : true
				},
				Official_Email_ID : {
					required : true
				}
			}		
		});
		
	});
	</script>
  <script type="text/javascript" src="css/view.js"></script>
  </HEAD>
<BODY>
 
<!--wrapper-->
<div id="wrapper">

<!--navbar-->
<?php include 'header_navbar.php' ;?>
<!--#navbar-->

<!--maincontentarea-->
<div id="content-main"> 
<!-- <img id="top" src="css/top.png" alt=""> -->
	<div id="form_container">
<?php 
	include "prod_conn.php";
	$query="SELECT first_name,last_name,address,village_town,state,country,pin_code,preferred_email,mobile_phone_no,pan from donors WHERE user_id=$_SESSION[SESS_USER_ID]";
	$donors=mysql_fetch_array(mysql_query($query));
?>

		<form id="form_87639"  class="appnitro" method="post" action="processdonate.php">
					<div class="form_description">
			<h2>Donation form</h2>
			<p>Please fill up the required information in the form below and click on submit. On the next page you will be asked to verify the information you enter here before redirecting to the secured payment gateway.</p>
		</div>	
			<ul >
		
		<fieldset>
		<legend> Personal Information </legend>
		<li id="li_1" >
		<label class="description" for="element_1">Name: </label>
		<span>
			<label class="description"><?php echo $donors['first_name']; ?> </label>
			<input id="element_1_1" name= "First_Name" class="element text" maxlength="255" size="20" value="<?php echo $donors['first_name']; ?>" hidden />
			<label>First</label>
		</span>
		<span>
			<label class="description"><?php echo $donors['last_name']; ?> </label>
			<input id="element_1_2" name= "Last_Name" class="element text" maxlength="255" size="20" value="<?php echo $donors['last_name'];?>" hidden />
			<label>Last</label>
		</span> 
		</li>
		<li id="li_5_1" >
		<label class="description" for="element_5">Permanent Account Number (PAN) </label>
		<?php if($donors['pan']!= NULL && $donors['pan'] != "0" && $donors['pan'] != ''){?>
		<span>
		<label class="description" for="element_5"><?php echo $donors['pan'];?></label>
		<input id="element_5_1_1" name="PAN" class="element text currency" size="20" value="<?php echo $donors['pan'];?>" type="text" hidden />		
		</span>
		<?php } else { ?>
		<span>
			<input id="element_5_1_1" name="newPAN" class="element text currency" size="20" value="" type="text" />		
			<label for="element_5_1_1">Quoting your PAN number will help you claim the deduction under Section 80G for Income tax purposes.</label>
		</span>
		 <?php } ?>
		</li>
		</fieldset><br />
		<fieldset>
		<legend> Billing Information </legend>
		<li id="li_2" >

		<label class="description" for="element_2">Billing Address* </label>
		<div>
			<input id="element_2_1" name="add_line_1" class="element text large req" value="<?php echo $donors['address'];?>" type="text" required>
			<label for="element_2_1">Street Address</label>
		</div>
	
		<div>
			<input id="element_2_2" name="add_line_2" class="element text large" value="" type="text">
			<label for="element_2_2">Address Line 2</label>
		</div>
	
		<div class="left">
			<input id="element_2_3" name="city" class="element text medium req" value="<?php echo $donors['village_town'];?>" type="text" required>
			<label for="element_2_3">City</label>
		</div>
	
		<div class="right">
			<input id="element_2_4" name="state" class="element text medium req" value="<?php echo $donors['state'];?>" type="text" required>
			<label for="element_2_4">State / Province / Region</label>
		</div>
	
		<div class="left">
			<input id="element_2_5" name="zipcode" class="element text medium" maxlength="15" value="<?php if($donors['pin_code']!=0)echo $donors['pin_code'];?>" type="text">
			<label for="element_2_5">Postal / Zip Code</label>
		</div>
	
		<div class="right">
			<select class="element select medium" id="country" name="country"> 
			<option value="India" selected="selected">India</option>
<option value="Afghanistan" >Afghanistan</option>
<option value="Albania" >Albania</option>
<option value="Algeria" >Algeria</option>
<option value="Andorra" >Andorra</option>
<option value="Antigua and Barbuda" >Antigua and Barbuda</option>
<option value="Argentina" >Argentina</option>
<option value="Armenia" >Armenia</option>
<option value="Australia" >Australia</option>
<option value="Austria" >Austria</option>
<option value="Azerbaijan" >Azerbaijan</option>
<option value="Bahamas" >Bahamas</option>
<option value="Bahrain" >Bahrain</option>
<option value="Bangladesh" >Bangladesh</option>
<option value="Barbados" >Barbados</option>
<option value="Belarus" >Belarus</option>
<option value="Belgium" >Belgium</option>
<option value="Belize" >Belize</option>
<option value="Benin" >Benin</option>
<option value="Bhutan" >Bhutan</option>
<option value="Bolivia" >Bolivia</option>
<option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
<option value="Botswana" >Botswana</option>
<option value="Brazil" >Brazil</option>
<option value="Brunei" >Brunei</option>
<option value="Bulgaria" >Bulgaria</option>
<option value="Burkina Faso" >Burkina Faso</option>
<option value="Burundi" >Burundi</option>
<option value="Cambodia" >Cambodia</option>
<option value="Cameroon" >Cameroon</option>
<option value="Canada" >Canada</option>
<option value="Cape Verde" >Cape Verde</option>
<option value="Central African Republic" >Central African Republic</option>
<option value="Chad" >Chad</option>
<option value="Chile" >Chile</option>
<option value="China" >China</option>
<option value="Colombia" >Colombia</option>
<option value="Comoros" >Comoros</option>
<option value="Congo" >Congo</option>
<option value="Costa Rica" >Costa Rica</option>
<option value="Côte d'Ivoire" >Côte d'Ivoire</option>
<option value="Croatia" >Croatia</option>
<option value="Cuba" >Cuba</option>
<option value="Cyprus" >Cyprus</option>
<option value="Czech Republic" >Czech Republic</option>
<option value="Denmark" >Denmark</option>
<option value="Djibouti" >Djibouti</option>
<option value="Dominica" >Dominica</option>
<option value="Dominican Republic" >Dominican Republic</option>
<option value="East Timor" >East Timor</option>
<option value="Ecuador" >Ecuador</option>
<option value="Egypt" >Egypt</option>
<option value="El Salvador" >El Salvador</option>
<option value="Equatorial Guinea" >Equatorial Guinea</option>
<option value="Eritrea" >Eritrea</option>
<option value="Estonia" >Estonia</option>
<option value="Ethiopia" >Ethiopia</option>
<option value="Fiji" >Fiji</option>
<option value="Finland" >Finland</option>
<option value="France" >France</option>
<option value="Gabon" >Gabon</option>
<option value="Gambia" >Gambia</option>
<option value="Georgia" >Georgia</option>
<option value="Germany" >Germany</option>
<option value="Ghana" >Ghana</option>
<option value="Greece" >Greece</option>
<option value="Grenada" >Grenada</option>
<option value="Guatemala" >Guatemala</option>
<option value="Guinea" >Guinea</option>
<option value="Guinea-Bissau" >Guinea-Bissau</option>
<option value="Guyana" >Guyana</option>
<option value="Haiti" >Haiti</option>
<option value="Honduras" >Honduras</option>
<option value="Hong Kong" >Hong Kong</option>
<option value="Hungary" >Hungary</option>
<option value="Iceland" >Iceland</option>
<option value="India" >India</option>
<option value="Indonesia" >Indonesia</option>
<option value="Iran" >Iran</option>
<option value="Iraq" >Iraq</option>
<option value="Ireland" >Ireland</option>
<option value="Israel" >Israel</option>
<option value="Italy" >Italy</option>
<option value="Jamaica" >Jamaica</option>
<option value="Japan" >Japan</option>
<option value="Jordan" >Jordan</option>
<option value="Kazakhstan" >Kazakhstan</option>
<option value="Kenya" >Kenya</option>
<option value="Kiribati" >Kiribati</option>
<option value="North Korea" >North Korea</option>
<option value="South Korea" >South Korea</option>
<option value="Kuwait" >Kuwait</option>
<option value="Kyrgyzstan" >Kyrgyzstan</option>
<option value="Laos" >Laos</option>
<option value="Latvia" >Latvia</option>
<option value="Lebanon" >Lebanon</option>
<option value="Lesotho" >Lesotho</option>
<option value="Liberia" >Liberia</option>
<option value="Libya" >Libya</option>
<option value="Liechtenstein" >Liechtenstein</option>
<option value="Lithuania" >Lithuania</option>
<option value="Luxembourg" >Luxembourg</option>
<option value="Macedonia" >Macedonia</option>
<option value="Madagascar" >Madagascar</option>
<option value="Malawi" >Malawi</option>
<option value="Malaysia" >Malaysia</option>
<option value="Maldives" >Maldives</option>
<option value="Mali" >Mali</option>
<option value="Malta" >Malta</option>
<option value="Marshall Islands" >Marshall Islands</option>
<option value="Mauritania" >Mauritania</option>
<option value="Mauritius" >Mauritius</option>
<option value="Mexico" >Mexico</option>
<option value="Micronesia" >Micronesia</option>
<option value="Moldova" >Moldova</option>
<option value="Monaco" >Monaco</option>
<option value="Mongolia" >Mongolia</option>
<option value="Montenegro" >Montenegro</option>
<option value="Morocco" >Morocco</option>
<option value="Mozambique" >Mozambique</option>
<option value="Myanmar" >Myanmar</option>
<option value="Namibia" >Namibia</option>
<option value="Nauru" >Nauru</option>
<option value="Nepal" >Nepal</option>
<option value="Netherlands" >Netherlands</option>
<option value="New Zealand" >New Zealand</option>
<option value="Nicaragua" >Nicaragua</option>
<option value="Niger" >Niger</option>
<option value="Nigeria" >Nigeria</option>
<option value="Norway" >Norway</option>
<option value="Oman" >Oman</option>
<option value="Pakistan" >Pakistan</option>
<option value="Palau" >Palau</option>
<option value="Panama" >Panama</option>
<option value="Papua New Guinea" >Papua New Guinea</option>
<option value="Paraguay" >Paraguay</option>
<option value="Peru" >Peru</option>
<option value="Philippines" >Philippines</option>
<option value="Poland" >Poland</option>
<option value="Portugal" >Portugal</option>
<option value="Puerto Rico" >Puerto Rico</option>
<option value="Qatar" >Qatar</option>
<option value="Romania" >Romania</option>
<option value="Russia" >Russia</option>
<option value="Rwanda" >Rwanda</option>
<option value="Saint Kitts and Nevis" >Saint Kitts and Nevis</option>
<option value="Saint Lucia" >Saint Lucia</option>
<option value="Saint Vincent and the Grenadines" >Saint Vincent and the Grenadines</option>
<option value="Samoa" >Samoa</option>
<option value="San Marino" >San Marino</option>
<option value="Sao Tome and Principe" >Sao Tome and Principe</option>
<option value="Saudi Arabia" >Saudi Arabia</option>
<option value="Senegal" >Senegal</option>
<option value="Serbia and Montenegro" >Serbia and Montenegro</option>
<option value="Seychelles" >Seychelles</option>
<option value="Sierra Leone" >Sierra Leone</option>
<option value="Singapore" >Singapore</option>
<option value="Slovakia" >Slovakia</option>
<option value="Slovenia" >Slovenia</option>
<option value="Solomon Islands" >Solomon Islands</option>
<option value="Somalia" >Somalia</option>
<option value="South Africa" >South Africa</option>
<option value="Spain" >Spain</option>
<option value="Sri Lanka" >Sri Lanka</option>
<option value="Sudan" >Sudan</option>
<option value="Suriname" >Suriname</option>
<option value="Swaziland" >Swaziland</option>
<option value="Sweden" >Sweden</option>
<option value="Switzerland" >Switzerland</option>
<option value="Syria" >Syria</option>
<option value="Taiwan" >Taiwan</option>
<option value="Tajikistan" >Tajikistan</option>
<option value="Tanzania" >Tanzania</option>
<option value="Thailand" >Thailand</option>
<option value="Togo" >Togo</option>
<option value="Tonga" >Tonga</option>
<option value="Trinidad and Tobago" >Trinidad and Tobago</option>
<option value="Tunisia" >Tunisia</option>
<option value="Turkey" >Turkey</option>
<option value="Turkmenistan" >Turkmenistan</option>
<option value="Tuvalu" >Tuvalu</option>
<option value="Uganda" >Uganda</option>
<option value="Ukraine" >Ukraine</option>
<option value="United Arab Emirates" >United Arab Emirates</option>
<option value="United Kingdom" >United Kingdom</option>
<option value="United States" >United States</option>
<option value="Uruguay" >Uruguay</option>
<option value="Uzbekistan" >Uzbekistan</option>
<option value="Vanuatu" >Vanuatu</option>
<option value="Vatican City" >Vatican City</option>
<option value="Venezuela" >Venezuela</option>
<option value="Vietnam" >Vietnam</option>
<option value="Yemen" >Yemen</option>
<option value="Zambia" >Zambia</option>
<option value="Zimbabwe" >Zimbabwe</option>
	
			</select>
		<label for="element_2_6">Country</label>
	</div> 
		</li>		

		<li id="li_3" >
		<label class="description" for="element_3">Email ID*</label>
					<input id="element_3" name="Official_EMail_ID" class="element text medium req" type="text" maxlength="255" value="<?php echo $donors['preferred_email'];?>" required /> 
				
		</li>
		<li id="li_6" >
		<label class="description" for="element_6">Please enter your phone number (including country code) </label>
		<span>
			<input id="element_6_1" name="Mobile_Phone_No" class="element text req" size="13" maxlength="13" value="<?php echo $donors['mobile_phone_no'];?>" type="text">
		</span>
		</li>		
	</fieldset>
	<fieldset>
	<legend> Donation Details </legend>	
		<?php 
			$keys=explode("^",$_SESSION['certificates']);
			$_SESSION['project_id']=array_shift($keys);
			$values=explode("^",$_SESSION['amounts']);
			$_SESSION['total_amt']=array_shift($values);
			$_SESSION['keys']=implode($keys,"-");
			$_SESSION['values']=implode($values,"-");
		?>
		<li id="li_5" >
		<?php if($_SESSION['total_amt']!=0){ ?>
		<label class="description" for="element_5"><font style="text-decoration:underline">Amount</font> :  Rs. <?php echo $_SESSION['total_amt']; ?></label>
			<input id="element_5_1" name="Donation_Amt" class="element text currency req" size="10" value="<?php echo $_SESSION['total_amt']; ?>" type="text" hidden />		
		<?php } ?>
		</li>	
		<li id="li_5" >
		<label class="description" for="element_5"><font style="text-decoration:underline">Project</font> : <?php $presult=mysql_query("SELECT title from project_certificates WHERE project_id=$_SESSION[project_id] GROUP BY project_id");$project=mysql_fetch_array($presult); echo $project['title']; ?> </label>
			<input id="element_5_2" name="project_id" class="element text req" size="10" value="<?php echo $_SESSION['project_id']; ?>" type="text" hidden />		
		</li>	
		<li class="buttons">
			    <input type="hidden" name="form_id" value="87639" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
		</fieldset>
			</ul>
		</form>	

</div> 

</div>
<!--#maincontentarea-->

<!--footer-->
<?php include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->
<!-- Removed by Vivek
<script src="http://cdn.wibiya.com/Toolbars/dir_0838/Toolbar_838967/Loader_838967.js" type="text/javascript"></script><noscript><a href="http://www.wibiya.com/">Web Toolbar by Wibiya</a></noscript> 
-->
<!-- Google Code for Donation Interest Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1017317607;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "_w0hCIGL1AQQ55GM5QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1017317607/?value=0&amp;label=_w0hCIGL1AQQ55GM5QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

 </BODY>
</HTML>