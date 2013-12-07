<?php
if(isset($_POST['mode'])){
	if($_POST['mode']=="month"){
		$data=array();
		require_once "prod_conn.php";
		$query="SELECT payment_date AS dateUTC, SUM( instrument_amount ) instrument_amount, CONCAT( 'Quarter', QUARTER( payment_date ) , ',', YEAR( payment_date ) )
		FROM payments
		GROUP BY  MONTH( payment_date ),YEAR(payment_date)
		ORDER BY dateUTC ASC  ";
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result)){
			$data[]=array(strtotime($row['dateUTC'])*1000,intval($row['instrument_amount']));
		}
		echo json_encode($data);
	}
	if($_POST['mode']=="week"){
		$data=array();
		require_once "prod_conn.php";
		$query="SELECT payment_date AS dateUTC, SUM( instrument_amount ) instrument_amount
		FROM payments
		GROUP BY  WEEK( payment_date ),YEAR(payment_date)
		ORDER BY dateUTC ASC  ";
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result)){
			$data[]=array(strtotime($row['dateUTC'])*1000,intval($row['instrument_amount']));
		}
		echo json_encode($data);
	}
	if($_POST['mode']=="quarter"){
		$data=array();
		require_once "prod_conn.php";
		$query="SELECT payment_date AS dateUTC, SUM( instrument_amount ) instrument_amount
		FROM payments
		GROUP BY  QUARTER( payment_date ),YEAR(payment_date)
		ORDER BY dateUTC ASC  ";
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result)){
			$data[]=array(strtotime($row['dateUTC'])*1000,intval($row['instrument_amount']));
		}
		echo json_encode($data);
	}
	if($_POST['mode']=="year"){
		$data=array();
		require_once "prod_conn.php";
		$query="SELECT payment_date AS dateUTC, SUM( instrument_amount ) instrument_amount, CONCAT( 'Quarter', QUARTER( payment_date ) , ',', YEAR( payment_date ) )
		FROM payments
		GROUP BY  YEAR(payment_date)
		ORDER BY dateUTC ASC  ";
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result)){
			$data[]=array(strtotime($row['dateUTC'])*1000,intval($row['instrument_amount']));
		}
		echo json_encode($data);
	}
}
?>