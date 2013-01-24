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
  <link rel="stylesheet" type="text/css" href="css/ajaxtabs.css">
  <SCRIPT type="text/javascript" src="css/ajaxtabs.js"></script>
  <SCRIPT type="text/javascript" src="css/jquery.js"></script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">
	$(document).ready(function(){
		$(".tabContents").hide(); // Hide all tab conten divs by default
		$(".tabContents:first").show(); // Show the first div of tab content by default
		
		$("#tabContaier ul li a").click(function(){ //Fire the click event
			
			var activeTab = $(this).attr("href"); // Catch the click link
			$("#tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
			$(this).addClass("active"); // set clicked link to highlight state
			$(".tabContents").hide(); // hide currently visible tab content div
			$(activeTab).fadeIn(); // show the target tab content div by matching clicked link.
		});
	});
  </script>
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
<? $city = "Hyderabad"; ?>
<h2>Service Institutions at <? echo $city;?></h2>
<p>The maps below gives location of various homes providing shelter and other services to young and old, the disabled and the destitute. These homes are managed with the support of several social work organisations. You are welcome to contact us to know about volunteering opportunities and other ways to support these homes. Move your cursor over the map pointer, to know about the place, the Social Work Organisation managing it and its location.</p>

<div id="tabContaier">
     <ul>
    	<li><a class="active" href="#tab1">Children Homes</a></li>
    	<li><a href="#tab2">Shelter Homes</a></li>
    	<li><a href="#tab3">All Homes</a></li>
    </ul><!-- //Tab buttons -->
    <div class="tabDetails">
    	<div id="tab1" class="tabContents">
             <h1>Children Homes.</h1>
             <p>Children Homes.</p>
             <? include 'report_map_children_homes_city.php'; ?>
        </div><!-- //tab1 -->
    	<div id="tab2" class="tabContents">
    	     <h1>Shelter Homes.</h1>
             <p>Shelter Homes.</p>
             <? include 'report_map_shelter_homes_city.php'; ?>
        </div><!-- //tab2 -->
    	<div id="tab3" class="tabContents">
    	     <h1>All Homes.</h1>
             <p>All Homes.</p>
             <? include 'report_map_all_homes_city.php'; ?>
        </div><!-- //tab3 -->
    </div><!-- //tab Details -->
</div><!-- //Tab Container -->

</div>

 <!--#maincontentarea-->


<!--footer-->
<? include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>