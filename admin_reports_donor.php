<?php
if(isset($_POST['search_donor'])){
include_once "prod_conn.php";
$query="SELECT donor_id,first_name,last_name,displayname,preferred_email,village_town,org_grp_name,mobile_phone_no FROM donors WHERE LOWER(first_name) LIKE LOWER('$_POST[search_key]%') OR LOWER(last_name) LIKE LOWER('$_POST[search_key]%') OR LOWER(CONCAT(first_name,' ',last_name)) LIKE '$_POST[search_key]%' OR LOWER(displayname) LIKE ('%$_POST[search_key]%') ORDER BY first_name ASC ";
$result=mysql_query($query);
if(mysql_num_rows($result)>0){
$donorlist=array();
while($row=mysql_fetch_array($result)){
	$donorlist[]=array($row['donor_id'],"$row[displayname]"," ","$row[preferred_email]","$row[mobile_phone_no]","$row[village_town]","$row[org_grp_name]");
}
echo json_encode($donorlist);
}
}
else {
require_once('login_auth.php');
$activetab="donorReportsTab";
 $thispage ="adminHomescreen";
if (!($_SESSION['SESS_USER_TYPE']=='A'))
{
	header("location: login_access_denied.php");
	exit();
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">
  <link rel="stylesheet" href="scripts/jquery-ui.css">

	<script src="scripts/jquery.min.js"></script>
			<script src="scripts/jquery.blockUI.js"></script>		

	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
<style>
.search_list{
border:1px solid transparent;
padding:1px;
margin:0px;
}
.search_list:hover{
border:1px solid #ccc;
cursor:pointer;
font-weight:bold;
}
</style>
<script>
$(function(){
$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
var keyUpTime = 1000; // 1 sec
var keyUpTimeout = null;
$("#from_date").datepicker();
$("#to_date").datepicker();
$('#donor_search').on('input', function(e) {
	$("#search_result").hide();
	if($(this).val().length>2){
    clearTimeout(keyUpTimeout);
    keyUpTimeout = setTimeout(function() { sendAjax(); }, keyUpTime);
	}
	else { 	$("#search_result").hide(); }
});
function sendAjax() {
		if($("#donor_search").val().length>2){
		$.ajax({
			async : true,
			type : "POST",
			url : "admin_reports_donor.php",
			data : {search_donor : 1, search_key : $("#donor_search").val() },
			dataType : "JSON",
			success : function(returnData) { 
			if(returnData){
			$("#search_result").children().remove();
			$("#search_result").show();
			for(var i=0;i<returnData.length;i++){
			$("#search_result").append('<div class="search_list"><span id="donor_name">'+returnData[i][1]+' '+returnData[i][2]+'</span>,<span id="donor_city">'+returnData[i][5]+'</span><input type="text" id="email" value="'+returnData[i][3]+'" hidden /><input id="phone_no" type="text" value="'+returnData[i][4]+'" hidden /><input id="org_grp" type="text" value="'+returnData[i][6]+'" hidden /><input id="donor_id" type="text" value="'+returnData[i][0]+'" hidden /></div><br />');
			}
			$(".search_list").on('click',function(){
				$("#search_result").hide();
				$("#donor_info").show();
				$("#donor_selected").val($(this).find("#donor_id").val());
				$("#citybox").val($(this).find("#donor_city").val());
				$("#emailbox").val($(this).find("#email").val());
				$("#mobilebox").val($(this).find("#phone_no").val());
				$("#orgbox").val($(this).find("#org_grp").val());
				$("#donor_search").val($(this).find("span").html());
			});
			}
		}
		});
	}
}
});
</script>
<title>My UC | Donor Reports</title>

</head>
<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">
<table>
<tr>
<td valign="top">
<?php include 'adminUcTabs.php';?>
</td>
<td>
<p>Select a donor : </p>
<div id="search_box" style="height:50px">
<form action="admin_reports_donor.php" method="POST" name="search">
<input type="text" id="donor_search" placeholder="Donor Name" size=20 name="donor_name" /> 
<input type="text" name="donor_id" id="donor_selected" hidden />
&nbsp <input type="text" id="from_date" placeholder="From Date" name="from_date" /><input type="text" id="to_date" placeholder="To Date" name="to_date" />
<input type="submit" value="Go" id="searchbutton" name="search_button" /><br />
<span id="donor_info" style="float:right" hidden><b>Donor Info</b><br />
<input type="text"  name="donor_email" placeholder="Email" id="emailbox" readonly />
<input type="text" name="donor_mobile" id="mobilebox" placeholder="Mobile" readonly />
<input type="text" name="donor_city" name="citybox" placeholder="City" id="citybox" readonly />
<input type="text" name="donor_org" id="orgbox" placeholder="Organization" readonly />
</span>
</form>
<div id="search_result" style="border: 1px solid #ccc;height:auto;background:white;max-height:300px;width:300px; overflow:auto;display:none;position:absolute;z-index:1000">
</div>
</div>
<?php if(isset($_POST['search_button'])){ ?>
<?php if($_POST['donor_name']!='') { ?>
<span>Donor Name :<b> <?php echo $_POST['donor_name']; ?> </b>| </span>
<?php } if($_POST['donor_email']!='') { ?>
<span>Email :<b> <?php echo $_POST['donor_email'];?> </b>| </span>
<?php } if($_POST['donor_mobile']!='') { ?>
<span>Mobile :<b> <?php echo $_POST['donor_mobile'];?> </b>| </span>
<?php } if($_POST['donor_city']!='') { ?>
<span>City :<b> <?php echo $_POST['donor_city'];?> </b>| </span>
<?php } if($_POST['donor_org']!='') { ?>
<span>Organizations :<b> <?php echo $_POST['donor_org'];?> </b> </span>
<?php } ?>
<br /><br />
<table id="table-search" style="">
<?php if($_POST['from_date']!='' && $_POST['to_date']!=''){ ?>
<tr><th align="left" colspan=2>From : <?php echo date("d-M-y",strtotime($_POST['from_date'])); ?></th><th align="left">To : <?php echo date("d-M-y",strtotime($_POST['to_date'])); ?></th></tr>
<?php
} 
$where="";
if(isset($_POST['from_date']) && $_POST['to_date']){
$where="AND (payment_date BETWEEN '$_POST[from_date]' AND '$_POST[to_date]')";
}
$query="SELECT FORMAT(amount_for_project+amount_for_operations_grant,0)donation,payment_date,town_city,name,document_link,title FROM postpay_certificates poc JOIN project_certificates prc ON poc.certificate_id=prc.certificate_id JOIN project_partners pp ON prc.partner_id=pp.partner_id JOIN payments ON poc.payment_id=payments.payment_id WHERE poc.donor_id=$_POST[donor_id] $where ";
$totalquery="SELECT FORMAT(SUM(amount_for_project+amount_for_operations_grant),0)sum FROM postpay_certificates WHERE donor_id=$_POST[donor_id] AND payment_id!=''";
$totalresult=mysql_query($totalquery);
$total=mysql_fetch_array($totalresult);
$result=mysql_query($query);
$i=1;
if(mysql_num_rows($result)>0){ ?>
<thead style="font-size:11px;"><th>S.No</th><th>Donation Date</th><th>Project Location</th><th>Project Partner</th><th>Project(Report)</th><th>Amount(INR)</th></thead>
<?php
while($row=mysql_fetch_array($result)){
echo "<tr><td>$i</td>
<td>$row[payment_date]</td>
<td>$row[town_city]</td>
<td>$row[name]</td>
<td><a href='$row[document_link]' target='_blank'>$row[title]</a></td>
<td align='right'>$row[donation]</td>
</tr>";
$i++;
}
echo "<tr><td colspan='6' align='right'><b>Total : $total[sum]</b></td></tr>";
}
else { echo "<tr><td colspan='6'>This donor has not made any financial donations </td></tr>"; }
echo "</table>";
}
 ?>
</td>
</tr>
</table>
</div>
<?php include "footer.php"; ?>
</div>
</body>
</html>
<?php } ?>
