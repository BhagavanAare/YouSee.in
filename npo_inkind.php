<?php
	session_start();
	$thispage="more";
		$thisdiv="npo_inkind";
	if(!isset($_GET['npo'])){
		header("Location : /npo.php");		
	}
	else {
		include "prod_conn.php";
		$id=mysql_real_escape_string(trim($_GET['npo']));
		$npo=mysql_fetch_array(mysql_query("SELECT name FROM project_partners 
											WHERE partner_id = $id"));
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="List of inkind requests posted by NPOs">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/div.css">
  <script src="/scripts/jquery.min.js"></script>
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
<div style="float:left;width:150px;padding:10px;margin:10px">
	<span> 
		<a href="getnpo.php?npo=<?php echo $id; ?>">
	<?php echo $npo['name'];?></a> 
		</span><br />
	<span>
		<a href="/npo_activities.php?npo=<?php echo $id; ?>">Volunteering</a>
	</span><br />
	<span style="font-size:13px;font-weight:bold;">
		<a href="/npo_inkind.php?npo=<?php echo $id; ?>">In Kind</a></span><br />
	<span><a href="/npo_postpay.php?npo=<?php echo $id; ?>">Financial</a></span>
</div>
<!-- Left Nav End -->
  <Title><?php echo $npo['name'];?> - In-Kind Requests | YouSee</Title>

<div style="float:left;width:750px;padding:10px;margin:10px;">
	<script>
	$(function(){
		$(".commit_request").click(function(){
	var offer_quantity=parseInt($("#offer_quantity"+this.id).val());
	$.ajax({
		type : "POST",
		data : { offer_quantity:offer_quantity , id:this.id } ,
		url : "inkind_commit.php",
		success : function(html){
		if(html){
			$("#existing_content").children().remove();
			$("#existing_content").append(html);
		}
		else{
			alert("You need to be logged in as a donor to make an in-kind offer.");
		}
		}
		});
	});
	});
	</script>
	
<div id="existing_content">	

<div style="position:relative;height:100%;">
<div id="div_inkind" style="position:relative;">
	<?php
	$request_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN project_partners on kind_donations.partner_id=project_partners.partner_id
				WHERE initiative_type=0 AND request_quantity>offer_quantity 
				AND offer_quantity=0 AND status='Open' 
				AND project_partners.partner_id = $id 
				AND request_expiry_date>'".date("Y-m-d")."'".$where." LIMIT 0,20";
	$request_ex=mysql_query($request_query);
	if(mysql_num_rows($request_ex)>0){
		echo "
	<h1 style='border:1px solid #ccc;background:#eee;
	border-radius:0.2em;padding:3px;'>Recent In kind requests by $npo[name]</h1>";
		?>
<div class='itemcontainer' id="requests_inkind">
<?php 
echo "<table class='table-item' style='width:800px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:10px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Requested By</th>
			<th>Transport by</th>
			<th>I Commit..</th>
			<th></th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($request_ex)){	?>
	<div class="postedComment" id="<?php echo $row['donation_id']; ?>">
		<div class="itemdiv <?php echo $row['category']; ?>" id="item<?php echo $row['donation_id']; ?>">
			<table class="table-item">
				<tr>
					<td  style="font-size:13px;font-weight:bold;" id="item<?php echo $row['donation_id'];?>">
						<span class="link">
							<a><?php echo $row['donationitem']; ?>
							<span id="note<?php echo $row['donation_id'];?>">
								<p style="margin:5px;padding:5px;"><?php echo $row['note'];?></p>
							</span>
							</a>
						</span> 
					</td>
					<td><?php echo $row['request_quantity']." ".$row['units_type']; ?></td>
					<td>
						<span class="link">
							<a href="/npo/<?php echo $row['partner_id']; ?>"><?php echo $row['name']; ?>
							<span id="reqadd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['request_address'].",".$row['request_city'];?></p>
							</span>
						</a>
					</td>
					<td><?php if($row['transport']==1) echo "<img src='images/npo.png' alt='Pick-Up' />"; else echo "<img src='images/donor.png' alt='Deliver' />" ?></td>
					<td style="text-align:left;">
						<form name="commit_form" method="POST" action="/inkind_commit.php">
						<input type="text" value="<?php echo $row['request_quantity'];?>" id="offer_quantity<?php echo $row['donation_id'];?>" size="2" name="offer_quantity"/><?php echo $row['units_type'];?>
					</td>
					<td style="width:5%;"><input type="submit" value="Commit" class="commit_request" id="<?php echo $row['donation_id']; ?>" />
					<input type="text" value="<?php echo $row['donation_id'];?>" name="id" hidden />
					</form>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php
	}	
?>
</div>
</div>
</div>
<?php 
	}
	else {
		echo "<h3> No In-Kind requests. </h3>";
	}
?>
	
	
	
	
</div>
</div>
</div>
<!-- Right div ends -->
</div>
</div>
 <?php include 'footer.php' ; ?>

</div>
<!--#footer-->
 </BODY>
</HTML>
<?php
}
?>

