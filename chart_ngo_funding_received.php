<h3>Funding Received through UC</h3>	
<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

session_start();

$login_id = $_SESSION['SESS_USER_ID'];

$query = "SELECT Year(start_date) \"year\",value
		 	FROM project_certificates
			JOIN project_partners ON project_certificates.partner_id=project_partners.partner_id
		  	WHERE  project_partners.user_id= '".$login_id."'
		 	GROUP BY Year(start_date) ORDER BY Year(start_date) desc";
$result = mysql_query($query);
$data = "t:";
$labels = "|";
$total_donation = 0;


if(mysql_num_rows($result)!= 0) 
{
		echo "<table id=\"table-search\">";
		echo "<thead>";
		echo "<th>S.No</th>"; echo"<th>Year</th>";  echo "<th>Funding Received</th>";
		echo "</thead>";
		echo "<tbody>";
		$i=1; $total_total_funding=0;
		while ($record = mysql_fetch_array($result))
		{
			$total_funding=0;
			$query_1 = "SELECT Year(start_date) \"year\",value
		 	FROM project_certificates
			JOIN project_partners ON project_certificates.partner_id=project_partners.partner_id
		  	WHERE  project_partners.user_id= '".$login_id."'
		 	AND Year(start_date)='".$record['year']."'";
			$result_1 = mysql_query($query_1);
			while ($record_1 = mysql_fetch_array($result_1))
			{
			$total_funding = $total_funding + $record_1['value'];
			}
					
			echo "<tr>";
			echo "<td>" . $i . "</td>";
			echo "<td>" . $record['year'] . "</td>";
			echo "<td>" . number_format($total_funding) . "</td>";
			echo "</tr>";
			$i++;
			$total_total_funding = $total_total_funding + $total_funding;
			$data .=  $total_funding . ",";
   			$labels = $record['year'] . $labels;
  			$labels = "|" . $labels;
		}
			$data = substr($data, 0, -1);
   			$labels = "1:" . $labels;
  			$ptotal_funding = number_format($total_funding, 0, '.', ',');
		echo "</tbody>";
		echo "<tfoot><tr><td colspan='2'>Total</td><td>".number_format($total_total_funding)."</td></tr></tfoot>";
		echo "</table></br>";
}
?>
<img src="http://chart.apis.google.com/chart
?cht=bvg	
&chtt=Funding+Received+-+<?php echo $ptotal_funding?>
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
