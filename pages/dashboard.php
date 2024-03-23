<?php 
	if(!$_SESSION["StfId"]){header('location:?p=login');}
	include('common/header.php');
	$StfId = $_SESSION["StfId"];
	$StfNm = $_SESSION["StfNm"];
	$CollDt = date('m/d/Y');
	$all_results = array();
	$grantAmtColl = 0;

	//Get Group Members
	$query2 = "CALL usp_ViewDashboard('".$StfId."')";
	mysqli_multi_query($con, $query2);
	do {
		/* store the result set in PHP */
		if ($result2 = mysqli_store_result($con)) {
			while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				//printf("%s\n", $row[0]);
				$Dt = $row2['Dt'];
				$GrpNo = $row2['GrpNo'];
				$AmtColl = $row2['AmtColl'];
				
				$grantAmtColl = $grantAmtColl + $AmtColl;

				if($Dt != ''){
					$all_result = new stdClass();
					
					$all_result->Dt = $Dt; 
					$all_result->GrpNo = $GrpNo;
					$all_result->AmtColl = $AmtColl;

					array_push($all_results, $all_result);
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
		  
			<div class="col-lg-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-description">Dashboard </h4>

					
                    <p class="card-title mt-5">Collection Summary of <?=$StfNm?></p>
                    <div class="table-responsive-sm">
						<table class="table table-bordered">
						<thead>
							<tr>
							<td scope="col" style="text-align: center;">Date</td>
							<td scope="col" style="text-align: center;">No. of Groups</td>
							<td scope="col" style="text-align: center;">Amount Collected</td>
							<td scope="col" style="text-align: center;">View</td>
							</tr>
						</thead>
						<tbody>
							<?php
							if(sizeof($all_results) > 0){
								for($i = 0; $i < sizeof($all_results); $i++){
							?>
							<tr>
							<td style="text-align: center;"><?=$all_results[$i]->Dt?></td>
							<td style="text-align: center;"><?=$all_results[$i]->GrpNo?></td>
							<td style="text-align: right;"><?=number_format($all_results[$i]->AmtColl, 2)?></td>
							<td style="text-align: center;"><a href="?p=dashboard-more&dt=<?=$all_results[$i]->Dt?>">Show</a></td>
							</tr>
							<?php } ?>
							<tr>
							<td style="text-align: center;">Total</td>
							<td></td> 
							<td style="text-align: right;"><?=number_format($grantAmtColl, 2)?></td> 
							<td style="text-align: right;"></td>
							</tr>
							<?php }else{ ?>
							<tr>
							<td style="text-align: center;" colspan="4">Sorry! No data Found</td>
							</tr>
							<?php } ?>	
						</tbody>
						</table>
					</div>
                  </div>
                </div>
              </div>
		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>