<?php 
	if(!$_SESSION["StfId"]){header('location:?p=login');}
	include('common/header.php');
	$StfId = $_SESSION["StfId"];
	$StfNm = $_SESSION["StfNm"];
	$CollDt = date('m/d/Y');
	$all_results = array();
	$ext_results = array();
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

	//Get Extra data
	$query3 = "CALL usp_ViewDashboardExtra('".$StfId."')";
	mysqli_multi_query($con, $query3);
	do {
		/* store the result set in PHP */
		if ($result3 = mysqli_store_result($con)) {
			while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
				//printf("%s\n", $row[0]);
				$GrpMeeting = $row3['GrpMeeting'];
				$GrpMeetingNormal = $row3['GrpMeetingNormal'];
				$GrpMeetingSpecial = $row3['GrpMeetingSpecial']; 
				$SansadMeetingNormal = $row3['SansadMeetingNormal']; 
				$SansadMeetingSpecial = $row3['SansadMeetingSpecial']; 

				if($GrpMeeting != ''){
					$ext_result = new stdClass();
					
					$ext_result->GrpMeeting = $GrpMeeting; 
					$ext_result->GrpMeetingNormal = $GrpMeetingNormal;
					$ext_result->GrpMeetingSpecial = $GrpMeetingSpecial;
					$ext_result->SansadMeetingNormal = $SansadMeetingNormal;
					$ext_result->SansadMeetingSpecial = $SansadMeetingSpecial;

					array_push($ext_results, $ext_result);
				}
			}
		}
		/* print divider */
		if (mysqli_more_results($con)) {
			//printf("-----------------\n");
		}
	} while (mysqli_next_result($con));
	/* execute multi query */
	//echo json_encode($ext_results);
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

					<p class="card-title mt-5">Meeting Summary</p>
                    <div class="table-responsive">
						<table class="table table-bordered">
						<!-- <thead>
							<tr>
							<td scope="col" style="text-align: center;">Proposed Meeting</td>
							<td scope="col" style="text-align: center;">Group Meeting (Normal)</td>
							<td scope="col" style="text-align: center;">Group Meeting (Special)</td>
							<td scope="col" style="text-align: center;">Sansad Meeting (Normal)</td>
							<td scope="col" style="text-align: center;">Sandad Meeting (Special)</td> 
							</tr>
						</thead> -->
						<tbody>
							<?php
							if(sizeof($ext_results) > 0){
								for($i = 0; $i < sizeof($ext_results); $i++){
							?>
							<tr>
							<td style="text-align: left;">Proposed Meeting</td><td><?=$ext_results[$i]->GrpMeeting?></td>
								</tr>
								<tr>
								<td style="text-align: left;">Group Meeting (Normal)</td><td><?=$ext_results[$i]->GrpMeetingNormal?></td>
							
								</tr>
								<tr>
								<td style="text-align: left;">Group Meeting (Special)</td><td><?=$ext_results[$i]->GrpMeetingSpecial?></td>
							
								</tr>
								<tr>
								<td style="text-align: left;">Sansad Meeting (Normal)</td><td><?=$ext_results[$i]->SansadMeetingNormal?></td>
							
								</tr>
								<tr>
								<td style="text-align: left;">Sansad Meeting (Special)</td><td><?=$ext_results[$i]->SansadMeetingSpecial?></td>
							 
							</tr>
							<?php } 
							}else{ ?>
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