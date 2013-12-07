<?php
require_once("classes/MemberQuery.php");
require_once("classes/Member.php");
$email = $_POST['email'];
$memQ = new MemberQuery();
$result = $memQ->DupEmail($email);
if($result)
{
echo "<p> This email address has already been registered by a member. Please enter another email address.</p>";
}
else {
return false;
}?>