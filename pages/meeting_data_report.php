<?php 
	if(!$_SESSION["StfId"]){header('location:?p=login');}
	include('common/header.php');
	$StfId = $_SESSION["StfId"];
	$StfNm = $_SESSION["StfNm"];
	
	$all_results = array();
	$grantAmtColl = 0;
	$MeetingDt = $_GET['MeetingDt'];
	$GrpSBAc = $_GET['GrpSBAc'];

	$query2 = "CALL usp_GenCollReport('".$MeetingDt."', '".$StfId."', '".$GrpSBAc."')";
	mysqli_multi_query($con, $query2);
	do {
		/* store the result set in PHP */
		if ($result2 = mysqli_store_result($con)) {
			while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				//printf("%s\n", $row[0]);
				$MDt = $row2['MDt'];
				$StfNm = $row2['StfNm'];
				$GrpNm = $row2['GrpNm'];
				$MemNo = $row2['MemNo'];
				$TotMem = $row2['TotMem'];
				$CollAmt = $row2['CollAmt'];
				$CollTm = $row2['CollTm'];
				
				//$grantAmtColl = $grantAmtColl + $AmtColl;

				if($MDt != ''){
					$all_result = new stdClass();
					
					$all_result->MDt = $MDt; 
					$all_result->StfNm = $StfNm;
					$all_result->GrpNm = $GrpNm;
					$all_result->MemNo = $MemNo;
					$all_result->TotMem = $TotMem;
					$all_result->CollAmt = $CollAmt;
					$all_result->CollTm = $CollTm;

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
                    <h4 class="card-title">Collection Report of <?=$StfNm?></h4>
					
                    <div class="table-responsive-sm">
						<table class="table table-bordered">
						<thead>
							<tr>
							<td scope="col" style="text-align: center;">Meeting Date</td>
							<td scope="col" style="text-align: center;">Staff Name</td>
							<td scope="col" style="text-align: center;">Group Name</td>
							<td scope="col" style="text-align: center;">Memo No</td>
							<td scope="col" style="text-align: center;">Total Member</td>
							<td scope="col" style="text-align: center;">Collection Amount</td>
							<td scope="col" style="text-align: center;">Collection Time</td>
							</tr>
						</thead>
						<tbody>
							<?php
							if(sizeof($all_results) > 0){
								for($i = 0; $i < sizeof($all_results); $i++){
							?>
							<tr>
							<td style="text-align: center;"><?=$all_results[$i]->MDt?></td>
							<td style="text-align: center;"><?=$all_results[$i]->StfNm?></td>
							<td style="text-align: center;"><?=$all_results[$i]->GrpNm?></td>
							<td style="text-align: center;"><?=$all_results[$i]->MemNo?></td>
							<td style="text-align: center;"><?=$all_results[$i]->TotMem?></td>
							<td style="text-align: center;"><?=$all_results[$i]->CollAmt?></td>
							<td style="text-align: center;"><?=$all_results[$i]->CollTm?></td>
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