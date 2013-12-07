<link rel="stylesheet" type="text/css" href="css/tabs.css">
  
<div  class="left_div" style="width:120px" >
<ul  class="tree" >  
	<li class="tree">
		<label for="folder1" class="menu_first">My Donations</label> 
		<input type="checkbox" checked id="folder1" />
	<ul>
		<li class="tabLink"> <a href="myucSummary.php" class="file" id="summaryTab">Summary</a></li>
		<li class="tabLink"> <a href="myucVolunteeringContributions.php" class="file" id="volunteeringTab">Volunteering</a></li>
		<li class="tabLink"> <a href="myucPageUnderConstruction.php" class="file" id="inkindTab">In Kind</a></li>
		<li class="tabLink"> <a href="myucWasteDonations.php" class="file" id="wasteTab">Waste</a></li>
		<li class="tabLink"> <a href="myucFinancialDonations.php" class="file" id="financialTab">Financial</a></li>
		
    </ul>
	<li class="tree">
		<label for="folder3" class="menu_first">My Commitments</label> 
		<input type="checkbox" checked id="folder3" />
		<ul>
			<li class="tabLink"> <a href="myCommits.php" class="file" id="Volunteering">Volunteering</a></li>
			<li class="tabLink"> <a href="offer_inkind.php" class="file" id="In Kind">In Kind</a></li>
		</ul>
	</li>
	<li class="tree">
		<label for="folder2" class="menu_first">Update</label> 
		<input type="checkbox" checked id="folder2" />
		<ul>
			<li class="tabLink"> <a href="myucUpdateInfoUtil.php" class="file" id="myInfoTab">My Info</a></li>
			<li class="tabLink"> <a href="myucChangePassword.php" class="file" id="settingsTab">Password</a></li>
			<li class="tabLink"> <a href="myucUpdateActivity.php" class="file" id="updateVolunteeringTab">Volunteering</a></li>
		</ul>
	</li>
	<?php include "prod_conn.php";
	$query="SELECT IF(doctor_flag=1,1,0)doctor FROM donors WHERE user_id=$_SESSION[SESS_USER_ID]";
	$doc=mysql_fetch_array(mysql_query($query));
	if($doc['doctor']==1){?>
	<li class="tree">
		<label for="folder2" class="menu_first">Doctor Panel</label> 
		<input type="checkbox" checked id="folder2" />
		<ul>
			<li class="tabLink"> <a href="doctor_schedule.php" class="file" id="docShedule">Schedule</a></li>
		</ul>
	</li>
	<?php }?>
</ul>
</div>
</td>
<td>

<script>
	var tabSelected="file activeLink";
	document.getElementById('<?php echo $activetab ?>').className=tabSelected;
</script>
<!--
Version Track
1 - 07May13 - Vivek - Change of order.
2 - 16Jun13 - Vivek - Addition of innkind commitments.
-->
