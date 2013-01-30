	<link rel="stylesheet" href="../scripts/jquery-ui.css">
	<script src="../scripts/jquery-1.8.3.js"></script>
	<script src="../scripts/jquery.ui.core.js"></script>
	<script src="../scripts/jquery.ui.widget.js"></script>
	<script src="../scripts/datepicker.js"></script>
 	<script type="text/javascript">
		$(function() {
		$( "#fromDate" ).datepicker();
		$( "#toDate" ).datepicker();
		});
	</script>
<?php
//if (isset($_POST['submit']))
//{

 //connect to database
 include_once("../prod_conn.php");

 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 $result = "SELECT project_id,project_title FROM projects";
 $projectResult=mysql_query($result);
 ?>

<form action="" method="post" name="activity">
  <p>&nbsp;</p>
  <table width="484" height="221" border="0" id="volID">
    <tr>
      <th scope="col"><label for="fromDate">From Date</label></th>
      <th scope="col"><label for="toDate">To Date</label></th>
      <th scope="col"><label for="fromTime">From Time</label></th>
      <th scope="col"><label for="toTime">To Time</label></th>
      <th scope="col"><label for="hours">Conservative Hours</label></th>
      <th scope="col"><label for="area">Area</label></th>
      <th scope="col"><label for="activity">Activity</label></th>
      <th scope="col"><label for="on_off">Onsite/Offsite</label></th>
      <th scope="col"><label for="location">Location</label></th>
      <th scope="col"><label for="organisation">Organisation Supported</label></th>
      <th scope="col"><label for="project">Project</label></th>
    </tr>
    <tr>
      <td><input type="text" name="fromDate" id="fromDate" /></td>
      <td><input name="toDate" type="text" id="toDate" /></td>
      <td><input type="text" name="fromTime" id="fromTime" /></td>
      <td><input type="text" name="toTime" id="toTime" /></td>
      <td><input type="text" name="hours" id="hours" /></td>
      <td><input type="text" name="area" id="area" /></td>
      <td><input type="text" name="activity" id="activity" /></td>
      <td><select name="on_off" id="on_off">
        <option value="onsite">Onsite</option>
        <option value="offsite">Offsite</option>
      </select></td>
      <td><input type="text" name="location" id="location" /></td>
      <td><input type="text" name="organisation" id="organisation" /></td>
      <td><select type="text" name="project" id="project">
        <?php  while($row = mysql_fetch_array($projectResult))
  		{
	  $projectid=$row['project_id'];
	  $projectname=$row['project_title'];
	  ?><option value="<?php echo "".$projectid; ?>"><?php echo "".$projectname; ?></option> 
      <?php } ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    <td>
    <input name="submit" type="submit" value="Submit" /></td></tr>
  </table>
  <p>&nbsp;</p>
</form>

<?php if(isset($_POST['submit'])) 
	{
		
		$donorid=234;
		$type="Shram Dhaan";
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
            }
        }
 
        function deleteRow(volID) {
            try {
            var table = document.getElementById(volID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[1].childNodes[1];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
 
            }
            }catch(e) {
                alert(e);
            }
        }
</SCRIPT>
    <INPUT type="button" value="Add Row" onclick="addRow('volID')" />
 
    <INPUT type="button" value="Delete Row" onclick="deleteRow('volID')" />
  
	