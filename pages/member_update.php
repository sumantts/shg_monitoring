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
                            </div>
                          </div>
                        </div>

                        

                        <div class="col-md-6">
                          <div class="mb-2">
                            <button type="button" id="getMember" class="btn btn-inverse-success btn-fw mb-2">Show</button>
                            <!-- <button type="button" id="delinkMember" class="btn btn-inverse-success btn-fw mb-2">Delink</button>
                            <button type="button" id="withdrawMember" class="btn btn-inverse-success btn-fw mb-2" >Withdraw</button> -->
                          </div>
                          
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                          <span class="col-form-label text-danger" id="form_error" style="font-size: 12px;"> </span>
                          <span class="col-form-label text-success" id="form_success" style="font-size: 12px;"> </span>
                          </div>
                        </div>

                      </div> 
                    </form>

                    <div id="part_tow" style="display: none">
                      <!-- <p><strong>Member Name:</strong> <span id="MemNm"></span></p>
                      <p><strong>Gurdian Name:</strong> <span id="GurdNm"></span></p> -->
                      <p><strong>Group Code:</strong> <span id="GrpCd"></span></p>                    
                      <p><strong>Group Name:</strong> <span id="GrpNm"></span></p>
                      <!-- <p><strong>Staff Code:</strong> <span id="StfCd"></span></p> -->

                      
                      
                      <div class="row"> 

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Member Name*</label>
                            <div class="col-sm-8">
                              <input type="text" id="memberName" class="form-control" />
                              <span class="col-form-label text-danger" id="memberName_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="memberName_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Gurdian Name*</label>
                            <div class="col-sm-8">
                              <input type="text" id="gurdianName" class="form-control" />
                              <span class="col-form-label text-danger" id="gurdianName_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="gurdianName_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <button type="button" id="updtMemProfile" class="btn btn-inverse-success btn-fw">Update</button>
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