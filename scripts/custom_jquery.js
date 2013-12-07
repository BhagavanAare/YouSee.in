$(document).ready(function() { 
 $("#postedComments").append( "<p id='last'></p>" );
//console.log("Document Ready");
doMouseWheel = 1 ; 
$(window).scroll(function() {
//console.log("Window Scroll ----");
	if (!doMouseWheel)  {
		return ;
	} ;
	var distanceTop = $('#last').offset().top - $(window).height();	
	if  ($(window).scrollTop() > distanceTop){
		//console.log("Window distanceTop to scrollTop Start");
		doMouseWheel = 0 ; 
		$('div#loadMoreComments').show();
		//console.log("Another window to the end !!!! "+$(".postedComment:last").attr('id'));	
		$.ajax({
			dataType : "html" ,
			url: "volunteering_opportunities_load.php?lastComment="+$(".postedComment:last").attr('id') ,	
			success: function(html) {
				$('div#loadMoreComments').hide();
				doMouseWheel = 1 ; 
				if(html){
					$("#postedComments").append(html);
					//console.log("Append html--------- " +$(".postedComment:first").attr('id'));
					//console.log("Append html--------- " +$(".postedComment:last").attr('id'));
					$("#last").remove();
					$("#postedComments").append( "<p id='last'></p>" );
					$('div#loadMoreComments').hide();
				}else{		
					$('div#loadMoreComments').replaceWith("<center><h1 style='color:red'>No more opportunities listed.</h1></center>");
					// Added on Ver.0.4  
					//Disable Ajax when result from PHP-script is empty (no more DB-results )
					doMouseWheel = 1 ; 
					$("#last").remove();
				}
			}

		});
	}
	});
	var vertical=[];
	var domain=[];
	var city=[];
	var activity=[];
	var sort="";
	$(":checkbox:checked").each(function(){
		if($("#"+this.id).hasClass("vertical")){
			vertical.push(this.value);
		}
		if($("#"+this.id).hasClass("domain")){
			domain.push(this.value);
		}
		if($("#"+this.id).hasClass("city")){
			city.push(this.value);
		}
		if($("#"+this.id).hasClass("activity")){
			activity.push(this.value);
		}
	});
	$(".vertical, .domain, .city, .activity").click(function(){
		$("#clear_filter").show();
		$("#postedComments").children().remove();
		$('div#loadMoreComments').show();
		$('#loader').show();
		if( $("#"+this.id).hasClass("vertical") ){
			if($("#"+this.id).is(':checked')){
				vertical.push(this.value);
				}
			else{
    				vertical.splice($.inArray(this.value, vertical),1);
			}
		$.ajax({
			type : "POST",
			data : {vertical:vertical , domain:domain ,city:city, activity:activity},
			url : "volunteering_opportunities.php",
			success : function(html) {
			$.ajax({
				type : "POST",
				data : {vertical:vertical , domain:domain ,city:city, activity:activity},
				url : "dt_filters.php",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
			}
			});
		}
		if( $("#"+this.id).hasClass("domain") ){
			if($("#"+this.id).is(':checked')){
				domain.push(this.value);
			}
			else{
    				domain.splice($.inArray(this.value, domain),1);
			}
		$.ajax({
			type : "POST",
			data : {vertical:vertical , domain:domain ,city:city, activity:activity},
			url : "volunteering_opportunities.php",
			success : function(html) {
			$.ajax({
				type : "POST",
				data : {vertical:vertical , domain:domain ,city:city, activity:activity},
				url : "dt_filters.php",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );


				}
			});
		}
		if( $("#"+this.id).hasClass("city") ){

			if($("#"+this.id).is(':checked')){
				city.push(this.value);
				}
			else{
    				city.splice($.inArray(this.value, city),1);
			}
		$.ajax({
			type : "POST",
			data : {vertical:vertical , domain:domain ,city:city, activity:activity},
			url : "volunteering_opportunities.php",
			success : function(html) {
			$.ajax({
				type : "POST",
				data : {vertical:vertical , domain:domain ,city:city, activity:activity},
				url : "dt_filters.php",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
				}
			});
		}
		if( $("#"+this.id).hasClass("activity") ){
			if($("#"+this.id).is(':checked')){
				activity.push(this.value);
			}
			else{
    				activity.splice($.inArray(this.value, activity),1);

			}
		$.ajax({
			type : "POST",
			data : {vertical:vertical , domain:domain ,city:city, activity:activity},
			url : "volunteering_opportunities.php",
			success : function(html) {
			$.ajax({
				type : "POST",
				data : {vertical:vertical , domain:domain ,city:city, activity:activity},
				url : "dt_filters.php",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
				}
			});
		}
	});
	$("#sortby").change(function(){
		alert("Hi"); 	
		$("#postedComments").children().remove();
		$('div#loadMoreComments').show();
		$('#loader').show();
		if( $("#"+this.id).value=="asc" ){
				sort=this.value;
				}
		$.ajax({
			type : "POST",
			data : sort,
			url : "volunteering_opportunities.php",
			success : function(html) {
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
			}
			});
	});
	$("#datesearch").change(function(){
		$("#postedComments").children().remove();
		$('div#loadMoreComments').show();
		$('#loader').show();
		var date=this.value;
		$.ajax({

			type : "POST",
			data : {vertical:vertical , domain:domain ,city:city, activity:activity, date:date},
			url : "volunteering_opportunities.php",
			success : function(html) {

			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
				}
			});
	});
	$("#clear_filter").click(function(){
	
		var vertical=[];
	var domain=[];
	var city=[];
	var activity=[];
	$.ajax({
			type : "POST",
			url : "volunteering_opportunities.php",
			success : function(html) {
			$.ajax({
				type : "POST",
				url : "dt_filters.php",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").children().remove();
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );


				}
			});
	});
});
	function act_details(activity_id){
		$("#td"+activity_id+"").click(function(){
		if($("#details"+activity_id+"").css('display')!='none'){
		$($("#details"+activity_id+"")).slideUp('fast');	
		}
		else {
		for($i=0;$i!=activity_id;$i++){
		$(".inner").hide();
		}
		$("#details"+activity_id+"").slideDown('fast');
		$("#details"+activity_id+"").css("background","#f2f2f2");
		}
		});  
		}
	
/*
Version Track
1 - 07May13 - Vivek - act_details function added and modified.
*/
