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
                            <label class="col-sm-4 col-form-label text-danger">Collection Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="collectionDate" class="form-control" />
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
                          <div class="form-group row">
                          <button type="button" id="check_loan_account_number" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    
                    <p class="card-description">Group Name: </p>
                    <p class="card-description">Group Address: </p>
                    <div class="table-responsive-sm">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <td scope="col" style="text-align: center;">Member Id</td>
                            <td scope="col" style="text-align: center;">Member Name</td>
                            <td scope="col" style="text-align: center;">Attendance </td>
                            <td scope="col" style="text-align: center;">Collection Amount </td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: right;"> </td>
                            <td style="text-align: center;"><input type="checkbox" /></td>
                            <td style="text-align: right;"> </td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: right;"> </td>
                            <td style="text-align: center;"><input type="checkbox" /></td>
                            <td style="text-align: right;"> </td>
                          </tr>
                          <tr>
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
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>