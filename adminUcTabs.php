<?php
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$activityQuery="SELECT name,activity,activity_details,skills,onsite_offsite,location,city,num_volunteers,opportunity_id FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='P'";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;
?>
<div class="left_div" style=" float:left;border-right:1px solid #ccc;">
<ul  class="tree" >  
	<li class="tree">
		<label for="folder1" class="menu_first"></label> 
		<label for="folder1" class="menu_first">  Activations</label> 
		<input type="checkbox" checked id="folder1" />
		<ul  class="tree" >  

			<li class="tabLink"><a href="adminUcNgoRegistrations.php" class="file" id="ngoRegistrationsTab">NGO Registrations</a></li>
			<li class="tabLink"><a href="adminUcVolunteeringApprovals.php" class="file" id="volunteeringApprovalsTab">Volunteer Hours</a></li>
			<li class="tabLink"><a  href="activityApproval.php" class="file" id="activityApprovalsTab">Volunteering Opp. <?php if($resultCount>0) {?><span style="color:#fE0606">(<?php echo $resultCount; ?>)</span><?php } ?></a></li>
			<li class="tabLink"><a  href="addserviceplace.php" class="file" id="serviceplaceTab">Add a Service place</a></li>
		</ul>
	</li>
	<li class="tree"> 
		<label for="folder4" class="menu_first">Commitments</label> 
		<input type="checkbox" checked id="folder4" />
		<ul  class="tree" >  
			<li class="tabLink"><a href="volunteer_commitments.php"  class="file" id="volunteerCommitmentsTab">Volunteering</a></li>	
			<li class="tabLink"><a href="inkind_commitments.php"  class="file" id="inkindCommitmentsTab">In-Kind</a></li>	
		</ul>
	</li>
	<li class="tree"> 
		<label for="folder5" class="menu_first">  Update</label> 
		<input type="checkbox" checked id="folder5" />
		<ul  class="tree" >  
			<li class="tabLink"><a href="adminuc_volunteering_requests.php"  class="file" id="requests-volunteering">Volunteering Opp.</a></li>
			<li class="tabLink"><a href="adminuc_event_inkind.php"  class="file" id="events-inkind">In-Kind Donations</a></li>					
			<li class="tabLink"><a href="update_waste.php"  class="file" id="wasteUpdateTab">Waste Donations</a></li>	
			<li class="tabLink"><a href="admin_postpay.php"  class="file" id="postpayUpdateTab">Postpay Donations</a></li>
			<li class="tabLink"><a href="update_serviceplaces.php"  class="file" id="service-places">Service places</a></li>					
		</ul>
	</li>
	<li class="tree"> 
		<label for="folder6" class="menu_first">  Reports</label> 
		<input type="checkbox" checked id="folder6" />
		<ul  class="tree" >  
			<li class="tabLink"><a href="admin_reports_donor.php"  class="file" id="donorReportsTab">Donor Reports</a></li>	
		</ul>
	</li>
	<li class="tree"> 
		<label for="folder3" class="menu_first">  Logs</label> 
		<input type="checkbox" checked id="folder3" />
		<ul  class="tree" >  
			<li class="tabLink"><a href="adminUcDonorLoginLog.php"  class="file" id="donorLoginLogTab">Donors</a></li>
			<li class="tabLink"><a href="adminUcNgoLoginLog.php" class="file" id="ngoLoginLogTab">NGOs</a></li>
			
		</ul>
	</li>
	<li class="tree"> 
		<label for="folder5" class="menu_first">Others</label> 
		<input type="checkbox" checked id="folder6" />
		<ul  class="tree" >  
			<li class="tabLink"><a href="getserverIP.php"  class="file" id="getserverIP">View IP addresses</a></li>	
			<li class="tabLink"><a href="adminucresetpwd.php"  class="file" id="resetpwd">Reset password</a></li>	
			<li class="tabLink"><a href="admin_mailer.php"  class="file" id="admin_mailer">Mailer</a></li>	
		</ul>
	</li>
</ul>
</div>
<script>
	var tabSelected="file activeLink";
	document.getElementById('<?php echo $activetab ?>').className=tabSelected;
</script>
<!--
Version Track
1 - 16May13 - Yashasvy - Commitments Tab added to menu
2 - 01June13 - Murali Krishna - Update Waste added to menu.
3 - 05June13 - Murali Krishna - Postpay donations added to menu.
4 - 16June13 - Vivek - Inkind commitments added to menu.
-->
