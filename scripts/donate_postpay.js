var $ = jQuery.noConflict();
var ID = 1;
var projects = [];
var certificates = [];
var certificates_old = [];
var area = [];
var selected_area = [];
var city = [];
var selected_city = [];
var npo = [];
var selected_npo = [];
var color_flag ;
var sum;
var R=0;


$(document).ready(function() {
	

	getCertificates().done(function(){
		getProjects();
	});

	function getCertificates(){
	
	var deferred = new jQuery.Deferred();

	setTimeout(function() {
	  	$.ajax({
		type: 'POST',
		url: '/donate_postpay_functions.php',
		data: { mode: 'CERTIFICATES'},
		dataType: "json"
		}).done(function( returnData ) {
		if(returnData){
		var certificates_List = returnData.Message.split(';');
		var certificates_old_List = returnData.Certificates_old.split(';');

		for(var i = 0; i < certificates_List.length - 1; i++) {
			certificates.push(certificates_List[i]);
			}
		for(var i = 0; i < certificates_old_List.length - 1; i++) {
			certificates_old.push(certificates_old_List[i]);
			}
		deferred.resolve();
		}
		else{
			alert("Error");
		}
		});
		
    }, 1);
	return deferred.promise();
	}

	var getProjects = function(){
	$.ajax({
		type: 'POST',
		url: '/donate_postpay_functions.php',
		data: { mode: 'PROJECTS'},
		dataType: "json"
	}).done(function( returnData ) {
		var area_container = $('#area');
   		var city_container = $('#city');
   		var npo_container = $('#npo');
   		var data_container = $('#data');
		var projects_List = returnData.Message.split(';');
		for(var i = 0; i < projects_List.length - 1; i++) {
			R++;
			var project = projects_List[i].split('^');	
			projects.push(projects_List[i]);
			if(jQuery.inArray(project[3], area) < 0) {
				area.push(project[3]);
				area[project[3]]=1;
				$('<input />', { type: 'checkbox', id: project[3] + i, value: project[3], class: 'areaValues' }).appendTo(area_container);
	   			$('<label />', { 'for': project[3]+i,id:project[3].replace(/[^a-zA-Z0-9]/g, "")+'label', text: project[3], style: 'display: inline;font-size:12px;' }).appendTo(area_container);
	   			$('<br>&nbsp').appendTo(area_container);
			}
			else{
								area[project[3]]++;
			}
			if(i==projects_List.length-2){
			for(var j = 0; j < area.length; j++) {
	   			$('<label />', { 'for': area[j]+i, text: ' ('+area[area[j]]+')', style: 'display: inline;font-size:11px;color:#666' }).appendTo('#'+area[j].replace(/[^a-zA-Z0-9]/g, "")+'label');
			}
			}
			if(jQuery.inArray(project[4], npo) < 0) {
				npo.push(project[4]);	
				npo[project[4]]=1;				
				$('<input />', { type: 'checkbox', id: project[4] + i, value: project[4], class: 'npoValues' }).appendTo(npo_container);
	   			$('<label />', { 'for': project[4],id:project[4].replace(/[^a-zA-Z0-9]/g, "")+'label', text: project[4], style: 'display: inline;font-size:12px;' }).appendTo(npo_container);
	   			$('<br>&nbsp').appendTo(npo_container);
			}	
			else{
								npo[project[4]]++;
			}
			if(i==projects_List.length-2){
			for(var j = 0; j < npo.length; j++) {
	   			$('<label />', { 'for': npo[j]+i, text: ' ('+npo[npo[j]]+')', style: 'display: inline;font-size:11px;color:#666' }).appendTo('#'+npo[j].replace(/[^a-zA-Z0-9]/g, "")+'label');
			}
			}
			if(jQuery.inArray(project[5], city) < 0) {
				city.push(project[5]);	
				city[project[5]]=1;				
				$('<input />', { type: 'checkbox', id: project[5] + i, value: project[5], class: 'cityValues' }).appendTo(city_container);
	   			$('<label />', { 'for': project[5],id:project[5].replace(/[^a-zA-Z0-9]/g, "")+'label', text: project[5], style: 'display: inline;font-size:12px;' }).appendTo(city_container);
	   			$('<br>&nbsp').appendTo(city_container);
			}	
			else{
								city[project[5]]++;
			}
			if(i==projects_List.length-2){
			for(var j = 0; j < city.length; j++) {
	   			$('<label />', { 'for': city[j]+i, text: ' ('+city[city[j]]+')', style: 'display: inline;font-size:11px;color:#666' }).appendTo('#'+city[j].replace(/[^a-zA-Z0-9]/g, "")+'label');
			}
			}

			color_flag = false;
			var cert_data = "";
			var cert_old_data = "";
			var color = " ";
			for(var j = 0; j < certificates.length; j++) {
				var certificate = certificates[j].split('^');
				var green = (parseInt(certificate[4]) - parseInt(certificate[5]))/parseInt(certificate[4]) * 100;
				var red = 100 - green;
				if(certificate[0] == project[0]) {
					if(color_flag) {
						color = 'style="border: 2px solid black; background: #ddd;"';
						color_flag = false;
					} else {
						color = ' ';
						color_flag = true;
					}
					cert_data += '<tr align="center"' + color + '>'+
								  '<td style="font-size:11px;">' + certificate[2] + ' to ' + certificate[3] + '</td>'+
								  '<td><a href="' + certificate[6] + '" target="_blank"><img src="images/pdficon.gif" alt="link" height="30px"></a></td>'+								  
								  '<td style="font-size:11px;">' + parseInt((certificate[4])).formatMoney(0, '.', ',') + '</td>'+   
								  '<td align="center" style="padding-left: 20px; padding-right: 20px;">'+
								        '<div style="display: block; width: 100%; height: 10px; margin-top: 5px;"><p style="display: block; width: auto; margin: 0; padding: 0; float: left;color:#008800;font-size:11px;">' + (parseInt(certificate[4]) - parseInt(certificate[5])).formatMoney(0, '.', ',') + '</p><p style="display: block;font-size:11px; width: auto;color:#FF0000;   margin: 0; padding: 0; float: right;">' + parseInt((certificate[5])).formatMoney(0, '.', ',') + '</p></div><br>'+
								        '<div id="progress" style="width: 150px; height:8px;background: #FF0000;">'+
								          '<div id="progress" style="width:' + ((green.toFixed(1) * 150) / 100 )+ 'px; height:7px; padding: 0.5px; background: #008800; float: left;"></div>'+
								        '</div>'+
								        '<div style="display: block;color:#008800; width: 100%; height: 10px; margin-top: 5px;"><p style="display: block; width: auto; margin: 0; font-size:11px;padding: 0; float: left;">' + (green.toFixed(1)) + '%</p><p style="display: block; width: auto;   margin: 0; padding: 0;color:#FF0000;font-size:11px; float: right;">' + (red.toFixed(1)) +'%</p></div><br>'+
								  '</td>'+
								  '<td><input id="R' + i + '_' + project[0] + '_' + certificate[1] + '" value = "0" class="certAmount" type="text" style="width:70px"></td>'+
								'</tr>';
				}
			}
			for(var j = 0; j < certificates_old.length; j++) {
				var certificate_old = certificates_old[j].split('^');
				var green = (parseInt(certificate_old[4]) - parseInt(certificate_old[5]))/parseInt(certificate_old[4]) * 100;
				var red = 100 - green;
				if(certificate_old[0] == project[0]) {
					if(color_flag) {
						color = 'style="border: 2px solid black; background: #ddd;opacity:0.5"';
						color_flag = false;
					} else {
						color = 'style="opacity:0.5"';
						color_flag = true;
					}
					if(returnData.Page=="postpaid"){
					cert_old_data += '<tr class="paid_cert'+project[0]+ '" align="center"  style="opacity:1" >'+
								  '<td style="font-size:11px;">' + certificate_old[2] + ' to ' + certificate_old[3] + '</td>'+
								  '<td><a href="' + certificate_old[6] + '" target="_blank"><img src="images/pdficon.gif" alt="link" height="30px"></a></td>'+								  
								  '<td style="font-size:11px;">' + parseInt((certificate_old[4])).formatMoney(0, '.', ',') + '</td>'+   
								  '<td align="center" style="padding-left: 20px; padding-right: 20px;">'+
								        '<div style="display: block; width: 100%; height: 10px; margin-top: 5px;"><p style="display: block; width: auto; margin: 0; padding: 0; float: left;color:#008800;font-size:11px;">' + (parseInt(certificate_old[4]) - parseInt(certificate_old[5])).formatMoney(0, '.', ',') + '</p><p style="display: block;font-size:11px; width: auto;color:#FF0000;   margin: 0; padding: 0; float: right;">' + parseInt((certificate_old[5])).formatMoney(0, '.', ',') + '</p></div><br>'+
								        '<div id="progress" style="width: 150px; height:8px;background: #FF0000;">'+
								          '<div id="progress" style="width:' + ((green.toFixed(1) * 150) / 100 )+ 'px; height:7px; padding: 0.5px; background: #008800; float: left;"></div>'+
								        '</div>'+
								        '<div style="display: block;color:#008800; width: 100%; height: 10px; margin-top: 5px;"><p style="display: block; width: auto; margin: 0; font-size:11px;padding: 0; float: left;">' + (green.toFixed(1)) + '%</p><p style="display: block; width: auto;   margin: 0; padding: 0;color:#FF0000;font-size:11px; float: right;">' + (red.toFixed(1)) +'%</p></div><br>'+
								  '</td>'+'<td><font style="font-size:11px">100% PostPaid!</font></td>' +
								'</tr>';
					}
					else {
					cert_old_data += '<tr class="paid_cert'+project[0]+ '" align="center"  ' + color + ' hidden >'+
								  '<td style="font-size:11px;">' + certificate_old[2] + ' to ' + certificate_old[3] + '</td>'+
								  '<td><a href="' + certificate_old[6] + '" target="_blank"><img src="images/pdficon.gif" alt="link" height="30px"></a></td>'+								  
								  '<td style="font-size:11px;">' + parseInt((certificate_old[4])).formatMoney(0, '.', ',') + '</td>'+   
								  '<td align="center" style="padding-left: 20px; padding-right: 20px;">'+
								        '<div style="display: block; width: 100%; height: 10px; margin-top: 5px;"><p style="display: block; width: auto; margin: 0; padding: 0; float: left;color:#008800;font-size:11px;">' + (parseInt(certificate_old[4]) - parseInt(certificate_old[5])).formatMoney(0, '.', ',') + '</p><p style="display: block;font-size:11px; width: auto;color:#FF0000;   margin: 0; padding: 0; float: right;">' + parseInt((certificate_old[5])).formatMoney(0, '.', ',') + '</p></div><br>'+
								        '<div id="progress" style="width: 150px; height:8px;background: #FF0000;">'+
								          '<div id="progress" style="width:' + ((green.toFixed(1) * 150) / 100 )+ 'px; height:7px; padding: 0.5px; background: #008800; float: left;"></div>'+
								        '</div>'+
								        '<div style="display: block;color:#008800; width: 100%; height: 10px; margin-top: 5px;"><p style="display: block; width: auto; margin: 0; font-size:11px;padding: 0; float: left;">' + (green.toFixed(1)) + '%</p><p style="display: block; width: auto;   margin: 0; padding: 0;color:#FF0000;font-size:11px; float: right;">' + (red.toFixed(1)) +'%</p></div><br>'+
								  '</td>'+'<td><font style="font-size:11px">100% PostPaid!</font></td>' +
								'</tr>';
					}
			}
			}

			var paid = parseInt((project[7])).formatMoney(0, '.', ',');
			var temp = parseInt(project[6]) - parseInt(project[7]);
			var remaining = parseInt((temp.toString())).formatMoney(0, '.', ',');

			var green = (parseInt(project[7]) / parseInt(project[6])) * 100;
			var red = 100 - green;
			var create_data = 	'<div id="R' + i + '">'+
								  '<div class="data" style="display: block;min-height:150px; width: 95%; border: 1px solid #ccc;border-radius:0.2em;-webkit-border-radius:0.2em;-moz-border-radius:0.2em; padding: 10px; margin: 10px;   ">'+
								   '<div style="float:right;text-align:center; margin-bottom: 0; padding-bottom: 0;">'+
								        '<br /><font style="font-size:12px;">PostPay Status (INR)</font>'+
										'<div style="display: block; width: 100%; height: 10px; margin-top: 5px;margin-bottom:-5px;"><p style="display: block; width: auto; margin: 0; padding: 0; float: left; color: #008800; font-weight: normal; font-size: 11px;">PostPaid</p><p style="display: block; width: auto;   margin: 0; padding: 0; float: right; color: #FF0000; font-weight: normal; font-size: 11px;">Remaining</p></div><br />'+
								        '<div style="display: block; width: 100%; height: 8px;"><p style="display: block; width: auto; margin: 0; padding: 0; float: left; color: #008800; font-weight: normal; font-size: 11px;">' + paid + '</p><p style="display: block; width: auto;   margin: 0; padding: 0; float: right; color: #FF0000; font-weight: normal; font-size: 11px;">' + remaining + '</p></div><br>'+
								        '<div id="progress" style="width: 150px; height:8px;background: #FF0000;">'+
								          '<div id="progress" style="width:  '+ ((green.toFixed(1) * 150) / 100 )+ 'px; height:7px; padding: 0.5px; background: #00AA00; float: left;"></div>'+
								        '</div>'+
								        '<div style="display: block; width: 100%; height: 10px; margin-top: 5px; margin-bottom: 1px;"><p style="display: block; width: auto; margin: 0; padding: 0; float: left; color: #008800; font-weight: normal; font-size: 11px;">' + (green.toFixed(1)) + '%</p><p style="display: block; width: auto;  margin: 1px 1px 1px 1px; padding: 1px 1px 1px 1px; float: right; color: #FF0000; font-weight: normal; font-size: 11px;">' + (red.toFixed(1)) + '%</p></div><br>';
				if(returnData.Page=="postpaid"){
				create_data+='<input type="button" id="R_Donate_' + i + '" class="more_info" value="Details" hidden></div>';
				}
				else{
				create_data+='<input type="button" id="R_Donate_' + i + '" class="more_info" value="Donate" ></div>';
				}
				create_data+='<div style="float: right; display: block; width: 53%; height: auto; line-height: 17px; text-align:left; padding-right: 10px; margin-top: 5px;">'+
								      '<b style="color:#369;font-size:14px;font-family:Trebuchet MS">'  + project[1] + '</b>' +
								      '<br><font style="color:#666;font-size:12px;">' + project[2] + '</font>' +
								      '<br><font id="area_'+i+'" style="color:#0C7878;display: inline-block;font-size:12px; width: auto; height: auto; margin: 0; padding: 0;">' + project[3] +
								      '</font>	|&nbsp <font id="city_' + i + '" style="color:#801506;display: inline-block; font-size:12px;width: auto; height: auto; margin: 0; padding: 0;">'+ project[5] +
								      '</font>' + 
									'<br><font style="display: inline-block;font-size:12px; width: auto; height: auto; margin: 0; padding: 0;">Partner: <a style="font-size:12px;" id="npo_' + i + '" href="'+project[9]+'">' + project[4] + '</a></font>' +
									'<br><font style="font-size:12px;">Total Funded (INR):</font> <font id="total_' + i + '" style="display: inline-block;font-size:12px; width: auto; height: auto; margin: 0; padding: 0;">'+ parseInt((project[6])).formatMoney(0, '.', ',') +
								    '</font>'+'<br /><input type="button" class="more_info" id = "more_info_R' + i + '" style="color:#369;font-size:12px;font-family:Trebuchet MS;background:none;border:none;padding:0px;cursor:pointer;" value="More Information" ></div>'+
								    '</p><div style="float: left; display: block; width: 25%; height: auto; text-align: center; margin-top: 5px;">'+
								      ''+
								      //'<div style="background: grey; width: 140px; height: 70px; margin-left: 10%;"></div>'+
								      '<img src="' + project[8] + '" alt="image"  style="background: grey; width: 140px; height: 120px; margin-right: 10%;" >'+
								      //'<img src="#" alt="image"  style="width: 140px; height: 70px; margin-left: 10%;" >'+
								      '<div style="float: left; display: inline-block; width: 100%; height: 30px;">'+
								    '</div>'+
								    '</div>'+
								    
								  '</div>'+
								  '<div id="ext-data-' + i + '" class="ext-data" style="display: block; width: 94%; height: auto; border: 1px solid grey; padding: 10px; margin: 14px; margin-top: -11px; -moz-box-shadow: 0 2px 2px #888;-webkit-box-shadow: 0 2px 2px #888;box-shadow: 0 2px 2px #888;display:none; border-bottom-right-radius:2em; border-bottom-left-radius:2em;" >'+
								    '<table style="background: #eee; display: block; width: 98%; height: auto; border: 1px solid grey; padding: 10px; margin: 5px; -moz-box-shadow: 0 0 5px #888;-webkit-box-shadow: 0 0 3px#888;box-shadow: 0 0 3px #888; border-bottom-right-radius:2em; border-bottom-left-radius:2em;">'+
								      '<tr style="background: #ccc; border: 1px solid black; width:100%;">'+
								        '<th style="padding:5px;width:30%;">Period</th>'+
								        '<th style="padding:5px;width:10%;">Document</th>'+
								        '<th style="padding:5px;width:20%;">Total (INR)</th>'+
								        '<th style="padding:5px;width:20%;">PostPay Status (INR)</th>'+
								        '<th style="padding:5px;width:20%;">Donate</th>'+
								      '</tr>'+

								      cert_data +
								      cert_old_data;
			if(returnData.Page!="postpaid"){
				create_data+='<tr align="center">'+
								        '<td colspan=2><font style="color:#369;font-size:11px;cursor:pointer"  class="hidden_' + project[0] +' showhidden" hidden >Show 100% PostPaid project phases</font></td>'+
								        '<td><input type="text" id="ID_' + i +'" value = "' + project[0] + '" hidden/>'+
								        '</td>'+
								        '<td valign="top"><b style="float:right;">Total</b></td>'+
								        '<td valign="top"><input id="R' + i + '_Total" type="text" value = "0" style="width:70px" disabled><br /><br /><input type="button" id="R_Donate_' + i + '" class="donate" style="width:100%;padding:2px;font-size:14px;" value="Donate" style="float: center:;"></td>'+
								      '</tr>';
			}
				create_data+='</table>'+
								  '</div>'+
								'</div>';

			$(create_data).appendTo(data_container);
			for(var j = 0; j < certificates_old.length; j++) {
				var certificate_old = certificates_old[j].split('^');
					if(certificate_old[5]==0){
					$('.hidden_' + certificate_old[0]).show();
					}
					else {
					$('.hidden_' + certificate_old[0]).hide();
					}
			}
		}
	});
	
	}

	function calculateTotal(id, proj_id, cert_id) {
		var sum = 0;
		for(var j = 0; j < certificates.length; j++) {
			var certificate = certificates[j].split('^');
			if(certificate[0] == proj_id) {
				sum += parseInt($('#R'+id+'_'+proj_id+'_'+certificate[1]).val());
			}
		}
		$('#R' + id + '_Total').val(sum);
		if($('#R' + id + '_Total').val() != 'NaN' && parseInt($('#R' + id + '_Total').val()) > 0) {
			//alert('tes');
			$('#R_Donate_' + id).removeClass('more_info');
			$('#R_Donate_' + id).addClass('donate');
		} else {
			//alert('sdas');
			$('#R_Donate_' + id).addClass('more_info');
			$('#R_Donate_' + id).removeClass('donate');
		}
	};
	function showList() {
		var flag_city = [];
		var flag_npo = [];
		var flag_area = [];
		for(var i = 0; i < R; i++) {
			flag_city[i] = '0';
			flag_npo[i] = '0';
			flag_area[i] = '0';
			if(selected_area.length > 0) {
				var area_temp = $('#area_' + i).text();
				for(var j = 0; j < selected_area.length; j++) {
					if(area_temp == selected_area[j] || flag_area[i] == '1') {
						flag_area[i] = '1';
					} else {
						flag_area[i] = '0';
					}
				}
			} else {
				flag_area[i] = '1';
			}
			if(selected_city.length > 0) {
				var city_temp = $('#city_' + i).text();	
				for(var j = 0; j < selected_city.length; j++) {
					if(city_temp == selected_city[j] || flag_city[i] == '1') {
						flag_city[i] = '1';
					} else {
						flag_city[i] = '0';
					}
				}
			} else {
				flag_city[i] = '1';
			}
			if(selected_npo.length > 0) {
				var npo_temp = $('#npo_' + i).text();	
				for(var j = 0; j < selected_npo.length; j++) {
					if(npo_temp == selected_npo[j] || flag_npo[i] == '1') {
						flag_npo[i] = '1';
					} else {
						flag_npo[i] = '0';
					}
				}
			} else {
				flag_npo[i] = '1';
			}
			if(flag_npo[i] == '1' && flag_city[i] == '1' && flag_area[i] == '1') {
				$('#R'+i).show('fast');
			} else {
				$('#R'+i).hide('fast');
			}
		}

	};




	$(document).on('click', '.showhidden', function() {
			var classname= $(this).attr('class').split(' ')[0];
			var project = classname.replace('hidden_', '');
			$(".paid_cert"+project).slideToggle("fast");
			$(this).replaceWith("<font style='width:200px;font-size:11px;color:#369;cursor:pointer' class='hide_"+project+" hideit' >Hide 100% PostPaid project phases</font>");
	});
	
	$(document).on('click', '.hideit', function() {
			var classname= $(this).attr('class').split(' ')[0];
			var project = classname.replace('hide_', '');
			$(".paid_cert"+project).slideToggle("fast");
			$(this).replaceWith("<font style='width:200px;font-size:11px;color:#369;cursor:pointer' class='hidden_"+project+" showhidden' >Show 100% PostPaid project phases</font>");
	});
	
	$(document).on('click', '.areaValues,.npoValues,.cityValues', function() {
		selected_area = [];
		selected_npo = [];
		selected_city = [];
		$(".clear_filters").hide();
		$(".areaValues:checked,.npoValues:checked,.cityValues:checked").each(function(){
		if($(this).hasClass("areaValues")){
			selected_area.push($(this).val());
			$(".clear_filters").show("fast");
		}
		if($(this).hasClass("npoValues")){
			selected_npo.push($(this).val());
			$(".clear_filters").show("fast");
		}
		if($(this).hasClass("cityValues")){
			selected_city.push($(this).val());
			$(".clear_filters").show("fast");
		}
		});
		showList();
	});

	// $(document).on('click', '.npoValues', function() {
		// selected_npo = [];
		// $("input[class='npoValues']:checked").each(function(){
			// selected_npo.push($(this).val());
			// $(".clear_filters").show("fast");
		// });
		// showList();
	// });

	// $(document).on('click', '.cityValues', function() {
		// selected_city = [];
		// $("input[class='cityValues']:checked").each(function(){
			// selected_city.push($(this).val());
			// $(".clear_filters").show("fast");
		// });
		// showList();
	// });
	$(document).on('click', '.clear_filters', function() {
		$(".clear_filters").hide();
		$(".cityValues:checked,.areaValues:checked,.npoValues:checked").each(function(){
			selected_city=[];
			selected_npo=[];
			selected_area=[];
			$(this).removeAttr('checked');
		});
		showList();
	});

	$(document).on('input', '.certAmount', function(e) {
		var data = $(this).attr('id').split('_');
		var id = data[0].substring(1);
		
		for(var j = 0; j < certificates.length; j++) {
			var certificate = certificates[j].split('^');
			if(certificate[1] == data[2]) {
				if(parseInt($('#' + $(this).attr('id')).val()) < 0) {
					alert('Amount cannot be negative value!');
					$('#' + $(this).attr('id')).val('');
				}

				if(parseInt(certificate[5]) >= parseInt($('#' + $(this).attr('id')).val())) {
					break;
				} else if($('#' + $(this).attr('id')).val() != '' && $('#' + $(this).attr('id')).val() != '-') {
					alert('Please donate amount equal to the remaining postpay amount.');
					$('#' + $(this).attr('id')).val('0');
				}
			}
		}
		calculateTotal(id, data[1], data[2]);
	});

	$(document).on('focusout', '.certAmount', function(e) {
		var data = $(this).attr('id').split('_');
		var id = data[0].substring(1);
		if($('#' + $(this).attr('id')).val() == '') {
			$('#' + $(this).attr('id')).val('0');
		}
		calculateTotal(id, data[1], data[2]);
	});


	function sendData(rowId, id){
		var ids = "";
		var amounts = "";
		ids += id + '^';
			amounts += $('#R'+rowId+'_Total').val() + '^';
		for(var j = 0; j < certificates.length; j++) {
			var certificate = certificates[j].split('^');
			if(certificate[0] == id) {
				if($('#R'+rowId+'_'+id+'_'+certificate[1]).val() != '0') {
					ids += certificate[1] + '^';
					amounts += $('#R'+rowId+'_'+id+'_'+certificate[1]).val() + '^'; 
				}	
			}
		}
		$.ajax({
			type: 'POST',
			url: '/set_session.php',
			data: { mode: 'GET', keys: ids, values: amounts},
			dataType: "json"
		}).done(function( returnData ) {	
			if(returnData){
			window.location.href='/postpay_login.php';
			}
			else{
				alert("Hello");
			}
		});		
	}

	$(document).on('click', '.donate', function() {
		var id = $(this).attr('id');
		id = id.substring(9);
		if($('#R' + id + '_Total').val() == '0') {
			alert('Please enter donation amount.');
			$('#more_info_R' + id).val('Hide Information');
			$('#ext-data-'+id).show("fast");
		} else {
			sendData(id, $('#ID_'+id).val());
		}
	});

	$(document).on('click', '.more_info', function(e){
		var id = $(this).attr('id');
		id = id.substring(11);
		if($(this).val() == 'More Information') {
			$(this).val('Hide Information');
			$('#ext-data-'+id).slideToggle("fast");
			$('#R_Donate_' + id).removeClass('more_info');
			$('#R_Donate_' + id).addClass('donate');
		} else if($(this).val() == 'Hide Information'){
		$(this).val('More Information');
		$('#ext-data-'+id).slideToggle("fast");
		$('#R_Donate_' + id).addClass('more_info');
		$('#R_Donate_' + id).removeClass('donate');
		}

		if($(this).val() == 'Donate' || $(this).val() == 'Details') {
		var id = $(this).attr('id');
		id = id.substring(9);
		$('#more_info_R' + id).val('Hide Information');
		$('#ext-data-'+id).show("fast");
		$('#R_Donate_' + id).removeClass('more_info');
		$('#R_Donate_' + id).addClass('donate');
		}

	});

	Number.prototype.formatMoney = function(c, d, t){
	var n = this, 
	    c = isNaN(c = Math.abs(c)) ? 2 : c, 
	    d = d == undefined ? "." : d, 
	    t = t == undefined ? "," : t, 
	    s = n < 0 ? "-" : "", 
	    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
	    j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};

});
$(document).ready(function() {
	});
/* Change log

02-Jun-2013 - Vivek - Bug Fixed - Pipelining ajax requests to ensure integrity.
11July13 - Vivek - Change in layout, addition of completely postpaid certificates.	

*/

