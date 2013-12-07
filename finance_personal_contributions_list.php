<style>
.scrollbar 
      {
			overflow: auto;
			border: solid 1px #000;
			padding: 5px;
			width: 700px;
			height: 300px;
	  }
</style>
<script type="text/javascript">
		$(function() {
		$( "#fromdate" ).datepicker();
		$( "#todate" ).datepicker();
	});
</script>
<form action="myucFinancialDonations.php" method="post">

<h3 style="margin-left:20px; ">Recent Financial Contributions</h3>
<?php
$vol_contr = "SELECT DATE_FORMAT(payment_date,'%d-%b-%Y') \"Donation Date\",displayname,amount_for_project,amount_for_operations_grant,
		 FORMAT(amount_for_project+amount_for_operations_grant,0) \"Total Donation\",FORMAT(amount_for_project,0) \"Project Donation\",
		 FORMAT(amount_for_operations_grant,0) \"Donation for UC\",village_town,location,project_title,document_link,mode_of_payment,instrument_no,DATE_FORMAT(start_date,'%d-%b-%Y') sdate,DATE_FORMAT(completion_date,'%d-%b-%Y') edate,postpay_certificate_id,FORMAT(value,0) \"Total Value\",name,website_url
		FROM (SELECT certificate_id,displayname,payment_date,instrument_no,mode_of_payment,amount_for_project,amount_for_operations_grant,village_town,postpay_certificate_id
		FROM donors JOIN postpay_certificates USING (donor_id) JOIN payments USING (payment_id)
		WHERE donor_id=".$_SESSION['SESS_DONOR_ID']."
		ORDER BY payment_id DESC)INFO
		LEFT OUTER JOIN project_certificates USING (certificate_id) LEFT OUTER JOIN project_partners USING(partner_id) LEFT OUTER JOIN projects USING (project_id)
	  ORDER BY payment_date desc LIMIT 0,5";
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$vol_contr5 = mysql_query($vol_contr);
if(mysql_num_rows($vol_contr5)>0){
$no = 1;

//Table heading declaration
$i = 1;
echo "<table class=\"scrollbar\" id=\"table-search\" style='font-size:12px'>";
echo "<thead  ><tr>";
echo "<th align=\"middle\">S.No</th>";
	echo "<th align=\"middle\">Donation Date</th>";
	echo "<th align=\"middle\">Project Location</th>";
	echo "<th align=\"middle\">Project Patner</th>";
	echo "<th align=\"middle\">Project (Report) </th>";
	echo "<th align=\"middle\">Donation Amount (INR)</th>"; 
echo "<th align=\"middle\">Contribution Receipt</th></tr>";
	echo "</thead>";	
while ($rows = mysql_fetch_assoc($vol_contr5)) {
		$oddeven = $i & 1;
		if ($oddeven == 0){$color = "#F2F2F2";}
		else {$color = "white";}
		echo "<tr bgcolor=\"$color\">";
		$name = $rows['displayname'];
		$place = $rows['village_town'];
		$title= "<a href=\"".$rows['document_link']."\" target=\"_blank\">".$rows['project_title']."</a>";
		$projectPatner= "<a href=\"".$rows['website_url']."\" target=\"_blank\">".$rows['name']."</a>";
		echo "<td align=\"middle\">" . $no . "</td><td width=\"14%\">" . $rows['Donation Date'] . "</td><td align=\"middle\">" . $rows['location'] . "</td><td align=\"middle\">" . $projectPatner . "</td><td align=\"middle\">" . $title . "</td><td align=\"middle\">" . $rows['Total Donation'] . "</td>";
		$total+=$rows['amount_for_project']+$rows['amount_for_operations_grant'];
		echo "<td><button id=\"printbutton\" value= \"Print Certificate\" onclick=\"printDiv(".$i.")\">Print</button></td>";
		printDoc($rows,$i);
		echo "</tr>";
		$i++;
		$no++;
	}
	echo "</table>";
}
else echo "<p>No financial contributions have been made so far.</p>";
?>
<h3 style="margin-left:20px; ">Financial Donations Report</h3>
<input type="hidden" name="financial" value="financialDonations" />
<table id="table-search">
	<tr>
		<th>From Date</th>
		<th>To Date</th>
	</tr>
	<tr>
		<td style="vertical-align:top;"><input type="text" name="from_date" id="fromdate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("d-M-Y"); ?>'></td>
		<td style="vertical-align:top;"><input type="text" name="to_date" id="todate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("d-M-Y"); ?>'></td>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>
</table>
</form>

<?php
if (isset($_POST['submit']))
	{
		$_POST['from_date']=gmdate("Y-m-d",strtotime($_POST['from_date']));
		$_POST['to_date']=gmdate("Y-m-d",strtotime($_POST['to_date']));
	if($_POST['from_date']==$_POST['to_date']) 
	{
		$dates=date("d M Y", strtotime($_POST['from_date']));
	}
	else 
	{
		$dates= date("d M Y", strtotime($_POST['from_date'])) ." <b>To </b>". date("d M Y", strtotime($_POST['to_date']));
	}
			 
	include_once("prod_conn.php");
	//query for retreving individual certificates within a project
	$query = "SELECT
		 DATE_FORMAT(payment_date,'%d-%b-%Y') \"Donation Date\",
		 displayname,amount_for_project,amount_for_operations_grant,
		 FORMAT(amount_for_project+amount_for_operations_grant,0) \"Total Donation\",
		 FORMAT(amount_for_project,0) \"Project Donation\",
		 FORMAT(amount_for_operations_grant,0) \"Donation for UC\",
		 village_town,
		 location,
		 project_title,
		 document_link,mode_of_payment,instrument_no,
		 DATE_FORMAT(start_date,'%d-%b-%Y') sdate,
         	 DATE_FORMAT(completion_date,'%d-%b-%Y') edate,
		 postpay_certificate_id,
		 FORMAT(value,0) \"Total Value\",
		 name,website_url

         FROM
		 (SELECT
		 certificate_id,displayname,
		 payment_date,instrument_no,mode_of_payment,
		 amount_for_project,
		 amount_for_operations_grant,
		 village_town,postpay_certificate_id
		 FROM donors JOIN postpay_certificates USING (donor_id) JOIN payments USING (payment_id)
		 WHERE payment_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."' AND  donor_id=".$_SESSION['SESS_DONOR_ID']."
		 ORDER BY payment_id DESC)INFO
		 LEFT OUTER JOIN project_certificates USING (certificate_id) LEFT OUTER JOIN project_partners USING(partner_id) LEFT OUTER JOIN projects USING (project_id) ORDER BY payment_date desc";


	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");?>


	<?php
	$result = mysql_query($query);
	$result1=$result;
	if(mysql_num_rows($result)!= 0) 
	{
	$rows;
	$i = 1;
	echo "</br>";
 	echo "<b> Reports From : </b>" . $dates . "</br>";
	echo "</br>";
	echo "<table class=\"scrollbar\" id=\"table-search\" style='font-size:12px'>";
	echo "<thead  ><tr>";
	echo "<th align=\"middle\">S.No</th>";
	echo "<th align=\"middle\">Donation Date</th>";
	echo "<th align=\"middle\">Project Location</th>";
	echo "<th align=\"middle\">Project Patner</th>";
	echo "<th align=\"middle\">Project (Report) </th>";
	echo "<th align=\"middle\">Donation Amount (INR)</th>"; 
	echo "<th align=\"middle\">Contribution Receipt</th></tr>";
	echo "</thead>";	


	//display the data
	$no=1;
	$total=0;;
	while ($rows = mysql_fetch_array($result,MYSQL_ASSOC)){

	//echo $rows;
	// variable for coloring oddeven rows
		$oddeven = $i & 1;
		if ($oddeven == 0){$color = "#F2F2F2";}
		else {$color = "white";}
	
		echo "<tr bgcolor=\"$color\">";
		$name = $rows['displayname'];
		$place = $rows['village_town'];

		$title= "<a href=\"".$rows['document_link']."\" target=\"_blank\">".$rows['project_title']."</a>";
		$projectPatner= "<a href=\"".$rows['website_url']."\" target=\"_blank\">".$rows['name']."</a>";

		echo "<td align=\"middle\">" . $no . "</td><td width=\"14%\">" . $rows['Donation Date'] . "</td><td align=\"middle\">" . $rows['location'] . "</td><td align=\"middle\">" . $projectPatner . "</td><td align=\"middle\">" . $title . "</td><td align=\"middle\">" . $rows['Total Donation'] . "</td>";



		$total+=$rows['amount_for_project']+$rows['amount_for_operations_grant'];

		echo "<td><button id=\"printbutton\" value= \"Print Certificate\" onclick=\"printDiv(".$i.")\">Print</button></td>";
		printDoc($rows,$i);
		echo "</tr>";

		$i++;
		$no++;
	}
	$total=number_format($total);
	echo "<tr><td></td><td></td><td></td><td></td><td style=\"font-weight:bold\" align=\"middle\">Total Donation</td><td align=\"middle\" style=\"font-weight:bold\">$total</td>";

	echo "<td><button id=\"printSummary\" value= \"Print Summary\" onclick=\"printSummary()\">Summary 	Receipt</button></td></tr>";
	printSummary($query);


	echo "</table>";
	}
	else
				{
					echo "<div style=\"margin-top:10px; margin-left:10px;\">No Financial Donations  are there within the given dates</div>";
				}

}

?>
</div>


<?php

function printDoc($rows,$i)
{

      $cert = $rows['postpay_certificate_id'];
      $name = $rows['displayname'];
      $place = $rows['village_town'];
      $project_donation = $rows['Project Donation'];
      $uc_donation = $rows['Donation for UC'];
      $total_donation = $rows['Total Donation'];
      $date = $rows['Donation Date'];
      $paymentmode = $rows['mode_of_payment'];
      $chequenumber = $rows['instrument_no'];
      $project = $rows['project_title'];
      $fromdate = $rows['sdate'];
      $todate = $rows['edate'];
      $projectvalue = $rows['Total Value'];
	 
echo "<td align=\"justify\" style=\"display:none\">";
echo "<table  id=\"certificate".$i."\" style=\"display:none;position:absolute;\" >";
//echo $i;
//echo "<table>";
echo "<tr>";
echo "<td width=\"90%\">";	  



echo "<img style='float:right' src=\"uc-logo.jpg\" alt=\"\" width=\"150\" height=\"120\">";

echo "<h2 style=\"font-family:Arial;font-size:25\"> Receipt of Contribution</h2>";
echo "<style=\"font-family:Arial;font-size:12.4;\"><i>Financing results yousee.in development</i>";

echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";

echo "<style='font-size:14px';'font-family:Arial'>This is to acknowledge the receipt of donation from <b>".$name."</b>, from ".$place.", towards results supported by United Care Development Services(UC) in projects providing services to poor communities. Details of the donation are presented below.";
echo "</br>";
echo "</br>";

echo "<table border=1 cellpadding=\"0\" cellspacing=\"0\" width=\"80%\" style='font-size:15px;' ><tr><th width=\"1%\">S.No</th><th width=\"15%\">Item</th><th width=\"60%\">Detail</th></tr>";
echo "<tr><td>1</td><td>Certificate ID</td><td>UC-RC-".$cert."</td></tr>";
echo "<tr><td>2</td><td>Project Supported</td><td>".$project." during ".$fromdate." to ".$todate.". UC spent INR. ".$projectvalue." on this project.</td></tr>";
echo "<tr><td>3</td><td><b>Donation to UC</b></td><td><b>INR. ".$total_donation."</b></td></tr>";
echo "<tr><td>4</td><td><b>Date of Donation</b></td><td><b>".$date."</b></td></tr>";
echo "<tr><td>5</td><td><b>Mode of Payment<b></td><td><b>".$paymentmode." ".$chequenumber."</b></td></tr></table></br>";
echo "<table width=\"97%\"><tr><td><style=\"font-family:Arial;font-size:18.4;\"><b>Donations to United Care Development Services are eligible for Income Tax Benefits under section 80G(5)(vi) of the Income Tax Act, 1961, approved through F.No.DIT(E)/HYD/80G/54/(09)/10-11, dated 23-Mar-2011.</b></td></tr></table>";

echo "</br>";
echo "</br>";
echo "The Permanent Account Number (PAN) of United Care Development Services  with Income Tax Department is AABCU1456C.
";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";

echo "<style=\"font-family:Arial;font-size:12.4\">P.S.Gunaranjan";
echo "</br>";
echo "</br>";
echo "<style=\"font-family:Arial;font-size:12.4\">Founder-Director, United Care Development Services";
echo "</br>";
echo "</br>";
echo "<style=\"font-family:Arial;font-size:12.4\"><b>Contact:</b> Mobile: +91-8008-884422 ; E-mail: contact@yousee.in ; Website: www.yousee.in";
echo "</br>";
echo "</br>";
echo "<style=\"font-family:Arial;font-size:12.4\">Registered Office: 9/29, Prashanth Nagar, Boduppal Road, Uppal, Hyderabad-500039";
echo "</br>";
echo "</br>";
echo "</td></tr>";
//echo "</table>";


//echo "</div>";
echo "</table>";
echo "</td>";
//echo "<script>printDiv();</script>";
}

function printSummary($query1)
{


     
      global $name,$place;
    
     
      $fdate = date("d-M-Y",strtotime($_POST['from_date']));
      $tdate = date("d-M-Y",strtotime($_POST['to_date']));
	  

echo "<td align=\"justify\">";
echo "<table  id=\"summary\" style=\"display:none;position:absolute;\" >";
//echo $i;
//echo "<table>";
echo "<tr>";
echo "<td width=\"90%\">";	  


echo "<img style='float:right' src=\"uc-logo.jpg\" alt=\"\" width=\"150\" height=\"120\">";

echo "<h2 style=\"font-family:Arial;font-size:25\"> Receipt of Contribution</h2>";
echo "<style=\"font-family:Arial;font-size:12.4;\"><i>Financing results yousee.in development</i>";

echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";

echo "<style='font-size:14px';'font-family:Arial'>This is to acknowledge the receipt of donation from <b>".$name."</b>, from ".$place.", towards results supported by United Care Development Services(UC) in projects providing services to poor communities from  ".$fdate." to ".$tdate.".<br/> Details of the donation are presented below.";
echo "</br>";
echo "</br>";

$i = 1;
echo "<table  border=1 cellpadding=\"0\" cellspacing=\"0\" width=\"80%\" style='font-size:15px;'>";
echo "<thead  ><tr>";
echo "<th align=\"middle\">S.No</th>";
echo "<th align=\"middle\">Donation Date</th>";
echo "<th align=\"middle\">Project Location</th>";
echo "<th align=\"middle\">Project Patner</th>";
echo "<th align=\"middle\">Project  </th>";
echo "<th align=\"middle\">Donation Amount (INR)</th>"; 
echo "</thead>";


	$result1 = mysql_query($query1);


//display the data
$no=1;
$total=0;
$count=mysql_num_rows($result1);
//echo $count;
//if(mysql_num_rows($result1)!= 0) 
//{
//echo $result;
while ($count>0){
//echo "asfdfdsafads";
$rows1 = mysql_fetch_array($result1,MYSQL_ASSOC);

// variable for coloring oddeven rows
	
//echo "adssss";	
	echo "<tr>";

//echo $rows1['Donation Date'];
echo "<td align=\"middle\">" . $no . "</td><td width=\"14%\">" . $rows1['Donation Date'] . "</td><td align=\"middle\">" . $rows1['location'] . "</td><td align=\"middle\">" .$rows1['name'] . "</td><td align=\"middle\">" . $rows1['project_title'] . "</td><td align=\"middle\">" . $rows1['Total Donation'] . "</td>";


$total+=$rows1['amount_for_project']+$rows1['amount_for_operations_grant'];

echo "</tr>";

$i++;
$no++;
$count--;
}

$total=number_format($total);

echo "<tr><td></td><td></td><td></td><td></td><td style=\"font-weight:bold\" align=\"middle\">Total Donation</td><td align=\"middle\" style=\"font-weight:bold\" >$total</td>";



echo "</table>";


echo "</br>";
echo "</br>";
echo "<table width=\"97%\"><tr><td><style=\"font-family:Arial;font-size:18.4;\"><b>Donations to United Care Development Services are eligible for Income Tax Benefits under section 80G(5)(vi) of the Income Tax Act, 1961, approved through F.No.DIT(E)/HYD/80G/54/(09)/10-11, dated 23-Mar-2011.</b></td></tr></table>";
echo "</br>";
echo "</br>";
echo "The Permanent Account Number (PAN) of United Care Development Services  with Income Tax Department is AABCU1456C.
";
echo "</br>";
echo "</br>";

echo "<style=\"font-family:Arial;font-size:12.4\">P.S.Gunaranjan";
echo "</br>";
echo "</br>";
echo "<style=\"font-family:Arial;font-size:12.4\">Founder-Director, United Care Development Services";
echo "</br>";
echo "</br>";
echo "<style=\"font-family:Arial;font-size:12.4\"><b>Contact:</b> Mobile: +91-8008-884422 ; E-mail: contact@yousee.in ; Website: www.yousee.in";
echo "</br>";
echo "</br>";
echo "<style=\"font-family:Arial;font-size:12.4\">Registered Office: 9/29, Prashanth Nagar, Boduppal Road, Uppal, Hyderabad-500039";
echo "</br>";
echo "</br>";
echo "</td></tr>";
//echo "</table>";


//echo "</div>";
echo "</table>";
echo "</td>";
//echo "<script>printDiv();</script>";
}
?>
<?php
/*function makecomma($input)
{
    // This function is written by some anonymous person - I got it from Google
    if(strlen($input)<=2)
    { return $input; }
    $length=substr($input,0,strlen($input)-2);
    $formatted_input = makecomma($length).",".substr($input,-2);
    return $formatted_input;
}
function formatInIndianStyle($num){
    // This is my function
    $pos = strpos((string)$num, ".");
    if ($pos === false) { $decimalpart="00";}
    else { $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos); }

    if(strlen($num)>3 & strlen($num) <= 12){
                $last3digits = substr($num, -3 );
                $numexceptlastdigits = substr($num, 0, -3 );
                $formatted = makecomma($numexceptlastdigits);
                $stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;
    }elseif(strlen($num)<=3){
                $stringtoreturn = $num.".".$decimalpart ;
    }elseif(strlen($num)>12){
                $stringtoreturn = number_format($num, 2);
    }

    if(substr($stringtoreturn,0,2)=="-,"){$stringtoreturn = "-".substr($stringtoreturn,2 );}

    return $stringtoreturn;
}
*/
?>


<script language="javascript">
function printDiv(i)
{

var content = document.getElementById("certificate"+i);
var pri = document.getElementById("ifmcontentstoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>
<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>
<script>
function printSummary()
{

var content = document.getElementById("summary");
var pri = document.getElementById("ifmsummarytoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>
<iframe id="ifmsummarytoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>
<?php
/* Change log

02-Jun-2013 - Vivek - Order by clause added to sort the certificates.

*/
?>	
