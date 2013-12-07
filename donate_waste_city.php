<?php 
$city = $_GET['city'];
$thispage = "donate_waste";
$activetab=$city."ReqTab";
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
<?php session_start();
?>
<?php include 'header_navbar.php';?>

<div id="uccertificate-main">

<table>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
	<?php include 'uc_donatewaste_tabs.php'; ?>
</div>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px;" >
<h4 style="padding-left:0px;">Donate Waste at <?php echo ucwords($city);?></h4>
<div><p>The map below gives shows places where Donations Camps for donating Recyclable or Reusable items are organised and also places where C Gardens (Composting Centers) have been set up.</p></div>
<div align="center"><?php 
	include 'report_map_compost_centers_city.php';
?></div>
<div>
<?php 
include 'whereCanYouDonate.php';?>
</div>
</td>
</tr>
</table>

<!--footer--></div>


<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
