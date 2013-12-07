<?php session_start(); 
$_SESSION['donate_postpay']="paid";
?>
<?php $thispage = "uccertificates";
$thisdiv="donations_postpaid"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script type="text/javascript" src="scripts/jquery.min.js"></script>
  <script type="text/javascript" src="scripts/donate_postpay.js"></script>
 </HEAD>
 <BODY>

	<!--wrapper-->
	<div id="wrapper">

	<!--header and navbar -->
	<?php include 'header_navbar.php';?>

	<!--maincontentarea-->
		<div id="uccertificate-main">
			<div id="options" style="display: inline-block; float: left; width: 15%; height: auto; padding: 10px; background: white;">
								<?php include "donate_postpay_leftnav.php"; ?>
					<p style="display: inline-block; float: left; width: 100%; height: auto; font-size: 18px; font-weight: bold; text-align: center; margin-top: 0; margin-bottom: 0; padding-top: 0;" >Options <font style="cursor:pointer;float:right;font-weight:normal;font-size:12px;color:#369;" class="clear_filters" hidden>Clear Filters</font></p>
					<div id="area" style="background: white;display: inline-block; width: 100%; padding: 10px; margin-top: 10px; ">
						<b>AREA</b> <br>
					</div>

					<div id="city" style="background: white; display: inline-block; width: 100%; padding: 10px; margin-top: 10px;">
						<b>LOCATION</b><br>
					</div>

					<div id="npo" style="background: white;display: inline-block; width: 100%; padding: 10px; margin-top: 10px;">
						<b>NPO</b><br>
					</div>
			</div>

			<div id="data" style="display: inline-block; width: 78%; height: auto; padding: 12px; margin-left: 24px; border: 0; border-left: 1px solid lightgrey;">
			<h3>Postpaid projects<h3>
			</div>
		</div>
	</div>
</body>
</html>