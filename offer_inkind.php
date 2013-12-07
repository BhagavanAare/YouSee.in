<?php $thispage = "offer_inkind";
require_once('login_auth.php');
 $activetab="In Kind";	 
if (!$_SESSION['SESS_USER_TYPE']=="D")
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
  <link rel="stylesheet" type="text/css" href="css/div.css">
  <link rel="stylesheet" type="text/css" href="css/inkind_items.css">
  <link rel="stylesheet" href="scripts/jquery-ui.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker_ngo.js"></script>		

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
		$("#offer_button").click(function(){
			$("#offer_form").show();
			$("#requests_inkind").hide();
			});
		$("#existing").click(function(){
			$("#offer_form").hide();
			$("#requests_inkind").show();
			});
		});
		
</script>
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<div id="content-main">
<!--maincontentarea begin-->


<table style="margin-bottom:40px;">
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
<?php include "myucTabs.php"; ?>
</div>
</td>
<td>
<input type="button" value="Make a new offer" id="offer_button" style="margin-right:40px;"/>
<input type="button" value="View my existing offers" id="existing" style="margin-left:40px;"/>
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
$request_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN donors on kind_donations.donor_id=donors.donor_id
				WHERE kind_donations.donor_id=".$_SESSION['SESS_DONOR_ID'];
$request_ex=mysql_query($request_query);
if(mysql_num_rows($request_ex)>0){
?>
<div class='itemcontainer' id="requests_inkind">
<?php 
echo "<h3>You offered..</h3>";
echo "<table class='table-item' style='width:750px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:30px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Offered By</th>
			<th>Address</th>
			<th>Transport</th>
			<th>I Commited..</th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($request_ex)){	?>
	<div class="postedComment" id="<?php echo $row['donation_id']; ?>">
		<div class="itemdiv <?php echo $row['category']; ?>" id="item<?php echo $row['donation_id']; ?>">
			<table class="table-item">
				<tr>
					<td style="padding-left:0px;font-size:12px;font-weight:bold;"><?php echo $row['donationitem']; ?></td>
					<td><?php echo $row['request_quantity']." ".$row['units_type']; ?></td>
					<td><a href="<?php echo $row['preferred_email']; ?>" target="_blank"><?php echo $row['displayname']; ?></a></td>
					<td><?php echo $row['offer_address'].", ".$row['offer_city'];?></td>
					<td><?php if($row['transport']==1) echo "<img src='images/available.png' alt='Deliver' />"; ?></td>
					<td style="text-align:left;">
						<?php echo $row['offer_quantity'];?> <?php echo $row['units_type'];?>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php
	}}
else {
		echo "You didn't make any in-kind offers.";
	}
?>
</div>
<div id="offer_form"hidden>
<?php include "offer_inkind_form.php" ?>
</div>
</td>
</tr>
</table>

	
<!--footer-->

<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>


