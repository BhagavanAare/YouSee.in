<?php $thispage ="registration";
$regPage="";
?>
<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="test/test.css">

<link rel="stylesheet" href="scripts/jquery-ui.css">
<script src="scripts/jquery-1.8.3.js"></script>
<script src="scripts/jquery.ui.core.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker.js"></script>
<script type="text/javascript">
		$(function() {
		$( "#dob" ).datepicker();
		$( "#dobngo" ).datepicker();
	});
	</script>
<script src="scripts/tabscripts.js"></script>
<script src="scripts/reg_validatorv4.js" type="text/javascript"></script>

<script type="text/javascript">
		function showDonorReg()
		{
			//alert("d");
			
				document.getElementById("donorRegScreen").style.display="block";
				document.getElementById("NGO").style.display="none";
			
			
		}	
		function showNGOReg()
		{

				document.getElementById("donorRegScreen").style.display="none";
				document.getElementById("NGO").style.display="block";
		}	
	</script>
</head>
<body style="background: #FFF;">
<div id="wrapper"><?php include("header_navbar.php"); ?>


<table>
	<tr>
		<td>
		<p><strong>Registration Form</strong></p>
		<p><input type="radio" onclick="showDonorReg();" name="userType"
			value="donor" id="donorRadio" /> <label for="donorRadio">Donor/Volunteer <span class="link" ><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span >I wish to donate or volunteer through UC platform.</span></a></span></label>
		&nbsp &nbsp <input type="radio" onclick="showNGOReg();"
			name="userType" id="NGORadio" value="ngo" /> <label for="NGORadio">NGO <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span style="margin-left:175px;">I wish to register my organisation(NGO/NPO) to mobilise resources through UC platform</span></a></span></label>
		</p>
		</td>
	</tr>
</table>

<div id="donorRegScreen" style="display: none">
<form name="donor" action="processRegistrations.php" method="post"><input
	type="hidden" name="formName" value="donorReg" /> 
	<!-- *****************************************   tabs ******************** -->
<script language="javascript">
var group="donorReg";
createGroup(group);
registerTab(group,"donortab1","donorDiv1");
registerTab(group,"donortab2","donorDiv2");
registerTab(group,"donortab3","donorDiv3");
registerTab(group,"donortab4","donorDiv4");
setActiveTab(group,"donortab1");
registerButtons(group,"donorBack","donorSubmit","donorNext");
var groupngo="ngoReg";
createGroup(groupngo);
registerTab(groupngo,"ngotab1","ngoDiv1");
registerTab(groupngo,"ngotab2","ngoDiv2");
setActiveTab(groupngo,"ngotab1");
registerButtons(groupngo,"ngoBack","ngoSubmit","ngoNext");
</script>

<div id="tab" class="tab">
<ul class="tabContainer">
	<div id="tabs" class="tab-box"><a
		onClick="showTab('donorReg','donortab1')" class="tabLink activeLink"
		id="donortab1">Personal Info</a> <a
		onClick="showTab('donorReg','donortab2')" class="tabLink"
		id="donortab2">Contact Info</a> <a
		onClick="showTab('donorReg','donortab3')" class="tabLink"
		id="donortab3">Organisation/Group Info</a> <a
		onClick="showTab('donorReg','donortab4')" class="tabLink"
		id="donortab4"> for UC</a></div>
</ul>
</div>
<br />
<div style="min-height:300px; margin-left:100px;" >
<div style="display: block;" id="donorDiv1"><?php include("donorRegForms/tab_personalInfo.php"); ?></div>
<div style="display: none;" id="donorDiv2"><?php include("donorRegForms/tab_contactInfo.php"); ?></div>
<div style="display: none;" id="donorDiv3"><?php include("donorRegForms/tab_orgInfo.php"); ?></div>
<div style="display: none;" id="donorDiv4"><?php include("donorRegForms/tab_forUC.php"); ?></div>
</div>
<div style="margin-left:100px; " >
<input type="button" value="Back" id="donorBack" disabled="disabled" onclick="showPreviousTab('donorReg')" />
<input style="margin-left:190px;" type="button" value="Next" id="donorNext" onClick="showNextTab('donorReg')" /></div>
<div style="margin-left: 200px;"><input id="register"
	style="visibility: visible" name="donorSubmit" type="submit"
	value="Register" /></div>
</form>
<br />
<br />
</div>
<!--  NGO Registration forms -->
<div id="NGO" style="display: none">
<form name="NGO" action="processRegistrations.php" method="post">
<input type="hidden" name="formName" value="NGOReg" /> 
	<!-- ***   tabs *** -->

<div id="tab" class="tab">
<ul class="tabContainer">
	<div id="tabs" class="tab-box">
		<a onClick="showTab('ngoReg','ngotab1')" class="tabLink activeLink" id="ngotab1">Organisation Info</a> 
		<a onClick="showTab('ngoReg','ngotab2')" class="tabLink" id="ngotab2">Contact Person Info</a></div>
</ul>
</div>
<div style="min-height:300px; margin-top:20px; margin-left:100px;">
<div style="display: block;" id="ngoDiv1"><?php include("NGORegForms/tab_partnerInfo.php"); ?></div>
<div style="display: none;" id="ngoDiv2"><?php include("NGORegForms/tab_partnerContactInfo.php"); ?></div>
</div>

<br />
<div style="margin-left:100px; " >
<input type="button" value="Back" id="ngoBack" disabled="disabled" onclick="showPreviousTab('ngoReg')" />
<input style="margin-left:190px;" type="button" value="Next" id="ngoNext" onClick="showNextTab('ngoReg')" /></div>
<div style="margin-left: 200px;"><input id="register"
	style="visibility: visible" name="ngoSubmit" type="submit"
	value="Register" /></div>


</form>
</div>
</div>

</form>

<br />
<br />
<div style="width: 1000px;
	margin-right: auto;
	margin-left: auto;"><?php include("footer.php"); ?></div>

</body>




</html>
