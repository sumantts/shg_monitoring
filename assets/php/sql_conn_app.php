<?php
//phpinfo();die/;

$servername = "192.168.1.30\BCC";
$conninfo = array("Database"=>"MPower_Pioneer_Test", "UID"=>"sa","PWD"=>"admin@123");
$conn = sqlsrv_connect($servername,$conninfo);


if ($conn) {
	//echo "SQL Server connection Success";
} else {
	echo "SQL Server connection Failed";
    echo "<pre>";
	die( print_r( sqlsrv_errors(), true)); 
}
session_start();
error_reporting(0);

/******
$sql = "SELECT  TOP 10 * from Mst_Staff";
$stmt = sqlsrv_query($conn,$sql);

if($stmt === false)
{
	die("ERROR");
}

while($row = sqlsrv_fetch_Array($stmt,SQLSRV_FETCH_ASSOC))
{
	echo $row["Staff_Name"]."<br>";
}

// exit();



$param1 = '9876543210';
$param2 = '98765';

$sql = "{call dbo.USP_Validate_User(?,?)}";

$params = array($param1, $param2); 

if ($stmt = sqlsrv_prepare($conn, $sql, $params)) {
    echo "Statement prepared.<br><br>\n";  

} else {  
    echo "Statement could not be prepared.\n";  
    die(print_r(sqlsrv_errors(), true));  
} 

if( sqlsrv_execute( $stmt ) === false ) {

    die( print_r( sqlsrv_errors(), true));

}else{

echo "</br>";

    print_r(sqlsrv_fetch_array($stmt));

}

*************/

?>
