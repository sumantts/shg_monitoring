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
  
  $data_saved = 0;
  for($i = 0; $i < sizeof($attendance_text); $i++){
    if($attendance_text[$i] > 0){
      $MeetingDt = $collectionDate[$i];
      $StfId = $_SESSION["StfId"];
      $MemId = $my_id[$i];
      //echo 'MemId: '.$MemId[$i];
      $Attendance = 1;
      $CollAmt = $CAmt[$i];

      //Insert Meeting data
      $query = "CALL usp_InsertMeetingData('".$MeetingDt."', '".$StfId."', '".$GroupId."', '".$MemId."', '".$Attendance."', '".$CollAmt."')";
      mysqli_multi_query($con, $query);
      $data_saved++;      
    }//end if
  }//end for

  //header("location:?p=meeting-data&save=ok&data_saved=$data_saved");
  ?>
  <script>
    window.location.href = '?p=meeting-data&save=ok&data_saved=<?=$data_saved?>&MeetingDt=<?=$MeetingDt?>&GrpSBAc=<?=$GrpSBAc?>';
  </script>
  <?php

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
                    <form class="form-sample">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Interest Receipt Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="intRcptDate" name="intRcptDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label text-danger" id="intRcptDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="intRcptDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Group S/B A/c No*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="groupAcNo" class="form-control" />
                              <span class="col-form-label text-danger" id="groupAcNo_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="groupAcNo_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                          <button type="button" id="getGroupMembers" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    <div id="part_two" style="display: none;">
                      <p class="card-description" id="interestAmount">Interest Amount: </p>
                      
                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action="">
                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                            <input type="hidden" name="GroupId" id="GroupId" value="">
                            <input type="hidden" name="GrpSBAc" id="GrpSBAc" value="">
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