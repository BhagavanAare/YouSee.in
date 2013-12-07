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
FROM project_certificates
LEFT OUTER JOIN postpay_certificates USING (CERTIFICATE_ID)
WHERE donor_id=".$_SESSION['SESS_DONOR_ID']."
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

$totaldonation = $postpaid + $opsgrant;

//number formatting
$ptotalvalue = number_format($totalvalue, 0, '.', ',');
$ptotaldonation = number_format($totaldonation, 0, '.', ',');

?>

<div align="center">
	<table border="0" style='font-family:"arial"; font-size:12px; width:330px;'>
		<th width="50%"></th><th width="50%"></th>
		<tr>
			<td colspan="2" align="center"><b>My PostPay Donations (in INR)</b></td>
		</tr>
		<tr>
			<td align="right"><img src="images/donate_wealth.jpg" border="0" /></td>
			<td align="left"><h2>Rs <?php echo $ptotaldonation;?></h2></td>
		</tr>
	</table>
</div>
