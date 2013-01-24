<? $thispage = ""; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Books | UC is a new initiative to channel investments to Education, Health and Energy & Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="Equipment Tracker -- UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  </HEAD>
 <BODY>

<!--wrapper-->
<div id="wrapper">

<div id="header"><!--header-->
<img src="uc-logo.jpg" />
</div><!--#header-->

<!--navbar-->

<!--#navbar-->

<!--maincontentarea-->
<div id="content-main">
<h1>Equipment Status and Tracker</h1>

<style type="text/css">
<!-- 
.box { 
background-color: #F4F4F4; 
border: 1px solid #CCC; 
height: 100px; 
width: 200px; 
padding: 5px; 
display:none; 
position:absolute; 
} 

--> 
</style> 
<script type="text/javascript" language="JavaScript"> 
var cX = 0; var cY = 0; var rX = 0; var rY = 0; 
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;} 
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;} 
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; } 
else { document.onmousemove = UpdateCursorPosition; } 
function AssignPosition(d) { 
if(self.pageYOffset) { 
rX = self.pageXOffset; 
rY = self.pageYOffset; 
} 
else if(document.documentElement && document.documentElement.scrollTop) { 
rX = document.documentElement.scrollLeft; 
rY = document.documentElement.scrollTop; 
} 
else if(document.body) { 
rX = document.body.scrollLeft; 
rY = document.body.scrollTop; 
} 
if(document.all) { 
cX += rX; 
cY += rY; 
} 
d.style.left = (cX+10) + "px"; 
d.style.top = (cY+10) + "px"; 
} 
function HideText(d) { 
if(d.length < 1) { return; } 
document.getElementById(d).style.display = "none"; 
} 
function ShowText(d) { 
if(d.length < 1) { return; } 
var dd = document.getElementById(d); 
AssignPosition(dd); 
dd.style.display = "block"; 
} 
function ReverseContentDisplay(d) { 
if(d.length < 1) { return; } 
var dd = document.getElementById(d); 
AssignPosition(dd); 
if(dd.style.display == "none") { dd.style.display = "block"; } 
else { dd.style.display = "none"; } 
} 
//--> 
</script> 

<?include 'display_health_equipment.php';?>

<!--#maincontentarea-->

<!--footer-->
<? include 'footer.php' ; ?>
<!--#footer-->

 </div>
 <!--#wrapper-->

 </BODY>
</HTML>