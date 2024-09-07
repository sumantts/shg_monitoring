<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php'); 

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
                            <label class="text-danger">Meeting Date*</label> 
                              <input type="date" id="meetingDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label text-danger" id="meetingDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="meetingDate_success" style="font-size: 12px;"></span>
                            </div>
                        </div>

                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label class="text-danger">GP Name*</label>                             
                              <select id="gpName" class="form-control">
                                <option value="0">Select</option> 
                                <?php if(sizeof($gp) > 0){
                                  for($i = 0; $i < sizeof($gp); $i++){?>
                                  <option value="<?=$gp[$i]->GpId?>"><?=$gp[$i]->GpNm?></option> 
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

                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label class="text-danger">No. of Group Attend*</label>                             
                              <input type="tel" id="noOfGroupAttend" class="form-control" />
                              <span class="col-form-label  text-danger" id="noOfGroupAttend_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="noOfGroupAttend_success" style="font-size: 12px;"></span>                             
                          </div>
                        </div>

                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label class="text-danger">Total Attendant*</label>                             
                              <input type="number" id="totalAttendant" class="form-control" />
                              <span class="col-form-label  text-danger" id="totalAttendant_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="totalAttendant_success" style="font-size: 12px;"></span>                             
                          </div>
                        </div> 

                        <div class="col-md-3 mr-2">
                          <div class="form-group row">
                            <label>Remarks</label>                             
                              <input type="text" id="remarks" class="form-control" />
                              <span class="col-form-label  text-danger" id="remarks_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="remarks_success" style="font-size: 12px;"></span>                             
                          </div>
                        </div>
                        

                      </div>

                        <div class="row">                          
                        <div class="col-md-2">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                            <button type="button" id="saveSamsadMeeting" class="btn btn-inverse-success btn-fw">Save</button>
                          </div>
                        </div>
                      </div> 
                    </form>
                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends --> 
          
    <?php include('common/footer.php');?>