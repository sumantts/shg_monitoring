<?php
	include '../assets/php/sql_conn.php';

	$i=1;
	$csv_export1 = "";

	$csv_fileName = 'meeting_data_'.date('Y-m-d').'.csv';
	$csv_export = '';
	$csv_export .="Sl. No.," ;
	$csv_export .="Metting Date," ;
	$csv_export .="Staff Code," ;
	$csv_export .="Group Code,";
	$csv_export .="Member Code,";
	$csv_export .="Attendance,";
	$csv_export .="Collection Amount,";
	$csv_export .="Entered On,";
	
	$csv_export .= "\n";
	
	if(isset($_POST['meetingDate'])){
		$meetingDate = $_POST['meetingDate'];
		$StfId = $_POST["StfId"];
		$meeting_rows = array();
	
		$meeting_date_str = date('d-m-Y', strtotime($meetingDate));
		
		//Get Meeting Data
		$query2 = "CALL usp_GetMeetingData('".$StfId."', '".$meetingDate."')";
		mysqli_multi_query($con, $query2);
		do {
			/* store the result set in PHP */
			if ($result2 = mysqli_store_result($con)) {
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				//printf("%s\n", $row[0]);
				$MettingDt = $row2['MettingDt'];
				$StfCd = $row2['StfCd'];
				$GrpCd = $row2['GrpCd'];
				$MemCd = $row2['MemCd'];
				$Attdance = $row2['Attdance'];
				$CollAmt = $row2['CollAmt'];
				$CollDt = $row2['CollDt'];
				
				

				$csv_export1 .= "$i,";
				$csv_export1 .= "$MettingDt,";
				$csv_export1 .= "$StfCd,";
				$csv_export1 .= "$GrpCd,";
				$csv_export1 .= "$MemCd,";
				$csv_export1 .= "$Attdance,";
				$csv_export1 .= "$CollAmt,";
				$csv_export1 .= "$CollDt,";
				$csv_export1 .= "\n";
				$i++;
			}
		}
		/* print divider */
		if (mysqli_more_results($con)) {
			//printf("-----------------\n");
		}
		} while (mysqli_next_result($con));

	}
	$csv_export .= $csv_export1;
	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".$csv_fileName."");
	echo($csv_export);
?>
