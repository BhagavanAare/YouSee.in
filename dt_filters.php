<?php 

if(isset($_SESSION['where_var'])){
$where=$_SESSION['where_var'];
//echo "$where";
$_SESSION['where_query']=$_SESSION['where_var'];
unset($_SESSION['where_var']);
}
else 
{
	//echo "biscuit";
	$where="";
}
$where = "";
if(isset($_REQUEST['vertical']))
{
	$where.=" AND (";
	$vcount=count($_REQUEST['vertical']);
   	foreach($_REQUEST['vertical'] as $v){
			if($vcount>1){
				$where.="v.vertical='".$v."' OR ";
				$vcount--;
			}
			else{
  				$where.="v.vertical='".$v."')";
			}
	}
}
if(isset($_REQUEST['dates'])){
	$where.=" AND (";
	$dates = $_REQUEST['dates'];
	$fromdate = new DateTime($dates[0]);
	$todate = new DateTime($dates[1]);
	$from_date = $fromdate->format('Y-m-d');
	$to_date = $todate->format('Y-m-d');
	$where.="$from_date <= o.to_date AND $to_date >= o.from_date) ";
}
if(isset($_REQUEST['domain'])){
	$where.=" AND (";
	$dcount=count($_REQUEST['domain']);
   	foreach($_REQUEST['domain'] as $d){
			if($dcount>1){
				$where.="v.domain='".$d."' OR ";
				$dcount--;
			}
			else{
  				$where.="v.domain='".$d."')";
			}
	}
}
if(isset($_REQUEST['city'])){
	$where.=" AND (";
	$ccount=count($_REQUEST['city']);
   	foreach($_REQUEST['city'] as $c){
			if($ccount>1){
				$where.="o.city='".$c."' OR ";
				$ccount--;
			}
			else{
  				$where.="o.city='".$c."')";
			}
	}
}
if(isset($_REQUEST['activity'])){
		$where.=" AND (";
	$acount=count($_REQUEST['activity']);
   	foreach($_REQUEST['activity'] as $a){
			if($acount>1){
				$where.="v.onsite_offsite='".$a."' OR ";
				$acount--;
			}
			else{
  				$where.="v.onsite_offsite='".$a."')";
			}
	}
}
if(isset($_POST['date'])){
		$where.=" AND (";
		$date=date_format(date_create_from_format('j-M-Y', $_POST['date']), 'Y-m-d');
		$where.="o.from_date <= ".$date." AND ".$date."<= o.to_date )";;
}


?>
<script type="text/javascript" src="scripts/custom_jquery.js"></script>

<table style="width:200px;border-right:1px solid #aaa;">
<tr><font style="font-weight:bold;font-size:16px;margin-left:20px;color:black;">Options </font><input align="right" type="button" class="clear_filter" value="Clear Filters" id="clear_filter" 
<?php if(!isset($_REQUEST['vertical']) && !isset($_REQUEST['domain']) && !isset($_REQUEST['city']) && !isset($_REQUEST['activity']) && !isset($_REQUEST['dates'])) {
		echo "hidden ";
	}
?>
 /><thead hidden>
<th>Search</th>
</thead></tr>
<tr hidden><td>
<input type="text" align="left" id="searchbox" style="width:130px" /><img align="right" style="width:20px;height:20px;cursor:pointer" src="" />
</td></tr>
<tr hidden>
<th>Search by date</th>
</tr>
<td hidden>
<input type="text" align="left" id="datesearch" class="datesearch" style="width:130px" />
</td>
</tr>
<td><b>Area</b></td>
<tr>
<td>
<?php
//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query="SELECT DISTINCT vertical, count( vertical ) AS count
FROM (
SELECT vertical, count( vertical )
FROM volunteering_activity v
INNER JOIN volunteering_opportunities o ON v.activity_id = o.activity_id
WHERE vertical != ''
AND o.to_date>'".date("Y-m-d")."'
AND approval_status = 'A' ".$where."
GROUP BY o.activity_id
)T1
GROUP BY vertical";
$queryresult=mysql_query($query);
while($result=mysql_fetch_array($queryresult)){
?><input type="checkbox" name="vertical[]" value="<?php echo $result['vertical'];?>" id="<?php echo $result['vertical'];?>" class="vertical" onchange="visible();" 
<?php
if(isset($_REQUEST['vertical'])){
	if($_REQUEST['vertical'][0]==$result['vertical']){
	echo "checked";
	}
}
?>><label for="<?php echo $result['vertical'];?>"><?php echo $result['vertical']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
<?php } ?><br />
</td>
</tr>

<td> <b>Date</b></td>
<tr>
	<td>
	<?php 
	$query = "
			SELECT count(v.activity_id) AS today_count
			FROM volunteering_activity v
			INNER JOIN volunteering_opportunities o ON v.activity_id = o.activity_id
			WHERE ".date("Y-m-d")." <= o.to_date AND ".date("Y-m-d")." >= o.from_date 
			AND approval_status = 'A' ".$where."";
			
	
	$queryresult=mysql_query($query);
	$result=mysql_fetch_array($queryresult);
	$todayCount = $result['today_count'];
			
	$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
	
	$query = "
			SELECT count(v.activity_id) AS tomorrow_count
			FROM volunteering_activity v
			INNER JOIN volunteering_opportunities o ON v.activity_id = o.activity_id
			WHERE ".date("Y-m-d", $tomorrow)." <= o.to_date AND ".date("Y-m-d", $tomorrow)." >= o.from_date
			AND approval_status = 'A' ".$where."";
	$queryresult=mysql_query($query);
	$result=mysql_fetch_array($queryresult);
	
	$tomorrowCount = $result['tomorrow_count'];
	
	$checkedOption = 0;
	if(isset($_REQUEST['dates']))
	{
		$dates = $_POST['dates'];
		$checkedOption = $dates[2];
	} 
	
	?>
	
	
	<tr>
		<td>
			<div id="today_div" >
			<input type="checkbox" class="dates" name="date[]" value="today" id="today" onchange="visible();" /><label for="today">Today(<?php echo $todayCount; ?>)</label><br />
			</div>
			<div id="tomorrow_div" >
			<input type="checkbox" class="dates" name="date[]" value="tomorrow" id="tomorrow" onchange="visible();" /><label for="tomorrow">Tomorrow(<?php echo $tomorrowCount; ?>)</label><br />
			</div>
			<div id="date_div" >
			<input type="text" id="from_date" name="from_date" placeholder="From"  size="8" style="width: 65px" />
			<input type="text" id="to_date" disabled="true" name="to_date" placeholder="To" size="8" style="width: 65px" />
			<input type="button" class="dates" id="date_submit" name="date_submit" value=">" />
			</div>
			
			
			<script type="text/javascript">	
				
				var todayCount = <?php echo $todayCount;?>;
				var tomorrowCount = <?php echo $tomorrowCount;?>;
				if(todayCount <1)
				{
					$("#today_div").hide();
				}
				if(tomorrowCount <1)
				{
					$("#tomorrow_div").hide();
				}
			</script>
			
		</td>
	</tr>
</td>
<?php
	echo "<script>";	
	if($checkedOption == 1)
	{
		?>
		$("#today_div").show();
		$("#today").prop("checked","true");
		$("#tomorrow_div").hide();
		$("#date_div").hide();
		<?php	
	}
	else if($checkedOption == 2)
	{
		?>
		$("#today_div").hide();
		$("#tomorrow_div").show();
		$("#tomorrow").prop("checked","true");
		$("#date_div").hide();
		<?php	
	}
	else if($checkedOption == 3)
	{
		$dates = $_POST['dates'];
		?>
		$("#today_div").hide();
		$("#tomorrow_div").hide();
		$("#date_div").show();
		$("#from_date").val("<?php echo $dates[0]; ?>");
		$("#to_date").val("<?php echo $dates[1]; ?>");
		$("#to_date").removeAttr("disabled");
		<?php	
	}
	echo "</script>";

?>

</td>
</tr>


<td><b>Domain</b></td>
<tr>
<td>
<?php
$query="SELECT DISTINCT domain, count( domain ) AS count
FROM (
SELECT domain, count( domain )
FROM volunteering_activity v
INNER JOIN volunteering_opportunities o ON v.activity_id = o.activity_id
WHERE domain != ''
AND o.to_date>'".date("Y-m-d")."'
AND approval_status = 'A' ".$where."
GROUP BY o.activity_id
)T1
GROUP BY domain";

$queryresult=mysql_query($query);
while($result=mysql_fetch_array($queryresult)){
?><input type="checkbox" name="domain[]" value="<?php echo $result['domain'];?>" id="<?php echo preg_replace('/( *)/', '', $result['domain']);?>" class="domain" onchange="visible();"
<?php
if(isset($_REQUEST['domain'])){
	if($_REQUEST['domain'][0]==$result['domain']){
	echo "checked";
	}
}
?>><label for="<?php echo preg_replace('/( *)/', '', $result['domain']);?>"><?php echo $result['domain']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
<?php } ?><br />
</td>
</tr>
<td><b>City</b></td>
<tr>
<td>
<?php
$query="SELECT DISTINCT city, count( city ) AS count
FROM (
SELECT city, count( city )
FROM volunteering_activity v
INNER JOIN volunteering_opportunities o ON v.activity_id = o.activity_id
WHERE city != ''
AND o.to_date>'".date("Y-m-d")."'
AND approval_status = 'A' ".$where."
GROUP BY o.activity_id
)T1
GROUP BY city";
$queryresult=mysql_query($query);
while($result=mysql_fetch_array($queryresult)){
?><input type="checkbox" name="city[]" value="<?php echo $result['city'];?>" id="<?php echo preg_replace('/( *)/', '', $result['city']);?>" class="city" onchange="visible();"
<?php
if(isset($_REQUEST['city'])){
	if($_REQUEST['city'][0]==$result['city']){
	echo "checked";
	}
}
?>><label for="<?php echo preg_replace('/( *)/', '', $result['city']);?>"><?php echo $result['city']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
<?php } ?><br />
</td>
</tr>
<td><b>Activity Type</b></td>
<tr>
<td>
<?php
$query="SELECT DISTINCT onsite_offsite, count( onsite_offsite ) AS count
FROM (
SELECT onsite_offsite, count( onsite_offsite )
FROM volunteering_activity v
INNER JOIN volunteering_opportunities o ON v.activity_id = o.activity_id
WHERE onsite_offsite != ''
AND o.to_date>'".date("Y-m-d")."'
AND approval_status = 'A' ".$where."
GROUP BY o.activity_id
)T1
GROUP BY onsite_offsite";
$queryresult=mysql_query($query);
while($result=mysql_fetch_array($queryresult)){
?><input type="checkbox" name="activity[]" value="<?php echo $result['onsite_offsite'];?>" id="<?php echo $result['onsite_offsite'];?>" class="activity" onchange="visible();" 
<?php
if(isset($_REQUEST['activity'])){
	if($_REQUEST['activity'][0]==$result['onsite_offsite']){
	echo "checked ";
	}
}
?>"><label for="<?php echo $result['onsite_offsite'];?>"><?php echo $result['onsite_offsite']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
<?php } ?><br />
</td>
</tr>
</table>