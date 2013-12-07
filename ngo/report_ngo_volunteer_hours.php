<head>
	<script type="text/javascript">
		$(function() {
		$( "#fromdate" ).datepicker();
		$( "#todate" ).datepicker();
	});
	
	
	 function reveal(b){
		 var a = "detail"+b;
		 var l=document.getElementById(b);
		 var e=document.getElementById(a);
		 if(!e)return true;
		 if(e.style.display=="none"){
			 e.style.display="block";
			 l.style.fontWeight="bold";
			 l.style.backgroundColor="#D778F3";
		 } else {
			 e.style.display="none"
			 l.style.fontWeight="normal";
			 l.style.backgroundColor="transparent";
		 }
		 return true;
		}
 </script>
</head>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<p style="margin-left:20px; "><h2>Volunteer Hours Report</h2></p>
<input type="hidden" name="formname" value="reportNgoVolunteerHours" />
<table id="table-search">
<tr>
<th>From Date</th>
<th>To Date</th>
</tr>
<tr>
<td style="vertical-align:top;"><input type="text" name="from_date" id="fromdate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td style="vertical-align:top;"><input type="text" name="to_date" id="todate" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
<?php
	if (isset($_POST['submit']))
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
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			
			
			
			$login_id = $_SESSION['SESS_USER_ID'];
			
			$query = "SELECT volunteering.donor_id,
				first_name,
				last_name,
				gender,
				preferred_email,
				mobile_phone_no
				FROM volunteering
				JOIN donors ON donors.donor_id=volunteering.donor_id
				JOIN project_partners ON project_partners.partner_id=volunteering.partner_id
				WHERE from_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."' AND project_partners.user_id = '".$login_id."' 
				GROUP BY volunteering.donor_id";
			$result = mysql_query($query);
				if(mysql_num_rows($result)!= 0) 
				{

					echo "</br>";
 					echo "<b> Reports From : </b>" . $dates . "</br>";
					echo "</br>";
					echo "<table id=\"table-search\" width=\"600px\">";
					echo "<thead>";
					echo "<tr><th>S.No</th>"; echo"<th>Name</th>";echo "<th>Gender</th>"; echo "<th>E-mail</th>"; echo "<th>Phone Number</th>"; echo "<th>Hours</th>"; echo"<th>Click</th>"; echo "</tr>"; 
					echo "</thead>";
					echo "<tbody>";
					$i=1;
					while ($record = mysql_fetch_array($result))
					{
							$query_1="SELECT * 
										FROM volunteering
										JOIN project_partners ON project_partners.partner_id=volunteering.partner_id								
										WHERE donor_id = '".$record['donor_id']."' AND from_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."'  AND project_partners.user_id = '".$login_id."'";
							$result_1 = mysql_query($query_1);
							$result_2 = mysql_query($query_1);
							$sum=0;
							while ($record_1 = mysql_fetch_array($result_1))
							{
							$sum=$sum + $record_1['hours'];
							}
							$details = "detail".$i;
					
						echo "<tr id=\"$i\">";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $record['displayname'] . "</td>";
						echo "<td>" . $record['gender'] . "</td>";
						echo "<td>" . $record['preferred_email'] . "</td>";
						echo "<td>" . $record['mobile_phone_no'] . "</td>";
 						echo "<td>" . $sum . "</td>";
						echo "<td align=\"center\" onclick=\"reveal('$i'); \"   style=\"cursor:pointer;\"><u style=\"color:blue;\">View More Details</u></td>";			
						echo "</tr>";
						
						echo "<tr>";
						
						echo "<td colspan=\"8\" id=\"$details\" style=\"display:none\" >";
							echo "<table width=\"600px\" id=\"altColorSubTable\">";
							echo "<thead>";
							echo "<tr><th>From Date</th>"; echo"<th>To Date</th>";  echo "<th>Activity Done</th>"; echo "<th>Donation Type</th>"; echo "<th>hours</th>"; echo "</tr>"; 
							echo "</thead>";
							echo "<tbody>";
							while ($record_2 = mysql_fetch_array($result_2))
							{
								echo "<tr>";
								echo "<td>".date("d M Y", strtotime($record_2['from_date']))."</td>";
								echo "<td>".date("d M Y", strtotime($record_2['to_date']))."</td>";
								echo "<td>".$record_2['activity_done']."</td>";
								echo "<td>".$record_2['donation_type']."</td>";
								echo "<td>".$record_2['hours']."</td>";
								echo "</tr>";
							}
							echo "</tbody>";
							echo "</table>";
						echo "</td>";
						echo "</tr>";
						$i++;
					}
					echo "</tbody>";
					echo "</table>";
				}
				else
				{
					echo "No Volunteers  are there within the given dates";
				}
	
		
	}
?>
