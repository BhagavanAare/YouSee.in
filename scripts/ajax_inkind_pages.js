	$(document).ready(function() { 
	pages="existing_requests";
	$("#exist_requests_button").css('background','#fff');
	$("#exist_offers_button").click(function(){
			$(this).css('background','#fff');
			$("#exist_requests_button").css('background','#eee');
	pages="existing_offers";
		thisdiv="offers_inkind";
			$.ajax({
			type:"POST",
			url:"existing_offers.php",
			success:function(html){
				$.ajax({
		type : "POST",
		url : "search_filters.php",
		data : {thisdiv:thisdiv},
		dataType : "html",
		success : function(html) {
			$("#search_filters").append(html);
		}
	});
				$("#existing_content").children().remove();
				$("#existing_content").append(html);
				$("#exist_offers_button").addClass("existing_selected");
				$("#exist_requests_button").removeClass("existing_selected");

			}
		});
	});
	$("#exist_requests_button").click(function(){
	pages="existing_requests";
	thisdiv="requests_inkind";
				$(this).css('background','#fff');
			$("#exist_offers_button").css('background','#eee');

			$.ajax({
			type:"POST",
			url:"ajax_inkind_requests.php",
			success:function(html){
				$.ajax({
		type : "POST",
		url : "search_filters.php",
		data : {thisdiv:thisdiv},
		dataType : "html",
		success : function(html) {
			$("#search_filters").append(html);
		}
	});
				$("#existing_content").children().remove();
				$("#existing_content").append(html);
				$("#exist_requests_button").addClass("existing_selected");
				$("#exist_offers_button").removeClass("existing_selected");
			}
		});
	});
	$("#donate").click(function(){
	var donate="";
			$.ajax({
				type : "POST",
				url : "inkind_forms.php",
				data : {donate:donate} ,
				success : function(html){
				if(html){
					window.location.href="offer_inkind.php";
					}
				else {
					alert("You need to be logged in as a donor to make an in-kind offer.");
				}
				}
			});
		});
	$("#request").click(function(){
	var request="";
			$.ajax({
				type : "POST",
				url : "inkind_forms.php",
				data : {request:request} ,
				success : function(html){
				if(html){
					window.location.href="req_inkind.php";
				}
				else{
					alert("You need to be logged in as an NGO to make an in-kind request.");
				}
				}
			});
		});
	if(pages=="existing_requests") { 
		thisdiv = "requests_inkind";
	}
	$.ajax({
		type : "POST",
		url : "search_filters.php",
		data : {thisdiv:thisdiv},
		dataType : "html",
		success : function(html) {
			$("#search_filters").append(html);
		}
	});
});

/* Change log

02-Jun-2013 - Vivek - Bug Fixed - URL path corrected.

*/
