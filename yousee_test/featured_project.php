<?php
//include("conn.php");
include("prod_conn.php");
$link = mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$range_result = mysql_query("SELECT  P.CERTIFICATE_ID FROM project_certificates P WHERE VALUE > (SELECT SUM(PP.AMOUNT_FOR_PROJECT)  FROM postpay_certificates PP
               WHERE PP.CERTIFICATE_ID=P.CERTIFICATE_ID)");
$random = Array();
while ($row = mysql_fetch_array($range_result, MYSQL_ASSOC)){
	$random[] = $row['CERTIFICATE_ID'];
}
$randomvaluekey = array_rand($random,1);
$randomvalue = $random[$randomvaluekey];
$query = "SELECT
 PROJECT_PHOTO_LINK                    IMG
,CONCAT(CONCAT(TOWN_CITY,' ,'),STATE)                      LOCATION
,CONCAT(CONCAT(AREA,' ,'),TAGS)                      AREATAGS
,DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') COMPLETIONDATE
,DATE_FORMAT(START_DATE,'%d-%b-%Y') STARTDATE
,NAME   PARTNER
,TITLE
,DESCRIPTION
,DOCUMENT_LINK
,VALUE
FROM project_certificates
LEFT OUTER JOIN project_partners USING (PARTNER_ID)
where certificate_id='$randomvalue'";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
		$img = $row['IMG'];
		$location = $row['LOCATION'];
		$areatags = $row['AREATAGS'];
		$procompdate = $row['COMPLETIONDATE'];
		$prostartdate = $row['STARTDATE'];
		$partner = $row['PARTNER'];
		$title = $row['TITLE'];
		$desc = $row['DESCRIPTION'];
		$doclink = $row['DOCUMENT_LINK'];
		$value = $row['VALUE'];
		}
?>

<?php
$chartquery = "SELECT CERTIFICATE_ID,DESCRIPTION
,MAX(VALUE) TOTAL_COST
,SUM(AMOUNT_FOR_PROJECT) POST_PAID
,MAX(VALUE)-SUM(AMOUNT_FOR_PROJECT) AVAILABLE
,round(((SUM(AMOUNT_FOR_PROJECT)/MAX(VALUE))*100),1) POST_PAID_PCT
,round(100-((SUM(AMOUNT_FOR_PROJECT)/MAX(VALUE))*100),1) AVAILABLE_PCT
from project_certificates
LEFT OUTER JOIN postpay_certificates USING (CERTIFICATE_ID) WHERE certificate_id='$randomvalue' GROUP BY CERTIFICATE_ID,DESCRIPTION";
$chartresult = mysql_query($chartquery);
while ($row = mysql_fetch_assoc($chartresult)) {
		$certid = $row['CERTIFICATE_ID'];
		$proj_desc = $row['DESCRIPTION'];
		$total_cost = $row['TOTAL_COST'];
		$postpaid = $row['POST_PAID'];
		$available = $row['AVAILABLE'];
		$postpaid_pct = $row['POST_PAID_PCT'];
		$available_pct = $row['AVAILABLE_PCT'];
}
$ppostpaid = number_format($postpaid, 0, '.', ',');
$pavailable = number_format($available, 0, '.', ',');
$ptotal_cost = number_format($total_cost, 0, '.', ',');
?>

<!-- display project info in table -->
<table style='width:450px; font-family:arial; font-size:12px;'>
	<tr>
		<td colspan="2" align="center"><h4 style='border-style:hidden; margin-top:10px; margin-bottom:5px;'>Featured Project</h4></td>
	</tr>
	<tr>
		<td rowspan="4"><img height="100px" width="100px" src="<?php echo $img; ?>"/></td>
		<td><b>Project Title: </b><?php echo $title; ?></td>
	</tr>
	<tr>
		<td><b>Project Partner: </b><?php echo $partner; ?></td>
	</tr>
	<tr>
		<td><b>Project Location: </b><?php echo $location; ?></td>	
	</tr>
	<tr>
		<td valign="middle"><b>See more here </b><a href="<?php echo $doclink; ?>" target="_blank"><img src="images/doctype_pdf.gif" /></a></td>	
	</tr>
</table>


<table style='width:450px; font-family:arial; font-size:12px;'>
	<tr>
		<td><b>PostPay Funding Status (in INR)</b></td>
		<td>PostPaid</td>
		<td align="right">Available</td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo $ppostpaid; ?></td>
		<td align="right"><?php echo $pavailable; ?></td>
	</tr>
	<tr>
		<td><b>Total Funded : </b><?php echo $ptotal_cost; ?></td>
		<td colspan="2">
			<!--graph section of the table-->
			<table id="graph_table"><tr>
			<td id="left_td" width="<?php echo $postpaid_pct; ?>%"></td>
			<td id="right_td" width="<?php echo $available_pct; ?>%"></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><b>Funding Period: </b><?php echo $prostartdate; ?> to </b><?php echo $procompdate; ?></td>	
		<td><?php echo $postpaid_pct; ?>%</td>
		<td align="right"><?php echo $available_pct; ?>%</td>
		
	</tr>	
</table>

<?php //mysql_close($link); ?>