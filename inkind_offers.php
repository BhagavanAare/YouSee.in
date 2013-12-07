
<div style="position:relative;height:100%;">
<div id="div_inkind" style="position:relative;left:210px;">
<?php 
session_start();
$where="";
if(isset($_REQUEST['category'])){
	if($_REQUEST['category']=="" || $_REQUEST['category']=='NULL'){
		$where.="";
	}
	else
	$where.=" AND item_category.category_id=".$_REQUEST['category'];
}
if(isset($_REQUEST['item'])){
	if($_REQUEST['item']=="" || $_REQUEST['item']=='NULL'){
		$where.="";
	}
	else{
	$where.=" AND items.item_id=".$_REQUEST['item'];
	}
}
if(isset($_REQUEST['request_city'])){
	$where.=" AND (";
	$ccount=count($_REQUEST['request_city']);
   	foreach($_REQUEST['request_city'] as $c){
			if($ccount>1){
				$where.="offer_city='".$c."' OR ";
				$ccount--;
			}
			else{
  				$where.="offer_city='".$c."')";
			}
	}
}
if(isset($_REQUEST['transport'])){
		$where.=" AND (";
	$tcount=count($_REQUEST['transport']);
   	foreach($_REQUEST['transport'] as $t){
			if($tcount>1){
				$where.="transport='".$t."' OR ";
				$tcount--;
			}
			else{
  				$where.="transport='".$t."')";
			}
	}
}
$_SESSION['where_inkind']=$where;
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
$request_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id
				JOIN donors on kind_donations.donor_id=donors.donor_id
				WHERE initiative_type=1 AND offer_quantity>request_quantity AND offer_expiry_date>'".date("Y-m-d")."' AND status='Open' AND request_quantity=0 ".$where." LIMIT 0,20";
$request_ex=mysql_query($request_query);
$total_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id
				JOIN donors on kind_donations.donor_id=donors.donor_id
				WHERE initiative_type=1 AND offer_quantity>request_quantity AND offer_expiry_date>'".date("Y-m-d")."' AND status='Open' AND request_quantity=0 ".$where."";
$total_ex=mysql_query($total_query);
if(mysql_num_rows($request_ex)>0){
?>
<br />
<font style="color:#666;font-weight:bold;font-size:14px;font-family:Trebuchet MS">Showing <?php echo mysql_num_rows($request_ex); ?> of <?php echo mysql_num_rows($total_ex); ?> offer(s).</font>
<br /><br />
<div class='itemcontainer' id="requests_inkind">
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
					</td>
					<td><?php echo $row['offer_quantity']." ".$row['units_type']; ?></td>
					<td>
						<span class="link">
							<a><?php echo $row['displayname']; ?>
							<span id="offeradd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['offer_address'].",".$row['offer_city'];?></p>
							</span>
						</a>
					</td>
					<td><?php if($row['transport']==0) echo "<img src='images/donor.png' alt='Deliver' />"; else echo "<img src='images/npo.png' alt='Pick-up' />" ?></td>
					<td style="text-align:left;">
						<input type="text" value="<?php echo $row['offer_quantity'];?>" name="request_quantity"  id="request_quantity<?php echo $row['donation_id'];?>" size=2 /><?php echo $row['units_type'];?>
					</td>
					<td style="width:5%;"><input type="submit" value="Request" class="offer_commit" id="<?php echo $row['donation_id']; ?>" />
					<input type="text" name="id" value="<?php echo $row['donation_id']; ?>" hidden /></td>
				</tr>
			</table>
			</form>
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
		echo "<h3> No Offers. </h3>";
	}
if(isset($_SESSION['page_number']))
unset($_SESSION['page_number']);
?>
