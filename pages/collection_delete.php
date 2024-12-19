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
                    <form class="form-sample" method="POST" action="#" id="formColDel">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Collection Date*</label>
                            <div class="col-sm-8">
                              <input type="date" id="collectionDate" name="collectionDate" value="<?=date('Y-m-d')?>" class="form-control" required />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Savings A/c. No.*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="savingsAcNo" name="savingsAcNo" value="" class="form-control" required />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-2">
                            <button type="submit" id="delCollection" class="btn btn-inverse-success btn-fw mb-2">Delete</button>
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