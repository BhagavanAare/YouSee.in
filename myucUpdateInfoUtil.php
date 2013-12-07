
<?php require_once('login_auth.php');?>

<?php $thispage = "myuc";
$activetab="myInfoTab";
include_once("prod_conn.php");
	$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 	//establishes database connection
	if (!$con) // if connection fails
	{
		die('Could not connect: ' . mysql_error()); // error is shown
	}
	mysql_select_db("$dbdatabase");
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
    <HEAD>
        <title>My UC | Update Info</title>
        <meta http-equiv="content-type" content="text/ html;charset=utf-8">
        <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/tabs.css">

        <link rel="stylesheet" href="scripts/jquery-ui.css">
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/jquery.ui.core.js"></script>
        <script src="scripts/jquery.ui.widget.js"></script>
        <script src="scripts/datepicker.js"></script>
        <script src="scripts/gen_validatorv4.js"></script>
      
        <script type="text/javascript">
            $(function() {
                // $( "#toDate\\[\\]" ).datepicker()
                $(".Date").datepicker();
            });


        </script>
        
        </HEAD>
        <BODY>

            <!--wrapper begin-->
            <div id="wrapper" >

                <!--header and navbar -->
                <?php include 'header_navbar.php';?>
                <div style="background:white">
                    <!--maincontentarea begin-->
                    <div id="uccertificate-main">

                    <!--maincontentarea end-->

                    <div>
                        <table>
                            <tr>
                                <td valign="top">
                                    <?php include 'myucTabs.php'; ?>
                                </td>
                                <td>

                                    <div>
                                        <script src="scripts/datepicker.js"></script>
                                        <script type="text/javascript">
                                            $(function() {
                                                // $( "#toDate\\[\\]" ).datepicker()
                                                $("#dob").datepicker();
                                            });


                                        </script>

                                        <?php



                                        include 'tableObjects/userTable.php';
                                        include 'tableObjects/donorTable.php';
                                        include 'tableObjects/ngoTable.php';

                                        $userID=$_SESSION['SESS_USER_ID'];
                                        $userType=$_SESSION['SESS_USER_TYPE'];

                                        $tableHeadElements;
                                        $queryResult;
                                        $formName;

                                        showDonorEditPage();
                                        function getDonorInfo()
                                        {
                                            global $userID, $array, $user, $donor, $tableHeadElements, $queryResult;
                                            $stringArray=array($donor['fname'],$donor['lname'],$donor['dob'],$donor['gender'],$donor['address'],$donor['city'],$donor['state'],$donor['country'],$donor['pincode'],$donor['occupation'],$donor['designation'],$donor['phno'],$donor['alternateEmail'],$donor['preferredEmail'],$donor['pan'],$donor['featurePermission'],$donor['featureQuote'],$donor['displayName'],$donor['orgName'],$donor['orgType'],$donor['orgDesc']);
                                            $attributes=arrayToString($stringArray);
                                            $query="select ".$attributes." from donors d, users u where u.user_id=d.user_id AND d.user_id='".$userID."'";
                                            $tableHeadElements = array("First Name","Last Name","Date of Birth", "Gender", "Address", "City","State","Country","Pincode","Occupation","Designation","Mobile Phone Number","Alternate Email","Preferred Email","PAN Card Number","Feature Permission","Feature Quote","Display Name","Organisation Name","Type","Desc");
                                            $queryResult=mysql_query($query);
                                            $r=mysql_num_fields($queryResult);
                                            //echo $r;
                                            //$queryResult;
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


                                        function showDonorEditPage()
                                        {
                                            global $userID, $array, $user, $donor, $tableHeadElements, $queryResult;

                                            getDonorInfo();
                                            

                                            $rows = mysql_fetch_array($queryResult,MYSQL_ASSOC);

                                            ?>

                                        <form name="donor" method="post" action="myucUpdateInfoUtil.php">
                                            <input type="hidden" name="formname" value="updateInfo"/>
                                            <fieldset><legend>Personal Info</legend>
                                                <table   border="0">
                                                    <tr>
                                                        <td><label for="firstName">First name</label></td>
                                                        <td><input name="fname" type="text" id="firstName" value = "<?php echo $rows[$donor['fname']]; ?>" disabled style="border:none" /></td>
                                                        <td><div class="error" id="donor_fname_errorloc"></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="lastName">Last name</label></td>
                                                        <td><input name="lname" type="text" id="lastName" value = "<?php echo $rows[$donor['lname']]; ?>" disabled style="border:none" /></td>
                                                        <td><div class="error" id="donor_lname_errorloc"></div></td>
                                                    </tr>

                                                    <tr>
                                                        <td><label>Date of Birth</label></td>
                                                        <td><input name="dob" type="text" id="dob" value = "<?php echo $rows[$donor['dob']]; ?>" /></td>
                                                        <td>&nbsp;</td>
                                                    <tr>
                                                        <td><label for="occupation">Occupation</label>
                                                        </td>
                                                        <td><input type="text" name="occupation" id="occupation" value = "<?php echo $rows[$donor['occupation']];?>" /></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <td><label for="donor_designation">Designation</label></td>
                                                    <td><input type="text" name="designation" id="donor_designation" value = "<?php echo $rows[$donor['designation']]; ?>" /></td>
                                                    <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="pan">PAN card no.</label>
                                                        </td>
                                                        <td><input type="text" name="pan" id="pan" value = "<?php echo $rows[$donor['pan']]; ?>" /></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align:top;">
                                                            <label for="quote">Quote <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>For featuring your photo and Quote on YouSee website we request you to  show a brief (1-3 lines) quote about your thoughts on volunteer,donations and overall about UC (max 300 characters)</span></a></span>
                                                            </label>
                                                        </td>
                                                        <td><span style="vertical-align:top;">
                                                                <textarea name="featureQuote" id="quote" cols="45" rows="5"><?php echo $rows[$donor['featureQuote']];?></textarea></span>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>

                                                </table>
                                            </fieldset>

                                            <fieldset><legend> Contact Info</legend>
                                                <table border="0">
                                                    <tr>
                                                        <td>
                                                            <label for="phone_number">Phone number*</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" maxlength="10"
                                                                   name="phno" id="phone_number" value = "<?php echo $rows[$donor['phno']]; ?>" />
                                                        </td>
                                                        <td>
                                                            <div class="error" id="donor_phno_errorloc"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="personal_emailid">Preferred Email ID</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="preferredEmail" id="preferred_emailid" value = "<?php echo $rows[$donor['preferredEmail']]; ?>" disabled  />
                                                        </td>
                                                        <td>
                                                            <div class="error" id="donor_preferredEmail_errorloc"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="official_emailid">Alternate Email ID</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="alternateEmail" id="alternate_emailid" value = "<?php echo $rows[$donor['alternateEmail']]; ?>" />
                                                        </td>
                                                        <td>
                                                            <div class="error" id="donor_alternateEmail_errorloc"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="donor_address">Address</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="address" id="donor_address" value = "<?php echo $rows[$donor['address']]; ?>"  />
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="city">City</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="city" id="city" value = "<?php echo $rows[$donor['city']]; ?>" />
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="donor_state">State*</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="state" id="donor_state" value = "<?php echo $rows[$donor['state']]; ?>"  />
                                                        </td>
                                                        <td>
                                                            <div class="error" id="donor_state_errorloc"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="donor_country">Country*</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="country" value="India" id="donor_country" value = "<?php echo $rows[$donor['country']]; ?>"  />
                                                        </td>
                                                        <td>
                                                            <div class="error" id="donor_country_errorloc"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label for="donor_pin_code">Pin code</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="pincode" id="donor_pin_code" value = "<?php echo $rows[$donor['pincode']]; ?>"  />
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </fieldset>



                                            <fieldset><legend> Organisation Info</legend>
                                                <table border="0">
                                                    <tr>
                                                        <td><label for="group_name">Org/Group Name</label></td>
                                                        <td>

                                                            <input type="text" name="orgName" id="group_name" value = "<?php echo $rows[$donor['orgName']]; ?>"  />
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="group_type">Org/Group Type</label></td>
                                                        <td>
                                                            <select name="orgType" id="group_type">

                                                                <option <?php if(($rows[$donor['orgType']])=="")
                                                                    {
                                                                        echo " selected";
                                                                        }?> value="">--Select--</option>
                                                                <option <?php if(($rows[$donor['orgType']])=="Company")
                                                                    {
                                                                        echo " selected";
                                                                        }?> value="Company">Company</option>
                                                                <option <?php if(($rows[$donor['orgType']])=="Society")
                                                                    {
                                                                        echo " selected";
                                                                        }?> value="Society">Cooperative Society</option>
                                                                <option <?php if(($rows[$donor['orgType']])=="Family")
                                                                    {
                                                                        echo " selected";
                                                                        }?> value="Family">Family</option>
                                                                <option <?php if(($rows[$donor['orgType']])=="Trust")
                                                                    {
                                                                        echo " selected";
                                                                        }?> value="Informal">Trust</option>
                                                                <option <?php if(($rows[$donor['orgType']])=="Unregistered Organisation")
                                                                    {
                                                                        echo " selected";
                                                                        }?> value="Unregistered Organisation">Unregistered Organisation</option>
                                                            </select></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align:top;"><label for="group_desc">Org/Group Description <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Please enter the details of your Group/Organisation(max 500 characters</span></label>
                                                                        </td>
                                                                        <td><textarea name="orgDesc" id="group_desc" cols="45" rows="5" ><?php echo $rows[$donor['orgDesc']];?></textarea></td>

                                                                        <td>&nbsp;</td>
                                                                        </tr>
                                                                        </table>


                                                                        </fieldset>

                                                                        <input name="submit" type="submit" value="Save Changes">
                                                                        </form>
                                                                        <script type="text/javascript">
                                                                            var frmvalidator  = new Validator("donor");
                                                                            frmvalidator.EnableFocusOnError(true);
                                                                            frmvalidator.EnableOnPageErrorDisplay();
                                                                            frmvalidator.EnableMsgsTogether();

                                                                            frmvalidator.addValidation("phno", "req", "	*Please enter  your Phone Number");
                                                                            frmvalidator.addValidation("preferredEmail", "email", "	*Please enter your Email properly");
                                                                            frmvalidator.addValidation("alternateEmail", "email", "	*Please enter your Email properly");
                                                                            frmvalidator.addValidation("preferredEmail", "req", "	*Please enter your Email.");
                                                                            frmvalidator.addValidation("state", "req", "	*Please enter  State");
                                                                            frmvalidator.addValidation("state", "alpha_s", "	*State must only contain characters");
                                                                            frmvalidator.addValidation("country", "req", "	*Please enter Country");
                                                                            frmvalidator.addValidation("country", "alpha_s", "	*Country must  only contain characters");frmvalidator.addValidation("fname","req","please enter first name");
                                                                            frmvalidator.addValidation("lname","req","please enter last name");
                                                                        </script>
                                                                            <?php
                                                                            //echo "<script>alert('".$_POST['submit']."')</script>"; exit();
                                                                            if(isset($_POST['submit']) )
                                                                            {

                                                                                include 'tableObjects/donorTable.php';
                                                                                /* Capitalize first letter of a word in Strings*/
                                                                                $_POST['city']=ucwords($_POST['city']);
                                                                                //echo $_POST['city'];
                                                                                $_POST['state']=ucwords($_POST['state']);
                                                                                $_POST['country']=ucwords($_POST['country']);
                                                                                $_POST['pincode']=mb_strtoupper($_POST['pincode']);
                                                                                $_POST['occupation']=ucwords($_POST['occupation']);
                                                                                $_POST['designation']=ucwords($_POST['designation']);
                                                                                $_POST['pan']=mb_strtoupper($_POST['pan']);
                                                                                $_POST['orgName']=ucwords($_POST['orgName']);

                                                                                $_POST['featurePermission']="N";
                                                                                $donorInsertAtts="".$donor['dob'].",".$donor['address'].",".$donor['city'].",".$donor['state'].",".$donor['country'].",".$donor['pincode'].",".$donor['occupation'].",".$donor['designation'].",".$donor['phno'].",".$donor['alternateEmail'].",".$donor['pan'].",".$donor['featurePermission'].",".$donor['featureQuote'].",".$donor['orgName'].",".$donor['orgType'].",".$donor['orgDesc']."";


                                                                                $donorValues="'".$_POST['dob']."','".$_POST['address']."','".$_POST['city']."','".$_POST['state']."','".$_POST['country']."','".$_POST['pincode']."','".$_POST['occupation']."','".$_POST['designation']."','".$_POST['phno']."','".$_POST['alternateEmail']."','".$_POST['pan']."','".$_POST['featurePermission']."','".$_POST['featureQuote']."','".$_POST['orgName']."','".$_POST['orgType']."','".$_POST['orgDesc']."'";

                                                                                //echo $donorValues;
                                                                                //echo "<script>alert(".$donorValues.")</script>";
                                                                                $insertDonorQuery="UPDATE donors SET ".$donor['dob'] ."='".$_POST['dob']."',".$donor['address'] ."='".$_POST['address']."',".$donor['city'] ."='".$_POST['city']."',".$donor['state'] ."='".$_POST['state']."',".$donor['country'] ."='".$_POST['country']."',".$donor['pincode'] ."='".$_POST['pincode']."',".$donor['occupation'] ."='".$_POST['occupation']."', ".$donor['designation'] ."='".$_POST['designation']."',".$donor['phno'] ."='".$_POST['phno']."',".$donor['alternateEmail'] ."='".$_POST['alternateEmail']."',".$donor['pan'] ."='".$_POST['pan']."',".$donor['featurePermission'] ."='".$_POST['featurePermission']."',".$donor['featureQuote'] ."='".$_POST['featureQuote']."',".$donor['orgName'] ."='".$_POST['orgName']."',".$donor['orgType']."='".$_POST['orgType']."',".$donor['orgDesc'] ."='".$_POST['orgDesc']."' WHERE user_id ='".$userID."' ";
                                                                                

                                                                                if (!mysql_query($insertDonorQuery))
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
                                                                        </div>

                                                                        </table>
                                                                        <br/>
                                                                        </div>



                                                                        </div>
                                                                        <!--footer-->
                                                                        <?php include 'footer.php' ; ?>

                                                                        </div>
                                                                        <!--wrapper end-->

                                                                        </BODY>
                                                                        </HTML>













