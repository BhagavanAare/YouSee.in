<?php
session_start();
error_reporting(0) ;
if($_GET['lastComment']){
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
if(isset($_SESSION['where_query'])){
$where=$_SESSION['where_query'];
$_SESSION['where_var']=$_SESSION['where_query'];
}
else if(isset($_SESSION['where_var'])){
	$where=$_SESSION['where_var'];
}
else $where="";
$sort=$_SESSION['sort_var'];
if(isset($_SESSION['page_number'])){
$_SESSION['page_number']++;
}
else {
$_SESSION['page_number']=2;
}
$filtered = filter_input(INPUT_GET, "lastComment", FILTER_SANITIZE_URL);
$activityQuery="SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' AND o.to_date>'".date("Y-m-d")."' AND o.activity_id>".$filtered." ".$where." GROUP BY o.activity_id ".$sort."  LIMIT 0,10";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;
if($resultCount>0){
?>
<div style="width:95%;padding:3px;background:#ccc;font-size:14px;font-weight:bold;font-family:Trebuchet MS;padding-left:30px;">Page <?php echo $_SESSION['page_number'];?></div>
<table class="table-div2">
	<?php
		while($row = mysql_fetch_array($result))
		{
		if(isset($_SESSION['SESS_USER_ID']) AND $_SESSION['SESS_USER_TYPE']=='D'){
$donor_id=mysql_fetch_array(mysql_query("SELECT donor_id from donors where user_id=".$_SESSION['SESS_USER_ID'].""));
$committedquery="SELECT distinct vo.activity_id from volunteer_commits vc INNER JOIN volunteering_opportunities vo ON vc.opportunity_id=vo.opportunity_id WHERE vc.donor_id=".$donor_id['donor_id'];
$commitresult=mysql_query($committedquery);
}
		$opp_query="SELECT * FROM volunteering_opportunities WHERE approval_status='A' AND to_date>'".date("Y-m-d")."' AND activity_id=".$row['activity_id']; 
	$oppresult=mysql_query($opp_query);
	?>
	<tr class="rows postedComment <?php echo $row['vertical'];?> <?php echo $row['domain'];?> <?php if(isset($_SESSION['SESS_USER_ID']) AND $_SESSION['SESS_USER_TYPE']=='D') while($commit=mysql_fetch_array($commitresult)){ if($commit['activity_id']==$row['activity_id']){ echo 'committed'; break;}} ?>" id="<?php echo $row['activity_id']; ?>">
	<td  id="td<?php echo $row['activity_id']; ?>" class="outer"> <div class="activitydiv">
	<p style="padding:0px;">
	<b style="float:left;position:relative;padding:0px;margin:0px;width:90%;font-size:14px;color:#369;font-family:Trebuchet MS"><?php echo $row['activity']; ?></b>
	<span style="margin-top:-14px;float:right;margin-right:2px;margin-left:20px;font-family:Trebuchet MS;font-size:11px;"><?php echo $row['embed_video']; ?> </span>
	<p style="padding:0px;margin-right:8px;width:90%;font-size:11px;color:#666;font-family:Trebuchet MS"><b>Details:</b>&nbsp<?php echo $row['activity_details']; ?> </p>
	<?php if($row['vertical']!=''||$row['vertical']!=NULL){ ?><img style="float:left;margin-right:10px;" src="images/<?php echo $row['vertical'];?>.png" width="50px" alt="General" />
	<?php } ?>
	<span style="font-family:Trebuchet MS;font-size:11px;"><b style="color:#0C7878;"><?php if($row['vertical']!=''||$row['vertical']!=NULL) echo $row['vertical']; else echo "General" ?> |</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;"><b style="color:#801506;"><?php echo $row['domain']; ?> |</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;"><b><?php echo $row['onsite_offsite']; ?></b></span>
	<br />
	<span style="float:left;font-family:Trebuchet MS;font-size:11px;">Partner:&nbsp<a style="font-size:11px;" href="/npo/<?php echo $row['partner_id'];?>"><?php echo $row['name']; ?></a></span><br />
	<input style="float:right;margin-right:8px;margin-top:-11px;" type="button" value="View and Commit">
	<span style="float:left;width:60%;font-family:Trebuchet MS;font-size:11px;"><b>Skills Required:</b>&nbsp<?php echo $row['skills']; ?></span>

	</p>
	</div>
	</td>
	</tr>
	<tr>
	<td id="details<?php echo $row['activity_id']; ?>" class="inner" hidden>
	<b style="font-size:12px;color:#369;">Activity Schedule</b>
	<table class="table-innerdiv2">
	<th>From date</th><th>To Date</th><th>From time</th><th>To time</th><th>Location</th><th>City</th><th>Vol Req.</th><th><span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Default setting assumes you are committing to all the days of the activity. Deselect any particular date which may not be possible for you.</span></a></span></th></tr>
	<?php while($record=mysql_fetch_array($oppresult)){ ?>
	<tr>
	<td><?php echo "".gmdate("d-M-y",strtotime($record['from_date']));?></td>
	<td><?php echo "".gmdate("d-M-y",strtotime($record['to_date']));?></td>
	<td><?php echo "".date("g:iA",strtotime($record['from_time']));?></td>
	<td><?php echo "".date("g:iA",strtotime($record['to_time']));?></td>
	<td><?php echo "".$record['location'];?></td>
	<td><?php echo "".$record['city'];?></td>
	<td><?php echo "".$record['num_volunteers'];?></td>
	<td>	<form id="form<?php echo $row['activity_id']; ?>" name="activityCommitForm" method="post" action="activity_commit.php">

<?php	if(isset($_SESSION['SESS_USER_ID']) AND ($_SESSION['SESS_USER_TYPE']=='D')){
$opquery="SELECT opportunity_id from volunteer_commits WHERE donor_id=".$donor_id['donor_id']." AND opportunity_id=".$record['opportunity_id'];
$opresult=mysql_query($opquery);
$opcount=mysql_num_rows($opresult);
if($opcount>=1){
$oppid=mysql_fetch_array($opresult);
if($oppid['opportunity_id']==$record['opportunity_id']){ echo "Committed!";}  
}
else{ ?>
<input type="checkbox" form="form<?php echo $row['activity_id']; ?>" value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked />
</td>

<?php 
}
}
else{ ?>
<input type="checkbox" form="form<?php echo $row['activity_id']; ?>" value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked /></td>
<?php } ?>
</td>
	</tr>		
<?php } ?>
		</table>
		<input name="activity_id" type="text" hidden form="form<?php echo $row['activity_id']; ?>" value="<?php echo $row['activity_id']; ?>"></input></div>
			<div style="float:right;position:relative;"><input name="activityCommit" type="submit" form="form<?php echo $row['activity_id']; ?>" value="Commit">

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
<?php mysql_close(); } else return null;}?>	
<?php
/*
Version Track
1 - 01May13 - Vivek - Display of skills required. 
2 - 07May13 - Vivek - Activity commit action introduced. 
3 - 12May13 - Vivek - Added field to embed video. 
*/
?>
