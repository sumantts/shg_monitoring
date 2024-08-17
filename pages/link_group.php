<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

//Get GP Name
$allGP = array();
$query2 = "CALL usp_GetGPList()";
mysqli_multi_query($con, $query2);
do {
  /* store the result set in PHP */
  if ($result2 = mysqli_store_result($con)) {
    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
      //printf("%s\n", $row[0]);
      $GpId = $row2['GpId'];
      $GpNm = $row2['GpNm'];  

      if($GpId != ''){
        $allGP_obj = new stdClass();
        
        $allGP_obj->GpId = $GpId; 
        $allGP_obj->GpNm = $GpNm; 

        array_push($allGP, $allGP_obj);
      }
    }
  }
  /* print divider */
  if (mysqli_more_results($con)) {
    //printf("-----------------\n");
  }
} while (mysqli_next_result($con));
/* execute multi query */  
//echo json_encode($allGP);

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
                            <label class="col-sm-4 col-form-label text-danger">Group S/B A/c No*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="groupAcNo" name="groupAcNo" class="form-control" />
                              <span class="col-form-label text-danger" id="groupAcNo_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="groupAcNo_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                          <button type="button" id="linkGroupShow" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    <div id="part_two" style="display: none;">
                      <p class="card-description" id="lg_GroupName">Group Name: </p>
                      <p class="card-description" id="lg_GroupAddress">Group Address: </p>
                      
                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action="">
                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                            <input type="hidden" name="GroupId" id="GroupId" value="">
                            <input type="hidden" name="GrpSBAc" id="GrpSBAc" value="">
                            <button type="button" name="linkGroupSave" id="linkGroupSave" class="btn btn-inverse-success btn-fw">Link Up</button>
                            <button type="button" name="unLinkGroupSave" id="unLinkGroupSave" class="btn btn-inverse-success btn-fw">Un-Link</button>
                            </div>
                          </div>
                        </form>
                      </div>

                      <!-- Start GP & Samsad -->
                      <div class="row mt-4">

                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label class="text-danger">GP Name*</label>                             
                              <select id="gpName" class="form-control">
                                <option value="0">Select</option> 
                                <?php if(sizeof($allGP) > 0){
                                  for($i = 0; $i < sizeof($allGP); $i++){?>
                                  <option value="<?=$allGP[$i]->GpId?>"><?=$allGP[$i]->GpNm?></option> 
                                <?php
                                }}
                                ?>
                              </select>
                              <span class="col-form-label  text-danger" id="gpName_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="gpName_success" style="font-size: 12px;"></span>                             
                          </div>
                        </div>  

                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label class="text-danger">Sansad Name*</label>                             
                              <select id="samsadName" class="form-control">
                                <option value="0">Select</option> 
                              </select>
                              <span class="col-form-label  text-danger" id="samsadName_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="samsadName_success" style="font-size: 12px;"></span>                             
                          </div>
                        </div>  

                        <div class="col-md-3">
                          <div class="mt-4"> 
                          <button type="button" id="UpdtGroupSansad" class="btn btn-inverse-success btn-fw">Update</button>
                          </div>
                        </div>

                      </div>
                      <!-- End GP & Samsad -->


                    </div>

                    <div id="part_three" style="display: none"> <h4>Sorry! No Record found</h4></div>

                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>