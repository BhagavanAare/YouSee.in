<?php //require_once('login_auth.php');?>
<?php $thispage ="volunteeringApprovals"; ?>




<body id="wrapper" style="background: #FFFFFF">

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


//$volunteeringQuery= "select d.".$donor['displayName'].",d.".$donor['gender'].",d.".$donor['city'].",d.".$donor['orgName'].",p.".$project['title'].", v.* FROM donors d, volunteering v, projects p WHERE ((".$volunteer['status']."='p') AND (d.".$donor['id']."=v.".$volunteer['donorId'].") AND (p.".$volunteer['projectId']."=v.".$project['id']."))";
$volunteeringQuery= "select d.".$donor['displayName'].",d.".$donor['gender'].",d.".$donor['city'].",d.".$donor['orgName'].",p.".$project['title'].", v.* FROM donors d, volunteering v, projects p WHERE ((".$volunteer['status']."='p') AND (d.".$donor['id']."=v.".$volunteer['donorId']."))";
echo $volunteeringQuery;
$result=mysql_query($volunteeringQuery);
$resultCount=mysql_num_rows($result);

$volunteeringidArray;
?>
<?php
if(isset($_SESSION['POST_DATA']))
{
	$_POST=$_SESSION['POST_DATA'];
	unset($_SESSION['POST_DATA']);
}
?>


<div align="center" id="volunteerDiv" style="display: block"><?php 
if ($result>0)
{
	generateVolunteerTable();
}
else
{
	echo "You don't have any Registrations to Approve";
}
?></div>
<?php function generateVolunteerTable()
{
	global $donor,$volunteer,$project,$result;
	?>



<form id="approveVolunteeringRequests"
	name="approveVolunteeringRequests" method="post" action="redirect.php">
<input name="formname" type="hidden" value="volunteeringApprovalForm" />
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
	$volunteeringidArray;
	while($row = mysql_fetch_array($result))
	{
		$calculatedTime="time";
			
		//$calculatedTime=calculateTime($row[$volunteer['fromDate']],$row[$volunteer['toDate']],$row[$volunteer['fromTime']],$row[$volunteer['toTime']]);
		$volunteeringidArray[$count]=$row[$volunteer['id']];

		?>
	<tr <?php if($count%2) echo "class=alt" ?>>
		<td><?php echo ++$count; ?></td>
		<td><?php echo "".$row[$donor['displayName']];?></td>
		<td><?php echo "".$row[$donor['gender']];?></td>
		<td><?php echo "".$row[$donor['place']];?></td>
		<td><?php echo "".$row[$donor['orgName']];?></td>
		<td><?php echo "".$row[$volunteer['fromDate']];?></td>
		<td><?php echo "".$row[$volunteer['toDate']];?></td>
		<td><?php echo "".$row[$volunteer['fromTime']];?></td>
		<td><?php echo "".$row[$volunteer['toTime']];?></td>

		<td><?php echo "".$calculatedTime;?></td>

		<td><?php echo "".$row[$volunteer['area']];?></td>
		<td><?php echo "".$row[$volunteer['activityDone']];?></td>
		<td><?php echo "".$row[$volunteer['Location']];?></td>
		<td><?php echo "".$row[$volunteer['org']];?></td>
		<td><?php echo "".$row[$projects['title']];?></td>


		<!-- Hidden fields required to update set password , send email

     <input type="hidden" name=<?php //echo "".$user['username']."".$row[$volunteer['id']]; ?> value=<?php // echo "".$row[$user['username']]; ?>/>
     -->

		<td><label> <input type="radio"
			name="<?php echo "action".$row[$volunteer['id']]; ?>" value="A"
			id="action_0" /> Approve</label> <br />

		<label> <input type="radio"
			name="<?php echo "action".$row[$volunteer['id']]; ?>" value="R"
			id="action_1" /> Reject</label> <br />
		<input type="radio"
			name="<?php echo "action".$row[$volunteer['id']]; ?>" value="P"
			id="action_2" checked="checked" /> Pending</label> <br />

		</td>
	</tr>
	<?php
	}
	?>
</table>
<input name="volunteeringApproval" type="submit" value="submit" /></form>
	<?php
}?>

   

<?php
if (isset($_POST['volunteeringApproval']))
{
	//echo " donor submitted <br />";
	$counter=0;
	$radioText="action";
	$approveCount=0;
	$useridArray=$volunteeringidArray;
	//echo "fjgsdfjbsjkdfhjkasdfjksdf";

	while($count)
	{
		$volunteeringid=$volunteeringidArray[$counter];
		//echo "     ".$useridArray[$counter];
		//echo " count=".$count." counter=".$counter." userid=".$userid."<br />";

		$counter++;
		$radioID="".$radioText."".$volunteeringid;
		//echo "".$radioID;
		$value=$_POST[$radioID];
		/*echo "<script>alert('$value')</script>";*/
		if($value=="A")
		{
			$approveCount++;
		}
		updateVolunteeringStatus($volunteeringid,$value);
		$count=$count-1;
	}

	/*echo "<script>alert('$donor');</script>";*/


}

function updateVolunteeringStatus($volunteeringID,$status)
{
	mysql_query("UPDATE users SET ".$volunteering['status']."='".$status."' WHERE ".$volunteering['id']."='".$volunteeringID."'");
}

?>
</body>
</html>


