<?php session_start();?>
<?php $thispage = "donate_time"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script>window.jQuery || document.write('<script src="css/jquery.js"><\/script>')</script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")
        return false;
      });
    });
  });
 </script>
  </HEAD>
 <BODY>

<!--wrapper begin-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->
<div id="uccertificate-main">

<p>UC facilitates Volunteers to donate their Time, Effort and Knowledge for various social causes. Listed below are some recent Volunteer activity contributions, conservatively accounted, from 01-Oct-2011. We welcome you to contact us for volunteering opportunities. Please click on the below tabs to see Volunteering Opportunities available or visit this <a href="maps_hyderabad.php" target="_blank">link</a>, to see <a href="maps_hyderabad.php" target="_blank">places</a> where you could volunteer.</p>

<div class="tab-box">
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">Volunteer Contributions Summary</a>
    <a href="javascript:;" class="tabLink " id="cont-2">Volunteering Opportunities</a>
    <a href="javascript:;" class="tabLink " id="cont-3">Volunteer Contributions - some examples</a>
</div>

<div class="tabcontent paddingAll" id="cont-1-1">
	<?php include 'dashboard_volunteer.php';?>
</div>

<div class="tabcontent paddingAll hide" id="cont-2-1">
	<?php include 'volunteer_opportunities_list.php';?>
</div>
  
<div class="tabcontent paddingAll hide" id="cont-3-1">
	<?php include 'volunteer_contributions_list.php';?>
</div>

</div>
<!--maincontentarea end-->


<!--footer-->
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>