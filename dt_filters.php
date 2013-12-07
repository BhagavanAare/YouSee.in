<?php 
session_start();
if(isset($_SESSION['where_var'])){
$where=$_SESSION['where_var'];
$_SESSION['where_query']=$_SESSION['where_var'];
unset($_SESSION['where_var']);
}
else $where="";
?>
<script type="text/javascript" src="scripts/custom_jquery.js"></script>

<table style="width:200px;border-right:1px solid #aaa;">
<tr><font style="font-weight:bold;font-size:16px;margin-left:20px;color:black;">Options </font><input align="right" type="button" class="clear_filter" value="Clear Filters" id="clear_filter" 
<?php if(!isset($_REQUEST['vertical']) && !isset($_REQUEST['domain']) && !isset($_REQUEST['city']) && !isset($_REQUEST['activity']) ) {
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
?>><label for="<?php echo $result['domain'];?>"><?php echo $result['domain']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
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
?>><label for="<?php echo $result['city'];?>"><?php echo $result['city']." <font style='color:#666;font-size:12px'>(".$result['count'].")</font>";?></label></input><br />
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