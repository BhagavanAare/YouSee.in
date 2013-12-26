$(document).ready(function() {
	$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
	var keyUpTime = 1000;
	// 1 sec
	var keyUpTimeout = null;
	$('#donor_search').on('input', function(e) {
		$("#search_result").hide();
		if ($(this).val().length > 2) {
			clearTimeout(keyUpTimeout);
			keyUpTimeout = setTimeout(function() {
				sendAjax();
			}, keyUpTime);
		} else {
			$("#search_result").hide();
		}

	});
	function sendAjax() {
		if ($("#donor_search").val().length > 2) {
			
			$.ajax({
				async : true,
				type : "POST",
				url : "util/dbUtility.php",
				data : {
					search_donor : 1,
					search_key : $("#donor_search").val()
				},
				dataType : "JSON",
				success : function(returnData) {
					if (returnData) {
						
						$("#search_result").children().remove();
						$("#search_result").show();
						for (var i = 0; i < returnData.length; i++) {
							$("#search_result").append('<div class="search_list"><span id="donor_name">' + returnData[i][1] + ' ' + returnData[i][2] + '</span>,<span id="donor_city">' + returnData[i][5] + '</span><input type="text" id="email" value="' + returnData[i][3] + '" hidden /><input id="phone_no" type="text" value="' + returnData[i][4] + '" hidden /><input id="org_grp" type="text" value="' + returnData[i][6] + '" hidden /><input id="donor_id" type="text" value="' + returnData[i][0] + '" hidden /></div><br />');
						}
						$(".search_list").on('click', function() {
							$("#search_result").hide();
							$("#donor_info").show();
							$("#donor_selected").val($(this).find("#donor_id").val());
							$("#citybox").val($(this).find("#donor_city").val());
							$("#emailbox").val($(this).find("#email").val());
							$("#mobilebox").val($(this).find("#phone_no").val());
							$("#orgbox").val($(this).find("#org_grp").val());
							$("#donor_address").val($(this).find("#donor_address").val());
							$("#donor_search").val($(this).find("span").html());
						});
					}
				}
			});
		}
	}

});
