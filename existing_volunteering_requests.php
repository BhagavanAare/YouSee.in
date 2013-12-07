
<?php $thispage ="requests-volunteering";
$place=""; ?>
<?php
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$activityQuery="SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' AND o.to_date>CURDATE() GROUP BY o.activity_id";
$result=mysql_query($activityQuery);
$resultCount=mysql_num_rows($result);
$count=0;

?>
<style>
.highlight{
	margin:2px;
	border:1px solid red;
	border-radius:0.2em;
	box-shadow:0px 0px 1px red;
}
</style>
<div style="display:block;" align="center"><?php
if ($resultCount>0)
{	
/* Select all the places listed */
$options="";
$resultq=mysql_query("SELECT place_id,place_description,location,city,organisation FROM places WHERE partner_id!=0");
			while($rowq=mysql_fetch_array($resultq)){
				$options.="<option value='$rowq[place_id]'>$rowq[place_description], $rowq[location], $rowq[city], $rowq[organisation]</option>";
			}	
		mysql_data_seek($resultq, 0);
?>
<h3 align="left"> <?php echo $resultCount; ?> requests active.</h4>
<hr>
<table align="center" class="table-div2">
	<?php
		while($row = mysql_fetch_array($result))
		{
		
			$opp_query="SELECT * FROM volunteering_opportunities WHERE approval_status='A' AND to_date>'".date("Y-m-d")."' AND activity_id=".$row['activity_id']; 
	$oppresult=mysql_query($opp_query);
	?>
	<tr class="rows postedComment <?php echo $row['vertical'];?> <?php echo $row['domain'];?> <?php if(isset($_SESSION['SESS_USER_ID']) AND $_SESSION['SESS_USER_TYPE']=='D') while($commit=mysql_fetch_array($commitresult)){ if($commit['activity_id']==$row['activity_id']){ echo 'committed'; break;}} ?>" id="<?php echo $row['activity_id']; ?>" >
	<td id="td<?php echo $row['activity_id'];?>" class="outer" style="width:80%;"> <div class="activitydiv" >
	<p style="padding:0px;">
	<b style="float:left;position:relative;padding:0px;margin:0px;width:90%;font-size:14px;color:#369;font-family:Trebuchet MS"><?php echo $row['activity']; ?></b>
	<span style="margin-top:-14px;float:right;margin-right:2px;margin-left:20px;font-family:Trebuchet MS;font-size:11px;"><?php echo $row['embed_video']; ?> </span>
	<p style="padding:0px;margin-right:8px;width:90%;font-size:11px;color:#666;font-family:Trebuchet MS"><b>Details:</b>&nbsp<?php echo $row['activity_details']; ?> </p>
	<?php if($row['vertical']!=''||$row['vertical']!=NULL){ ?><img style="float:left;margin-right:10px;" src="images/<?php echo $row['vertical'];?>.png" width="50px" alt="General" />
	<?php } ?>
	<span style="font-family:Trebuchet MS;font-size:11px;"><b style="color:#0C7878;"><?php if($row['vertical']!=''||$row['vertical']!=NULL) echo $row['vertical']; else echo "General" ?> |</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;"><b style="color:#801506;"><?php echo $row['domain']; ?> |</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;"><b><?php echo $row['onsite_offsite']; ?></b></span>
<br />
	<span style="float:left;font-family:Trebuchet MS;font-size:11px;">Partner:&nbsp<a style="font-size:11px;" href="/npo/<?php echo $row['partner_id'];?>"><?php echo $row['name']; ?></a></span><br />
	<input style="float:right;margin-right:8px;margin-top:-11px;" type="button" value="View and Edit">
	<span style="float:left;width:60%;font-family:Trebuchet MS;font-size:11px;"><b>Skills Required:</b>&nbsp<?php echo $row['skills']; ?></span>

	</p>
	</div>
	</td>
	</tr>
	<tr>
	<td id="details<?php echo $row['activity_id']; ?>" class="inner" hidden>
	<b style="font-size:12px;color:#369;">Activity Schedule</b>
	<table class="table-innerdiv2">
	<tr><th>Date</th><th>Time</th><th>Location</th><th>City</th><th>Vol Req.</th><th>Place</th><th></th></tr>
	<?php while($record=mysql_fetch_array($oppresult)){ ?>
	<tr class="opportunity" id="row<?php echo $row['opportunity_id'];?>">
	<td><form id="form<?php echo $record['opportunity_id']; ?>" name="opportunityForm" method="post" action="existing_volunteering_requests.php">
	<input type="text" value="<?php echo "".gmdate("d-M-Y",strtotime($record['from_date']));?>" class="date" size="8" readonly name="from_date" /><br />
	<input type="text" value="<?php echo "".gmdate("d-M-Y",strtotime($record['to_date']));?>" class="date" size="8" name="to_date" /></td>
	<?php if($record['from_time']==0){ echo "<td><div><input type='text' class='time' size='6' name='from_time' /></div>";}
	else {?>	
	<td><div><input type="text" value="<?php echo date("g:iA",strtotime($record['from_time']));?>" class="time" size="6" name="from_time"  /></div><?php }?>
	<?php if($record['to_time']==0){ echo "<div><input type='text' class='time' size='6' name='to_time' /></div></td>";}
	else {?>	
	<div><input type="text" value="<?php echo date("g:iA",strtotime($record['to_time']));?>" class="time" size="6" name="to_time"  /></div></td> <?php }?>
	
	<td><input type="text" value="<?php echo "".$record['location'];?>" size="10" name="location" /></td>
	<td><input type="text" value="<?php echo "".$record['city'];?>" size="6" name="city" /></td>
	<td><input type="text" name="num_volunteers" value="<?php echo "".$record['num_volunteers'];?>" size="1" /></td>
	<td>
		<select name="place" id="place" style="max-width:100px;">
			<option value="">Select</option>
			<?php 
			$place=$record['place_id'];
			$selops="";
			while($rowq=mysql_fetch_array($resultq)){
				$selops.="<option value='$rowq[place_id]'";
				if($rowq['place_id']==$place) $selops.=" selected ";
				$selops.=">$rowq[place_description], $rowq[location], $rowq[city], $rowq[organisation]</option>";
			}	
			mysql_data_seek($resultq, 0);
			echo $selops; 
			$selops="";?>
		</select>
	</td>

	<td><input type="text" value="<?php echo $record['opportunity_id'];?>" name="opp_id" readonly hidden />
	<input type="button" value="Save" name="save" id="save_changes<?php echo $record['opportunity_id'];?>" />
	</form>
	</td>
	</tr>
	<script>
	$(function(){
	$("#save_changes<?php echo $record['opportunity_id'];?>").click(function(){
		$.ajax({
			type:"POST",
			data : $("#form<?php echo $record['opportunity_id'];?>").serialize(),
			dataType : "JSON",
			url : "update_volunteering_opp.php",
			success:function(returnData){
				alert(returnData);
				$("#row<?php echo $record['opportunity_id'];?> input[type='text']").removeClass("highlight");
			}
		});
	});	
	});
	</script>		
<?php } ?>
		</table>
		<input name="activity_id" form="form<?php echo $row['activity_id']; ?>" type="text" hidden value="<?php echo $row['activity_id']; ?>" />
				<div style="float:right;position:relative;"><input  name="opportunity_add" type="button" id="add_opp<?php echo $row['activity_id']; ?>" value="Add">
		</div>
			

	</td>
	</tr>
	<script type="text/javascript">
		$(function(){
		act_details(<?php echo $row['activity_id']; ?>);
		$(".date").datepicker();
		$(".time").timeEntry();
		
	$(".opportunity input[type='text']").on('change',function(){
			$(this).addClass('highlight');
		});
		var i=0;
		$("#add_opp<?php echo $row['activity_id'];?>").click(function(){
			i++;
			var fromdate="<tr class='opportunity' id='newrow"+i+"'><td><form name='opportunityForm' method='POST' id='newform"+i+"'><input type='text' class='date' size='8' name='from_date' required readonly></input><br />";
			var todate="<input type='text' class='date' size='8' name='to_date' form='newform"+i+"' required readonly></input></td>";
			var fromtime="<td><div><input type='text' class='time' size='6' form='newform"+i+"'   name='from_time'></input></div>";
			var totime="<div><input type='text' class='time' size='6' form='newform"+i+"'  name='to_time' ></input></div></td>";
			var location="<td><input type='text' size='10' form='newform"+i+"'  name='location' required></input></td>";
			var city="<td><input type='text'  size='6' form='newform"+i+"'  name='city' required ></input></td>";
			var num_vol="<td><input type='text' size='1' form='newform"+i+"'  name='num_volunteers' required></input><input type='text' size='2' form='newform"+i+"'  name='activity' value='<?php echo $row['activity_id'];?>' hidden readonly></input></td>";
			var place="<td><select name='place' form='newform"+i+"' id='place' style='max-width:100px;'><option value=''>Select</option><?php echo $options;?></select></td>";
			var save="<td><input type='button' value='Save' class='new_entry' form='newform"+i+"'  id='save_new"+i+"'></input></form></td></tr>";

			$("#details<?php echo $row['activity_id'];?> .table-innerdiv2").append(fromdate+todate+fromtime+totime+location+city+num_vol+place+save);
		$(".date").datepicker();
		$(".time").timeEntry();
			
	$(".opportunity input[type='text']").on('change',function(){
			$(this).addClass('highlight');
		});
			$("#save_new"+i).on('click',function(){	
	
		$.ajax({
			type:"POST",
			data : $("#newform"+i).serialize(),
			dataType : "JSON",
			url : "update_volunteering_opp.php",
			success:function(returnData){
				alert(returnData);
				$("#newrow"+i+" :text").removeClass('highlight');

			}
			});
		});	
		
		});
		
		});
	</script>
<?php $count++;
	
		}

	?>

	
</table>	

<?php
}
else
{
	echo "There are no activities to be displayed.";
}
?>
		
</div>


