<?php 
if(isset($_POST['from_date'])){
require_once('login_auth.php');
if (!($_SESSION['SESS_USER_TYPE']=='A'))
{
	header("location: login_access_denied.php");
	exit();
	
}
$_POST['from_date']=date_format(date_create_from_format('j-M-Y', $_POST['from_date']), 'Y-m-d');
$_POST['to_date']=date_format(date_create_from_format('j-M-Y', $_POST['to_date']), 'Y-m-d');
$_POST['from_time']=date("H:i",strtotime($_POST['from_time']));
$_POST['to_time']=date("H:i",strtotime($_POST['to_time']));
include_once('prod_conn.php');
if(isset($_POST['opp_id']))
$query=	"UPDATE volunteering_opportunities SET 
				from_date='$_POST[from_date]',
				to_date='$_POST[to_date]',
				from_time='$_POST[from_time]',
				to_time='$_POST[to_time]',
				location='$_POST[location]',
				city='$_POST[city]',
				num_volunteers='$_POST[num_volunteers]',
				place_id='$_POST[place]'
				WHERE opportunity_id = $_POST[opp_id]";
else
$query=		"INSERT INTO volunteering_opportunities
			(activity_id,from_date,to_date,from_time,to_time,location,
			city,num_volunteers,approval_status,place_id)
			VALUES
			($_POST[activity],'$_POST[from_date]','$_POST[to_date]',
			'$_POST[from_time]','$_POST[to_time]','$_POST[location]',
			'$_POST[city]','$_POST[num_volunteers]','A','$_POST[place]')";
if(mysql_query($query))
echo json_encode("Changes have been saved.");
else echo json_encode("Changes could not be saved.");
}
else echo json_encode("Could not process your request. Please retry later.");
?>
