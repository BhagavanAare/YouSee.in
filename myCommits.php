
<?php require_once('login_auth.php');?>

<?php $thispage = "myuc";
  $activetab="Volunteering";	 	 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <title>My UC | Summary</title>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
   <link rel="stylesheet" type="text/css" href="css/div.css">

  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
  
	<script src="scripts/jquery.min.js"></script>
    <script src="scripts/custom_jquery.js"></script>

</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" >

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<div style="background:white">
<!--maincontentarea begin-->
<div id="uccertificate-main">

<div>
<table>
<tr>
<td valign="top">
<?php include 'myucTabs.php'; ?>
</td>
<td>

<div>
<!-- ******************** Main Content Area Start ******************** -->
 <?php
session_start();
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$activityQuery="SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				JOIN volunteer_commits c ON o.opportunity_id=c.opportunity_id
				JOIN donors d ON c.donor_id=d.donor_id
				WHERE o.to_date>'".date("Y-m-d")."' AND d.user_id=".$_SESSION['SESS_USER_ID']." GROUP BY o.activity_id ORDER BY o.opportunity_id";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
if($resultCount>0)
{	?>
<table class="table-div2">
	<?php
		while($row = mysql_fetch_array($result))
		{
		$opp_query="SELECT * FROM volunteering_opportunities WHERE approval_status='A' AND to_date>'".date("Y-m-d")."' AND activity_id=".$row['activity_id']; 
	$oppresult=mysql_query($opp_query);
	?>
	<tr class="rows postedComment <?php echo $row['vertical'];?> <?php echo $row['domain'];?>" id="<?php echo $row['activity_id']; ?>" >
	<td width=80%   id="td<?php echo $row['activity_id'];?>" class="outer"> <div class="activitydiv" style="width:100%;">
	<p style="padding:0px;">
	<h5 style="float:left;position:relative;padding:0px;margin:0px;width:65%;"><?php echo $row['activity']; ?></h5>
	<span style="float:right;margin-right:8px;">Vertical:&nbsp<b style="color:#0C7878;"><?php echo $row['vertical']; ?></b></span><br />
	<span style="float:right;margin-right:8px;">Domain:&nbsp<b style="color:#801506;"><?php echo $row['domain']; ?></b></span><br /><br />
	<span style="float:right;margin-right:8px"><b><?php echo $row['onsite_offsite']; ?></b></span>		
	<p style="padding:0px;margin-right:8px;width:70%;"><b>Details:</b>&nbsp<?php echo $row['activity_details']; ?></p><br />
	<span style="float:left">Partner:&nbsp<b><a href="<?php echo $row['website_url'];?>" target="_blank"><?php echo $row['name']; ?></a></b> </span><br />
	<span style="float:left;width:70%;"><b>Skills Required:</b>&nbsp<?php echo $row['skills']; ?></span>
	<input type="button" value="View">

	</p>
	</div>
	</td>
	</tr>
	<tr>
	<td id="details<?php echo $row['activity_id']; ?>" class="inner" hidden>
	<h3>Activity Schedule</h3>
	<table class="table-innerdiv2">
	<tr><th>From date</th><th>To Date</th><th>From time</th><th>To time</th><th>Location</th><th>City</th><th>Vol Req.</th></tr>
	<?php while($record=mysql_fetch_array($oppresult)){ ?>
	<tr>
	<td><?php echo "".gmdate("d-M-y",strtotime($record['from_date']));?></td>
	<td><?php echo "".gmdate("d-M-y",strtotime($record['to_date']));?></td>
	<?php if($record['from_time']==0){ echo "<td></td>";}
	else {?>	
	<td><?php echo "".date("g:iA",strtotime($record['from_time']));}?></td>
	<?php
	if($record['to_time']==0){ echo "<td></td>";}
	else {?>	
	<td><?php echo "".date("g:iA",strtotime($record['to_time']));}?></td>
	<td><?php echo "".$record['location'];?></td>
	<td><?php echo "".$record['city'];?></td>
	<td><?php echo "".$record['num_volunteers'];?></td>
	</tr>		
<?php } ?>
		</table>
				
			<!--	<div style="float:right;position:relative;"><input  name="activityCommit" type="submit" form="form<?php echo $row['activity_id'];?>" value="Commit">
		<input name="act_id" form="form<?php echo $row['activity_id']; ?>" type="text" hidden value="<?php echo $row['activity_id']; ?>"></input></div>
			</form>-->
			</tr>
	<script type="text/javascript">
		$(function(){
		act_details(<?php echo $row['activity_id']; ?>);
		});
	</script>
<?php 
	
		}

	?>

	
</table>	
<?php
}
else
{
	echo "<p>You have not committed to any activities yet, Visit <a href='donate_time.php'>Donate Time </a> page to see current activities.</p>";
}
	?>
<!-- ******************** Main Content Area End ******************** -->
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
