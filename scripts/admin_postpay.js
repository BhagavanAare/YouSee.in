var $j = jQuery.noConflict();
var ID = 1;
var rowId = [];
var projects_List = [];
var certificates_List = [];

$j(document).ready(function() {
	function getCertificates(id) {
			$j.ajax({
				type: 'POST',
				url: 'db_functions.php',
				data: { mode: 'CERTIFICATES'},
				dataType: "json"
			}).done(function( returnData ) {
				$j('#certificate'+id)
					.find('option')
					.remove()
					.end()
				;
				console.log("hi");
				var projects_List_Temp = returnData.Projects.split(';');
				var certificates_List_Temp = returnData.Certificates.split(';');
				
				for(var i = 0; i < projects_List_Temp.length - 1; i++) {
					var project = projects_List_Temp[i].split('^');
					projects_List[project[0]] = project[1] + '^' + project[2]; 
				}

				for(var i = 0; i < certificates_List_Temp.length - 1; i++) {
					var certificate = certificates_List_Temp[i].split(',');
					certificates_List[certificate[1]] = certificate[0] + '^' + certificate[2] + '^' + certificate[3] + '^' + certificate[4] +'^' + certificate[5];
					if(parseInt(certificate[5]) > 0 || certificate[5] == '') {
						if(certificate[5] == '') {
							certificate[5] = certificate[4] ;
						} 
						var tempData = projects_List[certificate[0]].split('^');
						$j('#certificate'+id).append('<option value = "'+ certificate[1]+'" >'+ tempData[1] + ', ' + certificate[5] + ', ' + tempData[0] + '</option>');
					}	
					var list = {};
					$j('#certificate'+id).each(function () {
						if(list[this.text]) {
							$(this).remove();
						} else {
							list[this.text] = this.value;
						}
					});
				}
			});
	}

	
	function calculateTotal() {
		if($j('#Amount').val() != '') 
			$j('#balance').val($j('#Amount').val());
		else {
			$j('#balance').val('0');
		}
		for(var i = 0; i < rowId.length; i++) {
			var num = parseInt(rowId[i]);

			if($j('#Amount_Project'+num).val() != '')
				$j('#balance').val(parseInt($j('#balance').val()) - parseInt($j('#Amount_Project'+num).val()));
			if($j('#Amount_Operation'+num).val() != '')
				$j('#balance').val(parseInt($j('#balance').val()) - parseInt($j('#Amount_Operation'+num).val()));			
		}
		console.log($j('#balance').val());		
	}
	getCertificates(1);
	rowId.push("1");

	$j(document).on('click', '.certificate', function(){
		var ID = $j(this).attr('id').substring(11);
		var temp = certificates_List[$j('#'+(this.id)).val()].split('^');
		var donor_name = projects_List[temp[0]].split('^');
		$j('#ngo' + ID).val(donor_name[1]);
		$j('#period' + ID).val(temp[1] + ' to ' + temp[2]);
		$j('#value' + ID).val(temp[3]);
		if(temp[4] == '') {
			$j('#balance' + ID).val(temp[3]);
		} else {
			$j('#balance' + ID).val(temp[4]);
		}
		if(parseInt($j('#balance').val()) > 0) {
			if(parseInt($j('#balance').val()) > parseInt($j('#balance'+ID).val())) {
				$j('#Amount_Project'+ID).val($j('#balance'+ID).val());
			} else {
				$j('#Amount_Project'+ID).val($j('#balance').val());
			}
		} else {
			//$j('#Amount_Project'+ID).val('0');
		}		
		calculateTotal();
	});

	$j(document).on('input', '#Amount', function(e){
		if($j('#Amount').val() != '') {
			$j('#balance').val($j('#Amount').val());
			if(parseInt($j('#Amount').val()) > parseInt($j('#balance1').val())) {
				$j('#Amount_Project1').val($j('#balance1').val());
			} else {
				$j('#Amount_Project1').val($j('#Amount').val());
			}
			calculateTotal();
		} else {
			$j('#balance').val('0');
			$j('#Amount_Project1').val('0');
		}		
	});
	
	$j(document).on('click', '.remove', function() {
		var ID = $j(this).attr('id');
		ID = ID.substring(6);
		console.log(ID);
		if(rowId.length != '1') {
			$j('#B' + ID).remove();
			index = rowId.indexOf(ID);
			rowId.splice(index, 1);
			calculateTotal();
		} else {
			alert('Sorry. You cannot remove this!');
		}
		calculateTotal();
	});
	
	$j('#add').click(function() {
		if(parseInt($j('#balance').val()) > 0) {
			ID++;
			var create = '<tbody id = "B'+ID+'"><tr><td span="2">&nbsp</td></tr><tr>';
			create += '<td align="right">Title</td>';
			create += '<td>';
			create += '<select id = "certificate'+ID+'" class = "certificate" style = "width: 400px;">';
			create += '</select>';
			create += '</td>';
			create += '</tr>';
			create += '<tr>';
			create += '<td align="right">Description</td>';
			create += '<td>NGO:&nbsp <input type="text" id="ngo'+ID+'" disabled> Period: &nbsp &nbsp<input type="text" id="period'+ID+'" style="width: 180px" disabled><br>';
			create += 'Value: <input type="text" id="value'+ID+'" value="0" disabled> Balance: <input type="text" id="balance'+ID+'" value="0" disabled></td>';
			create += '</tr>'; 

			create += '<tr>';
			create += '<td align="right">Amount for project</td>';
			create += '<td><input type="text" name="Amount for project" class = "Amount_Project" id="Amount_Project'+ID+'" maxlength="150"> </td>';
			create += '</tr>';
			create += '<tr>';
			create += '<td align="right">Amount for Operation</td>';
			create += '<td><input type="text" name="Amount for Operation" class = "Amount_Operation" id="Amount_Operation'+ID+'" value="0" maxlength="150"> </td>';
			create += '</tr>';
			create += '<tr>';
			create += '<td colspan="2" align="right"><input type="button" name="remove" id = "remove'+ID+'" class = "remove" value="Remove"  />';
			create += '</tr></tbody>';
			$j('#payment_table').append(create);	
			getCertificates(ID);
			rowId.push(ID.toString());
			if(parseInt($j('#balance').val()) > parseInt($j('#balance'+ID).val())) {
				$j('#Amount_Project'+ID).val($j('#balance'+ID).val());
			} else {
				$j('#Amount_Project'+ID).val($j('#balance').val());
			}
			calculateTotal();
		} else {
			alert('You don\'t have sufficient balance!');
		}

	});

	$j(document).on('input', '.Amount_Project', function(e){
		var id = $j(this).attr('id');
		id = id.substring(14);
		console.log($j('#balance').val());		
		calculateTotal();		
		if(parseInt($j('#balance').val()) < 0) {
			alert('Amount Exceeds Balance');
			$j('#Amount_Project'+id).val('');
			calculateTotal();
		}
		if((parseInt($j('#Amount_Project'+id).val()) + parseInt($j('#Amount_Operation'+id).val())) > parseInt($j('#balance'+id).val())) {
			alert('Total Amount Exceeds Project Balance');
			$j('#Amount_Project'+id).val('');
			calculateTotal();
		}
	});
	
	$j(document).on('input', '.Amount_Operation', function(e){
		var id = $j(this).attr('id');
		id = id.substring(16);
		console.log($j('#balance').val());		
		calculateTotal();	
		if( parseInt($j('#balance').val()) < 0) {
			alert('Amount Exceeds Balance');
			$j('#Amount_Operation'+id).val('');
			calculateTotal();
		}
		if((parseInt($j('#Amount_Project'+id).val()) + parseInt($j('#Amount_Operation'+id).val())) > parseInt($j('#balance'+id).val())) {
			alert('Total Amount Exceeds Project Balance');
			$j('#Amount_Operation'+id).val('');
			calculateTotal();
		}
		
	});
	
	$j('#submit_pay').click(function() {
		if($j('#balance').val() != '0') {
			alert("Balance not equal to zero or no data!");
		} else {
			var user_Id = $j('#donors_list').val();
			var dod = $j('#opp_date').val();
			var amount = $j('#Amount').val();
			var mode_pay = $j('#mode_pay').val();
			var	ins_no = $j('#instrument_no').val();
			var	ins_date = $j('#instrument_date').val();
			var ins_nar = $j('#instrument_nar').val();	
			console.log(user_Id);
			$j.ajax({
				async: false,
				type: 'POST',
				url: 'db_functions.php',
				data: { mode: 'SUBMIT_DON_DETAILS', DOD: dod, Amount: amount, MODE_PAY: mode_pay, INS_NO: ins_no, INS_DATE: ins_date, INS_NAR: ins_nar},
				dataType: "json"
			}).done(function( returnData ) {
				message = returnData.Message;
				var payment_id = returnData.Payment_Id;
				console.log(payment_id+"hi");
				var flag = 0;
				for(var i = 0; i < rowId.length; i++) {
					var num = parseInt(rowId[i]);
					var cer_id = $j('#certificate'+num).val();
					var amount_op = $j('#Amount_Operation'+num).val();
					var amount_pr = $j('#Amount_Project'+num).val();
					$j.ajax({
						async: false,
						type: 'POST',
						url: 'db_functions.php',
						data: { mode: 'SUBMIT_DON', Payment_Id: payment_id, User_id: user_Id, Certificate_id: cer_id, Amount_Pro: amount_pr, Amount_Op: amount_op},
						dataType: "json"
					}).done(function( returnData ) {
						message = returnData.Message;
						console.log(message + i);	
						flag = 1;					
					});
				}
				console.log(flag);
				if(flag == 1) {
					alert("Data submitted successfully!");
					window.location.href = "admin_postpay.php" ;
				}
			});
		}
	});
});