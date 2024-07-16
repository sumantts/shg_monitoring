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
                            <label class="col-sm-4 col-form-label text-danger">Member Code*</label>
                            <div class="col-sm-8">
                              <input type="tel" id="memberCode" class="form-control" />
                              <span class="col-form-label text-danger" id="memberCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="memberCode_success" style="font-size: 12px;"></span>
                              
                              <span class="col-form-label text-danger" id="form_error" style="font-size: 12px;"> </span>
                              <span class="col-form-label text-success" id="form_success" style="font-size: 12px;"> </span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-2">
                            <button type="button" id="getMember" class="btn btn-inverse-success btn-fw mb-2">Show</button>
                            <!-- <button type="button" id="updateCaste" class="btn btn-inverse-success btn-fw mb-2">Update</button> -->
                            <button type="button" id="delinkMember" class="btn btn-inverse-success btn-fw mb-2">Delink</button>
                            <?php if($_SESSION["StfId"] == 99){?>
                              <button type="button" id="withdrawMember" class="btn btn-inverse-success btn-fw mb-2" >Withdraw</button>
                            <?php } ?>
                          </div>
                          
                        </div>

                        <!-- <div class="col-md-6">
                          <div class="form-group row">
                          <span class="col-form-label text-danger" id="form_error" style="font-size: 12px;"> </span>
                          <span class="col-form-label text-success" id="form_success" style="font-size: 12px;"> </span>
                          </div>
                        </div> -->

                      </div> 
                      
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Caste</label>
                            <div class="col-sm-8">
                              <select id="memCst" class="form-control" >
                                <option value="">Select</option>
                                <option value="GENERAL">GENERAL</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                                <option value="OBC">OBC</option>
                                <option value="MINORITY">MINORITY</option>
                              </select>
                              <span class="col-form-label text-danger" id="memCst_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="memCst_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-2"> 
                            <button type="button" id="updateCaste" class="btn btn-inverse-success btn-fw mb-2">Update</button> 
                          </div>
                          
                        </div> 
                      </div>

                    </form>

                    <div id="part_tow" style="display: none">
                      <p><strong>Member Name:</strong> <span id="MemNm"></span></p>
                      <p><strong>Gurdian Name:</strong> <span id="GurdNm"></span></p>
                      <p><strong>Group Code:</strong> <span id="GrpCd"></span></p>                    
                      <p><strong>Group Name:</strong> <span id="GrpNm"></span></p>
                      <p><strong>Staff Code:</strong> <span id="StfCd"></span></p>

                      
                      
                      <div class="row"> 
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Savings A/c. No.*</label>
                            <div class="col-sm-8">
                              <input type="number" id="savings_ac_no" class="form-control" />
                              <span class="col-form-label text-danger" id="savings_ac_no_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="savings_ac_no_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <button type="button" id="savings_ac_no_validate" class="btn btn-inverse-success btn-fw">Validate</button>
                        </div>                        
                      </div>
                    </div>

                    <div class="row" id="last_part" style="display: none"> 
                      <div class="col-md-6 mt-4">
                        <div class="form-group">
                          <input type="hidden" name="group_code" id="group_code" value="">
                          <input type="hidden" name="staff_code" id="staff_code" value="<?=$_SESSION["StfId"]?>">
                          <input type="hidden" name="GrpId" id="GrpId" value="">
                        <button type="button" id="updtMemStaff" class="btn btn-inverse-success btn-fw">Update</button>
                        </div>
                      </div>                       
                    </div>

                    <div id="part_three" style="display: none"> <h4>Sorry! No Record found</h4></div>

                  </div>
                </div>
              </div> 		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <script>
            function shareMe() {
              const button = document.getElementById("button");
              var divblock = $('#receipt_body').text();
              window.open("https://api.whatsapp.com/send?text=" + divblock)
            };

          </script>
          
    <?php include('common/footer.php');?>