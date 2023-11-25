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
                    <p class="card-description"> Welcome to Mahila Bikash dashboard </p>
                    <table class="table table-bordered">
                      <thead>
						<tr>
						  <th scope="col">Particulars</th>
						  <th scope="col">Number</th>
						  <th scope="col">Amount</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <td>Receipt/Deposit</th>
						  <td style="text-align: right;"> </td>
						  <td style="text-align: right;"> </td>
						</tr>
						<tr>
						  <td>Payment/Withdrawal</th>
						  <td style="text-align: right;"> </td>
						  <td style="text-align: right;"> </td>
						</tr>
						<tr>
						  <td>Loan Collection</th>
						  <td style="text-align: right;"> </td>
						  <td style="text-align: right;"> </td>
						</tr>
						<tr>
						  <td colspan="2">Cash Balance</th>
						  <td style="text-align: right;"> </td>
						</tr>
					  </tbody>
                    </table>
                  </div>
                </div>
              </div>
		  
		  </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
    <?php include('common/footer.php');?>