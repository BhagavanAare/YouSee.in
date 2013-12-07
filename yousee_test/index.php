<?php session_start();?>
<?php $thispage = "homepage"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
  <HEAD>
  <TITLE>UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  </HEAD>
 <BODY>
 
<!--wrapper-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea-->
<div id="content-main" align="center"> 
<p>United Care Development Services (UC) is a <b>Philanthropy Exchange</b> which provides a wider giving platform through the <b><a href="four_donations.php">Four Donations For Development</a></b> (Chaar Daan, Chaar Dhaam) initiative, which invites contributions in the form of 1.Volunteering(Shram Daan), 2.In Kind Donations(Vastu Daan), 3.Waste Donations (Kachra Daan) and 4.Financial(PostPay) Donations(Dhan Daan). UC's objective is to generate <b>Resources for Result</b> oriented social work, in the areas of Education, Health and Environment.</p>

<div style='float:left; clear:left; align:center; border-style:solid; border-width:1px; border-color:#CCCCCC; margin-top:-5px; margin-bottom:15px; margin-left:15px;'>
	<?php include 'featured_project.php';?>
</div>

<div style='align:center; border-style:solid; border-width:1px; border-color:#CCCCCC; margin-top:-5px; margin-right:15px; margin-bottom:15px; margin-left:500px; '>
	<?php include 'featured_donor.php';?>
</div>

<div style=' width:450px; float:left; clear:left; align:center; border-style:solid; border-width:1px; border-color:#CCCCCC;  margin-top:0px; margin-bottom:15px; margin-left:15px;'>
	<h4 align="center" style='border-style:hidden; margin-top:10px; margin-bottom:5px;'>Four Donations Update</h4>
    <?php include 'featured_graphs_volunteer.php';?><br>
    <?php include 'kind_and_waste_donations_graph.php';?>
    <?php include 'featured_postpay_summary_graph.php';?>
</div>

<div style='align:center;'>
	<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fyouseeupdates&amp;width=400&amp;colorscheme=light&amp;connections=6&amp;stream=true&amp;header=false&amp;height=510" scrolling="yes" frameborder="0" style="border:none; overflow:hidden; width:360px; height:560px;" allowtransparency="true"></iframe>
</div>

</div>
<!--#maincontentarea-->

<!--footer-->
<?php include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

</BODY>
</HTML>