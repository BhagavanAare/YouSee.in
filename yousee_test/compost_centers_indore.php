<? $thispage = ""; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Contact UC | UC is a new initiative to channel investments to Education, Health and Energy & Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
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
<div id="uccertificate-main">
<? $city = "Indore"; ?>
<h2>C Gardens (Compost Gardens) at <? echo $city;?></h2>
<p>The map below gives locations of communities at <? echo $city;?> which are composting their organic waste with support from UC Volunteers and Partner Organisations. Move your cursor over the map pointer to know about the Community and the Location where a C Garden (Compost Garden) has been set up, to promote local composting of green and organic waste, without burning or transporting them to landfills.</p>
<div align="center">
<?include 'report_map_compost_centers_city.php';?>
</div>



</div>

 <!--#maincontentarea-->


<!--footer-->
<? include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>