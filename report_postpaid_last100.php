<?php

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
         JOIN POSTPAY_CERTIFICATES USING (donor_id)
         JOIN PAYMENTS USING (PAYMENT_ID)
         ORDER BY PAYMENT_DATE DESC
         LIMIT 0,100)INFO
         LEFT OUTER JOIN PROJECT_CERTIFICATES USING (CERTIFICATE_ID)
         LEFT OUTER JOIN PROJECTS USING (PROJECT_ID))FULL
         LEFT OUTER JOIN project_partners USING (partner_id)";

//connect to host and database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

//display output table
include ("display_table.php");
?>