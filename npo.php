<?php 
session_start();
include_once "prod_conn.php";
$thispage="more";
$submenu="npo";

$where="";
$page_no = 1;
$limit = "LIMIT 0,10";
$start="1";
$end="10";
if(isset($_POST['search_npo']) && $_POST['search_npo']!=''){
	$where .= " AND LOWER(name) LIKE LOWER('%$_POST[search_npo]%') ";
}
if(isset($_POST['search_city']) && $_POST['search_city'][0]!=''){	
	$where.=" AND (";
	$ccount=count($_POST['search_city']);
   	foreach($_POST['search_city'] as $c){
			if($ccount>1){
				$where.="LOWER(hq_town_city)=LOWER('".$c."') OR ";
				$ccount--;
			}
			else{
  				$where.="LOWER(hq_town_city)=LOWER('".$c."'))";
			}
	}
}
if(isset($_POST['type'])){
	$where.=" AND (";
	$ccount=count($_POST['type']);
   	foreach($_POST['type'] as $c){
			if($ccount>1){
				$where.="LOWER(type)=LOWER('".$c."') OR ";
				$ccount--;
			}
			else{
  				$where.="LOWER(type)=LOWER('".$c."'))";
			}
	}
}
if(isset($_GET['city'])){
	$city=mysql_real_escape_string(trim($_GET['city']));
	$where .= "AND hq_town_city='".$city."'";
}
if(isset($_POST['id'])){
	$limit = " LIMIT $_POST[start], $_POST[limit]";
	$page_no = $_POST['start']/$_POST['limit']+1;
	$start=$_POST['start'];
	
if(isset($_SESSION['where_npo'])){
	$where.=$_SESSION['where_npo'];
	unset($_SESSION['where_npo']);
}
}
$_SESSION['where_npo']=$where;

 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <TITLE>NPO's | YouSee</TITLE>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/jquery.blockUI.js"></script>
  <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
  </script>
  <script>
  //['Hyderabad',17.86,80.64,5,'getnpo.php?npo=1'],['Some city',19.86,80.64,5,'getnpo.php?npo=1']
	var points = [
				<?php 
				$query="SELECT  hq_town_city, latitude, longitude FROM project_partners LEFT JOIN users ON project_partners.user_id = users.user_id WHERE registration_status = 'A' $where ";
				$result=mysql_query($query);
				$num=mysql_num_rows($result);
				$i=1;
				while($row=mysql_fetch_array($result)){
					echo "['$row[hq_town_city]',$row[latitude],$row[longitude],1,'npo.php?city=$row[hq_town_city]']";
					if($i!=$num){
						echo ",";
					}
					$i++;
				}
				?>
				];
	console.log("<?php echo $query; ?>");
	function setMarkers(map, cities) {
	    var shape = {
	        coord: [1, 1, 1, 20, 18, 20, 18, 1],
	        type: 'poly'
	    };
	    for (var i = 0; i < cities.length; i++) {
	        var flag = new google.maps.MarkerImage(
	            'http://googlemaps.googlermania.com/google_maps_api_v3/en/Google_Maps_Marker.png',
	        new google.maps.Size(37, 34),
	        new google.maps.Point(0, 0),
	        new google.maps.Point(10, 34));
	        var place = cities[i];
	        var myLatLng = new google.maps.LatLng(place[1], place[2]);
	        var marker = new google.maps.Marker({
	            position: myLatLng,
	            map: map,
	            icon: flag,
	            shape: shape,
	            title: place[0],
	            zIndex: place[3],
	            url: place[4]
	        });
	        google.maps.event.addListener(marker, 'click', function () {
	        window.location.href = this.url;
	        });
	    }
	}
	function initialize() {
		// Create an array of styles.


	    var myOptions = {
	    center: new google.maps.LatLng(23.324167, 78.134766),
	        zoom: 4,
	   mapTypeControlOptions: {
	      mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID ]
	    }
	    };
		
	    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	    map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: false});

	     setMarkers(map, points);
	}
	
	google.maps.event.addDomListener(window,'load',initialize);
	$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
  </script>
	<style>
		table.npo td{
			width:50%;
		}
	</style>
 </HEAD>
 <BODY>

<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->

<?php include 'header_navbar.php';?>

<!--maincontentarea-->

<div id="uccertificate-main">
<div id="leftnav" class="leftnav" style="width:200px;float:left;min-height:100%;">
<table id="search_filter">
	<font style="font-weight:bold;font-size:16px;color:black;margin-left:20px;">Options</font><input type="button" style="color:#666;cursor:pointer;" id="clear_filters" value = "Clear Filters" hidden />
		<tr>
		<td><br /><form id="search_form">
			<input type="text" id="search_npo" placeholder="NPO Name" 
			<?php if(isset($_POST['search_npo'])) 
				echo " value='$_POST[search_npo]' ";
			?>
			/><input type="submit" id = "search_npo_button" value=">" /></form>
		</td>
	</tr>
	
	<th align="left"><br />City</th>
	<tr>
		<td>
		<div  style="max-height:200px;overflow:auto;">
			<?php 
			
			$query="SELECT COUNT(*) count,LOWER(hq_town_city) hq_town_city FROM project_partners LEFT JOIN users ON project_partners.user_id = users.user_id WHERE registration_status = 'A' $where GROUP BY LOWER(hq_town_city) ORDER BY hq_town_city ASC";
			$result=mysql_query($query);
			while($row=mysql_fetch_array($result)){
				echo "<input type='checkbox' name='city[]' id='$row[hq_town_city]' class='search_city' value='$row[hq_town_city]'";
				if(isset($_POST['search_city']) && $_POST['search_city'][0]==$row['hq_town_city']) 
				echo " checked ";
				echo " /><label for='$row[hq_town_city]'>".ucfirst($row['hq_town_city'])." ($row[count])</label><br />";
			}
			?>
		</div>
		</td>
	</tr>	
	<th align="left"><br />Type</th>
	<tr>
		<td>
		<div  style="max-height:200px;overflow:auto;">
			<?php 
			include_once "prod_conn.php";
			$query="SELECT COUNT(*) count,type FROM project_partners LEFT JOIN users ON project_partners.user_id = users.user_id WHERE registration_status = 'A' $where GROUP BY LOWER(type) ORDER BY type ASC";
			$result=mysql_query($query);
			while($row=mysql_fetch_array($result)){
				echo "<input type='checkbox' name='type[]' id='$row[type]' class='search_type' value='$row[type]' ";
				if(isset($_POST['type']) && $_POST['type'][0]==$row['type']) 
				echo " checked ";
				echo "/><label for='$row[type]'>$row[type] ($row[count])</label><br />";
			}
			?>
		</div>
		</td>
	</tr>
  <script src="scripts/ajax_npo.js"></script>	
</table>

</div>
<?php 

$countquery = "SELECT COUNT(*) count FROM project_partners LEFT JOIN users ON project_partners.user_id = users.user_id WHERE registration_status = 'A' $where ";
$countresult=mysql_query($countquery);

$count=mysql_fetch_array($countresult);
?>
<p style="font-size:15px;font-weight:bold;margin-bottom:20px">Find an NPO</p>
<p>You can view on this page Non Profit Organisations (NPOs) which have listed themselves with UC for mobilising any of the 4 Donations. You can click on the each NPO link, to  view various ways to support these NPOs.</p>


<div id="map_canvas" style="width: 750px; height: 400px; margin:20px;"></div>
<div id="displayedList">

<p style="font-size:15px;font-weight:bold;margin-bottom:20px;width:700px;padding-left:200px;">List of NPO partners (<?php echo $count['count']; ?> Total)</p>
<?php
$npoquery = "SELECT * FROM project_partners LEFT JOIN users ON project_partners.user_id = users.user_id WHERE registration_status = 'A' $where ORDER BY name ASC  $limit";
$result = mysql_query($npoquery);
?>
<div id="subList">
<?php
if(mysql_num_rows($result)>0){
if(isset($_POST['id'])){
	$end=$start+mysql_num_rows($result);
}
echo "<div style='background:#eee;padding:5px;margin:20px;width:700px;margin-left:200px;'><strong>Page $page_no</strong> ($start to $end)</div>";
while($row=mysql_fetch_array($result)){
?>
<div class="npo" style="width:700px;padding-left:200px;">
<table class="npo" width="700px" style="border:1px solid #ccc;padding:10px;margin-bottom:10px;
box-shadow: 1px 1px 1px #666;" id="<?php echo $row['partner_id']; ?>">
<tr><td>
<span style="font-size:20px;color:#369;font-weight:bold;">
 	<a href="getnpo.php?npo=<?php echo $row['partner_id']; ?>"> <?php echo $row['name']; ?> </a>
</span>
</td>
<td>
	
	<?php if($row['contact_first_name']!=NULL || $row['contact_last_name']!=NULL){ ?>
<span>

	 Contact Person : <?php echo $row['contact_first_name']." ".$row['contact_last_name']; if($row['contact_person_designation']!=NULL) {?> , <?php echo $row['contact_person_designation']; }?> 
	 
</span>
<?php } ?>
</td></tr>
<tr><td>
<span style="font-size:12px;">
	<span ><?php if($row['hq_town_city']!='') echo $row['hq_town_city'].", "; ?> </span>
	<span><?php if($row['hq_state']!='') echo $row['hq_state'].", "; ?></span>
	<span><?php echo $row['hq_country']; ?></span>
</span>
</td>
<td>

<?php if($row['office_phone']!=NULL) { ?>
<span>
	 Phone : <?php echo $row['office_phone']; ?> 
</span>
<?php } ?>
</td></tr>
<tr><td>
	<span>
	Organization Type : <?php echo $row['type']; ?>
	</span>
</td>
<td>	
	<span>
		 Email : <?php echo $row['partner_email']; ?>
	</span>
</td></tr>
</table>
</div>
<?php
}
}
else exit;
?>
</div>
</div>
<div id="loadMoreComments"></div>
</div>

 <?php include 'footer.php' ;  ?>
</div>

</BODY>

</HTML>