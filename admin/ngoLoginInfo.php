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
<h3 style="margin-left:20px; ">NGO Login Logs</h3>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<input type="hidden" name="formname" value="ngoLoginLog" />
<table id="table-search">
<thead>
<tr>
<th>From Date</th>
<th>To Date</th>
</tr>
</thead>
<tbody>
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
		if($_POST['formname']=="ngoLoginLog")
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
				name,
				contact_first_name,
				contact_person_phone,
				contact_person_email,
				hq_town_city,
				past_login_date,
				past_login_time
				FROM users
				JOIN project_partners ON users.user_id=project_partners.user_id
				WHERE past_login_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."'";
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$result = mysql_query($query);
			
				if(mysql_num_rows($result)!= 0) 
				{
					echo "<table id=\"table-search\">";
					echo "<thead>";
					echo "<tr><th rowspan=\"2\">S.No</th>"; echo"<th>Organisation Name</th>";  echo "<th>Contact Person Name</th>"; echo "<th>Phone</th>"; echo "<th>E-mail</th>"; echo "<th>City</th>"; echo "<th>Past Login Date</th>"; echo "<th>Past Login Time</th></tr>"; 
					echo "</thead>";
					echo "<tbody>";
					$i=1;
					while ($record = mysql_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $record['name'] . "</td>";
						echo "<td>" . $record['contact_first_name'] . "</td>";
						echo "<td>" . $record['contact_person_phone'] . "</td>";
						echo "<td>" . $record['contact_person_email'] . "</td>";
						echo "<td>" . $record['hq_town_city'] . "</td>";
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
					echo "No NGOs are there within the given dates";
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