<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Donation form</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="css/view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="css/top.png" alt="">
	<div id="form_container">
	
		<h1><a>Donation form</a></h1>
		<form id="form_87639" class="appnitro"  method="post" action="processdonate.php">
					<div class="form_description">
			<h2>Donation form</h2>
			<p>This is your form description. Click here to edit.</p>
		</div>						
			<ul >
			
		<li id="li_1" >
		<label class="description" for="element_1">Name* </label>
		<span>
			<input id="element_1_1" name= "First_Name" class="element text" maxlength="255" size="20" value=""/>
			<label>First</label>
		</span>
		<span>
			<input id="element_1_2" name= "Last_Name" class="element text" maxlength="255" size="20" value=""/>
			<label>Last</label>
		</span> 
		</li>
		
		<li id="li_1_1" >
		<label class="description" for="element_1">Father/Husband's Name* </label>
		<span>
			<input id="element_1_1_1" name= "Father_Husband_Name" class="element text" maxlength="50" size="50" value=""/>
		</span>
		</li>
		
		<li id="li_1_2" >
		<label class="description" for="element_1">Date of Birth* (DD/MM/YYYY)</label>
		<span>
			<input id="element_1_1_2" name= "DOB" class="element text" maxlength="10" size="8" value=""/>
		</span>
		</li>

		<li id="li_1_3" >
		<label class="description" for="element_1">Gender*</label>
		<div>
			<select class="element select medium" id="Gender" name="Gender"> 
			<option value="Male" selected="selected">Male</option>
			<option value="Female">Female</option>
			</select>
		</div>
		</li>

<li id="li_1_3" >
		<label class="description" for="element_1">Title/Designation</label>
		<span>
			<input id="element_1_1_3" name= "Title_Designation" class="element text" maxlength="50" size="50" value=""/>
		</span>
		</li>

<!-- <li id="li_1_3" >
		<label class="description" for="element_1">Your organization's name (if applicable)</label>
		<span>
			<input id="element_1_1_3" name= "Title_Designation" class="element text" maxlength="50" size="50" value=""/>
		</span>
		</li>
-->

		<li id="li_2" >

		<label class="description" for="element_2">Address* </label>
		<div>
			<input id="element_2_1" name="add_line_1" class="element text large" value="" type="text">
			<label for="element_2_1">Street Address</label>
		</div>
	
		<div>
			<input id="element_2_2" name="add_line_2" class="element text large" value="" type="text">
			<label for="element_2_2">Address Line 2</label>
		</div>
	
		<div class="left">
			<input id="element_2_3" name="city" class="element text medium" value="" type="text">
			<label for="element_2_3">City</label>
		</div>
	
		<div class="right">
			<input id="element_2_4" name="state" class="element text medium" value="" type="text">
			<label for="element_2_4">State / Province / Region</label>
		</div>
	
		<div class="left">
			<input id="element_2_5" name="zipcode" class="element text medium" maxlength="15" value="" type="text">
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
					<input id="element_3" name="Official_EMail_ID" class="element text medium" type="text" maxlength="255" value=""/> 
				
		</li>
		<li id="li_4">
		<label class="description" for="element_4">Please confirm your email address*</label>
		<div>
			<input id="element_4" name="Official_EMail_ID_confirm" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Please enter your phone number (including country code) </label>
		<span>
			<input id="element_6_1" name="Mobile_Phone_No" class="element text" size="13" maxlength="13" value="" type="text">
		</span>
		</li>		
		
<li id="li_5_1" >
		<label class="description" for="element_5">Enter your PAN Number </label>
		
		<span>
			<input id="element_5_1_1" name="PAN" class="element text currency" size="20" value="" type="text" />		
			<label for="element_5_1_1">Quoting your PAN number will help you claim the deduction under Section 80G for Income tax purposes.</label>
		</span>
		 
		</li>


		<li id="li_5" >
		<label class="description" for="element_5">Amount to donate*</label>
		
		<span>
			<input id="element_5_1" name="Donation_Amt" class="element text currency" size="10" value="" type="text" />		
			<label for="element_5_1">in Indian Rupees only</label>
		</span>
		 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Select the project to which you want to make donation </label>
		<div>
		<select class="element select medium" id="element_7" name="Certificate_ID"> 
			<option value="" selected="selected"></option>

<?php
//include("conn.php");
include("prod_conn.php");
$query = "SELECT  
P.CERTIFICATE_ID
,P.TITLE
,P.VALUE
FROM PROJECT_CERTIFICATES P
WHERE P.VALUE <  50000";
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
//$num_rows = mysql_num_rows($result);
while ($row = mysql_fetch_assoc($result)) {
		$Certificate_ID = $row['CERTIFICATE_ID'];
//		echo $Certificate_ID;
		$TITLE = $row['TITLE'];
		echo "<option value=\"$Certificate_ID\">$TITLE</option>";
		}

?>
		</select>
		</div> 
		</li>


		<li id="li_8" >
		<label class="description" for="element_5">Can we feature you on our home page</label>
		
		<span>
			<div>
		<select class="element select medium" id="element_7" name="Feature_Permission">	
			<option value="" selected="selected"></option>
<option value="Y" >Yes</option>
<option value="N" >No</option>
		</select>
		</div> 
			<label for="element_8_1">If you select 'Yes', we will feature you under the "Featured Donor" section on the home page of our website</label>
		</span>
		 
		</li>

		<li id="li_9" >
		<label class="description" for="element_5">Your quote (Optional)</label>
		
		<span>
			<input id="element_9_1" name="Feature_Quote" class="element text currency" size="50" value="" type="text" maxlength="255"/>		
			<label for="element_9_1">If you selected Yes in the previous option, we will show this quote along with your other information on the home page.</label>
		</span>
		 
		</li>

		<li id="li_10" >
		<label class="description" for="element_5">Link to your photograph</label>
		
		<span>
			<input id="element_9_1" name="Image_url" class="element text currency" size="50" value="" type="text" />		
			<label for="element_9_1">If you have your photograph uploaded anywhere online, please enter the direct link to the photo here.</label>
		</span>
		 
		</li>

			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="87639" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			Generated by <a href="http://www.phpform.org">pForm</a>
		</div>
	</div>
	<img id="bottom" src="css/bottom.png" alt="">
	</body>
</html>