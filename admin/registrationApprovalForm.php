<?php //require_once('login_auth.php');?>
<?php $thispage ="registrationApprovals"; ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Approvals</title>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link href="../css/table.css" rel="stylesheet" type="text/css" />
<script src="../scripts/tabscripts.js"></script>
</head>

<body id="wrapper" style="background:#FFFFFF">

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
 //$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";          
 $donorResult = mysql_query($query);
 ?>
 <!--******************************** TABS *******************************-->

<script language="javascript" >
var group="approval";
createGroup(group);
registerTab(group,"donor","donorDiv");
registerTab(group,"ngo","ngoDiv");

</script>

<div align="center" id="tab" class="tab"   >
<ul  class="tabContainer" >  
<div id="tabs" class="tab-box">
    <a onClick="showTab('approval','donor');" class="tabLink activeLink" id="donor">Donors</a>
    <a onClick="showTab('approval','ngo')" class="tabLink" id="ngo">NGOs</a>

</div>
</ul>
</div>
 
 
 
 
 
 <div align="center" id="donorDiv" style="display:block">
 
 <form id="approveRequests" name="approveRequests" method="post" action="redirect.php">
 <!-- a hidden field to identify which form is submitted.. field name is default for all forms value will be the name of form-->
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
 <?php $donorcount=0;
 $donorUseridArray;
 $useridArray;
 while($row = mysql_fetch_array($donorResult))
  {
	  $donorUseridArray[$donorcount]=$row[$user['id']];
		//echo "    ".$donorUseridArray[$donorcount]." count= ".$donorcount;
	    ?><tr <?php if($donorcount%2) echo "class=alt" ?>>
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

     <input type="hidden" name=<?php echo "".$user['username']."".$row[$user['id']]; ?> value=<?php echo "".$row[$user['username']]; ?>/>
     <input type="hidden" name=<?php echo  "".$donor['fname']."".$row[$user['id']]; ?> value=<?php echo "".$row[$donor['fname']];?> />
     <input type="hidden" name=<?php echo "".$user['username']."".$row[$user['id']]; ?> value=<?php echo "".$row[$user['username']]; ?> />
	 <input type="hidden" name=<?php echo "".$donor['displayName']."".$row[$user['id']]; ?> value="<?php echo $row[$donor['displayName']]; ?>" />
	 <input type="hidden" name="userType" value="ngo" />

     <td>         
           <label>
             <input type="radio" name="<?php echo "daction".$row[$user['id']]; ?>" value="A"    id="action_0" />
             Approve</label>
           <br />
		  
           <label>
             <input type="radio" name="<?php echo "daction".$row[$user['id']]; ?>" value="R"  id="action_1" />
            
             Reject</label>
             <br />
             <input type="radio" name="<?php echo "daction".$row[$user['id']]; ?>" value="P"  id="action_2" checked="checked" />
             Pending</label>
           <br />
         
     </td>   	
  </tr><?php
  }
  ?>
  </table>
  <input name="donorApprovalRegistration" type="submit" value="submit" />
  </form>
  
</div>

  <?php
  
 //$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";
 $query= "SELECT * FROM users u,project_partners p  WHERE u.".$user['id']."=p.".$ngo['userid']." AND ".$user['regStatus']."='P' ";          
           
 $ngoResult = mysql_query($query);
 
 //echo $ngoResult;
 
 while($row = mysql_fetch_array($ngoResult))
  {
	   //echo $row;

 
  echo "<br />";
  }
  
  
 //$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";          
 $ngoResult = mysql_query($query);
 ?>
 <div align="center" id="ngoDiv" style="display:none">
 <form id="approveRequests" name="approveRequests" method="post" action="redirect.php">
 
  <!-- a hidden field to identify which form is submitted.. field name is default for all forms value will be the name of form-->
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
 <?php $ngocount=0;
 $ngoUseridArray;
 while($row = mysql_fetch_array($ngoResult))
  {
	  $ngoUseridArray[$ngocount]=$row[$user['id']];
		//echo "    ".$ngoUseridArray[$ngocount]." count= ".$ngocount;
	    ?><tr <?php if($ngocount%2) echo "class=alt" ?>>
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
          <input type="hidden" name=<?php echo  "".$user['username']."".$row[$user['id']]; ?> value=<?php echo "".$row[$user['username']];?> />
          <input type="hidden" name=<?php echo  "".$ngo['name']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['name']];?> />
    <input type="hidden" name=<?php echo  "".$ngo['address']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['address']];?> />
    <input type="hidden" name=<?php echo  "".$ngo['city']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['city']];?> />
    <input type="hidden" name=<?php echo  "".$ngo['partnerEmail']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['partnerEmail']];?> />
    <input type="hidden" name=<?php echo  "".$ngo['fname']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['fname']];?> />
    <input type="hidden" name=<?php echo  "".$ngo['gender']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['gender']];?> />
    <input type="hidden" name=<?php echo  "".$ngo['phone']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['phone']];?> />
    <input type="hidden" name=<?php echo  "".$ngo['contactEmail']."".$row[$user['id']]; ?> value=<?php echo "".$row[$ngo['contactEmail']];?> />


 	<input type="hidden" name="userType" value="ngo" />
     <td><a href="<?php echo "".$row[$ngo['url']];?>"><?php echo "".$row[$ngo['url']];?></a></td>   
   
  
     <td>         
           <label>
             <input type="radio" name="<?php echo "naction".$row[$user['id']]; ?>" value="A"    id="action_0" />
             Approve</label>
           <br />
           <label>
             <input type="radio" name="<?php echo "naction".$row[$user['id']]; ?>" value="R"  id="action_1" />
            
             Reject</label>
             <br />
             <input type="radio" name="<?php echo "naction".$row[$user['id']]; ?>" value="S"  id="action_2" checked="checked" />
             Stall</label>
           <br />
         
     </td>   	
  </tr><?php 
  }
  ?>
  </table>
  <input name="formSubmitted" type="submit" value="submit" />
  </form>
  
 </div>
 

<?php
	$password;

if (isset($_POST['donorApprovalRegistration']) || isset($_POST['ngoApprovalRegistration'])) 
{
	//echo " donor submitted <br />";
	$counter=0;
	$count;
	$radioText;
	$displayName;
	//echo "fjgsdfjbsjkdfhjkasdfjksdf";
	if(isset($_POST['donorSubmit']))
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
	 echo "<script>window.location.href='registrationApprovalForm.php'</script>";

}

function updateStatus($userID,$status)
{
	
	global $user,$donor,$useridArray,$displayName,$email,$ngo;
	
	//echo "UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'<br />";
	mysql_query("UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'");

	if (isset($_POST['donorSubmit']))
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
	include_once ("../Email/class.phpmailer.php");
	include("../Email/config.php");
	global $user,$donor,$useridArray,$displayName;
	
	//echo "     email  ".$email;
	//echo "   dpname   ".$displayName;
	try{
	
	$to = $email;
	$mail->AddAddress($to);
	$subject= "Registration Confirmation";
	

	$body =  "Dear  " . $displayName . "<br>This is to acknowledge completion of registration on UC website.You can now visit yousee.in with the following <br/> Username : " . $username . " <br/> password : " . $password . "";
	
	$mail->Subject = $subject;
	$mail->Body = $body;
	if($mail->Send())
	{
		;
	}
	else
	{
		echo "<script>alert('Email Failed');</script>";
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


