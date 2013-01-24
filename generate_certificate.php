<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);  ?>" method="post">
<p> Generate Certificate for:</p>
<select name="certificate">
<?php
$query = "SELECT POSTPAY_CERTIFICATE_ID, DISPLAYNAME, DATE_FORMAT(PAYMENT_DATE,'%d-%b-%Y') DONATIONDATE
           FROM (SELECT POSTPAY_CERTIFICATE_ID, PAYMENT_ID, DONOR_ID, PAYMENT_DATE
                FROM  POSTPAY_CERTIFICATES LEFT OUTER JOIN PAYMENTS USING (PAYMENT_ID))INFO
                LEFT OUTER JOIN DONORS USING (DONOR_ID)
           ORDER BY  PAYMENT_DATE DESC";

$result = mysql_query($query);

while($row = mysql_fetch_array($result))
{
  echo "<option onclick=\"this.form.submit()\" value=\"".$row['POSTPAY_CERTIFICATE_ID']."\">".$row['DONATIONDATE']." ".$row['DISPLAYNAME']."</option>\n  ";
}
?>
</select>
<input type="submit" value="Select" />
<br>
</form>

<?php
if ( isset($_REQUEST['certificate']) )
{ $selection = $_REQUEST['certificate']; }

//echo "You Selected " . $selection;

$query2 = "SELECT POSTPAY_CERTIFICATE_ID,
                  DONOR_ID, DISPLAYNAME,
                  VILLAGE_TOWN,
                  AMOUNT_FOR_PROJECT,
                  AMOUNT_FOR_OPERATIONS_GRANT,
                  DATE_FORMAT(PAYMENT_DATE,'%d-%b-%Y') DONATIONDATE,
                  MODE_OF_PAYMENT,
                  INSTRUMENT_NO, TITLE,
                  DATE_FORMAT(START_DATE,'%d-%b-%Y') SDATE,
                  DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') EDATE,
                  VALUE
           FROM (SELECT POSTPAY_CERTIFICATE_ID, DONOR_ID,
                 AMOUNT_FOR_PROJECT, AMOUNT_FOR_OPERATIONS_GRANT,
                 PAYMENT_DATE, MODE_OF_PAYMENT,
                 INSTRUMENT_NO,
                 CERTIFICATE_ID
                 FROM  POSTPAY_CERTIFICATES LEFT OUTER JOIN PAYMENTS USING (PAYMENT_ID)
                 WHERE POSTPAY_CERTIFICATE_ID=\"".$selection."\")INFO
                 LEFT OUTER JOIN DONORS USING (DONOR_ID) LEFT OUTER JOIN PROJECT_CERTIFICATES USING (CERTIFICATE_ID)";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result2 = mysql_query($query2);

while ($row2 = mysql_fetch_assoc($result2)){
      $cert = $row2['POSTPAY_CERTIFICATE_ID'];
      $name = $row2['DISPLAYNAME'];
      $place = $row2['VILLAGE_TOWN'];
      $project_donation = number_format($row2['AMOUNT_FOR_PROJECT'], 0, '.', ',');
      $uc_donation = number_format($row2['AMOUNT_FOR_OPERATIONS_GRANT'], 0, '.', ',');
      $total_donation = number_format(($row2['AMOUNT_FOR_PROJECT']+$row2['AMOUNT_FOR_OPERATIONS_GRANT']), 0, '.', ',');
      $date = $row2['DONATIONDATE'];
      $paymentmode = $row2['MODE_OF_PAYMENT'];
      $chequenumber = $row2['INSTRUMENT_NO'];
      $project = $row2['TITLE'];
      $fromdate = $row2['SDATE'];
      $todate = $row2['EDATE'];
      $projectvalue = number_format($row2['VALUE'], 0, '.', ',');

      }

echo "This is to acknowledge the receipt of donation from <b>".$name."</b>, from ".$place.", towards results supported by United Care Development Services(UC) in projects providing services to poor communities. Details of the donation are presented below.";
echo "<table width=\"100%\" style='font-size:12px'><tr bgcolor=\"CCCCFF\"><th width=\"7%\">S-No</th><th width=\"33%\">Item</th><th width=\"60%\">Detail</th>";
echo "<tr><td>1</td><td>Certificate ID</td><td>UC-RC-".$cert."</td><tr>";
echo "<tr><td>2</td><td>Project Supported</td><td>".$project." during ".$fromdate." to ".$todate.". UC spent INR. ".$projectvalue." on this project.</td><tr>";
echo "<tr><td>3</td><td><b>Donation to UC</b></td><td><b>INR. ".$total_donation."</b></td><tr>";
echo "<tr><td>4</td><td><b>Date of Donation</b></td><td><b>".$date."</b></td><tr>";
echo "<tr><td>5</td><td><b>Mode of Payment<b></td><td><b>".$paymentmode." ".$chequenumber."</b></td><tr></table><br>";
echo "Donations to United Care Development Services are eligible for Income Tax Benefits under section 80G(5)(vi) of the Income Tax Act, 1961, approved through F.No.DIT(E)/HYD/80G/54/(09)/10-11, dated 23-Mar-2011.";
?>
