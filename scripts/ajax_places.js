var limit = 10;
var start=10;
$(function(){	
	$("#search_form").submit(function(e){
		e.preventDefault();
	});
	$("#search_filter :checkbox, #search_filter :submit, #clear_filters").on('click',function(){
		sendAjax(this.id);
	});
	
	$("#displayedList").append( "<p id='last''></p>" );
	 
	doMouseWheel = 1 ; 
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
			type : "POST",
			dataType : "html" ,
			url: "service_places.php" ,
			data : {id : $(".npo:last").attr("id"),start : start, limit : limit},	
			success: function(html) {
				$('div#loadMoreComments').hide();
				doMouseWheel = 1 ; 
				if($(html).find("#subList").html()!=""){
					start = start+limit;
					$("#subList").append($(html).find("#subList"));
					$("#last").remove();
					$("#displayedList").append( "<p id='last'></p>" );
					$('div#loadMoreComments').hide();
				}else{	
					$('div#loadMoreComments').replaceWith("<center><h1 style='color:#aaa'>End of list.</h1></center>");
					doMouseWheel = 1 ; 
					$("#last").remove();
				}
			}

		});
	}
	});
});


function sendAjax(id){
	var search_place="";
	var type=[];
	var search_city=[];
	var url="service_places.php";
	$("#clear_filters").hide();
	if(id!="clear_filters"){
	
	$("#map_canvas").hide();
	$("#search_place").val()!='NULL'?search_place=$("#search_place").val():search_place="";
	$("#search_filter :checkbox").each(function(){
		if($(this).is(":checked")){
			$("#clear_filters").show()
		}
		if($(this).hasClass("search_type")){
			if($(this).is(':checked')){
				type.push($(this).val());
			}
			else{
				if($.inArray($(this).val(),type)!= -1){
					type.splice($.inArray($(this).val(), type),1);
				}
			}
		}
		if($(this).hasClass("search_city")){
			if($(this).is(':checked')){
				search_city.push($(this).val());
			}
			else{
				if($.inArray($(this).val(),search_city)!= -1){
    				search_city.splice($.inArray($(this).val(), search_city),1);
				}
			}
		}
		});
	}
	else if(id=="clear_filters"){
		$("#map_canvas").show();
	}	
			$.ajax({
			async : true,
			type : "POST",
			data : {search_place:search_place ,search_city:search_city, type:type},
			url : url,
			success : function(html) {
			$("#displayedList").replaceWith(($(html).find("#displayedList")));
			$("#search_filter").replaceWith($(html).find("#search_filter"));
//			$('div#loadMoreComments').hide();		
//			$("#postedComments").append("<p id='last'></p>" );
			}
			});
}
