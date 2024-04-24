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
                            <label class="col-sm-4 col-form-label text-danger">Group S/B A/c No*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="GrpSBAc" name="GrpSBAc" class="form-control" />
                              <span class="col-form-label text-danger" id="GrpSBAc_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="GrpSBAc_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Financial Year*</label>
                            <div class="col-sm-8">
                              <select id="FinYrFrmTo" name="FinYrFrmTo" class="form-control">
                                <option value="0">Select</option>
                                <option value="2024_2025">2024-2025</option>
                              </select>
                              <span class="col-form-label text-danger" id="FinYrFrmTo_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="FinYrFrmTo_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Upto Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="UptoDate" name="UptoDate" value="<?=date('Y-m-d')?>" class="form-control" />
                              <span class="col-form-label text-danger" id="uptoDate_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="uptoDate_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div> -->

                        <div class="col-md-6">
                          <div class=" mb-2">
                          <button type="button" id="showLoanRegisterReport" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    <!-- <div id="part_two" style="display: none;">
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
                    </div> -->


                      <!-- Table Start -->
                      <div id="part_three" style="display: none">  
                        <div class="col-md-6">
                          <div class=" mb-2">
                            <button type="button" id="downloadLoanRegisterReport" class="btn btn-inverse-success btn-fw">Download</button>
                          </div>
                        </div>
                    <!-- <h4 class="card-title" id="cbTitle">Cash Book For The Period dd-mm-yyyy To dd-mm-yyyy</h4>
                    <p class="card-description" id="cbTitle2">Group Name: </p> -->
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <td colspan="20" class="text-center font-weight-bold" id="table_heading">Loan Register for Group Name as on Month, Year</td>
                          </tr>
                          <tr>
                            <td scope="col" class="text-center">Sl No</td>
                            <td scope="col" class="text-center">Member Name</td>
                            <td scope="col" class="text-center">A/c No.</td>
                            <td scope="col" class="text-center">Loan Amount</td>
                            <td scope="col" class="text-center">Loan Date</td>
                            <td scope="col" class="text-center">Loan Outstanding</td>
                            <td scope="col" class="text-center">Expected</td>
                            <td scope="col" class="text-center">Repaid</td>
                            <td scope="col" class="text-center">Overdue</td>
                          </tr>
                        </thead>
                        <tbody id="sl_repo_tbody">
                          
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