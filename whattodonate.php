<?php session_start();?>
<?php $thispage = "donate_waste";
$activetab="whatdonteReqTab";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Waste | Donation Summary</TITLE>
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
<td valign="top">
<div class="left_div" style=" float:left; " >
	<?php include 'uc_donatewaste_tabs.php'; ?>
</div>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >

<table cellpadding="3%"  width="600px">	
 <div>
<p>
<b>Recylables: </b>(Donate Waste / Kachra Daan) </p>
<ul>
<li>Paper (Shredded Paper, Used Notebooks, Packing Paper and Cartons, Magazines, Newspapers)</li>
<li>Plastics (Bags, Wraps, Bottles etc.)</li>
<li>Glass (Bottles)</li>
<li>Metal & E-Waste(Batteries and Electronic Items)</li>

</ul>
<p>
<b>Reusables: </b>(Donate In-Kind / Vastu Daan)</p>
<ul>
<li>Clothes, Books, Toys (let us not use this as an opportunity to discard stuff that you could still use, to indulge in weekend shopping .  Your extra change can be donated directly for a good cause or to buy things for a charity).</li>
</ul>
<p>Food/Organic Waste: In communities which are willing to set aside some space for composting of organic/wet waste, UC helps to set up composting centers called as C Gardens. The compost generated from these centers can be used as manure for gardening wihtin the community or donated for other communities.</p>
</div>
 </div>
</table>
</table>
</div>
<!--footer-->

<?php include 'footer.php' ; ?>
</div>


 </BODY>
</HTML>
