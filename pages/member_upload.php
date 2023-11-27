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
                            <label class="col-sm-4 col-form-label text-danger">Member Sheet*</label>
                            <div class="col-sm-8">
                              <input type="file" name="memberSheet" id="memberSheet" accept=".xlsx" /> 
                              <span class="col-form-label  text-danger" id="memberSheet_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="memberSheet_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                          <button type="button" id="uploadMemberSheet" class="btn btn-inverse-success btn-fw">Upload</button>
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