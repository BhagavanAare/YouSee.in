<?php if(isset($_POST['request'])){
	session_start();
	if(isset($_SESSION['SESS_USER_TYPE']) && $_SESSION['SESS_USER_TYPE']=="N") {
	?>
	<form name="requestForm" method="post" action="inkind_exc.php">
	<table  class="table-request">
	<th colspan="2" align="left"><h3>Make an Inkind Request</h3></th>
	<tr>
	<td align="right">Category</td>
	<td>
			<select style="max-width:120px;" type="text" id="category" name="category"> 
					<option value="NULL">--SELECT--</option>
					    <?php
					    include('prod_conn.php'); 
						mysql_connect("$dbhost","$dbuser","$dbpass");
						mysql_select_db("$dbdatabase");
				            $result= mysql_query('SELECT DISTINCT donationitemcategory,category_id FROM items'); ?> 
					    <?php while($row= mysql_fetch_assoc($result)) {
						$data=$row['donationitemcategory'];
						$category_id=$row['category_id'];
						echo '<option value="'.$category_id.'">'.$data.'</option>';
						}
					    ?>
			</select> 
	</td>
	</td>
	</tr>
	<tr>
	<td align="right">Item</td>
	<td> 
	<select style="max-width:120px;" type="text" name="item" id="item" />
	<option value="NULL">--SELECT--</option>
			<?php
			include('prod_conn.php'); 
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$sql=mysql_query("SELECT * from items");
			while($row=mysql_fetch_array($sql))
			{
				$data=$row['donationitem'];
				$data1=$row['donationitemcategory'];
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
	<td><select name="units_type">
			<option value="" selected="selected">---SELECT---</option>
			<option value="kilograms">Kilograms</option>
			<option value="litres">Litres</option>
			<option value="cartons">Cartons</option>
			<option value="pieces">Pieces</option>
			<option value="bags">Bags</option>
			<option value="cans">Cans</option>
			<option value="tins">Tins</option>
			<option value="packets">Packets</option>
			<option value="others">Others</option>
	</td>
	</td>
	</tr>
	<tr>
	<td align="right">Additional Unit Info <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Eg: If you have selected Units Type as Bags, Additional Unit Info will be 10, if you want 10 bags.</span></a></span></td>
	<td> <input type="text" name="unit_quantity" size="5" maxlength="5"> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Request Quantity</td>
	<td> <input type="text" name="request_quantity" size="5" maxlength="5"> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Request City</td>
	<td> <input type="text" name="request_city"> </td>
	</tr>
	<tr>
	<td align="right">Request Address</td>
	<td> <textarea rows="3" name="request_address"> </textarea></td>
	</tr>
	<tr>
	<td align="right">Request Expiry Date <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>The default Request Expiry Date is set to 90 days from Current Date. An Earlier / Later date can be set by the NGO.</span></a></span></td>
	<td> <input type="text" name="req_exp_date" id="req_exp_date" size="10" value='<?php date_default_timezone_set('Asia/Kolkata');$end = date("Y/m/d",strtotime("+3 months"));
 echo $end; ?>'> </td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="radio" name="transport" value="0" id="deliver"> 
			<label for="deliver">Deliver</label>
			<input type="radio" name="transport" value="1" id="pick-up">
			<label for="pick-up">Pick-up</label>
		</td>
	</tr>
	<tr><td colspan="2" align="center"><input type="submit" name="request_submit" value="Submit" /></td></tr>
</table>
</form>
<?php } 
}
elseif(isset($_POST['donate'])){
	session_start();
	if(isset($_SESSION['SESS_USER_TYPE']) && $_SESSION['SESS_USER_TYPE']=="D") {
	?> 


	<form name="offerForm" method="post" action="inkind_exc.php">
	<table  class="table-request">
	<th colspan="2" align="left"><h3>Make an Inkind Offer</h3></th>
	<tr>
	<td align="right">Category</td>
	<td>
			<select style="max-width:120px;" type="text" id="category" name="category"> 
					<option value="NULL">--SELECT--</option>
					    <?php
					    include('prod_conn.php'); 
						mysql_connect("$dbhost","$dbuser","$dbpass");
						mysql_select_db("$dbdatabase");
				            $result= mysql_query('SELECT DISTINCT donationitemcategory,category_id FROM items'); ?> 
					    <?php while($row= mysql_fetch_assoc($result)) {
						$data=$row['donationitemcategory'];
						$category_id=$row['category_id'];
						echo '<option value="'.$category_id.'">'.$data.'</option>';
						}
					    ?>
			</select> 
	</td>
	</td>
	</tr>
	<tr>
	<td align="right">Item</td>
	<td> 
	<select style="max-width:120px;" type="text" name="item" id="item" />
	<option value="NULL">--SELECT--</option>
			<?php
			include('prod_conn.php'); 
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$sql=mysql_query("SELECT * from items");
			while($row=mysql_fetch_array($sql))
			{
				$data=$row['donationitem'];
				$data1=$row['donationitemcategory'];
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
	<td><select name="units_type">
			<option value="" selected="selected">---SELECT---</option>
			<option value="kilograms">Kilograms</option>
			<option value="litres">Litres</option>
			<option value="cartons">Cartons</option>
			<option value="pieces">Pieces</option>
			<option value="bags">Bags</option>
			<option value="cans">Cans</option>
			<option value="tins">Tins</option>
			<option value="packets">Packets</option>
			<option value="others">Others</option>
	</td>
	</td>
	</tr>
	<tr>
	<td align="right">Additional Unit Info <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Eg: If you have selected Units Type as Bags, Additional Unit Info will be 10, if you want 10 bags.</span></a></span></td>
	<td> <input type="text" name="unit_quantity" size="5" maxlength="5"> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Offer Quantity</td>
	<td> <input type="text" name="offer_quantity" size="5" maxlength="5"> </td>
	</td>
	</tr>
	<tr>
	<td align="right">Offer City</td>
	<td> <input type="text" name="offer_city"> </td>
	</tr>
	<tr>
	<td align="right">Offer Address</td>
	<td> <textarea rows="3" name="offer_address"> </textarea></td>
	</tr>
	<tr>
	<td align="right">Offer Expiry Date <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>The default Offer Expiry Date is set to 90 days from Current Date. An Earlier / Later date can be set by the user.</span></a></span></td>
	<td> <input type="text" name="offer_exp_date" id="offer_exp_date" size="10" value='<?php date_default_timezone_set('Asia/Kolkata');$end = date("Y/m/d",strtotime("+3 months"));
 echo $end; ?>'> </td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="radio" name="transport" value="0" id="deliver"> 
			<label for="deliver">Deliver</label>
			<input type="radio" name="transport" value="1" id="pick-up">
			<label for="pick-up">Pick-up</label>
		</td>
	</tr>
	<tr><td colspan="2" align="center"><input type="submit" name="offer_submit" value="Submit" /></td></tr>
</table>
</form>
<?php } }?>