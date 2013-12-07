<?php
//include("prod_conn.php");

// this section generates query for volunteering contributions summary
$query = "SELECT donor_id, displayname, DATE_FORMAT(from_date,'%d-%b-%Y') fromdate, DATE_FORMAT(to_date,'%d-%b-%Y') todate, hours, activity_done, onsite_offsite
          FROM volunteering LEFT OUTER JOIN donors USING (donor_id)
          WHERE donor_id=".$_SESSION['SESS_DONOR_ID']." 
		  AND approval_status = 'P'
          ORDER BY  fromdate DESC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

$sno = 1;
 
//Table heading declaration
?>
<table id="table-search" >
	<thead>
	<tr >
		<th>S.No</th>
		<th>Volunteer Name</th>
		<th>From Date</th>
		<th>To Date</th>
		<th>Hours</th>
		<th>Activity</th>
		<th>Onsite-Offsite</th>
	</tr>
	</thead>
<?php 
while ($row = mysql_fetch_assoc($result)) {


//following section post values into a table
echo "<tr ><td width=\"4%\">" . $sno . "</td><td align=\"left\">" . $row['displayname'] . "</td><td  align=\"left\">" . $row['fromdate'] . "</td><td align=\"left\">" . $row['todate'] . "</td><td width = \"1%\" align=\"center\">" . $row['hours'] . "</td><td align=\"left\">" . $row['activity_done'] . "</td><td align=\"left\">" . $row['onsite_offsite'] . "</td></tr>";
$sno++; }
echo "</table>";

?>

