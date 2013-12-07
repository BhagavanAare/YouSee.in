<?php session_start();
$_SESSION['donate_postpay']="remaining";
?>
<?php $thispage = "uccertificates";
$thisdiv="donations_postpay"; ?>
<!DOCTYPE HTML">
<HTML lan="en">
 	<HEAD>
		<TITLE>Donate PostPay | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="scripts/jquery.min.js"></script>		
		<script src="scripts/donate_postpay.js"></script>
		<script src="scripts/jquery.blockUI.js"></script>		
		<script>
				$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
		</script>
		  <style>
		  label {
		    display: inline-block;
		    width: 5em;
		  }
		  .data:hover{
			-moz-box-shadow: 0 0 3px #666;
			-webkit-box-shadow: 0 0 3px #666;
			box-shadow: 0 0 3px #666;
		}
		  </style>
  	</HEAD>
 	<BODY >
 		
		<!--wrapper begin-->
		<div id="wrapper" >

			<!--header and navbar -->
			<?php include 'header_navbar.php';?>
			<!--maincontentarea begin-->
			<div id="uccertificate-main" >
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
					<p>You can make a 
					<span class="tooltip">
						<a>PostPay
							<span>
								The PostPay funding model, works by prefunding of projects from UC’s corpus, followed by measurement and documentation of outcomes from such projects.Potential donors are then invited to view outcomes from such projects and opt to PostPay for these outcomes, rather than funding them in advance.<br />
							<br />
						<font size=1 color="#367"><b>
						All Donations to United Care Development Services are eligible for Income Tax Benefits under
						section 80G(5)(vi) of the Income Tax Act, 1961, approved through
						F.No.DIT(E)/HYD/80G/54/(09)/10-11, dated 23-Mar-2011.</b></font>
							</span>
						</a>
					</span>
					donation to UC, for the projects listed in this page in the following manner:<br>
					1. Select a project you wish to donate and click on the Donate button to pay through your Credit/Debit Card or<br>
					2. Deposit a Cheque or make an Online Fund Transfer to 
					<span class="tooltip">
						<a>UC Bank Account
						<span>
						<b>Account Name:</b> United Care Development Services
							<br><b>Account Number:</b> 05128940000039
							<br><b>Bank:</b> HDFC Bank
							<br><b>Account Type:</b> Current Account 
							<br><b>Branch Name:</b> Raj Bhavan Road
							<br><b>Location:</b> Hyderabad
							<br><b>IFSC Code:</b> HDFC0000512
							<br><b>MICR CODE:</b> 500240015
						</span>
						</a>
					</span>
					. Do send us a message by email to donate@yousee.in or call us at +91-8008-884422 to let us know as to which project you wish your donation to be credited to<br>
						
					</p>
					
				</div>
				<br><br>
			<!--maincontentarea end-->
			</div>

		<!--footer-->
		<?php include 'footer.php' ;?>
		<!--wrapper end-->

		</div>
 	</BODY>
</HTML>
<?php
/*  Change Log 

11July13 - Vivek - Change in layout, addition of completely postpaid certificates.

*/
?>
