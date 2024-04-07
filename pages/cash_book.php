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

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">From Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="fromDate" name="fromDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label text-danger" id="fromDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="fromDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Upto Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="uptoDate" name="uptoDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label text-danger" id="uptoDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="uptoDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
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
                            <input type="hidden" name="GroupId" id="GroupId" value="">
                          <button type="button" id="showCashBook" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    <div id="part_two" style="display: none;">
                      <p class="card-description" id="cb_GroupName">Group Name: </p>
                      <p class="card-description" id="cb_GroupAddress">Group Address: </p>
                      
                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action="">
                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                              <button type="button" name="showCashBookReport" id="showCashBookReport" class="btn btn-inverse-success btn-fw">View Report</button>
                              <button type="button" name="printDiv" id="printDiv" class="btn btn-inverse-success btn-fw"  style="display: none">Print Report</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>


                      <!-- Table Start -->
                      <div id="part_three" style="display: none">  
                    <h4 class="card-title" id="cbTitle">Cash Book For The Period dd-mm-yyyy To dd-mm-yyyy</h4>
                    <p class="card-description" id="cbTitle2">Group Name: </p>
                    <div class="table-responsive-sm">
                      <table class="table table-bordered">
                      <thead>
                        <tr>
                          <td colspan="4" class="text-center">Receipt</td>
                          <td colspan="4" class="text-center">Payment</td>
                        </tr>
                        <tr>
                          <td scope="col" class="text-center">Date</td>
                          <td scope="col" class="text-center">Particulars</td>
                          <td scope="col" class="text-center">Cash</td>
                          <td scope="col" class="text-center">Bank</td>
                          <td scope="col" class="text-center">Date</td>
                          <td scope="col" class="text-center">Particulars</td>
                          <td scope="col" class="text-center">Cash</td>
                          <td scope="col" class="text-center">Bank</td>
                        </tr>
                      </thead>
                      <tbody id="cb_tbody">
                        <!-- <tr>
                          <td>0</td>
                          <td>1</td>
                          <td class="text-right">0</td>
                          <td class="text-right">1</td>
                          <td>1</td>
                          <td>2</td>
                          <td class="text-right">0</td>
                          <td class="text-right">1</td>
                        </tr>
                        <tr>
                          <td scope="col" class="text-left">Sub Total</td>
                          <td scope="col" class="text-center"></td>
                          <td scope="col" class="text-right">100</td>
                          <td scope="col" class="text-right">260</td>
                          <td scope="col" class="text-left">Sub Total</td>
                          <td scope="col" class="text-center"></td>
                          <td scope="col" class="text-right">30</td>
                          <td scope="col" class="text-right">150</td>
                        </tr>
                        <tr>
                          <td scope="col" class="text-left">Opening</td>
                          <td scope="col" class="text-center"></td>
                          <td scope="col" class="text-right">100</td>
                          <td scope="col" class="text-right">260</td>
                          <td scope="col" class="text-left">Closing</td>
                          <td scope="col" class="text-center"></td>
                          <td scope="col" class="text-right">30</td>
                          <td scope="col" class="text-right">150</td>
                        </tr>
                        <tr>
                          <td scope="col" class="text-left">Total</td>
                          <td scope="col" class="text-center"></td>
                          <td scope="col" class="text-right">100</td>
                          <td scope="col" class="text-right">260</td>
                          <td scope="col" class="text-left">Total</td>
                          <td scope="col" class="text-center"></td>
                          <td scope="col" class="text-right">30</td>
                          <td scope="col" class="text-right">150</td>
                        </tr> -->

                        <tr>
                          <td colspan="8">Sorry! No data Found</td>
                        </tr>

                      </tbody>
                      </table>
                    </div>
                    </div>
                    <!-- Table end -->

                    

                    

                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>