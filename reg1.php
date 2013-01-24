<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<script type="text/javascript">
		function showDonorReg()
		{
			//alert("d");
			if(document.getElementById("donorRadio").checked){
				document.getElementById("donorRegScreen").style.display="block";
				document.getElementById("NGORegScreen").style.display="none";}
		}	
		function showNGOReg()
		{
			//alert("n");
			if(document.getElementById("NGORadio").checked)
			{
				
				document.getElementById("donorRegScreen").style.display="none";
				document.getElementById("NGORegScreen").style.display="block";}
		}	
	</script>
	<link rel="stylesheet" type="text/css" href="css/jquery.ui.all.css">
	<script src="scripts/jquery-1.8.3.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/jquery.ui.tabs.js"></script>
	<link rel="stylesheet" type="text/css" href="css/demos.css">
	<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
</head>
<body>
<div>
	<form name="regForm" action="">
	<table>
		<tr>
			<td>
				<input type="radio" value="donor" onchange =  "showDonorReg()" name=userType id="donorRadio"/>
				<label for="donorRadio">Donor/Volunteer</label> 
				<input type="radio" value="NGO" onChange="showNGOReg()" name=userType id="NGORadio" />
				<label for="NGORadio" >NGO</label>
				
			</td>
		</tr>
		<tr>
			<td>
				<div id="donorRegScreen" style="display:none">
				<?php
					include("donorRegForms/tab_personalInfo.php");
					include("donorRegForms/tab_contactInfo.php");
					include("donorRegForms/tab_orgInfo.php");
					include("donorRegForms/tab_forUC.php");
                ?>
                 
					
				</div>
				<div id="NGORegScreen" style="display:none">
                jsdjfhjdsk
					<?php echo "sdfs";
					include("NGORegForms/tab_partnerContactInfo.php");
					include("NGORegForms/tab_partnerInfo.php");
                ?>
                    
				</div>
				
			</td>
		</tr>
		
	</table>
	
	</form>
</body>
</html>
