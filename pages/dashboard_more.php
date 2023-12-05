<?php 
	if(!$_SESSION["StfId"]){header('location:?p=login');}
	include('common/header.php');
	$StfId = $_SESSION["StfId"];
	$StfNm = $_SESSION["StfNm"];
	

	$dt = $_GET['dt'];
	$all_results = array();
	$grantAmtColl = 0;


	if(isset($_GET['dt'])){
		$dt = $_GET['dt'];

		$query2 = "CALL usp_ViewDashboardDtls('".$StfId."', '".$dt."')";
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
	}//end if
		
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
          <div class=""> 
		  
			<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Collection Summary of <?=$StfNm?></h4>
                    <p class="card-description"> Collection Data On <?=$dt?></p>
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
							<tr>
							<td style="text-align: center;">22-11-2023</td>
							<td style="text-align: right;"> </td>
							<td style="text-align: right;"> </td>
							</tr>
							<tr>
							<td style="text-align: center;">21-11-2023</td>
							<td style="text-align: right;"> </td>
							<td style="text-align: right;"> </td>
							</tr>
							<tr>
							<td style="text-align: center;">20-11-2023</td>
							<td style="text-align: right;"> </td>
							<td style="text-align: right;"> </td>
							</tr>
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