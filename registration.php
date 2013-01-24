<?php $thispage ="registration";
		$regPage="";
?>
<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="test/test.css">
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
    <?php include("header_navbar.php"); ?>
<div>

    <table >
    <tr>
          <td><input type="radio" onclick =  "showDonorReg();" name="userType" value="donor" id="donorRadio"/>
        <label for="donorRadio">Donor/Volunteer</label>
        <input type="radio" onClick="showNGOReg();" name="userType" id="NGORadio" value="ngo" />
        <label for="NGORadio" >NGO</label></td>
    </tr>
      </table>
    
          <div  id="donorRegScreen" style="display:none">
			<form name="donor" action="processRegistrations.php" method="post">
            <input type="hidden" name="formName" value="donorReg" />

<!-- *****************************************   tabs ******************** -->
<div id="tab">
<ul id="tablist">  
<li><a href="registration.php">Personal Info</a></li>
<li><a href="registration.php">Contact Info</a></li>
<li><a href="registration.php">Organisation Info</a></li>
<li><a href="registration.php">For UC</a></li>
</ul> 
</div>
					
					<?php include("donorRegForms/tab_personalInfo.php"); ?>
                    


					<?php include("donorRegForms/tab_contactInfo.php"); ?>


					<?php include("donorRegForms/tab_orgInfo.php"); ?>
					<?php include("donorRegForms/tab_forUC.php"); ?>
                    </fieldset>
                <input id="register" style="visibility:visible" name="submit" type="submit" value="Register" />
			</form>
            <br />
               			<br />
            </div>
        
        <div id="NGO" style="display:none">
			<form name="NGO" action="processRegistrations.php" method="post">
                        <input type="hidden" name="formName" value="NGOReg" />
              <?php
			  		//echo "lsdklfjd";
					
					include("NGORegForms/tab_partnerInfo.php");
					include("NGORegForms/tab_partnerContactInfo.php");
                ?>
                <input id="register" style="visibility:visible" type="submit" name="submit" value="Register" />
			</form>
            </div>
        
			<br />
               			<br />
    </form>
        <?php include("footer.php"); ?>
</body>
</html>
