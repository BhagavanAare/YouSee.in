<?php
$activetab="getserverIP";
$thispage = "donate_waste_app"; 
	require_once('login_auth.php');
	
	if(!$_SESSION['SESS_USER_TYPE'] == 'A') {
		header("Location: login_failed");
	}
?>
<html>
<head>
  <TITLE>Admin Panel</TITLE>
	<meta http-equiv="content-type" content="text/ html;charset=utf-8">
	<META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<script src="scripts/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/tabs.css">
	<link rel="stylesheet" type="text/css" href="css/div.css">
</head>

<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">
	<table style="margin-bottom:40px; width: 100%" id ="mytable">
		<tr>
			<td valign="top">
				<?php include 'adminUcTabs.php'; ?>
			</td>
			<td>
			<h3>IP : <?php echo getenv('REMOTE_ADDR'); ?>
				<ul>
					<li id="server" style="list-style-type:none;cursor:pointer;color:#369;margin:10px;"><a href="http://yousee.in/getserverIP.php" style="cursor:pointer;color:#369;margin:10px;text-decoration:none;"> Get server IP </a></li>
					<li id="secure_server" style="list-style-type:none;cursor:pointer;color:#369;margin:10px;"><a style="cursor:pointer;color:#369;margin:10px;text-decoration:none;" href="https://secure.netsolhost.com/yousee.in/getserverIP.php">Get SSL IP </a>	</li>
			</td>
		</tr>
	</table>
	</div>
	<?php include 'footer.php' ; ?>
	</div>
</body>
</html>