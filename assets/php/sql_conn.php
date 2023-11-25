<?php
	//echo "DB Connection start here";

	session_start();
	
    $p_name = 'Bagnan Mahila Bikash';
	$logo = 'logo.jpg';
	$ico = 'logo-mahila.ico';

	//Mysqli DB Connection Procedural style
	$host_name = "localhost";
	$user_name = "root";
	$password = "";
	$db_name = "db_shg_monitoring";

	$con = mysqli_connect($host_name, $user_name, $password, $db_name);
	
	// Check connection
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
	}

	// Change database to "GFG_TEST"
	// mysqli_select_db($conn,$dbtest);
	
	/***************
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}else{
		//Fetch Query
		$sql = "SELECT * FROM mst_module";
		$res = mysqli_query($con, $sql);
		if(mysqli_num_rows($res) > 0){
			while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
				//echo $row['Module_Id'].' -- '.$row['Module_Name'];
				//echo "<br>";
			}//end while
		}
	}
	
	//run the store proc
	$result = mysqli_query($con, "CALL usp_LogInAcYr");

	//loop the result set
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){   
		//echo $row['YrId'].' -- '.$row['FinYr'];
		//echo $row[0] . " - " .  $row[1] . " - " .  $row[2] . " - " .  $row[3]; 
	}//end while

	//Close DB Connection 
	mysqli_close($con);
	**************/
	
	
		 
?>
