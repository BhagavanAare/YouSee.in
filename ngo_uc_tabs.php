<ul  class="tree" >  
	<li class="tree">
		<label for="folder1" class="menu_first">Donations Received</label> 
		<input type="checkbox" checked id="folder1" />
		<ul>
			<li class="tabLink"><a href="ngo_uc_donation_summary.php" class="file" id="summaryTab" >Summary</a></li>					
			<li class="tabLink"><a href="ngo_uc_volunteer_hours.php" class="file" id="volunteerHoursTab" >Volunteering </a></li>					
			<li class="tabLink"><a href="ngo_uc_in_kind_donations.php" class="file" id="inKindTab">In Kind</a></li>					
			<li class="tabLink"><a href="ngo_uc_financial_donations.php" class="file" id="financialTab"  >Financial </a></li> 

			
		</ul>
	</li>
	<li class="tree">
		<label for="folder2" class="menu_first">Make Requests</label> 
		<input type="checkbox" checked id="folder2" />
		<ul>
			
			<li class="tabLink"><a href="req_volunteering.php" class="file" id="volunteerReqTab">Volunteering </a></li>					
			<li class="tabLink"><a href="req_inkind.php" class="file" id="inKindReqTab">In Kind Donations </a></li> 

			
		</ul>
	</li>
	<li class="tree">
		<label for="folder3" class="menu_first">Update</label> 
		<input type="checkbox" checked id="folder3" />
		<ul>
			<li class="tabLink"><a href="ngo_uc_update_org_info.php"  class="file" id="orgInfoTab">Org Info</a></li>					
			<li class="tabLink"><a href="ngo_uc_update_password.php"  class="file" id="passwordTab">Password</a></li>					

			
		</ul>
	</li>
</ul>
<script>
	var tabSelected="file activeLink";
	document.getElementById('<?php echo $activetab ?>').className=tabSelected;
</script>

<?php
/*
2 - 16Jun13 - Vivek - Addition of innkind requests.
*/
?>
