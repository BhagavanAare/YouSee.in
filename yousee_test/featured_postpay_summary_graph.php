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
  <td colspan="4" align="center"><b>4. PostPay Donations received for Projects (in INR)</b><br>Total Projects Completed for <?php echo $ptotalvalue;?> <br> </td>
</tr>
<tr>
  <td rowspan="3" align="right">PostPaid</td>
  <td align="left"><?php echo $ppostpaid;?></td>
  <td align="right"><?php echo $pavailable;?></td>
  <td rowspan="3" align="left">Awaiting Donations</td>
</tr>
<tr>
  <td colspan="2" align="center">
  <!--graph section of the table-->
  <table id="graph_table"><tr>
  <td id="left_td" width="<?php echo $receivedpct; ?>%"></td>
  <td id="right_td" width="<?php echo $availablepct; ?>%"></td>
  </tr></table>
  </td>
</tr>
<tr>
  <td align="left"><?php echo $receivedpct;?>%</td>
  <td align="right"><?php echo $availablepct;?>%</td>
</tr>
</table>

<br>

</div>
