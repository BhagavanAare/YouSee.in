<?php 	
		session_start();
		$thispage = "more";	
		$thisdiv="npo_summary";
		require_once "prod_conn.php";
		$id=mysql_real_escape_string(trim($_GET['npo']));
		$name=mysql_real_escape_string(trim($_GET['name']));
		$_SESSION['donate_postpay']="npo";
		$_SESSION['npo']=$id;
		$querystringcheck = "SELECT LOWER(name) name FROM project_partners WHERE 
		partner_id = $id";
		
		$result=mysql_query($querystringcheck);
		while($row=mysql_fetch_array($result)){
			$event=str_replace(" ","-",$row['name']);
			if($name!=$event){
				header("Location:/npo/$id/$event");
				exit();
			}
		} 
		
		//Get data for postpay chart
		require_once 'Highchart.php';
		$chart = new Highchart(Highchart::HIGHSTOCK);
		
		
		$postpay_query="SELECT UNIX_TIMESTAMP( payment_date ) *1000 AS dateUTC,
		 SUM( instrument_amount ) instrument_amount
		FROM payments
		LEFT JOIN postpay_certificates 
		ON payments.payment_id=postpay_certificates.payment_id
		JOIN project_certificates 
		ON postpay_certificates.certificate_id=project_certificates.certificate_id
		WHERE partner_id=$id 
		GROUP BY  MONTH( payment_date ),YEAR(payment_date)
		ORDER BY dateUTC ASC";
		$result=mysql_query($postpay_query);
		$data="[";
		while($row=mysql_fetch_array($result)){
			$data.="[$row[dateUTC],$row[instrument_amount]],";
		}
		$data=substr($data,0,-1);
		$data.="]";
		
		// Get data for in kind summary
		
		$inkind_query = "SELECT COUNT( * ) count, CONCAT( SUM( IF( initiative_type =1
		, request_quantity, offer_quantity ) ) , ' ', units_type ) quantity, category
		, donationitem
		FROM kind_donations
		JOIN items ON kind_donations.item_id = items.item_id
		JOIN item_category ON items.category_id = item_category.category_id
		WHERE STATUS = 'Delivered' AND partner_id=$id
		GROUP BY items.item_id ORDER BY quantity DESC LIMIT 0,6";
		$result=mysql_query($inkind_query);
		$inkind_data="";
		if(mysql_num_rows($result)>0) {
			while($row=mysql_fetch_array($result)){
				$inkind_data .= "<div style='display:inline-block;margin:10px;
				line-height:20px;'><img width='50px' height='50px' 
				src='/images/$row[category].png' alt='$row[category]' />
				<br />
			<span>$row[donationitem]</span><br />
			<span style='font-size:11px;'>$row[quantity]</span></div>";
			}
		}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel 
  Philanthropic Resources to Education, Health and Environmental services sectors,
   in order to improve access to these services especially for the poor. These 
   sectors need a much larger infusion of capital of various kinds including 
   Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/div.css">
  <script src="/scripts/jquery.min.js"></script>
 
<script type="text/javascript" src="/scripts/donate_postpay.js"></script>
<script type="text/javascript" src="/scripts/custom_jquery.js"></script>
  <script src="/scripts/jquery.blockUI.js"></script>

    <?php
        foreach ($chart->getScripts() as $script) {
            echo '<script type="text/javascript" src="/' . $script . '"></script>';
        }
    ?>

  	<script type="text/javascript">
    $(function() {
		// Block UI on ajax start
		$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
		// Create the Postpay chart
		$('#container').highcharts('StockChart', {
		    chart: {
		    },
			title : {	text : 'Postpay Donations' },
			yAxis: {
			type: 'datetime',
	        tickInterval: 12
			},
			navigator: {
	    	enabled: false
	    	},
			scrollbar: {    
	    	enabled: false
	    	},
			 credits: {
				enabled: false
			},
		    rangeSelector: {
				enabled : false,
				inputDateFormat:"%b,%Y",
				inputEditDateFormat:"%Y-%m",
		        selected: 4
		    },
	   		xAxis: {
        	type: 'datetime',
        	dateTimeLabelFormats: {
				second: '%Y-%m-%d<br/>%H:%M:%S',
				minute: '%Y-%m-%d<br/>%H:%M',
				hour: '%d %b<br />%Y',
				day: '%d %b<br />%Y',
				week: '%d %b<br />%Y',
				month: '%b,%Y',
				year: '%Y'
			},
			tickInterval: 1 * 365 * 24 * 3600 * 1000 ,
			ordinal:false
    		},
			yAxis: {
			minPadding: 0, 
			maxPadding: 0,         
			min: 0, 
			showLastLabel:false
			},
			series: [{
		        name: 'Donation Amount',
		        data: <?php echo $data; ?>,
		        type: 'line',
		        tooltip: {
		        	valueDecimals: 0
		        },
				 dataGrouping: {
                    dateTimeLabelFormats: {
                        day: ['%b,%y'],
                        week: ['%b,%y'],
                        Month: ['%B,%y'],
						year: ['%b, %Y']
                    }
				}
		    }],
		});
	});
	</script>
  </HEAD>
 <BODY>

<!--wrapper-->

<div id="wrapper">

<!--header and navbar -->

<?php include 'header_navbar.php';?>

<!--maincontentarea-->

<div id="uccertificate-main">


<?php 
// Get the NPO details with the partner id
$partnerquery = "SELECT * FROM project_partners WHERE partner_id=$id";
$result=mysql_query($partnerquery);
?>

<?php 
if(mysql_num_rows($result)==1){
	
while($row=mysql_fetch_array($result)){ ?>

<!-- Left Nav -->
<div style="float:left;width:150px;padding:10px;margin:10px">
	<span style="font-size:13px;font-weight:bold;"> 
		<a href="getnpo.php?npo=<?php echo $id; ?>"><?php echo $row['name'];?></a> 
		</span><br />
	<span><a href="/npo_activities.php?npo=<?php echo $id; ?>">Volunteering</a>
	</span><br />
	<span><a href="/npo_inkind.php?npo=<?php echo $id; ?>">In Kind</a></span><br />
	<span><a href="/npo_postpay.php?npo=<?php echo $id; ?>">Financial</a></span>
</div>
<!-- Left Nav End -->

<!-- Right div -->
<div id="npoprofile" class="npoprofile"
 style="float:right;width:750px;border-left:1px solid #ccc;padding:10px;margin:10px;
 line-height:30px;">

<title>
	<?php echo $row['name']; ?> | YouSee
</title>
<table width="750px" style="border:1px solid #ccc;border-radius:0.2em;padding:10px;
margin-bottom:10px;line-height:20px;
">
<tr><td>
<span style="font-size:20px;color:#369;font-weight:bold;">
 	<?php echo $row['name']; ?>
</span>
</td>
</tr>
<tr><td>
<span style="font-size:12px;">
	<span >
		<?php if($row['hq_town_city']!='') echo $row['hq_town_city'].", "; ?>
	</span>
	<span><?php if($row['hq_state']!='') echo $row['hq_state'].", "; ?></span>
	<span><?php echo $row['hq_country']; ?></span>
</span>
</td>
<td>
	
	<?php if($row['contact_first_name']!=NULL || $row['contact_last_name']!=NULL){ ?>
<span>

	 Contact Person : 
	 <?php echo $row['contact_first_name']." ".$row['contact_last_name'];
	  if($row['contact_person_designation']!=NULL) 
	  { echo ", ".$row['contact_person_designation']; }?> 
	 
</span>
<?php } ?>
</td>
</tr>
<tr><td>
	<span>
	Organization Type : <?php echo $row['type']; ?>
	</span>
</td>
<td>

<span>
	 Phone : 
	 
<?php if($row['office_phone']!=NULL) { ?>
<?php echo $row['office_phone']; ?> 
<?php } ?>
</span>
</td>
</tr>
<tr><td>
	<span>
	Website : <a href="<?php echo $row['website_url']; ?>" target="_blank"> 
	<?php echo $row['website_url']; ?> </a>
	</span>
</td>
<td>	
	<span>
		 Email : <?php echo $row['partner_email']; ?>
	</span>
</td>
</tr>
</table>

<div id="recent_activity" style="width:770px;height:auto;overflow:auto;">
	
	


	
	<h1 style='border:1px solid #ccc;background:#eee;padding:5px;font-size:14px;
	border-radius:0.2em;' align="center">Recent Requests posted</h1>


	<?php
	
	
	$activity_query = "SELECT * FROM project_partners p
				JOIN volunteering_activity v ON p.partner_id=v.partner_id 
				JOIN volunteering_opportunities o ON v.activity_id=o.activity_id
				WHERE o.approval_status='A' AND o.to_date>CURDATE()
				 AND v.partner_id=$id GROUP BY o.activity_id  ORDER BY o.to_date DESC
				 LIMIT 0,1";
	$result=mysql_query($activity_query);
	$resultCount=mysql_num_rows($result);
	?>
	<?php
if ($resultCount>0)
{	?>
<h1 style='border:1px solid #ccc;background:#eee;border-radius:0.2em;padding:3px;'>
	Recent Volunteering Activities</h1>
<table class="table-div2" style="width:770px;margin:0px;">
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
		  src="images/<?php echo $row['vertical'];?>.png" width="50px" 
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
<?php $count++;
	
		}

	?>

	
</table>
<?php
	echo "<br /><b><a href='/npo_activities.php?npo=$id'>
	See all Volunteering requests by this NPO</a></b>
	<hr>";		
 } 
else echo "<h3>No Volunteering requests posted.</h3>"; ?>

</div>

	
<div id="existing_content" ">	
	<?php
	$request_query="SELECT * FROM kind_donations 
				JOIN items on kind_donations.item_id=items.item_id
				JOIN item_category on items.category_id=item_category.category_id 
				JOIN project_partners
				 on kind_donations.partner_id=project_partners.partner_id
				WHERE initiative_type=0 AND request_quantity>offer_quantity 
				AND offer_quantity=0 AND status='Open' 
				AND project_partners.partner_id = $id 
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
	See all In Kind requests by this NPO</a></b>
	<hr>";	
?>

<?php 
	}
	else {
		echo "<h3> No In-Kind requests. </h3>
		<hr>";
	}
?>


<div style="width:750px;float:left;postition:relative;line-height:15px;">
	<div id="data" style="width: 770px; 
	height: auto;  border: 0;margin:24px 0px;padding:0px;
	">
	
<h1 style='border:1px solid #ccc;background:#eee;border-radius:0.2em;padding:3px;'>
	Awaiting Postpay Donations</h1>
	</div><hr>
</div>	
</div>











<div id="data1" 
style="display: inline-block; width: 770px; height: auto; float:left;">
	
	<h1 style='border:1px solid #ccc;background:#eee;border-radius:0.2em;
	font-size:14px;padding:5px;' align="center">
	Summary - Donations recieved
	</h1>
	<div id="inkind_summary" style="max-height:250px" >
	<?php if($inkind_data!=''){
	?>
	<h1 style='border:1px solid #ccc;background:#eee;border-radius:0.2em;'>
		In Kind Donations
	</h1>
		<?php echo $inkind_data; 
	}
	?>
	</div>
	<h1 style='border:1px solid #ccc;background:#eee;border-radius:0.2em;'>
		Postpay Donations
	
	</h1>
	<div id="container" style="display:block;">
	</div>
</div>
<?php
}
}
else{
	echo "<h1>Page not found</h1>";
}
?>
</div>
<!-- Right div ends -->

 </div>
 <?php include 'footer.php' ; ?>

</div>
<!--#footer-->
 </BODY>
</HTML>
