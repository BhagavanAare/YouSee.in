<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_DONOR_ID']);
	session_destroy();
?>
<?php $thispage = ""; ?>
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

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea-->
<div id="content-main">
<p align="center">&nbsp;</p>
<h4 align="center" class="err">You have been logged out.</h4>
</div>
<!--#maincontentarea-->

<!--footer-->
<?php include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>