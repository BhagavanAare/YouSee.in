<? $thispage = "uccertificates"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC Project Certificates</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/ajaxtabs.css">
  <SCRIPT type="text/javascript" src="css/ajaxtabs.js"></script>
  </HEAD>
 <BODY>

<!--wrapper-->
<div id="wrapper">

<div id="header"><!--header-->
<img src="uc-logo.jpg" />
</div><!--#header-->

<!--navbar-->
<?php include 'navbar.php' ;?>
<!--#navbar-->

<!--maincontentarea-->
<div id="uccertificate-main">
<br/>
<p>Individuals and Organisations who wish to contribute to one or more of the below result certificates can contribute in part or full for these results. UC Certificates Acquired page gives the list of postpay donations received so far. You take with your postpay donations not only credit for results achieved, but also tax benefits. <b>All donations to UC receive tax benefits under section 80G of the Income Tax Act, 1961</b>.You can transfer your postpay donation to the following Bank Account of UC:</p>
<p><b>Account Name:</b> United Care Development Services, <b>Account Number:</b> 05128940000039, <b>Bank</b>: HDFC Bank, Account Type: Current Account , Branch Name: Raj Bhavan Road, Location: Hyderabad, IFSC Code: HDFC0000512 , MICR CODE: 500240015</p>
<br/>


<?
include("prod_conn.php");

$query = " SELECT PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, NAME, TOTAL_VALUE, TOTAL_POSTPAID, (TOTAL_VALUE-TOTAL_POSTPAID) AVAILABLE
       FROM (SELECT PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID
            FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
                 FROM PROJECT_CERTIFICATES LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID 
                                                           FROM POSTPAY_CERTIFICATES GROUP BY CERTIFICATE_ID)PAID
                 USING (CERTIFICATE_ID)
                 GROUP BY  PROJECT_ID)SUMMARY
            LEFT OUTER JOIN PROJECTS USING (PROJECT_ID))FULL
       LEFT OUTER JOIN PROJECT_PARTNERS USING (PARTNER_ID)
       ORDER BY  AVAILABLE DESC";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$sno = 1;

//Table heading declaration
echo "<table style=\"border: 0px; border-collapse: collapse\"><tr bgcolor=\"CCCCFF\"><th>S-No</th><th>Project Area</th><th>Location</th><th>Project Description</th><th>Project Partner</th><th>Total Value(INR)</th><th align=\"left\">PostPaid(INR)</th><th align=\"right\">Available(INR)</th></tr>";
while ($row = mysql_fetch_assoc($result)) {

                // following section declares variables
                $POSTPAID_PCT = round((($row['TOTAL_POSTPAID']/$row['TOTAL_VALUE'])*100),1);
                $AVAILABLE_PCT = round((100-$POSTPAID_PCT),1);

                // following variables generated for graph api
                $TOTAL_VALUE = $row['TOTAL_VALUE'];
                $TOTAL_POSTPAID = $row['TOTAL_POSTPAID'];

                // following variables generated for number formatting
                $AVAILABLE_F = number_format($row['AVAILABLE'], 0, '.', ',');
                $TOTAL_VALUE_F = number_format($TOTAL_VALUE, 0, '.', ',');
                $TOTAL_POSTPAID_F = number_format($TOTAL_POSTPAID, 0, '.', ',');

                // variable for coloring oddeven rows
                $oddeven = $sno & 1;

                if ($oddeven == 0){$color = "CCCFFF";}
                else {$color = "FFFFFF";}

                //following section post values into a table
                echo "<tr bgcolor=\"$color\"><td rowspan=\"3\">" . $sno . "</td><td rowspan=\"3\">" . $row['PROJECT_AREA'] . "</td><td rowspan=\"3\">" . $row['LOCATION'] . "</td><td rowspan=\"3\">" . $row['PROJECT_DESCRIPTION'] . "</td><td rowspan=\"3\">". $row['NAME'] . "</td><td rowspan=\"3\" align=\"right\">". $TOTAL_VALUE_F . "</td><td align=\"left\">" . $TOTAL_POSTPAID_F . "</td><td align=\"right\">" . $AVAILABLE_F . "</td></tr>";
                echo "<tr bgcolor=\"$color\"><td colspan=\"2\" align=\"center\">" . "<img style=\"vertical-align:middle;\" border=\"0\" src=\"http://chart.apis.google.com/chart?chs=150x15&cht=bhs&chbh=a&chco=00FF00,FF0000&chd=t:$TOTAL_POSTPAID|$TOTAL_VALUE&chds=0,$TOTAL_VALUE\">" . "</td></tr>";
                echo "<tr bgcolor=\"$color\"><td align=\"left\">" . $POSTPAID_PCT . "%" . "</td><td align=\"right\">" . $AVAILABLE_PCT . "%" . "</td></tr>";

                $sno++;
                }
echo "</table>";
?>

</div>
<!--#maincontentarea-->

<!--bottomcontentarea-->
<!-- <div id="content-bottom">
<div align="center">
</div>
</div> -->
<!--#bottomcontentarea-->

<!--footer-->
<? include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>