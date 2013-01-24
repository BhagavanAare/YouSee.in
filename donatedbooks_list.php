<?php
include("connect_waste.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

if ( isset($_REQUEST['sort']) )
{ $selection = $_REQUEST['sort']; }

else
{ $selection = "category"; }

if ( $selection == "subject" )
{
$query = "SELECT donationid, category, subject, note, author, publisher, donationquantity
FROM donatewaste
WHERE donationitemid=36 AND donationunit=2 AND donationvalue=0
ORDER BY subject";

$result = mysql_query($query);
echo "<table border='1'><tr><th>ID</th><th>Category</th><th>Subject</th><th>Title</th><th>Author</th><th>Publisher</th><th>Available Copies</th></tr>";
while ($row = mysql_fetch_assoc($result)) {
                echo "<tr><td>" . $row['donationid'] . "</td><td>" . $row['category'] . "</td><td>" . $row['subject'] . "</td><td>" . $row['note'] . "</td><td>". $row['author'] . "</td><td>". $row['publisher'] . "</td><td>". $row['donationquantity'] . "</td></tr>";}
echo "</table>";
}
else
{
$query = "SELECT donationid, category, subject, note, author, publisher, donationquantity
FROM donatewaste
WHERE donationitemid=36 AND donationunit=2 AND donationvalue=0
ORDER BY category";

$result = mysql_query($query);
echo "<table border='1'><tr><th>ID</th><th>Category</th><th>Subject</th><th>Title</th><th>Author</th><th>Publisher</th><th>Available Copies</th></tr>";
while ($row = mysql_fetch_assoc($result)) {
                echo "<tr><td>" . $row['donationid'] . "</td><td>" . $row['category'] . "</td><td>" . $row['subject'] . "</td><td>" . $row['note'] . "</td><td>". $row['author'] . "</td><td>". $row['publisher'] . "</td><td>". $row['donationquantity'] . "</td></tr>";}
echo "</table>";
}
?>

