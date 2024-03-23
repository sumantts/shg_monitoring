<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');
//usp_GetStaffName

//Get Staff Name
$staff_names = array();

$query3 = "CALL usp_GetStaffName()";
mysqli_multi_query($con, $query3);
do {
  if ($result3 = mysqli_store_result($con)) {
    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
      $Id = $row3['Id'];
      $Name = $row3['StfNm'];

      if($Id != ''){
        $staff_name = new stdClass();
        
        $staff_name->Id = $Id; 
        $staff_name->Name = $Name;

        array_push($staff_names, $staff_name);
      }
    }
  }
  if (mysqli_more_results($con)) {
  }
} while (mysqli_next_result($con));
  
//echo json_encode($staff_names);

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
                    <form class="form-sample" name="form1" id="form1" method="POST" action="pages/csv.php" target="_blank">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Collection Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="meetingDate" name="meetingDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label  text-danger" id="collectionDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="collectionDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">FO Name*</label>
                            <div class="col-sm-8">
                              <select id="fieldOffices" name="fieldOffices" class="form-control" >
                                <option value="0">Select</option>
                                <?php
                                if(sizeof($staff_names) > 0){
                                  for($g = 0; $g < sizeof($staff_names); $g++){
                                    ?>
                                    <option value="<?=$staff_names[$g]->Id?>" style="font-size: 16px;"><?=$staff_names[$g]->Name?></option>                                  
                                    <?php
                                  }
                                }
                              ?>
                              </select>
                              <span class="col-form-label text-danger" id="fieldOffices_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="fieldOffices_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                          <input type="submit" id="getMeetingData" name="getMeetingData" class="btn btn-inverse-success btn-fw" value="Download">
                          </div>
                        </div>
                      </div> 
                    </form>

                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>