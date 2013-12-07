<?php session_start();?>
<?php $thispage = "homepage"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
  <HEAD>
  <TITLE>UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src="scripts/jquery.min.js"></script>
  <link rel="stylesheet" href="css/slideshow.css">
	<script src="scripts/slides.min.jquery.js"></script>
  <script type="text/javascript">
$(document).ready(function() { 
		$("#volunteers").delay(500).fadeIn(1900);
		$("#npo").delay(1000).fadeIn(1000);
		$("#provide").delay(2000).slideDown(1000);
		$("#resources").delay(3000).slideDown(1000);
		$(".fourd").delay(3000).slideDown(1000);
		$("#enabled").delay(4000).slideDown(1000);
		$(".philanthropy").delay(5000).fadeIn(1000);
		$("#fornpo").delay(6000).slideDown(1000);
		$("#forresults").delay(7000).slideDown(1000);
		$("#results").delay(8000).slideDown(1000);
		$(".resultimg").delay(8000).fadeIn(1000);	
		$(".areatext").delay(8000).slideDown(100);

	});
			
  </script>
  <style>
  .model_container{
	height:270px;
	position:relative;
	width:1000px;
	border-radius:0.6em;
	border:1px solid #eee;
	cursor:default;
	}
  .volunteers{
	margin-left:15px;
	width:150px;
	height:270px;
	float:left;
	background:url('images/volunteers.png');
	background-repeat:no-repeat;
	background-position:10px 50px;
	display:none;
}
  .fourd{	
	width:60px;
	height:60px;
	left:280px;
	margin-right:300px;
	border-radius:0.1em;
	position:absolute;
	float:left;
	border:1px solid #ccc;
	opacity:0.8;
	color:black;
	cursor:pointer;
	transition:opacity 2s;
	display:none;
	}
	.time{
	top:10px;
	background:url('images/donate_time.png');
	background-color:#eee;
	background-size:100%;
	background-repeat:no-repeat;
	}
	.kind{
	top:75px;
	background:url('images/donate_kind.png');
	background-color:#eee;
	background-size:100%;
	background-position:bottom;
	background-repeat:no-repeat;
	}
	.waste{
	top:140px;
	background:url('images/donate_waste.png');
	background-color:#eee;
	background-size:100%;
	background-repeat:no-repeat;
	}
	.postpay{
	top:205px;
	background:url('images/donate_postpay.png');
	background-color:#eee;
	background-size:100%;
	background-repeat:no-repeat;
	}
	.fourd:hover{
			box-shadow:0px 0px 3px #666;
			opacity:1;
	}
.vertical_text {
	padding:0px;
	margin:0px;
	font-size:40px;
	margin-left:95px;
	position:absolute;
	float:left;
    -moz-transform:rotate(-90deg); 
    -moz-transform-origin: bottom right;
    -webkit-transform: rotate(-90deg);
    -webkit-transform-origin: bottom right;
    -o-transform: rotate(-90deg);
    -o-transform-origin: bottom right;
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
	opacity:0.5;
	display:none;
}
.resultimg{
	width:80px;
	position:absolute;
	opacity:0.9;
	left:890px;
	display:none;
}
.sdown{
	display:none;
}
.areatext{
	display:none;
}
	</style>
  </HEAD>
 <BODY>
 
<!--wrapper-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea-->
<div id="content-main" > 
<div class="model_container">
<div class="volunteers" id="volunteers"></div>
<div style="color:#999;font-size:150px;float:left;position:absolute;left:170px;top:20px;" class="sdown" id="provide"> &raquo <br /><font style="margin-top:-50px;position:absolute;left:10px;font-size:14px;">provide</font> </div>
<p class="vertical_text resources" style="top:20px;" id="resources">Resources</p>
<a href="donate_time.php" style="text-decoration:none;" id="time">
	<div class="fourd time">
		<h3 style="color:#000;font-size:14px;padding:0px;margin:5px;cursor:pointer;	text-shadow:5px 5px 10px white;" align="center">Donate Time</h3>
	</div>
</a>
<a href="donate_in_kind.php" style="text-decoration:none;" id="kind">
	<div class="fourd kind" >
		<h3 style="color:#000;font-size:14px;padding:0px;margin:5px;cursor:pointer;text-shadow:5px 5px 10px white;" align="center">Donate In Kind</h3>
	</div>
</a>
<a href="donate_waste.php" style="text-decoration:none;" id="waste">
	<div class="fourd waste">
		<h3 style="color:#000;font-size:14px;padding:0px;margin:5px;cursor:pointer;text-shadow:5px 5px 10px white;" align="center">Donate Waste</h3>
	</div>
</a>
<a href="donate_postpay.php" style="text-decoration:none;" id="postpay">
	<div class="fourd postpay">
		<h3 style="color:#000;font-size:14px;padding:0px;margin:5px;cursor:pointer;text-shadow:5px 5px 10px white;" align="center">Donate Postpay</h3>
	</div>
</a>
<div style="color:#999;font-size:150px;float:left;position:absolute;left:360px;top:20px;"  id="enabled" class="sdown"> &raquo <br /><font style="margin-top:-50px;position:absolute;left:10px;font-size:14px;width:70px;">enabled through</font> </div>
<img src="images/uc-logo.png" alt="YouSee" style="width:130px;position:absolute;left:450px;top:50px;" id="uclogo" />
<font style="position:absolute;font-size:12px;left:450px;top:200px;display:none;" class="philanthropy">A Philanthropy Exchange</font>
<div style="color:#999;font-size:150px;float:left;position:absolute;top:0px;left:580px;top:20px;"  id="fornpo" class="sdown"> &raquo <br /><font style="margin-top:-50px;position:absolute;left:20px;font-size:14px;">for</b></font> </div>
<div id="npo" style="display:none;"><font style="font-size:30px;color:#369;text-shadow:0px 0px 1px #666;position:absolute;left:670px;top:90px;"><a href="npo.php">NPOs</a> <br /><font style="font-size:11px;">(Non Profit<br /> Organizations)</font></font></div>
<br />

<img class="resultimg" id="education" src="images/Education.png" alt="Education" style="top:10px;" />
<font style="position:absolute;font-size:12px;left:900px;top:80px;" class="areatext">Education</font><br />
<img class="resultimg" id="health" src="images/Health.png" alt="Health" style="top:110px;" />
<font style="position:absolute;font-size:12px;left:910px;top:160px;" class="areatext">Health</font><br />
<img class="resultimg" id="environment" src="images/Environment.png" alt="Environment" style="top:180px;" />
<font style="position:absolute;font-size:12px;left:900px;top:250px;" class="areatext">Environment</font><br />

<div style="color:#999;font-size:150px;float:left;position:absolute;top:20px;left:760px;display:none;"  class="sdown" id="forresults" > &raquo <br /><font style="margin-top:-50px;position:absolute;left:20px;font-size:14px;">for</font> </div>
<div class="vertical_text results" style="top:20px;left:640px;" id="results">Results<font style="font-size:20px;"> in</font></div>
</div>
<p style="color:#666;font-family:Trebuchet MS;font-size:1em;width:1000px;">
<b>United Care Development Services</b> (UC) is a <b>Philanthropy 
Exchange</b> which provides a wider giving platform through 
the <a href="four_donations.php">Four Donations For Development</a>
 (Chaar Daan, Chaar Dhaam) initiative, which invites contributions 
in the form of 
<ol style="line-height:20px;"><li><a href="donate_time.php">Volunteering(Shram Daan)</a></li>
<li><a href="donate_in_kind.php">In Kind Donations(Vastu Daan)</a></li>
<li><a href="donate_waste.php">Waste Donations (Kachra Daan)</a></li>
<li><a href="donate_postpay.php">Financial(PostPay) Donations(Dhan Daan)</a></li></ol> 
UC's objective is to generate <b>Resources for Result</b> oriented social work, in the areas of Education, Health and Environment.</p>


<div>
	<?php include 'featured_donor.php';?>
</div>

<div style='float:right;'>
	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FYouSeeUpdates&amp;width=500&amp;height=590&amp;colorscheme=light&amp;connections=7&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=false&ampheight:500;" scrolling="no" frameborder="0" style="border:1px solid #ccc; overflow:hidden; width:400px; height:480px; margin-top:15px;" allowTransparency="true"></iframe>
</div>

<div>
	<?php include 'featured_project.php';?>
</div>
<!--#maincontentarea-->
</div>

<!--footer-->
<!--#footer-->
 <!--#wrapper-->
<?php include 'footer.php' ; ?>
</div>

</BODY>
</HTML>
