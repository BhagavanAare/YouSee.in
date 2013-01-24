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
				document.getElementById("register").style.visibility="visible";
			
			
		}	
		function showNGOReg()
		{

				document.getElementById("donorRegScreen").style.display="none";
				document.getElementById("NGO").style.display="block";
				document.getElementById("register").style.visibility="visible";
		}	
	</script>

	</head>
	<body>
    <?php include("header_navbar.php"); ?>
<div>

    <table >
    <tr>
          <td><input type="radio" onclick =  "showDonorReg();"  name="userType" value="donor" id="donorRadio"/>
        <label for="donorRadio">Donor/Volunteer</label>
        <input type="radio" onClick="showNGOReg();" name="userType" id="NGORadio" value="ngo" />
        <label for="NGORadio" >NGO</label></td>
    </tr>
      </table>
    
          <div  id="donorRegScreen" style="display:none">
			<form name="donor" action="processRegistrations.php" method="post">
            <input type="hidden" name="formName" value="donorReg" />

<!-- *****************************************   tabs ******************** -->
<script src="scripts/tabscripts.js"></script>
<script language="javascript" >
var group="donorReg";
createGroup(group);
registerTab(group,"donortab1","donordiv1");
registerTab(group,"donortab2","donordiv2");
registerTab(group,"donortab3","donordiv3");
registerTab(group,"donortab4","donordiv4");

</script>

<div id="tab" class="tab"   >
<ul  class="tabContainer" >  
<div id="tabs" class="tab-box">

    <a onclick="showTab('donorReg','donortab1')" class="tabLink activeLink" id="tab1">Personal Info</a>
    <a onclick="showTab('donorReg','donortab2')" class="tabLink" id="tab2">Contact Info</a>
    <a onclick="showTab('donorReg','donortab3')" class="tabLink" id="tab3">Organisation Info</a>
    <a onclick="showTab('donorReg','donortab4')" class="tabLink" id="tab4"> for UC</a>
</div>
</ul> 
</div>
<div style="display:block;" id="donordiv1"><?php include("donorRegForms/tab_personalInfo.php"); ?></div>
<div style="display:none;" id="donordiv2"><?php include("donorRegForms/tab_contactInfo.php"); ?></div>
<div style="display:none;" id="donordiv3"><?php include("donorRegForms/tab_orgInfo.php"); ?></div>
<div style="display:none;" id="donordiv4"><?php include("donorRegForms/tab_forUC.php"); ?></div>

					
                    
					
                    

</div>
					


					
					
                   
                <input id="register" style="visibility:hidden" name="submit" type="submit" value="Register" />
			</form>
            <br />
               			<br />
            </div>
        
        <div id="NGO" style="display:none">
			<form name="NGO" action="processRegistrations.php" method="post">
                        <input type="hidden" name="formName" value="NGOReg" />
                        <!--
<script language="javascript" >
var group="ngoReg";
createGroup(group);
registerTab(group,"ngotab1","ngodiv1");
registerTab(group,"ngotab2","ngodiv2");
</script>
<div id="tab" class="tab"   >
<ul  class="tabContainer" >  
<div id="tabs" class="tab-box">
    <a onclick="showTab('ngoReg','ngotab1')" class="tabLink activeLink" id="tab1">NGO Information</a>
    <a onclick="showTab('ngoReg','ngotab2')" class="tabLink" id="tab2">Contact Person Info</a>

</div>
</ul> 
</div>
<div style="display:block;" id="ngodiv1"><?php // include("NGORegForms/tab_partnerInfo.php"); ?></div>
<div style="display:none;" id="ngodiv2"><?php // include("NGORegForms/tab_partnerContactInfo.php"); ?></div>

-->

                <input id="register" style="visibility:visible" type="submit" name="submit" value="Register" />
			</form>
            </div>
        
			<br />
               			<br />
    </form>
        <?php include("footer.php"); ?>
</body>
</html>
