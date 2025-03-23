<?php 
if(!$_SESSION["StfId"]){header('location:?p=login');}
include('common/header.php');

$StfId = $_SESSION["StfId"];
$StfNm = $_SESSION["StfNm"];
$CollDt = date('m/d/Y');
$all_results_m = array(); 
$all_results_e = array(); 
$all_results_s = array(); 
$grantAmtColl = 0;

$main_part_subtotal = 0;
$extra_part_subtotal = 0;
$social_part_subtotal = 0;
$grand_total = 0;
$IncDate = '';

//Get Group Members
$query2 = "CALL usp_RptFoIcentiveDtls('".$StfId."')";
mysqli_multi_query($con, $query2);
do {
  /* store the result set in PHP */
  if ($result2 = mysqli_store_result($con)) {
    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
      //printf("%s\n", $row[0]); 
      $IncDate = $row2['IncDate']; 

      if($row2['IncFor'] == 'Main Part'){
        $all_result = new stdClass();
        
        $all_result->Sl = $row2['Sl']; 
        $all_result->IncFor = $row2['IncFor'];
        $all_result->IncType = $row2['IncType'];
        $all_result->CalcValue = $row2['CalcValue'];
        $all_result->Remarks = $row2['Remarks'];
        $all_result->IncDate = $row2['IncDate']; 
        
        if($row2['IncType'] == 'calculated_incentive'){
          $main_part_subtotal = $row2['CalcValue'];
        }

        if($row2['IncType'] != 'calculated_incentive'){
          array_push($all_results_m, $all_result);
        }
      }
      

      if($row2['IncFor'] == 'Extra Part'){
        $all_result = new stdClass();
        
        $all_result->Sl = $row2['Sl']; 
        $all_result->IncFor = $row2['IncFor'];
        $all_result->IncType = $row2['IncType'];
        $all_result->CalcValue = $row2['CalcValue'];
        $all_result->Remarks = $row2['Remarks'];
        $all_result->IncDate = $row2['IncDate']; 

        $CalcValue = $row2['CalcValue'];
        $extra_part_subtotal = $extra_part_subtotal + $CalcValue;
        array_push($all_results_e, $all_result);
      }
      

      if($row2['IncFor'] == 'Social Part'){
        $all_result = new stdClass();
        
        $all_result->Sl = $row2['Sl']; 
        $all_result->IncFor = $row2['IncFor'];
        $all_result->IncType = $row2['IncType'];
        $all_result->CalcValue = $row2['CalcValue'];
        $all_result->Remarks = $row2['Remarks'];
        $all_result->IncDate = $row2['IncDate']; 

        $CalcValue = $row2['CalcValue'];
        $social_part_subtotal = $social_part_subtotal + $CalcValue;
        array_push($all_results_s, $all_result);
      }

    }
  }
  /* print divider */
  if (mysqli_more_results($con)) {
    //printf("-----------------\n");
  }
} while (mysqli_next_result($con));
/* execute multi query */
  
//echo json_encode($all_results); 
$grand_total = ($main_part_subtotal + $extra_part_subtotal + $social_part_subtotal);

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
                    <?php if($_SESSION["StfId"] == 99){?>
                      <form class="form-sample">
                        <!--<p class="card-description"> Personal info </p>-->
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label text-danger">Date*</label>
                              <div class="col-sm-8">
                                <input type="date" id="IncDate" name="IncDate" class="form-control" />
                                <span class="col-form-label text-danger" id="IncDate_error" style="font-size: 12px;"></span>
                                <span class="col-form-label text-success" id="IncDate_success" style="font-size: 12px;"></span>
                              </div>
                            </div>
                          </div> 

                          <div class="col-md-6">
                            <div class=" mb-2">
                            <button type="button" id="showIcentiveReport" class="btn btn-inverse-success btn-fw">Show</button>
                            <button type="button" id="calculateIcentive" class="btn btn-inverse-success btn-fw">Calculate</button>
                            </div>
                          </div>
                        </div> 
                      </form> 
                    <?php }else{?>
                    <!-- Table Start -->
                    <div >  
                        <!-- <div class="col-md-6">
                          <div class=" mb-2">
                            <button type="button" id="downloadLoanRegisterReport" class="btn btn-inverse-success btn-fw">Download</button>
                          </div>
                        </div> -->
                        
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td colspan="20" class="text-center font-weight-bold" id="table_heading1">Incentive For The Month Of (<?=date('F-Y', strtotime($IncDate))?>)</td>
                              </tr>
                              <tr>
                                <td scope="col" class="text-center">Sl</td> 
                                <td scope="col" class="text-center">Incentive Type</td>
                                <td scope="col" class="text-center">Value/Amount</td>
                                <td scope="col" class="text-center">Remarks</td> 
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(sizeof($all_results_m) > 0){

                                for($i = 0; $i < sizeof($all_results_m); $i++){
                                  $sl = $i + 1;                                  
                                ?>
                              <tr>
                                <td scope="col" class="text-center"><?php echo "$sl"; ?></td> 
                                <td scope="col" class="text-left"><?=$all_results_m[$i]->IncType?></td>
                                <td scope="col" class="text-right"><?=$all_results_m[$i]->CalcValue?></td>
                                <td scope="col" class="text-left"><?=$all_results_m[$i]->Remarks?></td> 
                              </tr>  
                              <?php }//end for ?>
                              
                              <?php if($main_part_subtotal > 0){?>
                                <tr> <td scope="col" class="text-center font-weight-bold" colspan="2">Sub Total (Main Part)</td> <td scope="col" class="text-right font-weight-bold"><?=number_format($main_part_subtotal, 2)?></td><td>&nbsp;</td></tr>
                              <?php } ?>

                              <?php
                              for($j = 0; $j < sizeof($all_results_e); $j++){
                                $sl = $j + 1;                                  
                              ?>
                              <tr>
                              <td scope="col" class="text-center"><?php echo "$sl"; ?></td> 
                              <td scope="col" class="text-left"><?=$all_results_e[$j]->IncType?></td>
                              <td scope="col" class="text-right"><?=$all_results_e[$j]->CalcValue?></td>
                              <td scope="col" class="text-left"><?=$all_results_e[$j]->Remarks?></td> 
                              </tr>  
                              <?php }//end for ?>
                              
                              <?php if($extra_part_subtotal > 0){?>
                                <tr> <td scope="col" class="text-center font-weight-bold" colspan="2">Sub Total (Extra Part)</td> <td scope="col" class="text-right font-weight-bold"><?=number_format($extra_part_subtotal, 2)?></td><td>&nbsp;</td></tr>
                              <?php } ?>

                              <?php 
                              for($k = 0; $k < sizeof($all_results_s); $k++){
                                $sl = $k + 1;                                  
                              ?>
                              <tr>
                              <td scope="col" class="text-center"><?php echo "$sl"; ?></td> 
                              <td scope="col" class="text-left"><?=$all_results_s[$k]->IncType?></td>
                              <td scope="col" class="text-right"><?=$all_results_s[$k]->CalcValue?></td>
                              <td scope="col" class="text-left"><?=$all_results_s[$k]->Remarks?></td> 
                              </tr>  
                              <?php }//end for ?>
                              
                              <?php if($social_part_subtotal > 0){?>
                                <tr> <td scope="col" class="text-center font-weight-bold" colspan="2">Sub Total (Social Part)</td> <td scope="col" class="text-right font-weight-bold"><?=number_format($social_part_subtotal, 2)?></td><td>&nbsp;</td></tr>
                              <?php } ?>

                              
                              <tr> <td scope="col" class="text-center font-weight-bold" colspan="2">Grand Total</td> <td scope="col" class="text-right font-weight-bold"><?=number_format($grand_total, 2)?></td><td>&nbsp;</td></tr>

                              <?php 
                              } else{?>
                                <tr> <td scope="col" class="text-center font-weight-bold" colspan="5">Sorry! No Data Found</td> </tr>  
                              <?php }?>                            
                            </tbody>
                          </table>
                        </div>
                      </div>
                    <!-- Table end -->  
                    <?php } ?>




                      <!-- Table Start -->
                      <div id="part_three" style="display: none">  
                        <!-- <div class="col-md-6">
                          <div class=" mb-2">
                            <button type="button" id="downloadLoanRegisterReport" class="btn btn-inverse-success btn-fw">Download</button>
                          </div>
                        </div> -->
                        
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td colspan="20" class="text-center font-weight-bold" id="table_heading">Incentive Report</td>
                              </tr>
                              <tr>
                                <td scope="col" class="text-center">FO ID</td>
                                <td scope="col" class="text-center">FO Name</td>
                                <td scope="col" class="text-center">Main Part</td>
                                <td scope="col" class="text-center">Extra Part</td>
                                <td scope="col" class="text-center">Social Part</td>
                                <td scope="col" class="text-center">Total Amount</td> 
                              </tr>
                            </thead>
                            <tbody id="sl_repo_tbody">
                              
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