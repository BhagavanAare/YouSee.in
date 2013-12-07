<?php session_start();?>
<?php $thispage = "uccertificates";
$thisdiv="donations_reports"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
		<script src="scripts/jquery.blockUI.js"></script>		
		<script>
				$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
		</script>
	<script type="text/javascript">
	$(function(){
		$("#gobutton").click(function(){
			if($("#month").val()!=null && $("#year").val()!=null){
				$.ajax({
				type: "POST",
				data : {month : $("#month").val() , year : $("#year").val() },
				url : 'report_postpaid.php',
				success : function(returnData) {
					$("#cont-2").html("Donations in the selected month");
					$("#cont-2-1").children().replaceWith(returnData);
				}
				
				});
			}
		});
	});
	</script>
 </HEAD>
 <BODY>

<!--wrapper-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea-->
<div id="uccertificate-main">
<div id="options" style="display: inline-block; float: left; width: 15%; height: auto; padding: 10px; background: white;">
					<?php include "donate_postpay_leftnav.php"; ?>
</div>

<div id="data" style="display: inline-block; width: 78%; height: auto; padding: 12px; margin-left: 24px; border: 0; border-left: 1px solid lightgrey;">
<div style="float:right;height:0px;">
Select a month :
<select name="month" id="month">
<option selected disabled>Month</option>
<?php 
for($i=1;$i<=12;$i++){
	echo "<option value='".date("m", mktime(0, 0, 0, $i+1, 0, 0, 0))."'>".date("M", mktime(0, 0, 0, $i+1, 0, 0, 0))."</option>";
}
?>
</select>
<select name="year" id="year">
<option selected disabled>Year</option>
<?php 
$year=date("Y");
for($i=2009;$i<=$year;$i++){
	echo "<option value='$i'>$i</option>";
}
?>
</select>
<input type="button" value="Go" id="gobutton" />
</div>
 <div class="tab-box">
    <a class="tabLink activeLink" id="cont-2">Last 100 Donations</a>
 </div>

  <div class="tabcontent paddingAll " id="cont-2-1">
  <?php include 'report_postpaid.php';?>
  </div>
  

</div>
</div>
<!--#maincontentarea-->

<!--bottomcontentarea-->
<!-- <div id="content-bottom">
<div align="center">
</div>
</div> -->
<!--#bottomcontentarea-->

<!--footer-->
<?php include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>