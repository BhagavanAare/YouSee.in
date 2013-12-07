
<?php require_once('login_auth.php');?>

<?php $thispage = "myuc";
 $activetab="summaryTab";	 	 	 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <title>My UC | Summary</title>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">

<?php
if(isset($_GET['gawt']) && $_GET['gawt']==1) { ?>
<!-- Google Code for Volunteer Registration Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1017317607;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "wegQCMnP0AQQ55GM5QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1017317607/?value=0&amp;label=wegQCMnP0AQQ55GM5QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php } ?>
<script type="text/javascript">
		$(function() {
		// $( "#toDate\\[\\]" ).datepicker()
		$(".Date").datepicker();
		$(".Time").timeEntry();
		});
		
		   
</script>

  <html lang="en">
	<head>
 
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

<!--maincontentarea end-->

<div>
<table>
<tr>
<td valign="top">
<?php include 'myucTabs.php'; ?>
</td>
<td>

<div>
<!-- ******************** Main Content Area Start ******************** -->
 	
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
	
<!-- ******************** Main Content Area End ******************** -->
</div>
</td>
</tr>
</div>

</table>
<br/>
</div>



</div>
<!--footer-->
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
