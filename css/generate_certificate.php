<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);  ?>" method="post">
<p> Generate Certificate for:</p>
<select name="certificate">
<?php
$query = "SELECT POSTPAY_CERTIFICATE_ID, DISPLAYNAME, PAYMENT_DATE
           FROM (SELECT POSTPAY_CERTIFICATE_ID, PAYMENT_ID, DONOR_ID, PAYMENT_DATE
                FROM  POSTPAY_CERTIFICATES LEFT OUTER JOIN PAYMENTS USING (PAYMENT_ID))INFO
                LEFT OUTER JOIN DONORS USING (DONOR_ID)
           ORDER BY  PAYMENT_DATE DESC";

$result = mysql_query($query);

while($row = mysql_fetch_array($result))
{
  echo "<option onclick=\"this.form.submit()\" value=\"".$row['POSTPAY_CERTIFICATE_ID']."\">".$row['PAYMENT_DATE']." ".$row['DISPLAYNAME']."</option>\n  ";
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

$query2 = "SELECT POSTPAY_CERTIFICATE_ID, DONOR_ID, DISPLAYNAME, VILLAGE_TOWN, AMOUNT_FOR_PROJECT, AMOUNT_FOR_OPERATIONS_GRANT
           FROM (SELECT POSTPAY_CERTIFICATE_ID, DONOR_ID, AMOUNT_FOR_PROJECT, AMOUNT_FOR_OPERATIONS_GRANT
                 FROM  POSTPAY_CERTIFICATES
                 WHERE POSTPAY_CERTIFICATE_ID=\"".$selection."\")INFO
                 LEFT OUTER JOIN DONORS USING (DONOR_ID)";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result2 = mysql_query($query2);

while ($row2 = mysql_fetch_assoc($result2)){
      $cert = $row2['POSTPAY_CERTIFICATE_ID'];
      $name = $row2['DISPLAYNAME'];
      $place = $row2['VILLAGE_TOWN'];
      $project_donation = number_format($row2['AMOUNT_FOR_PROJECT'], 0, '.', ',');
      //$project_donation = $row2['AMOUNT_FOR_PROJECT'];
      $uc_donation = number_format($row2['AMOUNT_FOR_OPERATIONS_GRANT'], 0, '.', ',');
      $total_donation = $project_donation + $uc_donation;
      //$uc_donation = $row2['AMOUNT_FOR_OPERATIONS_GRANT'];
      }

echo "This is to acknowledge the receipt of donation from <b>".$name."</b>, from ".$place.", towards results supported by UC in projects providing services to poor communities. Details of the donation are presented below.";
echo "<table width=\"100%\" style='font-size:12px'><tr bgcolor=\"CCCCFF\"><th width=\"7%\">S-No</th><th width=\"33%\">Item</th><th width=\"60%\">Detail</th>";
echo "<tr><td>1</td><td>Certificate ID</td><td>UC-RC-".$cert."</td><tr>";
echo "<tr><td>4</td><td>Donation for Project</td><td>INR. ".$project_donation."</td><tr>";
echo "<tr><td>5</td><td>Donation for UC</td><td>INR. ".$uc_donation."</td><tr>";
echo "<tr><td>6</td><td>Donation for UC</td><td><b>INR. ".$uc_donation."</b></td><tr>";
?>
