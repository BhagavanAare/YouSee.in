<?php
//include("conn.php");
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$range_result = mysql_query( "SELECT CONVERT(DONOR_ID,SIGNED) DONOR_ID FROM DONORS WHERE FEATURE_PERMISSION='Y' OR FEATURE_PERMISSION='y'");
$random = Array();

while ($row = mysql_fetch_array($range_result, MYSQL_ASSOC)){
	$random[] = $row['DONOR_ID'];
}

$randomvaluekey = array_rand($random,1);
$randomvalue = $random[$randomvaluekey];

$query = "SELECT DONOR_IMG, TYPE_OF_DONOR, DISPLAYNAME, VILLAGE_TOWN, STATE, FEATURE_QUOTE, FIRST_DONATION, DONATION_CNT, PROJ_CNT, TOT_DONATION_MADE
FROM DONORS
JOIN (SELECT DONOR_ID, DATE_FORMAT(MIN( PAYMENT_DATE ),'%d-%b-%Y') FIRST_DONATION, COUNT( * ) DONATION_CNT, COUNT( DISTINCT CERTIFICATE_ID ) PROJ_CNT, SUM( INSTRUMENT_AMOUNT ) TOT_DONATION_MADE
FROM DONORS JOIN POSTPAY_CERTIFICATES USING ( DONOR_ID ) JOIN PAYMENTS USING ( PAYMENT_ID ) WHERE POSTPAY_CERTIFICATES.DONOR_ID = $randomvalue
GROUP BY DONOR_ID
)DONATION_INFO
USING ( DONOR_ID )";

$result = mysql_query($query);
//$num_rows = mysql_num_rows($result);
while ($row = mysql_fetch_assoc($result)) {
		$img = $row['DONOR_IMG'];
		if ($img == ""){
			$img = "css/default_avatar.jpg";
		}
		$name = $row['DISPLAYNAME'];
		$villagetown = $row['VILLAGE_TOWN'];
		$state = $row['STATE'];
		$location = $villagetown.", ".$state;
		$quote = $row['FEATURE_QUOTE'];
		$firstdonation = $row['FIRST_DONATION'];
		$noofdonations = $row['DONATION_CNT'];
		$noofprojects = $row['PROJ_CNT'];
		$donor_type = $row['TYPE_OF_DONOR'];
		}
?>

<form action="#" class="cmxform" style="width:99%">
<fieldset>
<legend>Featured Donor</legend>
<ol>

        <li><table border="0">
        <tr>
        <td> <? echo "<img width=\"150px\" height=\"150px\" border=\"0\" src=\"$img\"/>"; ?></td>
        <td><b>Quote:  </b><? echo $quote; ?></td>
        </tr>
        </table></li>
	<li><label for="title"><b>Name of Donor:  </b><? echo $name; ?></label></li>
	<li><label for="name"><b>Date of first donation: </b><? echo $firstdonation; ?></label></li>
	<li><table border="0">
        <tr>
        <td><b>Number of donations: </b><? echo $noofdonations; ?></td>
        <td><b>, Number of projects donated to: </b> <? echo $noofprojects; ?></td>
        </tr>
        </table></li>
	<li><label for="name"><b>Location of the donor: </b><? echo $location; ?></label></li>
	<li><label for="name"><b>Type of donation: </b> <? echo $donor_type; ?></label></li>
	</ol>
</fieldset>
</form>