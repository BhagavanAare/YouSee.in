<?php
//include("conn.php");
include("prod_conn.php");
$query = "SELECT CERTIFICATE_ID,TITLE
,MAX(VALUE) TOTAL_COST
,IFNULL(SUM(AMOUNT_FOR_PROJECT),0) POST_PAID
,MAX(VALUE)-IFNULL(SUM(AMOUNT_FOR_PROJECT),0) AVAILABLE
,round(((IFNULL(SUM(AMOUNT_FOR_PROJECT),0)/MAX(VALUE))*100),2) POST_PAID_PCT
,round(100-((IFNULL(SUM(AMOUNT_FOR_PROJECT),0)/MAX(VALUE))*100),2) AVAILABLE_PCT
,DOCUMENT_LINK
from PROJECT_CERTIFICATES
LEFT OUTER JOIN POSTPAY_CERTIFICATES USING (CERTIFICATE_ID) WHERE 1 GROUP BY CERTIFICATE_ID,DESCRIPTION
ORDER BY CONVERT(CERTIFICATE_ID,SIGNED)";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
//$num_rows = mysql_num_rows($result);
//echo $num_rows;
echo "<table class=\"featured_cert_acquired\">";
echo  "<thead><tr>";
echo  "<th><b>S.No.</b></th>";
echo  "<th><b>TITLE</b></th>\n";
echo  "<th><b>PostPaid/Available Status in INR</b></th>\n";
echo  "<th><b>PostPaid+Available=Total Cost (INR)</b></th>\n";
echo  "<th><b>Certificate document</b></th>\n";
echo  "</thead></tr>\n";

$i = 1;
while ($row = mysql_fetch_assoc($result)) 
{
		$certid = $row['CERTIFICATE_ID'];
		$proj_desc = $row['TITLE'];
		$total_cost = $row['TOTAL_COST'];
		$postpaid = $row['POST_PAID'];
		$available = $row['AVAILABLE'];
		$postpaid_pct = $row['POST_PAID_PCT'];
		$available_pct = $row['AVAILABLE_PCT'];
		$DOCUMENT_LINK = $row['DOCUMENT_LINK'];
	
	$oddeven = $i & 1;
 if ($oddeven == 0){			$oddeven = "featured_cert_acquired_even";}			else {				$oddeven = "featured_cert_acquired_odd";}

	echo "<tr class=\"$oddeven\">\n";
	echo  "<td>$certid</td>\n";
	echo  "<td style=\"text-align:left;\">$proj_desc</td>\n";	
	echo  "<td><img border=\"0\" src=\"http://chart.apis.google.com/chart?chs=150x15&cht=bhs&chbh=a&chco=4AA02C,FF0000&chd=t:$postpaid|$total_cost&chds=0,$total_cost\"></td>\n";
	echo  "<td>$postpaid ($postpaid_pct %)+<br>$available ($available_pct %)<br>= $total_cost</td>\n";
	echo  "<td><a href=\"$DOCUMENT_LINK\" target=\"_blank\"><img src=\"images/doctype_pdf.gif\" /></a></td>\n";
	echo  "</tr>\n";
	$i++;
}
echo "</table>";
?>