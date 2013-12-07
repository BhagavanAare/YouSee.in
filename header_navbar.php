<!--header-->

<div id='header' style="padding:0px;margin:0px;">
<a href="http://www.yousee.in"><img style='position:absolute;padding:5px 10px 5px 10px;float:left;height:65px;z-index:10001;' src='http://www.yousee.in/images/uc-logo.png'></a>
<!--navbar-->
<?php if(!isset($_SESSION[ 'SESS_USER_ID'])){ include 'navbar.php'; } else{ include
'navbar_myuc.php'; } ?>

</div>
