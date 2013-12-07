	<form name="requestForm" method="post" action="inkind_exc.php">
	<table  class="table-request">
	<th colspan="2" align="left"><h3>Make an Inkind Request</h3></th>
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
	<td align="right">Notes <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Some additional details about the item, why and where it is required by the NPO.Max limit 500 characters.</span></a></span></td>
	<td> <textarea rows="3" value="" name="notes" required ></textarea></td>
	</tr>	
	<tr>
	<td align="right">Units Type</td>
	<td><select name="units_type" required>
			<option value="" selected="selected">---SELECT---</option>
			<option value="Kgs">Kgs</option>
			<option value="Litres">Litres</option>
			<option value="Pieces">Pieces</option>
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
	<td> <input type="text" name="request_city" required > </td>
	</tr>
	<tr>
	<td align="right">Request Address</td>
	<td> <textarea rows="3" value="" name="request_address" required ></textarea></td>
	</tr>
	<tr>
	<td align="right">Request Expiry Date <span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>The default Request Expiry Date is set to 90 days from Current Date. An Earlier date can be set by the NGO.</span></a></span></td>
	<td> <input type="text" placeholder="YYYY/MM/DD" name="req_exp_date" id="req_exp_date" size="10" value='<?php date_default_timezone_set('Asia/Kolkata');$end = date("d-M-Y",strtotime("+3 months"));
 echo $end; ?>' required /> </td>
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
	
