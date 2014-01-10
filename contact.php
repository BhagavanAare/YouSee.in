<?php session_start();?>
<?php $thispage = "contact"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Contact UC | UC is a new initiative to channel investments to Education, Health and Energy & Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
  </script>
  </HEAD>
 <BODY>
 
<!--wrapper-->
<div id="wrapper">
 
<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea-->
<div id="content-main">
<h1>Contact UC</h1>
<p>For more information about UC, please contact us at <a href="mailto:gunaranjan@yousee.in">gunaranjan@yousee.in</a></p>
<p>Phone: +91-9-000-183-123 or +91-8008-884422</p> 
<p>Project Office: 6-3-668/10/2, First Floor, Durganagar Colony, Panjagutta, Hyderabad-500082</p>
<p>Registered Office: 9/29, Prashanth Nagar, Boduppal Road, Uppal, Hyderabad-500039</p>
<!--<a href="login-form.php">Donor & Volunteer Login</a>-->
<br>
<!--<a href="main_login.php">UC Login</a>-->
<!--<a href="login_health.php">Health Project Login</a>-->
  <style>
      #map_canvas {
        width: 500px;
        height: 400px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
    	
      function initialize() {
         var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(17.42595, 78.45398),
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options)
        var marker = new google.maps.Marker({
  		position: new google.maps.LatLng(17.42595, 78.45398),
  		map: map,
  		
	});
        
	
        
        
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
 
  
<div id="map_canvas" style="width: 750px; height: 400px; margin:20px;"></div>
  


<div align="center">
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