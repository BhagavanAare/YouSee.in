<?php
if(isset($_POST['month'])){
	if($_POST['month']!=NULL || $_POST['year'] != NULL ) {
	$query = "SELECT
         DATE_FORMAT(PAYMENT_DATE,'%d-%b-%Y') \"Donation Date\",
         DISPLAYNAME \"Donor Name\",
         FORMAT(AMOUNT_FOR_PROJECT+AMOUNT_FOR_OPERATIONS_GRANT,0) \"Donation (in INR)\",
         VILLAGE_TOWN \"Donor Location\",
         LOCATION \" Project Location\",
         PROJECT_TITLE \"Project\",
         name \"Project Partner\"
         FROM
         (SELECT  PAYMENT_DATE, DISPLAYNAME, AMOUNT_FOR_PROJECT, AMOUNT_FOR_OPERATIONS_GRANT, VILLAGE_TOWN, LOCATION, PROJECT_TITLE, partner_id FROM
         (SELECT
         CERTIFICATE_ID,
         PAYMENT_DATE,
         DISPLAYNAME,
         INSTRUMENT_AMOUNT,
         AMOUNT_FOR_PROJECT,
         AMOUNT_FOR_OPERATIONS_GRANT,
         VILLAGE_TOWN
         FROM donors
         JOIN postpay_certificates USING (donor_id)
         JOIN payments USING (PAYMENT_ID)
         ORDER BY PAYMENT_DATE DESC)
		 INFO
         LEFT OUTER JOIN project_certificates USING (CERTIFICATE_ID)
         LEFT OUTER JOIN projects using (PROJECT_ID))FULL
         LEFT OUTER JOIN project_partners USING (partner_id)
		 WHERE MONTH(payment_date)=$_POST[month] AND YEAR(payment_date)=$_POST[year]";
		$totalquery="SELECT FORMAT(SUM(instrument_amount),0) 'sum' FROM payments WHERE MONTH(payment_date)=$_POST[month] AND YEAR(payment_date)=$_POST[year]";
	}
	}
else {
//query for retreving individual certificates within a project
	$query = "SELECT
         DATE_FORMAT(PAYMENT_DATE,'%d-%b-%Y') \"Donation Date\",
         DISPLAYNAME \"Donor Name\",
         FORMAT(AMOUNT_FOR_PROJECT+AMOUNT_FOR_OPERATIONS_GRANT,0) \"Donation (in INR)\",
         VILLAGE_TOWN \"Donor Location\",
         LOCATION \" Project Location\",
         PROJECT_TITLE \"Project\",
         name \"Project Partner\"
         FROM
         (SELECT  PAYMENT_DATE, DISPLAYNAME, AMOUNT_FOR_PROJECT, AMOUNT_FOR_OPERATIONS_GRANT, VILLAGE_TOWN, LOCATION, PROJECT_TITLE, partner_id FROM
         (SELECT
         CERTIFICATE_ID,
         PAYMENT_DATE,
         DISPLAYNAME,
         INSTRUMENT_AMOUNT,
         AMOUNT_FOR_PROJECT,
         AMOUNT_FOR_OPERATIONS_GRANT,
         VILLAGE_TOWN
         FROM donors
         JOIN postpay_certificates USING (donor_id)
         JOIN payments USING (PAYMENT_ID)
         ORDER BY PAYMENT_DATE DESC
         LIMIT 0,100)INFO
         LEFT OUTER JOIN project_certificates USING (CERTIFICATE_ID)
         LEFT OUTER JOIN projects using (PROJECT_ID))FULL
         LEFT OUTER JOIN project_partners USING (partner_id)";
	$totalquery="SELECT FORMAT(SUM(instrument_amount),0) 'sum' FROM (SELECT instrument_amount FROM payments ORDER BY payment_date DESC LIMIT 100)INFO";
}

//connect to host and database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$total=mysql_query($totalquery);

//display output table
include ("display_table.php");
?>