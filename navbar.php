<div  id="navbar" style="z-index:10000;">
<ul id="navlist"> 
<?php if(isset($thispage)){ ?>
<a href="http://www.yousee.in/index.php"><li <?php if ($thispage == "homepage") echo " id=\"currentpage\"";?>>Home</li></a>
<li <?php if ($thispage == "four_donations") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/four_donations.php">4 Donations</a></li>
<li <?php if ($thispage == "donate_time") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_time.php">Donate Time</a></li>
<li <?php if ($thispage == "donate_in_kind") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_in_kind.php">Donate in Kind</a></li>
<li <?php if ($thispage == "donate_waste") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_waste.php">Donate Waste</a></li>
<li <?php if ($thispage == "uccertificates") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/donate_postpay.php">Donate(PostPay)</a></li>
<li <?php if ($thispage == "more") echo " id=\"currentpage\"";?>><a>More</a>
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
<li <?php if ($thispage == "aboutuc") echo " id=\"currentpage\"";?>><a href="http://www.yousee.in/aboutuc.php">About UC</a></li>
<?php } 
else { ?>
<li><a href="http://www.yousee.in/index.php">Home</a></li>
<li><a href="http://www.yousee.in/four_donations.php">4 Donations</a></li>
<li><a href="http://www.yousee.in/donate_time.php">Donate Time</a></li>
<li><a href="http://www.yousee.in/donate_in_kind.php">Donate in Kind</a></li>
<li><a href="http://www.yousee.in/donate_waste.php">Donate Waste</a></li>
<li><a href="http://www.yousee.in/donate_postpay.php">Donate(PostPay)</a></li>
<li><a>More</a>
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
<li><a href="http://www.yousee.in/aboutuc.php">About UC</a></li>
<?php } ?>
<li> <form id="loginForm" name="loginForm" method="post" action="login_exec.php" style="display:inline;">
	 <table style="border-spacing:1px;padding:10px 3% 10px 10px;float:right;display:inline;" cellspacing=0 cellpadding=0 ><tr>
		<td><input style="width:80px;" placeholder="Username" name="username" type="text" title="Username" class="textfield" id="username" /></td>	
     <td> <input style="width:80px;" placeholder="Password" name="password" type="password" title="Password" class="textfield" id="password" /></td>
		<tr><td><input type="submit" name="Submit" value="Login" /></td><td><a style="line-height:35px;"href="http://www.yousee.in/registration.php">Register</a></td></tr></table>
</form></li>
</ul> 
</div>
