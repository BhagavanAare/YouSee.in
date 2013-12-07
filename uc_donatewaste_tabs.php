
<ul  class="tree" style="width:150px;">  
	<ul style="margin-left:-44px; list-style-type:none">
	        <li> <a href="donate_waste.php" class="file" id="summaryReqTab">Donate Waste</a> </li>
	        <li> <a href="donate_waste_instructions.php" class="file" id="howtoReqTab">How To?</a> </li>
		
	<li class="tree">
		<label for="folder3" class="menu_first" style="color:#666">Donation places</label> 
		<input type="checkbox" checked id="folder2" />
		<ul>
		<?php
		include_once "prod_conn.php";
		$navquery="SELECT city from places JOIN place_category ON 
		places.place_category_id = place_category.place_category_id 
		WHERE place_category='Compost Center' OR place_category = 'Donation Camp' GROUP BY city";
		$result=mysql_query($navquery);
		while($row=mysql_fetch_array($result)){ ?>
			<li ><a  class="file" href="donate_waste_city.php?city=<?php echo $row['city'];?>"id="<?php echo $row['city'];?>ReqTab"><?php echo $row['city'];?> </a></li>
        <?php } ?>  			
			 
			
			 
			 
		</ul>
	</li>
	
</ul> 	
<script>
	var tabSelected="file activeLink";
	document.getElementById('<?php echo $activetab ?>').className=tabSelected;
</script>
