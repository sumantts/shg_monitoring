<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

$qstring = '';
 
if(isset($_POST["importSubmit"])){    
  // Allowed mime types
  $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
  // Validate whether selected file is a CSV file
  if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){      
      // If the file is uploaded
      if(is_uploaded_file($_FILES['file']['tmp_name'])){
          //Remove old data
          $delete_query = "TRUNCATE TABLE  member_loanstatus";
          mysqli_multi_query($con, $delete_query);

          // Open uploaded CSV file with read-only mode
          $csvFile = fopen($_FILES['file']['tmp_name'], 'r');          
          $data_saved = 0;

          // Parse data from CSV file line by line
          while(($line = fgetcsv($csvFile)) !== FALSE){
            // Get row data
            $MemId = $line[0];
            $AcNo = $line[1];
            $LnDate = $line[2];
            $Purpose = $line[3]; //Purpose
            $LnAmt = $line[4];
            $LnOuts = $line[5];
            $PrnExp = $line[6];
            $PrnPay = $line[7];
            $PrnODue = $line[8];
            $AsOnDate = $line[9];
            $AsOn = date('Y-m-d', strtotime($AsOnDate));

            //Call SP to save data into DB
            if($data_saved > 0){
              $query = "CALL usp_InsertLoanStatus('".$MemId."', '".$AcNo."', '".$LnDate."', '".$Purpose."', '".$LnAmt."', '".$LnOuts."', '".$PrnExp."', '".$PrnPay."', '".$PrnODue."', '".$AsOn."')";
              //echo $query;
              mysqli_multi_query($con, $query);
            }
            $data_saved++;
          }//end while
          
          // Close opened CSV file
          fclose($csvFile);
          
          $qstring = 'success';
      }else{
          $qstring = 'error';
      }
  }else{
      $qstring = 'invalid_file';
  }

  //header("location: ?p=member-upload&qstring=$qstring&data_saved=$data_saved");
  ?>
  <script>
    window.location.href = '?p=loan-upload&qstring=<?=$qstring?>&data_saved=<?=($data_saved-1)?>';
  </script>
  <?php
  exit();
}//end isset



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
                    <?php if(isset($_GET["qstring"])){?>
                    <?php if($_GET["qstring"] == "error"){?>        
                    <span class="col-form-label  text-danger" style="font-size: 18px;">Invallid file format, Data not imported</span>
                    <?php } ?>

                    <?php if($_GET["qstring"] == "success"){?> 
                    <span class="col-form-label  text-success" style="font-size: 18px;"><?=$_GET["data_saved"]?> Data imported successfully</span>
                    <?php } ?>
                    <?php } ?>
                    
                    <h4 class="card-title"><?=$title?></h4>
                    <form class="form-sample" action="" method="post" enctype="multipart/form-data">
                      <!--<p class="card-description"> Personal info </p>-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">

                            <label class="col-sm-4 col-form-label text-danger">Loan Sheet*</label>
                            <div class="col-sm-8">
                              <input type="file" name="file" id="fileInput" accept=".csv" /> 
                              <span class="col-form-label  text-danger" id="loanSheet_error" style="font-size: 12px;"></span>
                              <span class="col-form-label  text-success" id="loanSheet_success" style="font-size: 12px;"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class=" mb-2">
                          <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
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