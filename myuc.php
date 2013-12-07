
<?php require_once('login_auth.php');?>

<?php $thispage = "myuc";
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
  <title>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</title>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
  
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
<div id="wrapper" >

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<div style="background:white">
<!--maincontentarea begin-->
<div id="uccertificate-main">

<h2>Welcome <?php include 'display_donor_info.php';?><!--, your Donor ID is: <?php //echo $_SESSION['SESS_DONOR_ID'];?>--></h2>

<br />

<!--<div class="tab-box">
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">Volunteering Contributions</a>
    <a href="javascript:;" class="tabLink " id="cont-2">Financial Donations</a>
    <a href="javascript:;" class="tabLink " id="cont-3">Waste Donations</a>
</div>

<div class="tabcontent paddingAll" id="cont-1-1">
	<?php //include 'volunteer_personal_contributions_list.php';?>
</div>

<div class="tabcontent paddingAll hide" id="cont-2-1">
	<?php //include 'finance_personal_contributions_list.php';?>
</div>
  
<div class="tabcontent paddingAll hide" id="cont-3-1">
	<table border="0" width="100%">
			<tr>
				<td align="center" width="50%"><?php //include 'donatewaste_graph_kg_personal.php';?></td>
				<td align="center" width="50%"><?php //include 'donatewaste_graph_rs_personal.php';?></td>
			</tr>
	</table>
</div>
-->
</div>
<!--maincontentarea end-->

<script src="scripts/tabscripts.js"></script>
<script language="javascript" >
var group="donorTabs";
createGroup(group);
registerTab(group,"volunteeringTab","volunteerDiv");
registerTab(group,"financialTab","financialDiv");
registerTab(group,"wasteTab","wasteDiv");
registerTab(group,"updateVolunteeringTab","updateVolunteeringDiv");
registerTab(group,"myInfoTab","myInfoDiv");
registerTab(group,"summaryTab","summaryDiv");
registerTab(group,"settingsTab","settingsDiv");
</script>
<div>
<table>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<ul  class="tree" >  
	<li class="tree">
		<label for="folder1" class="menu_first">+ My Donations</label> 
		<input type="checkbox" checked id="folder1" />
	<ul>
		<li class="tabLink"> <a onclick="showTab('donorTabs','summaryTab')" class="file" id="summaryTab">Summary</a></li>
		<li class="tabLink"> <a onclick="showTab('donorTabs','volunteeringTab')" class="file" id="volunteeringTab">Volunteering</a></li>
		<li class="tabLink"> <a class="file" id="inkindTab">In Kind</a></li>
		<li class="tabLink"> <a onclick="showTab('donorTabs','wasteTab')" class="file" id="wasteTab">Waste</a></li>
		<li class="tabLink"> <a onclick="showTab('donorTabs','financialTab')" class="file" id="financialTab">Financial</a></li>
		
    </ul>
	<li class="tree">
		<label for="folder2" class="menu_first">+ Update</label> 
		<input type="checkbox" checked id="folder2" />
		<ul>
			<li class="tabLink"> <a onclick="showTab('donorTabs','myInfoTab')" class="file" id="myInfoTab">My Info</a></li>
			<li class="tabLink"> <a onclick="showTab('donorTabs','settingsTab')" class="file" id="settingsTab">Settings</a></li>
			<li class="tabLink"> <a onclick="showTab('donorTabs','updateVolunteeringTab')" class="file" id="updateVolunteeringTab">Volunteering Info</a></li>
		</ul>
	</li>
</ul>
</div>
</td>
<td>

<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >
<div style="display:block;"   id="volunteerDiv">
	<?php  	
		if($activeTab=="volunteeringTab") 
		{
			include 'volunteer_personal_contributions_list.php';
		}
	?>
</div>

<div style="display:none;"  id="financialDiv">
	<?php
		if($activeTab=="wasteTab") 
		{
			include 'finance_personal_contributions_list.php';
		}	
	?>
</div>
<div  id="wasteDiv" style="display:none;">
	<table border="0" width="100%">
			<tr>
				<td align="center" width="50%"><?php include 'donatewaste_graph_kg_personal.php';?></td>
				<td align="center" width="50%"><?php include 'donatewaste_graph_rs_personal.php';?></td>
			</tr>
	</table>
</div>
<div style="display:none;" id="updateVolunteeringDiv">
	<?php include 'Volunteering/updateActivity.php';?>
</div>
<div style="display:none; align:center; margin-top:20px;" id="myInfoDiv">

	<?php 	include 'util/tableUtility.php';
			include 'util/updateInfoUtil.php';
	?>
</div>
<div style="display:none; align:center;" id="summaryDiv">
<table border="0" width="100%">
	<tr>
		<td align="center" width="33%"><?php include 'volunteer_personal_contributions_graph.php';?></td>
	</tr>
	<tr>
		<td align="center" width="33%"><?php include 'donatewaste_graph_total_kg_personal.php';?></td>
	</tr>
	<tr>
		<td align="center" width="33%"><?php include 'finance_personal_contributions_graph.php';?></td>
	</tr>
</table>
</div>
<div style="display:none;" id="settingsDiv">
	<?php include 'util/changePassword.php';?>
</div>
</td>
</tr>
</div>

</table>
<br/>
</div>


<?php
/*Restore Active tab after reloading the page*/
	if(isset($_SESSION['activeTab']))
	{
		
		echo "<script> showTab('donorTabs','".$_SESSION['activeTab']."')</script>";
	}
	else
	{
		
		echo "<script> showTab('donorTabs','summaryTab')</script>";
	}

	
?>


</div>
<!--footer-->
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
