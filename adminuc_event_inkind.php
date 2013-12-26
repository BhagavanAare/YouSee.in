<?php

$thispage = "myuc";

require_once ('login_auth.php');

if (!$_SESSION['SESS_USER_TYPE'] == 'A')
{
	header("Location: login_failed");
}

include ('prod_conn.php');
mysql_connect("$dbhost", "$dbuser", "$dbpass");
mysql_select_db("$dbdatabase");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<style>
			.search_list
			{
				border:1px solid transpaent;
				padding:1px;
				margin:0px;
			}
			.search_list:hover
			{
				border:1px solid #ccc;
				cursor:pointer;
				font-weight:bold;
			}
		</style>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/tabs.css">
		<link rel="stylesheet" href="scripts/jquery-ui.css">
		<script src="scripts/jquery.min.js"></script>
		<script src="scripts/jquery.ui.core.js"></script>
		<script src="scripts/jquery.ui.widget.js"></script>
		<script src="scripts/datepicker.js"></script>
		<script src="scripts/ajax_donor_utility.js"></script>
		<script type="text/javascript">
			$(function() {
				$("#category").change(function() {
					$("#item option").show();
					if ($(this).data('itemoptions') == undefined) {
						/*Taking an array of all options-2 and kind of embedding it on the select1*/
						$(this).data('itemoptions', $('#item option').clone());
					}
					var id = $(this).val();
					var itemoptions = $(this).data('itemoptions').filter('[name=' + id + ']');
					$('#item').html(itemoptions);
					$('#item').prepend('<option value="" selected="selected" >--Select--</option>');
				});
			});
		</script>
		<?php

		///// Partner Data
		$npoAdress = array();
		$npoNameArray = array();
		$npoID = array();
		$npoCity = array();
		$result = mysql_query('SELECT name,project_partners.partner_id, project_partners.address, project_partners.hq_town_city FROM project_partners JOIN users ON project_partners.user_id = users.user_id WHERE registration_status="A" ORDER BY LOWER(name) ASC');
		while ($row = mysql_fetch_assoc($result))
		{
			$npoNameArray[] = $row['name'];
			$npoAdress[] = $row['address'];
			$npoID[] = $row['partner_id'];
			$npoCity[] = $row['hq_town_city'];

		}

		//Service places data

		$placeIds = array();
		$placeNames = array();
		$placePartnerIds = array();
		$placeLocations = array();
		$placeCity = array();
		$placeAddress = array();
		$result = mysql_query('SELECT place_id, place_title, location, city, address, partner_id FROM places');
		while ($row = mysql_fetch_array($result))
		{
			$placeIds[] = $row['place_id'];
			$placeNames[] = $row['place_title'];
			$placePartnerIds[] = $row['partner_id'];
			$placeLocations[] = $row['location'];
			$placeCity[] = $row['city'];
			$placeAddress[] = $row['address'];
		}

		// ////////category data
		$result = mysql_query('SELECT category,category_id FROM item_category');
		$categoryIDs = array();
		$categoryData = array();
		while ($row = mysql_fetch_assoc($result))
		{
			$categoryData[] = $row['category'];
			$categoryIDs[] = $row['category_id'];
		}

		// //////////Item Data
		$donationItems = array();
		$catagories = array();
		$itemIDs = array();
		$itemcategoryIDs = array();
		$sql = mysql_query("SELECT * from items JOIN item_category ON items.category_id=item_category.category_id");

		while ($row = mysql_fetch_array($sql))
		{
			$donationItems[] = $row['donationitem'];
			$catagories[] = $row['category'];
			$itemIDs[] = $row['item_id'];
			$itemcategoryIDs[] = $row['category_id'];
		}
		?>

		<script type="text/javascript">

			$(document).ready(function()
{

var i=0;
$("#addButton").click(function()
{
var categoryData = "<tr id='itemRow"+i+"'><td></td><td align='center'><select style='max-width: 120px;' type='text' id='category"+i+"' name='category[]' required> <option value=''>--SELECT--</option>";<?php

for ($i = 0; $i < count($categoryIDs); $i++)
{
	echo "categoryData+=\"<option value='$categoryIDs[$i]'>$categoryData[$i]</option>\";";
}
?>
	categoryData += "</select></td>";

	var itemData = "<td><select style='max-width: 120px;' type='text' name='item[]' id='item" + i + "' required > <option value='' >--SELECT--</option>"; 
<?php
for ($i = 0; $i < count($itemIDs); $i++)
{

	echo "itemData+= \"<option value='$itemIDs[$i]' name='$itemcategoryIDs[$i]' hidden>$donationItems[$i]</option>\"; ";
}
?>
	itemData += "</select></td>";

	var unitsType = "<td><select name='units_type[]' required>";
	unitsType += "<option value='' selected='selected'>---SELECT---</option>";
	unitsType += "<option value='Kgs'>Kgs</option>";
	unitsType += "<option value='Litres'>Litres</option>";
	unitsType += "<option value='Pieces'>Pieces</option>";
	unitsType += "<option value='Boxes'>Boxes</option>";
	unitsType += "<option value='Packets'>Packets</option></td>";
	unitsType += "</td>";

	var requestQuntity = "";
	requestQuntity += "<td><input type='text' name='request_quantity[]' size='5'";
	requestQuntity += "		maxlength='5' required></td>";
	requestQuntity += "	</td>";

	var removeButton = "<td align='right'><input type='button' id='removeButton" + i + "' value='x' /></td></tr>";

	$(categoryData + itemData + unitsType + requestQuntity + removeButton).clone().appendTo($("#items"));
	var category = "category" + i;
	var item = "item" + i;
	var removeButtonId = "removeButton" + i;
	var itemRowId = "itemRow" + i;
	$("#" + category).change(function() {

		$("#" + item + " option").show();
		if ($(this).data('itemoptions') == undefined) {
			/*Taking an array of all options-2 and kind of embedding it on the select1*/
			$(this).data('itemoptions', $("#" + item + " option").clone());
		}
		var id = $(this).val();
		var itemoptions = $(this).data('itemoptions').filter('[name=' + id + ']');
		$('#' + item).html(itemoptions);
		$('#' + item).prepend('<option value="" selected="selected" >--Select--</option>');
	});
	$("#" + removeButtonId).click(function() {

		$("#" + itemRowId).remove();
	});
	i++;

	});
	});

		</script>
		<script type="text/javascript">
		
																								// updating City and Address fields when an NPO is selected.
			$(document).ready(function() {
				
				$("#opp_date").datepicker();
				$("#opp_date").val($.datepicker.formatDate('yy/mm/dd', new Date()));
				
				var addressArray = [];
				var cityArray = [];
				var placeAddressArray = [];
				var placeCityArray = [];
				<?php
				for ($i = 0; $i < count($npoAdress); $i++)
				{
					echo "addressArray['$npoID[$i]'] = '$npoAdress[$i]';";
					echo "cityArray['$npoID[$i]'] = '$npoCity[$i]';";
				}
				for ($i = 0; $i < count($placeAddress); $i++)
				{
					echo "placeAddressArray['$placeIds[$i]'] = '$placeAddress[$i]';";
					echo "placeCityArray['$placeIds[$i]'] = '$placeCity[$i]';";
				}
				?>

					$("#partner").change(function() {
						
						$("#place option").show();
						if ($(this).data('itemoptions') == undefined) {
							/*Taking an array of all options-2 and kind of embedding it on the select1*/
							$(this).data('itemoptions', $("#place option").clone());
						}
						var id = $(this).val();
						console.log(id);
						var itemoptions = $(this).data('itemoptions').filter('[name=' + id + ']');
						$('#place').html(itemoptions);
						$('#place').prepend('<option value="" selected="selected" >--Select--</option>');
						
						var value = $('#partner').val();
						

						if (value != '') {
							var address = addressArray['' + value];
							var city = cityArray['' + value];
							console.log('' + value);
							$("#requestAddress").val('' + address);
							$("#requestCity").val('' + city);
						} else {
							$("#requestAddress").val('');
							$("#requestCity").val('');
						}

					});
					$("#place").change(function(){
						var value = $('#place').val();
						if(value!='')
						{
							var address = placeAddressArray['' + value];
							var city = placeCityArray['' + value];
							console.log('' + value);
							$("#requestAddress").val('' + address);
							$("#requestCity").val('' + city);
						}	
					});
					});
					
		</script>
		<title>My UC | Events - Inkind donations</title>

	</head>
	<body>
		<div id="wrapper">
			<?php
			include ("header_navbar.php");
			?>
			<div id="content-main">
				<table>
					<tr>
						<td valign="top"><?php
						include 'adminUcTabs.php';
						?></td>
						<td>
						<div class="right_div"
						style="float: left; width: 750px; overflow: auto;">
							<form name="requestForm" method="post"
							action="adminuc_event_inkind.php">
								<table class="table-request"
								style="float: left; border-right: 1px solid #ccc;width:750px;">
									<th colspan="2" align="left"><h3>Update an In-Kind Donation</h3></th>
									<tr>
										<td id="partnertd" align="right">NPO*</td>
										<td colspan="4">
										<select style="max-width: 700px;" type="text"
										id="partner" name="partner_id" required>
											<option value="">--SELECT--</option>
											<?php

											$npoCount = count($npoID);
											for ($i = 0; $i < $npoCount; $i++)
											{
												echo '<option value="' . $npoID[$i] . '">' . $npoNameArray[$i] . '</option>';
											}
											?>
										</select></td>
									</tr>
									<tr>
										<td align="right">Service Place</td>
										<td colspan="4">
										<select  type="text" id="place" name="place_id" >
											<option value="">--SELECT--</option>
											<?php 
											$placeCount = count($placeIds);
											for($i=0;$i<$placeCount;$i++)
											{
												echo "<option value='$placeIds[$i]' name='$placePartnerIds[$i]' hidden>$placeNames[$i], $placeLocations[$i]</option> ";
											}
											?>
										</select>
										</td>
									</tr>
									<tr> 
										<td align="right">Donor*</td> 
										<td colspan="8">
											<input type="text" id="donor_search" placeholder="Donor Name" size=20 name="donor_name" /> 
											<input type="text" name="donor_id" id="donor_selected" hidden />
<span id="donor_info" style="float:left" hidden><b>Donor Info</b><br /> 
<input type="text"  name="donor_email" placeholder="Email" id="emailbox" readonly />
<input type="text" name="donor_mobile" id="mobilebox" placeholder="Mobile" size="10" readonly />
<input type="text" name="donor_city" name="citybox" placeholder="City" size="12" id="citybox" readonly />
<input type="text" name="donor_org" id="orgbox" placeholder="Organization" size="14" readonly />
<input type="hidden" id="donor_address" name="donor_address"  />
</span>
<div id="search_result" style="border: 1px solid #ccc;height:auto;background:white;max-height:300px;width:300px; overflow:auto;display:none;position:absolute;z-index:1000">
</div>
</div>
</td>
</tr>
						<tbody id="items">
										<tr>
											<td rowspan="2" align="right">Items</td>
											<th  colspan="1">Category</th>
											<th colspan="1">Item</th>
											<th colspan="1">Units Type</th>
											<th colspan="1">Quantity</th>
										</tr>
										<tr id="itemRow">
											<td align="center">
											<select style="max-width:120px;" type="text"
											id="category" name="category[]" required>
												<option value="">--SELECT--</option>
												<?php

												for ($i = 0; $i < count($categoryIDs); $i++)
												{
													echo "categoryData+=\"<option value='$categoryIDs[$i]'>$categoryData[$i]</option>\";";
												}
												?>
											</select></td>
											<td>
											<select style="max-width: 120px;" type="text"
											name="item[]" id="item" required />
											<option value="">--SELECT--</option>
											<?php

											for ($i = 0; $i < count($itemIDs); $i++)
											{

												echo "itemData+= \"<option value='$itemIDs[$i]' name='$itemcategoryIDs[$i]' hidden>$donationItems[$i]</option>\"; ";
											}
											?>
											</select></td>
						</td>
						<td>
						<select name="units_type[]" required>
							<option value="" selected="selected">---SELECT---</option>
							<option value="Kgs">Kgs</option>
							<option value="Litres">Litres</option>
							<option value="Pieces">Pieces</option>
							<option value="Boxes">Boxes</option>
							<option value="Packets">Packets</option>
						</td>
						</td>
						<td>
						<input type="text" name="request_quantity[]" size="5"
						maxlength="5" required>
						</td>
						</td>
					</tr>
					</tbody>
					
					<tr>
						<td align="right" colspan="8">
						<input type="button"
						value="+add" id="addButton" />
						</td>
					</tr>
					<tr>
						<td align="right">Delivery Date*</td>
						<td><input  type="text" name="dod" id="opp_date" maxlength="450" cols="40" rows="5"></textarea> </td>
					</tr>
							
					<tr>
						<td align="right">Request City*</td>
						<td colspan="4">
						<input id="requestCity" type="text" name="request_city"
						value="Hyderabad" required />
						</td>
					</tr>
					<tr>
						<td align="right">Request Address*</td>
						<td colspan="4">						<textarea id="requestAddress" rows="3" value=""
												name="request_address" required></textarea></td>
					</tr>

					<tr>
						<td colspan="2" align="center">
						<input type="submit"
						name="request_submit" value="Submit" />
						</td>
					</tr>
				</table>
				</form>
				<?php
if (isset ( $_POST ['request_submit'] )) {

// connect to database
include_once ("prod_conn.php");
$partnerId = $_POST['partner_id'];
$partnerquery = "SELECT partner_id,name,partner_email,contact_first_name from project_partners WHERE partner_id=" . $_POST ['partner_id'];
$partner = mysql_fetch_array ( mysql_query ( $partnerquery ) );
$categoryArray = $_POST ['category'];
$unique_categories=array_unique($categoryArray);
$itemIDArray = $_POST ['item'];
$unitsTypeArray = $_POST ['units_type'];
$reqQuntityArray = $_POST ['request_quantity'];
$ids="";
$place = $_POST['place_id'];
$donorId = $_POST['donor_id'];
$date = $_POST['dod'];
$dod = date ( "Y-m-d", strtotime ( $_POST ['dod'] ) );
$formattedDate = date ( "d-M-Y", strtotime ( $_POST ['dod'] ) );
$donorName = $_POST['donor_name'];
$donorMail = $_POST['donor_email'];
$donorCity = $_POST['donor_city'];
$donorAddress = $_POST['donor_address'];

$tables = array ();
$itemCount = count ( $categoryArray );
$tableText = "<table cellpadding='4'  style='border-collapse:collapse;' align='center' border='1'>";
$tableText.= "<tr>
<th colspan=\"4\" align=\"center\" height=\"20\" valign=\"top\">Items Recieved</th>
</tr>";
$tableText.= "<tr><th>S.No</th><th>Category</th><th>Item</th><th>Quantity</th></tr>";
for($j = 0; $j < $itemCount; $j ++) 
{
	$insert_inkind = "INSERT INTO kind_donations(initiative_type,partner_id,donor_id,item_id,units_type,request_quantity,offer_quantity,request_city,offer_city ,request_address,offer_address, request_date,offer_date, request_expiry_date,delivery_date, transport,note,status,place_id)
				VALUES ('0','$partner[partner_id]','$donorId','$itemIDArray[$j]','$unitsTypeArray[$j]', '$reqQuntityArray[$j]','$reqQuntityArray[$j]', '$donorCity','$_POST[request_city]', '$_POST[request_address]', '$donorAddress', '$dod' , '$dod' , '$dod','$dod', '0','Donation Camps, Individual Donations.','Delivered','$place')";
	$registration = mysql_query ( $insert_inkind );
	$subid = mysql_insert_id ();
	$update = mysql_query ("UPDATE kind_donations set sub_id=$subid WHERE donation_id=$subid");
	if(($itemCount-$j)==1){
	$ids.=$subid;
	}
	else{
		$ids.=$subid.",";
	}
}
	$query="SELECT donationitem,category,request_quantity,units_type from items INNER JOIN item_category on items.category_id=item_category.category_id INNER JOIN kind_donations ON items.item_id=kind_donations.item_id  WHERE kind_donations.donation_id IN ($ids) ORDER BY category";
	$result=mysql_query($query);
	$i=1;
	while($row=mysql_fetch_array($result)){
		$tableText.="<tr><td>$i</td><td>$row[category]</td><td>$row[donationitem]</td><td>$row[request_quantity] $row[units_type]</td></tr>";
		$i++;
	}

$tableText.="</table><br />";

$partnerEmail = $partner ['partner_email'];
$partnerName = $partner ['name'];
$partnerContactName = $partner['contact_first_name'];
$emailBody = "To,<br /> $partnerName <br /><br />
Dear $partnerContactName,<br><br>

This is to inform you that the following items have been received by $partnerName";

if($place != '')
{
	$emailBody .= " for ".$placeNames[$partnerId].", ";
}
$emailBody .=  " donated by $donorName on $formattedDate.<br /><br />";

$emailBody .= $tableText;
$emailBody .= "You may reply to this email or call +91-8008-884422 for any further information you may like to have from <a href=\"www.yousee.in\">YouSee</a>.";
//echo "$emailBody";



sendEmail ( $partnerEmail, $donorMail, $partnerContactName, $emailBody);

				?>

				<?php
				}
				?>
			</div>

			<div align="center">
				<?php

				if (isset($_POST['request_submit']))
				{
					echo "<h3 align='center'>Update succesful.</h3>";
					//echo "<h2>Recent In-Kind Updates</h2>";
					echo "$tableText";
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
		<?php
		include 'footer.php';
		?>
		<!--#footer-->
		</div>
	</body>
</html>

<?php
function sendEmail($email, $donorMail, $displayName, $mailBody)
{
	// global $string, $mailText;
	require_once ("Email/class.phpmailer.php");
	require_once 'Email/config.php';
	try
	{
		$to = $email;
		$mail -> AddAddress($to);
		$mail -> AddCC($donorMail);
		$mail -> AddBCC('gunaranjan@yousee.in');

		$body = $mailBody;
		$body .= "<br><br><br> From YouSee  (+91-8008-884422) <br /> <a href=\"www.yousee.in\">www.yousee.in</a>";
		$mail -> Subject = "In-Kind Donations Recieved";
		$mail -> Body = $body;
		if ($mail -> Send())
		{;
		}
		else
		{
			echo "<script>alert('email failed');</script>";
			$mail -> ErrorInfo;
			showError();
		}
	}
	catch ( phpmailerException $e )
	{
		echo $e -> errorMessage();
		echo "<script>alert('Message failed');</script>";
		// showError();
	}
}
?>
