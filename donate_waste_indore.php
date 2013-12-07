<?php session_start();?>
<?php $thispage = "donate_waste";
$activetab="IndoreReqTab";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Waste| Donation Summary</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="test/test.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
	<link rel="stylesheet" href="css/table.css">
	
	
  <html lang="en">
	<head>

</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<div id="uccertificate-main">

<table>
<td valign="top">
<div class="left_div" style=" float:left" >
	<?php include 'uc_donatewaste_tabs.php'; ?>
</div>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >
<h4><p> Donate Waste at Indore</p></h4>

<table cellpadding="3%"  width="600px">	
 <div style="float:left">
  <?php include 'dashboard_donatewaste_indore.php';?>
 </div>
<div style="float:left"><p> The map below gives shows cities where Donations Camps for donating Recyclable or Reusable items are organised and also places where C Gardens (Composting Centers) have been set up.. </p></div>
<div style="float:left" align="center"><?php 
	$city = "Indore";
	include 'report_map_compost_centers_city.php';
?></div>
<div>
<?php 
	$city = "Indore";
include 'whereCanYouDonate.php';?>
</div>


 </table>
</table>
<!--footer-->
</div>

<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
