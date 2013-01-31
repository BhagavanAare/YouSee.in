<link rel="stylesheet" href="../scripts/jquery-ui.css">
<script src="../scripts/jquery-1.8.3.js"></script>
<script src="../scripts/jquery.ui.core.js"></script>
<script src="../scripts/jquery.ui.widget.js"></script>
<script src="../scripts/datepicker.js"></script>
<style type="text/css">

span.link {
    	position: relative;
}

    span.link a span {
    	display: none;
}

span.link a:hover {
    	font-size: 99%;
    	font-color: #000000;
}

span.link a:hover span { 
    display: block; 
    	position: absolute; 
    	margin-top: 10px; 
    	margin-left: -10px; 
	    width: 175px; padding: 5px; 
    	z-index: 100; 
    	color: #000000; 
    	background: #f0f0f0; 
    	font: 12px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
}
</style>


<script type="text/javascript">
		$(function() {
		$( ".date" ).datepicker();
		//$( ".toDate[]" ).datepicker();
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
 
 $result = "SELECT project_id,project_title FROM projects";
 $projectResult=mysql_query($result);
 ?>

<form action="" method="post" name="activity" onsubmit="return isProject()">
  <p>&nbsp;</p>
  <table width="484" height="221" border="0" id="volID">
    <tr>
          
      <th scope="col"><label for="fromDate">From Date</label></th>
      <th scope="col"><label for="toDate">To Date</label></th>
      <th scope="col"><label for="fromTime">From Time</label></th>
      <th scope="col"><label for="toTime">To Time</label></th>
      <th scope="col"><label for="hours">Conservative Hours<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>YouSee follows conservative approach to record volunteer hours to ensure there is no accidental over report of volunteer hours. We believe and acknowledge that the actual volunteer contributions are much more than entered hours.</span></a></span></label></th>
      <th scope="col"><label for="area">Area</label></th>
      <th scope="col"><label for="activity">Activity</label></th>
      <th scope="col"><label for="on_off">Onsite/<br />Offsite</label></th>
      <th scope="col"><label for="location">Location</label></th>
      <th scope="col"><label for="organisation">Organisation Supported</label></th>
      <th scope="col"><label for="project">Project</label></th>
    </tr>
    <tr>
      <td><input class="date" size="7" type="text" name="fromDate[]" id="fromDate" /></td>
      <td><input class="date" size="7" type="text" name="toDate[]"  id="toDate" /></td>
      <td><input size="7" type="text" name="fromTime[]" id="fromTime" /></td>
      <td><input size="7" type="text" name="toTime[]" id="toTime" /></td>
      <td><input size="7" type="text" name="hours[]" id="hours" /></td>
      <td><input size="7" type="text" name="area[]" id="area" /></td>
      <td><input size="7" type="text" name="activity[]" id="activity" /></td>
      <td><select name="on_off[]" id="on_off">
          <option value="onsite">Onsite</option>
          <option value="offsite">Offsite</option>
        </select></td>
      <td><input size="7" type="text" name="location[]" id="location" /></td>
      <td><input size="7" type="text" name="organisation[]" id="organisation" /></td>
      <td><select style="max-width:120px;" type="text" name="project[]" id="project">
      <option value="NULL">--Select--</option>
          <?php  while($row = mysql_fetch_array($projectResult))
  		{
	  $projectid=$row['project_id'];
	  $projectname=$row['project_title'];
	  ?>
      	   
          <option value="<?php echo "".$projectid; ?>"><?php echo "".$projectname; ?></option>
          <?php } ?>
        </select></td>
    </tr>
  </table>
  <INPUT type="button" value="Add Row" onclick="addRow('volID')" />
<INPUT type="button" value="Delete Last Row" onclick="deleteRow('volID')" />

  <p><input name="submit[]" type="submit" value="Submit" /></p>
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
		$count= count($_POST['fromDate']);
		echo $count;
		
		$donorid=234;
		
		$type="Shram Dhaan";
		$volunteerInsertAtts= "donor_id,from_date,to_date,from_time,to_time,hours,donation_type,area,activity_done,onsite_offsite,location,organisation,notes,project_id,approval_status";
	
		for($i=0;$i<$count;$i++)
		{
		
			$volunteerValues="$donorid,'".$_POST['fromDate'][$i]."','".$_POST['toDate'][$i]."','".$_POST['fromTime'][$i]."','".$_POST['toTime'][$i]."','".$_POST['hours'][$i]."','$type','".$_POST['area'][$i]."','".$_POST['activity'][$i]."','".$_POST['on_off'][$i]."','".$_POST['location'][$i]."','".$_POST['organisation'][$i]."','notesss','".$_POST['project'][$i]."','P'";
		
		
			$insertUserQuery="INSERT INTO volunteering($volunteerInsertAtts) VALUES($volunteerValues)";
	//echo $insertUserQuery;
			if (!mysql_query($insertUserQuery))
  			{
  				die('Error: ' . mysql_error());
				showError();
				exit();
  			}
		}
			
	}
?>
<SCRIPT language="javascript">
        function addRow(volID) {
 
            var table = document.getElementById(volID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
				newcell.innerHTML = table.rows[1].cells[i].innerHTML;
				switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                } 				
                newcell.innerHTML = table.rows[1].cells[i].innerHTML;

            }
        }
 
        function deleteRow(volID) {
            try {
            var table = document.getElementById(volID);
            var rowCount = table.rows.length;
            if(rowCount <= 2) {
                alert("Cannot delete all the rows.");
                return;
            }
            var i=rowCount-1; 
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                 table.deleteRow(i);
                
                }
 
 
            
            catch(e) {
                alert(e);
            }
        }
</SCRIPT>
