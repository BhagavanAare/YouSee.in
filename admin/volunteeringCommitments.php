<head>
<style>
.scrollbar 
{
	overflow: auto;
	border: solid 1px #000;
	padding: 5px;
	width: 700px;
	height: 300px;
}
</style>
<style type="text/css" media="screen">
#table-search .rows
{
	cursor:pointer;
}
#table-search .rows:hover
{
	background:#e2e2e2;
}
</style>
<script type="text/javascript">
		$(function() {
		$( "#fromdate" ).datepicker();
		$( "#todate" ).datepicker();
	});
</script>
</head>

<form action="volunteer_commitments.php" method="post">

<h3 style="margin-left:20px; ">Recent Volunteering Commitments</h3>
<?php
$vol_comm = "SELECT * FROM donors 
	     INNER JOIN volunteer_commits ON donors.donor_id=volunteer_commits.donor_id
	     INNER JOIN volunteering_opportunities ON volunteer_commits.opportunity_id=volunteering_opportunities.opportunity_id
	     INNER JOIN volunteering_activity ON volunteering_opportunities.activity_id=volunteering_activity.activity_id
	     INNER JOIN project_partners ON volunteering_activity.partner_id=project_partners.partner_id
	     GROUP BY volunteering_activity.activity_id ORDER BY volunteer_commits.commit_id desc
	     LIMIT 0,5";

include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$vol_comm5 = mysql_query($vol_comm);
$resultcount=mysql_num_rows($vol_comm5);

$no = 1;
echo "<table class=\"scrollbar\" id=\"table-search\" style='font-size:12px'>";
echo "<thead>";
echo "<tr>";
echo "<th align=\"middle\">S.No</th>";
echo "<th align=\"middle\">Name of the Volunteer</th>";
echo "<th align=\"middle\">Activity</th>";
echo "<th align=\"middle\">NGO</th>";
echo "<th align=\"middle\">Commit Date/Time</th>";
echo "</thead>";
$i=1;	
while ($rows = mysql_fetch_assoc($vol_comm5)) 
{
		$vol_detail = "SELECT * 
		FROM volunteering_opportunities
		INNER JOIN volunteer_commits ON volunteering_opportunities.opportunity_id = volunteer_commits.opportunity_id
		INNER JOIN volunteering_activity ON volunteering_opportunities.activity_id=volunteering_activity.activity_id
		INNER JOIN donors ON volunteer_commits.donor_id = donors.donor_id
		WHERE volunteer_commits.donor_id=".$rows['donor_id']." GROUP BY volunteer_commits.commit_id" ;
		$vol_details = mysql_query($vol_detail);
		$details = "detail".$i;						
		echo "<tr class=\"rows\" id=\"$i\">";
		echo "<td align=\"middle\">" . $i . "</td><td width=\"14%\">" . $rows['displayname'] . "</td><td align=\"middle\">" . $rows['activity'] . "</td><td align=\"middle\">" . $rows['name'] . "</td><td align=\"middle\">" . $rows['commit_date_time'] . "</td>";
		echo "</tr>";
		echo "<tr >";
		echo "<td colspan=\"6\" id=\"$details\" hidden>";
		echo "<table align=\"right\" id=\"altColorSubTable\">";
		echo "<thead>";
		echo "<tr><th>From Date</th><th>To Date</th>";echo "<th>Location</th><th>City</th><th>Number of Volunteers</th>";
		echo "</tr>"; 
		echo "</thead>";
		while ($row = mysql_fetch_assoc($vol_details)) 
		{
			echo "<tbody>";
			echo "<tr>";
			echo "<td width=\"14%\">" . $row['from_date'] . "</td><td align=\"middle\">" . $row['to_date'] . "</td><td align=\"middle\">" . $row['location'] . "</td><td align=\"middle\">" . $row['city'] . "</td><td align=\"middle\">" . $row['num_volunteers'] . "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</td>";
		echo "</tr>";
?>
				<script>
				$(function(){
				$("#<?php echo $i; ?>").click(function(){

				if($("#detail<?php echo $i; ?>").css('display')!='none'){$("#detail<?php echo $i; ?>").slideUp();}
				else{	
					var $resultcount= <?php echo $resultcount; ?>;
					for(var $j=1;$j<$resultcount; $j++){
					$("#detail"+$j).hide();
					}
					$("#detail<?php echo $i; ?>").slideDown();}
					});
				});
				</script>
<?php
		$i++;
		$no++;
	}
	echo "</table>";
?>

<h3 style="margin-left:20px; ">Volunteering Commitments Report</h3>
<table id="table-search">
	<tr>
		<th>From Date</th>
		<th>To Date</th>
	</tr>
	<tr>
		<td style="vertical-align:top;"><input type="text" name="from_date" id="fromdate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("d-M-Y"); ?>'></td>
		<td style="vertical-align:top;"><input type="text" name="to_date" id="todate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("d-M-Y"); ?>'></td>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>
</table>
</form>

<?php
if (isset($_POST['submit']))
{
		$_POST['from_date']=gmdate("Y-m-d",strtotime($_POST['from_date']));
		$_POST['to_date']=gmdate("Y-m-d",strtotime($_POST['to_date']));
		if($_POST['from_date']==$_POST['to_date']) 
		{
			$dates=date("d M Y", strtotime($_POST['from_date']));
		}
		else 
		{
			$dates= date("d M Y", strtotime($_POST['from_date'])) ." <b>To </b>". date("d M Y", strtotime($_POST['to_date']));
		}
	include_once("prod_conn.php");
	//query for retreving individual certificates within a project
	$query = "SELECT * FROM donors 
		INNER JOIN volunteer_commits ON donors.donor_id=volunteer_commits.donor_id
		INNER JOIN volunteering_opportunities ON volunteer_commits.opportunity_id=volunteering_opportunities.opportunity_id
		INNER JOIN volunteering_activity ON volunteering_opportunities.activity_id=volunteering_activity.activity_id
		INNER JOIN project_partners ON volunteering_activity.partner_id=project_partners.partner_id
		WHERE date(commit_date_time) BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."'
	 	GROUP BY volunteering_activity.activity_id  ORDER BY volunteer_commits.commit_id desc";
	$query1 = "SELECT * FROM donors 
		INNER JOIN volunteer_commits ON donors.donor_id=volunteer_commits.donor_id
		INNER JOIN volunteering_opportunities ON volunteer_commits.opportunity_id=volunteering_opportunities.opportunity_id
		INNER JOIN volunteering_activity ON volunteering_opportunities.activity_id=volunteering_activity.activity_id
		INNER JOIN project_partners ON volunteering_activity.partner_id=project_partners.partner_id
		WHERE to_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."'
	 	GROUP BY volunteering_activity.activity_id ORDER BY volunteer_commits.commit_id desc";
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");?>
	<?php
	$result = mysql_query($query);
	$result1 = mysql_query($query1);
	if(mysql_num_rows($result)!= 0) 
	{
		$no = 1;
		//Table heading declaration
		echo "<table class=\"scrollbar\" id=\"table-search\" style='font-size:12px'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th align=\"middle\">S.No</th>";
		echo "<th align=\"middle\">Name of the Volunteer</th>";
		echo "<th align=\"middle\">Activity</th>";
		echo "<th align=\"middle\">NGO</th>";
		echo "<th align=\"middle\">Commit Date/Time</th>";
		echo "</thead>";
		$i=6;	
		echo "<h3>Reports based on Opportunity Commit date</h3>";
		echo "</br>";
 		echo "<b> Report Period : </b>" . $dates . "</br>";
		echo "</br>";	
		while ($rows = mysql_fetch_assoc($result))
		{
			$vol_detail = "SELECT * 
			FROM volunteering_opportunities
			INNER JOIN volunteer_commits ON volunteering_opportunities.opportunity_id = volunteer_commits.opportunity_id
			INNER JOIN volunteering_activity ON volunteering_opportunities.activity_id=volunteering_activity.activity_id
			INNER JOIN donors ON volunteer_commits.donor_id = donors.donor_id
			WHERE volunteer_commits.donor_id=".$rows['donor_id']." GROUP BY volunteer_commits.commit_id";
			$vol_details = mysql_query($vol_detail);
			$details = "detail".$i;						
			echo "<tr class=\"rows\" id=\"$i\">";
			echo "<td align=\"middle\">" . $i . "</td><td width=\"14%\">" . $rows['displayname'] . "</td><td align=\"middle\">" . $rows['activity'] . "</td><td align=\"middle\">" . $rows['name'] . "</td><td align=\"middle\">" . $rows['commit_date_time'] . "</td>";
			echo "</tr>";
			echo "<tr >";
			echo "<td colspan=\"6\" id=\"$details\" hidden>";
			echo "<table align=\"right\" id=\"altColorSubTable\">";
			echo "<thead>";
			echo "<tr><th>From Date</th><th>To Date</th>";echo "<th>Location</th><th>City</th><th>Number of Volunteers</th>";
			echo "</tr>"; 
			echo "</thead>";
			while ($row = mysql_fetch_assoc($vol_details)) 
			{
				echo "<tbody>";
				echo "<tr>";
				echo "<td width=\"14%\">" . $row['from_date'] . "</td><td align=\"middle\">" . $row['to_date'] . "</td><td align=\"middle\">" . $row['location'] . "</td><td align=\"middle\">" . $row['city'] . "</td><td align=\"middle\">" . $row['num_volunteers'] . "</td>";
				echo "</tr>";
			}	
			echo "</tbody>";
			echo "</table>";
			echo "</td>";
			echo "</tr>";
?>
				<script>
					$(function(){
					$("#<?php echo $i; ?>").click(function(){

					if($("#detail<?php echo $i; ?>").css('display')!='none'){$("#detail<?php echo $i; ?>").slideUp();}
					else{	
						var $resultcount= <?php echo $resultcount; ?>;
						for(var $j=1;$j<$resultcount; $j++){
						$("#detail"+$j).hide();
						}
						$("#detail<?php echo $i; ?>").slideDown();}
						});
					});
				</script>
			<?php
			$i++;
			$no++;
		}
	}
if(mysql_num_rows($result1)!= 0) 
	{
		$no = 1;
		//Table heading declaration
		echo "<table class=\"scrollbar\" id=\"table-search\" style='font-size:12px'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th align=\"middle\">S.No</th>";
		echo "<th align=\"middle\">Name of the Volunteer</th>";
		echo "<th align=\"middle\">Activity</th>";
		echo "<th align=\"middle\">NGO</th>";
		echo "<th align=\"middle\">Commit Date/Time</th>";
		echo "</thead>";
		$i=100;	
		echo "<h3>Reports based on Opportunity To-Date</h3>";
		echo "</br>";
 		echo "<b> Report Period : </b>" . $dates . "</br>";
		echo "</br>";
			
		while ($rows = mysql_fetch_assoc($result1))
		{
			$vol_detail = "SELECT * 
			FROM volunteering_opportunities
			INNER JOIN volunteer_commits ON volunteering_opportunities.opportunity_id = volunteer_commits.opportunity_id
			INNER JOIN volunteering_activity ON volunteering_opportunities.activity_id=volunteering_activity.activity_id
			INNER JOIN donors ON volunteer_commits.donor_id = donors.donor_id
			WHERE volunteer_commits.donor_id=".$rows['donor_id']." GROUP BY volunteer_commits.commit_id";
			$vol_details = mysql_query($vol_detail);
			$details = "detail".$i;						
			echo "<tr class=\"rows\" id=\"$i\">";
			echo "<td align=\"middle\">" . $i . "</td><td width=\"14%\">" . $rows['displayname'] . "</td><td align=\"middle\">" . $rows['activity'] . "</td><td align=\"middle\">" . $rows['name'] . "</td><td align=\"middle\">" . $rows['commit_date_time'] . "</td>";
			echo "</tr>";
			echo "<tr >";
			echo "<td colspan=\"6\" id=\"$details\" hidden>";
			echo "<table align=\"right\" id=\"altColorSubTable\">";
			echo "<thead>";
			echo "<tr><th>From Date</th><th>To Date</th>";echo "<th>Location</th><th>City</th><th>Number of Volunteers</th>";
			echo "</tr>"; 
			echo "</thead>";
			while ($row = mysql_fetch_assoc($vol_details)) 
			{
				echo "<tbody>";
				echo "<tr>";
				echo "<td width=\"14%\">" . $row['from_date'] . "</td><td align=\"middle\">" . $row['to_date'] . "</td><td align=\"middle\">" . $row['location'] . "</td><td align=\"middle\">" . $row['city'] . "</td><td align=\"middle\">" . $row['num_volunteers'] . "</td>";
				echo "</tr>";
			}	
			echo "</tbody>";
			echo "</table>";
			echo "</td>";
			echo "</tr>";
?>
				<script>
					$(function(){
					$("#<?php echo $i; ?>").click(function(){

					if($("#detail<?php echo $i; ?>").css('display')!='none'){$("#detail<?php echo $i; ?>").slideUp();}
					else{	
						var $resultcount= <?php echo $resultcount; ?>;
						for(var $j=1;$j<$resultcount; $j++){
						$("#detail"+$j).hide();
						}
						$("#detail<?php echo $i; ?>").slideDown();}
						});
					});
				</script>
			<?php
			$i++;
			$no++;
		}
	}
	else
	{
		echo "<div style=\"margin-top:10px; margin-left:10px;\">No Volunteering Commitments are there within the given dates</div>";
	}
}

?>
</div>
