<?php
include_once("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
$sql = "delete from volunteering where volunteer_act_id='$id'";
mysql_query($sql);

}
?>