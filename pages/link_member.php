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
                              <input type="text" id="memberCode" class="form-control" />
                              <span class="col-form-label text-danger" id="memberCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="memberCode_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-danger">Group Code*</label>
                            <div class="col-sm-8">
                              <input type="text" id="groupCode" class="form-control" />
                              <span class="col-form-label text-danger" id="groupCode_error" style="font-size: 12px;"></span>
                              <span class="col-form-label text-success" id="groupCode_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div> -->

                        <div class="col-md-6">
                          <div class="form-group row">
                          <button type="button" id="check_member_Id" class="btn btn-inverse-success btn-fw">Show</button>
                          </div>
                        </div>
                      </div> 
                    </form>

                    <p>Member Name:</p>
                    <p>Gurdian Name:</p>
                    <p>Group Code:</p>
                    <p>Group Name:</p>
                    <p>Staff Code:</p>
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