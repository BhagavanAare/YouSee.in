<?
session_start();
if(!session_is_registered(myusername)){
header("location:main_login.php");
}
// Check if session is not registered , redirect back to main page.
// Put this code in first line of web page.
?>

<?php
//include DB configuration file
include('prod_conn.php');

//Connect to database
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");


$insmaxdonorid=$_REQUEST['donorid'];
//urdate=curdate();
//$insdonatedate=$_POST['curdate']; echo $insdonatedate;
$task=$_REQUEST['task']; //echo $task;
$institle=$_POST['title']; //echo $institle;
$insauthor=$_POST['author'];
$inspub=$_POST['publisher'];
$inscatid=$_POST['catgorycode'];
$insname=$_POST['catgoryname'];
$subjectname=$_POST['subjectname'];
$insloc=$_POST['location'];
$bookid1=mysql_query("select bookid from uc_bookdonations"); 

if(!$bookid)
$insertq="insert into uc_bookdonations (`donorid`,`donation_date`,`categoryid`,`subjectid`,`booktitles`,`authors`,`publishers`,`distributionstatus`,`storelocations`) values ('$insmaxdonorid',curdate(),'$inscatid','$subjectname','$institle','$insauthor','$inspub','Received','$insloc')"; //echo $insertq;
$insert=mysql_query($insertq);

$selectq="select * from uc_bookdonations";
$select=mysql_query($selectq);
?>

<html>
<head>
<style type="text/css">
body
{
background-color:#ADDFFF;
}
</style>
</head>
<form action="uc_donor.html.php">
<table align="center" width="40%" border="1">
<?php
while ($row = mysql_fetch_array($select)) {
   $donorid=$row['donorid']; 
   $donation_date=$row['donation_date'];
   $bookid=$row['bookid'];
   $booktitles=$row['booktitles'];
   $publishers=$row['publishers'];
   $storelocations=$row['storelocations'];
}?>
<br><br>
<tr align="center"><center><h2>The Details of Book Submitted</h2></center></tr>
<br>
<tr>
<th>Book ID</th>
<th>Book Title</th>
<th>Publishers</th>
<th>Store Locations</th>
<th>Donor ID</th>
<th>Donation Date</th>
</tr>
<tr>
<td align="center"><?php echo $bookid?></td>
<td align="center"><?php echo $booktitles?></td>
<td align="center"><?php echo $publishers?></td>
<td align="center"><?php echo $storelocations?></td>
<td align="center"><?php echo $donorid?></td>
<td align="center"><?php echo $donation_date?></td>
</tr>
</table><br />
<center><input type="submit" value="Back" /></center>
</html>