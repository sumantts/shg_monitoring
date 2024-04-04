<?php
	include '../assets/php/sql_conn.php';

	$i=1;
	$csv_export1 = "";

	
	$csv_export = '';
	$csv_export .="Sl. No.," ;
	$csv_export .="Metting Date," ;
	$csv_export .="Staff Code," ;
	$csv_export .="Group Code,";
	$csv_export .="Member Count,";
	$csv_export .="Attendance Count,";
	$csv_export .="Collection Amount,";
	$csv_export .="S/B A/c No,";
	
	$csv_export .= "\n";
	
	if(isset($_POST['meetingDate'])){
		$meetingDate = $_POST['meetingDate'];
		$MeetingDtTo = $_POST['MeetingDtTo'];
		$fieldOffices = $_POST['fieldOffices'];
		$StfId = $_POST["StfId"];
		$meeting_rows = array();
	
		$meeting_date_str = date('d-m-Y', strtotime($meetingDate));
		$csv_fileName = 'meeting_data_'.$fieldOffices.'_'.$meetingDate.'.csv';
		
		//Get Meeting Data
		$query2 = "CALL usp_GetMeetingData('".$fieldOffices."', '".$meetingDate."', '".$MeetingDtTo."')";
		mysqli_multi_query($con, $query2);
		do {
			/* store the result set in PHP */
			if ($result2 = mysqli_store_result($con)) {
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
				//printf("%s\n", $row[0]);
				$MettingDt = $row2['MettingDt'];
				$StfCd = $row2['StfCd'];
				$GrpCd = $row2['GrpCd'];
				$MemCd = $row2['MemCnt'];
				$Attdance = $row2['AttCnt'];
				$CollAmt = $row2['CollAmt'];
				$CollDt = $row2['SBAcNo'];
				
				

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
