<link rel="stylesheet" href="css/slideshow.css">

	<script>
		$(function(){
			// Set starting slide to 1
			var startSlide = 1;
			// Get slide number if it exists
			if (window.location.hash) {
				startSlide = window.location.hash.replace('#','');
			}
			// Initialize Slides
			$('#slides').slides({
				generatePagination: true,
				play: 10000,
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
			<div id="slides">
				<div class="slides_container">
					<?php
					include_once("prod_conn.php");
					mysql_connect("$dbhost","$dbuser","$dbpass");
					mysql_select_db("$dbdatabase");
					
					$query = "SELECT DONOR_IMG,  DISPLAYNAME, VILLAGE_TOWN, STATE, FEATURE_QUOTE
					FROM donors WHERE feature_permission='Y' OR feature_permission='y' ORDER BY RAND() LIMIT 0,6";

					$result = mysql_query($query);
					//$num_rows = mysql_num_rows($result);
					while ($row = mysql_fetch_assoc($result)) {
							$img = $row['DONOR_IMG'];
							if ($img == ""){
								$img = "css/default_avatar.jpg";
							}
							$name = $row['DISPLAYNAME'];
							$villagetown = $row['VILLAGE_TOWN'];
							$state = $row['STATE'];
							$location = $villagetown.", ".$state;
							$quote = $row['FEATURE_QUOTE'];
					?>
						<div class="slide">
	<h4 style='border-style:hidden; margin-top:-20px; margin-bottom:0px;'>Featured Donor/Volunteer</h4>
	
		<table width="400px" height="175px"><tr><td rowspan="2"><img height="100px" width="100px" src="<?php echo $img; ?>" alt="Image"/></td></tr>
		<tr><td colspan="3"><q><?php echo $quote; ?></q></td></tr>
		<tr><td colspan="3"><b>Name: </b><?php echo $name; ?></td></tr>
		<tr><td colspan="3"><b>Location: </b><?php echo $location; ?></td></tr></table></tr>
					</div>
<?php
					}?>
					
				</div>
				<a href="#" class="prev"><img src="images/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="images/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
		

