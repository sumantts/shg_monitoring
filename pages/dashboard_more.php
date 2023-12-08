<?php 
	if(!$_SESSION["StfId"]){header('location:?p=login');}
	include('common/header.php');
	$StfId = $_SESSION["StfId"];
	$StfNm = $_SESSION["StfNm"];
	

	$dt =  date('Y-m-d', strtotime($_GET['dt']));
	$all_results = array();
	$grantAmtColl = 0;


	if(isset($_GET['dt'])){

		$query2 = "CALL usp_ViewDashboardDtls('".$StfId."', '".$dt."')";
		mysqli_multi_query($con, $query2);
		do {
			/* store the result set in PHP */
			if ($result2 = mysqli_store_result($con)) {
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$GrpNm = $row2['GrpNm'];
					$Attnd = $row2['Attnd'];
					$Amt = $row2['Amt'];
					
					//$grantAmtColl = $grantAmtColl + $AmtColl;

					if($GrpNm != ''){
						$all_result = new stdClass();
						
						$all_result->GrpNm = $GrpNm; 
						$all_result->Attnd = $Attnd;
						$all_result->Amt = $Amt;

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
	}//end if
		
	echo json_encode($all_results);

	
		
?>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include('common/navbar.php');?>
      <!-- partial -->
      <?php include('common/left_menu.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class=""> 
		  
			<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Collection Summary of <?=$StfNm?></h4>
                    <p class="card-description"> Collection Data On <?=$_GET['dt']?></p>
                    <div class="table-responsive-sm">
						<table class="table table-bordered">
						<thead>
							<tr>
							<td scope="col" style="text-align: center;">Group Name</td>
							<td scope="col" style="text-align: center;">Attendance</td>
							<td scope="col" style="text-align: center;">Amount Collected</td>
							</tr>
						</thead>
						<tbody>
							<?php
							if(sizeof($all_results) > 0){
								for($i = 0; $i < sizeof($all_results); $i++){
							?>
							<tr>
							<td style="text-align: center;"><?=$all_results[$i]->GrpNm?></td>
							<td style="text-align: center;"><?=$all_results[$i]->Attnd?></td>
							<td style="text-align: right;"><?=number_format($all_results[$i]->Amt, 2)?></td>
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