<?php
include("prod_conn.php");
$query = "SELECT SUM(TOTALVALUE) TOTALVALUE
,SUM(POSTPAID) POSTPAID
,SUM(OPSGRANT) OPSGRANT
FROM (
SELECT
CERTIFICATE_ID
,MAX(VALUE) TOTALVALUE
,SUM(AMOUNT_FOR_PROJECT) POSTPAID
,SUM(AMOUNT_FOR_OPERATIONS_GRANT) OPSGRANT
FROM PROJECT_CERTIFICATES
LEFT OUTER JOIN POSTPAY_CERTIFICATES USING (CERTIFICATE_ID)
WHERE DONOR_ID=".$_SESSION['SESS_DONOR_ID']."
GROUP BY CERTIFICATE_ID
)INFO";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
		$totalvalue = $row['TOTALVALUE'];
		$postpaid = $row['POSTPAID'];
		$opsgrant = $row['OPSGRANT'];
		}

$available = $totalvalue - $postpaid;
$totaldonation = $postpaid + $opsgrant;
$receivedpct = round((($postpaid/$totalvalue)*100),1);
$availablepct = round((100-$receivedpct),1);
$postpaypct = round((($postpaid/($postpaid+$opsgrant))*100),1);
$opsgrantpct = round((100-$postpaypct),1);

//number formatting
$ptotalvalue = number_format($totalvalue, 0, '.', ',');
$ppostpaid = number_format($postpaid, 0, '.', ',');
$popsgrant = number_format($opsgrant, 0, '.', ',');
$pavailable = number_format($available, 0, '.', ',');
$ptotaldonation = number_format($totaldonation, 0, '.', ',');

?>

<div align="center">
<br>
<table border="0" width="450" style='table-layout:fixed; font-family:"arial"; font-size:12px'>

<tr>
  <td colspan="4" align="center"><b>My PostPay Financial Donations (in INR):</b> <? echo $ptotaldonation;?> <br> </td>
</tr>
<tr>
  <td rowspan="3" align="right">For Projects</td>
  <td align="left"><? echo $ppostpaid;?></td>
  <td align="right"><? echo $popsgrant;?></td>
  <td rowspan="3" align="left">For UC Operations</td>
</tr>
<tr>
  <td colspan="2" align="center"><? echo "<img style=\"vertical-align:middle;\" border=\"0\" src=\"http://chart.apis.google.com/chart?chs=150x15&cht=bhs&chbh=a&chco=00FF00,00CC00&chd=t:$postpaid|$totaldonation&chds=0,$totaldonation\">"; ?></td>
</tr>
<tr>
  <td align="left"><? echo $postpaypct;?>%</td>
  <td align="right"><? echo $opsgrantpct;?>%</td>
</tr>
</table>

</div>
