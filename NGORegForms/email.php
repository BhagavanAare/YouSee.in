<?php 
$email_to = "mittu.thefire@gmail.com";
$email_subject = "Test E-Mail (This is the subject of the E-Mail)";
$email_body = "This is the body of the Email \nThis is a second line in the body!";

if(mail($email_to, $email_subject, $email_body)){
	echo "The email($email_subject) was successfully sent.";
} else {
	echo "The email($email_subject) was NOT sent.";
}
?>
