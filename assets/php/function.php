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
		$Caste = '';

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
					$Caste = $row['Caste'];
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
		$return_result['Caste'] = $Caste;

		sleep(1);
		echo json_encode($return_result);
	}//end function getMember
	
	//Update Caste
	if($fn == 'updateCaste'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$memberCode = $_POST["memberCode"];
		$memCst = $_POST["memCst"];
		
		$MemNm = '';
		$GurdNm = '';
		$GrpNm = '';
		$GrpCd = '';
		$StfCd = '';

		//Get Member
		$query = "CALL usp_UpdtMemInfo('".$memberCode."','".$memCst."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					/*$MemNm = $row['MemNm'];
					$GurdNm = $row['GurdNm'];
					$GrpNm = $row['GrpNm'];
					$GrpCd = $row['GrpCd'];
					$StfCd = $row['StfCd'];*/
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
		/*$return_result['MemNm'] = $MemNm;
		$return_result['GurdNm'] = $GurdNm;
		$return_result['GrpNm'] = $GrpNm;
		$return_result['GrpCd'] = $GrpCd;
		$return_result['StfCd'] = $StfCd;*/

		sleep(1);
		echo json_encode($return_result);
	}//end function getMember
	
	
	//DeLink Member
	if($fn == 'delinkMember'){
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
		$query = "CALL usp_ReleaseMember('".$memberCode."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
				/*while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$MemNm = $row['MemNm'];
					$GurdNm = $row['GurdNm'];
					$GrpNm = $row['GrpNm'];
					$GrpCd = $row['GrpCd'];
					$StfCd = $row['StfCd'];
				}*/
			}
			/* print divider */
			if (mysqli_more_results($con)) {
				//printf("-----------------\n");
			}
		} while (mysqli_next_result($con));
		/* execute multi query */		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		/*$return_result['MemNm'] = $MemNm;
		$return_result['GurdNm'] = $GurdNm;
		$return_result['GrpNm'] = $GrpNm;
		$return_result['GrpCd'] = $GrpCd;
		$return_result['StfCd'] = $StfCd;*/

		sleep(1);
		echo json_encode($return_result);
	}//end function getMember
	
	
	//withdraw Member
	if($fn == 'withdrawMember'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$memberCode = $_POST["memberCode"];

		//Get Member
		$query = "CALL usp_CloseMember('".$memberCode."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
			}
			/* print divider */
			if (mysqli_more_results($con)) {
				//printf("-----------------\n");
			}
		} while (mysqli_next_result($con));
		/* execute multi query */		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;

		sleep(1);
		echo json_encode($return_result);
	}//end function withdrawMember

	
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

	//update Mem Profile
	if($fn == 'updtMemProfile'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$memberCode = $_POST["memberCode"];
		$memberName = $_POST["memberName"];
		$gurdianName = $_POST["gurdianName"];
		
		$query = "CALL usp_UpdtMemProfile('".$memberCode."', '".$memberName."', '".$gurdianName."')";
		mysqli_multi_query($con, $query);
		
		sleep(1);
		$return_result['status'] = $status;
		echo json_encode($return_result);
	}//end function 
	
	//Meeting Data
	if($fn == 'getGroupMembers'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$collectionDate = $_POST["collectionDate"];
		$groupCode = $_POST["groupCode"];
		$StfId = $_POST["StfId"];	
		
		$GrpId = ''; 
		$GrpNm = '';
		$GrpAdd = '';
		$group_members = array();
		$grantCAmt = 0;
		$OpnAmt = 0;

		//GetGroup
		$query = "CALL usp_GetGroup('".$groupCode."')";
		mysqli_multi_query($con, $query);
		do {
			/* store the result set in PHP */
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$GrpId = $row['GrpId'];
					$GrpNm = $row['GrpNm'];
					$GrpAdd = $row['GrpAdd'];
				}
			}
			/* print divider */
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));

		//Get Group Members
		$query2 = "CALL usp_GetGroupMembers('".$groupCode."', '".$StfId."')";
		mysqli_multi_query($con, $query2);
		do {
			if ($result2 = mysqli_store_result($con)) {
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$MemId = $row2['MemId'];
					$MemNm = $row2['MemNm'];
					$Attnd = $row2['Attnd'];
					$CAmt = $row2['CAmt'];
					$OpnAmt = $row2['OpnAmt'];
					$Opening_Dues = $row2['OpDues'];
					if(isset($row2['MemCst'])){
						$MemCst = $row2['MemCst'];
					}else{
						$MemCst = '';
					}
					$grantCAmt = $grantCAmt + $CAmt;

					if($MemId != ''){
						$group_member = new stdClass();
						
						$group_member->MemId = $MemId; 
						$group_member->MemNm = $MemNm;
						$group_member->Attnd = $Attnd;
						$group_member->CAmt = $CAmt;
						$group_member->OpnAmt = $OpnAmt;
						$group_member->Opening_Dues = $Opening_Dues;
						$group_member->grantCAmt = $grantCAmt;
						$group_member->MemCst = $MemCst;

						array_push($group_members, $group_member);
					}
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['GrpId'] = $GrpId;
		$return_result['GrpNm'] = $GrpNm;
		$return_result['GrpAdd'] = $GrpAdd;
		$return_result['group_members'] = $group_members;
		$return_result['grantCAmt'] = $grantCAmt;

		sleep(1);
		echo json_encode($return_result);
	}//end function checkAccountNumber
	
	//Meeting Data
	if($fn == 'getMeetingReport'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$collectionDate = $_POST["collectionDate"];
		$groupCode = $_POST["groupCode"];
		$StfId = $_POST["StfId"];	
		
		$GrpId = ''; 
		$GrpNm = '';
		$GrpAdd = '';
		$group_reports = array();
		$grantCAmt = 0;
		$OpnAmt = 0;
		$MettingDt_heading = '';
		$GrpNm_heading = '';
		$ColAmt_st = 0;

		//Get Group Members
		$query2 = "CALL usp_GetMeetingReport('".$StfId."', '".$groupCode."', '".$collectionDate."')";
		mysqli_multi_query($con, $query2);
		do {
			if ($result2 = mysqli_store_result($con)) {
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					$MettingDt = $row2['MettingDt'];
					$GrpNm = $row2['GrpNm'];
					$MemNm = $row2['MemNm'];
					$Attnd = $row2['Attnd'];
					$ColAmt = $row2['ColAmt'];

					$MettingDt_heading = $MettingDt;
					$GrpNm_heading = $GrpNm;

					if($MettingDt != ''){
						$group_report = new stdClass();
						
						$group_report->MettingDt = $MettingDt; 
						$group_report->GrpNm = $GrpNm;
						$group_report->Attnd = $Attnd;
						$group_report->MemNm = $MemNm;
						$group_report->ColAmt = $ColAmt;
						$ColAmt_st = $ColAmt_st + $ColAmt;

						array_push($group_reports, $group_report);
					}
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['GrpNm_heading'] = $GrpNm_heading;
		$return_result['group_reports'] = $group_reports;
		$return_result['MettingDt_heading'] = $MettingDt_heading;
		$return_result['ColAmt_st'] = $ColAmt_st;

		sleep(1);
		echo json_encode($return_result);
	}//end
	
	//Delete Meeting Data
	if($fn == 'deleteMeetingData'){
		$return_result = array();
		$status = true;
		$error_msg = ''; 
		$meeting_date = $_POST["meeting_date"];
		$sb_ac = $_POST["sb_ac"];	
		

		$query = "CALL usp_DeleteCollection('".$sb_ac."', '".$meeting_date."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		
		$return_result['status'] = $status;
		

		//sleep(1);
		echo json_encode($return_result);
	}//end fu

	
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
		//$intRcptDate = $_POST["intRcptDate"];
		$groupAcNo = $_POST["groupAcNo"];
		$StfId = $_POST["StfId"];	
		$GrpId = '';
		$GrpNm = '';
		$GrpAdd = '';

		$query = "CALL usp_GetGroup('".$groupAcNo."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$GrpId = $row['GrpId'];
					$GrpNm = $row['GrpNm'];
					$GrpAdd = $row['GrpAdd'];
					$COpen = $row['COpen'];
					$BOpen = $row['BOpen'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		
		if($GrpNm == ''){
			$status = false;
		}
		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['GrpId'] = $GrpId;
		$return_result['GrpNm'] = $GrpNm;
		$return_result['GrpAdd'] = $GrpAdd;
		$return_result['COpen'] = $COpen;
		$return_result['BOpen'] = $BOpen;

		sleep(1);
		echo json_encode($return_result);
	}//end fu

	//save Interest Receipt
	if($fn == 'saveInterestAmount'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$openingAmtCash = $_POST["openingAmtCash"];
		$openingAmtBank = $_POST["openingAmtBank"];
		$groupAcNo = $_POST["groupAcNo"];
		//$intAmount = $_POST["intAmount"];
		$StfId = $_POST["StfId"];
		$VouPurpId = 2;

		//Insert Voucher
		$query = "CALL usp_InsertGroupOpening('".$groupAcNo."', '".$openingAmtCash."', '".$openingAmtBank."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;

		sleep(1);
		echo json_encode($return_result);
	}//end fu

	//save Voucher
	if($fn == 'saveVoucher'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$entryDate = $_POST["entryDate"];
		$groupAcNo = $_POST["groupAcNo"];
		$voucherType = $_POST["voucherType"];
		$voucherAmount = $_POST["voucherAmount"];
		$particulars = $_POST["particulars"];
		$StfId = $_POST["StfId"];	
		$VId = '';
		

		//usp_InsertVoucher
		$VouPurpId = $particulars;
		$query = "CALL usp_InsertVoucher('".$groupAcNo."', '".$entryDate."', '".$VouPurpId."', '".$voucherAmount."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$VId = $row['Id'];
					//$GrpAdd = $row['GrpAdd'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		

		$return_result['status'] = $status;
		$return_result['VId'] = $VId;
		$return_result['error_msg'] = $error_msg;
		
		sleep(1);
		echo json_encode($return_result);
	}//end fu

	//delete Voucher
	if($fn == 'deleteVoucher'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$entryDate = $_POST["entryDate"];
		$groupAcNo = $_POST["groupAcNo"];
		$voucherType = $_POST["voucherType"];
		$voucherAmount = $_POST["voucherAmount"];
		$particulars = $_POST["particulars"];
		$StfId = $_POST["StfId"];
		
		//usp_DeleteVoucher
		$VouPurpId = $particulars;
		$query = "CALL usp_DeleteVoucher('".$groupAcNo."', '".$entryDate."', '".$VouPurpId."', '".$voucherAmount."', '".$StfId."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					//$GrpNm = $row['GrpNm'];
					//$GrpAdd = $row['GrpAdd'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		
		sleep(1);
		echo json_encode($return_result);
	}//end fu

	
	
	//Show cashbook report
	if($fn == 'showCashBook'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$fromDate = $_POST["fromDate"];
		$uptoDate = $_POST["uptoDate"];
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
	//save Cashbook Report
	if($fn == 'showCashBookReport'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$fromDate = $_POST["fromDate"];
		$uptoDate = $_POST["uptoDate"];
		$groupAcNo = $_POST["groupAcNo"];
		$StfId = $_POST["StfId"];
		
		$cb_rows = array();
		
		$OpnCash = '';
		$OpnBank = '';
		$ClsCash = '';
		$ClsBank = '';

		$sTotalRCash = 0;
		$sTotalRBank = 0;
		$sTotalPCash = 0;
		$sTotalPBank = 0;

		$TotalRCash = 0;
		$TotalRBank = 0;
		$TotalPCash = 0;
		$TotalPBank = 0;

		//Get Cas Bank Fig
		$query = "CALL usp_GetCasBankFig('".$groupAcNo."', '".$fromDate."', '".$uptoDate."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$OpnCash = $row['OpnCash'];
					$OpnBank = $row['OpnBank'];
					$ClsCash = $row['ClsCash'];
					$ClsBank = $row['ClsBank'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));

		//View Cash Book
		$query = "CALL usp_ViewCashBook('".$groupAcNo."', '".$fromDate."', '".$uptoDate."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {				
				if(mysqli_num_rows($result) > 0){
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						//printf("%s\n", $row[0]);
						$SlNo = $row['SlNo'];
						$RDate =$row['RDate'];
						$RParti = $row['RParti'];
						$RCash = $row['RCash'];
						$RBank = $row['RBank'];
						$PDate =$row['PDate'];
						$PParti = $row['PParti'];
						$PCash = $row['PCash'];
						$PBank = $row['PBank'];

						$cb_row = new stdClass();
						$cb_row->SlNo = $SlNo;
						
						$cb_row->RDate = ($RDate != null)? date('d-m-Y', strtotime($RDate)) : '';
						$cb_row->RParti = ($RParti != null)? $RParti : '';
						$cb_row->RCash = ($RCash != null)? $RCash : '0.00';
						$cb_row->RBank = ($RBank != null)? $RBank : '0.00';
						$cb_row->PDate = ($PDate != null)? date('d-m-Y', strtotime($PDate)) : '';
						$cb_row->PParti = ($PParti != null)? $PParti : '';
						$cb_row->PCash = ($PCash != null)? $PCash : '0.00';
						$cb_row->PBank = ($PBank != null)? $PBank : '0.00';

						array_push($cb_rows, $cb_row);

						$sTotalRCash = $sTotalRCash + $RCash;
						$sTotalRBank = $sTotalRBank + $RBank;
						$sTotalPCash = $sTotalPCash + $PCash;
						$sTotalPBank = $sTotalPBank + $PBank;
					}
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		

		$TotalRCash = $sTotalRCash + $OpnCash;
		$TotalRBank = $sTotalRBank + $OpnBank;
		$TotalPCash = $sTotalPCash + $ClsCash;
		$TotalPBank = $sTotalPBank + $ClsBank;

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['OpnCash'] = $OpnCash;
		$return_result['OpnBank'] = $OpnBank;
		$return_result['ClsCash'] = $ClsCash;
		$return_result['ClsBank'] = $ClsBank;
		$return_result['cb_rows'] = $cb_rows;
		
		$return_result['sTotalRCash'] = number_format($sTotalRCash, 2);
		$return_result['sTotalRBank'] = number_format($sTotalRBank, 2);
		$return_result['sTotalPCash'] = number_format($sTotalPCash, 2);
		$return_result['sTotalPBank'] = number_format($sTotalPBank, 2);
		
		$return_result['TotalRCash'] = number_format($TotalRCash, 2);
		$return_result['TotalRBank'] = number_format($TotalRBank, 2);
		$return_result['TotalPCash'] = number_format($TotalPCash, 2);
		$return_result['TotalPBank'] = number_format($TotalPBank, 2);

		$return_result['fromDateN'] = date('d-m-Y', strtotime($fromDate));
		$return_result['uptoDateN'] = date('d-m-Y', strtotime($uptoDate));

		sleep(1);
		echo json_encode($return_result);
	}//end fu

	
	
	//Link Group 1st Part
	if($fn == 'linkGroupShow'){
		$return_result = array();
		$status = true;
		$error_msg = '';
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
	//Link Group 2nd part	
	if($fn == 'linkGroupSave'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		$groupAcNo = $_POST["groupAcNo"];
		$StfId = $_POST["StfId"];	
		
		$interestAmt = 100;

		//GetGroup
		$query = "CALL usp_UpdtGroupStaff('".$groupAcNo."', '".$StfId."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					//$GrpNm = $row['GrpNm'];
					//$GrpAdd = $row['GrpAdd'];
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;

		sleep(1);
		echo json_encode($return_result);
	}//end fu
	
	//Get Particulars
	if($fn == 'getPurpose'){
		$return_result = array();
		$purposes = array();
		$status = true;
		$error_msg = '';
		$voucherType = $_POST["voucherType"];

		$query2 = "CALL usp_GetPurpose('".$voucherType."')";
		mysqli_multi_query($con, $query2);
		do {
			if ($result2 = mysqli_store_result($con)) {
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					//printf("%s\n", $row[0]);
					$Id = $row2['Id'];
					$Purpose = $row2['Purpose'];

					if($Id != ''){
						$purpose = new stdClass();						
						$purpose->Id = $Id; 
						$purpose->Purpose = $Purpose;
						array_push($purposes, $purpose);
					}
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		
		sleep(1);
		$return_result['status'] = $status;
		$return_result['purposes'] = $purposes;
		echo json_encode($return_result);
	}//end function 

	//Dashboard more
	if($fn == 'deleteCollectionRecord'){
		$return_result = array();
		$status = true;
		$error_msg = '';
		//$intRcptDate = $_POST["intRcptDate"];
		$meeting_date = $_POST["meeting_date"];
		$sb_ac = $_POST["sb_ac"];	
		

		$query = "CALL usp_DeleteCollection('".$sb_ac."', '".$meeting_date."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		
		$return_result['status'] = $status;
		

		sleep(1);
		echo json_encode($return_result);
	}//end fu

	//Reports
	
	//show Mem List Report
	if($fn == 'showMemListReport'){
		$GrpSBAc = $_POST["GrpSBAc"];
		$StfId = $_POST["StfId"];

		$return_result = array();
		$status = true;
		$error_msg = '';
			
		$memlist_rows = array();
		

		//View Cash Book
		$query = "CALL usp_GetMembersList('".$GrpSBAc."', '".$StfId."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {				
				if(mysqli_num_rows($result) > 0){
					$status = true;
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						//printf("%s\n", $row[0]);
																													
						$Sl = $row['Sl'];
						$MemId = $row['MemId'];
						$MemNm = $row['MemNm'];
						$GurdNm = $row['GurdNm'];
						$Village = $row['Village'];
						$Aadhar = $row['Aadhar'];
						$PAN = $row['PAN'];
						$Voter = $row['Voter'];
						$Caste = $row['Caste'];

						if($Sl != ''){
							$memlist_row = new stdClass();
							$memlist_row->Sl = $Sl;
							$memlist_row->MemId = $MemId;
							$memlist_row->MemNm = $MemNm;
							$memlist_row->GurdNm = $GurdNm;
							$memlist_row->Village = $Village;
							$memlist_row->Aadhar = $Aadhar;
							$memlist_row->PAN = $PAN;
							$memlist_row->Voter = $Voter;
							$memlist_row->Caste = $Caste;
											
							array_push($memlist_rows, $memlist_row);
						}						
					}
				}else{
					$status = false;
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		
		if(sizeof($memlist_rows) > 0){
			$status = true;
		}else{
			$status = false;
		}
		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['memlist_rows'] = $memlist_rows;	
		

		sleep(1);
		echo json_encode($return_result);
	}//end fu
	
	//show Attendance Report
	if($fn == 'showAttendanceReport'){
		$GrpSBAc = $_POST["GrpSBAc"];
		$FinYrFrmTo = $_POST["FinYrFrmTo"];
		$UptoDate = $_POST["UptoDate"];
		$return_result = array();
		$status = true;
		$error_msg = '';		
		$FinYrFrm = '';
		$FinYrTo = '';
		$FinYrFrmToStr = explode("_", $FinYrFrmTo);		
		$FinYrFrm = $FinYrFrmToStr[0];
		$FinYrTo = $FinYrFrmToStr[1];		
		$attn_rows = array();	
		$fin_yr = $FinYrFrm.' '.$FinYrTo;

		//View Cash Book
		$query = "CALL usp_RptAttendance('".$GrpSBAc."', '".$FinYrFrm."', '".$FinYrTo."', '".$UptoDate."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {				
				if(mysqli_num_rows($result) > 0){
					$status = true;
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						//printf("%s\n", $row[0]);
																							
						$Sl = $row['Sl'];
						$GrpNm = $row['GrpNm'];
						$FinYr = $row['FinYr'];
						$MemId = $row['MemId'];
						$MemberNm = $row['MemberNm'];
						$MnthApr = $row['MnthApr'];
						$MnthMay = $row['MnthMay'];
						$MnthJun = $row['MnthJun'];
						$MnthJly = $row['MnthJly'];
						$MnthAug = $row['MnthAug'];
						$MnthSep = $row['MnthSep'];
						$MnthOct = $row['MnthOct'];
						$MnthNov = $row['MnthNov'];
						$MnthDec = $row['MnthDec'];
						$MnthJan = $row['MnthJan'];
						$MnthFeb = $row['MnthFeb'];
						$MnthMar = $row['MnthMar'];
						$Percnt = $row['Percnt'];

						$attn_row = new stdClass();
						$attn_row->Sl = $Sl;
						$attn_row->GrpNm = $GrpNm;
						$attn_row->FinYr = $FinYr;
						$attn_row->MemId = $MemId;
						$attn_row->MemberNm = $MemberNm;
						$attn_row->MnthApr = $MnthApr;
						$attn_row->MnthMay = $MnthMay;
						$attn_row->MnthJun = $MnthJun;
						$attn_row->MnthJly = $MnthJly;
						$attn_row->MnthAug = $MnthAug;
						$attn_row->MnthSep = $MnthSep;
						$attn_row->MnthOct = $MnthOct;
						$attn_row->MnthNov = $MnthNov;
						$attn_row->MnthDec = $MnthDec;
						$attn_row->MnthJan = $MnthJan;
						$attn_row->MnthFeb = $MnthFeb;
						$attn_row->MnthMar = $MnthMar;
						$attn_row->Percnt = $Percnt;					
						array_push($attn_rows, $attn_row);						
					}
				}else{
					$status = false;
				}
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['attn_rows'] = $attn_rows;	
		$return_result['fin_yr'] = $fin_yr;			

		sleep(1);
		echo json_encode($return_result);
	}//end fu
	
	//Savings Ledger Report	
	if($fn == 'showSavingLedgerReport'){
		$GrpSBAc = $_POST["GrpSBAc"];
		$FinYrFrmTo = $_POST["FinYrFrmTo"];
		$UptoDate = $_POST["UptoDate"];
		$return_result = array();
		$status = true;
		$error_msg = '';		
		$FinYrFrm = '';
		$FinYrTo = '';
		$FinYrFrmToStr = explode("_", $FinYrFrmTo);		
		$FinYrFrm = $FinYrFrmToStr[0];
		$FinYrTo = $FinYrFrmToStr[1];		
		$sl_rows = array();	
		$st_row = array();	
		$fin_yr = $FinYrFrm.' '.$FinYrTo;

		$st_SBOpnAmt = 0;
		$st_MnthApr = 0;
		$st_MnthMay = 0;
		$st_MnthJun = 0;
		$st_MnthJly = 0;
		$st_MnthAug = 0;
		$st_MnthSep = 0;
		$st_MnthOct = 0;
		$st_MnthNov = 0;
		$st_MnthDec = 0;
		$st_MnthJan = 0;
		$st_MnthFeb = 0;
		$st_MnthMar = 0;
		$st_YrTotal = 0;
		$st_SBClsAmt = 0;
		$st_DueOpnAmt = 0;
		$st_DueThisYr = 0;
		$st_DueClsAmt = 0;

		//View Cash Book
		$query = "CALL usp_RptSavings('".$GrpSBAc."', '".$FinYrFrm."', '".$FinYrTo."', '".$UptoDate."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {				
				if(mysqli_num_rows($result) > 0){
					$status = true;
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						//printf("%s\n", $row[0]);																					
						$Sl = $row['Sl'];
						$GrpNm = $row['GrpNm'];
						$FinYr = $row['FinYr'];
						$MemId = $row['MemId'];
						$MemberNm = $row['MemberNm'];
						$SBOpnAmt = $row['SBOpnAmt'];
						$MnthApr = $row['MnthApr'];
						$MnthMay = $row['MnthMay'];
						$MnthJun = $row['MnthJun'];
						$MnthJly = $row['MnthJly'];
						$MnthAug = $row['MnthAug'];
						$MnthSep = $row['MnthSep'];
						$MnthOct = $row['MnthOct'];
						$MnthNov = $row['MnthNov'];
						$MnthDec = $row['MnthDec'];
						$MnthJan = $row['MnthJan'];
						$MnthFeb = $row['MnthFeb'];
						$MnthMar = $row['MnthMar'];
						$YrTotal = $row['YrTotal'];
						$SBClsAmt = $row['SBClsAmt'];
						$DueOpnAmt = $row['DueOpnAmt'];
						$DueThisYr = $row['DueThisYr'];
						$DueClsAmt = $row['DueClsAmt'];

						$sl_row = new stdClass();
						$sl_row->Sl = $Sl;
						$sl_row->GrpNm = $GrpNm;
						$sl_row->FinYr = $FinYr;
						$sl_row->MemId = $MemId;
						$sl_row->MemberNm = $MemberNm;
						$sl_row->SBOpnAmt = $SBOpnAmt;
						$sl_row->MnthApr = $MnthApr;
						$sl_row->MnthMay = $MnthMay;
						$sl_row->MnthJun = $MnthJun;
						$sl_row->MnthJly = $MnthJly;
						$sl_row->MnthAug = $MnthAug;
						$sl_row->MnthSep = $MnthSep;
						$sl_row->MnthOct = $MnthOct;
						$sl_row->MnthNov = $MnthNov;
						$sl_row->MnthDec = $MnthDec;
						$sl_row->MnthJan = $MnthJan;
						$sl_row->MnthFeb = $MnthFeb;
						$sl_row->MnthMar = $MnthMar;
						$sl_row->YrTotal = $YrTotal;	
						$sl_row->SBClsAmt = $SBClsAmt;
						$sl_row->DueOpnAmt = $DueOpnAmt;
						$sl_row->DueThisYr = $DueThisYr;
						$sl_row->DueClsAmt = $DueClsAmt;				
						array_push($sl_rows, $sl_row);

						$st_SBOpnAmt = $st_SBOpnAmt + $SBOpnAmt;
						$st_MnthApr = $st_MnthApr + $MnthApr;
						$st_MnthMay = $st_MnthMay + $MnthMay;
						$st_MnthJun = $st_MnthJun + $MnthJun;
						$st_MnthJly = $st_MnthJly + $MnthJly;
						$st_MnthAug = $st_MnthAug + $MnthAug;
						$st_MnthSep = $st_MnthSep + $MnthSep;
						$st_MnthOct = $st_MnthOct + $MnthOct;
						$st_MnthNov = $st_MnthNov + $MnthNov;
						$st_MnthDec = $st_MnthDec + $MnthDec;
						$st_MnthJan = $st_MnthJan + $MnthJan;
						$st_MnthFeb = $st_MnthFeb + $MnthFeb;
						$st_MnthMar = $st_MnthMar + $MnthMar;
						$st_YrTotal = $st_YrTotal + $YrTotal;
						$st_SBClsAmt = $st_SBClsAmt + $SBClsAmt;
						$st_DueOpnAmt = $st_DueOpnAmt +$DueOpnAmt;
						$st_DueThisYr = $st_DueThisYr + $DueThisYr;
						$st_DueClsAmt = $st_DueClsAmt + $DueClsAmt;
					}//end while

						$st_row = new stdClass();
						$st_row->st_SBOpnAmt = number_format($st_SBOpnAmt, 2);
						$st_row->st_MnthApr = number_format($st_MnthApr, 2);
						$st_row->st_MnthMay = number_format($st_MnthMay, 2);
						$st_row->st_MnthJun = number_format($st_MnthJun, 2);
						$st_row->st_MnthJly = number_format($st_MnthJly, 2);
						$st_row->st_MnthAug = number_format($st_MnthAug, 2);
						$st_row->st_MnthSep = number_format($st_MnthSep, 2);
						$st_row->st_MnthOct = number_format($st_MnthOct, 2);
						$st_row->st_MnthNov = number_format($st_MnthNov, 2);
						$st_row->st_MnthDec = number_format($st_MnthDec, 2);
						$st_row->st_MnthJan = number_format($st_MnthJan, 2);
						$st_row->st_MnthFeb = number_format($st_MnthFeb, 2);
						$st_row->st_MnthMar = number_format($st_MnthMar, 2);
						$st_row->st_YrTotal = number_format($st_YrTotal, 2);	
						$st_row->st_SBClsAmt = number_format($st_SBClsAmt, 2);
						$st_row->st_DueOpnAmt = number_format($st_DueOpnAmt, 2);
						$st_row->st_DueThisYr = number_format($st_DueThisYr, 2);
						$st_row->st_DueClsAmt = number_format($st_DueClsAmt, 2);
				}else{
					$status = false;
				}//end if
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));
		

		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['sl_rows'] = $sl_rows;	
		$return_result['st_row'] = $st_row;	
		$return_result['fin_yr'] = $fin_yr;			

		sleep(1);
		echo json_encode($return_result);
	}//end fu
	
	//Savings Ledger Report	
	if($fn == 'showLoanRegisterReport'){
		$GrpSBAc = $_POST["GrpSBAc"];
		$StfId = $_SESSION["StfId"];

		$return_result = array();
		$status = true;
		$error_msg = '';
		$group_name = '';
		$month_year = '';
		$recovery_rate = 0;
				
		$sl_rows = array();	
		$st_row = array();	
		

		$st_LnAmt = 0;
		$st_Outs = 0;
		$st_Exptd = 0;
		$st_Repaid = 0;
		$st_ODue = 0;

		//View Cash Book
		$query = "CALL usp_GenLoanRegister('".$GrpSBAc."', '".$StfId."')";
		mysqli_multi_query($con, $query);
		do {
			if ($result = mysqli_store_result($con)) {				
				if(mysqli_num_rows($result) > 0){
					$status = true;
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						//printf("%s\n", $row[0]);																					
						$Sl = $row['Sl'];
						$MemNm = $row['MemNm'];
						$AcNo = $row['AcNo'];
						$LnAmt = $row['LnAmt'];
						$LnDt = $row['LnDt'];
						$Purpose = $row['Purpose'];
						$Outs = $row['Outs'];
						$Exptd = $row['Exptd'];
						$Repaid = $row['Repaid'];
						$ODue = $row['ODue'];
						$GrpNm = $row['GrpNm'];
						$AsOn = $row['AsOn'];

						$sl_row = new stdClass();
						$sl_row->Sl = $Sl;
						$sl_row->MemNm = $MemNm;
						$sl_row->AcNo = $AcNo;
						$sl_row->LnAmt = $LnAmt;
						$sl_row->LnDt = $LnDt;
						$sl_row->Purpose = $Purpose;
						$sl_row->Outs = $Outs;
						$sl_row->Exptd = $Exptd;
						$sl_row->Repaid = $Repaid;
						$sl_row->ODue = $ODue;
						$sl_row->GrpNm = $GrpNm;
						$sl_row->AsOn = $AsOn;			
						array_push($sl_rows, $sl_row);

						$st_LnAmt = $st_LnAmt + $LnAmt;
						$st_Outs = $st_Outs + $Outs;
						$st_Exptd = $st_Exptd + $Exptd;
						$st_Repaid = $st_Repaid + $Repaid;
						$st_ODue = $st_ODue + $ODue;
						
						$group_name = $GrpNm;
						$month_year = $AsOn;
					}//end while

						$st_row = new stdClass();
						$st_row->st_LnAmt = number_format($st_LnAmt, 2);
						$st_row->st_Outs = number_format($st_Outs, 2);
						$st_row->st_Exptd = number_format($st_Exptd, 2);
						$st_row->st_Repaid = number_format($st_Repaid, 2);
						$st_row->st_ODue = number_format($st_ODue, 2);

						$recovery_rate1 = (($st_Exptd - $st_ODue) / $st_Exptd) * 100;
						$recovery_rate = number_format($recovery_rate1, 2);
				}else{
					$status = false;
				}//end if
			}
			if (mysqli_more_results($con)) {
			}
		} while (mysqli_next_result($con));


		$return_result['status'] = $status;
		$return_result['error_msg'] = $error_msg;
		$return_result['sl_rows'] = $sl_rows;	
		$return_result['st_row'] = $st_row;	
		$return_result['group_name'] = $group_name;	
		$return_result['month_year'] = date('F, Y', strtotime($month_year));
		$return_result['recovery_rate'] = $recovery_rate;		

		sleep(1);
		echo json_encode($return_result);
	}//end fu
	
?>