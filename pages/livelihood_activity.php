<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

if(isset($_POST['insertMeetingData'])){
  $CAmt = $_POST['CAmt'];
  $collectionDate = $_POST['collectionDate'];
  $GroupId = $_POST['GroupId'];
  $my_id = $_POST['my_id'];
  $attendance = $_POST['attendance'];
  $attendance_text = $_POST['attendance_text'];
  $GrpSBAc = $_POST['GrpSBAc'];
  $sub_total = $_POST['sub_total'];
  $MeetType = $_POST['meetingTypeName'];

  $StfId = $_SESSION["StfId"];
  
  if($StfId > 0 && $GroupId > 0){
  
  $data_saved = 0;
  for($i = 0; $i < sizeof($attendance_text); $i++){    
      $MeetingDt = $collectionDate[$i];
      $MemId = $my_id[$i];
      //echo 'MemId: '.$MemId[$i];
      if($attendance_text[$i] > 0){
        $Attendance = true;
      }else{
        $Attendance = false;
      }
      $CollAmt = $CAmt[$i];

      //Insert Meeting data
     $query = "CALL usp_InsertMeetingData('".$MeetingDt."', '".$StfId."', '".$GroupId."', '".$MemId."', '".$Attendance."', '".$CollAmt."', '".$MeetType."')";
      mysqli_multi_query($con, $query);
      $data_saved++;     
  }//end for
       

  //Insert Voucher VouPurpId=1
  if($sub_total > 0){
    $VouPurpId = 1;
    $query_2 = "CALL usp_InsertVoucher('".$GroupId."', '".$MeetingDt."', '".$VouPurpId."', '".$sub_total."')";
    mysqli_multi_query($con, $query_2);     

    //Insert Voucher VouPurpId=6
    /*$VouPurpId = 6;
    echo $query_3 = "CALL usp_InsertVoucher('".$GroupId."', '".$MeetingDt."', '".$VouPurpId."', '".$sub_total."')";
    mysqli_multi_query($con, $query_3);*/
  }//end if

  //header("location:?p=meeting-data&save=ok&data_saved=$data_saved");
  ?>
  <script>
   window.location.href = '?p=meeting-data&save=ok&data_saved=<?=$data_saved?>&MeetingDt=<?=$MeetingDt?>&GrpSBAc=<?=$GrpSBAc?>';
  </script>
  <?php
  }else{?>
    <script>
    alert('Staff Id or Group ID missing.');
   </script>
  <?php }
}//end form submit

if(isset($_GET['data_saved'])){
  if($_GET['data_saved'] > 0){
    $MeetingDt = $_GET['MeetingDt'];
    $GrpSBAc = $_GET['GrpSBAc'];
    ?>
    <script>
      window.location.href = '?p=meeting-data-report&MeetingDt=<?=$MeetingDt?>&GrpSBAc=<?=$GrpSBAc?>';
    </script>
    <?php    
  }
}//end if

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
                    <form class="form-sample" >
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">
                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label class="text-danger">Collection Date*</label> 
                              <input type="date" id="collectionDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label  text-danger" id="collectionDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="collectionDate_success" style="font-size: 12px;"></span>
                             
                          </div>
                        </div>

                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label class="text-danger">Savings A/c. No.*</label>                             
                              <input type="tel" id="groupCode" class="form-control" />
                              <span class="col-form-label  text-danger" id="groupCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="groupCode_success" style="font-size: 12px;"></span>                             
                          </div>
                        </div>
                        
                        <div class="col-md-2 mt-4">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                            <button type="button" id="getLivelihoodActivity" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>

                      </div> 
                    </form>

                    <div id="part_two" style="display: none;">
                      <p class="card-description" id="GrpNm">Group Name: </p>
                      <p class="card-description" id="GrpAdd">Group Address: </p>
                      
                      <div class="table-responsive-sm" id="table_1" style="display: none;">
                        <form name="form1" id="form1" method="POST" action=""  onsubmit="return validateForm()">
                          <table class="table table-bordered" id="myTable">
                            <thead>
                              <tr>
                                <td scope="col" style="text-align: center;">SL#</td>
                                <td scope="col" style="text-align: center;">Member Code</td>
                                <td scope="col" style="text-align: center;">Member Name</td>
                                <td scope="col" style="text-align: center;">Activity 1 </td>
                                <td scope="col" style="text-align: center;">Amount </td>
                                <td scope="col" style="text-align: center;">Activity 2 </td>
                                <td scope="col" style="text-align: center;">Amount </td>
                              </tr>
                            </thead>
                            <tbody id="group_members_list">
                            </tbody>
                          </table>

                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                            <input type="hidden" name="GroupId" id="GroupId" value="">
                            <input type="hidden" name="GrpSBAc" id="GrpSBAc" value="">
                            <input type="hidden" name="meetingTypeName" id="meetingTypeName" value="Normal">
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

          <script>
            function validateForm(){
              $GroupId = $('#GroupId').val();              
              if ($GroupId == "") {
                alert("GroupId Missing");
                return false;
              }else{            
                return true;
              }  
            }
          </script>
          
    <?php include('common/footer.php');?>