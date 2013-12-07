<script type="text/javascript">
function displayCategoryDiv() {
    var selectBox = document.getElementById("search_type");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
			if(selectedValue=='author')
			{document.getElementById("author_div").style.display="block";}
			else {document.getElementById("author_div").style.display="none";}
			if(selectedValue=='title')
			{document.getElementById("title_div").style.display="block";}
			else {document.getElementById("title_div").style.display="none";}
			if(selectedValue=='category')
			{document.getElementById("category_div").style.display="block";}
			else {document.getElementById("category_div").style.display="none";}
}
function displayLocationDiv() {
    var selectcity = document.getElementById("city");
    var selectedCityValue = selectcity.options[selectcity.selectedIndex].value;
    var selectedCityName = selectcity.options[selectcity.selectedIndex].text;
 			if(selectedCityValue !='')	{  
				document.getElementById("location_div").style.display="block";
				$('#location_div').load('get_locations.php?city=' + selectedCityName);
			} else 
				{document.getElementById("location_div").style.display="none"; }


   }
</script>
<form method="post" name="search_library" action="index.php" >
<div id="search_contents" class="cube-I">
	<div id="search_by">
		<br><br>
		<h3>Search By:</h3>
		<p><b>Type</b></p>
		<select name="search_type" id="search_type" style="width:140px;" onchange="displayCategoryDiv();">
			<option value='' select="selected">--ALL--</option>
			<option id="author" name='opt_author' value='author' >Author</option>
			<option id="category" name='opt_category' value='category'>Category</option>
			<option id="title"  name='opt_author' value='title'>Title</option>
		</select>
	</div>
	<div id="author_div" style="display:none">
		<p><b>Author:</b></p>
			<input type="text" name="author" style="width:138px;">
	</div>
	<div id="title_div" style="display:none">
		<p><b>Title:</b></p>
			<input type="text" name="title" style="width:138px;">
	</div>
	<div id="category_div" style="display:none">
		<p><b><font color="red">Choose Category</font></b></p>
		<select name="category" id="category" style="width:140px;" >
			<option value='' select="selected">--ALL--</option>
			<?php
				foreach($categories as $code=>$description)
				{
					$id=$code;
					$data=$description;
					echo '<option value="'.$data.'" name="'.$data.'">'.$data.'</option>';
				}
			?>
		</select>
	</div>
	<div id="city_div"> 
		<p><b><font>City </font></b></p>
				<select id="city" name="city" style="width:140px;" onchange="displayLocationDiv();">
					<option value='' select="selected">--ALL--</option>
		<?php
		foreach ($cities as $c) { 
		echo '<option value="'.$c->getCityName().','.$c->getLatitude().','.$c->getLongitude().'" name="'.$c->getCityName().'">'.$c->getCityName().'</option>';
				    }
		?>
				</select>


	</div>
	<div id="location_div"  style="display:none">
	</div>
	</br></br>
	<input type="submit" name="Submit" value="Submit">
</div>

</form>
