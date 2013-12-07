<?php
// NOTE: the query output should be passed through a variable $result

//loop thru the field names to print the correct headers
$i = 0;
if(mysql_num_rows($result)==0){
	echo "<table id='table-search'><tr><td colspan='5'>There are no donations in this period.</td></tr></table>";
	}
else{
echo "<table id='table-search'>";
echo "<thead><tr>";
while ($i < mysql_num_fields($result))
{
	echo "<th>". mysql_field_name($result, $i) . "</th>";
	$i++;
}
echo "</thead></tr>";

//display the data
$i = 1;
while ($rows = mysql_fetch_array($result,MYSQL_ASSOC))
{

	echo "<tr>";
	foreach ($rows as $data){echo "<td align=\"right\">".$data ."</td>";}
	echo "</tr>";
	$i++;
}
$totalrows=mysql_fetch_array($total);
echo "<tr style='text-align:right'><td></td><td><b>Total</b></td><td><b>$totalrows[sum]</b></td></table>";
}
?>
