<?php require_once('login_auth.php');?>
<?php $thispage = "ngoHomescreen"; ?>
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
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <html lang="en">
	<head>
    
    <style type="text/css">

span.link {
    	position: relative;
}

    span.link a span {
    	display: none;
}

span.link a:hover {
    	font-size: 99%;
    	font-color: #000000;
}

span.link a:hover span { 
    display: block; 
    	position: absolute; 
    	margin-top: 10px; 
    	margin-left: -10px; 
	    width: 175px; padding: 5px; 
    	z-index: 100; 
    	color: #000000; 
    	background: #f0f0f0; 
    	font: 12px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
}
</style>
  <!-- 
  <script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")
        return false;
      });
    });
  });
  </script>
   -->
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->
<br />
<center><b>Donations/Volunteer Contributions recieved.</b></center>
<br />
<script src="scripts/tabscripts.js"></script>
<script language="javascript" >
var group="ngoTabs";
createGroup(group);
registerTab(group,"fundingStatusTab","fundingStatusDiv");
registerTab(group,"financialTab","financialDiv");

</script>

<div id="tab" class="tab"   >
<ul  class="tabContainer" >  
<div id="tabs" class="tab-box">
    <a onclick="showTab('ngoTabs','financialTab')" class="tabLink activeLink" id="financialTab">Financial Donations</a>
    <a onclick="showTab('ngoTabs','fundingStatusTab')" class="tabLink" id="fundingStatusTab">Funding Status</a>
    
    
</div>
</ul>
</div>
<div style="display:none;" id="financialDiv">
	ggjjg
</div>
<div style="display:block;"   id="fundingStatusDiv">
	<?php //include 'volunteer_personal_contributions_list.php';?>
</div>
<br />
<br />



<!--footer-->
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
