<?php session_start();?>
<?php $thispage = "donate_time"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/div.css">
<link rel="stylesheet" href="scripts/jquery-ui.css">
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery.ui.core.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker_ngo.js"></script>
<link rel="stylesheet" href="css/slideshow.css" />
<!--<script src="scripts/slides.css.js"></script>-->
<script src="scripts/jquery.blockUI.js"></script>
	<script>
		$(function(){
			$("#datesearch").datepicker();
			$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
		});
	</script>
	<script>
		function visible()
		{
		document.getElementById("clear_filter").style.visibility="visible";
		}
		function uncheck(){
		$('#table-search input:checkbox').removeAttr('checked');
		document.getElementById("clear_filter").style.visibility="hidden";}
	</script>
  </HEAD>
 <BODY>

<!--wrapper begin-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<!--maincontentarea begin-->
<div id="uccertificate-main">
<?php
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$activityQuery="SELECT name,activity,activity_details,skills,onsite_offsite,location,city,num_volunteers,opportunity_id FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id

				WHERE o.approval_status='P' GROUP BY o.activity_id";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;
?>
<table>
<tr>
<td  colspan="4">
<div id="rightp" style="float:left">
<table>
<tr><td width="1000px">
<?php if(isset($_GET['commit']) && $_GET['commit']!=''){
echo "<p>Thank you <span style='color:#000066;font-weight:bold;margin:0px;padding:0px;font-size:12px;'>".$_SESSION['SESS_DISPLAYNAME']."</span> for your volunteering commitment.</p>";
?>
<!-- Google Code for Volunteer Commitment Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1017317607;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "ds0hCMHQ0AQQ55GM5QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1017317607/?value=0&amp;label=ds0hCMHQ0AQQ55GM5QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php
if(isset($_GET['gawt']) && $_GET['gawt']==1){ ?>
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
<?php
} }
else{ ?>
<p align="left" style="color:#666;font-size:13px;font-family:Trebuchet MS;">UC facilitates volunteers to engage in predictable and structured volunteering initiatives with various Non-Profit organisations. We welcome you to sign up for some of the volunteering opportunities listed here.</p></td>
<?php }?></td>
</tr>
</table>

</div>
</td>
</tr>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<hr>
<div id="search_filters">
<?php include "dt_filters.php"; ?>
</div>
</div>
</td>
<td valign="top">
<hr>
<div id="postedComments" >
<?php include 'volunteering_opportunities.php'; ?>	
</div>
<div id="loadMoreComments" style="display:none;" ></div>			

</td>
</tr>
</table>
<!--maincontentarea end-->
</div>

<!--footer-->
<?php include 'footer.php' ;?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
<?php
/*
Version Track
1 - 07May13 - Vivek - Activity commit introduced. 
*/
?>