<?php include_once "prod_conn.php";
$thispage="more";
$submenu="events"; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <TITLE>Events | YouSee</TITLE>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/jquery.blockUI.js"></script>
  <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
  </script>
	<script type="text/javascript">
//['Hyderabad',17.86,80.64,5,'getnpo.php?npo=1'],['Some city',19.86,80.64,5,'getnpo.php?npo=1']
	var points = [
				<?php 
				$query="SELECT  event_id,event_name, event_latitude, event_longitude FROM events";
				$result=mysql_query($query);
				$num=mysql_num_rows($result);
				$i=1;
				while($row=mysql_fetch_array($result)){
					echo "['$row[event_name]',$row[event_latitude],$row[event_longitude],1,'getevents.php?eventid=$row[event_id]']";
					if($i!=$num){
						echo ",";
					}
					$i++;
				}
				?>
				];
	 
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

<p style="font-size:15px;font-weight:bold;margin-bottom:20px">Find an Event</p>

<div id="map_canvas" style="width: 700px; height: 450px; margin:20px;"></div>

<p style="font-size:15px;font-weight:bold;margin-bottom:20px">List of upcoming Events</p>
<?php
$where="";
if(isset($_GET['name'])){
	$name=mysql_real_escape_string(trim($_GET['name']));
	$where .= "AND LOWER(event_name)=LOWER('".$name."')";
}
$eventquery = "SELECT *,name partner_name FROM events JOIN project_partners ON events.event_user_id=project_partners.user_id WHERE event_id!=0 $where ORDER BY event_from_date DESC ";
$result = mysql_query($eventquery);
while($row=mysql_fetch_array($result)){
?>
<div class="events" style="width:700px;">
<table class="events" width="700px" style="border:1px solid #ccc;padding:10px;margin-bottom:10px;
box-shadow: 1px 1px 1px #666;">
<tr><td>
<span style="font-size:20px;color:#369;font-weight:bold;">
 	<a href="getevents.php?eventid=<?php echo $row['event_id']; ?>"> <?php echo $row['event_name']; ?> </a>
</span>
</td>
<td>
	
	<?php if($row['event_contact_name']!=NULL){ ?>
<span>

	 Contact Person : <?php echo $row['event_contact_name']; ?> 
	 
</span>
<?php } ?>
</td></tr>
<tr><td>
<span style="font-size:12px;">
	<span ><?php echo $row['event_city']; ?> </span>
	<span>,<?php echo $row['event_state']; ?></span>
	<span>,<?php echo $row['event_country']; ?></span>
</span>
</td>
<td>

<?php if($row['event_contact_number']!=NULL) { ?>
<span>
	 Phone : <?php echo $row['event_contact_number']; ?> 
</span>
<?php } ?>
</td></tr>
<tr><td>
	<span>
	Event Date : <?php echo date("d M,Y",strtotime($row['event_from_date'])). " - " . date("d M,Y",strtotime($row['event_to_date'])); ?>
	</span>
</td>
<td>	
	<span>
		 Email : <?php echo $row['event_contact_email']; ?>
	</span>
</td></tr>
<tr><td colspan="2">
	<span>
	Organized By :  <?php echo $row['partner_name']; ?>
	</span>
</td>
</tr>
</table>
</div>
<?php
}
?>
</div>

 <?php include 'footer.php' ; ?>
</div>

</BODY>

</HTML>