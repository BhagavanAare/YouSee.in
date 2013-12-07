<?php 
session_start();
$thispage="myuc";
$activetab="docSchedule";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
   
  <TITLE>Add schedule | People's Doctor</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/div.css">
  <link rel="stylesheet" href="scripts/jquery-ui.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker_ngo.js"></script>
	<script type="text/javascript" src="scripts/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>	
<script type="text/javascript">
		$(function() {
			$(".Date").datepicker();
			$(".Time").timeEntry();
		});   
</script>

	<script type="text/javascript">
		$(function() {
		var count=1;

		$("#yes").click(function() {
			$("#schedule_type").show();
			$("#schedule_weekly").hide();
			$("#schedule_daily").hide();
			$("#schedule_random").hide();
			$("#schedule_nondate").hide();
			$(".schedule_nondate").val("");
			$("#schedule_type input[type='radio']").prop('required',true);
			$("#schedule_nondate input[type='text']").prop('required',false);

		});
		$("#no").click(function() {
			$("#schedule_weekly").hide();
			$("#schedule_daily").hide();
			$("#schedule_random").hide();
			$("#schedule_type").hide();
			$("#schedule_nondate").show();	
			$(".schedule_type").prop('checked', false);
			$("#schedule_type input[type='radio']").prop('required',false);
			$("#schedule_nondate input[type='text']").prop('required',true);

		});
		$("#daily").click(function() {
			$("#schedule_weekly").hide();
			$("#schedule_daily").show();
			$("#schedule_random").hide();
			$(".schedule_weekly,.schedule_random,.schedule_random_ft,.schedule_random_tt").val("");
			$(".schedule_weekly").prop('checked',false);
			$("#schedule_daily input").prop('required',true);
			$("#schedule_weekly input").prop('required',false);
			$("#schedule_random input").prop('required',false);

		});
		$("#weekly").click(function() {
			$("#schedule_weekly").show();
			$("#schedule_daily").hide();
			$("#schedule_random").hide();
			$(".schedule_daily,.schedule_random,.schedule_random_ft,.schedule_random_tt").val("");
			$("#schedule_weekly input").prop('required',true);
		
			$("#schedule_daily input").prop('required',false);
			$("#schedule_random input").prop('required',false);
		});
			$(".schedule_weekly").each(function(){
				$(this).click(function(){
					if($(this).is(':checked')){
						$(".schedule_weekly").prop('required',false);
					}
					else{
						$(".schedule_weekly").prop('required',true);
					}

				});
			});
		$("#random").click(function() {
			$("#schedule_weekly").hide();
			$("#schedule_daily").hide();
			$("#schedule_random").show();
			$(".schedule_weekly,.schedule_daily").val("");
			$(".schedule_weekly").prop('checked',false);
			$("#schedule_random input").prop('required',true);
			$("#schedule_daily input").prop('required',false);
			$("#schedule_weekly input").prop('required',false);

		});
		$("#addbutton").click(function(){
			var newrow="<tr id='row"+count+"'>";
			newrow+="<td align='center' ><input type='text' class='Date' size='10' name='opp_date[]' required /></td>";
			newrow+="<td align='center' ><input type='text' class='Time' size='7' name='opp_fromtime[]' required /></td>";
			newrow+="<td align='center' ><input type='text' class='Time' size='7' name='opp_totime[]' required /></td>";
			newrow+="<td align='center'><input type='button' value='X' onclick='$(\"#row"+count+"\").remove();' /></td>";
			newrow+="</tr>";
			$("#schedule_random_body").append(newrow);
			$(".Date").datepicker();
			$(".Time").timeEntry();
			count++;
			
		});
			

	});
	</script>
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper">
<?php include "header_navbar.php";?>
<!--header and navbar -->
<div id="content-main">
<!--maincontentarea begin-->

<table style="margin-bottom:40px;">
<tr>
<td valign="top">
	<?php include "myucTabs.php";?>
</td>
<td>
	<form name="requestForm" method="post" onsubmit="return validateForm()">
	<table  class="table-request">
	<th colspan="2" align="left"><h3>Create/Edit Schedule Request</h3></th>
	<tr>
	<td align="right">Clinic Description</td>
	<td> <textarea name="description" id="consultdetails" maxlength="450" cols="40" rows="5" required></textarea> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Location</td>
	<td><input type="text" name="location" required /></td>
	</tr>
	<tr>
	<td align="right">City</td>
	<td><select name="city">
	<option value="">Select City</option>
	<?php 
	include_once "prod_conn.php";
	$cityquery="SELECT city,city_id from city";
	$cityresult=mysql_query($cityquery);
	while($city=mysql_fetch_array($cityresult)){
		echo "<option value='$city[city_id]'>$city[city]</option>";
	}
	?>
	</select></td>
	</tr>
	<tr>
	<td align="right">Date Specific? *</td>
	<td><input type="radio" name="date_specific" value="1" id="yes" required ><label for="yes">Yes</label></input>
	     <input type="radio" name="date_specific" value="0" id="no" required ><label for="no">No</label></input> </td>
	</td>
	</tr>
	<tr id="schedule_type" hidden>
	<td align="right">Schedule Type</td>
	<td><input type="radio" class="schedule_type" name="schedule_type" value="daily" id="daily" ><label for="daily">Daily</label>
	<input type="radio" class="schedule_type" name="schedule_type" value="weekly" id="weekly"  /><label for="weekly">Weekly</label>
	<input type="radio" class="schedule_type" name="schedule_type" value="random" id="random" /><label for="random">Random</label>
	</td>
	</tr><tr>
	<table id="schedule_random" class="table-schedule" hidden>
	<tr><th colspan="6"><h3>Random Schedule</h3></th></tr>
	<tr>
	<th>Date</th><th>From Time</th><th>To Time</th>
	</tr>
	<tbody id="schedule_random_body">
	<tr id="row_0">
	<td align="center"><input type="text" class="schedule_random Date" name="opp_date[]" id="opp_date" size="10" /></td>
	<td align="center">
		<input type="text" name="opp_fromtime[]" id="fromTime" class="schedule_random Time" size="7" />
		
	</td>
	<td align="center" id="totimeid">
	<input type="text" name="opp_totime[]" id="toTime" class="schedule_random Time" size="7" />	
	</td>
	
	</tr>
	</tbody>
	<tr><td colspan="6" align="left"><input type="button" id="addbutton" value="+ Add" name="add_field" /></td></tr>
	</table>
	<table id="schedule_nondate" class="table-schedule" hidden>
	<tr><th colspan="6"><h3>Schedule</h3></th></tr>
	<tr>
	<th>Expiry Date</th><th>From Time</th><th>To Time</th>
		</tr>
	<tr>
	<td align="center">
	 <input type="text" class="schedule_nondate Date" name="opp_date2" id="opp_date2" size="10"/>
	
	
	</td>
	
	<td align="center">
	<input type="text" name="opp_fromtime2" id="opp_fromtime2" class="schedule_nondate Time" size="7"/>
	
	</td>
	<td align="center" id="ttotimeid2">
		<input type="text" name="opp_totime2" id="opp_totime2" class="schedule_nondate Time" size="7"/>
	
	
	</td>
	</tr>
	</table>
	<table id="schedule_daily" class="table-schedule" hidden>
	<tr><th colspan="7"><h3>Daily Schedule</h3></th></tr>
	<tr>
	<th>From Date</th><th>To Date</th><th>From Time</th><th>To Time</th>
	</tr>
	<tr>
	<td align="center"><input type="text" class="schedule_daily Date" name="opp_fromdate3" id="opp_fromdate" size="10"  />	
	</td>
	<td align="center">
	<input type="text" class="schedule_daily Date" name="opp_todate3" id="opp_todate" size="10"/>

	</td>
	<td align="center">
	

		<input type="text" name="opp_fromtime3" id="opp_fromtime3" class="schedule_daily Time" size="7"/>
	
	
	
	</td>
	<td align="center" id="ttotimeid3">
	
			<input type="text" name="opp_totime3" id="opp_totime3" class="schedule_daily Time" size="7"/>

	
	</td>
	</tr>
	</table>
	<table id="schedule_weekly"  class="table-schedule" hidden>
	<tr><th colspan="7"><h3>Weekly Schedule</h3></th></tr>
	<tr>
	<th>Days</th><th>Expiry Date</th><th>From Time</th><th>To Time</th>
	</tr>
	<tr>
	<td align="left"><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="1" id="mon" />Mon<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="2" id="tue"/>Tue<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="3" id="wed"/>Wed<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="4" id="thu"/>Thu<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="5" id="fri"/>Fri<br /><input type="checkbox" name="opp_days[]" class="schedule_weekly" value="6" id="sat"/>Sat<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="0" id="sun"/>Sun</td>
	<td align="center"><input type="text" class="schedule_weekly Date" name="opp_date4" id="opp_date4" size="10" /></td>
	<td align="center">
	<input type="text" name="opp_fromtime4" id="opp_fromtime4" class="schedule_daily Time" size="7"/>
	</td>
	<td align="center" id="totimeid4">
		<input type="text" name="opp_totime4" id="opp_totime4" class="schedule_daily Time" size="7"/>
	</td>
	</tr>
	</table>
	</tr>
	<tr>
		<td colspan="2"></td><td>
	<input type="submit" name="submit" style="width:200px;height:40px;" value="Submit" /></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
	<?php 
	if(isset($_POST['submit'])){
	include("prod_conn.php");
	$query="INSERT INTO location(location,city_id) VALUES ('$_POST[location]','$_POST[city]')";
			$result=mysql_query($query);
			$location_id=mysql_insert_id();
			$doctorquery="SELECT doctor_id FROM doctor WHERE donor_id=$_SESSION[SESS_DONOR_ID]";
			$docresult=mysql_query($doctorquery);
			$doctor_id=mysql_fetch_array($docresult);
	if($_POST['date_specific']=='0'){
			$today=date("Y-m-d");
			$expdate = date_format(date_create_from_format('j-M-Y', $_POST['opp_date2']), 'Y-m-d');
			$_POST['opp_fromtime2']=DATE("H:i",strtotime($_POST['opp_fromtime2']));
			$_POST['opp_totime2']=DATE("H:i",strtotime($_POST['opp_totime2']));
			
			$schedule="INSERT INTO schedule(from_date,to_date,from_time,to_time,location_id,doctor_id,description) 
			VALUES ('$today','$expdate','$_POST[opp_fromtime2]','$_POST[opp_totime2]','$location_id','$doctor_id[doctor_id]','$_POST[description]')";
			$insert_schedule=mysql_query($schedule);
		}
	else {
		if($_POST['schedule_type']=="daily"){
			$_POST['opp_fromdate3'] = date_format(date_create_from_format('j-M-Y', $_POST['opp_fromdate3']), 'Y-m-d');
			$_POST['opp_todate3'] = date_format(date_create_from_format('j-M-Y', $_POST['opp_todate3']), 'Y-m-d');
			$_POST['opp_fromtime3']=DATE("H:i",strtotime($_POST['opp_fromtime3']));
			$_POST['opp_totime3']=DATE("H:i",strtotime($_POST['opp_totime3']));
			$schedule="INSERT INTO schedule(from_date,to_date,from_time,to_time,location_id,doctor_id,description) 
			VALUES ('$_POST[opp_fromdate3]','$_POST[opp_todate3]','$_POST[opp_fromtime3]','$_POST[opp_totime3]','$location_id','$doctor_id[doctor_id]','$_POST[description]')";
			$insert_schedule=mysql_query($schedule);
		}
			
		if($_POST['schedule_type']=="random"){
			$todate=$_POST['opp_date'];
			$fromdate=$_POST['opp_date'];
			$fromtime=$_POST['opp_fromtime'];
			$totime=$_POST['opp_totime'];
			for($i=0;$i<count($todate);$i++){
					$todate[$i]=date_format(date_create_from_format('j-M-Y', $todate[$i]), 'Y-m-d');
					$fromdate[$i]=$todate[$i];
					$fromtime[$i]=DATE("H:i",strtotime($fromtime[$i]));
					$totime[$i]=DATE("H:i",strtotime($totime[$i]));
					$schedule="INSERT INTO schedule(from_date,to_date,from_time,to_time,location_id,doctor_id,description) 
					VALUES ('$fromdate[$i]','$todate[$i]','$fromtime[$i]','$totime[$i]','$location_id','$doctor_id[doctor_id]','$_POST[description]')";
					$insert_schedule=mysql_query($schedule);
			}
		}
		if($_POST['schedule_type']=="weekly"){
			date_default_timezone_set('Asia/Kolkata');
			$today=date("Y-m-d");
			$expdate = date_format(date_create_from_format('j-M-Y', $_POST['opp_date4']), 'Y-m-d');
			$_POST['opp_fromtime4']=DATE("H:i",strtotime($_POST['opp_fromtime4']));
			$_POST['opp_totime4']=DATE("H:i",strtotime($_POST['opp_totime4']));
			$days_of_week=implode(",",$_POST['opp_days']);
			$schedule="INSERT INTO schedule(days_of_week,from_time,to_time,location_id,doctor_id,description) 
			VALUES ('$days_of_week','$_POST[opp_fromtime4]','$_POST[opp_totime4]','$location_id','$doctor_id[doctor_id]','$_POST[description]')";
			$insert_schedule=mysql_query($schedule);	
			
				}
		}
	echo "Schedule added successfully";
	} 
	
?>
	
<!--footer-->
</div>

</div>
<!--wrapper end-->

 </BODY>
</HTML>


