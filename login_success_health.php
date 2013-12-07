<?
session_start();
if(!session_is_registered(myusername)){
header("location:health_login.php");
}
// Check if session is not registered , redirect back to main page.
// Put this code in first line of web page.
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC is a new initiative to channel investments to Education, Health and Energy & Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is a new initiative to channel investments to Education, Health and Energy&Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script>window.jQuery || document.write('<script src="scripts/jquery.min.js"><\/script>')</script>

<script type="text/javascript">
//javascrip for tabs
$(document).ready(function() {
	$("#equipmentTr").hide();
	$("#departmentTr").hide();
	$("#outputOfEquipment").hide();
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
	
	var urlForHospitalList = '/getHospitalListAsJson.php';
	
	$.getJSON(urlForHospitalList, function(json){
		var options = '';
		var hospitalList = json.hospitalList;
		for (var i = 0; i < hospitalList.length; i++){
		   options += '<option value="' + hospitalList[i].id + '">' +hospitalList[i].name + '</option>';
		}
		$("#hospital").html(options);
	});
	$('#hospital').change(function(){
		$("#equipmentTr").hide();
		$("#departmentTr").hide();
		$("#outputOfEquipment").hide();
	});
	$('input:radio[name=typeOfQuery]').click(function(){
		$("#equipmentTr").hide();
		$("#departmentTr").hide();
		$("#outputOfEquipment").hide();
	});
	$("#selectHospital").click(function(e){
		var queryType = $('input:radio[name=typeOfQuery]:checked').val();
		var hospitalId = $('select#hospital option:selected').val();
		if(queryType==="equipment"){
			var urlForList = '/getEquipmentListAsJson.php?hospital='+hospitalId;
			otherType="department";
		}else{
			var urlForList = '/getDepartmentListAsJson.php?hospital='+hospitalId;
			otherType="equipment";
		}
		$.getJSON(urlForList, function(json){
			var options = '';
			var list = json[queryType+"List"];
			for (var i = 0; i < list.length; i++){
			   options += '<option value="' + list[i].id + '">' +list[i].name + '</option>';
			}
			$("#"+otherType+"Tr").hide();
			$("#"+queryType).html(options);
			$("#"+queryType+"Tr").show();
			
		});
		
	});
	$("#selectByEquipment").click(function(e){
		var hospitalId = $('select#hospital option:selected').val();
		var equipmentId = $('select#equipment option:selected').val();
		var urlForEquipmentStatus = '/getDepartmentWiseEquipmentStatus.php?hospital='+hospitalId+"&equipment="+equipmentId;
		$.getJSON(urlForEquipmentStatus, function(json){
			$("#outputOfEquipment").removeClass("hidden");
			var allDepartmentEquipmentStatus = json.allDepartmentEquipmentStatus;
			var htmlTr="";
			htmlTr=htmlTr+"<tr >";
			htmlTr=htmlTr+"<td style=\"background:#ddd;border-bottom:1px solid #000; height: 30px;\" width=\"50\">Sno</td><td style=\"background:#ddd;border-bottom:1px solid #000; height: 30px;\" width=\"250\">Department</td><td style=\"background:#ddd;border-bottom:1px solid #000; height: 30px;\" colspan="+json.maxNoOfEquiments+">Status</td>";
			htmlTr=htmlTr+"</tr>";
			for(var i=0;i<allDepartmentEquipmentStatus.length;i++){
				var oneRow = allDepartmentEquipmentStatus[i];
				htmlTr=htmlTr+"<tr class='"+oneRow.rowColor+"'>";
				htmlTr=htmlTr+"<td>"+oneRow.sno+"</td><td>"+oneRow.department+"</td>";
				//iterate departmentEquipmentStatus
				var departmentEquipmentStatus = oneRow.departmentEquipmentStatus;
				for(var j=0;j<departmentEquipmentStatus.length;j++){
					var oneEquipment=oneRow.departmentEquipmentStatus[j];
					htmlTr=htmlTr+"<td width=\"30\" class='"+oneEquipment.equipmentStatus+"'><img src=\"images/ventilator.jpg\" border=\"0\" /></td>";
				}
				htmlTr=htmlTr+"</tr>";
			}
			$("#equipmentStatusDetails").html(htmlTr);
			
			$("#outputOfEquipment").show();
			
		});
	});
	$("#selectByDepartment").click(function(e){
		var hospitalId = $('select#hospital option:selected').val();
		var departmentId = $('select#department option:selected').val();
		var urlForEquipmentStatus = '/getAllEqupimentStatusForDepartment.php?hospital='+hospitalId+"&department="+departmentId;
		$.getJSON(urlForEquipmentStatus, function(json){
			var max = parseInt(json.maxNoOfEquiments);
			var allEquipmentStatus = json.allEquipmentStatus;
			var htmlTr="";
			htmlTr=htmlTr+"<tr >";   
			htmlTr=htmlTr+"<td style=\"background:#ddd;border-bottom:1px solid #000; height: 30px;\"  width=\"50\">Sno</td><td style=\"background:#ddd;border-bottom:1px solid #000; height: 30px;\" width=\"250\">Equipment</td><td style=\"background:#ddd;border-bottom:1px solid #000; height: 30px;\" colspan="+json.maxNoOfEquiments+">Status</td>";
			htmlTr=htmlTr+"</tr>";
			for(var i=0;i<allEquipmentStatus.length;i++){
				var oneRow = allEquipmentStatus[i];
				htmlTr=htmlTr+"<tr class='"+oneRow.rowColor+"'>";
				htmlTr=htmlTr+"<td>"+oneRow.sno+"</td><td>"+oneRow.equipment+"</td>";
				//iterate departmentEquipmentStatus
				var departmentEquipmentStatus = oneRow.departmentEquipmentStatus;
				for(var j=0;j<departmentEquipmentStatus.length;j++){
					var oneEquipment=oneRow.departmentEquipmentStatus[j];
					htmlTr=htmlTr+"<td width=\"30\" class='"+oneEquipment.equipmentStatus+"'><img src=\"images/ventilator.jpg\" border=\"0\" /></td>";
				}
				
				var noofemptyslots = max-departmentEquipmentStatus.length
				for(var k=0;k<noofemptyslots;k++){
					htmlTr=htmlTr+"<td>&nbsp;</td>";
				}
				htmlTr=htmlTr+"</tr>";
			}
			$("#equipmentStatusDetails").html(htmlTr);
			$("#outputOfEquipment").show();
			
		});
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

<!--#navbar-->

<!--maincontentarea-->
<div id="content-main">
Login Successful <a href="logout.php">Logout</a>
<br>

<h1>Medical Equipment Dashboard</h1>

<style type="text/css">
<!--
.box {
background-color: #F4F4F4;
border: 1px solid #CCC;
height: 100px;
width: 200px;
padding: 5px;
font-size:10px;
display:none;
position:absolute;
}
.paddingAll,table#inputProvider{
font-family: Arial,Calibri,Verdana,Helvetica,sans-serif;
    font-size: 10pt;
    font-style: normal;
    line-height: 1.4;
    padding-left: 22px;
    padding-right: 10px;
    text-align: justify;
}
.label{
	width:205px;
}
.selectBox{
	width:250px;
}

.selectBox select{
	width:200px;
}
tr.oddrow{
	background:#ddd;
}
tr.evenrow{
	background:#FFFFFF;
}
td.W{
	background:#387C44;
	border:1px solid #ddd;
}
td.NW{
	background:#C11B17;
	border:1px solid #ddd;
}
td.labelClass{
	width:50px; 
	text-align:right;
	padding-right:5px;
}
td.valueClass{
	width:275px;
	text-align:left;
	font-weight:bold;
}
div.output{
	padding-bottom: 25px;
    padding-left: 25px;
	display:block
}
#content-main div.output img {
    border: 0px solid #CECECE;
    margin: 5px;
    padding-left: 6px;
}
table#equipmentStatusDetails{
	border:1px solid #000;
}
table#equipmentStatusDetails td{
	text-align:left;
}
-->
</style>
<script type="text/javascript" language="JavaScript">
//javascript for generating display box on mouse over
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

  <div class="tab-box">
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">Equiment Status</a>
    <a href="javascript:;" class="tabLink " id="cont-3">Service History</a>
    <a href="javascript:;" class="tabLink " id="cont-4">Report Issue</a>
  </div>

  <div class="tabcontent paddingAll" id="cont-1-1">
  <?include 'equipment_by_type.php';?>
  </div>

  

  <div class="tabcontent paddingAll hide" id="cont-3-1">
  <?include 'equipment_service_history.php';?>
  </div>

  <div class="tabcontent paddingAll hide" id="cont-4-1">
  <?include 'form_report_issue_test.php';?>
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