<?php $thispage = "req_inkind"; ?>
<?php 
require_once('login_auth.php');
 $activetab="inKindReqTab";	 	 	 
if (!$_SESSION['SESS_USER_TYPE']=="N")
{
	header(header("Location: login_failed"));
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
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
    <link rel="stylesheet" type="text/css" href="css/inkind_items.css">

  <link rel="stylesheet" type="text/css" href="css/div.css">
  <link rel="stylesheet" href="scripts/jquery-ui.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker_ngo.js"></script>		
<style type="text/css">
span.link 
{
    	position: relative;
}
span.link a span 
{
    	display: none;
}
span.link a:hover 
{
    	font-size: 99%;
    	font-color: #ffffff;
}
span.link a:hover span 
{ 
   	display: block; 
    	position: absolute; 
    	margin-top: 10px; 
    	margin-left: 10px; 
	width: 150px; 
	padding: 5px; 
    	z-index: 100; 
    	color: #000000; 
    	background:orange; 
    	font: 12px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
}
</style>
</style>
<script type="text/javascript">
		$(function() {
		$('#req_exp_date').datepicker();
		$('#offer_exp_date').datepicker();
		$("#category").change(function(){
			$("#item option").show();
			if($(this).data('itemoptions') == undefined){
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('itemoptions',$('#item option').clone());
			}	
		var id = $(this).val();
		var itemoptions = $(this).data('itemoptions').filter('[name=' + id + ']');
		$('#item').html(itemoptions);
		$('#item').prepend('<option value="" selected="selected" >--Select--</option>');
		});
			$("#request_button").click(function(){
			$("#request_form").show();
			$("#offers_inkind").hide();
			});
		$("#existing").click(function(){
			$("#request_form").hide();
			$("#offers_inkind").show();
			});
		});
</script>
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->
<div id="content-main">

<table style="margin-bottom:40px;">
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<?php include "ngo_uc_tabs.php"; ?>
</div>
</td>
<td>
<input type="button" value="Make a new request" id="request_button" style="margin-right:40px;"/>
<input type="button" value="View my existing requests" id="existing" style="margin-left:40px;"/>
<?php
include('prod_conn.php');
$link = mysql_connect("$dbhost","$dbuser","$dbpass");
if(!$link) {
	die('Failed to connect to server: ' . mysql_error());
	}
//Select database
$db = mysql_select_db("$dbdatabase");
if(!$db) {
	die("Unable to select database");
}
$partner=mysql_fetch_array(mysql_query("SELECT partner_id from project_partners WHERE user_id=".$_SESSION['SESS_USER_ID']));
$request_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN project_partners on kind_donations.partner_id=project_partners.partner_id
				WHERE kind_donations.partner_id=".$partner['partner_id'];
$request_ex=mysql_query($request_query);
if(mysql_num_rows($request_ex)>0){
?>
<div class='itemcontainer' id="offers_inkind">
<?php 
echo "<h3>You Requested for..</h3>";
echo "<table class='table-item' style='width:750px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:30px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Requested By</th>
			<th>Address</th>
			<th>Transport</th>
			<th>We Requested..</th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($request_ex)){	?>
	<div class="postedComment" id="<?php echo $row['donation_id'];?>">
		<div class="itemdiv <?php echo $row['category']; ?>" >
			<table class="table-item">
				<tr>
					<td  style="font-size:13px;font-weight:bold;"><?php echo $row['donationitem']; ?></td>
					<td><?php echo $row['request_quantity']." ".$row['units_type']; ?></td>
					<td><a href="<?php echo $row['partner_email']; ?>" target="_blank"><?php echo $row['name']; ?></a></td>
					<td><?php echo $row['request_address'].", ".$row['request_city'];?></td>
					<td><?php if($row['transport']==1) echo "<img src='images/available.png' alt='Deliver' />"; ?></td>
					<td style="text-align:left;">
						<?php echo $row['request_quantity'];?> <?php echo $row['units_type'];?>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php
	}	
	}
else {
		echo "You didn't make any in-kind requests.";
	}
?>
</div>
<div id="request_form" hidden>
<?php include "request_inkind_form.php" ?>
</div>
</td>
</tr>
</table>

	
<!--footer-->
</div>
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>


