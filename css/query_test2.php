<?

include("prod_conn.php");
//query for retreving individual certificates within a project
$query = "SELECT CERTIFICATE_ID, COUNT(DONOR_ID) NUM_DONATIONS, COUNT(DISTINCT DONOR_ID) NUM_DONORS, MAX(PAYMENT_DATE) FIRSTPAY, MIN(PAYMENT_DATE) LASTPAY
          FROM POSTPAY_CERTIFICATES JOIN PAYMENTS
          GROUP BY CERTIFICATE_ID";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

 //loop thru the field names to print the correct headers
$i = 0;
echo "<thead><tr>";
while ($i < mysql_num_fields($result)){
echo "<th scope=\"col\">". mysql_field_name($result, $i) . "</th>";
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
foreach ($rows as $data){echo "<td>".$data ."</td>";}
echo "</tr>";
$i++;

}
echo "</table>";

?>