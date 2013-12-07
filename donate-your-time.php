<?php $thispage = "donate-your-time";
header('Location:donate_time.php');
exit();
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
<div id="uccertificate-main">

<p>UC facilitates Volunteers to donate their Time, Effort and Knowledge for various social causes. Listed below are some recent Volunteer activity contributions, conservatively accounted, from 01-Oct-2011. We welcome you to contact us for volunteering opportunities. Please click on the below tabs to see Volunteering Opportunities available or visit this <a href="maps_hyderabad.php" target="_blank">link</a>, to see <a href="maps_hyderabad.php" target="_blank">places</a> where you could volunteer.</p>
<ul id="uccertificates" class="shadetabs">
<li><a href="dashboard_volunteer.php" class="selected" rel="uccertificatescontainer">Volunteer Contributions Summary</a></li>
<li><a href="volunteer_opportunities_list.php" rel="uccertificatescontainer">Volunteering Opportunities</a></li>
<li><a href="volunteer_contributions_list.php" rel="uccertificatescontainer">Volunteer Contributions - some examples</a></li>
</ul>

<div id="uccertificatescontainer" style="border:1px solid gray; margin-bottom: 1em; padding: 5px">

<script type="text/javascript">
var countries=new ddajaxtabs("uccertificates", "uccertificatescontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
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