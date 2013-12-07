<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_DONOR_ID']);
?>

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
<?php include 'navbar.php' ;?>
<!--#navbar-->

<!--maincontentarea-->
<div id="content-main">
<p align="center">&nbsp;</p>
<h4 align="center" class="err">You have been logged out.</h4>
<p align="center">Click here to <a href="login-form.php">Login</a></p>

<!--#maincontentarea-->

<!--footer-->
<? include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>