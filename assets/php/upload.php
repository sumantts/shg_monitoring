<?php

include('sql_conn_app.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");

$returnMessage = array();
$status = true;
$error_msg = "";

$staffId = $_POST["staffId"];
$uploaddata = json_decode($_POST["uploaddata"]);

for($i = 0; $i < sizeof($uploaddata); $i++){
    if($uploaddata[$i]->prodName == 'SAVINGS'){
        //USP_Savings_Collection
        $history = $uploaddata[$i]->history;
        $accNo = $uploaddata[$i]->accNo;
        $mobNo = $uploaddata[$i]->mobNo;

        for($j = 0; $j < sizeof($history); $j++){
            $amount = $history[$j]->amount;
            $transType = $history[$j]->transType;
            
            //Start SP
            $param1 = $staffId; //usrID
            $param2 = $accNo;
            $param3 = $transType; //transType 'D' / 'W';
            $param4 =  $amount; //transAmt
            $param5 = ''; 
            $param6 = ''; 
            $ContNo = $mobNo; //ContNo

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
            }else{
                $status = false;	
                $error_msg .= " upload failed...";	
            }
            //End SP
            $history[$j]->transStatus = $status;            
        }//end for

    }else{
        //echo 'USP_Loan_Collection';
        $history = $uploaddata[$i]->history;
        $accNo = $uploaddata[$i]->accNo;
        $mobNo = $uploaddata[$i]->mobNo;

        for($k = 0; $k < sizeof($history); $k++){
            $amount = $history[$k]->amount;

            $param1 = $staffId; //usrID
            $param2 = $accNo; //accountNo
            $param3 = $amount;
            $param4 = '123456'; //SmsCd
            $param5 = '';

            $sql = "{call dbo.USP_Loan_Collection(?,?,?,?,?)}";

            $params = array($param1, $param2, $param3, $param4, $param5); 

            if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
                //echo "Statement prepared.<br><br>\n"; 
            } else {  
                //echo "Statement could not be prepared.\n";  
                //die(print_r(sqlsrv_errors(), true));  
                $status = false;
                //$error_msg .= " Statement could not be prepared";
            } 
            
            $res = sqlsrv_execute( $stmt );			
            if($res == 1){
                $status = true;
            }else{
                $status = false;
                //$return_result['message'] = 'Loan Collection Problem';		
            }
            $history[$k]->transStatus = $status;
        }//end for
    }//end if
}//end for

$returnMessage['status'] = $status;
$returnMessage['error_msg'] = $error_msg;
$returnMessage['aftrUploaData'] = $uploaddata;

sleep(2);
echo json_encode($returnMessage);

    