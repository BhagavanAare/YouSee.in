<?php
	if($_POST['mode'] == 'GET') {
		session_start();
		$_SESSION['certificates'] = $_POST['keys'];
		$_SESSION['amounts'] = $_POST['values'];
		
		echo json_encode(array('Result' => 1, 'Message' => $_SESSION['amounts'] . $_SESSION['certificates'] . 'Done!'));
	} 