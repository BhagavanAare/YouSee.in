<div align="center" class="featured_header" style="margin-top:5px;">RECENT POSTPAY DONORS</div>
<?php
//include("conn.php");
include("prod_conn.php");
$query = "select  DATE_FORMAT(PAYMENT_DATE,'%d-%b-%y') \"Date\", DISPLAYNAME Name, DONORS.STATE Place
,AMOUNT_FOR_PROJECT \"Project Donation\"
,AMOUNT_FOR_OPERATIONS_GRANT \"Ops Grant\"
,SUBSTRING(TITLE,1,30) \"Project Title\"
from POSTPAY_CERTIFICATES
JOIN PROJECT_CERTIFICATES USING (CERTIFICATE_ID)
JOIN DONORS USING (DONOR_ID)
JOIN PAYMENTS USING (PAYMENT_ID)
ORDER BY PAYMENT_DATE DESC LIMIT 1,5";

mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
	
//$result = conn($query);
if (($result)||(mysql_errno == 0))
{
  echo "<table class=\"featured_cert_acquired\">";
  if (mysql_num_rows($result)>0)
  {
          //loop thru the field names to print the correct headers
          $i = 0;
		  echo "<thead><tr>";
          while ($i < mysql_num_fields($result))
          {
			 
	   echo "<th scope=\"col\" id=\"theader\">". mysql_field_name($result, $i) . "</th>";
       $i++;
    }
    echo "</thead></tr>";
   
    //display the data
	$i = 1;
    while ($rows = mysql_fetch_array($result,MYSQL_ASSOC))
    {
	$oddeven = $i & 1;
 if ($oddeven == 0){			$oddeven = "featured_cert_acquired_even";}			else {				$oddeven = "featured_cert_acquired_odd";}
	 echo "<tr class=\"$oddeven\">";
      foreach ($rows as $data)
      {
	 	echo "<td>".$data ."</td>";
      }
    echo "</tr>";
	$i++;
	}
//	echo "</tr>";
  }
  else
	  {
    echo "<tr><td colspan='" . ($i+1) . "'>No Results found!</td></tr>";
  }
  echo "</table>";
}else{
  echo "Error in running query :". mysql_error();
}
?>