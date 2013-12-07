<?php require_once('login_auth.php');?>

<?php $thispage = "myuc";

include_once("prod_conn.php");
	$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 	//establishes database connection
	if (!$con) // if connection fails
	{
		die('Could not connect: ' . mysql_error()); // error is shown
	}
	mysql_select_db("$dbdatabase");
	
?>

<?php $thispage = "ngoHomescreen"; 
$activetab="orgInfoTab";

if (!$_SESSION['SESS_USER_TYPE']=="N")
{
	header(header("Location: login_failed"));
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>My UC | Update Org Info</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="test/test.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
          <script src="scripts/gen_validatorv4.js"></script>
	</HEAD>
	<BODY>

		<!--wrapper begin-->
		<div id="wrapper" style="background:white; margin-bottom:20px;">

			<!--header and navbar -->
			<?php include 'header_navbar.php';?>

			<!--maincontentarea begin-->
			<div id="content-main">
			<table>
				<tr>
					<td valign="top">
						<div class="left_div" style=" float:left" >
							<?php include 'ngo_uc_tabs.php'; ?>
						</div>
					</td>
					<td>
						<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >

									<?php



										include 'tableObjects/userTable.php';
                                        include 'tableObjects/donorTable.php';
                                        include 'tableObjects/ngoTable.php';

                                        $userID=$_SESSION['SESS_USER_ID'];
                                        $userType=$_SESSION['SESS_USER_TYPE'];

                                        $tableHeadElements;
                                        $queryResult;
                                        $formName;

                                        showNGOEditPage();
										
                                        function getNGOInfo()
										{
											global $userID, $array, $user, $ngo, $tableHeadElements,$queryResult;
											$stringArray=array($ngo['name'],$ngo['type'],$ngo['address'],$ngo['city'],$ngo['state'],$ngo['country'],$ngo['pincode'],$ngo['fname'],$ngo['lname'],$ngo['gender'],$ngo['designation'],$ngo['phone'],$ngo['contactEmail'],$ngo['url'],$ngo['partnerEmail']);
											$attributes=arrayToString($stringArray);
											
											
											
											$query="select ".$attributes." from project_partners p, users u where u.user_id=p.user_id AND p.user_id='".$userID."'";
    
    										//echo $query;

											$queryResult=mysql_query($query);
                                            $r=mysql_num_fields($queryResult);
											
										
								
											//echo $queryResult;
											


										}

                                        function arrayToString($array)
                                        {
                                            $string="";
                                            foreach ($array as $key => $value)
                                            {
                                                $string.="".$value.",";
                                            }
                                            $string=substr($string, 0, -1);
                                            return $string;
                                        }


                                        function showNGOEditPage()
                                        {
                                            global $userID, $array, $user, $ngo, $tableHeadElements,$queryResult;

                                            getNGOInfo();
                                            //echo "<script>alert(".$queryResult.")</script>";
											//echo $queryResult;
                                            $rows = mysql_fetch_array($queryResult,MYSQL_ASSOC);

                                            ?>

                                        <form name="NGO" method="post" action="ngo_uc_update_org_info.php">
                                            <input type="hidden" name="formname" value="updateInfo"/>
											
											<fieldset><legend> Organisation Info</legend>
                                                <table border="0">
													<tr>
														<td><label for="partner_name">Organisation Name*</label></td>
														<td> <input type="text" name="partnerName" style="text-transform:capitalize" id="partner_name"  value = "<?php echo $rows[$ngo['name']]; ?>" disabled /></td>
													</tr>
													<tr>
														<td><label for="partner_type">Organisation Type*</label></td>
														<td>
															<select name="partnerType" id="partner_type">
																<option <?php if(($rows[$ngo['type']])=="Government")
                                                                    {
                                                                        echo " selected";
                                                                    }?> value="Government">Government Institution</option >
																<option <?php if(($rows[$ngo['type']])=="Company")
                                                                    {
                                                                        echo " selected";
                                                                    }?> value="Company">Section 25 Company</option>
																<option <?php if(($rows[$ngo['type']])=="Society")
                                                                    {
                                                                        echo " selected";
                                                                    }?> value="Society">Society</option>
																<option <?php if(($rows[$ngo['type']])=="Trust")
                                                                    {
                                                                        echo " selected";
                                                                    }?> value="Trust">Trust</option>
																<option <?php if(($rows[$ngo['type']])=="Unregistered Organisation")
                                                                    {
                                                                        echo " selected";
                                                                    }?> value="Unregistered Organisation">Unregistered Organisation</option>
															</select></td>
														
													</tr>
													<tr>
														<td style="vertical-align:top;"><label for="partner_email_id">Email ID*</label></td>
														<td><span style="vertical-align:top;">
														<input type="text" name="partnerEmailId" id="partner_email_id" value = "<?php echo $rows[$ngo['partnerEmail']]; ?>" />
														</span></td>
														<td><div class="error" id="NGO_partnerEmailId_errorloc"></td>
    												</tr>
														<td><label for="hqaddress">Office Address:</label></td>
														<td><input type="text" name="address" id="hqaddress" value = "<?php echo $rows[$ngo['address']]; ?>" /></td>
														<td>&nbsp;</td>
														</tr>

													<tr>
														<td><label for="city">City</label></td>
														<td><input type="text" name="hqcity" id="city" style="text-transform:capitalize" value = "<?php echo $rows[$ngo['city']]; ?>"/></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td><label for="partnerstate">State*</label></td>
														<td><input type="text" name="hqstate" id="partnerstate" style="text-transform:capitalize" value = "<?php echo $rows[$ngo['state']]; ?>"  /></td>
														<td><div class="error" id="NGO_hqstate_errorloc"></td>
													</tr>
													<tr>
														<td><label for="partnercountry">Country*</label></td>
														<td><input type="text" name="hqcountry" style="text-transform:capitalize" id="partnercountry" value="India" value = "<?php echo $rows[$ngo['country']]; ?>" /></td>
														<td><div class="error" id="NGO_hqcountry_errorloc"></td>
													</tr>
													<tr>
														<td><label for="partnerpin_code">Pin code</label></td>
														<td><input type="text" name="hqpincode" id="partnerpin_code" value = "<?php echo $rows[$ngo['pincode']]; ?>" /></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td><label for="website">Website</label></td>
														<td><input type="text" name="website" id="website" value = "<?php echo $rows[$ngo['url']]; ?>" /></td>
														<td>&nbsp;</td>
													</tr>
                                                </table>
                                            </fieldset>
											
                                            <fieldset><legend>Contact Info</legend>
                                                <table border="0">
													<tr>
														<td><label for="firstName">First name*</label></td>
														<td><input name="fname"
														style="text-transform: capitalize" type="text" id="firstName" value = "<?php echo $rows[$ngo['fname']]; ?>" /></td>
														<td>
															<div class="error" id="NGO_fname_errorloc"></div>
														</td>
													</tr>
													<tr>
														<td><label for="lastName">Last name*</label></td>
														<td><input name="lname" style="text-transform: capitalize" type="text" id="lastName" value = "<?php echo $rows[$ngo['lname']]; ?>" /></td>
														<td>
														<div class="error" id="NGO_lname_errorloc"></div>
														</td>
													</tr>
													<tr>
														<td>Gender</td>
														<td>
															<p><label> <input type="radio" name="gender" value="M" id="sexRadio_0"  <?php if(($rows[$ngo['gender']])=="M")
                                                                    {
                                                                        echo " checked";
                                                                    }?>  /> Male</label> <label> <input type="radio" name="gender" value="F" id="sexRadio_1" <?php if(($rows[$ngo['gender']])=="F")
                                                                    {
                                                                        echo " checked";
                                                                    }?> /> Female</label> <br/></p>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td><label for="ngo_designation">Designation</label></td>
														<td><input type="text" name="designation" style="text-transform: capitalize" id="ngo_designation" value = "<?php echo $rows[$ngo['designation']]; ?>" /></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td><label for="phone_number">Phone Number * <span class="link"	><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Enter a valid Phone Number</span></a></span></label></td>
														<td><input type="text" name="phno" id="phone_number" value = "<?php echo $rows[$ngo['phone']]; ?>" /></td>
														<td><div class="error" id="NGO_phno_errorloc"></div></td>
													</tr>
													<tr>
														<td><label for="personal_emailid"> Email ID  </label></td>
														<td><input type="text" name="personalEmail" id="personalemailid" value = "<?php echo $rows[$ngo['contactEmail']]; ?>" /></td>
														<td><div class="error" id="NGO_personalEmail_errorloc"></div></td>
													</tr>

												</table>

											</fieldset>

											<input name="submit" type="submit" value="Save Changes">
										</form>
										
										<script type="text/javascript">
											var ngovalidator  = new Validator("NGO");
											ngovalidator.EnableFocusOnError(true);
											ngovalidator.EnableOnPageErrorDisplay();
											ngovalidator.EnableMsgsTogether();
											
											ngovalidator.addValidation("partnerEmailId","req","Please enter NGO Emaild ID");
											ngovalidator.addValidation("partnerEmailId","email","Please enter proper Emaild ID");

											ngovalidator.addValidation("hqstate","req","Please enter your Head Quarter's State");
											
											ngovalidator.addValidation("hqstate","alpha_s","State should only contain alphabets");
											ngovalidator.addValidation("hqcountry","req","Please enter your Head Quarter's country");
											ngovalidator.addValidation("hqcountry","alpha_s","Country should only contain alphabets");
										
											ngovalidator.addValidation("fname","req","Please enter your First Name");
											ngovalidator.addValidation("fname","alpha_s","First Name should contain only characters");
											ngovalidator.addValidation("lname","req","Please enter your Last Name");
											ngovalidator.addValidation("lname","alpha_s","Last Name should contain only characters");
											
											ngovalidator.addValidation("phno","req","Please enter your Phone number");
											
											ngovalidator.addValidation("personalEmail","email","Please enter proper Emaild ID");

											//ngovalidator.addValidation("phno","num","Please enter numbers only");
										</script>
										
										
										<?php
										if(isset($_POST['submit']) )
										{

											include 'tableObjects/ngoTable.php';
												/* Capitalize first letter of a word in Strings*/
											$_POST['city']=ucwords($_POST['city']);
                                                                                //echo $_POST['city'];
											$_POST['hqstate']=ucwords($_POST['hqstate']);
											$_POST['hqcountry']=ucwords($_POST['hqcountry']);
											$_POST['hqpincode']=mb_strtoupper($_POST['hqpincode']);
											$_POST['occupation']=ucwords($_POST['occupation']);
											$_POST['fname']=ucwords($_POST['fname']);
											$_POST['lname']=ucwords($_POST['lname']);
										
										
										
											$insertNGOQuery="UPDATE project_partners SET ".$ngo['type'] ."='".$_POST['partnerType'] ."',".$ngo['partnerEmail'] ."='".$_POST['partnerEmailId']."',".$ngo['address'] ."='".$_POST['address']."',".$ngo['city'] ."='".$_POST['hqcity']."',".$ngo['state'] ."='".$_POST['hqstate']."',".$ngo['country'] ."='".$_POST['hqcountry']."',".$ngo['pincode'] ."='".$_POST['hqpincode']."', ".$ngo['fname'] ."='".$_POST['fname']."',".$ngo['lname'] ."='".$_POST['lname']."',".$ngo['gender'] ."='".$_POST['gender']."',".$ngo['designation'] ."='".$_POST['designation']."',".$ngo['phone'] ."='".$_POST['phno']."',".$ngo['contactEmail'] ."='".$_POST['personalEmail']."',".$ngo['url']."='".$_POST['website']."' WHERE user_id ='".$userID."'";
                                                                                
											echo $insertNGOQuery;
											if (!mysql_query($insertNGOQuery))
											{
												die('Error: ' . mysql_error());
												//showError();
												exit();
											}
											echo "<script>window.location.href='".$_SERVER['PHP_SELF']."'</script>";

										}


									}
									?>
							</div>
						</td>
					</tr>
				</table>
<!--footer-->
			</div>
			<?php include 'footer.php' ; ?>

		</div>
<!--wrapper end-->

 </BODY>
</HTML>
