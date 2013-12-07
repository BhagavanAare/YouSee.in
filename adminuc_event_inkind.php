<?php session_start();
$thispage="myuc"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">

	<script src="scripts/jquery.min.js"></script>
			<script src="scripts/jquery.blockUI.js"></script>
<script type="text/javascript">
		$(function() {
		$("#category").change(function(){
			$("#item option").show();
			if($(this).data('itemoptions') == undefined){
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('itemoptions',$('#item option').clone());
			}	
		var id = $(this).val();
		var itemoptions = $(this).data('itemoptions').filter('[name=' + id + ']');
		$('#item').html(itemoptions);
		$('#item').prepend('<option value="" selected="selected" >--Select--</option>');
		});
	});
</script>	
<title>My UC | Events - Inkind donations</title>

</head>
<body >
<div id="wrapper">
<?php include("header_navbar.php"); ?>
<div id="content-main">
<table>
<tr>
<td valign="top">
<?php include 'adminUcTabs.php';?>
</td>
<td>
<div class="right_div"  style=" float:left; width: 750px; overflow: auto;" >
	<form name="requestForm" method="post" action="adminuc_event_inkind.php">
	<table  class="table-request"style="float:left;border-right:1px solid #ccc;">
	<th colspan="2" align="left"><h3>Update an In-Kind Donation</h3></th>
	<tr>
	<td align="right">NPO</td>
	<td>
			<select style="max-width:700px;" type="text" id="partner" name="partner_id" required > 
					<option value="">--SELECT--</option>
					    <?php
					    include('prod_conn.php'); 
				            $result= mysql_query('SELECT name,project_partners.partner_id FROM project_partners JOIN users ON project_partners.user_id = users.user_id WHERE registration_status="A" ORDER BY LOWER(name) ASC'); 
					    while($row= mysql_fetch_assoc($result)) {
						$data=$row['name'];
						$partner_id=$row['partner_id'];
						if(isset($_POST['partner_id']) && $_POST['partner_id']==$partner_id){
							echo '<option value="'.$partner_id.'" selected>'.$data.'</option>';
						}
						echo '<option value="'.$partner_id.'">'.$data.'</option>';
						}
					    ?>
			</select>
	</td>
	</tr>
	<tr>
	<td align="right">Category</td>
	<td>
			<select style="max-width:120px;" type="text" id="category" name="category" required > 
					<option value="">--SELECT--</option>
					    <?php
					    include('prod_conn.php'); 
						mysql_connect("$dbhost","$dbuser","$dbpass");
						mysql_select_db("$dbdatabase");
				            $result= mysql_query('SELECT category,category_id FROM item_category'); ?> 
					    <?php while($row= mysql_fetch_assoc($result)) {
						$data=$row['category'];
						$category_id=$row['category_id'];
						echo '<option value="'.$category_id.'">'.$data.'</option>';
						}
					    ?>
			</select>
	</td>
	</tr>
	<tr>
	<td align="right">Item</td>
	<td> 
	<select style="max-width:120px;" type="text" name="item" id="item" required />
	<option value="">--SELECT--</option>
			<?php
			include('prod_conn.php'); 
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$sql=mysql_query("SELECT * from items JOIN item_category ON items.category_id=item_category.category_id");
			while($row=mysql_fetch_array($sql))
			{
				$data=$row['donationitem'];
				$data1=$row['category'];
				$id=$row['item_id'];
				$category=$row['category_id'];
				echo '<option value="'.$id.'" name="'.$category.'" hidden>'.$data.'</option>';
			}
			?>
        </select>
	</td>
	</td>
	</tr>
	<tr>
	<td align="right">Units Type</td>
	<td><select name="units_type" required>
			<option value="" selected="selected">---SELECT---</option>
			<option value="Kgs">Kgs</option>
			<option value="Litres">Litres</option>
			<option value="Pieces">Pieces</option>
			<option value="Boxes">Boxes</option>
			<option value="Packets">Packets</option>
	</td>
	</td>
	</tr>
	<tr>
	<td align="right">Request Quantity</td>
	<td> <input type="text" name="request_quantity" size="5" maxlength="5" required> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Request City</td>
	<td> <input type="text" name="request_city" value="Hyderabad" required ></td>
	</tr>
	<tr>
	<td align="right">Request Address</td>
	<td> <textarea rows="3" value="" name="request_address" required ></textarea></td>
	</tr>
	<tr hidden>
	<td align="right">Request Expiry Date <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>The default Request Expiry Date is set to 90 days from Current Date. An Earlier date can be set by the NGO.</span></a></span></td>
	<td> <input type="text" placeholder="YYYY/MM/DD" name="req_exp_date" id="req_exp_date" size="10" value='<?php date_default_timezone_set('Asia/Kolkata');$end = date("d-M-Y",strtotime("+3 months"));
 echo $end; ?>' required /> </td>
	</tr>
	<tr><td colspan="2" align="center"><input type="submit" name="request_submit" value="Submit" /></td></tr>
</table>
</form>
<?php
if (isset($_POST['request_submit'])){

 //connect to database
 include_once("prod_conn.php");
	$partnerquery="SELECT partner_id,name from project_partners WHERE partner_id=".$_POST['partner_id'];
	$partner=mysql_fetch_array(mysql_query($partnerquery));
	$insert_inkind = "INSERT INTO kind_donations(initiative_type,partner_id,donor_id,item_id,units_type,request_quantity,offer_quantity,request_city,offer_city ,request_address,offer_address, request_date,offer_date, request_expiry_date,delivery_date, transport,note,status)
			  VALUES ('0','$partner[partner_id]',138,'$_POST[item]','$_POST[units_type]', '$_POST[request_quantity]','$_POST[request_quantity]', '$_POST[request_city]','$_POST[request_city]', '$_POST[request_address]','$_POST[request_address]', CURDATE() , CURDATE() , '".date("Y-m-d",strtotime($_POST['req_exp_date']))."',CURDATE(), '0','Donation Camps, Individual Donations.','Delivered')";
	$registration = mysql_query($insert_inkind);
	$subid=mysql_insert_id();
	$update=mysql_query("UPDATE kind_donations set sub_id=$subid WHERE donation_id=$subid");
	$item=mysql_fetch_array(mysql_query("SELECT donationitem,request_quantity from items INNER JOIN item_category on items.category_id=item_category.category_id INNER JOIN kind_donations ON items.item_id=kind_donations.item_id  WHERE kind_donations.donation_id=$subid"));

?>
	<h3 align="center">Update succesful.</h3>
<?php
 $table="
  <table style='border-collapse:collapse;float:right;' border='1'>
  <tr>
  <th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Request Details</th>
  </tr>
  <tr>
  <td>Partner</td>
  <td>" . $partner['name'] . "</td>
  </tr>
  <tr>
  <tr>
  <td>Item </td>
  <td>" . $item['donationitem'] . "</td>
  </tr>
  <tr>
  <td>Quantity </td>
  <td>" . $item['request_quantity'] . "</td>
  </tr>
  </table>";
 echo $table;
	exit();
}
?>	

</div>

</td>
</tr>
</table>
</div>
<!--footer-->
<br />
<?php include 'footer.php' ; ?>
<!--#footer-->
</div>
</body>
</html>
