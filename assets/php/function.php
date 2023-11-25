<?php
	include('sql_conn.php');
	
	$fn = $_POST["fn"];
	
	//Login function
	if($fn == 'doLogin'){
		$return_result = array();
		$param1 = $_POST["username"];
		$param2 = $_POST["password"];
		$status = false;
		$message = 'Username not match';

		$_SESSION["User_Id"] = 1;
		$return_result['status'] = $status;
		$return_result['message'] = $message;
		
		echo json_encode($return_result);
	}//end function doLogin
	
	//Receipt page function
	if($fn == 'checkAccountNumber'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$account_number = $_POST["account_number"];
		$Staff_Id = $_POST["Staff_Id"];
		$param2 = date('m/d/Y');
		
		$sql = "{call dbo.USP_GetSavings_Demand(?,?)}";

		$params = array($account_number, $Staff_Id); 

		if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
			//echo "Statement prepared.<br><br>\n"; 
		} else {  
			//echo "Statement could not be prepared.\n";  
			//die(print_r(sqlsrv_errors(), true));  
			$status = false;
			$error_msg .= "Statement could not be prepared";
		} 

		if( sqlsrv_execute( $stmt ) === false ) {
			//die( print_r( sqlsrv_errors(), true));
			$error_msg .= " SP Execution error";
		}else{
			$rows = sqlsrv_fetch_array($stmt);
			if(sizeof($rows) > 0){
				$acExists = $rows["AcExists"];
				$return_result["acExists"] = $acExists;
				if($acExists == 0){
					$status = false;
					$error_msg .= " Wrong Account number";	
				}else{
					$status = true;
					$return_result["customer_name"] = $rows["CstNm"];
					$return_result["product_name"] = $rows["PrdNm"];
					$return_result["ContNo"] = $rows["ContNo"];
					if($rows["InstAmt"] > 0){
						$return_result["installment_amount"] = $rows["InstAmt"];
					}else{
						$return_result["installment_amount"] = 0.00;
					}
					if($rows["DmndAmt"] > 0){
						$return_result["demand_amount"] = $rows["DmndAmt"];
					}else{
						$return_result["demand_amount"] = 0.00;
					}
					if($rows["Fine"] > 0){
						$return_result["fine_amount"] = $rows["Fine"];
					}else{
						$return_result["fine_amount"] = 0.00;
					}
					$total_demand = $rows["DmndAmt"] + $rows["Fine"];
					if($total_demand > 0){
						$return_result["total_demand"] = $total_demand;
					}else{
						$return_result["total_demand"] = 0.00;
					}
					$return_result["balance_amount"] = $rows["BalnAmt"];
				}
				$return_result['rows'] = $rows;				
			}else{
				$status = false;
				$error_msg .= " Wrong Account number";		
			}
		}
		
		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		sleep(1);
		echo json_encode($return_result);
	}//end function checkAccountNumber
	
	if($fn == 'receiptSave'){
		$return_result = array();
		$status = false;
		$error_msg = '';
		$smsCode = '';

		$param1 = $_POST["usrID"];
		$param2 = $_POST["accountNo"];
		$param3 = $_POST["transType"];
		$param4 = $_POST["transAmt"];
		$param5 = '';// SMS CODE $_POST["fineAmt"];
		$param6 = '';// Return Message$_POST["newBalanceAmt"];
		$ContNo = $_POST["ContNo"];

		$sql = "{call dbo.USP_Savings_Collection(?,?,?,?,?,?)}";

		$params = array($param1, $param2, $param3, $param4, $param5, $param6); 

		if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
			//echo "Statement prepared.<br><br>\n"; 
		} else {  
			// "Statement could not be prepared.\n";  
			//die(print_r(sqlsrv_errors(), true));  
			$status = false;
			$error_msg .= " Statement could not be prepared";
		} 
		$res = sqlsrv_execute( $stmt );
		if($res == 1){
			$status = true;
			$error_msg .= " Transaction Saved.";
		}else{
			$status = false;
			$error_msg .= " Receipt Insert Problem";		
		}

		//Send SMS From Here
		if($status == true){
			$user = 'BagnanIMahila';
			$pass = 1;
			$sender = 'BMBCCS';
			$phone = $ContNo;//'7980632620';
			//$text = rawurlencode('Your A/c Has Been Credited Rs. '.$param4.' By Cash To A/c No. '.$param2.' - BMBCCS');
			$priority = 'ndnd';
			$stype = 'normal';

			if($param3 == 'D'){
				$curlURl = 'http://bhashsms.com/api/sendmsg.php?user=BagnanIMahila&pass=123456&sender=BMBCCS&phone='.$phone.'&text=Your%20A/c%20Has%20Been%20Credited%20Rs.%20'.$param4.'%20By%20Cash%20In%20A/c%20No.%20'.$param2.'%20-%20BMBCCS&priority=ndnd&stype=normal';
			}else{
				$curlURl = 'http://bhashsms.com/api/sendmsg.php?user=BagnanIMahila&pass=123456&sender=BMBCCS&phone='.$phone.'&text=Your%20A/c%20Has%20Been%20Debited%20Rs.%20'.$param4.'%20To%20Cash%20In%20A/c%20No.%20'.$param2.'%20-%20BMBCCS&priority=ndnd&stype=normal';			
			}

			$curl = curl_init();

			curl_setopt_array($curl, array(

			CURLOPT_URL => $curlURl,

			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			));

			$response = curl_exec($curl);
			if (curl_errno($curl)) {
				$error_msg = curl_error($curl);
				$error_msg .= " SMS Sending Failed: ".$error_msg;
			}else{
				$smsCode = $response;
				$error_msg .= " SMS Sent Successfully: ". $smsCode;
			}
			curl_close($curl);
		}//End SMS Sending block
		
		$return_result['message'] = $error_msg;
		$return_result['status'] = $status;
		$return_result['curlURl'] = $curlURl;

		sleep(2);
		echo json_encode($return_result);
	}//end function receiptSave
	
	//Start Payment page function
	if($fn == 'checkPaymentAccountNumber'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$param1 = $_POST["account_number"];
		$Staff_Id = $_POST["Staff_Id"];
		$param2 = date('m/d/Y');
		
		$sql = "{call dbo.USP_GetSavings_Demand(?,?)}";

		$params = array($param1, $Staff_Id); 

		if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
			//echo "Statement prepared.<br><br>\n"; 
		} else {  
			//echo "Statement could not be prepared.\n";  
			//die(print_r(sqlsrv_errors(), true));  
			$status = false;
			$error_msg .= "Statement could not be prepared";
		} 

		if( sqlsrv_execute( $stmt ) === false ) {
			//die( print_r( sqlsrv_errors(), true));
			$error_msg .= " SP Execution error";
		}else{
			$rows = sqlsrv_fetch_array($stmt);
			if(sizeof($rows) > 0){
				$acExists = $rows["AcExists"];
				$return_result["acExists"] = $acExists;
				if($acExists == 0){
					$status = false;
					$error_msg .= " Wrong Account number";	
				}else{
					 $productname = $rows["PrdNm"];					
					if(strstr($productname, 'Recurring')){	
						$status = false;
						$error_msg .= " Only Savings A/c Allowed";
					}else{
						$status = true;
						$return_result["customer_name"] = $rows["CstNm"];
						$return_result["ContNo"] = $rows["ContNo"];
						$return_result["balance_amount"] = $rows["BalnAmt"];
						$return_result["product_name"] = $rows["PrdNm"];
					}
				}
				$return_result['rows'] = $rows;				
			}else{
				$status = false;
				$error_msg .= " Wrong Account number";		
			}
		}
		
		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		sleep(1);
		echo json_encode($return_result);
	}//end function checkAccountNumber

	if($fn == 'sendOtp'){
		$return_result = array();
		$status = false;
		$error_msg = '';
		
		$param1 = $_POST["accountNo"];
		
		$res = 1;
		if($res == 1){
			$status = true;
			$return_result['message'] = 'OTP Sent to the registered Mobile Number';
		}else{
			$status = false;
			$return_result['message'] = 'Mobile Number Not Found';		
		}
		$return_result['status'] = $status;
		sleep(2);
		echo json_encode($return_result);
	}//end function sendOtp
	
	//End Payment page function
	
	//Loan Page page function Start
	if($fn == 'checkLoanAccountNumber'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$param1 = $_POST["loan_account_number"];
		$Staff_Id = $_POST["Staff_Id"];
		$param2 = date('m/d/Y');
		
		$sql = "{call dbo.USP_GetLoan_Demand(?,?)}";

		$params = array($param1, $Staff_Id); 

		if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
			//echo "Statement prepared.<br><br>\n"; 
		} else {  
			//echo "Statement could not be prepared.\n";  
			//die(print_r(sqlsrv_errors(), true));  
			$status = false;
			$error_msg .= "Statement could not be prepared";
		} 

		if( sqlsrv_execute( $stmt ) === false ) {
			die( print_r( sqlsrv_errors(), true));
			$error_msg .= " SP Execution error";
		}else{
			$rows = sqlsrv_fetch_array($stmt);
			$return_result['rows'] = $rows;
			if(sizeof($rows) > 0){				
				$acExists = $rows["AcExists"];				
				$return_result["acExists"] = $acExists;
				if($acExists == 0){
					$status = false;
					$error_msg .= " Wrong Account number";	
				}else{
					$status = true;
					$return_result["customer_name"] = $rows["CstNm"];
					$return_result["ContNo"] = $rows["ContNo"];
					$return_result["product_name"] = $rows["PrdNm"];					
					$return_result["total_demand"] = $rows["LoanAmt"];
					$return_result["OutsAmt"] = $rows["OutsAmt"];
					$return_result["IntDue"] = $rows["IntDue"];
					$return_result["LastPay"] = $rows["LastPay"];
				}
								
			}else{
				$status = false;
				$error_msg .= " Wrong Account number";		
			}
		}
		
		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		sleep(1);
		echo json_encode($return_result);
	}//end function checkAccountNumber
	
	//check Member Id Start
	if($fn == 'checkMemberId'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$Staff_Id = $_POST["Staff_Id"];
		$User_Id = $_POST["User_Id"];
		$member_Id = $_POST["member_Id"];
		$param2 = date('m/d/Y');
		
		$sql = "{call dbo.USP_GetCustomerDtls(?,?)}";

		$params = array($member_Id, $Staff_Id); 

		if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
			//echo "Statement prepared.<br><br>\n"; 
		} else {  
			//echo "Statement could not be prepared.\n";  
			//die(print_r(sqlsrv_errors(), true));  
			$status = false;
			$error_msg .= "Statement could not be prepared";
		} 

		if( sqlsrv_execute( $stmt ) === false ) {
			die( print_r( sqlsrv_errors(), true));
			$error_msg .= " SP Execution error";
		}else{
			$rows = sqlsrv_fetch_array($stmt);
			//$return_result['rows'] = $rows;
			if(sizeof($rows) > 0){				
				$acExists = $rows["AcExists"];				
				$return_result["acExists"] = $acExists;
				if($acExists == 0){
					$status = false;
					$error_msg .= " Wrong Member Id";	
				}else{
					$status = true;
					$return_result["member_code"] = $rows["CstCd"];
					$return_result["member_name"] = $rows["CstNm"];
					$return_result["org_name"] = $rows["OrgNm"];					
					$return_result["current_date"] = $rows["CurDt"];
					$return_result["staff_name"] = $rows["StfNm"];
				}								
			}else{
				$status = false;
				$error_msg .= " Wrong Member Id";		
			}
		}
		
		//2nd sp start here
		$sql1 = "{call dbo.USP_GetCollCustomer(?,?)}";

		$params1 = array($member_Id, $User_Id); 

		if ($stmt1 = sqlsrv_prepare($conn, $sql1, $params1)) {
			//echo "Statement prepared.<br><br>\n"; 
		} else {  
			//echo "Statement could not be prepared.\n";  
			//die(print_r(sqlsrv_errors(), true));  
			$status = false;
			$error_msg .= "2nd Statement could not be prepared";
		} 

		if( sqlsrv_execute( $stmt1 ) === false ) {
			die( print_r( sqlsrv_errors(), true));
			$error_msg .= " SP Execution error";
		}else{
			$statement = array();
			$net_CrAmt = 0;
			while($rowS = sqlsrv_fetch_Array($stmt1, SQLSRV_FETCH_ASSOC))
			{
				$sl = 1;
				$CrAmt = $rowS['CrAmt'];
				$net_CrAmt = $net_CrAmt + $CrAmt;
				$new_data = new stdClass();
				$new_data->Sl = $sl;
				$new_data->CrAmt = $CrAmt;
				$new_data->Remarks = $rowS['Remarks'];
				
				array_push($statement, $new_data);
				$sl++;
			}
			
			$return_result['statement'] = $statement;
			$return_result['net_CrAmt'] = $net_CrAmt;

			//echo 'Remarks: '.$rows1['Remarks'];
			// if(sizeof($rows1) > 0){				
			// 	$acExists1 = $rows1["AcExists"];				
			// 	$return_result["acExists1"] = $acExists1;
			// 	if($acExists1 == 0){
			// 		$status = false;
			// 		$error_msg .= " Wrong Member Id 2nd";	
			// 	}else{
			// 		$status = true;
			// 		//print_r($rows1);

			// 		//echo '********************';
			// 		for($i = 0; $i < sizeof($rows1); $i++){
			// 			//echo $rows1[$i]['No'].' '.$rows1[$i]['Remarks'].' '.$rows1[$i]['CrAmt'];

			// 		}//end for
			// 		// $return_result["member_code"] = $rows["CstCd"];
			// 		// $return_result["member_name"] = $rows["CstNm"];
			// 		// $return_result["org_name"] = $rows["OrgNm"];					
			// 		// $return_result["current_date"] = $rows["CurDt"];
			// 		// $return_result["staff_name"] = $rows["StfNm"];
			// 	}								
			// }else{
			// 	$status = false;
			// 	$error_msg .= " Wrong Member Id";		
			// }
		}
		//2nd sp end here

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		sleep(1);
		echo json_encode($return_result);
	}//check Member Id End
	
	//save_loan_collection
	if($fn == 'save_loan_collection'){
		$return_result = array();
		$status = false;
		$error_msg = '';
		
		$collection_amount = $_POST['collection_amount'];
		$param1 = $_POST["usrID"];
		$ContNo = $_POST["ContNo"];
		$param2 = $_POST["accountNo"];
		$param3 = $collection_amount;//$_POST["PrnAmt"];
		//$param4 = '';//$_POST["InttAmt"];
		//$param5 = '';//$_POST["BalanceAmt"];
		$param4 = $_POST["SmsCd"];
		$param5 = '';

		$sql = "{call dbo.USP_Loan_Collection(?,?,?,?,?)}";

		$params = array($param1, $param2, $param3, $param4, $param5); 

		if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
			//echo "Statement prepared.<br><br>\n"; 
		} else {  
			//echo "Statement could not be prepared.\n";  
			//die(print_r(sqlsrv_errors(), true));  
			$status = false;
			$error_msg .= " Statement could not be prepared";
		} 
		
		$res = sqlsrv_execute( $stmt );			
		if($res == 1){
			$status = true;

			//Send SMS from here for Loan collection
			if($status == true){
				$user = 'BagnanIMahila';
				$pass = 1;
				$sender = 'BMBCCS';
				$phone = $ContNo;
				$priority = 'ndnd';
				$stype = 'normal';
				
				$curlURl = 'http://bhashsms.com/api/sendmsg.php?user=BagnanIMahila&pass=123456&sender=BMBCCS&phone='.$phone.'&text=Installment%20Amount%20Of%20Rs.%20'.$param3.'%20Received%20Against%20Loan%20A/c%20No.%20'.$param2.'%20-%20BMBCCS&priority=ndnd&stype=normal';
				
				$curl = curl_init();

				curl_setopt_array($curl, array(

				CURLOPT_URL => $curlURl,

				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				));

				$response = curl_exec($curl);
				if (curl_errno($curl)) {
					$error_msg = curl_error($curl);
					$error_msg .= " SMS Sending Failed: ".$error_msg;
				}else{
					$smsCode = $response;
					$error_msg .= " SMS Sent Successfully: ". $smsCode;
				}
				curl_close($curl);
			}//End SMS Sending block

		}else{
			$status = false;
			$return_result['message'] = 'Loan Collection Problem';		
		}

		$return_result['status'] = $status;
		$return_result['sms_status'] = $error_msg;
		sleep(2);
		echo json_encode($return_result);
	}//end function save_loan_collection
	
	//Loan Page page function End
	
?>