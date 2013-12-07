<?php 
$activetab="wasteUpdateTab";
$thispage = "donate_waste_app"; 
	require_once('login_auth.php');
	
	if(!$_SESSION['SESS_USER_TYPE'] == 'A') {
		header("Location: login_failed");
	}
?> 

<!DOCTYPE html>
<html lan = "en">
<head>
	<title>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</title>
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
	<script src="scripts/update_waste.js"></script>
</head>

<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">
		
		<table style="margin-bottom:40px;" id ="mytable">
			<tr>
				<td valign="top">
					<?php include 'adminUcTabs.php'; ?>

				</td>
				
</td>
				<td>
					<table class="table-request">
						<th colspan="3" align="left"><h3>Donate Waste Update </h3></th>
						<tr>
							<td align="right" >Donor</td>
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
							<td align="right">Date of Donation</td>
							<td><input  type="text" name="opp_date" id="opp_date" maxlength="450" cols="40" rows="5"></textarea> </td>
						</tr>
						<tr>
							<td align="right">Place of Donation</td>
							<td><input type="text" name="placeofdonation" id="placeofdonation" maxlength="150"> </td>
						</tr>
						<tr>
							<td align="right">City</td>
							<td>
								<select name="city" id="city">
									<option value="" selected="selected">---SELECT---</option>
									<option value="Hyderabad">Hyderabad</option>
									<option value="Bangalore">Bangalore</option>
									<option value="Bhopal">Bhopal</option>
									<option value="Indore">Indore</option>
								</select>
							</td>
						</tr>
					</table>
					
			
					<table id="dataTable" class="table-request">
						<th colspan="8" align="left"><h3>Donate Waste Details</h3></th>							
						<tr>
							<th>Category</th>
							<th>Item</th>
							<th>Units</th>
							<th>Quantity</th>
							<th>Unit value (₹)</th>
							<th>Calculated Value (₹)</th>
							<th>Actual Value (₹)</th>
							<td colspan="2">
								<input type="button" value="Add" onclick="addRow('dataTable')" />
							</td>			
						</tr>
						
						<tr id = "R1">
							<td>
								<select id = "c1" class = "category" name = "c1">
									<option value="SELECT" selected = "selected">--SELECT--</option>								
								</select>
							</td>
							
							<td>
								<select id="i1"  class = "item" name="i1" style="min-width: 150px; max-width: 150px;" />
									<option value="SELECT" selected="selected">--SELECT--</option>
								</select>
							</td>
							
							<td>
								<select name="u1" id = 'u1'>
									<option value="" selected="selected">--SELECT--</option>
									<option value="1">Kilograms</option>
									<option value="2">Count</option>						
								</select>
							</td>
							
							<td align="center">
								<input type="text"  name="q1" id="q1" class = "q" size="4"/>
							</td>
							
							<td align="center">
								<input type="text"  name="unit_val1" id="unit_val1" class = "unit_val" size="4" />
							</td>
							
							<td>
								<input  type="text"  name="cal_val1" id="cal_val1" class = "cal8_val" size="4" disabled />
							</td>
							
							<td>
								<input  type="text"  name="actual_value1" id="actual_value1" class = "actual_value" size="4"/>
							</td>
							
							<td>
								<input type="button" id = "d1" class = "deleteRow" value="Remove" />  
							</td>							
						</tr>
					</table>	
					<table id="dataTable" class="table-request">
						<tr>
							<td colspan="2">
								<input type="submit" style="width:200px;height:30px;" onClick = "submitDonation()" name = "submitDonation" value="Submit" />
							</td>
							<td >Total Calculated Value: </td>
							<td>
								<input type="text" style="width:60px;" id="totalCalculated" value = "0" disabled />
							</td>
							<td colspan="3">Total Actual Value:</td>
							<td>
								<input type="text" style="width:60px;" id="totalActual" value = "0" disabled />
							</td>
						</tr>
					</table>	
				</td>
			</tr>
		</table>
			</div>
		<!--footer-->
		<?php include 'footer.php' ; ?>
	
	</div>
	<!--wrapper end-->
	
</body>
</html>


