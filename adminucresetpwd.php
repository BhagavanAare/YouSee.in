<?php
if(isset($_POST['search_user'])){
include_once "prod_conn.php";
$query="SELECT users.user_id,name FROM users JOIN project_partners ON users.user_id = project_partners.user_id WHERE user_type_id='N' AND LOWER(username) LIKE LOWER('%$_POST[search_key]%') ORDER BY LOWER(name) ASC ";
$result=mysql_query($query);
if(mysql_num_rows($result)>0){
$userlist=array();
while($row=mysql_fetch_array($result)){
	$userlist[]=array($row['user_id'],"$row[name]");
}
echo json_encode($userlist);
}
}
else { 
?>
<?php require_once('login_auth.php');?>
<?php
$activetab="volunteeringApprovalsTab";
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

	<script src="scripts/jquery.min.js"></script>
			<script src="scripts/jquery.blockUI.js"></script>	
<script>
$(function(){
$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
var keyUpTime = 1000; // 1 sec
var keyUpTimeout = null;
$('#user_search').on('input', function(e) {
	$("#search_result").hide();
	if($(this).val().length>2){
    clearTimeout(keyUpTimeout);
    keyUpTimeout = setTimeout(function() { sendAjax(); }, keyUpTime);
	}
	else { 	$("#search_result").hide(); }
});
function sendAjax() {
		if($("#user_search").val().length>2){
		$.ajax({
			async : true,
			type : "POST",
			url : "adminucresetpwd.php",
			data : {search_user : 1, search_key : $("#user_search").val() },
			dataType : "JSON",
			success : function(returnData) { 
			if(returnData){
			$("#search_result").children().remove();
			$("#search_result").show();
			for(var i=0;i<returnData.length;i++){
			$("#search_result").append('<div class="search_list"><span id="ngo_name">'+returnData[i][1]+'</span><input id="user_id" type="text" value="'+returnData[i][0]+'" hidden /></div><br />');
			}
			$(".search_list").on('click',function(){
				$("#search_result").hide();
				$("#user_selected").val($(this).find("#user_id").val());
				$("#user_search").val($(this).find("span").html());
			});
			}
		}
		});
	}
}
});
</script>
<title>My UC | Reset Password</title>

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
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >

<div id="search_box" style="height:50px">
<form action="adminucresetpwd.php" method="POST" name="search">
<input type="text" id="user_search" placeholder="Username" size=20 name="username" /> 
<input type="text" name="user_id" id="user_selected" hidden />
<input type="submit" value="Go" id="searchbutton" name="search_button" /><br />
</form>
<div id="search_result" style="border: 1px solid #ccc;height:auto;background:white;max-height:300px;width:300px; overflow:auto;display:none;position:absolute;z-index:1000">
</div>
</div>	
<?php if(isset($_POST['search_button'])){ ?>
<?php if($_POST['username']!='') { ?>
<br /><br />
<table id="table-search" style="">
<?php 
$password=setPassword($_POST['user_id']);
$nporesult=mysql_query("SELECT partner_email,username from project_partners JOIN users ON project_partners.user_id = users.user_id
 WHERE users.user_id=$_POST[user_id]");
$npo=mysql_fetch_array($nporesult);
echo "<tr><td>Password has been changed, Email sent to the user.</td>
</tr>";
include_once "Email/sendemail.php";
$params=array(						
						$email=$npo['partner_email'],
						$subject="Your password has been reset - YouSee",
						$displayname=$_POST['username'],
						$mailtext="We wish to inform you that your <a href='http://www.yousee.in'>YouSee</a> password has been reset. You can now login with the following:<br />
						Username : $npo[username]<br />Password : $password<br /><br />
You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a><br /><br />",
						);
						call_user_func_array('sendEmail',$params);
}
}
 ?>	
	
	

</div>

</td>
</tr>
</table>
</div>
<!--footer-->
<br />
<?php include 'footer.php' ; ?>
<!--#footer-->
</div>
</body>
</html>
<?php 
}

function setPassword($userID) {
	$length=8;
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$password = substr(str_shuffle($chars),0,$length);
	//echo $password;
	mysql_query("UPDATE users SET password='".md5($password)."' WHERE user_id='".$userID."'");
	return $password;
}
?>
