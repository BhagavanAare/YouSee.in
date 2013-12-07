<?php require_once('login_auth.php');?>
<?php $thispage = "req_volunteering"; 
 $activetab="volunteerReqTab";	 	 	 
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
  <link rel="stylesheet" type="text/css" href="css/div.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.timeentry.css">
  <link rel="stylesheet" href="scripts/jquery-ui.css">
	<link rel="stylesheet" href="css/table.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker_ngo.js"></script>
	<script src="scripts/jquery.timeentry.min.js"></script>
	<script src="scripts/jquery.mousewheel.js"></script>
<style type="text/css">
span.link 
{
    	position: relative;
}
span.link a span 
{
    	display: none;
}
span.link a:hover 
{
    	font-size: 99%;
    	font-color: #ffffff;
}
span.link a:hover span 
{ 
   	display: block; 
    	position: absolute; 
    	margin-top: 10px; 
    	margin-left: 10px; 
	width: 150px; 
	padding: 5px; 
    	z-index: 100; 
    	color: #000000; 
    	background:orange; 
    	font: 12px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
}
</style>
	<script type="text/javascript">
		$(function() {
		var $rowCount=$("#schedule_random_body").children().length;
		$( "#opp_date" ).datepicker();
		$( "#opp_date2" ).datepicker();
		$( "#opp_date4" ).datepicker();
		$( "#opp_fromdate" ).datepicker();
		$( "#opp_todate" ).datepicker();
		$( "#opp_totime2").timeEntry();
		$( "#opp_totime3").timeEntry();
		$( "#opp_totime4").timeEntry();
		$( "#opp_totime_0").timeEntry();
		$( "#opp_fromtime2").timeEntry();
		$( "#opp_fromtime3").timeEntry();
		$( "#opp_fromtime4").timeEntry();
		$( "#opp_fromtime_0").timeEntry();
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
			$(".schedule_weekly,.schedule_random,.schedule_random_ft,.schedule_random_tt").val("");
			$(".schedule_weekly").prop('checked',false);
		});
		$("#weekly").click(function() {
			$("#schedule_weekly").show();
			$("#schedule_daily").hide();
			$("#schedule_random").hide();
			$(".schedule_daily,.schedule_random,.schedule_random_ft,.schedule_random_tt").val("");
		});
		$("#random").click(function() {
			$("#schedule_weekly").hide();
			$("#schedule_daily").hide();
			$("#schedule_random").show();
			$(".schedule_weekly,.schedule_daily").val("");
			$(".schedule_weekly").prop('checked',false);
		});
		$("#addbutton").click(function(){
		var $row = $( "<tr id='row"+$rowCount+"'></tr>" );

   		 var $date = $( "<input type='text' class='schedule_random' name='opp_date[]' id='opp_date_"+$rowCount+"' size='10' / >" );


   var $fromtime = $( '<input type="text" class="schedule_random" name="opp_fromtime[]" id="opp_fromtime_'+$rowCount+'" value="'+$("#opp_fromtime_"+($rowCount-1)).val()+'" size="6" />' );

   var $totime = $( '<input type="text" class="schedule_random" name="opp_totime[]" id="opp_totime_'+$rowCount+'" value="'+$("#opp_totime_"+($rowCount-1)).val()+'" size="6" / >' );

   var $place = $( '<input type="text" id="place_'+$rowCount+'" class="schedule_random" name="place[]" value="'+$("#place_"+($rowCount-1)).val()+'" size="9"/ >' );

   var $city = $( '<input type="text" id="city_'+$rowCount+'" class="schedule_random" name="city[]" value="'+$("#city_"+($rowCount-1)).val()+'" size="9"/ >' );

   		 var $num_volunteer = $( '<input  type="text" id="num_vol_'+$rowCount+'" class="schedule_random" name="num_volunteers[]" value="'+$("#num_vol_"+($rowCount-1)).val()+'"size="2" / >' );

   		 $row.append( $( "<td align='center'></td>" ).append( $date ) );
   		 $row.append( $( "<td align='center'></td>" ).append( $fromtime ) );
   		 $row.append( $( "<td align='center'></td>" ).append( $totime ) );
   		 $row.append( $( "<td align='center'></td>" ).append( $place ) );
   		 $row.append( $( "<td align='center'></td>" ).append( $city ) );
   		 $row.append( $( "<td align='center'></td>" ).append( $num_volunteer ) );
		 $row.append($("<td></td>").append( $( "<input type='button' value='X' onclick='$(\"#row"+$rowCount+"\").remove();$rowCount--' / >")));
		 $row.append($("<td></td>").append( $( "<input type='text' value='"+($rowCount+1)+"' hidden name='rowCount' / >")));
   		 $("#schedule_random_body").append( $row );
		$('#opp_date_'+$rowCount).datepicker();	
			$('#opp_fromtime_'+$rowCount).timeEntry();
			$('#opp_totime_'+$rowCount).timeEntry();
		$rowCount++;
		});	

	});
	</script>
   
</style>
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<div id="content-main">
<!--maincontentarea begin-->
<script src="scripts/tabscripts.js"></script>


<table style="margin-bottom:40px;">
<tr>
<td valign="top">
<?php include 'ngo_uc_tabs.php'; ?>
</td>
<td>
	<form name="requestForm" method="post" action="req_volunteering.php">
	<table  class="table-request">
	<th colspan="2" align="left"><h3>New Request</h3></th>
	<tr>
	<td align="right">Vertical*</td>
	<td>
		<select name="vertical">
			<option value="" selected="selected">---SELECT---</option>
			<option value="Education">Education</option>
			<option value="Health">Health</option>
			<option value="Environment">Environment</option>
			<option value="Environment">General</option>
		</select>
	</td>
	</tr>
	<tr>
	<td align="right">Domain*</td>
	<td><select name="domain">
	<option value="" selected="selected">---SELECT---</option>
	<?php 
	include("prod_conn.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");
	$query="SELECT domain FROM volunteering_activity WHERE 1 group by domain";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
		echo '<option value="'.$row['domain'].'">'.$row['domain'].'</option>';
	}
	?> 
	</select></td>
	</td>
	</tr>
	<tr>
	<td align="right">Activity Title*</td>
	<td> <input type="text" name="activity" maxlength="150"> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Activity Details</td>
	<td> <textarea name="activity_details" maxlength="450" cols="40" rows="5"></textarea> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Skills Required <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Enter skills separated by commas (,)</span></a></span></td>
	<td> <input type="text" name="skills"> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Activity Type*</td>
	<td> <input type="radio" name="onsite_offsite" value="Onsite" id="onsite" ><label for="onsite">Onsite</label></input>
	     <input type="radio" name="onsite_offsite" value="Offsite" id="offsite" ><label for="offsite">Offsite</label></input> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Date Specific? *</td>
	<td><input type="radio" name="date_specific" value="1" id="yes"><label for="yes">Yes</label></input>
	     <input type="radio" name="date_specific" value="0" id="no"><label for="no">No</label></input> </td>
	</td>
	</tr>
	<tr id="schedule_type" hidden>
	<td align="right">Schedule Type</td>
	<td><input type="radio" class="schedule_type" name="schedule_type" value="daily" id="daily"><label for="daily">Daily</label>
	<input type="radio" class="schedule_type" name="schedule_type" value="weekly" id="weekly" /><label for="weekly">Weekly</label>
	<input type="radio" class="schedule_type" name="schedule_type" value="random" id="random"/><label for="random">Random</label>
	</td>
	</tr><tr>
	<table id="schedule_random" class="table-schedule" hidden>
	<tr><th colspan="6"><h3>Schedule</h3></th></tr>
	<tr>
	<th>Date</th><th>From Time</th><th>To Time</th><th>Place</th><th>City</th><th>No. of Volunteers</th>
	</tr>
	<tbody id="schedule_random_body">
	<tr id="row_0">
	<td align="center"><input type="text" class="schedule_random" name="opp_date[]" id="opp_date" size="10"/></td>
	<td align="center"><input type="text" class="schedule_random" name="opp_fromtime[]" id="opp_fromtime_0" size="6"/></td>
	<td align="center"><input type="text" class="schedule_random" name="opp_totime[]" id="opp_totime_0" size="6"/></td>
	<td align="center"><input type="text" id="place_0" class="schedule_random" name="place[]" size="9"/></td>
	<td align="center"><input type="text" id="city_0" class="schedule_random" name="city[]" size="9"/></td>
	<td align="center"><input  type="text" id="num_vol_0" class="schedule_random" name="num_volunteers[]" size="2" /></td>
	</tr>
	</tbody>
	<tr><td colspan="6" align="left"><input type="button" id="addbutton" value="+ Add" name="add_field" /></td></tr>
	</table>
	<table id="schedule_nondate" class="table-schedule" hidden>
	<tr><th colspan="6"><h3>Schedule</h3></th></tr>
	<tr>
	<th>Expiry Date</th><th>From Time</th><th>To Time</th><th>Place</th><th>City</th><th>No. of Volunteers</th>
	</tr>
	<tr>
	<td align="center"><input type="text" class="schedule_nondate" name="opp_date2" id="opp_date2" size="10"/></td>
	<td align="center"><input type="text" class="schedule_nondate" name="opp_fromtime2" id="opp_fromtime2" size="6"/></td>
	<td align="center"><input type="text" class="schedule_nondate" name="opp_totime2" id="opp_totime2" size="6"/></td>
	<td align="center"><input type="text" class="schedule_nondate" name="place2" size="9"/></td>
	<td align="center"><input type="text" class="schedule_nondate" name="city2" size="9"/></td>
	<td align="center"><input  type="text" class="schedule_nondate" name="num_volunteers2" size="2" /></td>
	</tr>
	</table>
	<table id="schedule_daily" class="table-schedule" hidden>
	<tr><th colspan="7"><h3>Schedule</h3></th></tr>
	<tr>
	<th>From Date</th><th>To Date</th><th>From Time</th><th>To Time</th><th>Place</th><th>City</th><th>No. of Volunteers</th>
	</tr>
	<tr>
	<td align="center"><input type="text" class="schedule_daily" name="opp_fromdate3" id="opp_fromdate" size="10"/></td>
	<td align="center"><input type="text" class="schedule_daily" name="opp_todate3" id="opp_todate" size="10"/></td>
	<td align="center"><input type="text" class="schedule_daily" name="opp_fromtime3" id="opp_fromtime3" size="6"/></td>
	<td align="center"><input type="text" class="schedule_daily" name="opp_totime3" id="opp_totime3" size="6"/></td>
	<td align="center"><input type="text" class="schedule_daily" name="place3" size="9"/></td>
	<td align="center"><input type="text" class="schedule_daily" name="city3" size="9"/></td>
	<td align="center"><input  type="text" class="schedule_daily" name="num_volunteers3" size="2" /></td>
	</tr>
	</table>
	<table id="schedule_weekly"  class="table-schedule" hidden>
	<tr><th colspan="7"><h3>Schedule</h3></th></tr>
	<tr>
	<th>Days</th><th>Expiry Date</th><th>From Time</th><th>To Time</th><th>Place</th><th>City</th><th>No. of Volunteers</th>
	</tr>
	<tr>
	<td align="left"><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="Monday" id="mon"/>Mon<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="Tuesday" id="tue"/>Tue<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="Wednesday" id="wed"/>Wed<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="Thursday" id="thu"/>Thu<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="Friday" id="fri"/>Fri<br /><input type="checkbox" name="opp_days[]" value="Saturday" id="sat"/>Sat<br /><input type="checkbox" class="schedule_weekly" name="opp_days[]" value="Sunday" id="sun"/>Sun</td>
	<td align="center"><input type="text" class="schedule_weekly" name="opp_date4" id="opp_date4" size="10"/></td>
	<td align="center"><input type="text" class="schedule_weekly" name="opp_fromtime4" id="opp_fromtime4" size="6"/></td>
	<td align="center"><input type="text" class="schedule_weekly" name="opp_totime4" id="opp_totime4" size="6"/></td>
	<td align="center"><input type="text" class="schedule_weekly" name="place4" size="9"/></td>
	<td align="center"><input type="text" class="schedule_weekly" name="city4" size="9"/></td>
	<td align="center"><input  type="text" class="schedule_weekly" name="num_volunteers4" size="2" /></td>
	</tr>
	</table>
	<?php 
	if(isset($_POST['submit'])){
	include("prod_conn.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");

	$query="SELECT partner_id FROM project_partners WHERE project_partners.user_id=".$_SESSION['SESS_USER_ID'];
	$result=mysql_query($query);
	$partner_id=mysql_fetch_array($result);
	$activity="INSERT INTO volunteering_activity(vertical,domain,activity,activity_details,skills,onsite_offsite,partner_id,date_specific) VALUES ('$_POST[vertical]','$_POST[domain]','$_POST[activity]','$_POST[activity_details]','$_POST[skills]','$_POST[onsite_offsite]','$partner_id[partner_id]','$_POST[date_specific]')";
	$insert_activity=mysql_query($activity);
	$activity_id=mysql_insert_id();
	if($_POST['date_specific']=='0'){
			$today=date("Y-m-d");
			$expdate = date_format(date_create_from_format('j-M-Y', $_POST['opp_date2']), 'Y-m-d');
			if($_POST['opp_fromtime2'] && $_POST['opp_totime2']=='')
			{
				$_POST['opp_fromtime2']=0;
				$_POST['opp_totime2']=0;
			}
			else
			{
			$_POST['opp_fromtime2']=DATE("H:i",strtotime($_POST['opp_fromtime2']));
			$_POST['opp_totime2']=DATE("H:i",strtotime($_POST['opp_totime2']));
			}
			$schedule="INSERT INTO volunteering_opportunities(activity_id,from_date,to_date,from_time,to_time,location,city,num_volunteers) VALUES ('$activity_id','$today','$expdate','$_POST[opp_fromtime2]','$_POST[opp_totime2]','$_POST[place2]','$_POST[city2]','$_POST[num_volunteers2]')";
			$insert_schedule=mysql_query($schedule);
		}
	else {
		if($_POST['schedule_type']=="daily"){
			$_POST['opp_fromdate3'] = date_format(date_create_from_format('j-M-Y', $_POST['opp_fromdate3']), 'Y-m-d');
			$_POST['opp_todate3'] = date_format(date_create_from_format('j-M-Y', $_POST['opp_todate3']), 'Y-m-d');
			if($_POST['opp_fromtime3'] && $_POST['opp_totime3']=='')
			{
				$_POST['opp_fromtime3']=0;
				$_POST['opp_totime3']=0;
			}
			else{
			$_POST['opp_fromtime3']=DATE("H:i",strtotime($_POST['opp_fromtime3']));
			$_POST['opp_totime3']=DATE("H:i",strtotime($_POST['opp_totime3']));
			}
			$schedule="INSERT INTO volunteering_opportunities(activity_id,from_date,to_date,from_time,to_time,location,city,num_volunteers) VALUES ('$activity_id','$_POST[opp_fromdate3]','$_POST[opp_todate3]','$_POST[opp_fromtime3]','$_POST[opp_totime3]','$_POST[place3]','$_POST[city3]','$_POST[num_volunteers3]')";
			$insert_schedule=mysql_query($schedule);
			}
			
		if($_POST['schedule_type']=="random"){
			$todate=$_POST['opp_date'];
			$fromdate=$_POST['opp_date'];
			$fromtime=$_POST['opp_fromtime'];
			$totime=$_POST['opp_totime'];
			$place=$_POST['place'];
			$city=$_POST['city'];
			$num_volunteers=$_POST['num_volunteers'];
			for($i=0;$i<$_POST['rowCount'];$i++){
					$todate[$i]=date_format(date_create_from_format('j-M-Y', $todate[$i]), 'Y-m-d');
					$fromdate[$i]=$todate[$i];
					if($fromtime[$i] && $totime[$i]=='')
						{
							$fromtime[$i]=0;
							$totime[$i]=0;
						}
					else{
					$fromtime[$i]=DATE("H:i",strtotime($fromtime[$i]));
					$totime[$i]=DATE("H:i",strtotime($totime[$i]));}
					$schedule="INSERT INTO volunteering_opportunities(activity_id,from_date,to_date,from_time,to_time,location,city,num_volunteers) VALUES ('$activity_id','$fromdate[$i]','$todate[$i]','$fromtime[$i]','$totime[$i]','$place[$i]','$city[$i]','$num_volunteers[$i]')";
					$insert_schedule=mysql_query($schedule);
			}
		}
		if($_POST['schedule_type']=="weekly"){
			date_default_timezone_set('Asia/Kolkata');
			$today=date("Y-m-d");
			$expdate = date_format(date_create_from_format('j-M-Y', $_POST['opp_date4']), 'Y-m-d');
			if($_POST['opp_fromtime4'] && $_POST['opp_totime4']=='')
						{
							$_POST['opp_fromtime4']=0;
							$_POST['opp_totime4']=0;
						}
			else{
			$_POST['opp_fromtime4']=DATE("H:i",strtotime($_POST['opp_fromtime4']));
			$_POST['opp_totime4']=DATE("H:i",strtotime($_POST['opp_totime4']));}
			while(strtotime($today)<=strtotime($expdate)){
				foreach($_POST['opp_days'] as $day){
					if(date_format(date_create($today), 'l')==$day){
						$schedule="INSERT INTO volunteering_opportunities(activity_id,from_date,to_date,from_time,to_time,location,city,num_volunteers) VALUES ('$activity_id','$today','$expdate','$_POST[opp_fromtime4]','$_POST[opp_totime4]','$_POST[place4]','$_POST[city4]','$_POST[num_volunteers4]')";
			$insert_schedule=mysql_query($schedule);	
					}
			}
				$today=date("Y-m-d",strtotime("1 Day",strtotime($today)));
			}
			$opp_days=implode(",",$_POST['opp_days']);
			
		}
	}
	} 
	
?>
	<tr><td colspan="2" align="right"><input type="submit" name="submit" style="width:200px;height:40px;" value="Submit" /></td></tr>
</table>
</form>
</td>
</tr>
</table>

	
<!--footer-->
</div>
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>


