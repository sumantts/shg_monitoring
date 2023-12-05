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
                      <span class="col-form-label  text-success" style="font-size: 18px;"><?=$_GET["data_saved"]?> Data inserted successfully</span>
                    <?php } }?>
                    
                    <h4 class="card-title"><?=$title?></h4>
                    <form class="form-sample" name="form1" id="form1" >
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">New Password*</label>
                            <div class="col-sm-8">
                              <input type="text" id="new_password" name="new_password" value="" class="form-control" />
                              <span class="col-form-label  text-danger" id="new_password_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="new_password_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION["StfId"]?>">
                          <button type="button" id="update_password" name="update_password" class="btn btn-inverse-success btn-fw">Update</button>
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