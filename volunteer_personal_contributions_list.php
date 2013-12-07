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
<script type="text/javascript">
		$(function() {
		$( "#fromdate" ).datepicker();
		$( "#todate" ).datepicker();
	});
</script>
<form action="myucVolunteeringContributions.php" method="post">
<h3 style="margin-left:20px; ">Recent Volunteering Contributions</h3>
<?php
$vol_contr = "SELECT donor_id, displayname, DATE_FORMAT(from_date,'%d-%b-%Y') FROMDATE, DATE_FORMAT(to_date,'%d-%b-%Y') TODATE, hours, activity_done, onsite_offsite
	  FROM volunteering LEFT OUTER JOIN donors USING (donor_id)
          WHERE donor_id=".$_SESSION['SESS_DONOR_ID']." 
	  AND approval_status='A'
          ORDER BY from_date DESC
	  LIMIT 0,5";
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$vol_contr5 = mysql_query($vol_contr);

$sno = 1;

//Table heading declaration
		$i = 1;
		echo "<table id=\"table-search\"width=\"100%\" style='font-size:12px'><thead><tr><th>S.No</th><th>From Date</th><th>To Date</th><th>Hours Volunteered</th><th>Activity</th><th>Onsite-Offsite</th></tr><thead><tbody>";
		while ($row = mysql_fetch_assoc($vol_contr5)) {
		echo "<tr ><td width=\"5%\">" . $sno . "</td><td align=\"left\">" . $row['FROMDATE'] . "</td><td align=\"left\">" . $row['TODATE'] . "</td><td align=\"center\">" . $row['hours'] . "</td><td align=\"left\">" . $row['activity_done'] . "</td><td align=\"left\">" . $row['onsite_offsite'] . "</td></tr>";
		$sno++; }
		echo "</tbody></table>";
		$i++;

?>
<h3 style="margin-left:20px; ">Volunteering Contributions Report</h3>
<input type="hidden" name="volunteering" value="volunteering" />
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
	include("prod_conn.php");

// this section generates query for volunteering contributions summary
$query = "SELECT donor_id, displayname, DATE_FORMAT(from_date,'%d-%b-%Y') FROMDATE, DATE_FORMAT(to_date,'%d-%b-%Y') TODATE, hours, activity_done, onsite_offsite
          FROM volunteering LEFT OUTER JOIN donors USING (donor_id)
          WHERE from_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."' AND  donor_id=".$_SESSION['SESS_DONOR_ID']." 
	  AND approval_status='A'
          ORDER BY from_date DESC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

$sno = 1;

//Table heading declaration
	echo "</br>";
 	echo "<b> Reports From : </b>" . $dates . "</br>";
	echo "</br>";
	if(mysql_num_rows($result)!= 0) 
	{
		$rows;
		$i = 1;
		echo "<table id=\"table-search\"width=\"100%\" style='font-size:12px'><thead><tr><th>S.No</th><th>From Date</th><th>To Date</th><th>Hours Volunteered</th><th>Activity</th><th>Onsite-Offsite</th></tr><thead><tbody>";
		while ($row = mysql_fetch_assoc($result)) {

		// variable for coloring oddeven rows

		//following section post values into a table
		echo "<tr ><td width=\"5%\">" . $sno . "</td><td align=\"left\">" . $row['FROMDATE'] . "</td><td align=\"left\">" . $row['TODATE'] . "</td><td align=\"center\">" . $row['hours'] . "</td><td align=\"left\">" . $row['activity_done'] . "</td><td align=\"left\">" . $row['onsite_offsite'] . "</td></tr>";
		$sno++; }
		echo "</tbody></table>";
		$i++;
	}
	else{
	echo "No Volunteering Contributions within the given dates.";}
}

?>

