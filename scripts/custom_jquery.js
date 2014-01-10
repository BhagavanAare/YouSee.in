
$(document).ready(function() 
{ 
 $("#postedComments").append( "<p id='last'></p>" );
//console.log("Document Ready");
doMouseWheel = 1 ; 
$(window).scroll(function() {
//console.log("Window Scroll ----");
	if (!doMouseWheel)  {
		return ;
	} ;
	var distanceTop = $('#last').offset().top - $(window).height();	
	if  ($(window).scrollTop() > distanceTop)
	{
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
	var dates = []; // dates[0] - from_date , dates[1] - to_date, dates[2] - checked Option
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
		
		if(this.id == "today" )
		{
			var d = new Date();
			var today = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
			dates[0] = today;
			dates[1] = today;
			dates[2] = 1;
			
		}
		if(this.id=="tomorrow")
		{
			var date = new Date();
			var d = date.getDate()+1;
			var tomorrow = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
			dates[0] = tomorrow;
			dates[1] = tomorrow;
			dates[2] = 2;
		}
		
		
	});
	
		
	
	function sendAjax()
	{
		
		$.ajax({
			type : "POST",
			data : {vertical:vertical , domain:domain ,city:city, activity:activity, dates:dates},
			url : "volunteering_opportunities.php",
			success : function(html) 
			{
		
				$('div#loadMoreComments').hide();
				$('#loader').hide();		
				$("#postedComments").append(html);
				$("#postedComments").append("<p id='last'></p>" );
		
			}
		});
		//alert(""+vertical+","+domain+","+city+","+activity+","+dates);
		$.ajax(
		{
					type : "POST",
					data : {vertical:vertical , domain:domain ,city:city, activity:activity, dates:dates},
					url : "dt_filters.php",
					success : function(html) {

						$("#search_filters").children().remove();
						$("#search_filters").append(html);
						$( "#from_date" ).datepicker(
						{
							maxDate: 365,
	      					onSelect: function( selected ) 
	      					{
		        				$("#to_date" ).datepicker( "option", "minDate", selected );
	    	    				$("#to_date" ).datepicker( "option", "maxDate", selected+365 );
	        					$("#to_date").removeAttr("disabled"); 
	      					}
	    				});
		    			$( "#to_date" ).datepicker({
	    	 				onSelect: function( selected ) 
	     					{
	        					$( "#from_date" ).datepicker( "option", "maxDate", selected );
	        				}
	      				});
					}	
		});
	}
	$("#clear_filter").click(function(){
	
		vertical=[];
		domain=[];
		city=[];
		activity=[];
		dates = [];
		sendAjax();
		
	
	});
	$(".vertical, .domain, .city, .activity, .dates").click(function(){
		$("#clear_filter").show();
		$("#postedComments").children().remove();
		$('div#loadMoreComments').show();
		$('#loader').show();
		
		
		if( $("#"+this.id).hasClass("dates") ){
			
			if($("#today").is(':checked'))
			{
				
				var d = new Date();
				var today = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
				dates[0] = today;
				dates[1] = today;
				dates[2] = 1;	
				
			}
			else if($("#tomorrow").is(':checked'))
			{
				
				var d = new Date(new Date().getTime() + 86400000); // 24 * 60 * 60 * 1000
				var tomorrow = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
				dates[0] = tomorrow;
				dates[1] = tomorrow;
				dates[2] = 2;	
			}
			else if(this.id == "date_submit")
			{
				from_date = $("#from_date").val();
				to_date = $("#to_date").val();
				var valid = true;
				var from = Date.parse(from_date);
				var to =  Date.parse(to_date);
				if(from_date.length == 0 || to_date.length == 0)
				{
					alert("Please enter date fields.");
				}
				else if(isNaN(from) || isNaN(to))
				{
					alert("invalid date format");
				}
				else
				{
					dates[0] = from_date;
					dates[1] = to_date;
					dates[2] = 3;
					sendAjax();
				}
			}
			else
			{
				dates = [];
			}
			sendAjax();
				
		}
		if( $("#"+this.id).hasClass("vertical") ){
			if($("#"+this.id).is(':checked')){
				vertical.push(this.value);
				}
			else{
    				vertical.splice($.inArray(this.value, vertical),1);
			}
			sendAjax();
		}
		if( $("#"+this.id).hasClass("domain") ){
			if($("#"+this.id).is(':checked')){
				domain.push(this.value);
			}
			else{
    				domain.splice($.inArray(this.value, domain),1);
			}
			sendAjax();
		}
		if( $("#"+this.id).hasClass("city") ){

			if($("#"+this.id).is(':checked')){
				city.push(this.value);
				}
			else{
    				city.splice($.inArray(this.value, city),1);
			}
			sendAjax();
		}
		if( $("#"+this.id).hasClass("activity") ){
			if($("#"+this.id).is(':checked')){
				activity.push(this.value);
			}
			else{
    				activity.splice($.inArray(this.value, activity),1);

			}
			sendAjax();
		}
	});
	$("#sortby").change(function(){
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
