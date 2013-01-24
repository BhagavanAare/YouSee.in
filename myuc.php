<?php require_once('login_auth.php');?>
<?php $thispage = "donate_time"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Time | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
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

<!--wrapper begin-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<!--maincontentarea begin-->
<div id="uccertificate-main">

<h2>Welcome <?php include 'display_donor_info.php';?>, your Donor ID is: <?php echo $_SESSION['SESS_DONOR_ID'];?></h2>

<table border="0" width="100%">
	<tr>
		<td align="center" width="33%"><?php include 'volunteer_personal_contributions_graph.php';?></td>
		<td align="center" width="33%"><?php include 'donatewaste_graph_total_kg_personal.php';?></td>
		<td align="center" width="33%"><?php include 'finance_personal_contributions_graph.php';?></td>
	</tr>
</table>

<br />

<div class="tab-box">
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">Volunteering Contributions</a>
    <a href="javascript:;" class="tabLink " id="cont-2">Financial Donations</a>
    <a href="javascript:;" class="tabLink " id="cont-3">Waste Donations</a>
</div>

<div class="tabcontent paddingAll" id="cont-1-1">
	<?php include 'volunteer_personal_contributions_list.php';?>
</div>

<div class="tabcontent paddingAll hide" id="cont-2-1">
	<?php include 'finance_personal_contributions_list.php';?>
</div>
  
<div class="tabcontent paddingAll hide" id="cont-3-1">
	<table border="0" width="100%">
			<tr>
				<td align="center" width="50%"><?php include 'donatewaste_graph_kg_personal.php';?></td>
				<td align="center" width="50%"><?php include 'donatewaste_graph_rs_personal.php';?></td>
			</tr>
	</table>
</div>

</div>
<!--maincontentarea end-->


<!--footer-->
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>