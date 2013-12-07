<?php 
session_start();
$thispage="more";
if(!isset($_SESSION['SESS_USER_ID']) || $_SESSION['SESS_USER_TYPE']=='N' || $_SESSION['SESS_USER_TYPE']=='A')
{
	header("Location:register_doctor.php");
	exit();
}
else{
include_once "prod_conn.php";

if(isset($_POST['submit'])){
	foreach($_POST['degree'] as $deg){
		$degree[]=$deg;
	}
	foreach($_POST['institute'] as $inst){
		$institute[]=$inst;
	}
	foreach($_POST['year'] as $y){
		$year[]=$y;
	}
	$count=count($degree);
	$query="SELECT speciality_sub_speciality_link_id FROM 
	speciality_sub_speciality_link WHERE speciality_id='$_POST[speciality]'
	 AND sub_speciality_id='$_POST[sub_spec]'";
	if($result=mysql_query($query)){
		if(mysql_num_rows($result)>0){
		$link=mysql_fetch_array($result);
		$link=$link['speciality_sub_speciality_link_id'];
		}
		else{
			mysql_query("INSERT INTO speciality_sub_speciality_link
			(speciality_id,sub_speciality_id) VALUES ('$_POST[speciality]',
			'$_POST[sub_spec]')");
			$link=mysql_insert_id();
		}
	}
	$insert_query="INSERT INTO doctor(donor_id,current_hospital,experience,
	age,city_id,speciality_Sub_Speciality_link_id) VALUES ('$_SESSION[SESS_DONOR_ID]',
	'$_POST[current_hospital]','$_POST[experience]','$_POST[age]','$_POST[city]',
	'$link')";
	if($result=mysql_query($insert_query)){
		$doctor_id=mysql_insert_id();
		for($i=0;$i<$count;$i++){
				mysql_query("INSERT INTO qualification(doctor_id,degree,year,university)
				VALUES ('$doctor_id','$degree[$i]','$year[$i]','$institute[$i]')");
		}
		if(mysql_query("UPDATE donors SET doctor_flag = 1 WHERE donor_id = '$_SESSION[SESS_DONOR_ID]'")){
			header("Location:doctor_schedule.php");
		}
	}
	
	 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<title>People's Doctor Registration | YouSee</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/css/main.css">
<script src="/scripts/jquery.min.js"></script>
<script>
$(function(){
				var count=1;

		$("#add_qualification").click(function(){
			var qual="<div id='qual"+count+"'><input type='text' placeholder='Degree' name='degree[]' size='10' required /> "
			qual+="<select name='year[]' required><option value=''>Select Year</option>";
			for(var i=(new Date).getFullYear();i>1929;i--){
				qual+="<option value='"+i+"'>"+i+"</option>";
			}
			qual+="</select> ";
			qual+="<input type='text' placeholder='Institution' name='institute[]' size='15' required /> ";
			qual+="<input type='button' value='X' onclick='$(\"#qual"+count+"\").remove();'/></div>";
			$("#qualifications").append(qual);
			count++;
		});
});
				</script>
</head>
<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">
	<form name="doctor_form" id="doctor_form" method="POST" action="doctor_details.php">
		<h3>Doctor Registration</h3>
		<fieldset id="qualifications">
			<legend>Qualifications</legend>
			<div id="qual0">
			<input type="text" placeholder="Degree" id="degree" name="degree[]" size="10" required />
			<select name="year[]" id="year1">
			<option value="">Select Year</option>
			<?php 
			for($i=date("Y");$i>1929;$i--){
				echo "<option value='$i'>$i</option>";
			}
			?>
			</select>
			<input type="text" placeholder="Institution" name="institute[]" size="15" required />
			<input type="button" value="+Add" id="add_qualification" />
			</div>
		</fieldset>
		<br />
		<fieldset>
			<legend>Details</legend>
			<input type="text" placeholder="Current Hospital" name="current_hospital" size="30" required /><br /><br />
			<select name="speciality" id="speciality" required>
			<option>Select Speciality</option>
			<?php 
			$specialityquery="SELECT speciality,speciality_id FROM speciality";
			$result=mysql_query($specialityquery);
			while($speciality=mysql_fetch_array($result)){
				echo "<option value='$speciality[speciality_id]'>$speciality[speciality]</option>";
			}
			?>
			</select><br /><br />
			<select name="sub_spec" id="sub_spec">
			<option>Select Sub Speciality</option>
			<?php 
			$sub_specquery="SELECT speciality,sub_speciality_id FROM sub_speciality";
			$result=mysql_query($sub_specquery);
			while($sub_spec=mysql_fetch_array($result)){
				echo "<option value='$sub_spec[sub_speciality_id]'>$sub_spec[speciality]</option>";
			}
			?>
			</select><br /><br />
			<input type="text" placeholder="Experience" name="experience" size="9" required /> years<br /><br />
			<input type="text" placeholder="Age" name="age" size="4" required /> years<br /><br />
			<select name="city" id="city">
			<option>Select city</option>
			<?php 
			$cityquery="SELECT city,city_id FROM city";
			$result=mysql_query($cityquery);
			while($city=mysql_fetch_array($result)){
				echo "<option value='$city[city_id]'>$city[city]</option>";
			}
			?>
			</select><br /><br />
			<input type="submit" value="Submit" name="submit" id="submit" />
		</fieldset>
	</form>
</div>
<?php include("footer.php");?>
</div>
<?php } ?>

	
	
