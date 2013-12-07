<!--header-->
<div id="header">

<!-- UC logo -->
<img style="float:left;" src="images/uc-logo.jpg">

<!-- login and register -->
<div style="float:right;">
<?php 
if(!isset($_SESSION['SESS_USER_ID'])){
include 'login_form.php';
}
else{
include 'display_donor_info.php';
echo "<td>&nbsp;</td>";
echo "<a href=\"logout.php\">Logout</a>";
}
?>
</div>

</div>


<!--navbar-->
<?php 
if(!isset($_SESSION['SESS_USER_ID']) || $_SESSION['SESS_USER_TYPE']=="A"){
include 'navbar.php';
}
else{
include 'navbar_myuc.php';
}
?>