<div id="navbar">
<ul id="navlist">  
<li<?php if ($thispage == "homepage") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/index.php">Home</a></li>
<li<?php if ($thispage == "four_donations") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/four_donations.php">4 Donations</a></li>
<li<?php if ($thispage == "donate_time") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_time.php">Donate Time</a></li>
<li<?php if ($thispage == "donate_in_kind") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_in_kind.php">Donate in Kind</a></li>
<li<?php if ($thispage == "donate_waste") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_waste.php">Donate Waste</a></li>
<li<?php if ($thispage == "uccertificates") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_postpay.php">Donate(PostPay)</a></li>
<li<?php if ($thispage == "more") echo " id=\"currentpage\"";?>><a>More</a>
<ul>
	<li <?php if (isset($submenu) && $submenu == "service_places") echo " id=\"currentsub\"";?>>
		<a href="http://www.yousee.in/service_places.php">Service Places</a>
	</li>

	<li <?php if (isset($submenu) && $submenu == "doctor") echo " id=\"currentsub\"";?>>
		<a href="http://www.yousee.in/doctor">People's Doctors</a>
	</li>

	<li <?php if (isset($submenu) && $submenu == "library") echo " id=\"currentsub\"";?>>
		<a href="http://www.yousee.in/library">People's Library</a>
	</li>

	<li <?php if (isset($submenu) && $submenu == "npo") echo " id=\"currentsub\"";?>>
		<a href="http://www.yousee.in/npo.php">NPOs</a>
	</li>

	<li <?php if (isset($submenu) && $submenu == "events") echo " id=\"currentsub\"";?>>
		<a href="http://www.yousee.in/events.php">Events</a>
	</li>

</ul>
</li>
<li<?php if ($thispage == "aboutuc") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/aboutuc.php">About UC</a></li>
<!-- <li<?php //if ($thispage == "myuc" || $thispage="ngoHomescreen") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/<?php //if ($thispage == "myuc") echo "myuc.php"; elseif($thispage="ngoHomescreen") echo "ngoHomescreen.php" ?>">MyUC</a></li> -->
<?php 
	$activeTab=false;
	
	$page="";
	
	//set homepage for a user based on their type
	if ($_SESSION['SESS_USER_TYPE'] == "D")
	{
		$page="myucSummary.php";
		
	}
	elseif ($_SESSION['SESS_USER_TYPE'] == "A")
	{
		$page="adminUcNgoRegistrations.php";
	}
	elseif ($_SESSION['SESS_USER_TYPE'] == "N")
	{
		$page="ngo_uc_donation_summary.php";
	}
	
	//set active tab as myuc.php 
	if($thispage=="myuc" || $thispage=="adminHomescreen" || $thispage=="ngoHomescreen")
	{
		$activeTab=true;
	}
	
?>
<li<?php if ($activeTab == true) echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/<?php echo $page; ?>">My UC</a></li>
<li> <table style="border-spacing:0px;padding:10px 3% 10px 10px;float:right;display:inline;" cellspacing=0 cellpadding=0 ><tr><td><font  style='line-height:30px;cursor:default'><?php echo $_SESSION['SESS_DISPLAYNAME']."</a></td></tr><tr><td>"."<a  style='line-height:30px;' href=\"logout.php\">Logout</a></td></tr></table>"; ?></li>
</ul> 
</div>
