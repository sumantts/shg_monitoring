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
					$grantCAmt = $grantCAmt + $CAmt;

					if($MemId != ''){
						$group_member = new stdClass();
						
						$group_member->MemId = $MemId; 
						$group_member->MemNm = $MemNm;
						$group_member->Attnd = $Attnd;
						$group_member->CAmt = $CAmt;
						$group_member->OpnAmt = $OpnAmt;

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
		

		//usp_InsertVoucher
		$VouPurpId = $particulars;
		$query = "CALL usp_InsertVoucher('".$groupAcNo."', '".$entryDate."', '".$VouPurpId."', '".$voucherAmount."')";
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

	
?>