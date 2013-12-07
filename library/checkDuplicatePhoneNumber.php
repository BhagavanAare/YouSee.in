<?php
require_once("classes/MemberQuery.php");
require_once("classes/Member.php");
$phone = $_POST['phone'];
$memQ = new MemberQuery();
$result = $memQ->DupPhone($phone);
if($result)
{
echo "<p> This Phone Number has already been registered by a member. Please enter another number. </p>";
}
else {
return false; }?>