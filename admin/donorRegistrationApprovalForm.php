<?php //require_once('login_auth.php');?>
<?php $thispage ="registrationApprovals"; ?>




<body id="wrapper" style="background: #FFFFFF">

<?php
//if (isset($_POST['submit']))
//{

//connect to database
include("prod_conn.php");
include("tableObjects/userTable.php");
include("tableObjects/donorTable.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query= "SELECT * FROM users u,donors d  WHERE u.".$user['id']."=d.user_id AND ".$user['regStatus']."='P' ";
$donorResult = mysql_query($query);
$donorResultCount=mysql_num_rows($donorResult);
?>

<?php
$password;
$ngocount=0;
$ngoUseridArray;
$donorcount=0;
$donorUseridArray;
$useridArray;
?>

<div align="center" id="donorApprovalsDiv" style="display: block"><?php 
if ($donorResultCount>0)
{
	
	generateDonorTable();
}
elseif ($donorResultCount==0)
{
	echo "You don't have any Registrations to Approve";
}
?></div>
<?php
function generateDonorTable()
{
	global $donorResult,$user,$donor,$donorcount,$donorUseridArray,$useridArray;
?>
<form id="approveRequests" name="approveRequests" method="post"
	action="<?php echo $_SERVER['PHP_SELF'];?>"><!-- a hidden field to identify which form is submitted.. field name is default for all forms value will be the name of form-->
<input name="formname" type="hidden" value="donorApproveRegistrationForm" />
<table align="center"  id="table-search" border="0">
	<thead>
	<tr style="font-weight:bold;">
		<th>S.No</th>
		<th>Username</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Date of Birth</th>
		<th>Address</th>
		<th>Gender</th>
		<th>City</th>
		<th>State</th>
		<th>Country</th>
		<th>Pincode</th>
		<th>Occupation</th>
		<th>Designation</th>
		<th>Phone Number</th>
		<th>Preferred Email ID</th>
		<th>Alternate Email ID</th>
		<th>PAN</th>
		<th>Feature Permission</th>
		<th>Feature Quote</th>
		<th>Display Name</th>
		<th>Org Name</th>
		<th>Org Type</th>
		<th>Org Description</th>
		
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php
	while($row = mysql_fetch_array($donorResult))
	{
		$donorUseridArray[$donorcount]=$row[$user['id']];
		//echo "    ".$donorUseridArray[$donorcount]." count= ".$donorcount;
		?>
	<tr <?php if($donorcount%2) echo "class=alt" ?>>
		<td><?php echo ++$donorcount; ?></td>
		<td><?php echo "".$row[$user['username']];?></td>
		<td><?php echo "".$row[$donor['fname']];?></td>
		<td><?php echo "".$row[$donor['lname']];?></td>
		<td><?php echo "".$row[$donor['dob']];?></td>
		<td><?php echo "".$row[$donor['gender']];?></td>
		<td><?php echo "".$row[$donor['address']];?></td>
		<td><?php echo "".$row[$donor['city']];?></td>
		<td><?php echo "".$row[$donor['state']];?></td>
		<td><?php echo "".$row[$donor['country']];?></td>
		<td><?php echo "".$row[$donor['pincode']];?></td>
		<td><?php echo "".$row[$donor['occupation']];?></td>
		<td><?php echo "".$row[$donor['designation']];?></td>
		<td><?php echo "".$row[$donor['phno']];?></td>
		<td><?php echo "".$row[$donor['preferredEmail']];?></td>
		<td><?php echo "".$row[$donor['alternateEmail']];?></td>
		<td><?php echo "".$row[$donor['pan']];?></td>
		<td><?php echo "".$row[$donor['featurePermission']];?></td>
		<td><?php echo "".$row[$donor['featureQuote']];?></td>
		<td><?php echo "".$row[$donor['displayName']];?></td>
		<td><?php echo "".$row[$donor['orgName']];?></td>
		<td><?php echo "".$row[$donor['orgType']];?></td>
		<td><?php echo "".$row[$donor['orgDesc']];?></td>
		
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
	</tbody>
</table>
<input name="donorApprovalRegistration" type="submit" value="submit" />
</form>
<?php
}
?>
<?php
$donorFormName="donorApprovalRegistration";

if (isset($_POST[$donorFormName]) )
{
	//echo " donor submitted <br />";
	$counter=0;
	
	$radioText;
	$displayName;
	//echo "fjgsdfjbsjkdfhjkasdfjksdf";
		$count=$donorcount;
		//echo $count;
		$radioText="daction";
		$useridArray=$donorUseridArray;


	
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
	echo "<script>window.location.href='".$_SERVER['PHP_SELF']."'</script>";

}
?>




<?php


function updateStatus($userID,$status)
{

	global $user,$donor,$useridArray,$displayName,$email,$ngo,$donorFormName;

	//echo "UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'<br />";
	mysql_query("UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'");
		$dpname="".$donor['displayName']."".$userID;
		$displayName=$_POST[$dpname];
		$mailName="".$user['username']."".$userID;
		$email= $_POST[$mailName];
	

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


</body>
</html>


