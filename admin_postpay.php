<?php 
$activetab="postpayUpdateTab";
$thispage = "donate_waste_app"; 
	require_once('login_auth.php');
	
	if(!$_SESSION['SESS_USER_TYPE'] == 'A') {
		header("Location: login_failed");
	}
?> 
<!DOCTYPE HTML5">
<html lan='en'>
 <head>
  <TITLE>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
	<meta http-equiv="content-type" content="text/ html;charset=utf-8">
	<META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/tabs.css">
	<link rel="stylesheet" type="text/css" href="css/div.css">
	<link rel="stylesheet" href="scripts/jquery-ui.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker_ngo.js"></script>
	<script src="scripts/datepicker.js"></script>
	<script src="scripts/admin_postpay.js"></script>
	<script src="scripts/update_waste.js"></script>
		<script src="scripts/jquery.blockUI.js"></script>		
		<script>
		$j(function(){
			$j(document).ajaxStart($j.blockUI).ajaxStop($j.unblockUI);
			$j("#opp_date").datepicker();
			$j("#instrument_date").datepicker();
		});
	</script>
</head>


<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">
	
		<table style="margin-bottom:40px; width: 100%" id ="mytable">
		<tr>
			<td valign="top">
				<?php include 'adminUcTabs.php'; ?>
			</td>
			<td>
				<div class="right_div"  style=" float:left; width: 100%; overflow: auto;" >
					<table  class="table-request">
						<tbody>
							<th colspan="3" align="left"><h3>Payment Info </h3></th>
							<tr>
								<td align="right">Donor*</td>
								<td>
									<input type = "text" id = "donors_input" class = "donors_input" list="donors_list" name="donors_input">
															<select id = "donors_list">
															</select>
								</td>
							</tr>
							<tr>
								<td align="right">Details</td>
								<td>
									<input type = "text" id = "phone_number" disabled /><input type = "text" id = "email_id" disabled />
									<br>
									<input type = "text" id = "location" disabled /><input type = "text" id = "organization" disabled />
								</td>
							</tr>	
							<tr>
								<td align="right">Date of Donation*</td>
								<td><input  type="text" name="dod" id="opp_date" maxlength="450" cols="40" rows="5"></textarea> </td>
							</tr>
							<tr>
								<td align="right">Amount*</td>
								<td><input type="text" name="Amount" id = "Amount" maxlength="150"> </td>
							</tr>
							<tr>
								<td align="right">Mode of Pay</td>
								<td> 
									<input type="radio" name="onsite_offsite" value="Online" id="mode_pay" ><label for="onsite">Online</label></input>
									<input type="radio" name="onsite_offsite" value="Cheque" id="mode_pay" ><label for="offsite">Cheque</label></input> 
									<input type="radio" name="onsite_offsite" value="Bank Deposit" id="mode_pay" ><label for="offsite"> Bank Deposit</label></input>
									<input type="radio" name="onsite_offsite" value="Cash" id="mode_pay" ><label for="offsite">Cash</label></input>
								</td>
							</tr>
							<tr>
								<td align="right">Instrument No.</td>
								<td><input type="text" name="instrument No" id = "instrument_no" maxlength="150"> </td>
							</tr>
							<tr>
								<td align="right">Instrument Date</td>
								<td><input  type="text" name="Instrument" id="instrument_date" maxlength="450" cols="40" rows="5"> </td>
							</tr>
							<tr>
								<td align="right">Narration</td>
								<td><input type="text" name="norration" id = "instrument_nar" maxlength="150"> </td>
							</tr>
							<tr>
								<td align="right">Balance</td>
								<td><input type = "text" id = "balance" name = "balance" disabled></td>
							</tr>
						</tbody>
					</table>
					
					<table  class="table-request" id="payment_table">
						<tbody id = 'B1'>
							<th colspan="3" align="left"><h3>Certificate Info </h3></th>
							
							<tr>
								<td align="right">Title</td>
								<td>
									<select id = "certificate1" class = "certificate" style = "width: 400px;">
									</select>
								</td>
							</tr>

							<tr>
								<td align="right">Description</td>
								<td>NGO:&nbsp <input type="text" id="ngo1" disabled> Period: &nbsp &nbsp<input type="text" id="period1" style="width: 180px" disabled><br>
								Value: <input type="text" id="value1" value="0" disabled> Balance: <input type="text" id="balance1" value="0" disabled></td>
							</tr> 

							<tr>
								<td align="right">Amount for project</td>
								<td><input type="text" name="Amount for project" class = "Amount_Project" id="Amount_Project1" maxlength="150"> </td>
							</tr>

							<tr>
								<td align="right">Amount for Operation</td>
								<td><input type="text" name="Amount for Operation" class = "Amount_Operation" id="Amount_Operation1" value="0" maxlength="150"> </td>
							</tr>
							<tr>
								<td colspan="2" align="right"><input type="button" name="remove" id = "remove1" class = "remove" value="Remove"  />
							</tr>
						</tbody>
					</table>
					<table class="table-request">
						<tr>
							<td colspan="2" align="center"><input type="button" name="add" id = "add" class = "add" value="Add"  />
								<input type="submit" id = "submit_pay" name="submit"  />
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<!--footer-->
	</div>
	<?php include 'footer.php' ; ?>
	
	</div>
	<!--wrapper end-->

 </body>
</HTML>
