<?php
$query = "SELECT PROJECT_ID, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, LATITUDE, LONGITUDE, NAME, TOTAL_VALUE, TOTAL_POSTPAID, (TOTAL_VALUE-TOTAL_POSTPAID) AVAILABLE, WEBSITE_URL
       FROM (SELECT PROJECT_ID, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, LATITUDE, LONGITUDE, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID
            FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
                 FROM PROJECT_CERTIFICATES LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
                                                           FROM POSTPAY_CERTIFICATES GROUP BY CERTIFICATE_ID)PAID
                 USING (CERTIFICATE_ID)
                 GROUP BY  PROJECT_ID)SUMMARY
            LEFT OUTER JOIN PROJECTS USING (PROJECT_ID)
            WHERE PROJECT_STATUS='Active')FULL
       LEFT OUTER JOIN PROJECT_PARTNERS USING (PARTNER_ID)
       ORDER BY  AVAILABLE DESC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

$sno = 1;

//Table heading declaration
echo "<table width=\"100%\" style='font-size:12px'><tr bgcolor=\"CCCCFF\"><th width=\"5%\">S-No</th><th width=\"20%\">Project Area</th><th width=\"20%\">Location</th><th width=\"35%\">Project Description</th><th width=\"20%\">Project Partner</th></tr>";
while ($row = mysql_fetch_assoc($result)) {

// variable for coloring oddeven rows
$oddeven = $sno & 1;

//variable for providing ids for hiding each project details and for partner website links
$details = "details" . $sno;
$WEBSITE_URL = $row['WEBSITE_URL'];
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}

//following section post values into a table
echo "<tr bgcolor=\"$color\"><td width=\"5%\">" . $sno . "</td><td align=\"left\" width=\"20%\">" . $row['PROJECT_AREA'] . "</td><td align=\"left\" width=\"20%\">" . $row['LOCATION'] . "</td><td align=\"left\" width=\"35%\">" . $row['PROJECT_DESCRIPTION'] . "</td><td align=\"left\" width=\"20%\">". "<a href=\"$WEBSITE_URL\" target=\"_blank\">" . $row['NAME'] . "</a>" . "</td></tr>";
$sno++; }
echo "</table>";

?>