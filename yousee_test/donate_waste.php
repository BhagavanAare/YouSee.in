<?php session_start();?>
<?php $thispage = "donate_waste"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Waste | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
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

<p>"<b>Do not Waste, Donate your Waste</b>" / "<b>Kachra Daan, Karo Kalyan</b>" is a citizen driven waste management initiative promoted by UC. We welcome you, your neighbours and your organisation to participate in this initiative. This initiative commenced in October 2010. Given below are live updates of waste donations received at different cities through this initiative, since inception. To know more and to participate in this initiative call +91-9000183123 or write to donateyourwaste@yousee.in</p>

<div class="tab-box">
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">All Cities</a>
    <a href="javascript:;" class="tabLink " id="cont-2">Hyderabad</a>
    <a href="javascript:;" class="tabLink " id="cont-3">Indore</a>
	<a href="javascript:;" class="tabLink " id="cont-4">Bhopal</a>
 </div>


 <div class="tabcontent paddingAll" id="cont-1-1">
  <?php include 'dashboard_donatewaste_allcities.php';?>
 </div>

 <div class="tabcontent paddingAll hide" id="cont-2-1">
  <?php include 'dashboard_donatewaste_hyderabad.php';?>
 </div>
  
 <div class="tabcontent paddingAll hide" id="cont-3-1">
  <?php include 'dashboard_donatewaste_indore.php';?>
 </div>
 
  <div class="tabcontent paddingAll hide" id="cont-4-1">
  <?php include 'dashboard_donatewaste_bhopal.php';?>
  </div>


<p>The map below gives locations of communities which are composting their organic waste with support from Volunteers and Partner Organisations. Move your cursor over the map pointer to know about the Community and the Location where a C Garden (Compost Garden) has been set up, to promote local composting of green and organic waste, without burning or transporting them to landfills.</p>
<div align="center"><?php include 'report_map_compost_centers.php';?></div>

<script type="text/javascript">
function reveal(a){
var e=document.getElementById(a);
if(!e)return true;
if(e.style.display=="none"){
e.style.display="block"
} else {
e.style.display="none"
}
return true;
}
</script>

<table border="0" bgcolor="#F8F8F8" width="100%" style="cursor:pointer;" onclick="reveal('para1'); return false" >
<tr><td><h2>Presentation on "Do not Waste, Donate your Waste" initiative</h2></td></tr>
</table>
<div id="para1"; style="display:none">
<div style="width:425px" id="__ss_8846923" align="center"> <strong style="display:block;margin:12px 0 4px"><a href="http://www.slideshare.net/YouSeePresents/do-not-waste-donate-your-waste" title="Do not Waste, Donate your Waste" target="_blank">Do not Waste, Donate your Waste</a></strong> <iframe src="http://www.slideshare.net/slideshow/embed_code/8846923" width="637" height="532" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe> <div style="padding:5px 0 12px"> View more <a href="http://www.slideshare.net/" target="_blank">presentations</a> from <a href="http://www.slideshare.net/YouSeePresents" target="_blank">YouSee</a> </div> </div>
</div>
<br>

<table border="0" bgcolor="#F8F8F8" width="100%" style="cursor:pointer;" onclick="reveal('para2'); return false" >
<tr><td><h2>Why donate your Waste?</h2></td></tr>
</table>
<div id="para2"; style="display:none">
<p>We can easily achieve three goals by donating our waste which is segregated.</p>
<ol>
<li>Most of it can be <b><FONT color=#555555>Recycled</FONT></b>, thereby preventing it from reaching landfills and polluting the environment.</li>
<li>The value generated from the recycled waste would be deployed for providing services to people like RagPickers and other very poor households, like paying for their children's school fees, providing them health services etc.</li>
<li>Items which can be <b><FONT color=#555555>Reused</FONT></b>, like Clothes and <b><a href="donatebooks.php">Books</a></b>, will be given to the underprivileged and students, direclty and through NGOs working for them.</li>
</ol>
<p>So the next time before we throw away a piece of paper or a polythene wrapper or any other waste, pause for a moment, and choose to donate it rather than throwing it away.</p>
</div>
<br>

<table border="0" bgcolor="#F8F8F8" width="100%" style="cursor:pointer;" onclick="reveal('para3'); return false" >
<tr><td><h2>How does it work?</h2></td></tr>
</table>
<div id="para3"; style="display:none">
<p>
<p>Various companies, housing colonies and apartment complex associations and other partnering organisations set up in their premises waste bins to collect segregated dry waste. Residents at these locations can donate their segregated dry waste into these designated bins. There are also common places where anybody can donate their segregated dry waste on specifics dates. <b><FONT color=#555555>Reusable</FONT></b> items donated like Clothes and <b><a href="donatebooks.php">Books</a></b> are listed on UC's website. NGOs working for the underprivileged and Students who may need one or more of these items are welcome to contact UC to request and receive these donated items. <b><FONT color=#555555>Recyclable</FONT></b> material is given to recyclers and value generated from this waste is used to provide services to the poor and the disadvantaged.  So, do not waste, donate your waste.</p>
</p>
</div>
<br>

<table border="0" bgcolor="#F8F8F8" width="100%" style="cursor:pointer;" onclick="reveal('para4'); return false" >
<tr><td><h2>What waste can you donate?</h2></td></tr>
</table>
<div id="para4"; style="display:none">
<p>Various forms of dry waste including paper/books, plastic/polythene, clothes, electrical/electronic waste etc can be donated. In communities which are willing to set aside some space for composting of organic/wet waste, UC helps to set up composting centers called as C Gardens. The compost generated from these centers can be used as manure for gardening wihtin the community or donated for other communities.</p>
</div>
<br>

<table border="0" bgcolor="#F8F8F8" width="100%" style="cursor:pointer;" onclick="reveal('para5'); return false" >
<tr><td width="100%"><h2>Where can you donate? (for Individuals)</h2></td></tr>
</table>
<div id="para5"; style="display:none">
<p>Here are some common public donation points at Hyderabad where anyone can come and donate thier dry waste on specifica dates. We are looking to add more such public donation points. If you would like to help indentify such donation points which would be convinient and accessible to the general public, you could let us know. You may contact us by Email: gunaranjan@yousee.in or by Phone: +91-9000182123 or +91-8008-884422</p>
<table border="1">
<tr><td>S No</td><td>Donation Points at Hyderabad</td><td>Donation Point Address</td><td>Donation Date</td><td>Donation Timing</td></tr>
<tr><td>1</td><td>Chikkadpally</td><td>Aurora Degree College</td><td>Last Saturday, Every Month</td><td>10.00 AM to 12.00 PM</td></tr>
<tr><td>2</td><td>Padmarao Nagar</td><td>SEVA Office, Kowtha Swarajya Vihar, 10 Padmarao Nagar, Secunderabad(opposite Fresh Supermarket)</td><td>Last Saturday, Every Month</td><td>10.00 AM to 12.00 PM</td></tr>
<tr><td>3</td><td>Panjagutta</td><td>Aurora's Business School, 6-3-456/18 & 19, Dwarakapuri Colony, Panjagutta (Near NIMS Hospital)</td><td>Last Sunday, Every Month</td><td>10.00 AM to 12.00 PM</td></tr>
</table>
</div>
<br>


<table border="0" bgcolor="#F8F8F8" width="100%" style="cursor:pointer;" onclick="reveal('para6'); return false" >
<tr><td><h2>Who are donating? (Residential Communities and Offices)</h2></td></tr>
</table>
<div id="para6"; style="display:none">
<p>Here are some Offices and Residential Communities who are donating thier waste. If your Office or Residential Community would like to join this initiative and contribute, please do let us know. You may contact us by Email: gunaranjan@yousee.in or by Phone: +91-9000182123 or +91-8008-884422</p>
<table border="1">
<tr><td><b>S No</b></td><td><b>Office</b></td><td><b>City</b></td><td><b>Location</b></td></tr>
<tr><td>1</td><td>AVIVA</td><td>Hyderabad</td><td>Somajiguda</td></tr>
<tr><td>2</td><td>BASIX</td><td>Hyderabad</td><td>Banjara Hills</td></tr>
<tr><td>3</td><td>BASIX</td><td>Hyderabad</td><td>Koti</td></tr>
<tr><td>4</td><td>Invesco</td><td>Hyderabad</td><td>Rayadurgam</td></tr>
<tr><td>5</td><td>Royal Sundaram</td><td>Hyderabad</td><td>Somajiguda</td></tr>
<tr><td>6</td><td>Synopsys</td><td>Hyderabad</td><td>Kondapur</td></tr>
<tr><td><b>S No</b></td><td><b>Residential Community</b></td><td><b>City</b></td><td><b>Location</b></td></tr>
<tr><td>1</td><td>HillRidge Springs</td><td>Hyderabad</td><td>Gachibowli</td></tr>
<tr><td>2</td><td>Serene County</td><td>Hyderabad</td><td>Gachibowli</td></tr>
<tr><td>3</td><td>Trendset Towers</td><td>Hyderabad</td><td>Gachibowli</td></tr>
<tr><td>4</td><td>Mahalaxminagar Residents Welfare Association</td><td>Indore</td><td>MahalaxmiNagar</td></tr>
<tr><td>5</td><td>KalandiKunj Residents Welfare Association</td><td>Indore</td><td>Piplayana Square</td></tr>

</table>
</div>
<br>

<table border="0" bgcolor="#F8F8F8" width="100%" style="cursor:pointer;" onclick="reveal('para8'); return false" >
<tr><td><h2>To help / for help - Contact</h2></td></tr>
</table>
<div id="para8"; style="display:none">
<p>e-mail: <a href="mailto:donateyourwaste@yousee.in">donateyourwaste@yousee.in</a>,<br>
SMS or Call: <Call> to 91-8008-884422 or<br>
Call: Mr. Gunaranjan 91-9000183123 or Mr. Ramachandra 91-9704123669<br>

For Waste Donation at Indore, MadhyaPradesh - Contact UC partner Indian Grameen Services<br>
Call: Mr. Mitesh 91-9826262621 or Mr. Deepak 91-9827297568</p>
</div>
<br>

</div>

 <!--#maincontentarea-->


<!--footer-->
<?php include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>