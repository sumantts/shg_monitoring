<?php

include '../assets/php/sql_conn.php';

//Step 1
/*$customers_data = array(
array(
'customers_id' => '1',
'customers_firstname' => 'Chris',
'customers_lastname' => 'Cavagin',
'customers_email' => 'chriscavagin@gmail.com',
'customers_telephone' => '9911223388'
),
array(
'customers_id' => '2',
'customers_firstname' => 'Richard',
'customers_lastname' => 'Simmons',
'customers_email' => 'rsimmons@media.com',
'customers_telephone' => '9911224455'
),
array(
'customers_id' => '3',
'customers_firstname' => 'Steve',
'customers_lastname' => 'Beaven',
'customers_email' => 'ateavebeaven@gmail.com',
'customers_telephone' => '8855223388'
),
array(
'customers_id' => '4',
'customers_firstname' => 'Howard',
'customers_lastname' => 'Rawson',
'customers_email' => 'howardraw@gmail.com',
'customers_telephone' => '9911334488'
),
array(
'customers_id' => '5',
'customers_firstname' => 'Rachel',
'customers_lastname' => 'Dyson',
'customers_email' => 'racheldyson@gmail.com',
'customers_telephone' => '9912345388'
)
);*/

if(isset($_POST['meetingDate'])){
    $meetingDate = $_POST['meetingDate'];
    $StfId = $_POST["StfId"];
    $meeting_rows = array();

    $meeting_date_str = date('d-m-Y', strtotime($meetingDate));
    
    //Get Meeting Data
    $query2 = "CALL usp_GetMeetingData('".$StfId."', '".$meetingDate."')";
    mysqli_multi_query($con, $query2);
    do {
      /* store the result set in PHP */
      if ($result2 = mysqli_store_result($con)) {
        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
          //printf("%s\n", $row[0]);
          $MettingDt = $row2['MettingDt'];
          $StfCd = $row2['StfCd'];
          $GrpCd = $row2['GrpCd'];
          $MemCd = $row2['MemCd'];
          $Attdance = $row2['Attdance'];
          $CollAmt = $row2['CollAmt'];
          $CollDt = $row2['CollDt'];
          
  
          if($MettingDt != ''){
            $meeting_row = [
              'Metting_Date' => $MettingDt,
              'Staff_Code' => $StfCd,
              'Group_Code' => $GrpCd,
              'Member_Code' => $MemCd,
              'Attendance' => $Attdance,
              'Collection_Amount' => $CollAmt,
              'Entered_On' => $CollDt
            ];
  
            array_push($meeting_rows, $meeting_row);
          }
        }
      }
      /* print divider */
      if (mysqli_more_results($con)) {
        //printf("-----------------\n");
      }
    } while (mysqli_next_result($con));

    

//echo json_encode($meeting_rows);
//exit();

//Step 2
// Filter Customer Data
function filterCustomerData(&$str) {
$str = preg_replace("/\t/", "\\t", $str);
$str = preg_replace("/\r?\n/", "\\n", $str);
if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

//Step 3
// File Name & Content Header For Download
$file_name = "meeting_data_$meeting_date_str.xls";
header("Content-Disposition: attachment; filename=\"$file_name\"");
//header("Content-Type: application/vnd.ms-excel");
header('Content-Type: application/csv');

//Step 4
//To define column name in first row.
$column_names = false;
// run loop through each row in $meeting_rows
foreach($meeting_rows as $row) {
    if(!$column_names) {
        echo implode("\t", array_keys($row)) . "\n";
        $column_names = true;
    }
    // The array_walk() function runs each array element in a user-defined function.
    array_walk($row, 'filterCustomerData');
    echo implode("\t", array_values($row)) . "\n";
}
exit;

}//end form submit

?>