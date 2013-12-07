<?php

include("prod_conn.php");
//query for retreving individual certificates within a project
$query = "SELECT
         DATE_FORMAT(PAYMENT_DATE,'%d-%b-%Y') \"Donation Date\",
         DISPLAYNAME \"Donor Name\",
         FORMAT(AMOUNT_FOR_PROJECT+AMOUNT_FOR_OPERATIONS_GRANT,0) \"Total Donation =\",
         FORMAT(AMOUNT_FOR_PROJECT,0) \"Project Donation +\",
         FORMAT(AMOUNT_FOR_OPERATIONS_GRANT,0) \"Donation for UC\",
         VILLAGE_TOWN \"Donor Location\",
         LOCATION \" Project Location\",
         PROJECT_TITLE \"Project\"
         FROM
         (SELECT
         CERTIFICATE_ID,
         PAYMENT_DATE,
         DISPLAYNAME,
         AMOUNT_FOR_PROJECT,
         AMOUNT_FOR_OPERATIONS_GRANT,
         VILLAGE_TOWN
         FROM donors JOIN postpay_certificates USING (donor_id) JOIN payments USING (PAYMENT_ID)
         WHERE donor_id=".$_SESSION['SESS_DONOR_ID']."
         ORDER BY PAYMENT_DATE DESC)INFO
         LEFT OUTER JOIN project_certificates USING (CERTIFICATE_ID) LEFT OUTER JOIN projects USING (PROJECT_ID)";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

 //loop thru the field names to print the correct headers
$i = 0;
echo "<table style='font-size:12px'>";
echo "<thead><tr>";
while ($i < mysql_num_fields($result)){
echo "<th bgcolor=\"CCCCFF\">". mysql_field_name($result, $i) ."</th>";
$i++;
}
echo "</thead></tr>";

//display the data
$i = 1;
while ($rows = mysql_fetch_array($result,MYSQL_ASSOC)){
// variable for coloring oddeven rows
$oddeven = $i & 1;
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}

echo "<tr bgcolor=\"$color\">";
foreach ($rows as $data){echo "<td align=\"right\">".$data ."</td>";}
echo "</tr>";
$i++;
}

echo "</table>";

?>