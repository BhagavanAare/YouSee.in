<?php session_start();?>
<?php $thispage = "donate_waste";
$activetab="WhyReqdonate";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Waste| Donation Summary</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="test/test.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
	<link rel="stylesheet" href="css/table.css">
	
	
  <html lang="en">
	<head>

</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" style="background:white; margin-bottom:20px;">

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<div id="uccertificate-main">
<table>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
	<?php include 'uc_donatewaste_tabs.php'; ?>
</div>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >

<table cellpadding="3%"  width="600px">	
 <div>
<p>All donations go to Charity. You're not only bringing smiles to several unfortunate people, but also helping environment by reducing waste. </p>
<ul><li><b>Recyclables</b>  are given to recyclers and value generated is used to make postpay donations for social work projects.</li>
<li><b>Reusables</b> like Clothes, Books, Toys etc. are given to Organisations serving the underprivileged.</li></ul>
<p>To put it in a nutshell, here is an opportunity to  – Save the Planet, Serve the Poor / Kachra Daan, Karo Kalyan.So the next time before we throw away a piece of paper or a polythene wrapper or any other waste, pause for a moment, and choose to donate it rather than throwing it away.</p>
</div>
</table>
</table>
</div>
<!--footer-->
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->


 </BODY>
</HTML>
