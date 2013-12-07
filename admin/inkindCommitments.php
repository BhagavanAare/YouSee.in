<?php require_once('login_auth.php');
if (!($_SESSION['SESS_USER_TYPE']=='A'))
{
	header("location: login_access_denied.php");
	exit();
	
}
?>
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
	<link rel="stylesheet" href="scripts/jquery-ui.css">
<input type="button" value="Pending requests" id="pending_requests_button">
<input type="button" value="Pending Offers" id="pending_offers_button" >
<input type="button" value="Connected users" id="connected_button">
<input type="button" value="Delivered material" id="delivered_button">
<div class='itemcontainer' id="pending_requests">
<?php
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
				JOIN project_partners on kind_donations.partner_id=project_partners.partner_id
				WHERE initiative_type='0' AND kind_donations.status='Pending'";
$request_ex=mysql_query($request_query);
if(mysql_num_rows($request_ex)>0){
?>
<?php 
echo "<h3>Pending Requests</h3>";
echo "<table class='postedComment' style='width:650px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:30px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Requested By</th>
			<th></th>
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
							<a href="<?php echo $row['website_url']; ?>" target="_blank"><?php echo $row['name']; ?>
							<span id="reqadd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['request_address'].",".$row['request_city'];?></p>
							</span>
						</a>
					</td>
					<td><form name="donationrequest" method="POST" action="inkind_commitments.php"><input type="text" value="<?php echo $row['donation_id'];?>" name="id" hidden /><input type="submit" value="Activate" name="activate_request" /><input type="submit" value="Stall" name="stall_request" /></form></td>
				</tr>
			</table>
		</div>
	</div>
<?php
	}}
else {
		echo "There are no pending requests.";
	}
?>
</div>
<div class='itemcontainer' id="pending_offers">
<?php 
$offer_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN donors on kind_donations.donor_id=donors.donor_id
				WHERE initiative_type='1' AND kind_donations.status='Pending'";
$offer_ex=mysql_query($offer_query);
if(mysql_num_rows($offer_ex)>0){
echo "<h3>Pending Offers</h3>";
echo "<table class='table-item' style='width:750px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:30px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Requested By</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($offer_ex)){	?>
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
					<td><?php echo $row['offer_quantity']." ".$row['units_type']; ?></td>
					<td>
						<span class="link">
							<a><?php echo $row['displayname']; ?>
							<span id="offeradd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['offer_address'].",".$row['offer_city'];?></p>
							</span>
						</a>
					</td>
					<td><form name="donationoffer" method="POST" action="inkind_commitments.php"><input type="text" value="<?php echo $row['donation_id'];?>" name="id" hidden /><input type="submit" value="Activate" name="activate_offer" /><input type="submit" value="Stall" name="stall_offer" /></form></td>
				</tr>
			</table>
		</div>
	</div>
<?php
	}}
else {
		echo "There are no pending offers.";
	}
?>
</div>
<div class='itemcontainer' id="connected">
<?php 
$connected_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN project_partners on kind_donations.partner_id=project_partners.partner_id
				JOIN donors on kind_donations.donor_id=donors.donor_id
				WHERE kind_donations.status='Connected'";
$connected_ex=mysql_query($connected_query);
if(mysql_num_rows($connected_ex)>0){
?>
<?php 
echo "<h3>Connected users</h3>";
echo "<table class='table-item' style='width:750px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:30px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Requested By</th>
			<th>Delivered By</th>
			<th>Delivery Date</th>
			<th></th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($connected_ex)){	?>
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
					<td><form name="donationconnect" method="POST" action="inkind_commitments.php"><input type="text" size="4" name="quantity" value="<?php if($row['initiative_type']=='0'){echo $row['offer_quantity'];} else { echo $row['request_quantity'];}?>" /><?php echo $row['units_type']; ?></td>
					<td>
						<span class="link">
							<a href="<?php echo $row['website_url']; ?>" target="_blank"><?php echo $row['name']; ?>
							<span id="reqadd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['request_address'].",".$row['request_city'];?></p>
							</span>
						</a>
					</td>
					<td>
						<span class="link">
							<a><?php echo $row['displayname']; ?>
							<span id="offeradd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['offer_address'].",".$row['offer_city'];?></p>
							</span>
						</a>
					</td>
					<td><input type="text" id="date<?php echo $row['donation_id'];?>" name="delivery_date" size="10" /></td>
					<td><input type="text" value="<?php echo $row['donation_id'];?>" name="id" hidden /><input type="submit" name="deliver" value="Delivered" /></form></td>
				</tr>
			</table>
		</div>
	</div>
	<script>
	$(function(){
		$("#date<?php echo $row['donation_id'];?>").datepicker();
	});
	</script>
<?php
	}}
else {
		echo "<p>There are no connected users.</p>";
	}
?>
</div>
<div class='itemcontainer' id="delivered">
<?php 
$delivered_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN project_partners on kind_donations.partner_id=project_partners.partner_id
				JOIN donors on kind_donations.donor_id=donors.donor_id
				WHERE kind_donations.status='Delivered'";
$delivered_ex=mysql_query($delivered_query);
if(mysql_num_rows($delivered_ex)>0){
?>
<?php 
echo "<h3>Completed transactions</h3>";
echo "<table class='table-item' style='width:750px;border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:30px;font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Requested By</th>
			<th>Address</th>
			<th>Delivery Date</th>
			<th></th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($delivered_ex)){	?>
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
							<a href="<?php echo $row['website_url']; ?>" target="_blank"><?php echo $row['name']; ?>
							<span id="reqadd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['request_address'].",".$row['request_city'];?></p>
							</span>
						</a>
					</td>
					<td>
						<span class="link">
							<a><?php echo $row['displayname']; ?>
							<span id="offeradd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['offer_address'].",".$row['offer_city'];?></p>
							</span>
						</a>
					</td>
					<td><?php echo $row['delivery_date'];?></td>
					<td><input type="submit" value="Archive" /></td>
				</tr>
			</table>
		</div>
	</div>
<?php
	}}
else {
		echo "<p>There are no Delivered material.</p>";
	}
?>
</div>
