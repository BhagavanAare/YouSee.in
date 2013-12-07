<?php
//include("conn.php");
include("prod_conn.php");
$link = mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$range_result = mysql_query("SELECT  P.CERTIFICATE_ID FROM PROJECT_CERTIFICATES P WHERE VALUE > (SELECT SUM(PP.AMOUNT_FOR_PROJECT)  FROM POSTPAY_CERTIFICATES PP
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
FROM PROJECT_CERTIFICATES
LEFT OUTER JOIN project_partners USING (PARTNER_ID)
where certificate_id='$randomvalue'";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
		$img = $row['IMG'];
		$location = $row['LOCATION'];
		$areatags = $row['AREATAGS'];
		$procompdate = $row['COMPLETIONDATE'];
		$prostartdate = $row['STARTDATE'];
		$period = $row['PERIOD'];
		$partner = $row['PARTNER'];
		$title = $row['TITLE'];
		$desc = $row['DESCRIPTION'];
		$doclink = $row['DOCUMENT_LINK'];
		$value = $row['VALUE'];
		}
?>

<?
$chartquery = "SELECT CERTIFICATE_ID,DESCRIPTION
,MAX(VALUE) TOTAL_COST
,SUM(AMOUNT_FOR_PROJECT) POST_PAID
,MAX(VALUE)-SUM(AMOUNT_FOR_PROJECT) AVAILABLE
,round(((SUM(AMOUNT_FOR_PROJECT)/MAX(VALUE))*100),1) POST_PAID_PCT
,round(100-((SUM(AMOUNT_FOR_PROJECT)/MAX(VALUE))*100),1) AVAILABLE_PCT
from PROJECT_CERTIFICATES
LEFT OUTER JOIN POSTPAY_CERTIFICATES USING (CERTIFICATE_ID) WHERE certificate_id='$randomvalue' GROUP BY CERTIFICATE_ID,DESCRIPTION";
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

<form action="#" class="cmxform">
<fieldset>
<legend>Featured Project</legend>
<ol>
	<li><table border="0">
	<tr><td rowspan="2"><img height="150px" width="150px" src="<? echo $img; ?>"/></td><td><b>Project Title: </b><? echo $title; ?></td></tr>
        <tr><td><b>Duration: From </b><? echo $prostartdate; ?><b> To </b> <? echo $procompdate; ?></td></tr>
        </table></li>

        <li><label for="name"><b>Project partner: </b> <? echo $partner; ?></label></li>
	<li><label for="name"><b>Project Tags: </b><? echo $areatags; ?> | <b>Location: </b> <? echo $location; ?></label></li>

	<li><table border="0">
        <tr><td rowspan="3"><b>Funding status:</b>(in INR)</td><td><b>PostPaid</b><br><? echo $ppostpaid; ?></td><td align="right"><b>Available</b><br><? echo $pavailable; ?></td><td rowspan="3" align="center"><b>Total Value: </b><br><? echo $ptotal_cost; ?></td><td rowspan="3" align="right"><b>See Results</b><br><a href="<? echo $doclink; ?>" target=\"_blank\"><img src="images/doctype_pdf.gif" /></td></tr>
        <tr><td colspan="2"><? echo "<img style=\"vertical-align:middle;\" border=\"0\" src=\"http://chart.apis.google.com/chart?chs=150x15&cht=bhs&chbh=a&chco=00FF00,FF0000&chd=t:$postpaid|$total_cost&chds=0,$total_cost\">"; ?></td></tr>
        <tr><td><? echo $postpaid_pct; ?>%</td><td align="right"><? echo $available_pct; ?>%</td></tr>
        </table></li>

</ol>	
</fieldset>
</form>
<? mysql_close($link); ?>