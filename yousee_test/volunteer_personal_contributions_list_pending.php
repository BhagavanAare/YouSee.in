<?php
//include("prod_conn.php");

// this section generates query for volunteering contributions summary
$query = "SELECT DONOR_ID, DISPLAYNAME, DATE_FORMAT(from_date,'%d-%b-%Y') FROMDATE, DATE_FORMAT(to_date,'%d-%b-%Y') TODATE, hours, activity_done, onsite_offsite
          FROM volunteering LEFT OUTER JOIN DONORS USING (DONOR_ID)
          WHERE DONOR_ID=".$_SESSION['SESS_DONOR_ID']." 
		  AND APPROVAL_STATUS = 'P'
          ORDER BY  FROMDATE DESC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

$sno = 1;

//Table heading declaration
echo "<table width=\"100%\" style='font-size:12px'><tr bgcolor=\"CCCCFF\"><th>S-No</th><th>Volunteer Name</th><th>From Date</th><th>To Date</th><th>Hours Volunteered</th><th>Activity</th><th>Onsite-Offsite</th></tr>";
while ($row = mysql_fetch_assoc($result)) {

// variable for coloring oddeven rows
$oddeven = $sno & 1;
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}

//following section post values into a table
echo "<tr bgcolor=\"$color\"><td width=\"5%\">" . $sno . "</td><td align=\"left\">" . $row['DISPLAYNAME'] . "</td><td align=\"left\">" . $row['FROMDATE'] . "</td><td align=\"left\">" . $row['TODATE'] . "</td><td align=\"center\">" . $row['hours'] . "</td><td align=\"left\">" . $row['activity_done'] . "</td><td align=\"left\">" . $row['onsite_offsite'] . "</td></tr>";
$sno++; }
echo "</table>";

?>

