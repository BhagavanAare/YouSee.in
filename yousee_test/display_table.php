<?php
// NOTE: the query output should be passed through a variable $result

//loop thru the field names to print the correct headers
$i = 0;
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
