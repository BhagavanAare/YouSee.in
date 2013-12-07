<h3>Post Pay Donation Received</h3>	
<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");


$login_id = $_SESSION['SESS_USER_ID'];

$query = "SELECT Year(payment_date) \"year\",amount_for_project,amount_for_operations_grant
		  FROM postpay_certificates
			INNER JOIN donors ON donors.donor_id=postpay_certificates.donor_id
			INNER JOIN payments ON postpay_certificates.payment_id=payments.payment_id
			INNER JOIN project_certificates ON project_certificates.certificate_id=postpay_certificates.certificate_id
			INNER JOIN project_partners ON project_partners.partner_id=project_certificates.partner_id
		  WHERE project_partners.user_id = '".$login_id."'
		  GROUP BY Year(payment_date)";

$result = mysql_query($query);
$data = ",";
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
			$total_donations = $total_donations + $record_1['amount_for_project'];
			}
					
			echo "<tr>";
			echo "<td>" . $i . "</td>";
			echo "<td>" . $record['year'] . "</td>";
			echo "<td align=\"right\">" . number_format($total_donations) . "</td>";
			echo "</tr>";
			$i++;
			$total_total_donations = $total_total_donations + $total_donations;
			$data = $data. $total_donations. ",";
   			$labels =$labels. $record['year'];
  			$labels =$labels. "|" ;
		}
			$data = "t:" . substr($data, 1, -1);

   			$labels = "1:" . $labels;
  			$ptotal_donation = number_format($total_donations, 0, '.', ',');
		echo "</tbody>";
		echo "<thead><tr><td colspan='2' align=\"right\">Total</td><td align=\"right\">".number_format($total_total_donations)."</td></tr></thead>";
		echo "</table></br>";
}
?>
<img src="http://chart.apis.google.com/chart
?cht=bvg
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
