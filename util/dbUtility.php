<?php

if (isset($_POST['search_donor']))
{
	include_once "../prod_conn.php";
	$query = "SELECT donor_id,first_name,last_name,displayname,preferred_email,village_town,org_grp_name,mobile_phone_no FROM donors WHERE LOWER(first_name) LIKE LOWER('$_POST[search_key]%') OR LOWER(last_name) LIKE LOWER('$_POST[search_key]%') OR LOWER(CONCAT(first_name,' ',last_name)) LIKE '$_POST[search_key]%' OR LOWER(displayname) LIKE ('%$_POST[search_key]%') ORDER BY first_name ASC ";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0)
	{
		$donorlist = array();
		while ($row = mysql_fetch_array($result))
		{
			$donorlist[] = array(
				$row['donor_id'],
				"$row[displayname]",
				" ",
				"$row[preferred_email]",
				"$row[mobile_phone_no]",
				"$row[village_town]",
				"$row[org_grp_name]"
			);
		}
		echo json_encode($donorlist);
	}
}

?>