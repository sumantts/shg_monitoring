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

                        <div class="col-md-6">
                          <div class=" mb-2">
                            <input type="hidden" name="StfId" id="StfId" value="<?=$_SESSION['StfId']?>">
                          <button type="button" id="showMemListReport" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>


                      <!-- Table Start -->
                      <div id="part_three" style="display: none">  
                    <!-- <h4 class="card-title" id="cbTitle">Cash Book For The Period dd-mm-yyyy To dd-mm-yyyy</h4>
                    <p class="card-description" id="cbTitle2">Group Name: </p> -->
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          
                          <tr>
                            <td scope="col" class="text-left">Sl No</td>
                            <td scope="col" class="text-left">Member Code</td>
                            <td scope="col" class="text-left">Member Name</td>
                            <td scope="col" class="text-left">Guardian Name</td>
                            <td scope="col" class="text-left">Village</td>
                            <td scope="col" class="text-left">Aadhar No.</td>
                            <td scope="col" class="text-left">PAN No.</td>
                            <td scope="col" class="text-left">Voter ID</td>
                            <td scope="col" class="text-left">Caste</td>
                          </tr>
                        </thead>
                        <tbody id="memlist_repo_tbody">
                          
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