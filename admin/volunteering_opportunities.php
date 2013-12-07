<select style="float:right" hidden>
<option value="" selected disabled>Sort By</option>
<option value="Popularity">Popularity</option>
<option value="dasc">Date Asc</option>
<option value="ddesc">Date desc</option>
</select>
<h3> Volunteering Opportunities </h3>
<?php 
session_start();
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$where="";
if($_REQUEST['vertical'])
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
if($_REQUEST['domain']){
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
if($_REQUEST['city']){
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
if($_REQUEST['activity']){
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
if($_POST['date']){
		$where.=" AND (";
		$date=date_format(date_create_from_format('j-M-Y', $_POST['date']), 'Y-m-d');
		$where.="o.from_date <= ".$date." AND ".$date."<= o.to_date )";;
}
$_SESSION['WHERE']=$where;
$activityQuery="SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' ".$where."GROUP BY o.activity_id ORDER BY o.opportunity_id LIMIT 0,5";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;
?>
<?php
if ($resultCount>0)
{	?>
<table class="table-div2">
	<?php
		while($row = mysql_fetch_array($result))
		{
		
		$opp_query="SELECT * FROM volunteering_opportunities WHERE approval_status='A' AND activity_id=".$row['activity_id']; 
	$oppresult=mysql_query($opp_query);
	?>
	<tr class="rows postedComment <?php echo $row['vertical'];?> <?php echo $row['domain'];?>" id="<?php echo $row['activity_id']; ?>" >
	<td width=80%   id="td<?php echo $row['activity_id'];?>"> <div style="width:100%;">
	<p style="padding:0px;">
	<h5 style="float:left;position:relative;padding:0px;margin:0px;width:65%;"><?php echo $row['activity']; ?></h5>
	<span style="float:right;margin-right:8px;">Vertical:&nbsp<b style="color:#0C7878;"><?php echo $row['vertical']; ?></b></span><br />
	<span style="float:right;margin-right:8px;">Domain:&nbsp<b style="color:#801506;"><?php echo $row['domain']; ?></b></span><br /><br />
	<span style="float:right;margin-right:8px"><b><?php echo $row['onsite_offsite']; ?></b></span>		
	<p style="padding:0px;margin-right:8px;width:70%;"><b>Details:</b>&nbsp<?php echo $row['activity_details']; ?></p><br />
	<span style="float:left">Partner:&nbsp<b><?php echo $row['name']; ?></b> </span><br />
	<span style="float:left;width:70%;"><b>Skills Required:</b>&nbsp</span>

	</p>
	</div>
	</td>
	</tr>
	<tr>
	<td id="details<?php echo $row['activity_id']; ?>" class='inner'" hidden>
	<h3>Activity Schedule</h3>
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
	<td><input type="checkbox" value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked/></td>
	</tr>		
<?php } ?></table>
	<form id="activityApprovalForm" method="post" action="activityApproval.php">
		<div style="float:right;position:relative;"><input  name="activityApprove" type="button" style="border-radius:20px;"value="Commit" onClick="alert('by calling 8008-884422 OR e-mail to contact@yousee.in');">
		<input name="act_id" type="text" hidden value="<?php echo $row['activity_id']; ?>"></input></div>
	</td>
	</tr>
	<script type="text/javascript">
		$(function(){
		$("#td<?php echo $row['activity_id']; ?>").click(function(){
		if($("#details<?php echo $row['activity_id']; ?>").css('display')!='none'){
		$($("#details<?php echo $row['activity_id']; ?>")).slideUp();	
		$("#td<?php echo $row['activity_id']; ?>").css("background-color","#f2f2f2");
		}
		else {
		for($i=0;$i!=<?php echo $row['activity_id']; ?>;$i++){
		$(".inner").hide();
		$("#"+$i).css("background-color","#f2f2f2");
		}
		$("#td<?php echo $row['activity_id']; ?>").css("background","#c2c2c2");
		$("#details<?php echo $row['activity_id']; ?>").slideDown();
		$("#details<?php echo $row['activity_id']; ?>").css("background","#c2c2c2");
		}
		});       
		});
	</script>
	</form>
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
<?php include 'volunteering_opportunities_load.php'; ?>
