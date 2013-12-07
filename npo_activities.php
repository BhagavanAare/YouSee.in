<?php
	session_start();
	$thispage="more";
	$thisdiv="npo_activities";
	
	if(!isset($_GET['npo'])){
		header("Location: /npo.php");		
	}
	else {
		include "prod_conn.php";
		$id=mysql_real_escape_string(trim($_GET['npo']));
		$npo=mysql_fetch_array(mysql_query("SELECT name FROM project_partners 
											WHERE partner_id = $id"));
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="List of activities posted by individual NPO's">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/div.css">
  <script src="/scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/custom_jquery.js"></script>
  <script src="/scripts/jquery.blockUI.js"></script>
  </HEAD>
 <BODY>

<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->

<?php include 'header_navbar.php';?>

<!--maincontentarea-->

<div id="uccertificate-main">
	<!-- Left Nav -->
<div style="float:left;width:150px;padding:10px;margin:10px">
	<span > 
		<a href="getnpo.php?npo=<?php echo $id; ?>">
	<?php echo $npo['name'];?></a> 
		</span><br />
	<span style="font-size:13px;font-weight:bold;">
		<a href="/npo_activities.php?npo=<?php echo $id; ?>">Volunteering</a>
	</span><br />
	<span><a href="/npo_inkind.php?npo=<?php echo $id; ?>">In Kind</a></span><br />
	<span><a href="/npo_postpay.php?npo=<?php echo $id; ?>">Financial</a></span>
</div>
<!-- Left Nav End -->
  <Title><?php echo $npo['name'];?> - Volunteering Requests | YouSee</Title>

<div style="float:left;width:750px;padding:10px;margin:10px;">
	<?php
		$activity_query = "SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' AND o.to_date>CURDATE()
				 AND v.partner_id=$id GROUP BY o.activity_id";
	$result=mysql_query($activity_query);
	$resultCount=mysql_num_rows($result);
	?>
	<?php
if ($resultCount>0)
{	?>
<h1 style='border:1px solid #ccc;background:#eee;border-radius:0.2em;padding:3px;'>
	Volunteering Activities Posted by <?php echo $npo['name']; ?></h1>
<table class="table-div2">
	<?php
		while($row = mysql_fetch_array($result))
		{
		if(isset($_SESSION['SESS_USER_ID']) AND $_SESSION['SESS_USER_TYPE']=='D'){
		$donor_id=mysql_fetch_array(mysql_query("SELECT donor_id from donors 
		where user_id=".$_SESSION['SESS_USER_ID'].""));
		$committedquery="SELECT distinct vo.activity_id from volunteer_commits vc 
		INNER JOIN volunteering_opportunities vo 
		ON vc.opportunity_id=vo.opportunity_id
		 WHERE vc.donor_id=".$donor_id['donor_id'];
$commitresult=mysql_query($committedquery);
}
		$opp_query="SELECT * FROM volunteering_opportunities 
		WHERE approval_status='A' AND to_date>'".date("Y-m-d")."' 
		AND activity_id=".$row['activity_id']; 
	$oppresult=mysql_query($opp_query);
	?>
	<tr class="rows postedComment <?php echo $row['vertical'];?> 
	<?php echo $row['domain'];?> 
	<?php if(isset($_SESSION['SESS_USER_ID']) 
	AND $_SESSION['SESS_USER_TYPE']=='D')
	 while($commit=mysql_fetch_array($commitresult))
	 { 
		 if($commit['activity_id']==$row['activity_id'])
		 { echo 'committed'; break;}
	} ?>" id="<?php echo $row['activity_id']; ?>" >
	<td id="td<?php echo $row['activity_id'];?>" class="outer" style="width:80%;"> 
	<div class="activitydiv" >
	<p style="padding:0px;">
	<b style="float:left;position:relative;padding:0px;margin:0px;width:90%;
	font-size:14px;color:#369;font-family:Trebuchet MS">
	<?php echo $row['activity']; ?>
	</b>
	<span style="margin-top:-14px;float:right;margin-right:2px;margin-left:
	20px;font-family:Trebuchet MS;font-size:11px;">
	<?php echo $row['embed_video']; ?> 
	</span>
	<p style="padding:0px;margin-right:8px;width:90%;font-size:11px;
	color:#666;font-family:Trebuchet MS">
	<b>Details:</b>&nbsp<?php echo $row['activity_details']; ?> 
	</p>
	<?php if($row['vertical']!=''||$row['vertical']!=NULL){
		 ?>
		 <img style="float:left;margin-right:10px;"
		  src="images/<?php echo $row['vertical'];?>.png" width="50px" 
		  alt="General" />
	<?php } ?>
	<span style="font-family:Trebuchet MS;font-size:11px;">
		<b style="color:#0C7878;">
			<?php if($row['vertical']!=''||$row['vertical']!=NULL)
			 echo $row['vertical']; else echo "General" ?> |
		</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;">
		<b style="color:#801506;"><?php echo $row['domain']; ?> |</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;">
		<b><?php echo $row['onsite_offsite']; ?></b></span>
<br />
	<span style="float:left;font-family:Trebuchet MS;font-size:11px;">
		Partner:
		&nbsp<a style="font-size:11px;" href="/npo/<?php echo $row['partner_id'];?>">
		<?php echo $row['name']; ?></a></span><br />
	<input style="float:right;margin-right:8px;margin-top:-11px;" 
	type="button" value="View and Commit">
	<span style="float:left;width:60%;font-family:Trebuchet MS;font-size:11px;">
		<b>Skills Required:</b>&nbsp<?php echo $row['skills']; ?></span>

	</p>
	</div>
	</td>
	</tr>
	<tr>
	<td id="details<?php echo $row['activity_id']; ?>" class="inner" hidden>
	<b style="font-size:12px;color:#369;">Activity Schedule</b>
	<table class="table-innerdiv2">
	<th>From date</th><th>To Date</th><th>From time</th><th>To time</th>
	<th>Location</th><th>City</th><th>Vol Req.</th>
	<th><span class="link"><a href="javascript: void(0)">
		<font face=verdana,arial,helvetica size=2>[?]</font>
		<span>Default setting assumes you are committing to all the days of the 
		activity. Deselect any particular date which may not be possible for you.
		</span>
		</a>
		</span>
	</th></tr>
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

	<td>		<form id="form<?php echo $row['activity_id']; ?>" 
	name="activityCommitForm" method="post" action="activity_commit.php">
<?php	if(isset($_SESSION['SESS_USER_ID']) AND ($_SESSION['SESS_USER_TYPE']=='D')){
$opquery="SELECT opportunity_id from volunteer_commits 
WHERE donor_id=".$donor_id['donor_id']." 
AND opportunity_id=".$record['opportunity_id'];
$opresult=mysql_query($opquery);
$opcount=mysql_num_rows($opresult);
if($opcount>=1){
$oppid=mysql_fetch_array($opresult);
if($oppid['opportunity_id']==$record['opportunity_id']){ echo "Committed!";}  
}
else{ ?>
<input type="checkbox" form="form<?php echo $row['activity_id']; ?>" 
value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked /></td>
<?php 
}
}
else{ ?>
<input type="checkbox" form="form<?php echo $row['activity_id']; ?>" 
value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked /></td>
<?php } ?>
</td>
	</tr>		
<?php } ?>
		</table>
		<input name="activity_id" form="form<?php echo $row['activity_id']; ?>" 
		type="text" hidden value="<?php echo $row['activity_id']; ?>"></input>
				<div style="float:right;position:relative;">
				<input  name="activityCommit" type="submit" 
				form="form<?php echo $row['activity_id'];?>" 
				<?php if(isset($_GET['id'])){ ?> target="_blank" <?php } ?>
				value="Commit">
		</div>
			</form>

	</td>
	</tr>
	<script type="text/javascript">
		$(function(){
		act_details(<?php echo $row['activity_id']; ?>);
		});
	</script>
<?php $count++;	
		}
	?>
</table>	
<?php
}
else {
	echo "<h3>No volunteering requests posted.</h3>";
}
?>
</div>

</div>
 <?php include 'footer.php' ; ?>

</div>
<!--#footer-->
 </BODY>
</HTML>
<?php
}
?>
