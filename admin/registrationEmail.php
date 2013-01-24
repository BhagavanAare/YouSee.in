<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("../prod_conn.php");
include("../tableObjects/userTable.php");		
include("../tableObjects/donorTable.php");
include("../tableObjects/ngoTable.php");
include("class.phpmailer.php"); 
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 


 $query= "SELECT * FROM users u,donors d  WHERE u.".$user['id']."=d.user_id AND ".$user['regStatus']."='P' ";          
 //$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";          
 $donorResult = mysql_query($query);
 ?>
 <form id="approveRequests" name="approveRequests" method="post" action="registrationApprovalForm.php">
 <input name="formname" type="hidden" value="actionDonor" />
 <table  border="1">
 <th>
 	<td>Username</td>
    <td>Gender</td>
    <td>Donor Name</td>
    <td>Date of Birth</td>
    <td>Place</td>
    <td>Organisation Name</td>
    <td>Phone Number</td>
    <td>Email ID</td>
    <td>Action</td>
 </th>
 <?php $count=0;
 $useridArray;
 while($row = mysql_fetch_array($donorResult))
  {
	  $useridArray[$count]=$row[$user['id']];
		echo "    ".$useridArray[$count]." count= ".$count;
	    ?><tr>
	<td><?php echo $count++; ?></td>
    <td><?php echo "".$row[$user['username']];?></td>
     <td><?php echo "".$row[$donor['gender']];?></td>
     <td><?php echo "".$row[$donor['fname']];?></td>
     <td><?php echo "".$row[$donor['dob']];?></td>
     <td><?php echo "".$row[$donor['city']];?></td>
     <td><?php echo "".$row[$donor['orgName']];?></td>
     <td><?php echo "".$row[$donor['phno']];?></td>
     <td><?php echo "".$row[$donor['officialEmail']];?></td>
     <td>         
           <label>
             <input type="radio" name="<?php echo "action".$row[$user['id']]; ?>" value="A"    id="action_0" />
             Approve</label>
           <br />
           <label>
             <input type="radio" name="<?php echo "action".$row[$user['id']]; ?>" value="R"  id="action_1" />
            
             Reject</label>
             <br />
             <input type="radio" name="<?php echo "action".$row[$user['id']]; ?>" value="S"  id="action_2" checked="checked" />
             Stall</label>
           <br />
         
     </td>   	
  </tr><?php
  }
  ?>
  </table>
  <input name="donorSubmit" type="submit" value="submit" />
  </form>
  


  <?php
  
 //$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";
 $query= "SELECT * FROM users u,project_partners p  WHERE u.".$user['id']."=p.".$ngo['userid']." AND ".$user['regStatus']."='P' ";          
           
 $ngoResult = mysql_query($query);
 
 echo $ngoResult;
 
 while($row = mysql_fetch_array($ngoResult))
  {
	   //echo $row;

 
  echo "<br />";
  }
  
  
 //$query= "SELECT \"".$user['id']."\",\"".$user['typeID']."\" FROM users  WHERE  (".$user['regStatus']."='P') ";          
 $ngoResult = mysql_query($query);
 ?>
 <form id="approveRequests" name="approveRequests" method="post" action="registrationApprovalForm.php">
 <input name="formname" type="hidden" value="actionDonor" />
 <table  border="1">
 <th>
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
 </th>
 <?php $count=0;
 $useridArray;
 while($row = mysql_fetch_array($ngoResult))
  {
	  $useridArray[$count]=$row[$user['id']];
		echo "    ".$useridArray[$count]." count= ".$count;
	    ?><tr>
	<td><?php echo $count++; ?></td>
    <td><?php echo "".$row[$user['username']];?></td>
     <td><?php echo "".$row[$ngo['name']];?></td>
     <td><?php echo "".$row[$ngo['address']];?></td>
     <td><?php echo "".$row[$ngo['city']];?></td>
     <td><?php echo "".$row[$ngo['partnerEmail']];?></td>
     <td><?php echo "".$row[$ngo['fname']];?></td>
     <td><?php echo "".$row[$ngo['gender']];?></td>
     <td><?php echo "".$row[$ngo['phone']];?></td>
     <td><?php echo "".$row[$ngo['contactEmail']];?></td>  
     <td><a href="<?php echo "".$row[$ngo['url']];?>"><?php echo "".$row[$ngo['url']];?></a></td>   
   
  
     <td>         
           <label>
             <input type="radio" name="<?php echo "action".$row[$user['id']]; ?>" value="A"    id="action_0" />
             Approve</label>
           <br />
           <label>
             <input type="radio" name="<?php echo "action".$row[$user['id']]; ?>" value="R"  id="action_1" />
            
             Reject</label>
             <br />
             <input type="radio" name="<?php echo "action".$row[$user['id']]; ?>" value="S"  id="action_2" checked="checked" />
             Stall</label>
           <br />
         
     </td>   	
  </tr><?php
  }
  ?>
  </table>
  <input name="ngoSubmit" type="submit" value="submit" />
  </form>
  
 
 

<?php

if (isset($_POST['donorSubmit']) || isset($_POST['ngoSubmit'])) 
{
	echo "submitted <br />";
	$counter=0;
	 while($count)
	 {
		 $userid=$useridArray[$counter];
		 //echo " count=".$count." counter=".$counter." userid=".$userid."<br />";

		 $counter++;
		 $radioID="action".$userid;
		 $value=$_POST[$radioID];
		 if($value=="A")
		 {
			 //echo $userid." approved";
			 updateStatus($userid,$value);
		 }
		 elseif($value=="R")
		 {
			 //echo $userid." rejected";
			 updateStatus($userid,$value);
		 }
		 elseif($value=="S")
		 {
			 echo $userid." stalled";
		 }
		 
		 $count=$count-1;
	 }
}

function updateStatus($userID,$status)
{
	global $user;
	echo "UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'<br />";
	mysql_query("UPDATE users SET ".$user['regStatus']."='".$status."' WHERE ".$user['id']."='".$userID."'");
}
?>


</body>
</html>


