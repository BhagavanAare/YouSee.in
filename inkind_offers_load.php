<?php 
session_start();
error_reporting(0) ;
if($_GET['lastComment']){
include('prod_conn.php');
$link = mysql_connect("$dbhost","$dbuser","$dbpass");
if(!$link) {
	die('Failed to connect to server: ' . mysql_error());
}
//Select database
$db = mysql_select_db("$dbdatabase");
if(!$db) {
	die("Unable to select database");
}
$where=$_SESSION['where_inkind'];
if(isset($_SESSION['page_number'])){
$_SESSION['page_number']++;
}
else {
$_SESSION['page_number']=2;
}
$filtered = filter_input(INPUT_GET, "lastComment", FILTER_SANITIZE_URL);
$request_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id
				JOIN donors on kind_donations.donor_id=donors.donor_id
				WHERE initiative_type=1 AND offer_quantity>request_quantity AND request_quantity=0 ".$where." AND offer_expiry_date>'".date("Y-m-d")."' AND status='Open' AND kind_donations.donation_id>".$filtered." LIMIT 0,20";
$request_ex=mysql_query($request_query);
if(mysql_num_rows($request_ex)>0){
?>
<script>
	$(function(){
	$(".offer_commit").click(function(){
	var request_quantity=parseInt($("#request_quantity"+this.id).val());
	$.ajax({
		type : "POST",
		data : { request_quantity : request_quantity , id:this.id } ,
		url : "inkind_commit.php",
		success : function(html){
			if(html){
			$("#existing_content").children().remove();
			$("#existing_content").append(html);
			}
			else{
				alert("You need to be logged in as an NGO to make an in-kind request.");
			}
		}
		});
	});
	});
</script>
  <link rel="stylesheet" type="text/css" href="css/inkind_items.css">  
<div class='itemcontainer' id="requests_inkind">
<div style="width:95%;padding:3px;background:#ccc;font-size:14px;font-weight:bold;font-family:Trebuchet MS;padding-left:30px;">Page <?php echo $_SESSION['page_number'];?></div>

<?php 
echo "<table class='table-item' style='width:800px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:30px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Offered By</th>
			<th>Transport by</th>
			<th>We Require..</th>
			<th></th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($request_ex)){	?>
	<div class="postedComment" id="<?php echo $row['donation_id'];?>">
		<div class="itemdiv <?php echo $row['category']; ?>" >
		
		<form name="commit_form" method="POST" action="/inkind_commit.php">
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
					</td>					<td><?php echo $row['offer_quantity']." ".$row['units_type']; ?></td>
					<td>
						<span class="link">
							<a><?php echo $row['displayname']; ?>
							<span id="offeradd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['offer_address'].",".$row['offer_city'];?></p>
							</span>
						</a>
					</td>
					<td><?php if($row['transport']==0) echo "<img src='images/donor.png' alt='Deliver' />"; else echo "<img src='images/npo.png' alt='Deliver' />" ?></td>
					<td style="text-align:left;">
						<input type="text" value="<?php echo $row['offer_quantity'];?>" id="request_quantity<?php echo $row['donation_id'];?>" size=2 /><?php echo $row['units_type'];?>
					</td>
					<td style="width:5%;"><input type="submit" value="Request" class="offer_commit" id="<?php echo $row['donation_id']; ?>" /></td>
				</tr>
			</table>
		</form>
		</div>
	</div>
<?php
	}
?>
</div>
<?php
	} else {mysql_close(); return null;}
	}else return null; ?>	
