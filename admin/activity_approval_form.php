<style type="text/css">
span.link 
{
    	position: relative;
}
span.link a span 
{
    	display: none;
}
span.link a:hover 
{
    	font-size: 99%;
    	font-color: #ffffff;

}
span.link a:hover span 
{ 
   	display: block; 
    	position: absolute; 
    	margin-top: 10px; 
	padding-right:100px;
	width:280px;
	padding: 0px; 
    	z-index: 100; 
    	color: #000000; 
    	background:orange; 
    	font: 11px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
}
</style>
<link rel="stylesheet" type="text/css" href="css/pagination.css">
<?php 
require_once 'YouseeMobile/sendNotification.php';
if(isset($_POST['activityApprove'])){	
		$rejectquery="UPDATE volunteering_opportunities SET approval_status='R' WHERE activity_id='".$_POST['act_id']."'";
		mysql_query($rejectquery);
		foreach($_POST['opp_id'] as $opp){
		$query="UPDATE volunteering_opportunities SET approval_status='A' WHERE activity_id='".$_POST['act_id']."' AND opportunity_id='".$opp."'";
		$result=mysql_query($query); 
		}
		sendGCMNotification($_POST['act_id']);
		header("location:activityApproval.php");
		exit();
		}
if(isset($_POST['activityReject'])){
		$query="UPDATE volunteering_opportunities SET approval_status='R' WHERE activity_id='".$_POST['act_id']."'";
		$result=mysql_query($query);
		header("location:activityApproval.php");
		exit();
		}
?>
<?php //require_once('login_auth.php');?>
<?php $thispage ="activityApprovals"; ?>
<body id="wrapper" style="background: #FFFFFF">
<?php
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$activityQuery="SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='P' GROUP BY o.activity_id";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;

?>
<?php
//Get post data from session variable
if(isset($_SESSION['POST_DATA']))
{
	$_POST=$_SESSION['POST_DATA'];
	unset($_SESSION['POST_DATA']);
}
?>
<?php
	
	include('prod_conn.php');	
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
	
	$tbl_name="volunteering_opportunities";		
	$adjacents = 3;
	
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE approval_status='P' GROUP BY activity_id" ;
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = mysql_num_rows(mysql_query($query));
	
	/* Setup vars for query. */
	$targetpage = "activityApproval.php"; 	
	$limit = 10; 
	
	if(isset($_GET['page'])){
		if($_GET['page']<=$total_pages){
		$page = $_GET['page'];}
		else $page=1;
		$start = ($page - 1) * $limit; 	
		}
			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='P' GROUP BY o.activity_id LIMIT $start, $limit";
	$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	if($page>$lastpage) 
		$page=0;
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">&laquo previous</a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next &raquo</a>";
		else
			$pagination.= "<span class=\"disabled\">next &raquo</span>";
		$pagination.= "</div>\n";		
	}
?>

<div style="display:block;" align="center"><?php
if ($resultCount>0)
{	?>
<h3 align="left"> <?php echo $resultCount; ?> new requests!</h4>
<hr>
<?= $pagination; ?>
<table align="center" class="table-div">
	<?php
		while($row = mysql_fetch_array($result))
		{
		
		$opp_query="SELECT * FROM volunteering_opportunities WHERE approval_status='P' AND activity_id=".$row['activity_id']; 
	$oppresult=mysql_query($opp_query);
	?>
	<tr class="rows">
	<td width=80%   id="<?php echo $count;?>"> <div style="width:100%;">
	<p>
	<span style="float:left">Partner:&nbsp<b><?php echo $row['name']; ?></b> </span>
	<span style="float:right;margin-right:8px;">Vertical:&nbsp<b style="color:#0C7878;"><?php echo $row['vertical']; ?></b></span><br />
	<span style="float:right;margin-right:8px;">Domain:&nbsp<b style="color:#801506;"><?php echo $row['domain']; ?></b></span><br /><br />
	<span style="float:right;margin-right:8px"><b><?php echo $row['onsite_offsite']; ?></b></span>
	<h5 style="position:relative;top:-15px;padding:0px;margin:0px;"><?php echo $row['activity']; ?></h5>
<form id="activityApprovalForm" method="post" action="activityApproval.php">
		<div style="float:right"><input  name="activityApprove" type="submit" value="Confirm" ">
		<input name="act_id" type="text" hidden value="<?php echo $row['activity_id']; ?>"></input></div>
		
	<b>Details:</b>&nbsp<?php echo $row['activity_details']; ?><br /><br />
	<span style="float:left;"><b>Skills:</b>&nbsp<?php echo $row['skills']; ?> </span>
	</p>
	</div>
	</td>
	</tr>
	<tr>
	<td id="details<?php echo $count; ?>" hidden>
	<div>
	<table class="table-innerdiv">
	<th>From date</th><th>To Date</th><th>From time</th><th>To time</th><th>Location</th><th>City</th><th>Vol Req.</th><th><span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Select opportunities to approve,Unchecked opportunities will be rejected.</span></a></span></th></tr>
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
	</div>
	</td>
	</tr>
	<script type="text/javascript">
		$(function(){
		$("#<?php echo $count; ?>").click(function(){
		if($("#details<?php echo $count; ?>").css('display')!='none'){
		$($("#details<?php echo $count; ?>")).slideUp();	
		$("#<?php echo $count; ?>").css("background-color","#e2e2e2");
		}
		else {
		for($i=0;$i<<?php echo $resultCount; ?>;$i++){
		$("#details"+$i).hide();
		$("#"+$i).css("background-color","#f2f2f2");
		}
		$("#details<?php echo $count; ?>").slideDown();
		$("#<?php echo $count; ?>").css("background","#c2c2c2");
		$("#details<?php echo $count; ?>").css("background","#c2c2c2");
		}
		});       
		});
	</script>
	</form>
<?php $count++;
	
		}

	?>

	
</table>	
<?= $pagination; ?>

<?php
}
else
{
	echo "You don't have any Activity Registrations to Approve.";
}
?>
		
</div>

</body>
</html>

