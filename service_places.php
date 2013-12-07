<?php 
session_start();
include_once "prod_conn.php";
$thispage="more";
$submenu="place";

$where="";
$page_no = 1;
$limit = "LIMIT 0,10";
$start="1";
if(isset($_POST['search_place']) && $_POST['search_place']!=''){
	$where .= " AND LOWER(place_title) LIKE LOWER('%$_POST[search_place]%') ";
}
if(isset($_POST['search_city']) && $_POST['search_city'][0]!=''){	
	$where.=" AND (";
	$ccount=count($_POST['search_city']);
   	foreach($_POST['search_city'] as $c){
			if($ccount>1){
				$where.="LOWER(city)=LOWER('".$c."') OR ";
				$ccount--;
			}
			else{
  				$where.="LOWER(city)=LOWER('".$c."'))";
			}
	}
}
if(isset($_POST['type'])){
	$where.=" AND (";
	$ccount=count($_POST['type']);
   	foreach($_POST['type'] as $c){
			if($ccount>1){
				$where.="LOWER(place_category)=LOWER('".$c."') OR ";
				$ccount--;
			}
			else{
  				$where.="LOWER(place_category)=LOWER('".$c."'))";
			}
	}
}
if(isset($_GET['city'])){
	$city=mysql_real_escape_string(trim($_GET['city']));
	$where .= "AND city='".$city."'";
}
if(isset($_POST['id'])){
	$limit = " LIMIT $_POST[start], $_POST[limit]";
	$page_no = $_POST['start']/$_POST['limit']+1;
	$start=$_POST['start']+1;
	
if(isset($_SESSION['where_place'])){
	$where.=$_SESSION['where_place'];
	unset($_SESSION['where_place']);
}
}
$_SESSION['where_place']=$where;

 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <TITLE>Service Places | YouSee</TITLE>
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
				if(isset($_GET['city'])){
					$query="SELECT place_id,IF(place_title!='',place_title,place_category)place_title,location,latitude,longitude FROM places JOIN place_category ON places.place_category_id = place_category.place_category_id WHERE 1 $where";
					$result=mysql_query($query);
					$num=mysql_num_rows($result);
					$i=1;
					while($row=mysql_fetch_array($result)){
						echo "['$row[place_title], $row[location]',$row[latitude],$row[longitude],1,'/places/$row[place_id]']";
						if($i!=$num){
							echo ",";
						}
						else{
							$latitude=$row['latitude'];
							$longitude=$row['longitude'];
						}
						$i++;
					}
				}
				else{
				$query="SELECT  city, latitude, longitude FROM places where 1 $where GROUP BY city";
				$result=mysql_query($query);
				$num=mysql_num_rows($result);
				$i=1;
				while($row=mysql_fetch_array($result)){
					echo "['$row[city]',$row[latitude],$row[longitude],1,'service_places.php?city=$row[city]']";
					if($i!=$num){
						echo ",";
					}
					$i++;
					}
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
	    center: new google.maps.LatLng(<?php if(isset($_GET['city'])){ echo $latitude.",".$longitude;}else echo "23.324167, 78.134766";?>),
	        zoom: <?php if(isset($_GET['city'])) echo "10"; else echo "4";?>,
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
 
 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_IN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
			<input type="text" id="search_place" placeholder="Service Place Name" 
			<?php if(isset($_POST['search_place'])) 
				echo " value='$_POST[search_place]' ";
			?>
			/><input type="submit" id = "search_place_button" value=">" /></form>
		</td>
	</tr>
	
	<th align="left"><br />City</th>
	<tr>
		<td>
		<div  style="max-height:200px;overflow:auto;">
			<?php 
			
			$query="SELECT COUNT(*) count,city FROM places
			JOIN place_category ON places.place_category_id=place_category.place_category_id
			LEFT JOIN project_partners ON places.partner_id = project_partners.partner_id
			 where 1 $where GROUP BY city";
			$result=mysql_query($query);
			while($row=mysql_fetch_array($result)){
				echo "<input type='checkbox' name='city[]' id='$row[city]' class='search_city' value='$row[city]'";
				if(isset($_POST['search_city']) && $_POST['search_city'][0]==$row['city']) 
				echo " checked ";
				echo " /><label for='$row[city]'>".ucfirst($row['city'])." ($row[count])</label><br />";
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
			$query="SELECT COUNT(*) count, place_category place_type FROM places JOIN place_category ON places.place_category_id = place_category.place_category_id where 1 $where GROUP BY place_type";
			$result=mysql_query($query);
			while($row=mysql_fetch_array($result)){
				echo "<input type='checkbox' name='type[]' id='$row[place_type]' class='search_type' value='$row[place_type]' ";
				if(isset($_POST['type']) && $_POST['type'][0]==$row['place_type']) 
				echo " checked ";
				echo "/><label for='$row[place_type]'>$row[place_type] ($row[count])</label><br />";
			}
			?>
		</div>
		</td>
	</tr>
  <script src="scripts/ajax_places.js"></script>	
</table>

</div>
<?php 

$countquery = "SELECT COUNT(*) count FROM places JOIN place_category ON places.place_category_id=place_category.place_category_id where 1 $where ";
$countresult=mysql_query($countquery);

$count=mysql_fetch_array($countresult);
?>
<p style="font-size:15px;font-weight:bold;margin-bottom:20px">Find a Service Place</p>
<p>If you are searching, to visit an Old Age Home, Children's Home, Shelter for Homeless, School, Hospital or an Environmental activity place, to share your time and support, you can now find them here. Please do let us know of more such places which can be posted on this page by calling +91-8008-884422 or writing to contact@yousee.in</p>


<div id="map_canvas" style="width: 750px; height: 400px; margin:20px;"></div>
<div id="displayedList">

<p style="font-size:15px;font-weight:bold;margin-bottom:20px;width:700px;padding-left:200px;">List of Service Places (<?php echo $count['count']; ?> Total)</p>
<?php
$placequery = "SELECT place_id,places.partner_id,place_category place_type,place_title,places.address,places.location,city,name organisation FROM places
LEFT JOIN project_partners ON places.partner_id = project_partners.partner_id
JOIN place_category ON places.place_category_id=place_category.place_category_id
 where 1 $where ORDER BY place_title $limit";
$result = mysql_query($placequery);
?>
<div id="subList">
<?php
if(mysql_num_rows($result)>0){
	$end=$start+mysql_num_rows($result)-1;
echo "<div style='background:#eee;padding:5px;margin:20px;width:700px;margin-left:200px;'><strong>Page $page_no</strong> ($start to $end)</div>";
while($row=mysql_fetch_array($result)){
?>
<div class="npo" style="width:700px;padding-left:200px;">
<table class="npo" width="700px" style="border:1px solid #ccc;padding:10px;margin-bottom:10px;
box-shadow: 1px 1px 1px #666;" id="<?php echo $row['place_id']; ?>">
<tr><td>
<span style="font-size:20px;color:#369;font-weight:bold;">
 	<a href="/getplaces.php?placeid=<?php echo $row['place_id'];?>"><?php echo $row['place_title']; ?> </a>
</span>
</td>
<tr><td>
<span style="font-size:12px;">
	<tr>
	<td><span > <b>Supported By: </b> &nbsp <?php if($row['organisation']!='') echo "<a href='getnpo.php?npo=$row[partner_id]'>$row[organisation]</a>"; ?> </span></td>
	<td><span><b>Place Type: </b> &nbsp <?php echo $row['place_type']?> </br></span>
	</td></tr>
	<td><span> <b> Address:</b> &nbsp <?php echo $row['address']." ".$row['location'].", ".$row['city']; ?></span></td>
</span>
</td>
</tr>
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
