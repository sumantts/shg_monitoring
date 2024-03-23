<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');
//usp_GetPurpose
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
                            <label class="col-sm-4 col-form-label text-danger">Entry Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="entryDate" name="entryDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label text-danger" id="entryDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="entryDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Voucher Type*</label>
                            <div class="col-sm-8">
                              <select id="voucherType" name="voucherType" class="form-control" >
                                <option value="0">Select</option>
                                <option value="1">Receipt</option>
                                <option value="2">Payment</option>
                              </select>
                              <span class="col-form-label text-danger" id="voucherType_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="voucherType_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Particulars*</label>
                            <div class="col-sm-8">
                              <select id="particulars" name="particulars" class="form-control" >
                                <option value="0">Select</option>
                                <option value="1">Particular 1</option>
                                <option value="2">Particular 2</option>
                              </select>
                              <span class="col-form-label text-danger" id="particulars_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="particulars_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Amount*</label>
                            <div class="col-sm-8">
                              <input type="number" id="voucherAmount" name="voucherAmount" value="" class="form-control" />
                              <span class="col-form-label text-danger" id="voucherAmount_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="voucherAmount_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                            <button type="button" id="saveVoucher" class="btn btn-inverse-success btn-fw">Save</button>
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