<?php $thispage ="registrationApprovals"; ?>

<body id="wrapper" style="background: #FFFFFF">

<?php
//connect to database
include("prod_conn.php");
include("tableObjects/userTable.php");
include("tableObjects/donorTable.php");
include("tableObjects/ngoTable.php");

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

$query= "SELECT * FROM users u,project_partners p  WHERE u.".$user['id']."=p.".$ngo['userid']." AND ".$user['regStatus']."='P' ORDER BY registration_date DESC";
$ngoResult = mysql_query($query);
$ngoResultCount=mysql_num_rows($ngoResult);
//echo "<script>alert('".$ngoResultCount."')</script>";
?>

<?php
$password;
$ngocount=0;
$ngoUseridArray; 
$donorcount=0;
$donorUseridArray;
$useridArray;
?>


<div align="center" id="ngoApprovalsDiv">
<?php if ($ngoResultCount>0)
{
	generateNgoTable();
}
else
{
	echo "You don't have any Registrations to Approve";
}?></div>

<?php

function generateNgoTable()
{
	global $user,$ngo,$ngoResult,$ngocount,$ngoUseridArray;
	?>
<form id="approveRequests" name="approveRequests" method="post"
	action="adminUcNgoRegistrations.php"><!-- a hidden field to identify which form is submitted.. field name is default for all forms value will be the name of form-->
<input name="formname" type="hidden" value="ngoApproveRegistrationForm" />

<table align="center" id="table-search" border="0">
	<thead>
	<tr >
		<th>S.No</th>
		<th>Username</th>
		<th>NGO</th>
		<th>Address</th>
		<th>Place</th>
		<th>Email</th>
		<th>Contact Name</th>
		<th>Gender</th>
		<th>Contact Number</th>
		<th>Contact Email</th>
		<th>Website</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php

	while($row = mysql_fetch_array($ngoResult))
	{
		$ngoUseridArray[$ngocount]=$row[$user['id']];
		//echo "".$ngoUseridArray[$ngocount]." count= ".$ngocount; ?>
	<tr>
		<td><?php echo ++$ngocount; ?></td>
		<td><?php echo "".$row[$user['username']];?></td>
		<td><?php echo "".$row[$ngo['name']];?></td>
		<td><?php echo "".$row[$ngo['address']];?></td>
		<td><?php echo "".$row[$ngo['city']];?></td>
		<td><?php echo "".$row[$ngo['partnerEmail']];?></td>
		<td><?php echo "".$row[$ngo['fname']]." ".$row[$ngo['lname']];?></td>
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
			value='<?php echo "".$row[$ngo['fname']]." ".$row[$ngo['lname']];?>' />
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
			id="action_0" /> Activate</label> <br />
		<label> <input type="radio"
			name="<?php echo "naction".$row[$user['id']]; ?>" value="R"
			id="action_1" /> Stall</label> <br />
		</td>
	</tr>
	<?php
	}

	?>
	</tbody>
</table>
<input name="ngoApprovalRegistration" type="submit" value="submit" /></form>


	<?php
}
?>
<?php

$ngoFormName="ngoApprovalRegistration";
if (isset($_POST[$ngoFormName]))
{
	//echo " donor submitted <br />";
	$counter=0;
	
	$radioText;
	$displayName;
	//echo "fjgsdfjbsjkdfhjkasdfjksdf";
		$count=$ngocount;
		$radioText="naction";
		$useridArray=$ngoUseridArray;
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
	
	echo "<script>window.location.href='".$_SERVER['PHP_SELF']."'</script>";

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
		$dpname="".$ngo['fname']."".$userID;
		$displayName=$_POST[$dpname];
		echo $displayName;
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
		$mail->AddBCC("contact@yousee.in");
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
	mysql_query("UPDATE users SET ".$user['password']."='".md5($password)."' WHERE ".$user['id']."='".$userID."'");
	return $password;
}


?>
<?php 
/* Change Log

02-Jul-2013 - Vivek - Password Encryption.

*/

