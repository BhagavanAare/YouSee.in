<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- This is a pagination script using Jquery, Ajax and PHP
     The enhancements done in this script pagination with first,last, previous, next buttons -->

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
        <title>Edit Volunteer Activity</title>
         
		 <script type="text/javascript" src="scripts/EditDeletePage.js"></script> 
 <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" href="scripts/jquery-ui.css">

  <link rel="stylesheet" type="text/css" href="test/test.css"> 
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/jquery.ui.core.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
    <script src="scripts/gen_validatorv4.js"></script>
	<script type="text/javascript" src="scripts/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>


        
        <style type="text/css">
            
            #loading{
                width: 100%;
                position: absolute;
                top: 100px;
                left: 100px;
				margin-top:200px;
				align:center;
            }
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            #container .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 5px 0 5px 0;
                color: #000;
                font-size: 13px;
            }

            #container .pagination{
                width: 800px;
                height: 25px;
            }
            #container .pagination ul li{
                list-style: none;
                float: left;
                border: 1px solid #006699;
                padding: 2px 6px 2px 6px;
                margin: 0 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #006699;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container .pagination ul li:hover{
                color: #fff;
                background-color: #006699;
                cursor: pointer;
            }
			.go_button
			{
			background-color:#f2f2f2;border:1px solid #006699;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:relative;margin-top:-1px;
			}
			.total
			{
			      font-family:arial;color:#999;
			}
			.editbox
			{
			display:none;
			
			}
			.editbox
			{
			padding:1px;
			width: 80px;
			text-align:center;

			}
			
			
			
			
			

        </style>
	<script type="text/javascript">
		$(function() {
		$(".Date1").datepicker();
		$(".Time1").timeEntry();
		});
		
		   
	</script>
    </head>
    <body>
	



        
		
		
<body> 

<div id="loading"></div>
 <div id="container"></div>
 
<!--<div style="margin-top:30px"> 
<span style="color:#cc0000">Note</span>: Demo no database connectivity 
</div>--> 
		
    </body>
</html>
