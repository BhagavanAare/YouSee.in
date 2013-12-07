<head>
	<style type="text/css" media="screen">
	#table-search .rows{
		cursor:pointer;
	}
	#table-search .rows:hover{
		background:#e2e2e2;
	}
	</style>
	<script type="text/javascript">
		$(function() {
		$( "#fromdate1" ).datepicker();
		$( "#todate1" ).datepicker();
	});
	</script>
</head>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<p style="margin-left:20px; "><h2>Financial Donations Report</h2></p>
<input type="hidden" name="formname" value="reportNgoFinancialDonations" />
<table id="table-search">
<tr>
<th>From Date</th>
<th>To Date</th>
</tr>
<tr>
<td style="vertical-align:top;"><input type="text" name="from_date" id="fromdate1" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td style="vertical-align:top;"><input type="text" name="to_date" id="todate1" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
<?php
	if (isset($_POST['submit']))
	{
		$_POST['from_date']=gmdate("Y-m-d",strtotime($_POST['from_date']));
		$_POST['to_date']=gmdate("Y-m-d",strtotime($_POST['to_date']));
			
			if($_POST['from_date']==$_POST['to_date']) 
			{
				$dates=date("d M Y", strtotime($_POST['from_date']));
			}
			else 
			{
				$dates= date("d M Y", strtotime($_POST['from_date'])) ." <b>To </b>". date("d M Y", strtotime($_POST['to_date']));
			}
			include("prod_conn.php");
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			
			
			
			$login_id = $_SESSION['SESS_USER_ID'];
			//$login_id = 1;
			
			$query = "SELECT 
				*
				FROM postpay_certificates
				INNER JOIN donors ON donors.donor_id=postpay_certificates.donor_id
				INNER JOIN payments ON postpay_certificates.payment_id=payments.payment_id
				INNER JOIN project_certificates ON project_certificates.certificate_id=postpay_certificates.certificate_id
				INNER JOIN project_partners ON project_partners.partner_id=project_certificates.partner_id
				WHERE payment_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."' AND project_partners.user_id = '".$login_id."'
				GROUP BY postpay_certificates.donor_id";
			
			$result = mysql_query($query);
			$resultcount=mysql_num_rows($result);
				if(mysql_num_rows($result)!= 0) 
				{

					echo "</br>";
 					echo "<b> Reports From : </b>" . $dates . "</br>";
					echo "</br>";
					echo "<table style=\"margin-bottom:20px;\" id=\"table-search\">";
					echo "<thead>";
					echo "<tr><th rowspan=\"2\">S.No</th>"; echo"<th>Name</th>";echo "<th>E-mail</th>";echo "<th>Total Donations (INR) </th>";echo "</tr>"; 
					echo "</thead>";
					echo "<tbody>";
					$i=1;$total_total_donations=0;
					while ($record = mysql_fetch_array($result))
					{ 
							$total_donations = 0;
							$query_1 = "SELECT *
									FROM postpay_certificates
									INNER JOIN donors ON donors.donor_id=postpay_certificates.donor_id
									INNER JOIN payments ON postpay_certificates.payment_id=payments.payment_id
									INNER JOIN project_certificates ON project_certificates.certificate_id=postpay_certificates.certificate_id
									INNER JOIN project_partners ON project_partners.partner_id=project_certificates.partner_id
									WHERE payment_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."' AND project_partners.user_id = '".$login_id."' AND postpay_certificates.donor_id = '".$record['donor_id'] ."'";
							$result_1 = mysql_query($query_1);
							$result_2 = mysql_query($query_1);
							while ($record_1 = mysql_fetch_array($result_1))
							{
							$total_donations = $total_donations + $record_1['amount_for_project'] + $record_1['amount_for_operations_grant'];
							}

						
							$details = "detail".$i;						
							echo "<tr class=\"rows\" id=\"$i\">";
							echo "<td>" . $i . "</td>";
							echo "<td>" . $record['displayname'] . "</td>";
							echo "<td>" . $record['preferred_email'] . "</td>";
							echo "<td align=\"right\">" . number_format($total_donations) . "</td>";
							echo "</tr>";
							echo "<tr >";
							echo "<td colspan=\"6\" id=\"$details\" hidden>";
							echo "<table align=\"right\" id=\"altColorSubTable\">";
							echo "<thead>";
							echo "<tr><th>Payment Date</th>";  echo "<th>Donation</th>"; echo "</tr>"; 
							echo "</thead>";
							echo "<tbody>";
						
							$total_donations_1 = 0;
						
							while ($record_2 = mysql_fetch_array($result_2))
							{
							$total_donations_1 = $record_2['amount_for_project'] + $record_2['amount_for_operations_grant'];
						$total_total_donations=$total_total_donations+$total_donations_1;
						echo "<tr>";
						echo "<td>" . gmdate('d-M-Y',strtotime($record_2['payment_date'])) . "</td>";
						echo "<td align=\"right\">" . number_format($total_donations_1) . "</td>";
						echo "</tr>";
							}
							echo "</tbody>";
							echo "</table>";
							echo "</td>";
						echo "</tr>";
						?>
						<script>
						$(function(){
							$("#<?php echo $i; ?>").click(function(){
							if($("#detail<?php echo $i; ?>").css('display')!='none'){$("#detail<?php echo $i; ?>").slideUp();}
							else{	
							var $resultcount= <?php echo $resultcount; ?>;
							for(var $j=1;$j<$resultcount; $j++){
									$("#detail"+$j).hide();
							}
							$("#detail<?php echo $i; ?>").slideDown();}
							});
						});
						</script><?php
						$i++;
					}
					echo "</tbody>";
					echo "<thead><tr><th colspan='3' align='right'>Total</th><th align='right'>".number_format($total_total_donations)."</th></tr></thead>";
					echo "</table>";
				}
				else
				{
					echo "Nothing there within the given dates";
				}
		
	}

?>
