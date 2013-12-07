<?php
			include "prod_conn.php";
			$txnResult = isset($_GET['ResResult']) ? $_GET['ResResult'] : '';
			$txnTrackID= isset($_GET['ResTrackId']) ? $_GET['ResTrackId'] : ''; //Merchant track ID
			$txnPaymentID = isset($_GET['ResPaymentId']) ? $_GET['ResPaymentId'] : '';
			$txnRef= isset($_GET['ResRef']) ? $_GET['ResRef'] : '';
			$txnTranID = isset($_GET['ResTranId']) ? $_GET['ResTranId'] : '';
			$txnAmount= isset($_GET['ResAmount']) ? $_GET['ResAmount'] : '';
			$txnError = isset($_GET['ResError']) ? $_GET['ResError'] : '';
			$query="SELECT TRANSACTION_ID, GATEWAY_RESPONSE, DONATION_AMT,sess_id FROM ONLINE_PAYMENTS WHERE TRANSACTION_ID='".$txnTrackID."'";
			$db_open = mysql_connect("$dbhost", "$dbuser", "$dbpass");
			$db = mysql_select_db("$dbdatabase");
			$result = mysql_query($query) or die (mysql_error());
			while ($row = mysql_fetch_assoc($result)) 
			{
				session_id($row['sess_id']);
				session_start();
				$TRANSIND=$row['TRANSACTION_ID'];
				$TRANS_STATUS=$row['GATEWAY_RESPONSE'];
				$DONATION_AMT=$row['DONATION_AMT'];
			}			
			$txnResult = $TRANS_STATUS;
			$txnAmount = $DONATION_AMT;
			
				$keys=explode("-",$_SESSION['keys']);
				$values=explode("-",$_SESSION['values']);
				$total_amt=$_SESSION['total_amt'];
					$query="INSERT INTO payments (payment_date,mode_of_payment,instrument_amount) VALUES ('".date("Y-m-d")."','Payment Gateway','$total_amt')";
					mysql_query($query);
					$payment_id=mysql_insert_id();
					$update=mysql_query("UPDATE online_payments SET payment_id=$payment_id WHERE transaction_id=$TRANSIND");
				for($i=0;$i<count($values);$i++){
					$query2="INSERT INTO postpay_certificates (payment_id,certificate_id,donor_id,amount_for_project,amount_for_operations_grant) VALUES ($payment_id, $keys[$i],$_SESSION[SESS_DONOR_ID],$values[$i],'0')";
					mysql_query($query2);
				}

$thispage="uccertificates"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head >
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<!--wrapper-->
<div id="wrapper">

<!--navbar-->
<?php include 'header_navbar.php' ;?>
<!--#navbar-->

<!--maincontentarea-->
<div id="content-main"> 
<center>
<br /><h3> Transaction Response </h3>	</center>

<p align="center">Please quote the following transaction reference number for any queries relating to this request.</p>
<?php 
$table="
			<table align='center'  id='table-search'>
			<tr>	
				<th colspan='50'>Final Response</th>
			</tr>
			<tr>
				<td colspan='35'>Transaction Status</td>				
				<td>$txnResult</td>				
			</tr>
			
			<tr>
				<td colspan='35'>Merchant Reference No:[TRACK_ID]</td>				
				<td>$txnTrackID</td>				
			</tr>
			<tr>
				<td colspan='35'>Transaction PaymentID</td>				
				<td>$txnPaymentID</td>				
			</tr>
						
			<tr>
				<td colspan='35'>Transaction Reference No</td>				
				<td>$txnRef</td>				
			</tr>
			
			<tr>
				<td colspan='35'>Transaction ID</td>				
				<td>$txnTranID</td>				
			</tr>
			<tr>
				<td colspan='35'>Transaction Amount</td>				
				<td>$txnAmount</td>				
			</tr>
			
			<tr>
				<td colspan='35'>Transaction Error</td>				
				<td>$txnError </td>				
			</tr>
					
			</table>";
		echo $table;
		?>
			
		<?php
		if($TRANS_STATUS=="PAYMENT SUCCESSFUL"){
		$a=explode("-",$_SESSION['keys']);
			$donorresult=mysql_query("SELECT displayname,preferred_email from donors WHERE donor_id=".$_SESSION['SESS_DONOR_ID']);
			$donor=mysql_fetch_array($donorresult);
			$projectresult=mysql_query("SELECT title from project_certificates WHERE certificate_id=$a[0] GROUP BY project_id");
			$project=mysql_fetch_array($projectresult);
						$params=
						array(
						$email="gunaranjan@gmail.com",
						$subject="Acknowledgement of Donation",
						$displayname=$donor['displayname'],
						$mailtext="Donor Email : $donor[preferred_email]<br />Thank you for your donation of Rs.$txnAmount towards the project $project[title] , made on ".date("Y-m-d").". We welcome you to login into your account on UC site www.yousee.in, to download on print the Receipt of Contributions at your convenience. You may submit the downloaded receipts for claiming of tax benefits under section 80G of Income Tax Act.You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />".$table,
						);
						call_user_func_array('sendEmail',$params);
			unset($_SESSION['total_amt']);
			unset($_SESSION['keys']);
			unset($_SESSION['values']);
		}
		?>
			
<br /><br /><br />			
</div>
<?php 
include "footer.php";
include "Email/sendemail.php";
?>
</div>			
</body>
</html>