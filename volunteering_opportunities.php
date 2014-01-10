<select style="float:right" id="sortby" hidden>
<option value="" selected disabled>Sort By</option>
<option value="Popularity">Popularity</option>
<option value="dasc">Date Asc</option>
<option value="ddesc">Date desc</option>
</select>
<?php 

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$where="";
$sort="ORDER BY o.activity_id ASC";
if(isset($_GET['npo'])){
	$where.=" AND v.partner_id=$_GET[npo] ";
}
if(isset($_REQUEST['vertical']))
{
	$where.=" AND (";
	$vcount=count($_REQUEST['vertical']);
   	foreach($_REQUEST['vertical'] as $v){
			if($vcount>1){
				$where.="v.vertical='".$v."' OR ";
				$vcount--;
			}
			else{
  				$where.="v.vertical='".$v."')";
			}
	}
}
if(isset($_REQUEST['dates'])){
	$where.=" AND (";
	$dates = $_REQUEST['dates'];
	$fromdate = new DateTime($dates[0]);
	$todate = new DateTime($dates[1]);
	$from_date = $fromdate->format('Y-m-d');
	$to_date = $todate->format('Y-m-d');
	$where.="$from_date <= o.to_date AND $to_date >= o.from_date) ";
}
if(isset($_REQUEST['domain'])){
	$where.=" AND (";
	$dcount=count($_REQUEST['domain']);
   	foreach($_REQUEST['domain'] as $d){
			if($dcount>1){
				$where.="v.domain='".$d."' OR ";
				$dcount--;
			}
			else{
  				$where.="v.domain='".$d."')";
			}
	}
}
if(isset($_REQUEST['city'])){
	$where.=" AND (";
	$ccount=count($_REQUEST['city']);
   	foreach($_REQUEST['city'] as $c){
			if($ccount>1){
				$where.="o.city='".$c."' OR ";
				$ccount--;
			}
			else{
  				$where.="o.city='".$c."')";
			}
	}
}
if(isset($_REQUEST['activity'])){
		$where.=" AND (";
	$acount=count($_REQUEST['activity']);
   	foreach($_REQUEST['activity'] as $a){
			if($acount>1){
				$where.="v.onsite_offsite='".$a."' OR ";
				$acount--;
			}
			else{
  				$where.="v.onsite_offsite='".$a."')";
			}
	}
}
if(isset($_POST['date'])){
		$where.=" AND (";
		$date=date_format(date_create_from_format('j-M-Y', $_POST['date']), 'Y-m-d');
		$where.="o.from_date <= ".$date." AND ".$date."<= o.to_date )";;
}
$_SESSION['where_var']=$where;
//echo $_SESSION['where_var'];
$_SESSION['sort_var']=$sort;
$activityQuery="SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' AND o.to_date>CURDATE() ".$where." GROUP BY o.activity_id ".$sort." LIMIT 0,10";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$totalquery="SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' AND o.to_date>CURDATE() ".$where." GROUP BY o.activity_id ".$sort;
$totalresult=mysql_query($totalquery);
$totalCount=mysql_num_rows($totalresult);
$count=0;
	?>
<?php
if ($resultCount>0)
{	?>
<font style="color:#369;margin-left:15px;font-weight:bold;font-size:14px;font-family:Trebuchet MS">Volunteering Opportunities</font>
<font style="color:#666;font-weight:bold;font-size:12px;font-family:Trebuchet MS">(Showing <?php echo $resultCount; ?> of <?php echo $totalCount; ?> opportunities.)</font>
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
	<tr class="rows postedComment <?php echo $row['vertical'];?> <?php echo $row['domain'];?> <?php if(isset($_SESSION['SESS_USER_ID']) AND $_SESSION['SESS_USER_TYPE']=='D') while($commit=mysql_fetch_array($commitresult)){ if($commit['activity_id']==$row['activity_id']){ echo 'committed'; break;}} ?>" id="<?php echo $row['activity_id']; ?>" >
	<td id="td<?php echo $row['activity_id'];?>" class="outer" style="width:80%;"> <div class="activitydiv" >
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
	<td><?php echo "".date("d-M-y",strtotime($record['from_date']));?></td>
	<td><?php echo "".date("d-M-y",strtotime($record['to_date']));?></td>
	<?php if($record['from_time']==0 || $record['from_time']==NULL || $record['from_time']==""){ echo "<td></td>";}
	else {?>	
	<td><?php echo "".date("g:iA",strtotime($record['from_time']));}?></td>
	<?php
	if($record['to_time']==0 || $record['to_time']==NULL || $record['to_time']==""){ echo "<td></td>";}
	else {?>	
	<td><?php echo "".date("g:iA",strtotime($record['to_time']));}?></td>
	<td><?php echo "".$record['location'];?></td>
	<td><?php echo "".$record['city'];?></td>
	<td><?php echo "".$record['num_volunteers'];?></td>

	<td>		<form id="form<?php echo $row['activity_id']; ?>" name="activityCommitForm" method="post" action="activity_commit.php">
<?php	if(isset($_SESSION['SESS_USER_ID']) AND ($_SESSION['SESS_USER_TYPE']=='D')){
$opquery="SELECT opportunity_id from volunteer_commits WHERE donor_id=".$donor_id['donor_id']." AND opportunity_id=".$record['opportunity_id'];
$opresult=mysql_query($opquery);
$opcount=mysql_num_rows($opresult);
if($opcount>=1){
$oppid=mysql_fetch_array($opresult);
if($oppid['opportunity_id']==$record['opportunity_id']){ echo "Committed!";}  
}
else{ ?>
<input type="checkbox" form="form<?php echo $row['activity_id']; ?>" value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked /></td>
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
		<input name="activity_id" form="form<?php echo $row['activity_id']; ?>" type="text" hidden value="<?php echo $row['activity_id']; ?>"></input>
				<div style="float:right;position:relative;"><input  name="activityCommit" type="submit" form="form<?php echo $row['activity_id'];?>" <?php if(isset($_GET['id'])){ ?> target="_blank" <?php } ?>value="Commit">
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
else
{
	echo "<p>No opportunities are listed for this selection.</p>";
}
?>
<?php 
if(isset($_SESSION['page_number']))
unset($_SESSION['page_number']);
include 'volunteering_opportunities_load.php'; ?>
<?php
/*
Version Track
1 - 01May13 - Vivek - Display of skills required. 
2 - 07May13 - Vivek - Activity commit action introduced. 
3 - 12May13 - Vivek - Added field to embed video. 
*/
?>
