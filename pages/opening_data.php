<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

if(isset($_POST['insertMeetingData'])){
  //echo json_encode($_POST);
  //exit();

  $CAmt = $_POST['CAmt'];
  $collectionDate = $_POST['collectionDate'];
  $GroupId = $_POST['GroupId'];
  $my_id = $_POST['my_id'];
  $Opening_Dues = $_POST['Opening_Dues'];
  $caste = $_POST['caste'];
  //$attendance_text = $_POST['attendance_text']; 
  
  $data_saved = 0;
  for($i = 0; $i < sizeof($my_id); $i++){
    $Opening_Dues_Bal = 0;
    //if($CAmt[$i] > 0){
      $MeetingDt = $collectionDate[$i];
      $StfId = $_SESSION["StfId"];
      $MemId = $my_id[$i];
      //echo 'MemId: '.$MemId[$i];
      $Attendance = 1;
      $CollAmt = $CAmt[$i];
      $Opening_Dues_Bal = $Opening_Dues[$i];
      $caste_temp = $caste[$i];

      //Insert Meeting data
      $query = "CALL usp_UpdtMemBalance('".$MemId."', '".$CollAmt."', '".$Opening_Dues_Bal."', '".$caste_temp."')";
      mysqli_multi_query($con, $query);
      $data_saved++;      
    //}//end if
  }//end for

  //header("location:?p=opening-data&save=ok&data_saved=$data_saved");
  ?>
  <script>
    window.location.href = '?p=opening-data&save=ok&data_saved=<?=$data_saved?>';
  </script>
  <?php

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
                      <span class="col-form-label  text-success" style="font-size: 18px;"><?=$_GET["data_saved"]?> Records inserted successfully</span>
                    <?php } }?>
                    
                    <h4 class="card-title"><?=$title?></h4>
                    <form class="form-sample">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <!-- <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">As on  Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="collectionDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label  text-danger" id="collectionDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="collectionDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div> -->
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Savings A/c. No.*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="groupCode" class="form-control" />
                              <span class="col-form-label  text-danger" id="groupCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="groupCode_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                          <button type="button" id="getGroupMembers1" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    <div id="part_two" style="display: none;">
                      <p class="card-description" id="GrpNm">Group Name: </p>
                      <p class="card-description" id="GrpAdd">Group Address: </p>

                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action="">
                          <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-danger">Caste*</label>
                                <div class="col-sm-6">
                                  <select id="caste" name="caste" class="form-control" >
                                    <option value="0">Select</option>
                                    <option value="1">GENERAL</option>
                                    <option value="2">SC</option>
                                    <option value="3">ST</option>
                                    <option value="4">OBC</option>
                                    <option value="5">MINORITY</option>
                                  </select>
                                  <span class="col-form-label  text-danger" id="collectionDate_error" style="font-size: 12px;"></span>
                                  <span class="col-form-label  text-success" id="collectionDate_success" style="font-size: 12px;"></span>
                                </div>
                              </div>
                            </div>
                            
                          <table class="table table-bordered" id="myTable">
                            <thead>
                              <tr>
                                <td scope="col" style="text-align: center;">Member Code</td>
                                <td scope="col" style="text-align: center;">Member Name</td>
                                <td scope="col" style="text-align: center;">Opening Balance</td>
                                <td scope="col" style="text-align: center;">Opening Due</td>
                                <td scope="col" style="text-align: center;">Caste</td>
                              </tr>
                            </thead>
                            <tbody id="group_members_list1">
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