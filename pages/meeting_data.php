<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

if(isset($_POST['insertMeetingData'])){
  echo json_encode($_POST);
  //exit();

  $CAmt = $_POST['CAmt'];
  $collectionDate = $_POST['collectionDate'];
  $GroupId = $_POST['GroupId'];
  $MemId = $_POST['MemId'];
  $attendance = $_POST['attendance'];
  
  for($i = 0; $i < sizeof($CAmt); $i++){
    if($CAmt[$i] > 0){
      $MeetingDt = $collectionDate[$i];
      $StfId = $_SESSION["StfId"];
      $GroupId = $GroupId[$i];
      $MemId = $MemId[$i];
      $MeetingDt = $collectionDate[$i];
      $MeetingDt = $collectionDate[$i];
    }//end if
  }//end for

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
                    <h4 class="card-title"><?=$title?></h4>
                    <form class="form-sample">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Collection Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="collectionDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label  text-danger" id="collectionDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="collectionDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Enter Group Code*</label>
                            <div class="col-sm-8">
                              <input type="text" id="groupCode" class="form-control" />
                              <span class="col-form-label  text-danger" id="groupCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="groupCode_success" style="font-size: 12px;"></span>
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
                      <p class="card-description" id="GrpNm">Group Name: </p>
                      <p class="card-description" id="GrpAdd">Group Address: </p>
                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action="">
                          <table class="table table-bordered">
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
                              <input type="submit" name="insertMeetingData" id="insertMeetingData" class="btn btn-inverse-success btn-fw" value="Save">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>