<?php
//include("conn.php");
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$range_result = mysql_query( "SELECT CONVERT(donor_id,SIGNED) donor_id FROM donors WHERE feature_permission='Y' OR feature_permission='y'");
$random = Array();

while ($row = mysql_fetch_array($range_result, MYSQL_ASSOC)){
	$random[] = $row['donor_id'];
}

$randomvaluekey = array_rand($random,1);
$randomvalue = $random[$randomvaluekey];

$query = "SELECT DONOR_IMG, TYPE_OF_DONOR, DISPLAYNAME, VILLAGE_TOWN, STATE, FEATURE_QUOTE, FIRST_DONATION, DONATION_CNT, PROJ_CNT, TOT_DONATION_MADE
FROM donors
JOIN (SELECT donor_id, DATE_FORMAT(MIN( PAYMENT_DATE ),'%d-%b-%Y') FIRST_DONATION, COUNT( * ) DONATION_CNT, COUNT( DISTINCT CERTIFICATE_ID ) PROJ_CNT, SUM( INSTRUMENT_AMOUNT ) TOT_DONATION_MADE
FROM donors JOIN postpay_certificates USING ( donor_id ) JOIN payments USING ( PAYMENT_ID ) WHERE postpay_certificates.donor_id = $randomvalue
GROUP BY donor_id
)DONATION_INFO
USING ( donor_id )";

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

<!-- display project info in table -->
<table style='width:450px; font-family:arial; font-size:12px;'>
	<tr>
		<td colspan="2" align="center" ><h4 style='border-style:hidden; margin-top:10px; margin-bottom:5px;'>Featured Donor/Volunteer</h4></td>
	</tr>
	<tr>
		<td rowspan="3"><img height="100px" width="100px" src="<?php echo $img; ?>"/></td>
		<td colspan="2"><b>Quote: </b><?php echo $quote; ?></td>
	</tr>
	<tr>
		<td><b>Name: </b><?php echo $name; ?></td>
	</tr>
	<tr>
		<td><b>Location: </b><?php echo $location; ?></td>
	</tr>
</table>
