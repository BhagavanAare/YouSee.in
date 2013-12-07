<div id="navbar">
<ul id="navlist">  
<li<?php if ($thispage == "homepage") echo " id=\"currentpage\"";?>><a href="index.php">Home</a></li>
<li<?php if ($thispage == "four_donations") echo " id=\"currentpage\"";?>><a href="four_donations.php">4 Donations</a></li>
<li<?php if ($thispage == "donate_time") echo " id=\"currentpage\"";?>><a href="donate_time.php">Donate Time</a></li>
<li<?php if ($thispage == "donate_in_kind") echo " id=\"currentpage\"";?>><a href="donate_in_kind.php">Donate in Kind</a></li>
<li<?php if ($thispage == "donate_waste") echo " id=\"currentpage\"";?>><a href="donate_waste.php">Donate Waste</a></li>
<li<?php if ($thispage == "uccertificates") echo " id=\"currentpage\"";?>><a href="uccertificates.php">Donate(PostPay)</a></li>
<li<?php if ($thispage == "projects_partners") echo " id=\"currentpage\"";?>><a href="projects_partners.php">Projects & Partners</a></li>
<li<?php if ($thispage == "aboutuc") echo " id=\"currentpage\"";?>><a href="aboutuc.php">About UC</a></li>
<li<?php if ($thispage == "contact") echo " id=\"currentpage\"";?>><a href="contact.php">Contact</a></li>
<!-- <li<?php //if ($thispage == "myuc" || $thispage="ngoHomescreen") echo " id=\"currentpage\"";?>><a href="<?php //if ($thispage == "myuc") echo "myuc.php"; elseif($thispage="ngoHomescreen") echo "ngoHomescreen.php" ?>">MyUC</a></li> -->
<?php 
	$activeTab=false;
	
	$page="";
	
	//set homepage for a user based on their type
	if ($_SESSION['SESS_USER_TYPE'] == "D")
	{
		$page="myuc.php";
		
	}
	elseif ($_SESSION['SESS_USER_TYPE'] == "A")
	{
		$page="adminHomescreen.php";
	}
	elseif ($_SESSION['SESS_USER_TYPE'] == "N")
	{
		$page="ngoHomescreen.php";
	}
	
	//set active tab as myuc.php 
	if($thispage=="myuc" || $thispage=="adminHomescreen" || $thispage=="ngoHomescreen")
	{
		$activeTab=true;
		
	}
	
?>
<li<?php if ($activeTab == true) echo " id=\"currentpage\"";?>><a href="<?php echo $page; ?>">My UC</a></li>

</ul> 
</div>