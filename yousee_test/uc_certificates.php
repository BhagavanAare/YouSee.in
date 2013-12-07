<html>
<head>
<script type="text/javascript">
 function reveal(a){
 var e=document.getElementById(a);
 if(!e)return true;
 if(e.style.display=="none"){
 e.style.display="block"
 } else {
 e.style.display="none"
 }
 return true;
 }
 </script>
 </head>
 <body>
<?php
include("prod_conn.php");

$query = "SELECT PROJECT_ID, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, NAME, TOTAL_VALUE, TOTAL_POSTPAID, (TOTAL_VALUE-TOTAL_POSTPAID) AVAILABLE, WEBSITE_URL
       FROM (SELECT PROJECT_ID, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID
            FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
                 FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
                                                           FROM postpay_certificates GROUP BY CERTIFICATE_ID)PAID
                 USING (CERTIFICATE_ID)
                 GROUP BY  PROJECT_ID)SUMMARY
            LEFT OUTER JOIN projects USING (PROJECT_ID))FULL
       LEFT OUTER JOIN project_partners USING (PARTNER_ID)
       ORDER BY  AVAILABLE DESC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

$sno = 1;

//Table heading declaration
echo "<table width=\"100%\" style='font-size:12px'><tr bgcolor=\"CCCCFF\"><th width=\"3%\">S-No</th><th width=\"14%\">Project Area</th><th width=\"12%\">Location</th><th width=\"29%\">Project Description</th><th width=\"10%\">Project Partner</th><th width=\"7%\">Total Cost(INR)</th><th align=\"left\" width=\"9%\">PostPaid(INR) by Donors</th><th align=\"right\" width=\"9%\">Awaiting Donations(INR)</th><th width=\"7%\" >View Details</th></tr></table>";
while ($row = mysql_fetch_assoc($result)) {

// following section declares variables for project level summary
$POSTPAID_PCT = round((($row['TOTAL_POSTPAID']/$row['TOTAL_VALUE'])*100),1);
$AVAILABLE_PCT = round((100-$POSTPAID_PCT),1);

// following variables generated for graph api  for project level summary
$TOTAL_VALUE = $row['TOTAL_VALUE'];
$TOTAL_POSTPAID = $row['TOTAL_POSTPAID'];

// following variables generated for number formatting for project level summmary
$AVAILABLE_F = number_format($row['AVAILABLE'], 0, '.', ',');
$TOTAL_VALUE_F = number_format($TOTAL_VALUE, 0, '.', ',');
$TOTAL_POSTPAID_F = number_format($TOTAL_POSTPAID, 0, '.', ',');

// variable for coloring oddeven rows
$oddeven = $sno & 1;

//variable for providing ids for hiding each project details and for partner website links
$details = "details" . $sno;
$MATCH_PROJECT_ID = $row['PROJECT_ID'];
$WEBSITE_URL = $row['WEBSITE_URL'];
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}

//following section post values into a table
echo "<table bgcolor=\"$color\" style='font-size:12px' >";
echo "<tr><td rowspan=\"3\" width=\"3%\">" . $sno . "</td><td rowspan=\"3\" align=\"left\" width=\"14%\">" . $row['PROJECT_AREA'] . "</td><td rowspan=\"3\" align=\"left\" width=\"12%\">" . $row['LOCATION'] . "</td><td rowspan=\"3\" align=\"left\" width=\"29%\">" . $row['PROJECT_DESCRIPTION'] . "</td><td rowspan=\"3\" align=\"left\" width=\"10%\">". "<a href=\"$WEBSITE_URL\" target=\"_blank\">" . $row['NAME'] . "</a>" . "</td><td rowspan=\"3\" align=\"right\" width=\"7%\">". $TOTAL_VALUE_F . "</td><td align=\"left\" width=\"9%\">" . $TOTAL_POSTPAID_F . "</td><td align=\"right\" width=\"9%\">" . $AVAILABLE_F . "</td><td rowspan=\"3\" align=\"center\" onclick=\"reveal('$details'); return false\" width=\"7%\"  style=\"cursor:pointer;\">Click to View</td></tr>";
//graph section of the table
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<table id=\"graph_table\"><tr>";
echo "<td id=\"left_td\" width=\"" . $POSTPAID_PCT . "\"></td>";
echo "<td id=\"right_td\" width=\"" . $AVAILABLE_PCT . "\"></td>";
echo "</tr></table>";
echo "</td></tr>";
echo "<tr><td align=\"left\">" . $POSTPAID_PCT . "%" . "</td><td align=\"right\">" . $AVAILABLE_PCT . "%" . "</td></tr></table>";


//query for retreving individual certificates within a project
$query2 = "SELECT CERTIFICATE_ID, PROJECT_ID, DATE_FORMAT(START_DATE,'%d-%b-%Y') STARTDATE, DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') COMPLETIONDATE, VALUE, POSTPAID, DOCUMENT_LINK, (VALUE-POSTPAID) AVAILABLE
        FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
                                                  FROM postpay_certificates GROUP BY CERTIFICATE_ID)PAID
        USING (CERTIFICATE_ID)
        ORDER BY START_DATE DESC";

$result2 = mysql_query($query2);

$ino = 1;

// following section creates sub table containing certificate details
echo "<table bgcolor=\"$color\" id=\"$details\"; style=\"display:none; font-size:12px\" width=\"100%\">";

while ($row2 = mysql_fetch_assoc($result2)) {
// following section declares variables for certificates
$POSTPAID_PCT = round((($row2['POSTPAID']/$row2['VALUE'])*100),1);
$AVAILABLE_PCT = round((100-$POSTPAID_PCT),1);

// following variables generated for graph api  and document links for certificates
$VALUE = $row2['VALUE'];
$POSTPAID = $row2['POSTPAID'];
$DOCUMENT_LINK = $row2['DOCUMENT_LINK'];  

// following variables generated for number and date formatting for certificates
$AVAILABLE_F = number_format($row2['AVAILABLE'], 0, '.', ',');
$VALUE_F = number_format($VALUE, 0, '.', ',');
$POSTPAID_F = number_format($POSTPAID, 0, '.', ',');
$COMPLETIONDT = $row2['COMPLETIONDATE'];
$STARTDT = $row2['STARTDATE'];

if($MATCH_PROJECT_ID == $row2['PROJECT_ID']) {
echo "<tr><td rowspan=\"3\" width=\"3%\">" . $sno . "." . $ino . "</td><td rowspan=\"3\" colspan=\"2\" width=\"26%\"></td><td colspan=\"2\" align=\"left\" rowspan=\"3\" width=\"39%\">" . $STARTDT . " to " . $COMPLETIONDT . "</td><td align=\"right\" rowspan=\"3\" width=\"7%\">" . $VALUE_F . "</td><td align=\"left\" width=\"9%\">" . $POSTPAID_F . "</td><td align=\"right\" width=\"9%\">" . $AVAILABLE_F . "</td><td align=\"center\" rowspan=\"3\" width=\"7%\"><a href=\"$DOCUMENT_LINK\" target=\"_blank\"><img src=\"images/doctype_pdf.gif\" /></a></td></tr>";
//graph section of the table
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<table id=\"graph_table\"><tr>";
echo "<td id=\"left_td\" width=\"" . $POSTPAID_PCT . "\"></td>";
echo "<td id=\"right_td\" width=\"" . $AVAILABLE_PCT . "\"></td>";
echo "</tr></table>";
echo "</td></tr>";
echo "<tr><td align=\"left\">" . $POSTPAID_PCT . "%" . "</td><td align=\"right\">" . $AVAILABLE_PCT . "%" . "</td></tr>";
$ino++; }}

echo "</table>";

$sno++; }
?>
</body>
</html>