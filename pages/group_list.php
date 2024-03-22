<?php 
	if(!$_SESSION["StfId"]){header('location:?p=login');}
	include('common/header.php');
	$StfId = $_SESSION["StfId"];
	$StfNm = $_SESSION["StfNm"];
	
	$all_results = array();
	$grantAmtColl = 0;

	$query2 = "CALL usp_GetGroupList('".$StfId."')";
	mysqli_multi_query($con, $query2);
	do {
		/* store the result set in PHP */
		if ($result2 = mysqli_store_result($con)) {
			while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				//printf("%s\n", $row[0]);
				$SlNo = $row2['SlNo'];
				$GrpId = $row2['GrpId'];
				$GrpNm = $row2['GrpNm'];
				$GrpAdd = $row2['GrpAdd'];
				$AcNo = $row2['AcNo'];
				
				//$grantAmtColl = $grantAmtColl + $AmtColl;

				if($SlNo != ''){
					$all_result = new stdClass();
					
					$all_result->SlNo = $SlNo; 
					$all_result->GrpId = $GrpId;
					$all_result->GrpNm = $GrpNm;
					$all_result->GrpAdd = $GrpAdd;
					$all_result->AcNo = $AcNo;

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
                    <h4 class="card-title">Group List of <?=$StfNm?></h4>
					
                    <div class="table-responsive-sm">
						<table class="table table-bordered">
						<thead>
							<tr>
							<td scope="col" style="text-align: center;">SL#</td>
							<td scope="col" style="text-align: center;">Group ID</td>
							<td scope="col" style="text-align: center;">Group Name</td>
							<td scope="col" style="text-align: center;">Group Address</td>
							<td scope="col" style="text-align: center;">A/c No</td>
							</tr>
						</thead>
						<tbody>
							<?php
							if(sizeof($all_results) > 0){
								for($i = 0; $i < sizeof($all_results); $i++){
							?>
							<tr>
							<td style="text-align: center;"><?=$all_results[$i]->SlNo?></td>
							<td style="text-align: center;"><?=$all_results[$i]->GrpId?></td>
							<td style="text-align: left;"><?=$all_results[$i]->GrpNm?></td>
							<td style="text-align: center;"><?=$all_results[$i]->GrpAdd?></td>
							<td style="text-align: center;"><?=$all_results[$i]->AcNo?></td>
							</tr>
							<?php } }else{ ?>
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