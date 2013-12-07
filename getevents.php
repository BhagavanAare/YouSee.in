<?php 	
		session_start();
		$thispage = "more";
		
		// Include db configuration file
		require_once "prod_conn.php";
		$id=mysql_real_escape_string(trim($_GET['eventid']));
		$name=mysql_real_escape_string(trim($_GET['event']));
		$querystringcheck = "SELECT LOWER(event_name) event_name FROM events WHERE event_id = $id";
		$result=mysql_query($querystringcheck);
		while($row=mysql_fetch_array($result)){
			$event=str_replace(" ","-",$row['event_name']);
			if($name!=$event){
				header("Location:/events/$id/$event");
				exit();
			}
		}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/div.css">
  <script src="/scripts/jquery.min.js"></script>

  <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
  </script>
	<script type="text/javascript">
//['Hyderabad',17.86,80.64,5,'getnpo.php?npo=1'],['Some city',19.86,80.64,5,'getnpo.php?npo=1']
	var points = [
				<?php 
				$query="SELECT  event_id,event_name,event_address,event_city,event_latitude, event_longitude FROM events WHERE event_id=$id";
				$result=mysql_query($query);
				$num=mysql_num_rows($result);
				$i=1;
				while($row=mysql_fetch_array($result)){
				echo "['$row[event_name], $row[event_address]',$row[event_latitude],$row[event_longitude],1,'getevents.php?eventid=$row[event_id]']";
				$latitude = $row['event_latitude'];
				$longitude = $row['event_longitude'];
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
	        new google.maps.Point(0, 19));
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
	    center: new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude; ?>),
	        zoom: 13,
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
  </HEAD>
 <BODY>

<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->

<?php include 'header_navbar.php';?>

<!--maincontentarea-->

<div id="uccertificate-main">

<!-- Right div -->
<?php
$event_query="SELECT events.*,name partner_name from events JOIN project_partners ON events.event_user_id=project_partners.user_id WHERE event_id = $id";
$result=mysql_query($event_query);
while($row=mysql_fetch_array($result)){
?>
<title><?php echo $row['event_name']; ?></title>
<div class="events" style="width:960px;">
<table class="events" width="960px" style="border-spacing:10px;border:1px solid #ccc;padding:10px;margin-bottom:10px;border-radius:0.2em;">
<tr><td>
<span style="font-size:20px;color:#369;font-weight:bold;">
 	<a href="/getevents.php?event=<?php echo $row['event_name']; ?>"> <?php echo $row['event_name']; ?> </a>
</span>
</td>
</tr>
<tr>
<td rowspan="10" style="width:500px;border-right:1px solid #ccc;padding-right:20px;">
	<p>
		<?php echo $row['event_description']; ?>
	</p>
</td>
</tr>
<tr><td width="100px">
	<span>
	<b>Event Date :</b> </span></td>
<td>
	<span><?php echo date("d M,Y",strtotime($row['event_from_date'])). " - " . date("d M,Y",strtotime($row['event_to_date'])); ?>
	</span>
</td>
</tr>
<tr><td>
	<span>
	<b>Event Time :</b>
	</span>
</td>
<td>
<span> <?php echo date("g:i A",strtotime($row['event_from_time'])). " - " . date("g:i A",strtotime($row['event_to_time'])); ?>
	</span>
</td>
</tr>
<tr>
<td>
	<span ><b>Venue :</b>
</span>
</td>
<td><span> <?php echo $row['event_address']; ?> </span>,<br />
	<span ><?php echo $row['event_city']; ?></span>
	<span>, <?php echo $row['event_state'];?></span>
	<span>, <?php echo $row['event_country']; ?></span>

</td>
</tr>

<tr><td>
	<span>
	<b>Organized By :</b>
	</span>
	</td>
	<td><span> <?php echo $row['partner_name']; ?>
	</span>
</td>
</tr>
<tr>
<td>
	
	<?php if($row['event_contact_name']!=NULL){ ?>
<span>

	<b> Contact Person :</b><span>
	</td>
	<td><span><?php echo $row['event_contact_name']; ?> 
	 
</span>
<?php } ?>
</td>
</tr>

<tr>
<td>

<?php if($row['event_contact_number']!=NULL) { ?>
<span>
	 <b>Phone :</b> </span>
	 </td>
	 <td><span><?php echo $row['event_contact_number']; ?> 
</span>
<?php } ?>
</td></tr>
<tr>
<td>	
	<span>
		<b> Email :</b></span></td>
		<td><span><?php echo $row['event_contact_email']; ?>
	</span>
</td></tr>
</table>
</div>
<?php
}
?>
<div id="participant_list" style="width:540px;float:left;">
<?php $query="SELECT project_partners.partner_id,name,vcount,icount FROM event_participants 
JOIN project_partners ON event_participants.partner_id = project_partners.partner_id
LEFT JOIN 
(SELECT COUNT(DISTINCT volunteering_activity.activity_id)vcount,partner_id 
FROM volunteering_activity 
JOIN volunteering_opportunities ON 
volunteering_activity.activity_id=volunteering_opportunities.activity_id
WHERE approval_status='A' AND to_date>CURDATE() GROUP BY partner_id)
vc ON vc.partner_id =  project_partners.partner_id

LEFT JOIN 
(SELECT COUNT(donation_id)icount,partner_id FROM kind_donations 
WHERE initiative_type=0 AND status='Open' AND request_expiry_date>CURDATE()
GROUP BY partner_id)kd
ON event_participants.partner_id=kd.partner_id

 WHERE event_id=$id ORDER BY name ASC";
	$result=mysql_query($query);
	$countquery="SELECT FOUND_ROWS() count";
	$count=mysql_query($countquery);
	$count=mysql_fetch_array($count);
	$i=1;
	echo "
<h1>Participating NPOs ($count[count])</h1>
<table id='table-search' style='border-collapse:collapse;'>
	<thead><th>S.no</th><th>NPO <font style='font-weight:normal;color:green'>(Volunteering Requests)</font>  <font style='font-weight:normal;color:brown'>(In-kind Requests)</font></th></thead>";
	while($row=mysql_fetch_array($result)){
		echo "<tr>
		<td>$i</td>
		<td>
		<a href='/npo/$row[partner_id]'>
		<b>$row[name]</b> </a>";
		if($row['vcount']!=NULL){
		echo "
		<font  style='font-size:12px;color:green;' title='Volunteering Requests'>
		 ( <a  style='font-size:12px;color:green;' href='/npo_activities.php?npo=$row[partner_id]'>$row[vcount]</a> ) 
		</font>";
		}
		if($row['icount']!=NULL){
		echo "
		<font  style='font-size:12px;color:brown;' title='In-Kind Requests'>
		 (<a  style='font-size:12px;color:brown' href='/npo_inkind.php?npo=$row[partner_id]'>$row[icount]</a>)
		</font>";
		}
		echo "
		</td></tr>";
		$i++;
	}
	echo "</table>"
?>
</div>	
 <?php
 $inkind_query = "SELECT COUNT( * ) count, CONCAT( SUM( IF( initiative_type =1
		, request_quantity, offer_quantity ) ) , ' ', units_type ) quantity, category
		, donationitem
		FROM event_link
		JOIN kind_donations on event_link.donation_id = kind_donations.donation_id
		JOIN items ON kind_donations.item_id = items.item_id
		JOIN item_category ON items.category_id = item_category.category_id
		WHERE STATUS = 'Delivered' AND donation_type='In-Kind'
		GROUP BY items.category_id,items.item_id ORDER BY item_category.category_id DESC";
		$result=mysql_query($inkind_query);
		$inkind_data="";
		if(mysql_num_rows($result)>0) {
			while($row=mysql_fetch_array($result)){
				$inkind_data .= "<div style='display:inline-block;margin:10px;
				line-height:20px;'><img width='50px' height='50px' 
				src='/images/$row[category].png' alt='$row[category]' />
				<br />
			<span style='font-weight:bold'>$row[donationitem]</span><br />
			<span style='font-size:11px;'><b>$row[quantity]</b></span></div>";
			}
		}
if($inkind_data!=""){
?>
<div id="inkind_summary" style="float:left;width:400px;border:1px solid #eee;border-radius:0.2em;margin-bottom:15px;height:auto;">
<h3>In-Kind donations received:</h3>
<?php
		echo $inkind_data;
?>
</div>
<?php } ?>
<div id="map_canvas" style="width: 400px; height: 250px;padding-left:20px;margin:10px;"></div>
<h3>Event Location</h3>
 </div>

 <?php include 'footer.php' ; ?>

</div>
<!--#footer-->
 </BODY>
</HTML>
