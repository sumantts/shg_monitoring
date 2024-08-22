<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');?>
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
                            <label class="col-sm-4 col-form-label text-danger">Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="transferDate" class="form-control" />
                              <span class="col-form-label text-danger" id="transferDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="transferDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Member Code*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="memberCode" class="form-control" />
                              <span class="col-form-label text-danger" id="memberCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="memberCode_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">From Group S/B*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="fromGroupSB" class="form-control" />
                              <span class="col-form-label text-danger" id="fromGroupSB_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="fromGroupSB_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">To Group S/B*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="toGroupSB" class="form-control" />
                              <span class="col-form-label text-danger" id="toGroupSB_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="toGroupSB_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Transfer Amount*</label>
                            <div class="col-sm-8">
                              <input type="number" id="transferAmount" class="form-control" />
                              <span class="col-form-label text-danger" id="transferAmount_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="transferAmount_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                            <button type="button" id="transferMember" class="btn btn-inverse-success btn-fw mb-2">Transfer</button> 
                          </div>                          
                        </div>
                      </div> 
                    </form>  

                    <div id="part_three" style="display: none"> <h4>Sorry! No Record found</h4></div>

                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
           
          
    <?php include('common/footer.php');?>