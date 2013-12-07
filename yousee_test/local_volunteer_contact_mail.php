<?
//query for testing output
$query = "SELECT 
         donor_id,
         first_name,
         last_name,
         displayname,
         personal_e_mail_id,
         official_e_mail_id,
         preferred_email,
         mobile_phone_no,
         village_town,
         org_grp_Name
         FROM(SELECT donor_id
                     FROM volunteering
                     GROUP BY donor_id)INFO
         LEFT OUTER JOIN DONORS USING (donor_id)";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

//loop thru the field names to print the correct headers
$i = 0;
echo "Report on active Volunteers monthwise.";
echo "<table style='font-size:12px'>";
echo "<thead><tr>";
while ($i < mysql_num_fields($result)){
echo "<th bgcolor=\"CCCCFF\">". mysql_field_name($result, $i) . "</th>";
$i++;
}
echo "</thead></tr>";

//display the data
$i = 1;
while ($rows = mysql_fetch_array($result,MYSQL_ASSOC)){
// variable for coloring oddeven rows
$oddeven = $i & 1;
if ($oddeven == 0){$color = "CCCFFF";}
else {$color = "FFFFFF";}

echo "<tr bgcolor=\"$color\">";
foreach ($rows as $data){echo "<td align=\"right\">".$data ."</td>";}
echo "</tr>";
$i++;
}

echo "</table>";

?>
