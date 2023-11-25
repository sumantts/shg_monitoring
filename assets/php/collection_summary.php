<?php

include('sql_conn_app.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");


$returnMessage = array();
$UsrID = 60;//$_POST["User_Id"];
$CollDt = date('m/d/Y');
$status = true;
$error_msg = "";

$sql = "{call dbo.USP_Dashboard(?,?)}";

    $params = array($UsrID, $CollDt);
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
        $return_result['rows'] = $rows;
        if(sizeof($rows) > 0){				
            $ReceiptNo = $rows["ReceiptNo"];			
            $ReceiptAmt = $rows["ReceiptAmt"];			
            $PaymtNo = $rows["PaymtNo"];			
            $PaymtAmt = $rows["PaymtAmt"];			
            $LoanNo = $rows["LoanNo"];				
            $LoanAmt = $rows["LoanAmt"];		
            $CashBalance = $rows["CashBalance"];
        }else{
            $status = false;
            $error_msg .= " No collection available";		
        }
    }//end 

    $returnMessage['status'] = $status;
    $returnMessage['error_msg'] = $error_msg;
    $returnMessage['ReceiptNo'] = $ReceiptNo;
    $returnMessage['ReceiptAmt'] = $ReceiptAmt;
    $returnMessage['PaymtNo'] = $PaymtNo;
    $returnMessage['PaymtAmt'] = $PaymtAmt;
    $returnMessage['LoanNo'] = $LoanNo;
    $returnMessage['LoanAmt'] = $LoanAmt;
    $returnMessage['CashBalance'] = $CashBalance;

sleep(2);
echo json_encode($returnMessage);

/*************/

?>
