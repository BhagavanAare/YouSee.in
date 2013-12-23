<?php 	
		session_start();
		$thispage = "more";
		date_default_timezone_set("Asia/Calcutta");
		// Include db configuration file
		require_once "prod_conn.php";
		$id=mysql_real_escape_string(trim($_GET['placeid']));
		$name=mysql_real_escape_string(trim($_GET['place']));
		$querystringcheck = "SELECT LOWER(place_title) place_desc FROM places WHERE place_id = $id";
		$result=mysql_query($querystringcheck);
		while($row=mysql_fetch_array($result)){
			$place=str_replace(" ","-",$row['place_desc']);
			if($name!=$place){
				header("Location:places/$id/$place");
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
  <script src="/scripts/custom_jquery.js"></script>

  <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?&sensor=true&region=IN">
  </script>
	<script type="text/javascript">
//['Hyderabad',17.86,80.64,5,'getnpo.php?npo=1'],['Some city',19.86,80.64,5,'getnpo.php?npo=1']
	var points = [
				<?php 
				$query="SELECT  place_id,place_category,place_title,location,city,latitude, longitude FROM places
				JOIN place_category ON places.place_category_id = place_category.place_category_id
				 WHERE place_id=$id";
				$result=mysql_query($query);
				$num=mysql_num_rows($result);
				$i=1;
				while($row=mysql_fetch_array($result)){
				echo "['$row[place_title], $row[location]',$row[latitude],$row[longitude],1,'getplaces.php?placeid=$row[place_id]']";
				$latitude = $row['latitude'];
				$longitude = $row['longitude'];
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
$event_query="SELECT places.*,name partner_name from places LEFT JOIN project_partners ON places.partner_id=project_partners.partner_id WHERE place_id = $id";
$result=mysql_query($event_query);
while($row=mysql_fetch_array($result)){
?>
<title><?php echo $row['place_title']; ?> | YouSee</title>
<div class="events" style="width:960px;">
<table class="events" width="960px" style="border-spacing:10px;border:1px solid #ccc;padding:10px;margin-bottom:10px;border-radius:0.2em;">
<tr><td>
<span style="font-size:20px;color:#369;font-weight:bold;">
 	<a href="/getplaces.php?placeid=<?php echo $row['place_id']; ?>"> <?php echo $row['place_title']; ?> </a>
</span>
</td>
</tr> 
<tr>
<td style="width:500px;border-right:1px solid #ccc;padding-right:20px;">
	<p>
		<?php echo $row['place_description']; ?>
	</p>
</td>
<td rowspan="10">
	<div id="map_canvas" style="float:right;width:400px;height:300px;"></div>
</td>
</tr>
<tr>
	<td>
<span ><b>Address :</b> <?php echo $row['address']; ?> </span>,
	<span ><?php echo $row['location']; ?></span>
	<span>, <?php echo $row['city'];?></span>

</td>
</tr>

<tr><td>
	<span>
	<b>Organized By :</b>
	</span>
	<span> <a href="/npo/<?php echo $row['partner_id'];?>"><?php echo $row['partner_name']; ?></a>
	</span>
</td>
</tr>
<tr>
<td>
	
	<?php if($row['contact_person']!=NULL){ ?>
<span>

	<b> Contact Person :</b><span>
	<span><?php echo $row['contact_person']; ?> 
	 
</span>
<?php } ?>
</td>
</tr>

<tr>
<td>

<?php if($row['contact_no']!=NULL) { ?>
<span>
	 <b>Phone :</b> </span>
	<span><?php echo $row['contact_no']; ?> 
</span>
<?php } ?>
</td></tr>
<tr>
<td>	
	<span>
		<b> Email :</b></span>
		<span><?php echo $row['contact_email']; ?>
	</span>
</td></tr>	
<tr>
<td></td>

</tr>

</table>
</div>
<?php
}
?>

<div width="670px">
<?php	
	$activity_query = "SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' AND o.to_date>CURDATE()
				 AND o.place_id=$id GROUP BY o.activity_id  ORDER BY o.to_date DESC";
	$result=mysql_query($activity_query);
	$resultCount=mysql_num_rows($result);
	?>
	<?php
if ($resultCount>0)
{	?>
<table class="table-div2" style="width:670px;margin:0px;">
	<h3>Volunteering Opportunities at this place.</h3>
	<?php
		while($row = mysql_fetch_array($result))
		{
		if(isset($_SESSION['SESS_USER_ID']) AND $_SESSION['SESS_USER_TYPE']=='D'){
		$donor_id=mysql_fetch_array(mysql_query("SELECT donor_id from donors 
		where user_id=".$_SESSION['SESS_USER_ID'].""));
		$committedquery="SELECT distinct vo.activity_id from volunteer_commits vc 
		INNER JOIN volunteering_opportunities vo 
		ON vc.opportunity_id=vo.opportunity_id
		 WHERE vc.donor_id=".$donor_id['donor_id'];
$commitresult=mysql_query($committedquery);
}
		$opp_query="SELECT * FROM volunteering_opportunities 
		WHERE approval_status='A' AND to_date>'".date("Y-m-d")."' 
		AND activity_id=".$row['activity_id']; 
	$oppresult=mysql_query($opp_query);
	?>
	<tr class="rows postedComment <?php echo $row['vertical'];?> 
	<?php echo $row['domain'];?> 
	<?php if(isset($_SESSION['SESS_USER_ID']) 
	AND $_SESSION['SESS_USER_TYPE']=='D')
	 while($commit=mysql_fetch_array($commitresult))
	 { 
		 if($commit['activity_id']==$row['activity_id'])
		 { echo 'committed'; break;}
	} ?>" id="<?php echo $row['activity_id']; ?>" >
	<td id="td<?php echo $row['activity_id'];?>" class="outer" style="width:80%;"> 
	<div class="activitydiv" >
	<p style="padding:0px;">
	<b style="float:left;position:relative;padding:0px;margin:0px;width:90%;
	font-size:14px;color:#369;font-family:Trebuchet MS">
	<?php echo $row['activity']; ?>
	</b>
	<span style="margin-top:-14px;float:right;margin-right:2px;margin-left:
	20px;font-family:Trebuchet MS;font-size:11px;">
	<?php echo $row['embed_video']; ?> 
	</span>
	<p style="padding:0px;margin-right:8px;width:90%;font-size:11px;
	color:#666;font-family:Trebuchet MS">
	<b>Details:</b>&nbsp<?php echo $row['activity_details']; ?> 
	</p>
	<?php if($row['vertical']!=''||$row['vertical']!=NULL){
		 ?>
		 <img style="float:left;margin-right:10px;"
		  src="/images/<?php echo $row['vertical'];?>.png" width="50px" 
		  alt="General" />
	<?php } ?>
	<span style="font-family:Trebuchet MS;font-size:11px;">
		<b style="color:#0C7878;">
			<?php if($row['vertical']!=''||$row['vertical']!=NULL)
			 echo $row['vertical']; else echo "General" ?> |
		</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;">
		<b style="color:#801506;"><?php echo $row['domain']; ?> |</b></span>
	<span style="font-family:Trebuchet MS;font-size:11px;">
		<b><?php echo $row['onsite_offsite']; ?></b></span>
<br />
	<span style="float:left;font-family:Trebuchet MS;font-size:11px;">
		Partner:
		&nbsp<a style="font-size:11px;" href="/npo/<?php echo $row['partner_id'];?>">
		<?php echo $row['name']; ?></a></span><br />
	<input style="float:right;margin-right:8px;margin-top:-11px;" 
	type="button" value="View and Commit">
	<span style="float:left;width:60%;font-family:Trebuchet MS;font-size:11px;">
		<b>Skills Required:</b>&nbsp<?php echo $row['skills']; ?></span>

	</p>
	</div>
	</td>
	</tr>
	<tr>
	<td id="details<?php echo $row['activity_id']; ?>" class="inner" hidden>
	<b style="font-size:12px;color:#369;">Activity Schedule</b>
	<table class="table-innerdiv2">
	<th>From date</th><th>To Date</th><th>From time</th><th>To time</th>
	<th>Location</th><th>City</th><th>Vol Req.</th>
	<th><span class="link"><a href="javascript: void(0)">
		<font face=verdana,arial,helvetica size=2>[?]</font>
		<span>Default setting assumes you are committing to all the days of the 
		activity. Deselect any particular date which may not be possible for you.
		</span>
		</a>
		</span>
	</th></tr>
	<?php while($record=mysql_fetch_array($oppresult)){ ?>
	<tr>
	<td><?php echo "".gmdate("d-M-y",strtotime($record['from_date']));?></td>
	<td><?php echo "".gmdate("d-M-y",strtotime($record['to_date']));?></td>
	<?php if($record['from_time']==0){ echo "<td></td>";}
	else {?>	
	<td><?php echo "".date("g:iA",strtotime($record['from_time']));}?></td>
	<?php
	if($record['to_time']==0){ echo "<td></td>";}
	else {?>	
	<td><?php echo "".date("g:iA",strtotime($record['to_time']));}?></td>
	<td><?php echo "".$record['location'];?></td>
	<td><?php echo "".$record['city'];?></td>
	<td><?php echo "".$record['num_volunteers'];?></td>

	<td>		<form id="form<?php echo $row['activity_id']; ?>" 
	name="activityCommitForm" method="post" action="activity_commit.php">
<?php	if(isset($_SESSION['SESS_USER_ID']) AND ($_SESSION['SESS_USER_TYPE']=='D')){
$opquery="SELECT opportunity_id from volunteer_commits 
WHERE donor_id=".$donor_id['donor_id']." 
AND opportunity_id=".$record['opportunity_id'];
$opresult=mysql_query($opquery);
$opcount=mysql_num_rows($opresult);
if($opcount>=1){
$oppid=mysql_fetch_array($opresult);
if($oppid['opportunity_id']==$record['opportunity_id']){ echo "Committed!";}  
}
else{ ?>
<input type="checkbox" form="form<?php echo $row['activity_id']; ?>" 
value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked /></td>
<?php 
}
}
else{ ?>
<input type="checkbox" form="form<?php echo $row['activity_id']; ?>" 
value="<?php echo $record['opportunity_id']; ?>" name="opp_id[]" checked /></td>
<?php } ?>
</td>
	</tr>		
<?php } ?>
		</table>
		<input name="activity_id" form="form<?php echo $row['activity_id']; ?>" 
		type="text" hidden value="<?php echo $row['activity_id']; ?>"></input>
				<div style="float:right;position:relative;">
				<input  name="activityCommit" type="submit" 
				form="form<?php echo $row['activity_id'];?>" 
				<?php if(isset($_GET['id'])){ ?> target="_blank" <?php } ?>
				value="Commit">
		</div>
			</form>

	</td>
	</tr>
	<script type="text/javascript">
		$(function(){
		act_details(<?php echo $row['activity_id']; ?>);
		});
	</script>
<?php
		}

	?>

	
</table>
<?php	
 } 
else echo "<h3>No Volunteering requests posted.</h3>"; ?>

</div>

	
<div id="existing_content" ">	
	<?php
	$request_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN places
				 on kind_donations.place_id=places.place_id
				WHERE initiative_type=0 AND request_quantity>offer_quantity 
				AND offer_quantity=0 AND status='Open' 
				AND places.places_id = $id 
				AND request_expiry_date>'".date("Y-m-d")."'".$where." LIMIT 0,1";
	$request_ex=mysql_query($request_query);
	if(mysql_num_rows($request_ex)>0){
		echo "
	<h1 style='border:1px solid #ccc;background:#eee;
	border-radius:0.2em;padding:3px;'>Recent In kind requests</h1>";
		?>
<?php 
echo "<table class='table-item' 
		style='width:750px;margin:0px;padding:0px;
		border-radius:1em;border:1px solid transparent'>
		<tr style=''>
			<th style='background:#fff;width:10px;
			font-size:12px;padding:0px;margin:0px'>Category</th>
			<th>Item name</th>
			<th>Quantity</th>
			<th>Requested By</th>
			<th>Transport by</th>
			<th>I Commit..</th>
			<th></th>
		</tr>
	</table>";
$i=0;
while($row=mysql_fetch_array($request_ex)){	
?>
	<div class="postedComment" id="<?php echo $row['donation_id']; ?>" >
		<div class="itemdiv <?php echo $row['category']; ?>" 
		id="item<?php echo $row['donation_id']; ?>"  style="margin:0px;">
			<table class="table-item">
				<tr>
					<td  style="font-size:13px;font-weight:bold;" 
					id="item<?php echo $row['donation_id'];?>">
						<span class="link">
							<a><?php echo $row['donationitem']; ?>
							<span id="note<?php echo $row['donation_id'];?>">
								<p style="margin:5px;padding:5px;">
									<?php echo $row['note'];?>
								</p>
							</span>
							</a>
						</span> 
					</td>
					<td>
						<?php echo $row['request_quantity']." ".$row['units_type'];?>
					</td>
					<td>
						<span class="link">
							<a href="/npo/<?php echo $row['partner_id']; ?>">
							<?php echo $row['name']; ?>
							<span id="reqadd<?php echo $row['donation_id'];?>">
							<p style="margin:5px;padding:5px;">
							<?php 
							echo $row['request_address'].",".$row['request_city'];?>
							</p>
							</span>
						</a>
					</td>
					<td><?php if($row['transport']==1)
					 echo "<img src='images/npo.png' alt='Pick-Up' />"; 
					 else echo "<img src='images/donor.png' alt='Deliver' />" ?>
					</td>
					<form action="/inkind_commit.php" method="POST">
					<td style="text-align:left;">
						<input type="text" name ="offer_quantity" 
						value="<?php echo $row['request_quantity'];?>" 
						id="offer_quantity<?php echo $row['donation_id'];?>" 
						size="2" name="commit_quantity"/>
						<?php echo $row['units_type'];?>
						<input type="text" name="id" value="<?php echo $row['donation_id']; ?>"
						hidden />
					</td>
					<td style="width:5%;"><input type="submit" 
					value="Commit" class="commit_request" 
					id="<?php echo $row['donation_id']; ?>" />
					</form></td>
				</tr>
			</table>
		</div>
	</div>
<?php
	}
?>
	
</div>
	
<div>	
	<?php
	echo "<br /><b><a href='/npo_inkind.php?npo=$id'>
	See all In Kind requests by this Service Place</a></b>
	<hr>";	
?>

<?php 
	}
	else {
		echo "<h3> No In-Kind requests. </h3>
		<hr>";
	}
?>



</div>
 <?php include 'footer.php' ; ?>

</div>
<!--#footer-->
 </BODY>
</HTML>
