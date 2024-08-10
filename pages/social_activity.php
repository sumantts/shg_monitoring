<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

if(isset($_POST['saveSocialActivity'])){
  $ActivityDt = $_POST['ActivityDt'];
  $StfId = $_SESSION["StfId"];
  $Activity_Id = $_POST['Activity_Id'];
  $noOfActivity = $_POST['noOfActivity'];
  $EntSl = $_POST['EntSl'];

  if(sizeof($ActivityDt) > 0){
  
  $data_saved = 0;
  for($i = 0; $i < sizeof($ActivityDt); $i++){    
    $activity_date = $ActivityDt[$i];  
    $ActvityId = $Activity_Id[$i]; 
    $activity_number = $noOfActivity[$i];
    $entry_serial = $EntSl[$i];


    //Insert Meeting data
    $query = "CALL usp_InsertActivityData('".$activity_date."', '".$StfId."', '".$ActvityId."', '".$activity_number."', '".$entry_serial."')";
    mysqli_multi_query($con, $query);
    $data_saved++;     
  }//end for 
  ?>
  <script>
   window.location.href = '?p=social-activity&save=ok&data_saved=<?=$data_saved?>';
  </script>
  <?php
  }else{?>
    <script>
    alert('Staff Id or Group ID missing.');
   </script>
  <?php }
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
                    <form class="form-sample" >
                      <!--<p class="card-description"> Personal info </p>-->
                        <div class="row">
                          <div class="col-md-4 mr-2">
                            <div class="form-group row">
                              <label class="text-danger">For the month*</label> 
                                <input type="date" id="activityDate" value="<?=date('Y-m-d')?>" class="form-control" />
                                <span class="col-form-label  text-danger" id="activityDate_error" style="font-size: 12px;"></span>
                                <span class="col-form-label  text-success" id="activityDate_success" style="font-size: 12px;"></span>
                              
                            </div>
                          </div>
                        </div>

                        <div class="row">                          
                          <div class="col-md-2">
                            <div class=" mb-2">
                              <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                              <button type="button" id="getActivityData" class="btn btn-inverse-success btn-fw">Show</button>
                            </div>
                          </div>                        
                        </div> 
                    </form>

                    <div id="part_two" style="display: none;"> 
                      
                      <div class="table-responsive-sm" id="table_1" style="display: none;">
                        <form name="form1" id="form1" method="POST" action=""  onsubmit="return validateForm()">
                          <table class="table table-bordered" id="myTable">
                            <thead>
                              <tr>
                                <td scope="col" style="text-align: center;">SL#</td>
                                <td scope="col" style="text-align: center;">Activity Name</td>
                                <td scope="col" style="text-align: center;">No. of Activity</td> 
                              </tr>
                            </thead>
                            <tbody id="activity_list">
                            </tbody>
                          </table>

                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                            <input type="hidden" name="GroupId" id="GroupId" value="">
                            <input type="hidden" name="GrpSBAc" id="GrpSBAc" value="">
                            <input type="hidden" name="meetingTypeName" id="meetingTypeName" value="Normal">
                              <input type="submit" name="saveSocialActivity" id="saveSocialActivity" class="btn btn-inverse-success btn-fw" value="Save">
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
              return true;
              /*$GroupId = $('#GroupId').val();              
              if ($GroupId == "") {
                alert("GroupId Missing");
                return false;
              }else{            
                return true;
              } */ 
            }
          </script>
          
    <?php include('common/footer.php');?>