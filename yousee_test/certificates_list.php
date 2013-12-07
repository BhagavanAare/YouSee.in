<?php

include("prod_conn.php");

$query2 = "SELECT CERTIFICATE_ID, START_DATE, COMPLETION_DATE, VALUE, POSTPAID
        FROM PROJECT_CERTIFICATES LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
                                                  FROM POSTPAY_CERTIFICATES GROUP BY CERTIFICATE_ID)PAID
        USING (CERTIFICATE_ID)";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result2 = mysql_query($query2);

$ino = 1;
echo "<table>";
while ($row2 = mysql_fetch_assoc($result2)) {
echo "<tr><td>" . $ino . "</td><td>" . $row2['START_DATE'] . " to " . $row2['COMPLETION_DATE'] . "<td>" . $row2['VALUE'] . "</td><td>" . "Document" . "</td></tr>";
$ino++; }
echo "</table>";
?>

