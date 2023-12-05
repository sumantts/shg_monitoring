<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

if(isset($_POST['meetingDate'])){
  $meetingDate = $_POST['meetingDate'];
  $StfId = $_POST["StfId"];
  $meeting_rows = array();

  //echo $meetingDate;
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
            'MettingDt' => $MettingDt,
            'StfCd' => $StfCd,
            'GrpCd' => $GrpCd,
            'MemCd' => $MemCd,
            'Attdance' => $Attdance,
            'CollAmt' => $CollAmt,
            'CollDt' => $CollDt
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
  /* execute multi query */

  //$fields = array('Meeting Date', 'Staff Code', 'Group Code', 'Member Code', 'Attendance', 'Collection Amount', 'Entered On'); 
  //echo json_encode($meeting_rows);
  //header("location:?p=meeting-data&save=ok&data_saved=$data_saved");
  


  $customers_data = array(
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
    );

//Step 2
// Filter Customer Data
  function filterCustomerData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  //Step 3
  // File Name & Content Header For Download
  $file_name = "customers_data.xls";
  header("Content-Disposition: attachment; filename=\"$file_name\"");
  header("Content-Type: application/vnd.ms-excel");
  
  //Step 4
  //To define column name in first row.
  $column_names = false;
  // run loop through each row in $customers_data
  foreach($customers_data as $row) {
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
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include('common/navbar.php');?>
      <!-- partial -->
      <?php include('common/left_menu.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <?php 
                    if(isset($_GET["save"])){
                    if($_GET["save"] == "ok"){?> 
                      <span class="col-form-label  text-success" style="font-size: 18px;"><?=$_GET["data_saved"]?> Data inserted successfully</span>
                    <?php } }?>
                    
                    <h4 class="card-title"><?=$title?></h4>
                    <form class="form-sample" name="form1" id="form1" method="POST" action="pages/download.php" target="_blank">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Meeting Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="meetingDate" name="meetingDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label  text-danger" id="collectionDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="collectionDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Enter Group Code*</label>
                            <div class="col-sm-8">
                              <input type="text" id="groupCode" class="form-control" />
                              <span class="col-form-label  text-danger" id="groupCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="groupCode_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div> -->

                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                          <input type="submit" id="getMeetingData" name="getMeetingData" class="btn btn-inverse-success btn-fw" value="Download">
                          </div>
                        </div>
                      </div> 
                    </form>

                    <div id="part_two" style="display: none;">
                      <p class="card-description" id="GrpNm">Group Name: </p>
                      <p class="card-description" id="GrpAdd">Group Address: </p>
                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action="">
                          <table class="table table-bordered" id="myTable">
                            <thead>
                              <tr>
                                <td scope="col" style="text-align: center;">Member Id</td>
                                <td scope="col" style="text-align: center;">Member Name</td>
                                <td scope="col" style="text-align: center;">Attendance </td>
                                <td scope="col" style="text-align: center;">Collection Amount </td>
                              </tr>
                            </thead>
                            <tbody id="group_members_list">
                              <!-- <tr>
                                <td style="text-align: center;"> </td>
                                <td style="text-align: right;"> </td>
                                <td style="text-align: center;"><input type="checkbox" /></td>
                                <td style="text-align: right;"> </td>
                              </tr>
                              <tr>
                                <td style="text-align: center;"> </td>
                                <td style="text-align: center;">Total </td>
                                <td style="text-align: center;"> </td>
                                <td style="text-align: right;"> </td>
                              </tr> -->
                            </tbody>
                          </table>

                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                            <input type="hidden" name="GroupId" id="GroupId" value="'">
                              <input type="submit" name="insertMeetingData" id="insertMeetingData" class="btn btn-inverse-success btn-fw" value="Save">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>

                    <div id="part_three" style="display: none"> <h4>Sorry! No Record found</h4></div>

                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>