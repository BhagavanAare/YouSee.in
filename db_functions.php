<?php
	include('prod_conn.php'); 
	
	$mode = $_POST['mode'];
	//$mode = "CHECK_REGISTRATION";
	$query = "";
	
	if($mode == "CATEGORY") {
		$query = "SELECT *
				  FROM 
				  item_category
				 ";
		
		$result = mysql_query($query);
		
		$return_data = "";
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)) {
				$return_data .= $row['category_id'] . ", " . $row['category'] ."; ";
			}		
			echo json_encode(array('Result' => 1, 'Message' => $return_data));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == "ITEM") {
		$category_id = $_POST['category_id'];
		$query = "SELECT item_id, donationitem
				  FROM 
				  items
				  WHERE
				  category_id = '$category_id'
				 ";
		
		$result = mysql_query($query);
		
		$return_data = "";
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)) {
				$return_data .= $row['item_id'] . ", " . $row['donationitem'] ."; ";
			}		
			echo json_encode(array('Result' => 1, 'Message' => $return_data));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == "DONORS_LIST") {
		//$input = "A";
		$input = $_POST['input_text'];
		$query = "SELECT donor_id, displayname, village_town, mobile_phone_no, preferred_email, org_grp_name
				  FROM 
				  donors
				  WHERE
				  displayname COLLATE UTF8_GENERAL_CI LIKE '%$input%'
				 ";
		
		$result = mysql_query($query);
		
		$return_data = "";
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)) {
				$return_data .= $row['donor_id'] . "," . $row['displayname'] . "," . $row['mobile_phone_no']. "," . $row['preferred_email'] . "," . $row['village_town'] . "," . $row['org_grp_name'] . ";";
			}		
			echo json_encode(array('Result' => 1, 'Message' => $return_data));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == "SUBMIT") {
		$donor = $_POST['donor'];
		$dod = $_POST['dod'];
		$placeofdonation = $_POST['placeofdonation'];
		$city = $_POST['city'];
		$item_id = $_POST['item_id'];
		$unit = $_POST['unit'];
		$quantity = $_POST['quantity'];
		$unit_val = $_POST['unit_val'];
		$cal_val = $_POST['cal_val'];
		$actual_value = $_POST['actual_value'];
		
		$query = "INSERT INTO donatewaste 
				 (donor_id, dateofdonation, placeofdonation, city, item_id, donationunit, donationquantity, donationunitvalue, donationcalculatedvalue, donationvalue) 
				 VALUES 
				 ('$donor','$dod','$placeofdonation','$city','$item_id','$unit','$quantity','$unit_val','$cal_val','$actual_value')
				 ";
		//echo json_encode(array('Result' => 1, 'Message' => $query));
		$result = mysql_query($query);
		if($result > 0) {
			echo json_encode(array('Result' => 1, 'Message' => "YES"));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == 'CERTIFICATES') {
		
			$query = "SELECT PROJECT_ID, PROJECT_DESCRIPTION, NAME
			            FROM (SELECT PROJECT_ID, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID
			              FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
			                FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
			                                                           FROM postpay_certificates GROUP BY CERTIFICATE_ID)PAID
			                 USING (CERTIFICATE_ID)
			                 GROUP BY  PROJECT_ID)SUMMARY
			            LEFT OUTER JOIN projects USING (PROJECT_ID))FULL
			          LEFT OUTER JOIN project_partners USING (PARTNER_ID)
			          ORDER BY PROJECT_ID DESC
			          " ;

			$result = mysql_query($query);
			$projects = "";
			while ($row = mysql_fetch_assoc($result)) {
				$projects .= $row['PROJECT_ID'] . "^" . $row['PROJECT_DESCRIPTION'] . "^" . $row['NAME'] . ";";	
			}
			
			$query2 = "SELECT PROJECT_ID, CERTIFICATE_ID, DATE_FORMAT(START_DATE,'%d-%b-%Y') STARTDATE, DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') COMPLETIONDATE, VALUE, (VALUE-POSTPAID) AVAILABLE
			            FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
			                                                  FROM postpay_certificates GROUP BY CERTIFICATE_ID)PAID
			            USING (CERTIFICATE_ID)
			            ORDER BY PROJECT_ID DESC 
			            ";

			$result2 = mysql_query($query2);
			$certificates = "";
			while ($row = mysql_fetch_assoc($result2)) {
			  $certificates .= $row['PROJECT_ID'] . "," . $row['CERTIFICATE_ID'] . "," . $row["STARTDATE"] . "," . $row["COMPLETIONDATE"] . "," . $row["VALUE"] . "," . $row["AVAILABLE"] . ";";
			}
			echo json_encode(array('Result' => 1, 'Projects' => $projects, 'Certificates' => $certificates));
	} else if ($mode == 'SUBMIT_DON_DETAILS') {
		$dod = $_POST['DOD'];
		$amount = $_POST['Amount'];
		$mode_pay = $_POST['MODE_PAY'];
		$ins_no = $_POST['INS_NO'];
		$ins_date = $_POST['INS_DATE'];
		$ins_nar = $_POST['INS_NAR'];
		$query = "INSERT INTO payments
				 (payment_date, mode_of_payment, instrument_no, instrument_date, instrument_amount, instrument_narration) 
				 VALUES 
				 ('$dod', '$mode_pay', '$ins_no', '$ins_date', '$amount', '$ins_nar')
				 ";
		$result = mysql_query($query);
		if($result > 0) {
			$pid=mysql_insert_id();
				echo json_encode(array('Result' => 1, 'Message' => "YES", 'Payment_Id' => $pid));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == 'SUBMIT_DON') {
		$payment_id = $_POST['Payment_Id'];
		$user_Id = $_POST['User_id'];
		$cer_id = $_POST['Certificate_id'];
		$amount_pr = $_POST['Amount_Pro'];
		$amount_op = $_POST['Amount_Op'];
		$amount=$amount_pr+$amount_op;
		$query = "INSERT INTO postpay_certificates
				 (payment_id, certificate_id, donor_id, amount_for_project, amount_for_operations_grant) 
				 VALUES 
				 ('$payment_id', '$cer_id', '$user_Id', '$amount_pr', '$amount_op')
				 ";
		$result = mysql_query($query);
		if($result > 0) {
			// Send an email to the NPO and donor acknowledging the donation.
			include "Email/sendemail.php";
			$ngoquery="SELECT contact_first_name,contact_last_name,name,partner_email,first_name,last_name,displayname,preferred_email,title,payment_date,mode_of_payment
			FROM project_partners 
			LEFT JOIN project_certificates ON project_partners.partner_id=project_certificates.partner_id 
			RIGHT JOIN postpay_certificates ON project_certificates.certificate_id=postpay_certificates.certificate_id
			RIGHT JOIN donors ON postpay_certificates.donor_id=donors.donor_id
			RIGHT JOIN payments ON postpay_certificates.payment_id=payments.payment_id
			WHERE postpay_certificates.certificate_id='$cer_id' AND postpay_certificates.donor_id='$user_Id' AND payments.payment_id='$payment_id'";
			$qresult=mysql_query($ngoquery);
			$qrows=mysql_fetch_array($qresult);
			$paramsngo=
			array(
			$email=$qrows['partner_email'],
			$subject="Ackowledgement - Donation made",
			$displayname=$qrows['contact_first_name']." ".$qrows['contact_last_name'],
			$mailtext="This is to inform you that $qrows[displayname] has made a postpay donation of Rs.$amount to UC on $qrows[payment_date] towards the project of $qrows[name] listed on UC site www.yousee.in . If there any updates of $qrows[name] projects which you may wish to share with $qrows[displayname], you are welcome do so by email to $qrows[preferred_email]. You may reply to this email or call +91-8008-884422 for any further information you may like to have from <a href='http://www.yousee.in'>YouSee</a>.",
			);
			call_user_func_array('sendEmail',$paramsngo);
			
			$paramsdonor=
			array(
			$email=$qrows['preferred_email'],
			$subject="Ackowledgement - Donation made",
			$displayname=$qrows['first_name']." ".$qrows['last_name'],
			$mailtext="Thank you for your donation of Rs.$amount towards the project '$qrows[title]', made on $qrows[payment_date] through $qrows[mode_of_payment]. We welcome you to login into your account on UC site www.yousee.in, to download or print the Receipt of Contributions at your convenience. You may submit the downloaded receipts for claiming of tax benefits under section 80G of Income Tax Act. You may reply to this email or call +91-8008-884422 for any further information you may like to have from <a href='http://www.yousee.in'>YouSee</a>.",
			);
			call_user_func_array('sendEmail',$paramsdonor);
			
			//Return an array with the Result being true.		
			echo json_encode(array('Result' => 1, 'Message' => "YES"));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} 
	mysql_close();
?>
