<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	//$body             = file_get_contents('contents.html');
	//$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 2525;                    // set the SMTP server port
	$mail->Host       = "mail.yousee.in"; // SMTP server
	$mail->Username   = "contact@yousee.in";     // SMTP server username
	$mail->Password   = "Tactcon1";            // SMTP server password
	

	$mail->AddReplyTo("contact@yousee.in","Yousee");

	$mail->From       = "contact@yousee.in";
	$mail->FromName   = "contact@yousee.in";

	/*$to = "akhilesh910@gmail.com";

	$mail->AddAddress($to);*/
                                   
	//$mail->Subject  = "Acknowledgement-Information Submission";
	//$mail->AddAttachment("test.png");
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	//$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML
	
	/*$mail->Send();
	//echo 'Message has been sent.';
*/	
}
 catch (phpmailerException $e) {
	//echo $e->errorMessage();
	echo "asddsa";
}

?>