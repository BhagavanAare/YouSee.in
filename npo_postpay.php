<?php
	session_start();
	$thispage="more";
	$thisdiv="npo_postpay";
	$_SESSION['donate_postpay']="npo";
	if(!isset($_GET['npo'])){
		header("Location : /npo.php");		
	}
	else {
		include "prod_conn.php";
		$id=mysql_real_escape_string(trim($_GET['npo']));
		$_SESSION['npo']=$id;
		$npo=mysql_fetch_array(mysql_query("SELECT name FROM project_partners 
											WHERE partner_id = $id"));
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="List of projects supprted  to individual NPO's">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/div.css">
  <script src="/scripts/jquery.min.js"></script>
	<script src="/scripts/donate_postpay.js"></script>
  <script src="/scripts/jquery.blockUI.js"></script>
  </HEAD>
 <BODY>

<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->

<?php include 'header_navbar.php';?>

<!--maincontentarea-->

<div id="uccertificate-main">
	<!-- Left Nav -->
<div style="float:left;width:150px;display:inline-block;padding:10px;margin:10px">
	<span> 
		<a href="getnpo.php?npo=<?php echo $id; ?>">
	<?php echo $npo['name'];?></a> 
		</span><br />
	<span>
		<a href="/npo_activities.php?npo=<?php echo $id; ?>">Volunteering</a>
	</span><br />
	<span><a href="/npo_inkind.php?npo=<?php echo $id; ?>">In Kind</a></span><br />
	<span style="font-size:13px;font-weight:bold;">
		<a href="/npo_postpay.php?npo=<?php echo $id; ?>">Financial</a></span>
</div>
  <Title><?php echo $npo['name'];?> - PostPay projects | YouSee</Title>

<!-- Left Nav End -->
	
	
	<div id="data" style="display: inline-block; float:left; width: 770px; 
	height: auto; padding: 12px; margin-left: 14px; border: 0;
	 border-left: 1px solid lightgrey;">
	<h1 style='border:1px solid #ccc;background:#eee;
	border-radius:0.2em;padding:3px;'>
	Awaiting Postpay donations for <?php echo $npo['name'];?>
	</h1>
	</div>
</div>
<!-- Right div ends -->

 <?php include 'footer.php' ; ?>

</div>
<!--#footer-->
 </BODY>
</HTML>
<?php
}
?>

