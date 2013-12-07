<?php session_start();?>
<?php $thispage = "donate_in_kind"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate in Kind | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/ajaxtabs.css">
  <SCRIPT type="text/javascript" src="css/ajaxtabs.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
<p>You can donate Old or New, Books, Computers/Laptops, Clothes and Other items at several <a href="maps_hyderabad.php" target="_blank">Donation Camps</a> organised by UC once a month. These items are distributed to students and NGOs working with the underprivileged. So if you have old items gathering dust or you prefer to donate in kind rather than donating in cash, you are welcome to come and donate at these <a href="maps_hyderabad.php" target="_blank">places</a>. The tabs below present information about various kind donations received and where they have been deployed.</p>

  <div class="tab-box">
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">Computers/Laptops</a>
    <a href="javascript:;" class="tabLink " id="cont-2">Books</a>
    <a href="javascript:;" class="tabLink " id="cont-3">Other Items</a>
  </div>


  <div class="tabcontent paddingAll" id="cont-1-1">
	<p>The following computers/lapstops have been donated by different donors and distributed to various NGOs to support their activities. NGOs who may need support in this area can contact UC.<p>
	<?php include 'report_asset_donations_list.php';?>
  </div>

  <div class="tabcontent paddingAll hide" id="cont-2-1">
	<p>During the monthly donation camps held currently at Hyderabad, we receive several reusable books which are distributed to students or NGOs working with underprivileged children. We look forward to start this initiative in all the major cities of India too. Please do contact 9000183123 or gunaranjan@yousee.in for information on this initiative. We are currently working on developing IT applications to improve presentation of information of books donated and distributed. Given below are live updates of donations received at Hyderabad through this initiative.</p>
	<?php include 'books_bar.php';?>
  </div>

  <div class="tabcontent paddingAll hide" id="cont-3-1">
  <p>You can also donate Clothes and other items which are usable or reusable by NGOs, at the donation camps. In case these items are bulky and large in size, we request you to send photographs of such items along with thier specifications. Such details would be shared with NGO partners. In case such items are needed by any of the NGOs, we could coordinate for you to send the large size items directly to the NGO.<p>
  <!-- <p>The following items are available for donation to NGOs. NGOs who may need any one of these items can contact UC:<p>-->
  <?php //include 'report_assets_for_donation_list.php';?>
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