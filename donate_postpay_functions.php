<?php
	include_once('prod_conn.php'); 
	session_start();
	$mode = $_POST['mode'];
	//$mode = "CURRENCY";
	$query = "";
	
	if($mode == "PROJECTS") {
		
		if($_SESSION['donate_postpay']=="paid"){
		$query = "SELECT PROJECT_ID, PROJECT_TITLE, PROJECT_DESCRIPTION, NAME, WEBSITE_URL, PROJECT_AREA, LOCATION, TOTAL_VALUE, TOTAL_POSTPAID, PHOTO_LINK,PARTNER_ID
		            FROM (SELECT PROJECT_ID, PROJECT_TITLE, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID, PHOTO_LINK
		              FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
		                FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
		                  FROM postpay_certificates GROUP BY CERTIFICATE_ID) PAID
		                 USING (CERTIFICATE_ID)
		                 GROUP BY  PROJECT_ID)SUMMARY
		            LEFT OUTER JOIN projects USING (PROJECT_ID))FULL
		          LEFT OUTER JOIN project_partners USING (PARTNER_ID)
				  WHERE TOTAL_VALUE=TOTAL_POSTPAID
		          ORDER BY RAND()
		          " ;
		}
		else if($_SESSION['donate_postpay']=="npo"){
			$query = "SELECT PROJECT_ID, PROJECT_TITLE, PROJECT_DESCRIPTION, NAME, WEBSITE_URL, PROJECT_AREA, LOCATION, TOTAL_VALUE, TOTAL_POSTPAID, PHOTO_LINK,PARTNER_ID
		            FROM (SELECT PROJECT_ID, PROJECT_TITLE, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID, PHOTO_LINK
		              FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
		                FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
		                  FROM postpay_certificates GROUP BY CERTIFICATE_ID) PAID
		                 USING (CERTIFICATE_ID)
		                 GROUP BY  PROJECT_ID)SUMMARY
		            LEFT OUTER JOIN projects USING (PROJECT_ID))FULL
		          LEFT OUTER JOIN project_partners USING (PARTNER_ID)
				  WHERE TOTAL_VALUE!=TOTAL_POSTPAID AND partner_id=$_SESSION[npo]
		          ORDER BY RAND()
		          " ;
		}
		else{
		$query = "SELECT PROJECT_ID, PROJECT_TITLE, PROJECT_DESCRIPTION, NAME, WEBSITE_URL, PROJECT_AREA, LOCATION, TOTAL_VALUE, TOTAL_POSTPAID, PHOTO_LINK,PARTNER_ID
		            FROM (SELECT PROJECT_ID, PROJECT_TITLE, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID, PHOTO_LINK
		              FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
		                FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
		                  FROM postpay_certificates GROUP BY CERTIFICATE_ID) PAID
		                 USING (CERTIFICATE_ID)
		                 GROUP BY  PROJECT_ID)SUMMARY
		            LEFT OUTER JOIN projects USING (PROJECT_ID))FULL
		          LEFT OUTER JOIN project_partners USING (PARTNER_ID)
				  WHERE TOTAL_VALUE!=TOTAL_POSTPAID
		          ORDER BY RAND()
		          " ;
		}
		$result = mysql_query($query);
		$projects = "";
		while ($row = mysql_fetch_assoc($result)) {			
			if($row['TOTAL_VALUE'] - $row['TOTAL_POSTPAID'] > 0 && $row['TOTAL_POSTPAID'] != '') {
		     	$projects .= $row['PROJECT_ID'] . "^" . $row['PROJECT_TITLE'] . "^" . $row['PROJECT_DESCRIPTION'] . "^" . $row['PROJECT_AREA'] . "^" . $row['NAME'] . "^" .  $row['LOCATION'] . "^" . $row['TOTAL_VALUE'] . "^" . $row['TOTAL_POSTPAID'] . "^" . $row['PHOTO_LINK'] . "^/npo/" . $row['PARTNER_ID'] . ";";
		   	}			
			if($row['TOTAL_VALUE'] - $row['TOTAL_POSTPAID'] == 0 && $row['TOTAL_POSTPAID'] != '') {
		     	$projects .= $row['PROJECT_ID'] . "^" . $row['PROJECT_TITLE'] . "^" . $row['PROJECT_DESCRIPTION'] . "^" . $row['PROJECT_AREA'] . "^" . $row['NAME'] . "^" .  $row['LOCATION'] . "^" . $row['TOTAL_VALUE'] . "^" . $row['TOTAL_POSTPAID'] . "^" . $row['PHOTO_LINK'] . "^/npo" . $row['PARTNER_ID'] . ";";
				$page="postpaid";
		   	}

		  	if ($row['TOTAL_POSTPAID'] == ''){
		   		$projects .= $row['PROJECT_ID'] . "^" . $row['PROJECT_TITLE'] . "^" . $row['PROJECT_DESCRIPTION'] . "^" . $row['PROJECT_AREA'] . "^" . $row['NAME'] . "^" .  $row['LOCATION'] . "^" . $row['TOTAL_VALUE'] . "^0" . "^" . $row['PHOTO_LINK'] . "^/npo" . $row['PARTNER_ID'] . ";";
		  	}
		}
		if(isset($page)){ echo json_encode(array('Result' => 1, 'Message' => $projects, 'Page' => $page)); } 
		else
		echo json_encode(array('Result' => 1, 'Message' => $projects));
	} else if ($mode == "CERTIFICATES") {
		$query2 = "SELECT PROJECT_ID, CERTIFICATE_ID, DATE_FORMAT(START_DATE,'%d-%b-%Y') STARTDATE, DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') COMPLETIONDATE, VALUE, (VALUE - POSTPAID) AVAILABLE, DOCUMENT_LINK
		            FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
		                                                  FROM postpay_certificates GROUP BY CERTIFICATE_ID)PAID
		            USING (CERTIFICATE_ID)
		            ORDER BY CERTIFICATE_ID DESC 
		            ";

		$result2 = mysql_query($query2);
		$certificates = "";
		$certificates_old = "";
		while ($row = mysql_fetch_assoc($result2)) {
		  if($row['AVAILABLE']<0){
			continue;
		  }
		  if($row['AVAILABLE'] == 0 && $row['AVAILABLE'] != NULL ) {
		  	  $certificates_old .= $row['PROJECT_ID'] . "^" . $row['CERTIFICATE_ID'] . "^" . $row["STARTDATE"] . "^" . $row["COMPLETIONDATE"] . "^" . $row["VALUE"] . "^" . $row["AVAILABLE"] . "^" . $row["DOCUMENT_LINK"] . ";";
		  }

		  if($row['AVAILABLE'] != '' && $row['AVAILABLE'] != 0) {
		      $certificates .= $row['PROJECT_ID'] . "^" . $row['CERTIFICATE_ID'] . "^" . $row["STARTDATE"] . "^" . $row["COMPLETIONDATE"] . "^" . $row["VALUE"] . "^" . $row["AVAILABLE"] . "^" . $row["DOCUMENT_LINK"] . ";";
		  } 

		  if ($row['AVAILABLE'] == ''){
		    $certificates .= $row['PROJECT_ID'] . "^" . $row['CERTIFICATE_ID'] . "^" . $row["STARTDATE"] . "^" . $row["COMPLETIONDATE"] . "^" . $row["VALUE"] . "^" .  $row["VALUE"] . "^" . $row["DOCUMENT_LINK"] . ";";
		  }
		}
		if($certificates_old!=""){
		echo json_encode(array('Result' => 1, 'Message' => $certificates, 'Certificates_old' => $certificates_old));
		}
		else {
				echo json_encode(array('Result' => 1, 'Message' => $certificates));
		}
	} 
	mysql_close();
	unset($_SESSION['partner_id']);
?>
<?php
/* Change log

02-Jun-2013 - Vivek - Order by clause added to sort by certificate ID.
11-July-13 - Vivek - Change in layout, addition of completely postpaid certificates.

*/
?>	

