<?php
include_once("../prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
if($_POST['id'])
{
$id=mysql_real_escape_string($_POST['id']);

$_POST['fdate']=date_format(new DateTime($_POST['fdate']),'Y-m-d');
$_POST['tdate']=date_format(new DateTime($_POST['tdate']),'Y-m-d');

$fdate=mysql_real_escape_string($_POST['fdate']);
$tdate=mysql_real_escape_string($_POST['tdate']);
$ftime=mysql_real_escape_string($_POST['ftime']);
$ttime=mysql_real_escape_string($_POST['ttime']);
$hours=mysql_real_escape_string($_POST['hours']);
$area=mysql_real_escape_string($_POST['area']);
$location=mysql_real_escape_string($_POST['location']);
$activity=mysql_real_escape_string($_POST['activity']);
$site=mysql_real_escape_string($_POST['site']);
$org=mysql_real_escape_string($_POST['org']);
$project=mysql_real_escape_string($_POST['project']);

//$orgname['name']=mysql_query("SELECT name FROM project_partners WHERE partner_id='$org'");

$sql = "update volunteering set from_date='$fdate',to_date='$tdate',from_time='$ftime',to_time='$ttime',hours='$hours',area='$area',location='$location',activity_done='$activity',onsite_offsite='$site',partner_id='$org',project_id='$project'  where volunteer_act_id='$id'";
mysql_query($sql);

//echo "<script>alert(".mysql_error($sql).")</script>";

}
?>