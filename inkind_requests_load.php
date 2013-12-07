<?php 
session_start();
$thispage="inkind_requests";

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
$where_var=$_SESSION['where_var'];
if(isset($_SESSION['page_number'])){
$_SESSION['page_number']++;
}
else {
$_SESSION['page_number']=2;
}
$filtered = filter_input(INPUT_GET, "lastComment", FILTER_SANITIZE_URL);
$request_query="SELECT * FROM kind_donations JOIN items on kind_donations.item_id=items.item_id
				JOIN project_partners on kind_donations.partner_id=project_partners.partner_id
				WHERE initiative_type=0 AND request_quantity>offer_quantity AND offer_quantity=0 AND status='Open' AND request_expiry_date>'".date("Y-m-d")."'".$where_var." AND kind_donations.donation_id>".$filtered." LIMIT 0,20 ";
$request_ex=mysql_query($request_query);
if(mysql_num_rows($request_ex)>0){
?>

  <link rel="stylesheet" type="text/css" href="css/inkind_items.css">  
<div class='itemcontainer' id="requests_inkind">
<div style="width:95%;padding:3px;background:#ccc;font-size:14px;font-weight:bold;font-family:Trebuchet MS;padding-left:30px;">Page <?php echo $_SESSION['page_number'];?></div>

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
					<td><?php echo $row['request_quantity']." ".$row['units_type']; ?></td>
					<td>
						<span class="link">
							<a href="/npo/<?php echo $row['project_id']; ?>" target="_blank"><?php echo $row['name']; ?>
							<span id="reqadd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;"><?php echo $row['request_address'].",".$row['request_city'];?></p>
							</span>
						</a>
					</td>
					<td><?php if($row['transport']==1) echo "<img src='images/npo.png' alt='Pick-up' />"; else echo "<img src='images/donor.png' alt='Deliver' />" ?></td>
					<td style="text-align:left;">
						<input type="text" value="<?php echo $row['request_quantity'];?>" id="offer_quantity<?php echo $row['donation_id'];?>" size="2" name="offer_quantity"/><?php echo $row['units_type'];?>
					</td>
					<td style="width:5%;"><input type="submit" value="Commit" class="commit_request" id="<?php echo $row['donation_id']; ?>" />
					<input type="text" value="<?php echo $row['donation_id'];?>" name="id" hidden />
					</td>
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
	} else{ mysql_close();return null;} }else return null; ?>
