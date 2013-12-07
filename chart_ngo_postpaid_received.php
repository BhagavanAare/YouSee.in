<h3>Post Pay Donation Received</h3>	
<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

session_start();

$login_id = $_SESSION['SESS_USER_ID'];

$query = "SELECT Year(payment_date) \"year\",amount_for_project,amount_for_operations_grant
		  FROM postpay_certificates
			INNER JOIN donors ON donors.donor_id=postpay_certificates.donor_id
			INNER JOIN payments ON postpay_certificates.payment_id=payments.payment_id
			INNER JOIN project_certificates ON project_certificates.certificate_id=postpay_certificates.certificate_id
			INNER JOIN project_partners ON project_partners.partner_id=project_certificates.partner_id
		  WHERE project_partners.user_id = '".$login_id."'
		  GROUP BY Year(payment_date) ORDER BY Year(payment_date) desc";

$result = mysql_query($query);
$data = "t:";
$labels = "|";
$total_donation = 0;

if(mysql_num_rows($result)!= 0) 
{
		echo "<table id=\"table-search\">";
		echo "<thead>";
		echo "<th>S.No</th>"; echo"<th>Year</th>";  echo "<th>Total Donations</th>";
		echo "</thead>";
		echo "<tbody>";
		$i=1; $total_total_donations=0;
		while ($record = mysql_fetch_array($result))
		{
			$total_donations=0;
			$query_1 = "SELECT Year(payment_date) \"year\",amount_for_project,amount_for_operations_grant
					  FROM postpay_certificates
					  INNER JOIN donors ON donors.donor_id=postpay_certificates.donor_id
					  INNER JOIN payments ON postpay_certificates.payment_id=payments.payment_id
					  INNER JOIN project_certificates ON project_certificates.certificate_id=postpay_certificates.certificate_id
					  INNER JOIN project_partners ON project_partners.partner_id=project_certificates.partner_id
					  WHERE project_partners.user_id = '".$login_id."' AND Year(payment_date)='".$record['year']."'";
			$result_1 = mysql_query($query_1);
			while ($record_1 = mysql_fetch_array($result_1))
			{
			$total_donations = $total_donations + $record_1['amount_for_project'] + $record_1['amount_for_operations_grant'];
			}
					
			echo "<tr>";
			echo "<td>" . $i . "</td>";
			echo "<td>" . $record['year'] . "</td>";
			echo "<td>" . number_format($total_donations) . "</td>";
			echo "</tr>";
			$i++;
			$total_total_donations = $total_total_donations + $total_donations;
			$data .=  $total_donations . ",";
   			$labels = $record['year'] . $labels;
  			$labels = "|" . $labels;
		}
			$data = substr($data, 0, -1);
   			$labels = "1:" . $labels;
  			$ptotal_donation = number_format($total_donation, 0, '.', ',');
			
			

		echo "</tbody>";
		echo "<tfoot><tr><td colspan='2'>Total</td><td>".number_format($total_total_donations)."</td></tr></tfoot>";
		echo "</table></br>";
}
?>
<img src="http://chart.apis.google.com/chart
?cht=bvg
&chtt=+Postpay+Donations+-+<?php echo $total_total_donations?>
&chxt=y,x
&chd=<?php echo $data;?>
&chxl=<?php echo $labels;?>
&chds=a
&chbh=a
&chs=250x250
">
<?php
mysql_error();
?>
