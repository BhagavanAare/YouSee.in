<?php $thisdiv=$_POST['thisdiv']; ?>
<script type="text/javascript" src="scripts/ajax_inkind.js"></script>
 <script type="text/javascript">
		$(function() {
		$(".category").change(function(){
			$(".item option").show();
			if($(this).data('itemoptions') == undefined){
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('itemoptions',$('.item option').clone());
			}	
			var id = $(this).val();
			var itemoptions = $(this).data('itemoptions').filter('[name=' + id + ']');
			$('.item').html(itemoptions);
			$('.item').prepend('<option value="" selected="selected" >--Select--</option>');
		});
		});
	</script>
<table style="position:absolute;z-index:30;width:200px;border-right:1px solid #ccc;padding-left:15px;">
<tr><td><font style="font-weight:bold;font-size:16px;margin-left:20px;color:black;">Options </font><span id="clear_filters" style="cursor:pointer;color:#369;text-decoration:underline" <?php if(!isset($_REQUEST['category'])) echo "hidden";?>>Clear Filters</span><input align="right" type="button" class="clear_filter" value="Clear Filters" id="clear_filter" onclick="uncheck();location.reload();" style="visibility: hidden"></td></tr>
<thead hidden>
<tr>
<th>Search</th>
</tr>
</thead>
<tr hidden><td>
<input type="text" align="left" id="searchbox" style="width:130px" /><img align="right" style="width:20px;height:20px;cursor:pointer" src="" />
</td></tr>
<tr hidden>
<th>Search by date</th>
</tr>
<tr>
<td hidden>
<input type="text" align="left" id="datesearch" class="datesearch" style="width:130px" />
</td>
</tr>
<tr>
<td><b>Category</b></td>
</tr>
<tr>
<td>
<?php
//connect to database
session_start();
$where="";
if(isset($_SESSION['where_var'])){
	$where=$_SESSION['where_var'];
}
if(isset($_SESSION['where_inkind'])){
	$where=$_SESSION['where_inkind'];
}
require_once("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
if($thisdiv=="requests_inkind"){
$query="SELECT category, items.category_id, count(item_category.category_id ) as count
FROM item_category
INNER JOIN items ON item_category.category_id = items.category_id
INNER JOIN kind_donations ON items.item_id = kind_donations.item_id
WHERE initiative_type=0 AND status='Open' AND offer_quantity=0 AND request_expiry_date>'".date("Y-m-d")."'  ".$where."
GROUP BY items.category_id";
}
else if($thisdiv=="offers_inkind"){
$query="SELECT category, items.category_id, count(item_category.category_id ) as count
FROM item_category
INNER JOIN items ON item_category.category_id = items.category_id
INNER JOIN kind_donations ON items.item_id = kind_donations.item_id
WHERE initiative_type=1 AND status='Open' AND request_quantity=0 AND offer_expiry_date>'".date("Y-m-d")."' ".$where."
GROUP BY items.category_id";
}
$queryresult=mysql_query($query);
?>
			<select style="max-width:150px;" type="text" id="category" class="category" name="category"> 
					<option value="NULL">-------All-------</option>
					    <?php while($row= mysql_fetch_assoc($queryresult)) {
						$data=$row['category'];
						$count=$row['count'];
						$category_id=$row['category_id'];
						if(isset($_REQUEST['category'])){	
							if($_REQUEST['category']==$category_id){
							echo '<option value="'.$category_id.'" selected>'.$data." <font style='color:#aaa;font-size:10px'>(".$count.")</font>".'</option>';
							}
							else
							echo '<option value="'.$category_id.'">'.$data." <font style='color:#aaa;font-size:10px'>(".$count.")</font>".'</option>';
						}
						else
						echo '<option value="'.$category_id.'">'.$data." <font style='color:#aaa;font-size:10px'>(".$count.")</font>".'</option>';
						}
					    ?>
			</select> 
			<br /><br />
</td>
</tr>
<tr>
<td><b>Item</b></td>
</tr>
<tr>
<td>
	<select style="max-width:120px;" type="text" name="item" id="item" class="item">
	<option value="NULL">-------All-------</option>
			<?php
			include('prod_conn.php'); 
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			if($thisdiv=="requests_inkind"){
			$sql=mysql_query("SELECT donationitem,item_category.category_id, items.item_id, count( kind_donations.item_id ) as count
							FROM item_category
							INNER JOIN items ON item_category.category_id = items.category_id
							INNER JOIN kind_donations ON items.item_id = kind_donations.item_id
							WHERE initiative_type =0 AND status='Open' ".$where."
							GROUP BY kind_donations.item_id");
			}
			else if($thisdiv=="offers_inkind"){
			$sql=mysql_query("SELECT donationitem,item_category.category_id, items.item_id, count( kind_donations.item_id ) as count
							FROM item_category
							INNER JOIN items ON item_category.category_id = items.category_id
							INNER JOIN kind_donations ON items.item_id = kind_donations.item_id
							WHERE initiative_type =1 AND status='Open' ".$where."
							GROUP BY kind_donations.item_id");
			}
			while($row=mysql_fetch_array($sql))
			{
				$data=$row['donationitem'];
				$id=$row['item_id'];
				$count=$row['count'];
				$category=$row['category_id'];
				if(isset($_REQUEST['category'])){
					if(isset($_REQUEST['item'])){
					if($_REQUEST['item']==$id){
							echo '<option value="'.$id.'" name="'.$category.'" selected>'.$data.' ('.$count.')'.'</option>';
							}
					else{
					echo '<option value="'.$id.'" name="'.$category.'">'.$data.' ('.$count.')'.'</option>';
					}
					}
					else
							echo '<option value="'.$id.'" name="'.$category.'">'.$data.' ('.$count.')'.'</option>';
						}
				echo '<option value="'.$id.'" name="'.$category.'" hidden>'.$data.' ('.$count.')'.'</option>';
			}
			?>
        </select>
		<br /><br />
</td>
</tr>
<tr>
<td><b>City</b></td>
</tr>
<tr>
<td>
<?php 
if($thisdiv=="requests_inkind"){
$query="SELECT distinct request_city,count(request_city) as count from kind_donations 
INNER JOIN items ON kind_donations.item_id=items.item_id
INNER JOIN item_category ON items.category_id=item_category.category_id 
WHERE request_city!='' AND status='Open' AND initiative_type=0 AND offer_quantity=0 AND request_expiry_date>'".date("Y-m-d")."' ".$where." GROUP BY request_city";
$queryresult=mysql_query($query);
while($result=mysql_fetch_array($queryresult)){
?><input type="checkbox" name="request_city[]" value="<?php echo $result['request_city'];?>" id="<?php echo preg_replace('/( *)/', '', $result['request_city']);?>" class="city" onchange="visible();" 
<?php if(isset($_REQUEST['request_city'])){
		if($_REQUEST['request_city'][0]==$result['request_city']){
			echo "checked"; 
			}
		}
?>	
><label for="<?php echo $result['request_city'];?>"><?php echo $result['request_city']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
<?php }}
elseif($thisdiv=="offers_inkind") {
$query="SELECT distinct offer_city,count(offer_city) as count from kind_donations 
INNER JOIN items ON kind_donations.item_id=items.item_id
INNER JOIN item_category ON items.category_id=item_category.category_id 
WHERE offer_city!='' AND status='Open' AND initiative_type=1 AND request_quantity=0 AND offer_expiry_date>'".date("Y-m-d")."' ".$where." GROUP BY offer_city";
$queryresult=mysql_query($query);
while($result=mysql_fetch_array($queryresult)){
?><input type="checkbox" name="offer_city[]" value="<?php echo $result['offer_city'];?>" id="<?php echo preg_replace('/( *)/', '', $result['offer_city']);?>" class="city" onchange="visible();" 
<?php if(isset($_REQUEST['request_city'])){
		if($_REQUEST['request_city'][0]==$result['offer_city']){
			echo "checked"; 
			}
		}
?>	
><label for="<?php echo $result['offer_city'];?>"><?php echo $result['offer_city']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
<?php } }
?>
		<br /><br />
</td>
</tr>
<tr>
<td><b>Transport type</b></td>
</tr>
<tr>
<td>
<?php
if($thisdiv=="requests_inkind"){
$query="SELECT transport,count(transport) as count from kind_donations 
INNER JOIN items ON kind_donations.item_id = items.item_id
INNER JOIN item_category ON items.category_id = item_category.category_id
WHERE initiative_type=0 AND status='Open' ".$where." GROUP BY transport";
}
if($thisdiv=="offers_inkind"){
$query="SELECT transport,count(transport) as count from kind_donations
INNER JOIN items ON kind_donations.item_id = items.item_id
INNER JOIN item_category ON items.category_id = item_category.category_id
 WHERE initiative_type=1 AND status='Open' ".$where." GROUP BY transport";
}
$result=mysql_query($query);
while($row=mysql_fetch_array($result)){
if($row['transport']==0){
?>
<input type="checkbox" name="transport[]" value="0" id="Deliver" class="transport" onchange="visible();"
<?php if(isset($_REQUEST['transport'])){
		if($_REQUEST['transport'][0]=='0'){
			echo "checked"; 
			}
		}
	?>		
><label for="Delivery">Deliver <font style='color:#666;font-size:12px'>(<?php echo $row['count']; ?>)</font></label></input><br />
<?php } 
else if($row['transport']==1){ ?>
<input type="checkbox" name="transport[]" value="1" id="Pick-up" class="transport" onchange="visible();"
<?php if(isset($_REQUEST['transport'])){
		if($_REQUEST['transport'][0]=='1'){
			echo "checked"; 
			}
		}
	?>	
><label for="Pick-up">Pick-up <font style='color:#666;font-size:12px'>(<?php echo $row['count']; ?>)</font></label></input>
<?php } 
}?>
	<br /><br />
</td>
</tr>
</table>
<?php
/* Change log

02-Jun-2013 - Vivek - Query altered to display active requests and offers.

*/
?>	