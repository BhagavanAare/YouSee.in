<?php require_once('login_auth.php');?>
<?php $thispage = "donation_summary"; 

if (!$_SESSION['SESS_USER_TYPE']=="N")
{
	header(header("Location: login_failed"));
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="test/test.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
  <link rel="stylesheet" href="scripts/jquery-ui.css">
	<link rel="stylesheet" href="css/table.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
	<script src="scripts/jquery.timeentry.min.js"></script>
	<script src="scripts/jquery.mousewheel.js"></script>
	<script type="text/javascript">
		$(function() {
		$( "#opp_date" ).datepicker();
		$( "#opp_date2" ).datepicker();
		$( "#opp_date4" ).datepicker();
		$( "#opp_fromdate" ).datepicker();
		$( "#opp_todate" ).datepicker();
		$( "#opp_fromtime" ).timeEntry();
		$( "#opp_totime" ).timeEntry();
		$( "#opp_fromtime2" ).timeEntry();
		$( "#opp_totime2" ).timeEntry();
		$( "#opp_fromtime3" ).timeEntry();
		$( "#opp_totime3" ).timeEntry();
		$( "#opp_fromtime4" ).timeEntry();
		$( "#opp_totime4" ).timeEntry();
		
		$("#yes").click(function() {
			$("#schedule_type").show();
			$("#schedule_weekly").hide();
			$("#schedule_daily").hide();
			$("#schedule_random").hide();
			$("#schedule_nondate").hide();
			$(".schedule_nondate").val("");
		});
		$("#no").click(function() {
			$("#schedule_weekly").hide();
			$("#schedule_daily").hide();
			$("#schedule_random").hide();
			$("#schedule_type").hide();
			$("#schedule_nondate").show();	
			$(".schedule_type").prop('checked', false);;
		});
		$("#daily").click(function() {
			$("#schedule_weekly").hide();
			$("#schedule_daily").show();
			$("#schedule_random").hide();
			$(".schedule_weekly,.schedule_random").val("");
			$(".schedule_weekly").prop('checked',false);
		});
		$("#weekly").click(function() {
			$("#schedule_weekly").show();
			$("#schedule_daily").hide();
			$("#schedule_random").hide();
			$(".schedule_daily,.schedule_random").val("");
		});
		$("#random").click(function() {
			$("#schedule_weekly").hide();
			$("#schedule_daily").hide();
			$("#schedule_random").show();
			$(".schedule_weekly,.schedule_daily").val("");
			$(".schedule_weekly").prop('checked',false);
		});
	});
	</script>
	
  
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->
<table>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<ul  class="tree" >  
	<li class="tree">
		<label for="folder1" class="menu_first">+ Donations Received</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>

			<li class="tabLink"><a href="donation_summary.php" class="file" id="summaryTab">Summary</a></li>								
			<li class="tabLink"><a class="file" id="volunteerHoursTab" onclick="showTab('ngoTabs','volunteerHoursTab')" >Volunteering </a></li>					
			<li class="tabLink"><a class="file" id="inKindTab">In Kind</a></li>					
			<li class="tabLink"><a class="file" id="financialTab" onclick="showTab('ngoTabs','financialTab')" >Financial </a></li> 

			
		</ul>
	</li>
	<li class="tree">
		<label for="folder1" class="menu_first"> Make Requests</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>
			
			<li><a href="req_volunteering.php" class="file" id="volunteerReqTab">Volunteering </a></li>					
			<li class="tabLink"><a class="file" id="inKindReqTab">In Kind Donations </a></li> 

			
		</ul>
	</li>
	<li class="tree">
		<label for="folder1" class="menu_first">> Update</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>
			<li class="tabLink"><a  class="file" id="orgTabTab">Org Info</a></li>					
			<li class="tabLink"><a  class="file" id="settingsTab">Settings</a></li>					

			
		</ul>
	</li>
</ul>
</div>
</td>
<td>
<table cellpadding="3%"  width="600px" border="0">
<?php include 'reportNgoFinancialDonations.php';?>

</table>
<!--footer-->

<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
