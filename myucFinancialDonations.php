
<?php require_once('login_auth.php');?>

<?php $thispage = "myuc";
$activetab="financialTab";
 	 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <title>My UC | Financial Donations</title>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
	<link rel="stylesheet" href="scripts/jquery-ui.css">

	</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" >

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<div style="background:white">
<!--maincontentarea begin-->
<div id="uccertificate-main">

<div>
<table>
<tr>
<td valign="top">
<?php include 'myucTabs.php'; ?>
</td>
<td>

<div>
<!-- ******************** Main Content Area Start ******************** -->
<?php
			include 'finance_personal_contributions_list.php';
			
	?>
<!-- ******************** Main Content Area End ******************** -->
</div>
</td>
</tr>
</div>

</table>
<br/>
</div>



</div>
<!--footer-->
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
