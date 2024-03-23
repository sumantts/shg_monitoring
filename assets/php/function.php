<?php
	include('sql_conn.php');
	
	$fn = $_POST["fn"];
	
	//Login function
	if($fn == 'doLogin'){
		$return_result = array();
		$PrmUsrNm = $_POST["username"];
		$PrmUsrPwd = $_POST["password"];
		$status = true;
		$StfId = '';
		$StfNm = '';

		$query = "CALL usp_StaffLogIn('".$PrmUsrNm."', '".$PrmUsrPwd."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
				$status = true;
				$message = 'Username or password match';
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$StfId = $row['StfId'];
					$StfNm = $row['StfNm']; 
					
					$_SESSION['StfId'] = $StfId;
					$_SESSION['StfNm'] = $StfNm;
				}
			}
			/* print divider */
			if (mysqli_more_results($con)) {
				//printf("-----------------\n");
			}
		} while (mysqli_next_result($con));

		if($StfId == ''){
			$status = false;
			$message = 'Username or password does not match';
		}
		$return_result['status'] = $status;
		$return_result['message'] = $message;
		$return_result['StfId'] = $StfId;
		$return_result['StfNm'] = $StfNm;
		
		echo json_encode($return_result);
	}//end function doLogin
	
	//Link Member
	if($fn == 'getMember'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$memberCode = $_POST["memberCode"];
		
		$MemNm = '';
		$GurdNm = '';
		$GrpNm = '';
		$GrpCd = '';
		$StfCd = '';

		//Get Member
		$query = "CALL usp_GetMember('".$memberCode."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$MemNm = $row['MemNm'];
					$GurdNm = $row['GurdNm'];
					$GrpNm = $row['GrpNm'];
					$GrpCd = $row['GrpCd'];
					$StfCd = $row['StfCd'];
				}
			}
			/* print divider */
			if (mysqli_more_results($con)) {
				//printf("-----------------\n");
			}
		} while (mysqli_next_result($con));
		/* execute multi query */		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['MemNm'] = $MemNm;
		$return_result['GurdNm'] = $GurdNm;
		$return_result['GrpNm'] = $GrpNm;
		$return_result['GrpCd'] = $GrpCd;
		$return_result['StfCd'] = $StfCd;

		sleep(1);
		echo json_encode($return_result);
	}//end function getMember
	//Validate function
	if($fn == 'usp_GetGroup'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$GrpId = '';
		$GrpNm = '';
		$GrpAdd = '';
		$savings_ac_no = $_POST["savings_ac_no"];
		
		$query = "CALL usp_GetGroup('".$savings_ac_no."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$GrpId = $row['GrpId'];
					$GrpNm = $row['GrpNm'];
					$GrpAdd = $row['GrpAdd'];
				}
			}
			/* print divider */
			if (mysqli_more_results($con)) {
				//printf("-----------------\n");
			}
		} while (mysqli_next_result($con));
		
		if($GrpId != ''){
			$status = true;			
		}else{
			$status = false;
		}
		sleep(1);
		$return_result['status'] = $status;
		$return_result['GrpId'] = $GrpId;
		$return_result['GrpNm'] = $GrpNm;
		$return_result['GrpAdd'] = $GrpAdd;
		echo json_encode($return_result);
	}//end function getMember

	//Update Linked Member
	if($fn == 'updtMemStaff'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$memberCode = $_POST["memberCode"];
		$group_code = $_POST["group_code"];
		$staff_code = $_POST["staff_code"];
		$GrpId = $_POST["GrpId"];
		
		$query = "CALL usp_UpdtMemStaff('".$memberCode."', '".$GrpId."', '".$staff_code."')";
		mysqli_multi_query($con, $query);
		
		sleep(1);
		$return_result['status'] = $status;
		echo json_encode($return_result);
	}//end function getMember
	
	//Meeting Data
	if($fn == 'getGroupMembers'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$collectionDate = $_POST["collectionDate"];
		$groupCode = $_POST["groupCode"];
		$StfId = $_POST["StfId"];	
		
		$GrpNm = '';
		$GrpAdd = '';
		$group_members = array();
		$grantCAmt = 0;

		//GetGroup
		$query = "CALL usp_GetGroup('".$groupCode."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$GrpNm = $row['GrpNm'];
					$GrpAdd = $row['GrpAdd'];
				}
			}
			/* print divider */
			if (mysqli_more_results($con)) {
				//printf("-----------------\n");
			}
		} while (mysqli_next_result($con));
		/* execute multi query */

		//Get Group Members
		$query2 = "CALL usp_GetGroupMembers('".$groupCode."', '".$StfId."')";
		mysqli_multi_query($con, $query2);
		do {
			/* store the result set in PHP */
			if ($result2 = mysqli_store_result($con)) {
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$MemId = $row2['MemId'];
					$MemNm = $row2['MemNm'];
					$Attnd = $row2['Attnd'];
					$CAmt = $row2['CAmt'];
					$grantCAmt = $grantCAmt + $CAmt;

					if($MemId != ''){
						$group_member = new stdClass();
						
						$group_member->MemId = $MemId; 
						$group_member->MemNm = $MemNm;
						$group_member->Attnd = $Attnd;
						$group_member->CAmt = $CAmt;

						array_push($group_members, $group_member);
					}
				}
			}
			/* print divider */
			if (mysqli_more_results($con)) {
				//printf("-----------------\n");
			}
		} while (mysqli_next_result($con));
		/* execute multi query */

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['GrpNm'] = $GrpNm;
		$return_result['GrpAdd'] = $GrpAdd;
		$return_result['group_members'] = $group_members;
		$return_result['grantCAmt'] = $grantCAmt;

		sleep(1);
		echo json_encode($return_result);
	}//end function checkAccountNumber
	
	
	//Update Passowrd
	
	
	//Update Password
	if($fn == 'updtStaffPwd'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$new_password = $_POST["new_password"];
		$StfId = $_POST["StfId"];
		
		$query = "CALL usp_UpdtStaffPwd('".$StfId."', '".$new_password."')";
		mysqli_multi_query($con, $query);
		
		sleep(1);
		$return_result['status'] = $status;
		echo json_encode($return_result);
	}//end function getMember

	
	
	//Interest Receipt
	if($fn == 'showInterestAmount'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$intRcptDate = $_POST["intRcptDate"];
		$groupAcNo = $_POST["groupAcNo"];
		$StfId = $_POST["StfId"];	
		
		$interestAmt = 100;

		//GetGroup
		/*$query = "CALL usp_GetGroup('".$groupCode."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$GrpNm = $row['GrpNm'];
					$GrpAdd = $row['GrpAdd'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));*/
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['interestAmt'] = $interestAmt;

		sleep(1);
		echo json_encode($return_result);
	}//end fu

	//save Interest Receipt
	if($fn == 'saveInterestAmount'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$intRcptDate = $_POST["intRcptDate"];
		$groupAcNo = $_POST["groupAcNo"];
		$StfId = $_POST["StfId"];	
		
		$interestAmt = 100;

		//GetGroup
		/*$query = "CALL usp_GetGroup('".$groupCode."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$GrpNm = $row['GrpNm'];
					$GrpAdd = $row['GrpAdd'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));*/
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['interestAmt'] = $interestAmt;

		sleep(1);
		echo json_encode($return_result);
	}//end fu

	//save Voucher
	if($fn == 'saveVoucher'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$entryDate = $_POST["entryDate"];
		$voucherType = $_POST["voucherType"];
		$voucherAmount = $_POST["voucherAmount"];
		$particulars = $_POST["particulars"];
		$StfId = $_POST["StfId"];	
		

		//GetGroup
		/*$query = "CALL usp_GetGroup('".$groupCode."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$GrpNm = $row['GrpNm'];
					$GrpAdd = $row['GrpAdd'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));*/
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		
		sleep(1);
		echo json_encode($return_result);
	}//end fu

	
?>