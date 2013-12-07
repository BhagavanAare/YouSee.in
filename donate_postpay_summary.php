<?php session_start();?>
<?php $thispage = "uccertificates";
$thisdiv="donations_summary"; ?>
<!DOCTYPE HTML">
<HTML lan="en">
 	<HEAD>
		<TITLE>Donate PostPay | UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="scripts/jquery.min.js"></script>		
		<script src="scripts/jquery.blockUI.js"></script>		
		<script>
				$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
		</script>
		  <style>
		  label {
		    display: inline-block;
		    width: 5em;
		  }
		  .data:hover{
			-moz-box-shadow: 0 0 3px #666;
			-webkit-box-shadow: 0 0 3px #666;
			box-shadow: 0 0 3px #666;
		}
		  </style>
  	</HEAD>
 	<BODY >
 		
		<!--wrapper begin-->
		<div id="wrapper" >

			<!--header and navbar -->
			<?php include 'header_navbar.php';?>
			<!--maincontentarea begin-->
			<div id="uccertificate-main">
				<div id="options" style="display: inline-block; float: left; width: 15%; height: auto; padding: 10px; background: white;">
					<?php include "donate_postpay_leftnav.php"; ?>
				</div>

				<div id="data" style="display: inline-block; width: 78%; height: auto; padding: 12px; margin-left: 24px; border: 0; border-left: 1px solid lightgrey;">

<?php					
include_once 'Highchart.php';

$chart = new Highchart(Highchart::HIGHSTOCK);
require_once "prod_conn.php";
$query="SELECT UNIX_TIMESTAMP( payment_date ) *1000 AS dateUTC, SUM( instrument_amount ) instrument_amount
FROM payments
GROUP BY  MONTH( payment_date ),YEAR(payment_date)
ORDER BY dateUTC ASC  ";
$result=mysql_query($query);
$data="[";
while($row=mysql_fetch_array($result)){
	$data.="[$row[dateUTC],$row[instrument_amount]],";
}
$data=substr($data,0,-1);
$data.="]";

?>

<html>
    <head>
        <title>Spline</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        foreach ($chart->getScripts() as $script) {
            echo '<script type="text/javascript" src="' . $script . '"></script>';
        }
        ?>
    </head>
    <body>
	<script type="text/javascript">
           $(function() {

		// Create the chart
		$('#container').highcharts('StockChart', {
		    chart: {
		    },
			title: {
							text: 'Postpay Donations - Monthly'
			},
			yAxis: {
			type: 'datetime',
	        tickInterval: 12
			},
			 credits: {
				enabled: false
			},
		    rangeSelector: {
				enabled : true,
				inputDateFormat:"%b,%Y",
				inputEditDateFormat:"%Y-%m",
		        selected: 4
		    },
	    xAxis: {
        	type: 'datetime',
        	dateTimeLabelFormats: {
				second: '%Y-%m-%d<br/>%H:%M:%S',
				minute: '%Y-%m-%d<br/>%H:%M',
				hour: '%d %b<br />%Y',
				day: '%d %b<br />%Y',
				week: '%d %b<br />%Y',
				month: '%b,%Y',
				year: '%Y'
			},
			tickInterval: 1 * 30 * 24 * 3600 * 1000,
			ordinal:false
    	},
		yAxis: {
			minPadding: 0, 
			maxPadding: 0,         
			min: 0, 
			showLastLabel:false
		},
		series: [{
		        name: 'Donation Amount',
		        data: <?php echo $data; ?>,
		        type: 'line',
		        tooltip: {
		        	valueDecimals: 0
		        },
				 dataGrouping: {
                    dateTimeLabelFormats: {
                        day: ['%d %b,%y'],
                        week: ['%d %b,%y'],
                        Month: ['%B,%y'],
						year: ['%b, %Y']
                    }
				}
		    }],
		});
		$("#mbut").click(function(){
			$.ajax({
				type : "POST",
				data : {mode : "month"},
				dataType : "JSON",
				url : "getchartdata.php",
				success : function(data){
						$('#container').highcharts('StockChart', {
							 chart: {
						},
						credits: {
										enabled: false
						},

						rangeSelector: {
							enabled : true,
							selected: 4,
							inputDateFormat:"%b,%Y",
							inputEditDateFormat:"%Y-%m",
						},

						title: {
							text: 'Postpay Donations - Monthly'
						},
						xAxis: {
							type: 'datetime',
							dateTimeLabelFormats: {
								second: '%Y-%m-%d<br/>%H:%M:%S',
								minute: '%Y-%m-%d<br/>%H:%M',
								hour: '%d %b<br />%Y',
								day: '%d %b<br />%Y',
								week: '%d %b<br />%Y',
								month: '%b,%Y',
								year: '%Y'
							},
							tickInterval:  30 * 24 * 3600 * 1000,
							ordinal:false
						},
						yAxis: {
							minPadding: 0, 
							maxPadding: 0,         
							min: 0, 
							showLastLabel:false
						},
							series: [{
								name: 'Donation Amount',
								data: data,
								type: 'line',
								tooltip: {
									valueDecimals: 2
								},
								dataGrouping: {
									dateTimeLabelFormats: {
										day: ['%d %b,%y'],
										week: ['%d %b,%y'],
										Month: ['%B,%y'],
										year: ['%b, %Y']
									}
								}
							}]
					});
				}
			});
		});
		// $("#wbut").click(function(){
			// $.ajax({
				// type : "POST",
				// data : {mode : "week"},
				// dataType : "JSON",
				// url : "getchartdata.php",
				// success : function(data){
						// $('#container').highcharts('StockChart', {
							 // chart: {
						// },
						// credits: {
										// enabled: false
						// },
						// rangeSelector: {
							// enabled : true,
							// selected: 4
						// },

						// title: {
							// text: 'Postpay Donations - Weekly'
						// },
						// xAxis: {
							// type: 'datetime',
							// dateTimeLabelFormats: {
								// second: '%Y-%m-%d<br/>%H:%M:%S',
								// minute: '%Y-%m-%d<br/>%H:%M',
								// hour: '%d %b<br />%Y',
								// day: '%d %b<br />%Y',
								// week: '%d %b<br />%Y',
								// month: '%b,%Y',
								// year: '%Y'
							// },
							// tickInterval:  30 * 24 * 3600 * 1000,
							// ordinal:false
						// },
						// yAxis: {
							// minPadding: 0, 
							// maxPadding: 0,         
							// min: 0, 
							// showLastLabel:false
						// },
							// series: [{
								// name: 'Donation Amount',
								// data: data,
								// type: 'line',
								// tooltip: {
									// valueDecimals: 2
								// },
								// dataGrouping: {
									// dateTimeLabelFormats: {
										// day: ['%d %b,%y'],
										// week: ['%d %b,%y'],
										// Month: ['%B,%y'],
										// year: ['%b, %Y']
									// }
								// }
							// }]
					// });
				// }
			// });
		// });
		$("#qbut").click(function(){
			$.ajax({
				type : "POST",
				data : {mode : "quarter"},
				dataType : "JSON",
				url : "getchartdata.php",
				success : function(data){
						$('#container').highcharts('StockChart', {
							 chart: {
						},
						credits: {
										enabled: false
						},

						rangeSelector: {
							enabled : true,
							selected: 5,
							inputDateFormat:"%b,%Y",
							inputEditDateFormat:"%Y-%m",
						},

						title: {
							text: 'Postpay Donations - Quarterly'
						},
						xAxis: {
							type: 'datetime',
							dateTimeLabelFormats: {
								second: '%Y-%m-%d<br/>%H:%M:%S',
								minute: '%Y-%m-%d<br/>%H:%M',
								hour: '%d %b<br />%Y',
								day: '%d %b<br />%Y',
								week: '%d %b<br />%Y',
								month: '%b,%Y',
								year: '%Y'
							},
							tickInterval:  3 * 30 * 24 * 3600 * 1000,
							ordinal:false
						},
						yAxis: {
							minPadding: 0, 
							maxPadding: 0,         
							min: 0, 
							showLastLabel:false
						},
							series: [{
								name: 'Donation Amount',
								data: data,
								type: 'line',
								tooltip: {
									valueDecimals: 2
								},
								dataGrouping: {
									dateTimeLabelFormats: {
										day: ['%d %b,%y'],
										week: ['%d %b,%y'],
										Month: ['%B,%y'],
										year: ['%b, %Y']
									}
								}
							}]
					});
				}
			});
		});
		$("#ybut").click(function(){
			$.ajax({
				type : "POST",
				data : {mode : "year"},
				dataType : "JSON",
				url : "getchartdata.php",
				success : function(data){
						$('#container').highcharts('StockChart', {
							 chart: {
						},
						credits: {
										enabled: false
						},

						rangeSelector: {
							enabled : false,
							selected: 5
						},

						title: {
							text: 'Postpay Donations - Yearly'
						},
						xAxis: {
							type: 'datetime',
							dateTimeLabelFormats: {
								second: '%Y-%m-%d<br/>%H:%M:%S',
								minute: '%Y-%m-%d<br/>%H:%M',
								hour: '%d %b<br />%Y',
								day: '%d %b<br />%Y',
								week: '%d %b<br />%Y',
								month: '%m,%Y',
								year: '%Y'
							},
							tickInterval:  12 * 30 * 24 * 3600 * 1000,
							ordinal:false
						},
						yAxis: {
							minPadding: 0, 
							maxPadding: 0,         
							min: 0, 
							showLastLabel:false
						},
							series: [{
								name: 'Donation Amount',
								data: data,
								type: 'line',
								tooltip: {
									valueDecimals: 2
								},
								dataGrouping: {
									dateTimeLabelFormats: {
										day: ['%d %b,%y'],
										week: ['%d %b,%y'],
										Month: ['%B,%y'],
										year: ['%Y']
									}
								}
							}]
					});
				}
			});
		});
	});
        </script>
		<span> Group By : </span><input type="button" value="Month" id="mbut" />
		<!-- <input type="button" value="Week" id="wbut" /> -->
		<input type="button" value="Quarter" id="qbut" />
		<input type="button" value="Year" id="ybut" />
        <div id="container"></div>
</div>
    </body>
</html>