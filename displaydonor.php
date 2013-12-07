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
include('db_config.php');

//Connect to database
mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_table);

$donor1=$_REQUEST['donortype'];
$gender=$_REQUEST['gender'];
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$dname=$_REQUEST['dname'];

$gname=$_REQUEST['gname'];
$addr=$_REQUEST['addr'];
$town=$_REQUEST['town'];
$state=$_REQUEST['state'];
$country=$_REQUEST['country'];
$mail1=$_REQUEST['mail1'];

$mail2=$_REQUEST['mail2'];
$mobile=$_REQUEST['mobile'];

$insertq="insert into donors (TYPE_OF_DONOR,FIRST_NAME,LAST_NAME,GENDER,ADDRESS,VILLAGE_TOWN,STATE,COUNTRY,
MOBILE_PHONE_NO,PERSONAL_E_MAIL_ID,OFFICIAL_E_MAIL_ID,DISPLAYNAME,Org_Grp_Name) values ('$donor1','$fname','$lname','$gender','$addr','$town','$state','$country','$mobile','$mail1','$mail2','$dname','$gname')";

$insert=mysql_query($insertq);
//echo $insert;

$idq="select max(DONOR_ID) from donors";
$id=mysql_result(mysql_query($idq),0);

$selectq="select DISPLAYNAME,DONOR_ID from donors where DONOR_ID='$id'";
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
<table align="center" width="40%" border="1">
<?php
while ($row = mysql_fetch_array($select)) {
   $name=$row['DISPLAYNAME']; 
   $id=$row['DONOR_ID'];
	
}?>
<tr>
<th>Name</th>
<th>Donor ID</th>
</tr>
<tr>

<td align="center"><?php echo $name?></td>
<td align="center"><?php echo $id?></td></tr>
</table>
</html>	






