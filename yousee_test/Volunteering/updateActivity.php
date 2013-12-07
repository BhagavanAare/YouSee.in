<link rel="stylesheet" href="scripts/jquery-ui.css">
 <link rel="stylesheet" type="text/css" href="css/main.css">
 <link rel="stylesheet" type="text/css" href="test/test.css">
	<script src="scripts/jquery-1.8.3.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
	<script src="scripts/autocomplete.js"></script>
    <script src="scripts/gen_validatorv4.js"></script>
	<script type="text/javascript" src="scripts/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script><style>
      div.scrollbar 
      {
			overflow: auto;
			border: solid 1px #000;
			padding: 5px;
			width: 600px;
			height: 300px;
		}
    </style>
<script type="text/javascript">
		$(function() {
		// $( "#toDate\\[\\]" ).datepicker()
		$(".Date").datepicker();
		$(".Time").timeEntry();
		});
		
	
		$(function() {
		$("#organisation").change(function() {

		$('#project option').show();
		if($(this).data('projectoptions') == undefined){
		/*Taking an array of all options-2 and kind of embedding it on the select1*/
		$(this).data('projectoptions',$('#project option').clone());
		} 
		
		var id = $(this).val();
		var blockoptions = $(this).data('projectoptions').filter('[name=' + id + ']');
		$('#project').html(blockoptions);
		$('#project').prepend('<option value="" selected="selected" >--Select--</option>');
		});
		   });
	</script>



    

<?php
$donorid=$_SESSION['SESS_DONOR_ID'];
//if (isset($_POST['submit']))
//{

 //connect to database
 include_once("prod_conn.php");

 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 

 $area="SELECT COUNT( * ) AS  `Rows` ,  `project_area` 
FROM  `projects` 
GROUP BY  `project_area` 
ORDER BY  `project_area`"; 
 ?>
<?php
//Get post data from session variable
if(isset($_SESSION['POST_DATA']))
{
	$_POST=$_SESSION['POST_DATA'];
	unset($_SESSION['POST_DATA']);
}
?>
<form action="redirect.php" method="post" name="activity" onsubmit="return isProject()">

  <input type="hidden" name="formname" value="updateActivity" />
  <table>
  <tr><td>
  <fieldset>
<legend><h3>Volunteer Activity Update Form</h3></legend>
  <table  border="0" id="volID">
 <tr><td><label for="fromDate">From Date *</label></td>
      <td><input class="Date" size="7" type="text" name="fromDate" id="fromDate" /></td>
      </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_fromDate_errorloc"></div></td>
        </tr>
      <tr><td><label for="toDate">To Date *</label></td>
        <td><input class="Date" size="7" type="text" name="toDate" id="toDate" /></td>
        </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_toDate_errorloc"></div></td>
        </tr>
      <tr><td><label for="fromTime">From Time</label></td>
            <td><input size="7" type="text" class="Time" name="fromTime" id="fromTime" /></td>
</tr>
      <tr><td><label for="toTime">To Time</label></td>
            <td><input size="7" type="text" class="Time" name="toTime" id="toTime" /></td>

      </tr>
      <tr><td><label for="hours">Conservative Hours<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>YouSee follows a conservative approach to record volunteer hours to ensure that there is no accidental over reporting of volunteer hours. We believe and acknowledge that the actual volunteer contributions are much more than the reported hours.</span></a></span></label></td>
            <td><input size="7" type="text" name="hours" id="hours" /></td>
      
      </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_hours_errorloc"></div></td>
        </tr>
      <tr><td><label for="area">Area</label></td>
	  <td><input type="text" id="area" name="area" tabindex="2" onchange="DropDownIndexClear('edleveltextbox');" style="width:103px; position: absolute; z-index: 1;text-transform:capitalize; margin-top:-13px;" />
			<select name="" id="edleveltextbox" tabindex="1000" onchange="DropDownTextToBox(this,'area');" style="position: absolute; z-index: 0; width: 125px;margin-top:-13px; height : 22px" >
			<?php
				$area=array('Education','Environment','Livelihoods','Health','Support to Elderly','Support to disabled','Information Technology','Documentation','Office Support','Spreading Awareness','Accounting & Legal');
				for($i = 0, $size = count($area); $i < $size; $i++)
				{
				        echo "<option value=\"".$area[$i]."\" title=\"".$area[$i]."\">".$area[$i]."</option>";
				}
			?>
			</select>
			<script language="javascript" type="text/javascript">
				DropDownIndexClear("edleveltextbox");
			</script>
			</td>
      <!--<td><select name="area" id="area" style="max-width:120px;">
          <option value="Education">Education</option>
		  <option value="Environment">Environment</option>
          <option value="Livelihoods">Livelihoods</option>
          <option value="Health">Health</option>
          <option value="Support to Elderly ">Support to Elderly </option>
          <option value="Support to Disabled">Support to Disabled</option>
		  <option value="Information Technology">Information Technology</option>
		  <option value="Support to Disabled">Support to Disabled</option>
		  <option value="Support to Disabled">Support to Disabled</option>
		  <option value="Support to Disabled">Support to Disabled</option>
          ,Documentation,Office Support,Spreading Awareness,Accounting & Legal,
          </select></td>-->
       </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_area_errorloc"></div></td>
        </tr>
      <tr><td><label for="activity">Activity</label></td>
       <td><input size="7" type="text" name="activity" id="activity" /></td>
      </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_activity_errorloc"></div></td>
        </tr>
      <tr><td><label for="on_off">Onsite/Offsite</label></td>
         <td><select name="on_off" id="on_off">
          <option value="Onsite">Onsite</option>
          <option value="Offsite">Offsite</option>
        </select></td>
      </tr>
      <tr><td><label for="location">Location</label></td>
      <td><input size="7" type="text" name="location" id="location" /></td>
      </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_location_errorloc"></div></td>
        </tr>
      <tr><td><label for="organisation">Organisation Supported</label></td>
       <td>
	  <select style="max-width:120px;" type="text" name="organisation" id="organisation" />
	  <option value="NULL">--Select--</option>
          <?php  
			$result1 = "SELECT partner_id,name FROM project_partners";
			$projectResult1=mysql_query($result1);
		  
		  while($row1 = mysql_fetch_array($projectResult1))
			{
			$projectid1=$row1['name'];
			$name1=$row1['name'];
			?>
      	   
			<option value="<?php echo "".$projectid1; ?>"><?php echo "".$name1; ?></option>
			<?php } ?>
      </select>
	  
	  </td>
      </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_organisation_errorloc"></div></td>
        </tr>
      <tr><td><label for="project">Project</label></td>
            <td>
	  <select style="max-width:120px;" type="text" name="project" id="project">
      <option value="NULL">--Select--</option>
          <?php 
			$result = "SELECT partner_id, project_id,project_title FROM projects";
			$projectResult=mysql_query($result);

		  while($row = mysql_fetch_array($projectResult))
			{
				$partnerid=$row['partner_id'];
				$projectid=$row['project_id'];
				$projectname=$row['project_title'];
		?>
      	   
          <option value="<?php echo "".$projectid; ?>" name="<?php echo $partnerid; ?>" hidden><?php echo "".$projectname; ?></option>
          <?php } ?>
        </select>
		</td>
      </tr>
      <tr>
        <td colspan="2"><div class="error" id="activity_project_errorloc"></div></td>
        </tr>
      <tr><td>  <p><input name="submit[]" type="submit" value="Submit" /></p></td></tr>
      </table>
      
        </fieldset>
      </td><td style="vertical-align:top;">
      <div class="scrollbar" >
      <p style="font-family:Tahoma, Geneva, sans-serif;size:20px;color:#FFF;background-color:#000066"; align="center" > Volunteer Activity Information Submitted</p><br/>
      <?php include("volunteer_personal_contributions_list_pending.php");?>
      </div>
      </td>
    </tr>
  </table>
  

</form>


<script>
function isProject()
{
	var i=0;
	var projects=document.getElementsByName('project[]');
	var count=projects.length;
	for(i=0;i<count;i++)
	{
		if(projects[i].value=="NULL")
		{
			alert("Please select the Project or remove the corresponding rows");
			return false;
		}
	}
	return true;

}
</script>
<?php if(isset($_POST['submit'])) 
	{
		
		//$donorid=234;
			

		$type="Shram Dhaan";
		$_POST['fromTime']=DATE("H:i", STRTOTIME($_POST['fromTime']));
		$_POST['toTime']=DATE("H:i", STRTOTIME($_POST['toTime']));
		$_POST['location']=ucwords($_POST['location']);
		
		
		$volunteerInsertAtts= "donor_id,from_date,to_date,from_time,to_time,hours,donation_type,area,activity_done,onsite_offsite,location,organisation,notes,project_id,approval_status";
	
			$volunteerValues="$donorid,'".$_POST['fromDate']."','".$_POST['toDate']."','".$_POST['fromTime']."','".$_POST['toTime']."','".$_POST['hours']."','$type','".$_POST['area']."','".$_POST['activity']."','".$_POST['on_off']."','".$_POST['location']."','".$_POST['organisation']."','notesss','".$_POST['project']."','P'";
		
		
			$insertUserQuery="INSERT INTO volunteering($volunteerInsertAtts) VALUES($volunteerValues)";
	//echo $insertUserQuery;
			if (!mysql_query($insertUserQuery))
  			{
  				die('Error: ' . mysql_error());
				showError();
				exit();
  			}
		echo "<script>window.location.href='myuc.php'</script>";	
	}
?>

	<script type="text/javascript">
	var frmvalidator  = new Validator("activity");
	frmvalidator.EnableFocusOnError(true);
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	
	
 	frmvalidator.addValidation("fromDate","req"," *Please enter From Date");
	frmvalidator.addValidation("toDate","req"," *Please enter To Date");
	frmvalidator.addValidation("hours","req"," *Please enter conservative hours");
	frmvalidator.addValidation("hours","numeric"," *Hours should be numeric");
	frmvalidator.addValidation("area","req"," *Please enter your Area of activity");
	frmvalidator.addValidation("activity","req","*Please enter your Activity");
	frmvalidator.addValidation("activity","alpha_s","Activity must contain only characters");
	frmvalidator.addValidation("location","req"," *Please enter the location of your Activity");
	frmvalidator.addValidation("location","alpha_s","Location must  only contain characters");
	frmvalidator.addValidation("organisation","dontselect=NULL"," *Please select an organisation");
	//frmvalidator.addValidation("organisation","dontselect=NULL","please");
  </script>
