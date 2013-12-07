var $j = jQuery.noConflict();
var numDetails = 1;
var donors_Id = [];
var donors_Names = [];
var donors_Phone = [];
var donors_Email = [];
var donors_City = [];
var donors_Org = [];
var user_Id;
var row_Id = [];
var totalCal = 0;
var totalAct = 0;

function calculateTotal() {
	totalCal = 0;
	totalAct = 0;
	for(var i = 0; i < row_Id.length; i++) {
		var num = parseInt(row_Id[i]);
		totalCal += parseInt($j("#cal_val"+num).val());
		totalAct += parseInt($j("#actual_value"+num).val());
	}
	$j('#totalCalculated').val(totalCal);
	$j('#totalActual').val(totalAct);
};


function addRow(tableID) {	
	numDetails++;
	var s = '<td><select id = "c' + numDetails + '" class = "category" name = "c' + numDetails + '"><option value="SELECT" selected = "selected">--SELECT--</option></select></td>';
	s += '<td><select id="i' + numDetails + '"  class = "item" style="min-width: 150px; max-width: 150px;" name="i' + numDetails + '"/></select></td>';
	s += '<td><select id="u' + numDetails + '"><option value="0">---SELECT---</option><option value="1">Kilograms</option><option value="2">Count</option></select></td>';
	s += '<td align="center"><input type="text"  name="q' + numDetails + '" id="q' + numDetails + '" class = "q" size="4" /></td>';
    s += '<td align="center"><input type="text"  name="unit_val' + numDetails + '" id="unit_val' + numDetails + '" class = "unit_val" size="4"/></td>';
	s += '<td><input type="text"  name="cal_val' + numDetails + '" id="cal_val' + numDetails + '" size="4" class = "cal_val" disabled/></td>';
	s += '<td><input type="text"  name="actual_value' + numDetails + '" id="actual_value' + numDetails + '" class = "actual_value" size="4"/></td>';
	s += '<td><input type="button" id = "d'+numDetails+'" class = "deleteRow" value="Remove" /> </td>';
	row_Id.push(numDetails.toString());
	console.log(row_Id);
	$j('#dataTable').append('<tr id = "R' + numDetails+'">'+ s +'</tr>');	
	select();
};

function deleteRow(id) {
	if(id != 1) {
		$j('#R' + id).remove();
		index = row_Id.indexOf(id);
		row_Id.splice(index, 1);
		calculateTotal();
		console.log(row_Id);
		console.log(row_Id.length);
	}
};

function select() {
	var id = numDetails;
	$j.ajax({
		type: 'POST',
		url: 'db_functions.php',
		data: { mode: 'CATEGORY'},
		dataType: "json"
	}).done(function( returnData ) {
		var category_List = returnData.Message.split(';');
		for(var i = 0; i < category_List.length - 1; i++) {
			var category = category_List[i].split(',');
			$j('#c' + id).append('<option value = "' + category[0] + '">' + category[1] + '</option>');
			var list = {};
			$j('#c'+ id +' option').each(function () {
				if(list[this.text]) {
					$j(this).remove();
				} else {
					list[this.text] = this.value;
				}
			});
		}
	});
};

function submitDonation() {
	var user_Id = $j('#donors_list').val();
	console.log(user_Id);
	message = "";
	for(var i = 0; i < row_Id.length; i++) {
		var num = parseInt(row_Id[i]);
		console.log('donor: '+ user_Id+', dateofdonation: '+$j('#opp_date').val()+', placeofdonation: '+$j('#placeofdonation').val()+', city: '+$j('#city').val()+', item_id: '+$j('#i'+num).val()+', donationunit: '+$j('#u'+num).val()+', donationquantity: '+$j('#q'+num).val()+', donationunitvalue: '+$j('#unit_val'+num).val()+', donationcalculatedvalue: '+$j('#cal_val'+num).val()+', donationvalue: '+$j('#actual_value'+num).val());
		$j.ajax({
			async: false,
			type: 'POST',
			url: 'db_functions.php',
			data: { mode: 'SUBMIT', donor: user_Id, dod: $j('#opp_date').val(), placeofdonation: $j('#placeofdonation').val(), city: $j('#city').val(), item_id: $j('#i'+num).val(), unit: $j('#u'+num).val(), quantity: $j('#q'+num).val(), unit_val: $j('#unit_val'+num).val(), cal_val: $j('#cal_val'+num).val(), actual_value: $j('#actual_value'+num).val()},
			dataType: "json"
		}).done(function( returnData ) {
			message = returnData.Message;
		});
	}
	alert("Data submitted!");
	window.location.href = "update_waste.php" ;
};

$j(document).ready(function() {

	
	$j("#opp_date").datepicker();
	select();
	row_Id.push("1");
		
	$j(document).on('input', '.q', function(e){
		var id = $j(this).attr('id');
		id = id.substring(1);
		if($j('#q' + id).val() > 0 && $j('#q' + id).val() < 99999999 && $j('#unit_val' + id).val() > 0 && $j('#unit_val' + id).val() < 99999999 ) {
			$j('#cal_val' + id).val($j('#q' + id).val() * $j('#unit_val' + id).val());
			$j('#actual_value' + id).val($j('#q' + id).val() * $j('#unit_val' + id).val());
			calculateTotal();
		} else {
			$j('#cal_val' + id).val('');
			$j('#actual_value' + id).val('');
		}
	});
	
	$j(document).on('input', '.actual_value', function(e) {
		calculateTotal();
	});
	
	$j(document).on('input', '.unit_val', function(e) {
		var id = $j(this).attr('id');
		id = id.substring(8);
		if($j('#q' + id).val() > 0 && $j('#q' + id).val() < 99999999 && $j('#unit_val' + id).val() > 0 && $j('#unit_val' + id).val() < 99999999 ) {
			$j('#cal_val' + id).val($j('#q' + id).val() * $j('#unit_val' + id).val());
			$j('#actual_value' + id).val($j('#q' + id).val() * $j('#unit_val' + id).val());
			calculateTotal();
		} else {
			$j('#cal_val' + id).val('');
			$j('#actual_value' + id).val('');
		}
	});
	
		
	$j('#donors_list').click(function(){
		$j('#donors_input').val($j('#donors_list option:selected').text());
		console.log($j('#donors_list').val());
		var index = $j.inArray($j('#donors_list').val(), donors_Id);
		console.log(index);
		$j('#phone_number').val(donors_Phone[index]);
		$j('#location').val(donors_City[index]);
		$j('#email_id').val(donors_Email[index]);
		$j('#organization').val(donors_Org[index]);		
	});
	
	$j('input.donors_input').on('input',function(e){
		$j('#donors_list')
			.find('option')
			.remove()
			.end()
		;
		donors_Id = [];
		donors_Names = [];
		donors_Phone = [];
		donors_Email = [];
		donors_City = [];
		donors_Org = [];
		
		$j('#phone_number').val('');
		$j('#location').val('');
		$j('#email_id').val('');
		$j('#organization').val('');		
		var input = $j('#donors_input').val();
		if(input != '') {
			$j.ajax({
				type: 'POST',
				url: 'db_functions.php',
				data: { mode: 'DONORS_LIST', input_text: input},
				dataType: "json"
			}).done(function( returnData ) {
				var donors_List = returnData.Message.split(';');
				for(var i = 0; i < donors_List.length - 1; i++) {
					var donor = donors_List[i].split(',');
					donors_Id[i] = donor[0];
					donors_Names[i] = donor[1];
					donors_Phone[i] = donor[2];
					donors_Email[i] = donor[3];
					donors_City[i] = donor[4];
					donors_Org[i] = donor[5];
					$j('#donors_list').append('<option value = "'+ donor[0]+'" >'+ donor[1] + ', ' + donor[3] + ', ' + donor[4] + ', ' + donor[5] + ', ' + donor[2] + '</option>');
					var list = {};
					$j('#donors_list').each(function () {
						if(list[this.text]) {
							$(this).remove();
						} else {
							list[this.text] = this.value;
						}
					});
				}
			});
		} else {
			 $j('#donors_list')
				.find('option')
				.remove()
				.end()
			;
			$j('#phone_number').val('');
			$j('#location').val('');
			$j('#email_id').val('');
			$j('#organization').val('');	
		}
	});
	
	$j('.deleteRow').on('click', function() {
		var row = $j(this).attr('id');
		var id = row.substring(1);
		deleteRow(id);
	});
	
	$j('.category').on('click', function() {
		var category = $j(this).attr('id');
		var id = category.substring(1);
		var category_id = $j('#' + category).val();
		if(category_id != 'SELECT') {
			$j.ajax({
				type: 'POST',
				url: 'db_functions.php',
				data: { mode: 'ITEM', category_id: category_id},
				dataType: "json"
			}).done(function( returnData ) {
				$j('#i' + id)
					.find('option')
					.remove()
					.end()
				;
				var item_List = returnData.Message.split(';');
				for(var i = 0; i < item_List.length - 1; i++) {
					var item = item_List[i].split(',');
					$j('#i' + id).append('<option value = "' + item[0] + '">' + item[1] + '</option>');
					var list = {};
					$j('#i' + id +' option').each(function () {
						if(list[this.text]) {
							$(this).remove();
						} else {
							list[this.text] = this.value;
						}
					});
				}
			});
		} else {
			$j('#i' + id)
				.find('option')
				.remove()
				.end()
			;
			$j('#i' + id).append('<option value = "SELECT">--SELECT--</option>');
		}
	});	
});