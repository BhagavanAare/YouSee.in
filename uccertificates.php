<?php session_start();?>
<?php $thispage = "uccertificates"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
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

<!--wrapper-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea-->
<div id="uccertificate-main">
<p>The fourth form of giving promoted by UC, the PostPay Phinlanthropy model, works by prefunding of projects from UC's corpus, followed by measurement and documentation of results from such projects. Individuals and Organisations can now make postpay donations to take credit for these results and also tax benefits. All donations to UC receive tax benefits under section 80G of the Income Tax Act, 1961.</p>
<br/>


 <div class="tab-box">
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">View Projects</a>
    <a href="javascript:;" class="tabLink " id="cont-2">Last 100 Donations</a>
    <a href="javascript:;" class="tabLink " id="cont-3">Quarterwise Donations</a>
	<a href="javascript:;" class="tabLink " id="cont-4">I Wish To Donate</a>
 </div>


  <div class="tabcontent paddingAll" id="cont-1-1">
  <?php include 'uc_certificates.php';?>
  </div>

  <div class="tabcontent paddingAll hide" id="cont-2-1">
  <?php include 'report_postpaid_last100.php';?>
  </div>
  
  <div class="tabcontent paddingAll hide" id="cont-3-1">
  <?php include 'report_donations_quarterwise.php';?>
  </div>
  
  <div class="tabcontent paddingAll hide" id="cont-4-1">
  <?php include 'postpay.php';?>
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
<?php include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>