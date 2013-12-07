
	<script>
		$(function(){
			// Set starting slide to 1
			var startSlide = 1;
			// Get slide number if it exists
			if (window.location.hash) {
				startSlide = window.location.hash.replace('#','');
			}
			// Initialize Slides
			$('#slides_p').slides({
				generatePagination: true,
				prependPagination:true,
				play: 11000,
				pause: 5000,
				hoverPause: true,
				autoHeight:true,
				// Get the starting slide
				start: startSlide,
				animationComplete: function(current){
					// Set the slide number as a hash
					window.location.hash = '#' + current;
				}
			});
		});
	</script>
			<div id="slides_p">
				<div class="slides_container">
				<?php
$link = mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$query = "SELECT
 PROJECT_PHOTO_LINK                    IMG
,WEBSITE_URL  PROJECT_LINK
,CONCAT(CONCAT(TOWN_CITY,' ,'),STATE)                      LOCATION
,CONCAT(CONCAT(AREA,' ,'),TAGS)                      AREATAGS
,DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') COMPLETIONDATE
,DATE_FORMAT(START_DATE,'%d-%b-%Y') STARTDATE
,NAME   PARTNER
,TITLE
,DESCRIPTION
,DOCUMENT_LINK
,VALUE
,certificate_id,partner_id

FROM project_certificates
LEFT OUTER JOIN project_partners USING (PARTNER_ID)
where VALUE > (SELECT SUM(PP.AMOUNT_FOR_PROJECT)  FROM postpay_certificates PP WHERE PP.CERTIFICATE_ID=project_certificates.CERTIFICATE_ID) ORDER BY RAND() LIMIT 0,6";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
		$img = $row['IMG'];
		$location = $row['LOCATION'];
		$areatags = $row['AREATAGS'];
		$procompdate = $row['COMPLETIONDATE'];
		$prostartdate = $row['STARTDATE'];
		$partner = $row['PARTNER'];
		$title = $row['TITLE'];
		$desc = $row['DESCRIPTION'];
		$doclink = $row['DOCUMENT_LINK'];
		$value = $row['VALUE'];
		$weblink=$row['PROJECT_LINK'];
		$randomvalue=$row['certificate_id'];
		$partner_id = $row['partner_id'];
?>

<?php
$chartquery = "SELECT CERTIFICATE_ID,DESCRIPTION
,MAX(VALUE) TOTAL_COST
,SUM(AMOUNT_FOR_PROJECT) POST_PAID
,MAX(VALUE)-SUM(AMOUNT_FOR_PROJECT) AVAILABLE
,round(((SUM(AMOUNT_FOR_PROJECT)/MAX(VALUE))*100),1) POST_PAID_PCT
,round(100-((SUM(AMOUNT_FOR_PROJECT)/MAX(VALUE))*100),1) AVAILABLE_PCT
from project_certificates
LEFT OUTER JOIN postpay_certificates USING (CERTIFICATE_ID) WHERE certificate_id='$randomvalue' GROUP BY CERTIFICATE_ID,DESCRIPTION";
$chartresult = mysql_query($chartquery);
while ($row = mysql_fetch_assoc($chartresult)) {
		$certid = $row['CERTIFICATE_ID'];
		$proj_desc = $row['DESCRIPTION'];
		$total_cost = $row['TOTAL_COST'];
		$postpaid = $row['POST_PAID'];
		$available = $row['AVAILABLE'];
		$postpaid_pct = $row['POST_PAID_PCT'];
		$available_pct = $row['AVAILABLE_PCT'];
}
$ppostpaid = number_format($postpaid, 0, '.', ',');
$pavailable = number_format($available, 0, '.', ',');
$ptotal_cost = number_format($total_cost, 0, '.', ',');
?>
<div class="slide">
<!-- display project info in table -->
<table style='width:400px; font-family:arial;'>
	<tr>
		<td colspan="2" align="left"><h4 style='margin-left:50px;border-style:hidden; margin-top:-20px; margin-bottom:0px;'>Featured Project</h4></td>
	</tr>
	<tr>
		<td rowspan="4"><img height="100px" width="100px" src="<?php echo $img; ?>"/></td>
		<td><b>Project Title: </b><?php echo $title; ?></td>
	</tr>
	<tr>
		<td><b>Project Partner: </b><a class="linka" href="/npo/<?php echo $partner_id; ?>"><?php echo $partner; ?></a></td>
	</tr>
	<tr>
		<td><b>Project Location: </b><?php echo $location; ?></td>	
	</tr>
	<tr>
		<td valign="middle"><a class="linka" href="<?php echo $doclink; ?>" target="_blank"><img width="12px" height="15px"src="images/doctype_pdf.gif" /><b>See more here </b></a></td>	
	</tr>
</table>


<table style='width:400px; font-family:arial; '>
	<tr>
		<td><b>PostPay Funding Status (in INR)</b></td>
		<td style="color:green"><b>PostPaid</b></td>
		<td style="color:red"align="right"><b>Available</b></td>
	</tr>
	<tr>
		<td><b>Total Funded : </b><?php echo $ptotal_cost; ?></td>
		<td style="color:green"><?php echo $ppostpaid; ?></td>
		<td style="color:red" align="right"><?php echo $pavailable; ?></td>
	</tr>
	<tr>
		<td><b>Funding Period: </b><?php echo $prostartdate; ?> to <?php echo $procompdate; ?></td>
		<td colspan="2">
			<!--graph section of the table-->
			<table id="graph_table"><tr>
			<td id="left_td" width="<?php echo $postpaid_pct; ?>%"></td>
			<td id="right_td" width="<?php echo $available_pct; ?>%"></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td></td>	
		<td style="color:green"><?php echo $postpaid_pct; ?>%</td>
		<td style="color:red" align="right"><?php echo $available_pct; ?>%</td>
		
	</tr>	
</table>
</div>
<?php } //mysql_close($link); ?>
</div>
				<a href="#" class="prev"><img src="images/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="images/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
</div>