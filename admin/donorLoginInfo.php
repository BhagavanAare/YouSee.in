<head>
	<link rel="stylesheet" href="scripts/jquery-ui.css">
	<link rel="stylesheet" href="css/table.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
	<script type="text/javascript">
		$(function() {
		$( "#fromdate" ).datepicker();
		$( "#todate" ).datepicker();
	});
	</script>
</head>
<h3 style="margin-left:20px; ">Donor Login Logs</h3>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<input type="hidden" name="formname" value="donorLoginLog" />
<table id="table-search">
<thead>
<tr>
<th>From Date</th>
<th>To Date</th>
</thead>
<tbody>
</tr>
<tr>
<td style="vertical-align:top;"><input type="text" name="from_date" id="fromdate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td style="vertical-align:top;"><input type="text" name="to_date" id="todate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</tbody>
</table>
</form>
<br />
<br />
<br />
<?php
	if (isset($_POST['submit']))
	{
		if($_POST['formname']=="donorLoginLog")
		{
			if($_POST['from_date']==$_POST['to_date']) 
			{
				$dates=date("d M Y", strtotime($_POST['from_date']));
			}
			else 
			{
				$dates=date("d M Y", strtotime($_POST['from_date'])) ." to ". date("d M Y", strtotime($_POST['to_date']));
			}
			include("prod_conn.php");
			$query = "SELECT 
				first_name,
				last_name,
				gender,
				preferred_email,
				mobile_phone_no,
				village_town,
				org_grp_name,
				past_login_date,
				past_login_time
				FROM users
				JOIN donors ON users.user_id=donors.user_id
				WHERE past_login_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."'";
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$result = mysql_query($query);
				if(mysql_num_rows($result)!= 0) 
				{
					echo "<table id=\"table-search\">";
					echo "<thead>";
					echo "<tr><th rowspan=\"2\">S.No</th>"; echo"<th>First Name</th>";  echo "<th>Last Name</th>"; echo "<th>Gender</th>"; echo "<th>E-mail</th>"; echo "<th>Phone Number</th>"; echo "<th>City</th>";echo "<th>Organisation Name</th>";echo "<th>Past Login Date</th>"; echo "<th>Past Login Time</th></tr>"; 
					echo "</thead>";
					echo "<tbody>";
					$i=1;
					while ($record = mysql_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $record['first_name'] . "</td>";
						echo "<td>" . $record['last_name'] . "</td>";
						echo "<td>" . $record['gender'] . "</td>";
						echo "<td>" . $record['preferred_email'] . "</td>";
						echo "<td>" . $record['mobile_phone_no'] . "</td>";
						echo "<td>" . $record['village_town'] . "</td>";
						echo "<td>" . $record['org_grp_name'] . "</td>";
						echo "<td>" . date('dMY', strtotime($record['past_login_date'])) . "</td>";
						echo "<td>" . date('g:ia', strtotime($record['past_login_time'])) . "</td>";
						echo "</tr>";
						$i++;
					}
					echo "</tbody>";
					echo "</table>";
				}
				else
				{
					echo "No Donors are there within the given dates";
				}
		}
	}

?>
<?php
/*
Version Track
1 - 16May13 - Yashasvy - Change in labels styles
*/
?>