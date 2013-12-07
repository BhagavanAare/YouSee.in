<?php session_start();?>
<?php $thispage = "donate_waste";
$activetab="summaryReqTab";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>Donate Waste | YouSee</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/tabs.css">
	<link rel="stylesheet" href="css/table.css">
	
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper" >

<!--header and navbar -->
<?php include 'header_navbar.php';?>

<div id="uccertificate-main">

<table>
<tr>
<td valign="top">
	 <div class="left_div" style=" float:left"> 
	<?php include 'uc_donatewaste_tabs.php'; ?>
	</div>
</td>
<td>
	<div class="right_div"  style=" float:left; width: 750px;" >
		<p><b>"Don't Waste, Donate Waste</b>
		" / "<b>Kachra Daan, Karo Kalyan</b>" is a citizen driven 
		waste management initiative promoted by UC. We welcome you, 
		your neighbours and your organisation to participate in this
		 initiative. This initiative commenced in October 2010.</p>
		<div style="width:750px;"><p>The map below gives shows cities 
		where Donations Camps for donating Recyclable or Reusable items
		 are organised and also places where C Gardens 
		 (Composting Centers) have been set up.</p></div>
		<div align="center">
			<?php include 'report_map_compost_centers.php';?>
		</div>
		<div>
		<p><b>A visual tour of this initiative:</b></p><br />
		<iframe 
		src="http://www.slideshare.net/slideshow/embed_code/27299315" 
		width="700" height="400" frameborder="0" marginwidth="0" 
		marginheight="0" scrolling="no"></iframe>
		</div>
		<div><h3 style="padding-left:0px;">Why Donate?</h3>
<p>
You can give the value generated from Recyclables and give the 
Reusable items donated for Charity. 
You're not only bringing smiles to several unfortunate people, 
but also helping environment by 

reducing waste.</p>
<ul>
	<li>Recyclables can be given to recyclers and value 
	generated is used to make postpay donations for social 
	work projects.</li>
<li>Reusables like Clothes, Books, Toys etc. are given to 
Organisations serving the underprivileged.</li>
</ul>
<p>
To put it in a nutshell, here is an opportunity to – Save the Planet, 
Serve the Poor / Kachra Daan, Karo Kalyan.
So the next time before we throw away a piece of paper or 
a polythene wrapper or any other waste, pause for a moment,
 and choose to donate it rather than throwing it away.
</p>

<h3 style="padding-left:0px;">What to Donate?</h3>

<b>Recylables: (Donate Waste / Kachra Daan) </b>
<ul>
	<li>Paper (Shredded Paper, Used Notebooks,
	 Packing Paper and Cartons, Magazines, Newspapers)
</li>
<li>Plastics (Bags, Wraps, Bottles etc.)</li>
<li>Glass (Bottles).</li>
<li>Metal & E-Waste(Batteries and Electronic Items)</li>
<li>Food/Garden Waste:
<ul>
	<li>In communities which are willing to set aside some space for 
	composting of organic/wet waste, UC helps to set up composting 
	centers called as C Gardens. The compost generated from these 
	centers can be used as manure for gardening wihtin the community or 
	donated for other communities.</li>
</ul></li>
</ul>
<b>Reusables: (Donate In-Kind / Vastu Daan)</b>
<ul>
	<li>Clothes, Books, Toys (let us not use this as an opportunity 
	to discard stuff that you could still use, to indulge in weekend 
	shopping . Your extra change can be donated directly for a good 
	cause or to buy things for a charity).</li>
</ul>

 
	</div>
	</div>
</td>
</tr>
</table>
<!--footer-->
</div>
<?php include 'footer.php' ; ?>

</div>
<!--wrapper end-->

 </BODY>
</HTML>
