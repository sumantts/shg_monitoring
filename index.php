<?php
	include('assets/php/sql_conn.php');	
	
	if(isset($_GET["p"])){
	$p = $_GET["p"];
	}else{
		$p = '';
	}
	
	switch($p){
		case 'login':
		include('pages/login.php');
		break;
		
		case 'dashboard':
		$title = "Dashboard";
		include('pages/dashboard.php');		
		break;
		
		case 'receipt':
		$title = "Receipt";
		include('pages/receipt.php');		
		break;
		
		case 'payment':
		$title = "Payment";
		include('pages/payment.php');		
		break;
		
		case 'loan_collection':
		$title = "Loan Collection";
		include('pages/loan_collection.php');		
		break;
		
		case 'mem_collection':
		$title = "View Receipt";
		include('pages/mem_collection.php');		
		break;
		
		default:
		include('pages/login.php');
	}

?>