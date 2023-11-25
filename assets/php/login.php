<?php

include('sql_conn_app.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");


$return_result = array();
$param1 = $_POST["username"];
$param2 = $_POST["password"];

$sql = "{call dbo.USP_Validate_User(?,?)}";

$params = array($param1, $param2); 

if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
    //echo "Statement prepared.<br><br>\n"; 
} else {  
    //echo "Statement could not be prepared.\n";  
    die(print_r(sqlsrv_errors(), true));  
} 

//DB Connection end

if( sqlsrv_execute( $stmt ) === false ) {
    die( print_r( sqlsrv_errors(), true));
}else{
    $rows = sqlsrv_fetch_array($stmt);
    //print_r($rows);
    if(sizeof($rows) > 0){
        $status = true;
        $return_result["User_Id"] = $rows["User_Id"];
        $return_result["Staff_Id"] = $rows["Staff_Id"];
        $return_result["Staff_Name"] = $rows["Staff_Name"];
        $return_result['User_Id'] = $rows["User_Id"];
    }else{
        $status = false;
        $return_result['message'] = 'Wrong Username or Password';		
    }

}
$return_result['status'] = $status;

sleep(2);
		
echo json_encode($return_result);

?>
