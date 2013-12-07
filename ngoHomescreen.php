<?php require_once('login_auth.php');?>
<?php $thispage = "ngoHomescreen"; 

if (!$_SESSION['SESS_USER_TYPE']=="N")
{
	header(header("Location: login_failed"));
}
if(isset($_SESSION['POST_DATA']))
	{
		//Get post data from session variable
		$_POST=$_SESSION['POST_DATA'];
		unset($_SESSION['POST_DATA']);
		
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
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <link rel="stylesheet" href="scripts/jquery-ui.css">
	<link rel="stylesheet" href="css/table.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
	
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
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->

<script src="scripts/tabscripts.js"></script>
<script language="javascript" >
var group="ngoTabs";
createGroup(group);
registerTab(group,"volunteerHoursTab","volunteerHoursDiv");
registerTab(group,"summaryTab","summaryDiv");
registerTab(group,"financialTab","financialDiv");

</script>

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
		<label for="folder1" class="menu_first">+ Make Requests</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>
			
			<li class="tabLink"><a class="file" id="volunteerReqTab">Volunteering </a></li>					
			<li class="tabLink"><a class="file" id="inKindReqTab">In Kind Donations </a></li> 

			
		</ul>
	</li>
	<li class="tree">
		<label for="folder1" class="menu_first">+ Update</label> 
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
	<div>
		<div style="display:none;" id="summaryDiv" >
			<?php include ("ngo/chartNgoPostpaidRecieved.php");?>
		</div>
		<div style="display:none;" id="financialDiv">
			<?php include ("ngo/reportNgoFinancialDonations.php");?>
		</div>
		<div style="display:block;"   id="volunteerHoursDiv">
			<?php include ("ngo/reportNgoVolunteerHours.php");?>
		</div>
		
	</div>
</td>
</tr>
</table>
<?php 
/*Restore Active tab after reloading the page*/
	if(isset($_SESSION['activeTab']))
	{
		
		echo "<script> showTab('ngoTabs','".$_SESSION['activeTab']."')</script>";
		
	}
	else
	{
		
		echo "<script> showTab('ngoTabs','summaryTab')</script>";
	}

?>
<!--footer-->

<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
