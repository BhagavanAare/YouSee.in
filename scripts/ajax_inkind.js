$(document).ready(function() { 
 $("#postedComments").append( "<p id='last''></p>" );
//console.log("Document Ready");
doMouseWheel = 1 ; 
	if(pages=="existing_offers"){
		url="inkind_offers_load.php?lastComment=";
		suburl="inkind_offers.php";
		thisdiv="offers_inkind";
		}
	else {
			url = "inkind_requests_load.php?lastComment=";
			suburl="inkind_requests.php";
			thisdiv="requests_inkind";
	}
$(window).scroll(function() {
//console.log("Window Scroll ----");
	if (!doMouseWheel || !$('#last').offset())  {
		return ;
	} 		
		var distanceTop = $('#last').offset().top - $(window).height();
	if  ($(window).scrollTop() > distanceTop){
		//console.log("Window distanceTop to scrollTop Start");
		doMouseWheel = 0 ; 
		$('div#loadMoreComments').show();
		//console.log("Another window to the end !!!! "+$(".postedComment:last").attr('id'));	
		$.ajax({
			dataType : "html" ,
			url: url+$(".postedComment:last").attr("id") ,	
			success: function(html) {
				$('div#loadMoreComments').hide();
				doMouseWheel = 1 ; 
				if(html){
					$("#requests_inkind").append(html);
					//console.log("Append html--------- " +$(".postedComment:first").attr('id'));
					//console.log("Append html--------- " +$(".postedComment:last").attr('id'));
					$("#last").remove();
					$("#postedComments").append( "<p id='last'></p>" );
					$('div#loadMoreComments').hide();
				}else{	
					$('div#loadMoreComments').replaceWith("<center><h1 style='color:#aaa'>End of list.</h1></center>");
					// Added on Ver.0.4  
					//Disable Ajax when result from PHP-script is empty (no more DB-results )
					doMouseWheel = 1 ; 
					$("#last").remove();
				}
			}

		});
	}
	});
	var category="";
	var item=[];
	var request_city=[];
	var offer_city=[];
	var transport=[];
	var sort="";
	$(".category, .item, .city, .transport").on('change',function(){
	
	$("#category").val()!='NULL'?category=$("#category").val():category="";
	$("#item").val()!='NULL' && $("#category").val()!='NULL'?item=$("#item").val():item=[];
	$(":checkbox:checked").each(function(){
		if($("#"+this.id).hasClass("city")){
			request_city.push(this.value);
		}
		if($("#"+this.id).hasClass("transport")){
			transport.push(this.value);
		}
	});
	

		$('div#loadMoreComments').show();
		$('#loader').show();
		if( $("#"+this.id).hasClass("category") ){
			category=this.value;
		$.ajax({
			type : "POST",
			data : {category:category , item:item ,request_city:request_city, transport:transport},
			url : suburl,
			success : function(html) {
				$.ajax({
				type : "POST",
				url : "search_filters.php",
				data : {thisdiv:thisdiv,category:category , item:item ,request_city:request_city, transport:transport},
				dataType : "html",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$("#postedComments").children().remove();
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
			}
			});
		}
		if( $("#"+this.id).hasClass("item") ){
				item=this.value;
		$.ajax({
			type : "POST",
			data : {category:category , item:item ,request_city:request_city, transport:transport},
			url : suburl,
			success : function(html) {
				$.ajax({
				type : "POST",
				url : "search_filters.php",
				data : {thisdiv:thisdiv,category:category , item:item ,request_city:request_city, transport:transport},
				dataType : "html",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$("#postedComments").children().remove();
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
				}
			});
		}
		if( $("#"+this.id).hasClass("city") ){

			if($("#"+this.id).is(':checked')){
				request_city.push(this.value);
				}
			else{
    				request_city.splice($.inArray(this.value, request_city),1);
			}
		$.ajax({
			type : "POST",
			data : {category:category , item:item ,request_city:request_city, transport:transport},
			url : suburl,
			success : function(html) {
				$.ajax({
				type : "POST",
				url : "search_filters.php",
				data : {thisdiv:thisdiv,category:category , item:item ,request_city:request_city, transport:transport},
				dataType : "html",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$("#postedComments").children().remove();
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
				}
			});
		}
		if( $("#"+this.id).hasClass("transport") ){
			if($("#"+this.id).is(':checked')){
				transport.push(this.value);
			}
			else{
    				transport.splice($.inArray(this.value, transport),1);

			}
		$.ajax({
			type : "POST",
			data : {category:category , item:item ,request_city:request_city, transport:transport},
			url : suburl,
			success : function(html) {
				$.ajax({
				type : "POST",
				url : "search_filters.php",
				data : {thisdiv:thisdiv,category:category , item:item ,request_city:request_city, transport:transport},
				dataType : "html",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$("#postedComments").children().remove();
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
			url : suburl,
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
			data : {category:category , item:item ,request_city:request_city, transport:transport, date:date},
			url : suburl,
			success : function(html) {

			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
				}
			});
	});

	$("#clear_filters").click(function(){
	var category="";
	var item=[];
	var request_city=[];
	var offer_city=[];
	var transport=[];
	var sort="";
	$.ajax({
			type : "POST",
			data : {category:category , item:item ,request_city:request_city, transport:transport},
			url : suburl,
			success : function(html) {
				$.ajax({
				type : "POST",
				url : "search_filters.php",
				data : {thisdiv:thisdiv},
				dataType : "html",
				success : function(html) {
					$("#search_filters").children().remove();
					$("#search_filters").append(html);
				}
			});
			$("#postedComments").children().remove();
			$('div#loadMoreComments').hide();
			$('#loader').hide();		
			$("#postedComments").append(html);
			$("#postedComments").append("<p id='last'></p>" );
				}
			});
	});
	});

/*
Version Track
1 - 07May13 - Vivek - act_details function added and modified.
*/
