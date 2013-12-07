<?

include("prod_conn.php");
//query for retreving individual certificates within a project
$query = "SELECT 
         PROJECT_ID AS PROJ_ID,
         PROJECT_TITLE,
         CERTIFICATE_ID AS PH_ID,
         FORMAT(VALUE,0) PH_FUND,
         FORMAT(SUM(AMOUNT_FOR_PROJECT+AMOUNT_FOR_OPERATIONS_GRANT),0) TOT_DONATION,
         FORMAT(SUM(AMOUNT_FOR_PROJECT),0) PROJ_DONATION,
         FORMAT(SUM(AMOUNT_FOR_OPERATIONS_GRANT),0) UC_DONATION,
         CONCAT(FORMAT(SUM(AMOUNT_FOR_PROJECT)/VALUE*100,0),'%') PP_PCT,
         COUNT(DONOR_ID) NUM_DONATIONS,
         COUNT(DISTINCT DONOR_ID) NUM_DONORS,
         DATE_FORMAT(START_DATE,'%d-%b-%Y') PH_SDATE,
         DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') PH_EDATE,
         DATEDIFF(COMPLETION_DATE,START_DATE)+1 PH_DAYS,
         DATEDIFF(MIN(PAYMENT_DATE),COMPLETION_DATE) PAY_SDAYS,
         DATE_FORMAT(MIN(PAYMENT_DATE),'%d-%b-%Y') FIRSTPAY,
         DATE_FORMAT(MAX(PAYMENT_DATE),'%d-%b-%Y') LASTPAY,
         DATEDIFF(MAX(PAYMENT_DATE),MIN(PAYMENT_DATE))+1 PAYDAYS
         FROM PROJECTS JOIN PROJECT_CERTIFICATES USING (PROJECT_ID) JOIN POSTPAY_CERTIFICATES USING (CERTIFICATE_ID) JOIN PAYMENTS USING (PAYMENT_ID)
         GROUP BY CERTIFICATE_ID
         ORDER BY PP_PCT ASC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

 //loop thru the field names to print the correct headers
$i = 0;
echo "Report on TurnAroundTime of PostPay of UC project(phasewise) certificates.";
echo "<table style='font-size:12px'>";
echo "<thead><tr>";
while ($i < mysql_num_fields($result)){
echo "<th bgcolor=\"CCCCFF\">". mysql_field_name($result, $i) . "</th>";
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