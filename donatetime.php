<? //$thispage = "uccertificates-acquired"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC Project Certificates</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/ajaxtabs.css">
  <SCRIPT type="text/javascript" src="css/ajaxtabs.js"></script>
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
<table border="0" width="100%">
<tr>
<td align="center" width="50%"> <?include 'featured_graphs_volunteer.php';?></td>
<td align="center" width="50%"><?include 'volunteer_time_bar.php';?></td>
</tr>
<table>
 </div>

<div id="uccertificate-main">

<p>The work and achievements at UC have been made possible with the constant support from several Volunteers, who have donated their Time, Effort and Knowledge for UC and its projects. Listed below are some recent Volunteer activity contributions, conservatively accounted, from 01-Oct-2011. We welcome you to contact us, for volunteering opportunities with UC.</p>

<br/><p>Please click on the below tabs to see Volunteering Contributions received so far and also Volunteering Opportunities available</p>
<br/>
<ul id="uccertificates" class="shadetabs">
<li><a href="volunteer_contributions_list.php" class="selected" rel="uccertificatescontainer">Volunteer Contributions Received</a></li>
<li><a href="volunteer_opportunities_list.php" rel="uccertificatescontainer">Volunteering Opportunities</a></li>
</ul>

<div id="uccertificatescontainer" style="border:1px solid gray; margin-bottom: 1em; padding: 5px">
<? //include ('volunteer_contributions_list.php');?>


<script type="text/javascript">
var countries=new ddajaxtabs("uccertificates", "uccertificatescontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
</div>
</div>
<!--#maincontentarea-->

<!--bottomcontentarea-->
<!-- <div id="content-bottom">
<div align="center">
</div>
</div> -->
<!--#bottomcontentarea-->

<!--footer-->
<? include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>