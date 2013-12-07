<?php
	require_once('auth.php');
?>
<? $thispage = "myuc"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC is a new initiative to channel investments to Education, Health and Energy & Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  </HEAD>
 <BODY>

<!--wrapper-->
<div id="wrapper">

<div id="header"><!--header-->
<img src="uc-logo.jpg" />
</div><!--#header-->

<!--navbar-->
<?php include 'navbar_myuc.php' ;?>
<!--#navbar-->

<!--maincontentarea-->
<div id="content-main">

<h2>Welcome <?include 'reports/display_donor_info.php';?>, your Donor ID is: <?php echo $_SESSION['SESS_DONOR_ID'];?></h2>
<a href="logout_test.php">Logout</a>
<br>
<table border="0" width="100%">
<tr>
<td align="center" width="50%"><?include 'reports/volunteer_personal_contributions_graph.php';?></td>
<td align="center" width="50%"><?include 'reports/finance_personal_contributions_graph.php';?></td>
</tr>
<tr>
<td align="center" width="50%"><?include 'reports/donatewaste_graph_total_kg_personal.php';?></td>
<td align="center" width="50%"></td>
</tr>
<table>

<br/>My Volunteering Contributions<br/>
<? include 'reports/volunteer_personal_contributions_list.php';?>

<br/>My Financial Donations<br/>
<? include 'reports/finance_personal_contributions_list.php';?>

<br/>My Waste Donations<br/>
<table border="0" width="100%">
<tr>
<td align="center" width="50%"><?include 'reports/donatewaste_graph_kg_personal.php';?></td>
<td align="center" width="50%"><?include 'reports/donatewaste_graph_rs_personal.php';?></td>
</tr>
<table>

</div>

<!--#maincontentarea-->

<!--footer-->
<? include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>