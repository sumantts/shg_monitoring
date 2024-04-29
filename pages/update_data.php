<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

if(isset($_POST['updateMeetingData'])){ 
    echo $query_2 = "CALL usp_CheckMemberColl()";
    mysqli_multi_query($con, $query_2); 
  ?>
  <script>
   window.location.href = '?p=update-data&save=ok&data_saved=ok';
  </script>
  <?php     
  }//end if
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
                      <span class="col-form-label  text-success" style="font-size: 18px;"> Records updated successfully</span>
                    <?php } }?>
                    
                    <h4 class="card-title"><?=$title?></h4>
                  

                    <div>
                      <p class="card-description" >It will check and rectify the wrong collection data (if any)</p>
                      <div class="table-responsive-sm">
                        <form name="form1" id="form1" method="POST" action=""  onsubmit="return validateForm()">
                          
                          <div class="form-group row">
                            <div class="col-md-12 mt-2">
                            <input type="hidden" name="GroupId" id="GroupId" value="">
                            <input type="hidden" name="GrpSBAc" id="GrpSBAc" value="">
                              <input type="submit" name="updateMeetingData" id="updateMeetingData" class="btn btn-inverse-success btn-fw" value="Update">
                            </div>
                          </div>
                        </form>
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
            function validateForm(){            
              if(confirm('It will take a few minutes, do not close the window.')) {                
                return true;
              }else{
                return false;
              }
            }
          </script>
          
    <?php include('common/footer.php');?>