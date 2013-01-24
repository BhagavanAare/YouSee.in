<html>
<body>
<a href="registration.php">regitration page</a><br /><br /><br /><br />

<?php
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query("SELECT * FROM offer");
$counter=1;
$offerIDarr;
while($row = mysql_fetch_array($result))
{
	echo $row['offer_id']."   ";
	
	echo $row['offer_date']."   ";
	
	echo $row['offer_id']."   ";
	
	echo $row['offer_date']."   ";
	//echo "<br />";
	//$counter++; 
	echo "$counter";
	echo "<form action=\"index.php\"  method=\"post\">";
	echo "<input type=\"hidden\" name=\"clicked\" value=\"" . $row['offer_id'] . "\">";
	echo "<input type=\"submit\" name=\"accept\" value=\"accept\">";
	echo "</form>";
	echo "<br />";
}
?>
 
 <?php
 if($_POST)
 {
	echo "submit clicked : " . $_POST['clicked'] . "";
 }
 ?>
 
 <br />
 <label><b>new donation</b></label><br>
<label>item required</label> <input type="text" name="item"></form>


</body>
</html>
