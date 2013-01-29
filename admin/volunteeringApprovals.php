<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>

<body id="wrapper" style="background:#FFFFFF">

<?php
//if (isset($_POST['submit']))
//{

 //connect to database
 include("prod_conn.php");

include("tableObjects/donorTable.php");
include("tableObjects/volunteeringTable.php");
include("tableObjects/projectsTable.php");
 
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");

 $query= "SELECT * FROM users u,donors d  WHERE u.".$user['id']."=d.user_id AND ".$user['regStatus']."='P' ";          
 //$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";          
 $donorResult = mysql_query($query);
 ?>
 
 
 
 <?php
 /* Connects to database and get volunteering details along with volunteer information and the project they worked on */
 
 //Get the volunteer IDs whose volunteerings approvals are pending
	
	$volunteeringQuery= "SELECT * FROM volunteering v, donor d, projects p WHERE ".$vlounteer['status']."='P'";
	
	
	$volunteeringQuery= "select d.".$donor['displayName'].",d.".$donor['gender'].",d.".$donor['city'].",d.".$donor['orgName'].",p.".$projects['title'].", v.* FROM donors d, volunteering v, projects p WHERE ((".$volunteering['status']."='p') AND (d.".$donor['id']."=v.".$volunteer['donorId'].") AND (p.".$project['projectId']."=v.".$project['id']."))";

	$result=mysql_query($volunteeringQuery);
	
 ?>
  
 
 <form id="approveVolunteeringRequests" name="approveVolunteeringRequests" method="post" action=".php">
 <input name="formname" type="hidden" value="actionDonor" />
 <table align="center" id="altColorTable" border="0">
 <tr class="alt">
 	<td>S.No</td>
 	<td>Donor Name</td>
    <td>Gender</td>
    <td>Place</td>
    <td>Organisation Name</td>
    <td>From date</td>
    <td>To date</td>
    <td>From time</td>
	<td>To time</td>
    <td>calculated time</td>
    <td>Entered time</td>
	<td>Area</td>
	<td>Activity done</td>
	<td>Onsite/Offsite</td>
	<td>Location</td>
	<td>Organisation</td>
	<td>Project Name</td>
 </tr>
 <?php $count=0;
 $donorUseridArray;
 $useridArray;
 while($row = mysql_fetch_array($donorResult))
  {
	  $donorUseridArray[$count]=$row[$user['id']];
		//echo "    ".$donorUseridArray[$count]." count= ".$count;
	    ?><tr <?php if($count%2) echo "class=alt" ?>>
	<td><?php echo ++$count; ?></td>
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
  <input name="donorSubmit" type="submit" value="submit" />
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
 <form id="approveRequests" name="approveRequests" method="post" action="admin/registrationApprovalForm.php">
 <input name="formname" type="hidden" value="actionDonor" />
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
  <input name="ngoSubmit" type="submit" value="submit" />
  </form>
  
 </div>
 

<?php
	$password;

if (isset($_POST['donorSubmit']) || isset($_POST['ngoSubmit'])) 
{
	//echo " donor submitted <br />";
	$counter=0;
	$count;
	$radioText;
	$displayName;
	//echo "fjgsdfjbsjkdfhjkasdfjksdf";
	if(isset($_POST['donorSubmit']))
	{
		$count=$count;
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

?>
</body>


</html>
 