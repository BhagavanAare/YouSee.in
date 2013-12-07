<?php session_start();?>
<?php $thispage = "donate_in_kind"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate in Kind | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/div.css">
  <link rel="stylesheet" type="text/css" href="css/inkind_items.css">  
  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/jquery.blockUI.js"></script>
  <script type="text/javascript" src="scripts/ajax_inkind_pages.js"></script>
  <script type="text/javascript">
		$(function() {
		$(".category").change(function(){
			$(".item option").show();
			if($(this).data('itemoptions') == undefined){
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('itemoptions',$('#item option').clone());
			}	
			var id = $(this).val();
			var itemoptions = $(this).data('itemoptions').filter('[name=' + id + ']');
			$('.item').html(itemoptions);
			$('.item').prepend('<option value="" selected="selected" >------All------</option>');
		});
		});
		$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
	</script>
  </HEAD>
 <BODY>

<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->
<div id="inkind_header">
<?php include 'header_navbar.php';?>
</div>
<!--maincontentarea-->

<div id="uccertificate-main" style="min-height:1000px;">
<div style="position:relative;width:1000px;height:150px;">
	<div style="float:right;width:200px;height:150px;">
		<div class="divbutton"  id="donate">	<img style="position:absolute;width:70px;height:70px;left:-35px" src="images/fordonors.png" alt="" />I have something to donate!</div>
		<div class="divbutton"  id="request"><img style="position:absolute;width:70px;height:70px;right:0px" src="images/fornpos.png" alt="" /> We have a request.</div>
	</div>
	
	
	<div style="float:left;width:700px;height:150px;">
		<p style="color:#666;font-size:13px;font-family:Trebuchet MS;">NPOs (NonProfit Organisations) can make In-Kind Donation requests here. Donors can also commit to donate items In-Kind here. UC is evolving criteria for NPOs and Donors to request and commit to In-Kind donations, in such a way that the most needy are supported. You are welcome to give us your feedback to achieve this goal.

 

</p><p style="color:#666;font-size:13px;font-family:Trebuchet MS;">Donors can also donate In-Kind reusable(portable) items by visiting the Donation Camps held at different locations in a <a style="color:#369;text-decoration:none;" href="donate_waste.php">few cities</a>. </p>
	</div>
</div>
	<div class="existing_inkind" style="padding-bottom:30px;">
	<div style="position:relative;float:left;left:7px; opacity:1" id="exist_requests_button" class="existing_selected">Requests</div>
	<div style="position:relative;float:right; opacity:1;right:7px;" id="exist_offers_button">Offers</div>
	</div>

<div id="existing_content" style="min-height:800px;">
<?php include "ajax_inkind_requests.php"; ?>
</div>			
<!--#maincontentarea-->
</div>
</div>


 </div>
 <?php include 'footer.php' ; ?>

 <!--#wrapper-->
<!--footer-->
<!--#footer-->
 </BODY>
</HTML>