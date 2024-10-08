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
                    <form class="form-sample">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <!-- <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Interest Receipt Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="intRcptDate" name="intRcptDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label text-danger" id="intRcptDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="intRcptDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div> -->
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
                          <button type="button" id="showInterestAmount" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    <div id="part_two" style="display: none;">
                      <p class="card-description" id="ir_GroupName">Group Name: </p>
                      <p class="card-description" id="ir_GroupAddress">Group Address: </p>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Cash Opening Amount*</label>
                            <div class="col-sm-8">
                              <input type="number" id="openingAmtCash" name="openingAmtCash" class="form-control" />
                              <span class="col-form-label text-danger" id="openingAmtCash_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="openingAmtCash_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Bank Opening Amount*</label>
                            <div class="col-sm-8">
                              <input type="number" id="openingAmtBank" name="openingAmtBank" class="form-control" />
                              <span class="col-form-label text-danger" id="openingAmtBank_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="openingAmtBank_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                      
                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action="">
                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                            <input type="hidden" name="GroupId" id="GroupId" value="">
                            <input type="hidden" name="GrpSBAc" id="GrpSBAc" value="">
                              <button type="button" name="saveInterestAmount" id="saveInterestAmount" class="btn btn-inverse-success btn-fw">Save</button>
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