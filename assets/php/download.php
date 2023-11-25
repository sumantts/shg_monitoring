<?php

include('sql_conn_app.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");


$returnMessage = array();
$staffId = $_POST["staffId"];
$sql = "{call dbo.USP_DataImport_Offline(?)}";

$params = array($staffId); 

if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
    //echo "Statement prepared.<br><br>\n";  

} else {  
    echo "Statement could not be prepared.\n";  
    die(print_r(sqlsrv_errors(), true));  
} 

if( sqlsrv_execute( $stmt ) === false ) {

    die( print_r( sqlsrv_errors(), true));

}else{
    $array = array();
    
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        //echo $row['Customer_Name'];
        
        $obj = new stdClass();
        $obj->prodType = $row['Prod_Type'];
        $obj->prodName = $row['Prod_Name'];
        $obj->accNo = $row['Account_No'];
        $obj->cusName = $row['Customer_Name'];
        $obj->mobNo = $row['Mobile_No'];
        $obj->balAmt = $row['Balance_Amount'];
        $obj->history = array();

        array_push($array, $obj);

    }
    
    //echo "</br>";

    //print_r(sqlsrv_fetch_array($stmt));

}

$returnMessage['allData'] = $array;
if(sizeof($array)> 1){
    $returnMessage['status'] = true;
}else{
    $returnMessage['status'] = false;
}

sleep(2);
echo json_encode($returnMessage);

/*************/

?>
