<?php //require_once('login_auth.php');?>
<?php $thispage ="registrationApprovals"; ?>




<body
	id="wrapper" style="background: #FFFFFF">

<?php
//if (isset($_POST['submit']))
//{

//connect to database
include("prod_conn.php");
include("tableObjects/userTable.php");
include("tableObjects/donorTable.php");
include("tableObjects/ngoTable.php");

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query= "SELECT * FROM users u,donors d  WHERE u.".$user['id']."=d.user_id AND ".$user['regStatus']."='P' ";
$donorResult = mysql_query($query);
$donorResultCount=mysql_num_rows($donorResult);
?>
<?php

//$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";
$query= "SELECT * FROM users u,project_partners p  WHERE u.".$user['id']."=p.".$ngo['userid']." AND ".$user['regStatus']."='P' ";
$ngoResult = mysql_query($query);
$ngoResultCount=mysql_num_rows($ngoResult);
?>

<?php
$password;
$ngocount=0;
$ngoUseridArray;
$donorcount=0;
$donorUseridArray;
$useridArray;

if(isset($_SESSION['POST_DATA']))
{
	//Get post data from session variable
	$_POST=$_SESSION['POST_DATA'];
	unset($_SESSION['POST_DATA']);
}
?>
<!--******************************** TABS *******************************-->

<script language="javascript">
var group="regApproval";
createGroup(group);
registerTab(group,"donor","donorDiv");
registerTab(group,"ngo","ngoDiv");

</script>

<div align="center" id="tab" class="tab">
<ul class="tabContainer">
	<div id="tabs" class="tab-box"><a
		onClick="showTab('regApproval','donor');" class="tabLink activeLink"
		id="donor">Donors <?php echo " (".$donorResultCount.")";?></a> <a
		onClick="showTab('regApproval','ngo')" class="tabLink" id="ngo"> NGOs
		<?php echo " (".$ngoResultCount.")";?> </a></div>
</ul>
</div>


<div align="center" id="donorDiv" style="display: block"><?php 
if ($donorResultCount>0)
{
	generateDonorTable();
}
elseif ($donorResultCount==0)
{
	echo "You don't have any Registrations to Approve";
}
?></div>
<div align="center" id="ngoDiv" style="display: none"><?php if ($ngoResultCount>0)
{
	generateNgoTable();
}
else
{
	echo "You don't have any Registrations to Approve";
}?></div>

<?php
function generateDonorTable()
{
	global $donorResult,$user,$donor,$donorcount,$donorUseridArray,$useridArray;
	?>



<form id="approveRequests" name="approveRequests" method="post"
	action="redirect.php"><!-- a hidden field to identify which form is submitted.. field name is default for all forms value will be the name of form-->
<input name="formname" type="hidden" value="donorApproveRegistration" />
<table align="center" id="altColorTable" border="0">
	<tr class="alt">
		<td>S.No</td>
		<td>Username</td>
		<td>Gender</td>
		<td>Donor Name</td>
		<td>Date of Birth</td>
		<td>Place</td>
		<td>Organisation Name</td>
		<td>Phone Number</td>
		<td>Email ID</td>
		<td>Action</td>
	</tr>
	<?php
	while($row = mysql_fetch_array($donorResult))
	{
		$donorUseridArray[$donorcount]=$row[$user['id']];
		//echo "    ".$donorUseridArray[$donorcount]." count= ".$donorcount;
		?>
	<tr <?php if($donorcount%2) echo "class=alt" ?>>
		<td><?php echo ++$donorcount; ?></td>
		<td><?php echo "".$row[$user['username']];?></td>

		<td><?php echo "".$row[$donor['gender']];?></td>
		<td><?php echo "".$row[$donor['fname']];?></td>

		<td><?php echo "".$row[$donor['dob']];?></td>
		<td><?php echo "".$row[$donor['city']];?></td>
		<td><?php echo "".$row[$donor['orgName']];?></td>
		<td><?php echo "".$row[$donor['phno']];?></td>
		<td><?php echo "".$row[$user['username']];?></td>

		<!-- Hidden fields required to update set password , send email-->

		<input type="hidden"
			name=<?php echo "".$user['username']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$user['username']]; ?> />
		<input type="hidden"
			name=<?php echo  "".$donor['fname']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$donor['fname']];?> />
		<input type="hidden"
			name=<?php echo "".$user['username']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$user['username']]; ?> />
		<input type="hidden"
			name=<?php echo "".$donor['displayName']."".$row[$user['id']]; ?>
			value="<?php echo $row[$donor['displayName']]; ?>" />
		<input type="hidden" name="userType" value="ngo" />

		<td><label> <input type="radio"
			name="<?php echo "daction".$row[$user['id']]; ?>" value="A"
			id="action_0" /> Approve</label> <br />

		<label> <input type="radio"
			name="<?php echo "daction".$row[$user['id']]; ?>" value="R"
			id="action_1" /> Reject</label> <br />
		<input type="radio" name="<?php echo "daction".$row[$user['id']]; ?>"
			value="P" id="action_2" checked="checked" /> Pending</label> <br />

		</td>
	</tr>
	<?php
	}

	?>
</table>
<input name="donorApprovalRegistration" type="submit" value="submit" />
</form>


	<?php
}?>




<?php

function generateNgoTable()
{
	global $user,$ngo,$ngoResult,$ngocount,$ngoUseridArray;
	?>
<form id="approveRequests" name="approveRequests" method="post"
	action="redirect.php"><!-- a hidden field to identify which form is submitted.. field name is default for all forms value will be the name of form-->
<input name="formname" type="hidden" value="ngoApproveRegistration" />

<table align="center" id="altColorTable" border="0">
	<tr class="alt">
		<td>S.No</td>
		<td>Username</td>
		<td>NGO</td>
		<td>Address</td>
		<td>Place</td>
		<td>Email</td>
		<td>Contact Name</td>
		<td>Gender</td>
		<td>Contact Number</td>
		<td>Contact Email</td>
		<td>Website</td>
		<td>Action</td>
	</tr>
	<?php

	while($row = mysql_fetch_array($ngoResult))
	{
		$ngoUseridArray[$ngocount]=$row[$user['id']];
		//echo "".$ngoUseridArray[$ngocount]." count= ".$ngocount; ?>
	<tr <?php if($ngocount%2) echo "class=alt" ?>>
		<td><?php echo ++$ngocount; ?></td>
		<td><?php echo "".$row[$user['username']];?></td>
		<td><?php echo "".$row[$ngo['name']];?></td>
		<td><?php echo "".$row[$ngo['address']];?></td>
		<td><?php echo "".$row[$ngo['city']];?></td>
		<td><?php echo "".$row[$ngo['partnerEmail']];?></td>
		<td><?php echo "".$row[$ngo['fname']];?></td>
		<td><?php echo "".$row[$ngo['gender']];?></td>
		<td><?php echo "".$row[$ngo['phone']];?></td>
		<td><?php echo "".$row[$ngo['contactEmail']];?></td>
		<input type="hidden"
			name=<?php echo  "".$user['username']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$user['username']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['name']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['name']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['address']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['address']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['city']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['city']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['partnerEmail']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['partnerEmail']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['fname']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['fname']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['gender']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['gender']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['phone']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['phone']];?> />
		<input type="hidden"
			name=<?php echo  "".$ngo['contactEmail']."".$row[$user['id']]; ?>
			value=<?php echo "".$row[$ngo['contactEmail']];?> />


		<input type="hidden" name="userType" value="ngo" />
		<td><a href="<?php echo "".$row[$ngo['url']];?>"><?php echo "".$row[$ngo['url']];?></a></td>


		<td><label> <input type="radio"
			name="<?php echo "naction".$row[$user['id']]; ?>" value="A"
			id="action_0" /> Approve</label> <br />
		<label> <input type="radio"
			name="<?php echo "naction".$row[$user['id']]; ?>" value="R"
			id="action_1" /> Reject</label> <br />
		<input type="radio" name="<?php echo "naction".$row[$user['id']]; ?>"
			value="S" id="action_2" checked="checked" /> Stall</label> <br />

		</td>
	</tr>
	<?php
	}

	?>
</table>
<input name="ngoApprovalRegistration" type="submit" value="submit" /></form>


	<?php
}
?>
<?php
$donorFormName="donorApprovalRegistration";
$ngoFormName="ngoApprovalRegistration";
if (isset($_POST[$donorFormName]) || isset($_POST[$ngoFormName]))
{
	//echo " donor submitted <br />";
	$counter=0;
	
	$radioText;
	$displayName;
	//echo "fjgsdfjbsjkdfhjkasdfjksdf";
	if(isset($_POST['donorApprovalRegistration']))
	{
		$count=$donorcount;
		//echo $count;
		$radioText="daction";
		$useridArray=$donorUseridArray;


	}
	else
	{
		$count=$ngocount;
		$radioText="naction";
		$useridArray=$ngoUseridArray;
	}
	while($count)
	{
		
		$email;
		$userid=$useridArray[$counter];
		//echo "     ".$useridArray[$counter];
		//echo " count=".$count." counter=".$counter." userid=".$userid."<br />";

		$counter++;
		$radioID="".$radioText."".$userid;
		//echo "".$radioID;
		$value=$_POST[$radioID];
		/*echo "<script>alert('$value')</script>";*/
		if($value=="A")
		{

			//echo $userid." approved";
			updateStatus($userid,$value);
			$password=setPassword($userid);
			//	$username=$_POST["".$user['username']."".$userid];
			$username=$email;

			/*echo "<script>alert('$username')</script>";*/
			sendEmail($userid,$email,$username,$password);

		}
		elseif($value=="R")
		{
			//echo $userid." rejected";
			updateStatus($userid,$value);
		}
		elseif($value=="S")
		{
			//echo $userid." stalled";
		}

		$count=$count-1;
	}
	$approveCount;
	/*echo "<script>alert('$donor');</script>";*/
	echo "<script>window.location.href='adminHomescreen.php'</script>";

}
?>




<?php


function updateStatus($userID,$status)
{

	global $user,$donor,$useridArray,$displayName,$email,$ngo,$donorFormName;

	//echo "UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'<br />";
	mysql_query("UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'");

	if (isset($_POST[$donorFormName]))
	{
		$dpname="".$donor['displayName']."".$userID;
		$displayName=$_POST[$dpname];
		$mailName="".$user['username']."".$userID;
		$email= $_POST[$mailName];
	}
	else
	{
		$dpname="".$ngo['name']."".$userID;
		$displayName=$_POST[$dpname];
		$mailName="".$ngo['partnerEmail']."".$userID;
		$email= $_POST[$mailName];
	}


}
function sendEmail($userID,$email,$username,$password)
{
	include_once ("Email/class.phpmailer.php");
	include("Email/config.php");
	global $user,$donor,$useridArray,$displayName,$donorFormName;

	//echo "     email  ".$email;
	//echo "   dpname   ".$displayName;
	try{

		$to = $email;
		$mail->AddAddress($to);
		$subject= "Registration Confirmation ";


		$body =  "Dear  " . $displayName . ",<br>This is to acknowledge completion of registration on UC website.You can now visit yousee.in with the following <br/> Username : " . $username . " <br/> password : " . $password . " <br><br><br>";
		$body.="<br><br><br> From YouSee  (+91-8008-884422) <br /> <a href=\"www.yousee.in\">www.yousee.in</a>";

		$mail->Subject = $subject;
		$mail->Body = $body;
		if($mail->Send())
		{
			;
		}
		else
		{
			//echo "<script>alert('Email Failed');</script>";
		}
		//echo 'Registration Complete.';
	}
	catch (phpmailerException $e) {
		echo $e->errorMessage();
		echo "<script>alert('Message failed');</script>";
	}

}
function setPassword($userID) {
	global $user;
	$length=8;
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$password = substr(str_shuffle($chars),0,$length);
	//echo $password;
	mysql_query("UPDATE users SET ".$user['password']."='".$password."' WHERE ".$user['id']."='".$userID."'");
	return $password;
}


?>
<?php


if(isset($_POST['formname']))
{


	echo $_POST['formname'];
	
	if($_POST['formname']==$donorFormName)
	{
		echo "<script> showTab('regApproval','donor')</script>";
	}
	else
	{
		echo "<script> showTab('regApproval','ngo')</script>";
	}
}


?>


</body>
</html>


