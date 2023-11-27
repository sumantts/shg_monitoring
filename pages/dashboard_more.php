<?php 
	if(!$_SESSION["StfId"]){header('location:?p=login');}
	include('common/header.php');
	$StfId = $_SESSION["StfId"];
	$StfNm = $_SESSION["StfNm"];
	$CollDt = date('m/d/Y');
	
		
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
                    <p class="card-description"> Collection Data On 22-11-2023</p>
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