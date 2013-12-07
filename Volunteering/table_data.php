
<script type="text/javascript">
		$(function() {
		$(".Date1").datepicker();
		$(".Time1").timeEntry();
		});
		
		   
</script>

<?php
require_once('../login_auth.php');
$donorid=$_SESSION['SESS_DONOR_ID'];
$sno=0;
$result1 = "SELECT name,partner_id FROM project_partners JOIN users USING (user_id) WHERE users.registration_status='A'";
$presult = "SELECT project_id,project_title FROM projects";
$query_pag_data = "SELECT volunteer_act_id,donor_id, displayname, DATE_FORMAT(from_date,'%d-%b-%Y') fromdate, DATE_FORMAT(to_date,'%d-%b-%Y') todate,DATE_FORMAT(from_time,'%h:%i %p') fromtime,DATE_FORMAT(to_time,'%h:%i %p') totime, hours,area,location, activity_done, onsite_offsite,organisation,project_id,partner_id
          FROM volunteering LEFT OUTER JOIN donors USING (donor_id)
          WHERE donor_id=".$donorid."
		  AND approval_status = 'P'
          ORDER BY  fromdate DESC LIMIT $start, $per_page";
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
$tabledata = "";
$tablehead="<tr style='display:none'></tr><tr style='font-weight:bold'><th>S.No</th><th>From Date</th><th>To Date</th><th >From Time</th><th>To Time</th><th>Hours</th><th>Area</th><th>Activity</th><th>Site</th><th>Location</th><th>Organisation</th><th>Project</th><th>Delete</th></tr>";
while($row = mysql_fetch_array($result_pag_data)) 
{
$sno++;
$id=$row['volunteer_act_id'];
$fdate=htmlentities($row['fromdate']);
$tdate=htmlentities($row['todate']);
$ftime=htmlentities($row['fromtime']);
$ttime=htmlentities($row['totime']); 
$hours=htmlentities($row['hours']); 
$area=htmlentities($row['area']);
$location=htmlentities($row['location']);
$activity=htmlentities($row['activity_done']);
$site=htmlentities($row['onsite_offsite']);
$org=htmlentities($row['partner_id']);
$project=htmlentities($row['project_id']);

$orgname = mysql_fetch_array(mysql_query("SELECT name FROM project_partners WHERE partner_id='$org'"));
$orgname_1 = $orgname['name'];

$projectname = mysql_fetch_array(mysql_query("SELECT project_title FROM projects WHERE project_id='$project'"));
$projectname_1 = $projectname['project_title'];




$tabledata.="<tr id='$id' class='edit_tr'>

<td>
<div>$sno</div>
</td>

<td class='edit_td' >
<div id='one_$id' class='text' style='width:70px'>$fdate</div>
<input type='text' value='$fdate' class='editbox Date1' id='one_input_$id' />
</td>

<td class='edit_td' >
<div id='two_$id' class='text' style='width:70px'>$tdate</div> 
<input type='text' value='$tdate' class='editbox Date1' id='two_input_$id' />
</td>

<td class='edit_td' style='width:70px;text-align:center'>
<div id='three_$id' class='text' style='width:60px'>$ftime</div> 
<input type='text' value='$ftime' class='editbox Time1' style='width:60px' id='three_input_$id'/>
</td>

<td class='edit_td' >
<div id='four_$id' class='text' style='width:60px'>$ttime</div> 
<input type='text' value='$ttime' class='editbox Time1' style='width:60px' id='four_input_$id'/>
</td>

<td class='edit_td' >
<div id='five_$id' class='text' style='width:30px'>$hours</div> 
<input type='text' value='$hours' class='editbox' style='width:20px' id='five_input_$id'/>
</td>

<td class='edit_td' >
<div id='six_$id' class='text'>$area</div> 
<!--<input type='text' value='$area' class='editbox' id='six_input_$id'/>
</td>-->
	<select type=\"text\" name=\"area\" class='editbox' id='six_input_$id' >";
        
    $area1=array('Education','Environment','Livelihoods','Health','Support to Elderly','Support to disabled','Information Technology','Documentation','Office Support','Spreading Awareness','Accounting & Legal');
        for($i = 0, $size = count($area1); $i < $size; $i++)
        {
           $tabledata.="<option value='".$area1[$i]."'";
		   if(($area1[$i])==$area)
			{
				$tabledata.="selected" ;
			}
		   $tabledata.=">".$area1[$i]."</option>";
        }
        
        $tabledata.="</select>
</td>


<td class='edit_td' >
<div id='seven_$id' class='text' style='text-align:center;width:80px'>$activity</div> 
<input type='text' value='$activity' class='editbox' id='seven_input_$id'/>

<td class='edit_td' >
<div id='eight_$id' class='text' style='text-align:center;width:40px'>$site</div> 

<select class='editbox' id='eight_input_$id' style='text-align:center'>
zzzxdfxz
  <option ";
  if(($site)=='onsite')
  {
   $tabledata.="selected" ;
  }
  $tabledata.="value='onsite'>Onsite</option>
  <option ";
  if(($site)=='offsite')
  {
	$tabledata.="selected" ;
  }
  $tabledata.="value='offsite'>Offsite</option>
</select>
</td>

<td class='edit_td' >
<div id='nine_$id' class='text' style='text-align:center'>$location</div> 
<input type='text' value='$location' class='editbox' id='nine_input_$id'/>
</td>

<td class='edit_td' >
<div id='ten_$id' class='text' style='text-align:center'>$orgname_1</div> 

<select type=\"text\" name=\"organisation\" class='editbox' id='ten_input_$id' >";
$partnerResult1=mysql_query($result1);
while($row1 = mysql_fetch_array($partnerResult1))
{
    $partnerid1=$row1['partner_id'];
    $name1=$row1['name'];
	$tabledata.="<option value='$partnerid1' title '$name1'";
	if(($org)==$partnerid1)
	{
		$tabledata.="selected" ;
	}
	$tabledata.=">$name1</option>";
    //echo $name1;
   } echo mysql_error();
 $tabledata.="</select>
</td>

<td class='edit_td' >
<div id='eleven_$id' class='text' style='width:100px;text-align:center'>$projectname_1</div> 

<select type=\"text\" name=\"project\" class='editbox' id='eleven_input_$id' >";
$projectResult1=mysql_query($presult);
while($prow = mysql_fetch_array($projectResult1))
{
    $projid=$prow['project_id'];
    $projname=$prow['project_title'];
	
	$tabledata.="<option value='$projid'";
	if(($project)==$projid)
	{
		$tabledata.="selected" ;
	}
	$tabledata.=">$projname</option>";
    //echo $projname;
   } echo mysql_error();
 $tabledata.="</select>
</td>

<td><a href='#' class='delete' id='$id'> Delete </a></td>

</tr>";
}
$finaldata = "<table width='100%' id='table-search'>". $tablehead . $tabledata . "</table>"; // Content for Data


/* Total Count */
$query_pag_num = "SELECT COUNT(*) AS count FROM volunteering WHERE donor_id=".$donorid." AND approval_status = 'P'";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

?>