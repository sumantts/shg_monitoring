
	//Login Page Function
	$( "#login_btn" ).on( "click", function() {
		$username = $('#username').val();
		$password = $('#password').val();

		if($username == '' || $password == ''){
			$('#error_text').html('Please enter staff code and password');
		}else{
			$('#error_text').html('');

			$.ajax({
			method: "POST",
			url: "assets/php/function.php",
			data: { fn: "doLogin", username: $username, password: $password }
			})
			.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					window.location.href = '?p=dashboard';
				}else{
					//alert($res1.message);
					$('#error_text').html($res1.message);
				}
			});
			return false;
		}
	});
	
	
	//Link Member
	$( "#getMember" ).on( "click", function() {
		$memberCode = $('#memberCode').val();
		$('#part_tow').hide();
		$('#part_three').hide();

		if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else{	
			$('#memberCode_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "getMember", memberCode: $memberCode }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					if($res1.MemNm != ''){
						$('#MemNm').html( $res1.MemNm);
						$('#GurdNm').html( $res1.GurdNm);
						$('#GrpCd').html( $res1.GrpCd);
						$('#GrpNm').html( $res1.GrpNm);
						$('#StfCd').html( $res1.StfCd);
						$('#group_code').val($res1.GrpCd);
						$('#memCst').val($res1.Caste).trigger('change');
						
						$('#memberName').val( $res1.MemNm);
						$('#gurdianName').val( $res1.GurdNm);
						//$('#staff_code').val($res1.StfCd);
						$('#part_tow').show();
					}else{
						$('#part_three').show();
					}
				}else{
					$('#form_success').html('');
					$('#form_error').html($res1.error_msg);
					return false;
				}
			});
		}//end if
	});
	
	
	//Link Member
	$( "#updateCaste" ).on( "click", function() {
		$memberCode = $('#memberCode').val();
		$memCst = $('#memCst').val();
		$('#part_tow').hide();
		$('#part_three').hide();

		if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else{	
			$('#memberCode_error').html('');
			$('#memCst_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "updateCaste", memberCode: $memberCode, memCst: $memCst }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){ 
					alert('Caste Updated successfully');
				}//end if 
			});
		}//end if
	});
	
	
	//UnLink Member
	$( "#delinkMember" ).on( "click", function() {
		$memberCode = $('#memberCode').val();
		$('#part_tow').hide();
		$('#part_three').hide();

		if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else{	
			if(confirm('Are you sure to Delink?')){				
				$('#memberCode_error').html('');
				$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "delinkMember", memberCode: $memberCode }
				})
				.done(function( res ) {
					//console.log(res);
					$res1 = JSON.parse(res);
					if($res1.status == true){
						if($res1.MemNm != ''){
							alert('Member Delinked successfully');
						}
					}else{
						$('#form_success').html('');
						$('#form_error').html($res1.error_msg);
						return false;
					}
				});
			}//confirm
		}//end if
	});
	
	
	//Withdraw Member
	$( "#withdrawMember" ).on( "click", function() {
		$memberCode = $('#memberCode').val();
		$('#part_tow').hide();
		$('#part_three').hide();

		if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else{	
			if(confirm('Are you sure to Withdraw?')){				
				$('#memberCode_error').html('');
				$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "withdrawMember", memberCode: $memberCode }
				})
				.done(function( res ) {
					//console.log(res);
					$res1 = JSON.parse(res);
					if($res1.status == true){
						if($res1.MemNm != ''){
							alert('Member Withdraw successfully');
						}
					}else{
						$('#form_success').html('');
						$('#form_error').html($res1.error_msg);
						return false;
					}
				});
			}//confirm
		}//end if
	});

	//Validate	
	$( "#savings_ac_no_validate" ).on( "click", function() {
		$savings_ac_no = $('#savings_ac_no').val();

		$('#savings_ac_no_success').html('');
		$('#savings_ac_no_error').html('');
		$('#last_part').hide();

		if($savings_ac_no == ''){
			$('#savings_ac_no_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{	
			$('#savings_ac_no_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "usp_GetGroup", savings_ac_no: $savings_ac_no }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#last_part').show();
					$('#GrpId').val($res1.GrpId);					
					$('#savings_ac_no_success').html('Validated successfully'); 
				}else{
					$('#savings_ac_no_error').html('Not Validated'); 					
					return false;
				}
			});
		}//end if
	});
	//End Validate

	//Update Linked Member
	$( "#updtMemStaff" ).on( "click", function() {
		$memberCode = $('#memberCode').val();
		$group_code = $('#group_code').val();
		$staff_code = $('#staff_code').val();
		$GrpId = $('#GrpId').val();

		if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else if($GrpId == ''){
			$('#savings_ac_no_error').html('Account Validation Error');
			return false;
		}else{	
			$('#memberCode_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "updtMemStaff", memberCode: $memberCode, group_code: $group_code, staff_code: $staff_code, GrpId: $GrpId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					alert('Member Linked successfully');
				}else{
					$('#form_success').html('');
					$('#form_error').html($res1.error_msg);
					return false;
				}
			});
		}//end if
	});
	//Update Linked Member End

	//updtMemProfile
	$( "#updtMemProfile" ).on( "click", function() {
		$memberCode = $('#memberCode').val();
		$memberName = $('#memberName').val();
		$gurdianName = $('#gurdianName').val();
		//$GrpId = $('#GrpId').val();

		if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else if($memberName == ''){
			$('#memberName_error').html('Please enter Member Name');
			return false;
		}else if($gurdianName == ''){
			$('#gurdianName_error').html('Please enter Gurdian Name');
			return false;
		}else{	
			$('#memberCode_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "updtMemProfile", memberCode: $memberCode, memberName: $memberName, gurdianName: $gurdianName }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					alert('Member Profile Updated Successfully');
				}else{
					$('#form_success').html('');
					$('#form_error').html($res1.error_msg);
					return false;
				}
			});
		}//end if
	});

	//Opening Data
	$( "#getGroupMembers1" ).on( "click", function() {
		$collectionDate = '';//$('#collectionDate').val();
		$groupCode = $('#groupCode').val();
		$StfId = $('#StfId').val();
		
		$('#collectionDate_success').html('');
		$('#collectionDate_error').html('');
		$('#groupCode_success').html('');
		$('#groupCode_error').html('');
		$('#GrpNm').html('Group Name: ');
		$('#GrpAdd').html('Group Address: ');
		$html = '';
		$('#group_members_list1').html($html);
		$('#part_two').hide();
		$('#part_three').hide();

		if($groupCode == ''){
			$('#groupCode_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{	
			$('#collectionDate_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "getGroupMembers", collectionDate: $collectionDate, groupCode: $groupCode, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					if($res1.GrpNm != ''){
						$('#GrpNm').html('Group Name: ' + $res1.GrpNm);
						$('#GrpAdd').html('Group Address: ' + $res1.GrpAdd);					
						
						$group_members1 = $res1.group_members;	 

						if($group_members1.length > 0){
							for(var i = 0; i < $group_members1.length; i++){
								$MemCstTemp = '';
								if($group_members1[i].MemCst != ''){
									$MemCstTemp = $group_members1[i].MemCst;
								}

								$html += '<tr> <td style="text-align: center;">'+$group_members1[i].MemId+'</td> <td style="text-align: center;">'+$group_members1[i].MemNm+'</td> <td style="text-align: right;width: 100px;"><input type="number" name="CAmt[]" id="CAmt_'+$group_members1[i].MemId+'" value="'+$group_members1[i].OpnAmt+'" class="form-control"> <input type="hidden" name="hiddenCAmt[]" id="hiddenCAmt_'+$group_members1[i].MemId+'" value="'+$group_members1[i].CAmt+'" class="form-control"><input type="hidden" name="collectionDate[]" id="collectionDate_'+$group_members1[i].MemId+'" value="'+$collectionDate+'">  <input type="hidden" name="my_id[]" id="my_id_'+$group_members1[i].MemId+'" value="'+$group_members1[i].MemId+'"> </td><td style="text-align: right;width: 100px;"><input type="number" name="Opening_Dues[]" id="Opening_Dues_'+$group_members1[i].MemId+'" value="'+$group_members1[i].Opening_Dues+'" class="form-control"></td> <td><select id="caste_'+$group_members1[i].MemId+'" name="caste[]" class="form-control"> <option value="">Select</option>';
								
								if($MemCstTemp == 'GENERAL'){
									$html += '<option value="GENERAL" selected>GENERAL</option>';
								}else{
									$html += '<option value="GENERAL">GENERAL</option>';
								}
								if($MemCstTemp == 'SC'){
									$html += '<option value="SC" selected>SC</option>';
								}else{
									$html += '<option value="SC">SC</option>';
								}
								if($MemCstTemp == 'ST'){
									$html += '<option value="ST" selected>ST</option>';
								}else{
									$html += '<option value="ST">ST</option>';
								}
								if($MemCstTemp == 'OBC'){
									$html += '<option value="OBC" selected>OBC</option>';
								}else{
									$html += '<option value="OBC">OBC</option>';
								}
								if($MemCstTemp == 'MINORITY'){
									$html += '<option value="MINORITY" selected>MINORITY</option>';
								}else{
									$html += '<option value="MINORITY">MINORITY</option>';
								}

								$html += '</select></td> </tr>';
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="6">No data Available</td> </tr>';
						}

						$('#group_members_list1').html($html);
						$('#GroupId').val($res1.GrpId);
						$('#part_two').show();
					}else{					
						$('#part_three').show();
					}
				}else{
				}
			});
		}//end if
	});

	//Meeting Data
	$( "#getGroupMembers" ).on( "click", function() {
		$collectionDate = $('#collectionDate').val();
		$groupCode = $('#groupCode').val();
		$StfId = $('#StfId').val();
		
		$('#collectionDate_success').html('');
		$('#collectionDate_error').html('');
		$('#groupCode_success').html('');
		$('#groupCode_error').html('');
		$('#GrpNm').html('Group Name: ');
		$('#GrpAdd').html('Group Address: ');
		$html = '';
		$('#group_members_list').html($html);
		$('#part_two').hide();
		$('#part_three').hide();
		$('#table_1').hide();
		$('#table_2').hide();

		if($collectionDate == ''){
			$('#collectionDate_error').html('Please Enter Collection Date');
			return false;
		}else if($groupCode == ''){
			$('#groupCode_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{	
			$('#collectionDate_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "getGroupMembers", collectionDate: $collectionDate, groupCode: $groupCode, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					if($res1.GrpNm != ''){
						$('#GrpNm').html('Group Name: ' + $res1.GrpNm);
						$('#GrpAdd').html('Group Address: ' + $res1.GrpAdd);					
						
						$group_members = $res1.group_members;					

						if($group_members.length > 0){
							$sl = 1;
							for(var i = 0; i < $group_members.length; i++){
								$html += '<tr> <td style="text-align: center;">'+$sl+'</td><td style="text-align: center;">'+$group_members[i].MemId+'</td> <td style="text-align: center;">'+$group_members[i].MemNm+'</td> <td style="text-align: center;"><input type="checkbox" name="attendance[]" id="attendance_'+$group_members[i].MemId+'" checked class="check_class" data-member_id="'+$group_members[i].MemId+'" /><input type="hidden" name="attendance_text[]" id="attendance_text_'+$group_members[i].MemId+'" value="1" /></td> <td style="text-align: right;width: 100px;"><input type="number" name="CAmt[]" id="CAmt_'+$group_members[i].MemId+'" value="'+$group_members[i].CAmt+'" class="form-control" onblur="calculateSubtotal()"> <input type="hidden" name="hiddenCAmt[]" id="hiddenCAmt_'+$group_members[i].MemId+'" value="'+$group_members[i].CAmt+'" class="form-control"><input type="hidden" name="collectionDate[]" id="collectionDate_'+$group_members[i].MemId+'" value="'+$collectionDate+'">  <input type="hidden" name="my_id[]" id="my_id_'+$group_members[i].MemId+'" value="'+$group_members[i].MemId+'"> </td> </tr>';
								$sl++;
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="5">No data Available</td> </tr>';
						}
						$html += '<tr> <td style="text-align: right;" colspan="4">Subtotal</td><td style="text-align: right;"><input type="number" name="sub_total" id="sub_total" value="0.00" class="form-control" readonly></td> </tr>';

						$('#group_members_list').html($html);
						$('#GrpSBAc').val($groupCode);
						calculateSubtotal();
						$('#part_two').show();
						$('#table_1').show();
					}else{					
						$('#part_three').show();
					}
				}
			});

			//Check group id
			$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "usp_GetGroup", savings_ac_no: $groupCode }
			  })
			.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#GroupId').val($res1.GrpId);
				}
			});
		}//end if
	});

	//Meeting Report
	$( "#getMeetingReport" ).on( "click", function() {
		$collectionDate = $('#collectionDate').val();
		$groupCode = $('#groupCode').val();
		$StfId = $('#StfId').val();
		
		$('#collectionDate_success').html('');
		$('#collectionDate_error').html('');
		$('#groupCode_success').html('');
		$('#groupCode_error').html('');
		$('#GrpNm').html('Group Name: ');
		$('#GrpAdd').html('Group Address: ');
		$html = '';
		$('#group_members_list').html($html);
		$('#group_members_list_1').html($html);
		$('#part_two').hide();
		$('#table_1').hide();
		$('#table_2').hide();
		$('#part_three').hide();

		if($collectionDate == ''){
			$('#collectionDate_error').html('Please Enter Collection Date');
			return false;
		}else if($groupCode == ''){
			$('#groupCode_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{	
			$('#collectionDate_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "getMeetingReport", collectionDate: $collectionDate, groupCode: $groupCode, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					if($res1.GrpNm != ''){
						$('#GrpNm').html('Group Name: ' + $res1.GrpNm_heading);
						$('#GrpAdd').html('Meeting Date: ' + $res1.MettingDt_heading);					
						
						$group_reports = $res1.group_reports;					

						if($group_reports.length > 0){
							$sl = 1;
							for(var i = 0; i < $group_reports.length; i++){
								$html += '<tr> <td style="text-align: center;">'+$sl+'</td><td style="text-align: center;">'+$group_reports[i].MemNm+'</td> <td style="text-align: center;">'+$group_reports[i].Attnd+'</td> <td style="text-align: right;width: 100px;">'+$group_reports[i].ColAmt+'</td> </tr>';
								$sl++;
							}
							$html += '<tr> <td style="text-align: center; font-weight: bold" colspan="3">Subtotal</td><td style="text-align: right;width: 100px;">'+$res1.ColAmt_st+'</td> </tr>';
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="4">No data Available</td>$res1.ColAmt_st </tr>';
						}

						$('#group_members_list_1').html($html);
						$('#part_two').show();
						$('#table_2').show();
					}else{					
						$('#part_three').show();
					}
				}
			});

			//Check group id
			/*$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "usp_GetGroup", savings_ac_no: $groupCode }
			  })
			.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#GroupId').val($res1.GrpId);
				}
			});*/
		}//end if
	});

	//Delete Meeting data
	$( "#deleteMeetingData" ).on( "click", function() {						
		$meetingDt = $('#collectionDate').val();				
		$grpSBAc = $('#groupCode').val();

		if($meetingDt == ''){
			alert('Please select meeting date');
		}else if($grpSBAc == ''){
			alert('Please enter Savings A/c. No.');
		}else{
			if(confirm('Are you sure to delete it?')){
				$.ajax({
					method: "POST",
					url: "assets/php/function.php",
					data: { fn: "deleteMeetingData", meeting_date: $meetingDt, sb_ac: $grpSBAc}
				})
					.done(function( res ) {
					//console.log(res);
					$res1 = JSON.parse(res);
					if($res1.status == true){
						alert('Data deleted successfully');					
					}					
				});
			}//end if
		}//end if
	});//end finction

	$('#meetingType').on('change', function(){
		$meetingTypeText = $('#meetingType option:selected').text();
		$('#meetingTypeName').val($meetingTypeText);
		console.log('meetingTypeText: ' + $meetingTypeText);
	});
	//End Loan Page Function  

	function calculateSubtotal(){
		$myFormData = $('#form1').serializeArray();
		//console.log(JSON.stringify($myFormData))
		$sub_total = 0;
		for($i = 0; $i < $myFormData.length; $i++){
			if($myFormData[$i].name == 'CAmt[]'){
				$temp_amount = 0;
				if($myFormData[$i].value != ''){
					$temp_amount = $myFormData[$i].value;
				}
				$sub_total = parseFloat($sub_total) + parseFloat($temp_amount);
			}
		}//end for

		$('#sub_total').val($sub_total);
	}//end fun
	
	//Check uncheck
	$('#myTable').on('click', '.check_class', function(){
		$member_id = $(this).data('member_id');
		console.log('checkbox member_id: ' + $member_id);

		//$attendance_id = $('#attendance_' + $member_id).checked();
		if ($('#attendance_' + $member_id).is(':checked')) {
		// The checkbox is checked
			console.log('checked');			
			$hiddenCAmt = $('#hiddenCAmt_' + $member_id).val();
			$('#CAmt_' + $member_id).val($hiddenCAmt);
		} else {
		// The checkbox is not checked
			console.log('unchecked: ');
			$val = 0;
			$('#CAmt_' + $member_id).val($val);
		}
		calculateSubtotal();

	});	

	//Update Password
	$( "#update_password" ).on( "click", function() {
		$new_password = $('#new_password').val();
		$StfId = $('#StfId').val();

		if($new_password == ''){
			$('#new_password_error').html('Please Enter Password');
			return false;
		}else{	
			$('#new_password_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "updtStaffPwd", new_password: $new_password, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					alert('Password updated successfully')
					window.location.href = '?p=login&out=ok';
				}else{
					//$('#form_success').html('');
					//$('#form_error').html($res1.error_msg);
					return false;
				}
			});
		}//end if
	});
	//Update Password End

	//Check uncheck
	$('#myTable').on('click', '.check_class', function(){
		$member_id = $(this).data('member_id');
		console.log('checkbox member_id: ' + $member_id);
		
		if ($('#attendance_' + $member_id).is(':checked')) {
		// The checkbox is checked
			console.log('checked');	
			$val = 1;
			$('#attendance_text_' + $member_id).val($val);
		} else {
		// The checkbox is not checked
			console.log('unchecked: ');
			$val = 0;
			$('#attendance_text_' + $member_id).val($val);
		}
	});	

	

	//Interest Receipt
	$( "#showInterestAmount" ).on( "click", function() {
		$intRcptDate = '';//$('#intRcptDate').val();
		$groupAcNo = $('#groupAcNo').val();
		$StfId = $('#StfId').val();
		
		$('#intRcptDate_error').html('');
		$('#groupAcNo_error').html('');		
		
		$('#interestAmount').html('Interest Amount: ');
		$('#part_two').hide();		

		if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showInterestAmount", groupAcNo: $groupAcNo, StfId: $StfId }
			})
			  .done(function( res ) {
				console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#GroupId').val($res1.GrpId);
					$('#ir_GroupName').html('Group Name: '+$res1.GrpNm);
					$('#ir_GroupAddress').html('Group Address: '+$res1.GrpAdd);
					$('#openingAmtCash').val($res1.COpen);
					$('#openingAmtBank').val($res1.BOpen);
					
					$('#part_two').show();
				}else{
					alert('No Data Found');
				}
			});
		}//end if
	});
	//Save Interest Amount	
	$( "#saveInterestAmount" ).on( "click", function() {
		$openingAmtCash = $('#openingAmtCash').val();
		$openingAmtBank = $('#openingAmtBank').val();
		$groupAcNo = $('#groupAcNo').val();
		//$intAmount = $('#intAmount').val();
		$StfId = $('#StfId').val();
		$GroupId = $('#GroupId').val();
		
		$('#intRcptDate_error').html('');
		$('#groupAcNo_error').html('');	
		$('#intAmount_error').html('');		
		
		$('#interestAmount').html('Interest Amount: ');
		//$('#part_two').hide();		

		if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "saveInterestAmount", openingAmtCash: $openingAmtCash, openingAmtBank: $openingAmtBank, groupAcNo: $GroupId, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#groupAcNo').val('');
					$('#intAmount').val('');
					alert('Opening Balance Saved');
					//$('#interestAmount').html('Interest Amount: ' + $res1.interestAmt);
					
					$('#part_two').hide();
				}else{
					alert('No Interest amount');
				}
			});
		}//end if
	});
	
	//Save Voucher Entry	
	$( "#saveVoucher" ).on( "click", function() {
		$entryDate = $('#entryDate').val();
		$groupAcNo = $('#groupAcNo').val();
		$voucherType = $('#voucherType').val();
		$voucherAmount = $('#voucherAmount').val();
		$particulars = $('#particulars').val();
		$StfId = $('#StfId').val();
		$GroupId = $('#GroupId').val();
		
		$('#entryDate_error').html('');
		$('#voucherType_error').html('');	
		$('#voucherAmount_error').html('');	
		$('#particulars_error').html('');

		if($entryDate == ''){
			$('#entryDate_error').html('Please Select Date');
			return false;
		}else if($voucherType == '0'){
			$('#voucherType_error').html('Please Select Voucher Type');
			return false;
		}else if($particulars == '0'){
			$('#particulars_error').html('Please Select Particulars');
			return false;
		}else if($voucherAmount <= 0){
			$('#voucherAmount_error').html('Please Enter Voucher Amount');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "saveVoucher", entryDate: $entryDate, groupAcNo: $GroupId, voucherType: $voucherType, voucherAmount: $voucherAmount, particulars: $particulars, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){

					if($res1.VId == '-1'){
						alert('Voucher Exists');
					}else if($res1.VId == '-2'){
						alert('Cash Shortage');
					}else{
						$('#groupAcNo').val('');
						$('#voucherType').val('0').trigger('change');
						$('#voucherAmount').val('');
						$('#particulars').val('0').trigger('change');
						$('#part_two').hide();
						alert('Particular saved successfully');
					}
				}else{
					//alert('No Interest amount');
				}
			});
		}//end if
	});
	
	//Delete Voucher 	
	$( "#deleteVoucher" ).on( "click", function() {
		$entryDate = $('#entryDate').val();
		$groupAcNo = $('#groupAcNo').val();
		$voucherType = $('#voucherType').val();
		$voucherAmount = $('#voucherAmount').val();
		$particulars = $('#particulars').val();
		$StfId = $('#StfId').val();
		$GroupId = $('#GroupId').val();
		
		$('#entryDate_error').html('');
		$('#voucherType_error').html('');	
		$('#voucherAmount_error').html('');	
		$('#particulars_error').html('');

		if($entryDate == ''){
			$('#entryDate_error').html('Please Select Date');
			return false;
		}else if($voucherType == '0'){
			$('#voucherType_error').html('Please Select Voucher Type');
			return false;
		}else if($particulars == '0'){
			$('#particulars_error').html('Please Select Particulars');
			return false;
		}else if($voucherAmount <= 0){
			$('#voucherAmount_error').html('Please Enter Voucher Amount');
			return false;
		}else{
			if(confirm('Are you sure to delete it?')){
				$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "deleteVoucher", entryDate: $entryDate, groupAcNo: $GroupId, voucherType: $voucherType, voucherAmount: $voucherAmount, particulars: $particulars, StfId: $StfId }
				})
				.done(function( res ) {
					//console.log(res);
					$res1 = JSON.parse(res);
					if($res1.status == true){
						//$('#entryDate').val('');
						$('#groupAcNo').val('');
						$('#voucherType').val('0').trigger('change');
						$('#voucherAmount').val('');
						$('#particulars').val('0').trigger('change');
						$('#part_two').hide();
						alert('Voucher Deleted successfully');
					}else{
						//alert('No Interest amount');
					}
				});
			}//end if
		}//end if
	});

	

	//Show cashbook Report 1st Part
	$( "#showCashBook" ).on( "click", function() {
		$fromDate = $('#fromDate').val();
		$uptoDate = $('#uptoDate').val();
		$groupAcNo = $('#groupAcNo').val();
		$StfId = $('#StfId').val();
		
		$('#fromDate_error').html('');
		$('#uptoDate_error').html('');	
		$('#groupAcNo_error').html('');		
		
		$('#interestAmount').html('Interest Amount: ');
		$('#part_two').hide();		
		$('#part_three').hide();

		if($fromDate == ''){
			$('#fromDate_error').html('Please Select From Date');
			return false;
		}else if($uptoDate == ''){
			$('#uptoDate_error').html('Please Select Upto Date');
			return false;
		}else if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showInterestAmount", intRcptDate: $fromDate, groupAcNo: $groupAcNo, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$cb_GrName = $res1.GrpNm;
					$('#cb_GroupName').html('Group Name: '+$res1.GrpNm);
					$('#cb_GroupAddress').html('Group Address: '+$res1.GrpAdd);
					$('#GroupId').val($res1.GrpId);
					$('#part_two').show();
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});
	//Show Cashbook report	
	$( "#showCashBookReport" ).on( "click", function() {
		$fromDate = $('#fromDate').val();
		$uptoDate = $('#uptoDate').val();
		$groupAcNo = $('#GroupId').val();
		$StfId = $('#StfId').val();
		$html = '';
		
		$('#fromDate_error').html('');
		$('#uptoDate_error').html('');	
		$('#groupAcNo_error').html('');	
		$('#part_three').hide();		

		if($fromDate == ''){
			$('#fromDate_error').html('Please Select From Date');
			return false;
		}else if($uptoDate == ''){
			$('#uptoDate_error').html('Please Select Upto Date');
			return false;
		}else if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showCashBookReport", fromDate: $fromDate, uptoDate: $uptoDate, groupAcNo: $groupAcNo, StfId: $StfId }
			})
			  .done(function( res ) {
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#cbTitle').html('Cash Book For The Period '+$res1.fromDateN+' To '+$res1.uptoDateN);
					$('#cbTitle2').html('Group Name: '+$cb_GrName);

					$cb_rows = $res1.cb_rows;

					$('#cb_tbody').html($html);
					if($cb_rows.length > 0){
						for($i = 0; $i < $cb_rows.length; $i++){
							$html += '<tr> <td>'+$cb_rows[$i].RDate+'</td> <td>'+$cb_rows[$i].RParti+'</td> <td class="text-right">'+$cb_rows[$i].RCash+'</td> <td class="text-right">'+$cb_rows[$i].RBank+'</td> <td>'+$cb_rows[$i].PDate+'</td> <td>'+$cb_rows[$i].PParti+'</td> <td class="text-right">'+$cb_rows[$i].PCash+'</td> <td class="text-right">'+$cb_rows[$i].PBank+'</td> </tr>';
						}//end for

						$html += '<tr> <td scope="col" class="text-left">Sub Total</td> <td scope="col" class="text-center"></td> <td scope="col" class="text-right">'+$res1.sTotalRCash+'</td> <td scope="col" class="text-right">'+$res1.sTotalRBank+'</td> <td scope="col" class="text-left">Sub Total</td> <td scope="col" class="text-center"></td> <td scope="col" class="text-right">'+$res1.sTotalPCash+'</td> <td scope="col" class="text-right">'+$res1.sTotalPBank+'</td> </tr>';

						$html += '<tr> <td scope="col" class="text-left">Opening</td> <td scope="col" class="text-center"></td> <td scope="col" class="text-right">'+$res1.OpnCash+'</td> <td scope="col" class="text-right">'+$res1.OpnBank+'</td> <td scope="col" class="text-left">Closing</td> <td scope="col" class="text-center"></td> <td scope="col" class="text-right">'+$res1.ClsCash+'</td> <td scope="col" class="text-right">'+$res1.ClsBank+'</td> </tr>';

						$html += '<tr> <td scope="col" class="text-left">Total</td> <td scope="col" class="text-center"></td> <td scope="col" class="text-right">'+$res1.TotalRCash+'</td> <td scope="col" class="text-right">'+$res1.TotalRBank+'</td> <td scope="col" class="text-left">Total</td> <td scope="col" class="text-center"></td> <td scope="col" class="text-right">'+$res1.TotalPCash+'</td> <td scope="col" class="text-right">'+$res1.TotalPBank+'</td> </tr>';

					}else{
						$html += '<tr> <td colspan="8">Sorry! No data Found</td> </tr>';
					}//end if

					$('#cb_tbody').html($html);
					$('#part_three').show();	
					$('#printDiv').show();	
						
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});

	

	//Link Group 1st Part
	$( "#linkGroupShow" ).on( "click", function() {
		$groupAcNo = $('#groupAcNo').val();
		$StfId = $('#StfId').val();	
		$intRcptDate = '';
		$('#groupAcNo_error').html('');		
		
		$('#interestAmount').html('Interest Amount: ');
		$('#part_two').hide();		

		if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showInterestAmount", intRcptDate: $intRcptDate, groupAcNo: $groupAcNo, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#lg_GroupName').html('Group Name: '+$res1.GrpNm);
					$('#lg_GroupAddress').html('Group Address: '+$res1.GrpAdd);
					$('#GroupId').val($res1.GrpId);

					$Sansad_Id = $res1.Sansad_Id;
					console.log('  Sansad_Id: ' + $Sansad_Id);
					$('#gpName').val($res1.GP_Id).trigger('change');
					setTimeout(function(){
						console.log(' 2 Sansad_Id: ' + $Sansad_Id);
						$('#samsadName').val($Sansad_Id).trigger('change');
					},500);

					$('#part_two').show();
				}else{
					alert('No Data Available');
				}
			});
		}//end if
	});
	//Link Group 2nd part	
	$( "#linkGroupSave" ).on( "click", function() {
		$groupAcNo = $('#GroupId').val();
		$StfId = $('#StfId').val();	
		$('#groupAcNo_error').html('');		
		
		$('#interestAmount').html('Linked Group Description: ');
		//$('#part_two').hide();		

		if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "linkGroupSave", groupAcNo: $groupAcNo, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#groupAcNo').val('');
					$('#part_two').hide();
					alert('Group Linkup Done');
				}else{
					alert('No Interest amount');
				}
			});
		}//end if
	});
	$( "#unLinkGroupSave" ).on( "click", function() {
		if(confirm('Are you sure to unlink?')){
			$groupAcNo = $('#GroupId').val();
			$StfId = $('#StfId').val();	 	

			if($groupAcNo == ''){
				$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
				return false;
			}else{
				$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "unLinkGroupSave", groupAcNo: $groupAcNo, StfId: $StfId }
				})
				.done(function( res ) { 
					$res1 = JSON.parse(res);
					if($res1.status == true){
						$('#groupAcNo').val('');
						$('#part_two').hide();
						alert('Group Un-Linkup Done');
					}else{
						alert('API Error');
					}
				});
			}//end if
		}
	});


	//Get Particulars
	$( "#voucherType" ).on( "change", function() {
		$voucherType = $('#voucherType').val();
		
		$html = '<option value="0">Select</option>';

		if($voucherType != '0'){	
			
			$.ajax({
			method: "POST",
			url: "assets/php/function.php",
			data: { fn: "getPurpose", voucherType: $voucherType }
			})
			.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$purposes = $res1.purposes;
					for($i = 0; $i < $purposes.length; $i++){
						$html += "<option value='"+$purposes[$i].Id+"'>"+$purposes[$i].Purpose+"</option>";
						//$html += "<input type='number' id="+$purposes[$i].OptId+" name="+$purposes[$i].OptId+" class='form-control' />";
					}//end for
					$('#particulars').html($html);
				}
			});
		}else{
			$('#particulars').html($html);
		}//end if
	});
	//Get Particulars
	
	//Show voucher entry group
	$( "#showVoucherEntryGroup" ).on( "click", function() {
		$intRcptDate = $('#entryDate').val();
		$groupAcNo = $('#groupAcNo').val();
		$StfId = $('#StfId').val();
		
		$('#intRcptDate_error').html('');
		$('#groupAcNo_error').html('');		
		
		$('#interestAmount').html('Interest Amount: ');
		$('#part_two').hide();		

		if($intRcptDate == ''){
			$('#intRcptDate_error').html('Please Select Date');
			return false;
		}else if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showInterestAmount", intRcptDate: $intRcptDate, groupAcNo: $groupAcNo, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#ve_GroupName').html('Group Name: '+$res1.GrpNm);
					$('#ve_GroupAddress').html('Group Address: '+$res1.GrpAdd);
					$('#GroupId').val($res1.GrpId);
					$('#part_two').show();
				}else{
					alert('No Data Found');
				}
			});
		}//end if
	});

	//Dashboard More part
	function deleteCollectionRecord(meeting_date, sb_ac, dt){
		console.log('meeting_date: '+ meeting_date + ', sb_ac:' +  sb_ac);

		if(confirm('Are you sure?')){			
			$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "deleteCollectionRecord", meeting_date: meeting_date, sb_ac: sb_ac}
			  })
				.done(function( res ) {
				  //console.log(res);
				  $res1 = JSON.parse(res);
				  if($res1.status == true){
					window.location.href = '?p=dashboard-more&dt='+dt;					
				  }
				  
			  });
		}//end if

	}//end finction

	//Print preview
	$('#printDiv').on('click', function(){	
		$fromDate = $('#fromDate').val();
		$uptoDate = $('#uptoDate').val();
		$GroupId = $('#GroupId').val();
		$groupAcNo = $('#groupAcNo').val();
		$cbTitle2 = $('#cbTitle2').html();
		$StfId = $('#StfId').val();

		var w = 800;
		var h = 500;
		var left = Number((screen.width/2)-(w/2));
		var tops = Number((screen.height/2)-(h/2));
		var open_link = 'fpdf186/cash_book.php?fromDate='+$fromDate+'&uptoDate='+$uptoDate+'&groupAcNo='+$groupAcNo+'&GroupId='+$GroupId+'&StfId='+$StfId+'&cbTitle2='+$cbTitle2;
		//var rpaypalCls = window.open(open_link, '_blank', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
		window.location.href = open_link;
   	})
   //Reports
   
	//show Attendance Report	
	$( "#showAttendanceReport" ).on( "click", function() {
		$GrpSBAc = $('#GrpSBAc').val();
		$FinYrFrmTo = $('#FinYrFrmTo').val();
		$UptoDate = $('#UptoDate').val();
		$html = '';
		
		$('#GrpSBAc_error').html('');
		$('#FinYrFrmTo_error').html('');	
		$('#uptoDate_error').html('');	
		$('#part_three').hide();		

		if($GrpSBAc == ''){
			$('#GrpSBAc_error').html('Please Enter Savings A/c. No.');
			return false;
		}else if($FinYrFrmTo == '0'){
			$('#FinYrFrmTo_error').html('Please Select Accounting Year');
			return false;
		}else if($UptoDate == ''){
			$('#uptoDate_error').html('Please Select Upto Date');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showAttendanceReport", GrpSBAc: $GrpSBAc, FinYrFrmTo: $FinYrFrmTo, UptoDate: $UptoDate }
			})
			  .done(function( res ) {
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$attn_rows = $res1.attn_rows;

					$('#gr_name').html('Group Name: '+ $attn_rows[0].GrpNm);
					$('#sb_ac_no').html('S/B No.: '+ $GrpSBAc);
					$('#fin_yr').html('Attendance Register '+ $res1.fin_yr+' FY');

					$('#atten_repo_tbody').html($html);
					if($attn_rows.length > 0){
						for($i = 0; $i < $attn_rows.length; $i++){
							$html += '<tr> <td>'+$attn_rows[$i].Sl+'</td> <td>'+$attn_rows[$i].MemberNm+'</td> <td class="text-right">'+$attn_rows[$i].MnthApr+'</td> <td class="text-right">'+$attn_rows[$i].MnthMay+'</td> <td class="text-right">'+$attn_rows[$i].MnthJun+'</td> <td class="text-right">'+$attn_rows[$i].MnthJly+'</td> <td class="text-right">'+$attn_rows[$i].MnthAug+'</td> <td class="text-right">'+$attn_rows[$i].MnthSep+'</td> <td class="text-right">'+$attn_rows[$i].MnthOct+'</td> <td class="text-right">'+$attn_rows[$i].MnthNov+'</td> <td class="text-right">'+$attn_rows[$i].MnthDec+'</td> <td class="text-right">'+$attn_rows[$i].MnthJan+'</td> <td class="text-right">'+$attn_rows[$i].MnthFeb+'</td> <td class="text-right">'+$attn_rows[$i].MnthMar+'</td> <td class="text-right">'+$attn_rows[$i].Percnt+'</td> </tr>';
						}//end for

					}else{
						$html += '<tr> <td colspan="15">Sorry! No data Found</td> </tr>';
					}//end if

					$('#atten_repo_tbody').html($html);
					$('#part_three').show();
						
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});

	//showMemListReport	
	$( "#showMemListReport" ).on( "click", function() {
		$GrpSBAc = $('#GrpSBAc').val();
		$StfId = $('#StfId').val();
		$html = '';
		
		$('#GrpSBAc_error').html('');
		$('#FinYrFrmTo_error').html('');	
		$('#uptoDate_error').html('');	
		$('#part_three').hide();		

		if($GrpSBAc == ''){
			$('#GrpSBAc_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showMemListReport", GrpSBAc: $GrpSBAc, StfId: $StfId }
			})
			  .done(function( res ) {
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$memlist_rows = $res1.memlist_rows;

					$('#memlist_repo_tbody').html($html);
					if($memlist_rows.length > 0){
						for($i = 0; $i < $memlist_rows.length; $i++){
							$html += '<tr> <td>'+$memlist_rows[$i].Sl+'</td> <td>'+$memlist_rows[$i].MemId+'</td> <td class="text-left">'+$memlist_rows[$i].MemNm+'</td> <td class="text-left">'+$memlist_rows[$i].GurdNm+'</td> <td class="text-left">'+$memlist_rows[$i].Village+'</td> <td class="text-left">'+$memlist_rows[$i].Aadhar+'</td> <td class="text-left">'+$memlist_rows[$i].PAN+'</td> <td class="text-left">'+$memlist_rows[$i].Voter+'</td><td class="text-left">'+$memlist_rows[$i].Caste+'</td> </tr>';
						}//end for

					}else{
						$html += '<tr> <td colspan="8">Sorry! No data Found</td> </tr>';
					}//end if

					$('#memlist_repo_tbody').html($html);
					$('#part_three').show();
						
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});
   
	//Savings Ledger Report	
	$( "#showSavingLedgerReport" ).on( "click", function() {
		$GrpSBAc = $('#GrpSBAc').val();
		$FinYrFrmTo = $('#FinYrFrmTo').val();
		$UptoDate = $('#UptoDate').val();
		$html = '';
		
		$('#GrpSBAc_error').html('');
		$('#FinYrFrmTo_error').html('');	
		$('#uptoDate_error').html('');	
		$('#part_three').hide();		

		if($GrpSBAc == ''){
			$('#GrpSBAc_error').html('Please Enter Savings A/c. No.');
			return false;
		}else if($FinYrFrmTo == '0'){
			$('#FinYrFrmTo_error').html('Please Select Accounting Year');
			return false;
		}else if($UptoDate == ''){
			$('#uptoDate_error').html('Please Select Upto Date');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showSavingLedgerReport", GrpSBAc: $GrpSBAc, FinYrFrmTo: $FinYrFrmTo, UptoDate: $UptoDate }
			})
			  .done(function( res ) {
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$sl_rows = $res1.sl_rows;
					$st_row = $res1.st_row;

					$('#gr_name').html('Group Name: '+ $sl_rows[0].GrpNm);
					$('#sb_ac_no').html('S/B No.: '+ $GrpSBAc);
					$('#fin_yr').html('Group Savings Deposit Register '+ $res1.fin_yr+' FY');

					$('#sl_repo_tbody').html($html);
					if($sl_rows.length > 0){
						for($i = 0; $i < $sl_rows.length; $i++){
							$html += '<tr> <td>'+$sl_rows[$i].Sl+'</td> <td>'+$sl_rows[$i].MemberNm+'</td> <td class="text-right">'+$sl_rows[$i].SBOpnAmt+'</td>  <td class="text-right">'+$sl_rows[$i].MnthApr+'</td> <td class="text-right">'+$sl_rows[$i].MnthMay+'</td> <td class="text-right">'+$sl_rows[$i].MnthJun+'</td> <td class="text-right">'+$sl_rows[$i].MnthJly+'</td> <td class="text-right">'+$sl_rows[$i].MnthAug+'</td> <td class="text-right">'+$sl_rows[$i].MnthSep+'</td> <td class="text-right">'+$sl_rows[$i].MnthOct+'</td> <td class="text-right">'+$sl_rows[$i].MnthNov+'</td> <td class="text-right">'+$sl_rows[$i].MnthDec+'</td> <td class="text-right">'+$sl_rows[$i].MnthJan+'</td> <td class="text-right">'+$sl_rows[$i].MnthFeb+'</td> <td class="text-right">'+$sl_rows[$i].MnthMar+'</td> <td class="text-right">'+$sl_rows[$i].YrTotal+'</td> <td class="text-right">'+$sl_rows[$i].SBClsAmt+'</td> <td class="text-right">'+$sl_rows[$i].DueOpnAmt+'</td> <td class="text-right">'+$sl_rows[$i].DueThisYr+'</td> <td class="text-right">'+$sl_rows[$i].DueClsAmt+'</td> </tr>';
						}//end for
							
						$html += '<tr> <td colspan="2" class="text-center">Subtotal</td> <td class="text-right">'+$st_row.st_SBOpnAmt+'</td>  <td class="text-right">'+$st_row.st_MnthApr+'</td> <td class="text-right">'+$st_row.st_MnthMay+'</td> <td class="text-right">'+$st_row.st_MnthJun+'</td> <td class="text-right">'+$st_row.st_MnthJly+'</td> <td class="text-right">'+$st_row.st_MnthAug+'</td> <td class="text-right">'+$st_row.st_MnthSep+'</td> <td class="text-right">'+$st_row.st_MnthOct+'</td> <td class="text-right">'+$st_row.st_MnthNov+'</td> <td class="text-right">'+$st_row.st_MnthDec+'</td> <td class="text-right">'+$st_row.st_MnthJan+'</td> <td class="text-right">'+$st_row.st_MnthFeb+'</td> <td class="text-right">'+$st_row.st_MnthMar+'</td> <td class="text-right">'+$st_row.st_YrTotal+'</td> <td class="text-right">'+$st_row.st_SBClsAmt+'</td> <td class="text-right">'+$st_row.st_DueOpnAmt+'</td> <td class="text-right">'+$st_row.st_DueThisYr+'</td> <td class="text-right">'+$st_row.st_DueClsAmt+'</td> </tr>';

					}else{
						$html += '<tr> <td colspan="15">Sorry! No data Found</td> </tr>';
					}//end if

					$('#sl_repo_tbody').html($html);
					$('#part_three').show();
						
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});
   
	//Savings Ledger Report	
	$( "#showLoanRegisterReport" ).on( "click", function() {
		$GrpSBAc = $('#GrpSBAc').val();
		$html = '';
		
		$('#GrpSBAc_error').html('');
		$('#part_three').hide();		

		if($GrpSBAc == ''){
			$('#GrpSBAc_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showLoanRegisterReport", GrpSBAc: $GrpSBAc }
			})
			  .done(function( res ) {
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$sl_rows = $res1.sl_rows;
					$st_row = $res1.st_row;

					$('#table_heading').html('Loan Register for '+$res1.group_name+' as on '+$res1.month_year+'');

					$('#sl_repo_tbody').html($html);
					if($sl_rows.length > 0){
						for($i = 0; $i < $sl_rows.length; $i++){
							$html += '<tr> <td>'+$sl_rows[$i].Sl+'</td> <td>'+$sl_rows[$i].MemNm+'</td> <td class="text-right">'+$sl_rows[$i].AcNo+'</td>  <td class="text-right">'+$sl_rows[$i].LnAmt+'</td> <td class="text-right">'+$sl_rows[$i].LnDt+'</td> <td class="text-right">'+$sl_rows[$i].Purpose+'</td>  <td class="text-right">'+$sl_rows[$i].Outs+'</td> <td class="text-right">'+$sl_rows[$i].Exptd+'</td> <td class="text-right">'+$sl_rows[$i].Repaid+'</td> <td class="text-right">'+$sl_rows[$i].ODue+'</td> </tr>';
						}//end for
							
						$html += '<tr> <td colspan="3" class="text-center">Subtotal</td> <td class="text-right">'+$st_row.st_LnAmt+'</td>  <td class="text-right"> </td><td class="text-right"> </td> <td class="text-right">'+$st_row.st_Outs+'</td> <td class="text-right">'+$st_row.st_Exptd+'</td> <td class="text-right">'+$st_row.st_Repaid+'</td> <td class="text-right">'+$st_row.st_ODue+'</td></tr>';
							
						$html += '<tr> <td colspan="9" class="text-right font-weight-bold">Recovery Rate (in %)</td> <td class="text-right">'+$res1.recovery_rate+'</td></tr>';

					}else{
						$html += '<tr> <td colspan="10">Sorry! No data Found</td> </tr>';
					}//end if

					$('#sl_repo_tbody').html($html);
					$('#part_three').show();
						
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});
	
	//Incentive Report	
	$( "#showIcentiveReport" ).on( "click", function() {
		$IncDate = $('#IncDate').val();
		$html = '';
		
		$('#IncDate_error').html('');
		$('#part_three').hide();		

		if($IncDate == ''){
			$('#IncDate_error').html('Please Select date');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "showIcentiveReport", IncDate: $IncDate }
			})
			  .done(function( res ) {
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$sl_rows = $res1.sl_rows; 

					$('#table_heading').html('Incentive For The Month Of ' + $res1.ins_month_format);

					$('#sl_repo_tbody').html($html);
					if($sl_rows.length > 0){
						for($i = 0; $i < $sl_rows.length; $i++){
							$html += '<tr> <td>'+$sl_rows[$i].Id+'</td> <td>'+$sl_rows[$i].FOName+'</td> <td class="text-right">'+$sl_rows[$i].MainPart+'</td>  <td class="text-right">'+$sl_rows[$i].ExtraPart+'</td> <td class="text-right">'+$sl_rows[$i].SocialPart+'</td> <td class="text-right">'+$sl_rows[$i].TotAmt+'</td></tr>';
						}//end for
							
						$html += '<tr> <td colspan="5" class="text-center font-weight-bold">Sub Total</td> <td class="text-right font-weight-bold">'+$res1.sub_total+'</td></tr>';
					}else{
						$html += '<tr> <td colspan="6">Sorry! No data Found</td> </tr>';
					}//end if

					$('#sl_repo_tbody').html($html);
					$('#part_three').show();
						
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});

	//Incentive Report	
	$( "#calculateIcentive" ).on( "click", function() {
		$IncDate = $('#IncDate').val();
		$html = '';
		
		$('#IncDate_error').html('');
		$('#part_three').hide();		

		if($IncDate == ''){
			$('#IncDate_error').html('Please Select date');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "calculateIcentive", IncDate: $IncDate }
			})
			  .done(function( res ) {
				$res1 = JSON.parse(res);
				if($res1.status == true){
					
						
				}else{
					alert('No Data found');
				}
			});
		}//end if
	});

	//save Samsad Meeting
	$( "#saveSamsadMeeting" ).on( "click", function() {
		$meetingDate = $('#meetingDate').val();
		$noOfGroupAttend = $('#noOfGroupAttend').val();
		$totalAttendant = $('#totalAttendant').val();
		$gpName = $('#gpName').val();
		$samsadName = $('#samsadName').val();
		$remarks = $('#remarks').val();
		$StfId = $('#StfId').val();
		
		$('#meetingDate_success').html('');
		$('#meetingDate_error').html('');
		$('#noOfGroupAttend_success').html('');
		$('#noOfGroupAttend_error').html('');		
		$('#totalAttendant_success').html('');
		$('#totalAttendant_error').html('');				
		$('#gpName_success').html('');
		$('#gpName_error').html('');				
		$('#samsadName_success').html('');
		$('#samsadName_error').html('');
		$('#remarks_success').html('');
		$('#remarks_error').html('');
		

		if($meetingDate == ''){
			$('#meetingDate_error').html('Please Enter Meeting Date');
			return false;
		}else if($noOfGroupAttend == ''){
			$('#noOfGroupAttend_error').html('Please Enter No. of Group Attend');
			return false;
		}else if($totalAttendant == ''){
			$('#totalAttendant_error').html('Please Enter Total Attendant');
			return gpName;
		}else if($gpName == '0'){
			$('#gpName_error').html('Please Select GP Name');
			return false;
		}else if($samsadName == '0'){
			$('#samsadName_error').html('Please Select Sansad Name');
			return false;
		}else{	 
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "saveSamsadMeeting", meetingDate: $meetingDate, noOfGroupAttend: $noOfGroupAttend, totalAttendant: $totalAttendant, remarks: $remarks, StfId: $StfId, gpName: $gpName, samsadName: $samsadName }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){ 					
					$('#noOfGroupAttend').val('');
					$('#totalAttendant').val('');
					$('#remarks').val('');
					$('#gpName').val('0').trigger('change');
					$('#samsadName').val('0').trigger('change');
					alert('Data saved successfully');
				}else{
					alert('Data save error');
				}
			});
		}//end if
	}); 



	//Social Activity
	$( "#getActivityData" ).on( "click", function() {
		$activityDate = $('#activityDate').val();
		$StfId = $('#StfId').val();
		
		$('#activityDate_success').html('');
		$('#activityDate_error').html('');
		
		$('#part_two').hide();
		$('#part_three').hide();
		$('#table_1').hide();
		$('#activity_list').html('');

		if($activityDate == ''){
			$('#activityDate_error').html('Please Select Date');
			return false;
		} else{	 
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "getActivityData", activityDate: $activityDate, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){			
					$html = '';	
					$activities = $res1.activities;					

					if($activities.length > 0){
						$sl = 1;
						for(var i = 0; i < $activities.length; i++){
							$html += '<tr> <td style="text-align: center;">'+$sl+'</td><td style="text-align: left;">'+$activities[i].ActNm+'</td> <td style="text-align: right;width: 100px;"><input type="number" name="noOfActivity[]" id="noOfActivity_'+$activities[i].Activity_Id+'" value="'+$activities[i].ActNo+'" class="form-control"> <input type="hidden" name="Activity_Id[]" id="Activity_Id_'+$activities[i].Activity_Id+'" value="'+$activities[i].Activity_Id+'"><input type="hidden" name="EntSl[]" id="EntSl_'+$activities[i].Activity_Id+'" value="'+$activities[i].EntSl+'"><input type="hidden" name="ActivityDt[]" id="ActivityDt_'+$activities[i].Activity_Id+'" value="'+$activities[i].ActivityDt+'"> </td> </tr>';
							$sl++;
						}
					}else{
						$html += '<tr> <td style="text-align: center;" colspan="3">No data Available</td> </tr>';
					}
					//$html += '<tr> <td style="text-align: right;" colspan="4">Subtotal</td><td style="text-align: right;"><input type="number" name="sub_total" id="sub_total" value="0.00" class="form-control" readonly></td> </tr>';

					$('#activity_list').html($html); 
					$('#part_two').show();
					$('#table_1').show();
						
				}
			});

			//Check group id
			$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "usp_GetGroup", savings_ac_no: $groupCode }
			  })
			.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#GroupId').val($res1.GrpId);
				}
			});
		}//end if
	});


	//Get Samsad
	$( "#gpName" ).on( "change", function() {
		$gpName = $('#gpName').val();
		
		$html = '<option value="0">Select</option>';

		if($gpName != '0'){				
			$.ajax({
			method: "POST",
			url: "assets/php/function.php",
			data: { fn: "GetSansadList", gpName: $gpName }
			})
			.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$all_samsad = $res1.all_samsad;
					for($i = 0; $i < $all_samsad.length; $i++){
						$html += "<option value='"+$all_samsad[$i].SsdId+"'>"+$all_samsad[$i].SsdName+"</option>"; 
					}//end for
					$('#samsadName').html($html);
				}
			});
		}else{
			$('#samsadName').html($html);
		}//end if
	});
	//Get Samsad

	//Updt Group Sansad
	$( "#UpdtGroupSansad" ).on( "click", function() {
		$GroupId = $('#GroupId').val();
		$gpName = $('#gpName').val();
		$samsadName = $('#samsadName').val(); 
		$StfId = $('#StfId').val();
		
		$('#gpName_success').html('');
		$('#gpName_error').html('');
		$('#samsadName_success').html('');
		$('#samsadName_error').html(''); 		

		if($gpName == '0'){
			$('#gpName_error').html('Please Select GP Name');
			return false;
		}else if($samsadName == '0'){
			$('#samsadName_error').html('Please Select Sansad Name');
			return false;
		}else{	 
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "UpdtGroupSansad", GroupId: $GroupId, samsadName: $samsadName, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){ 
					alert('Updated successfully')
				}else{
					alert('Data save error');
				}
			});
		}//end if
	}); 
	
	
	//Validate Transfer Member
	$( "#validateTransferMember" ).on( "click", function() {
		$transferDate = $('#transferDate').val();
		$memberCode = $('#memberCode').val();
		$fromGroupSB = $('#fromGroupSB').val();
		$toGroupSB = $('#toGroupSB').val();
		$transferAmount = $('#transferAmount').val();
		$StfId = $('#StfId').val();
		
		$('#transferDate_error').html('');
		$('#memberCode_error').html('');
		$('#fromGroupSB_error').html('');
		$('#toGroupSB_error').html('');
		$('#transferAmount_error').html('');

		if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else if($fromGroupSB == ''){
			$('#fromGroupSB_error').html('Please Enter From Group S/B');
			return false;
		}else if($toGroupSB == ''){
			$('#toGroupSB_error').html('Please Enter To Group S/B');
			return false;
		}else{	
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "validateTransferMember", memberCode: $memberCode, fromGroupSB: $fromGroupSB, toGroupSB: $toGroupSB }
			})
			  .done(function( res ) { 
				$res1 = JSON.parse(res);
				if($res1.status == true){	
					$('#transferMember').show();
					$('#FrmGrpNm').val($res1.FrmGrpNm);
					$('#ToGrpNm').val($res1.ToGrpNm);
					$('#MemNm').val($res1.MemNm);
					$('#MemBal').val($res1.MemBal); 				
				}else{	
					$('#transferMember').hide();
					$('#FrmGrpNm').val('');
					$('#ToGrpNm').val('');
					$('#MemNm').val('');
					$('#MemBal').val('');
					alert($res1.error_msg);
					return false;
				}
			});
		}//end if
	});
	
	
	//Transfer Member
	$( "#transferMember" ).on( "click", function() {
		$transferDate = $('#transferDate').val();
		$memberCode = $('#memberCode').val();
		$fromGroupSB = $('#fromGroupSB').val();
		$toGroupSB = $('#toGroupSB').val();
		$transferAmount = $('#transferAmount').val();
		$StfId = $('#StfId').val();
		
		$('#transferDate_error').html('');
		$('#memberCode_error').html('');
		$('#fromGroupSB_error').html('');
		$('#toGroupSB_error').html('');
		$('#transferAmount_error').html('');

		if($transferDate == ''){
			$('#transferDate_error').html('Please Enter Date');
			return false;
		}else if($memberCode == ''){
			$('#memberCode_error').html('Please Enter Member Code');
			return false;
		}else if($fromGroupSB == ''){
			$('#fromGroupSB_error').html('Please Enter From Group S/B');
			return false;
		}else if($toGroupSB == ''){
			$('#toGroupSB_error').html('Please Enter To Group S/B');
			return false;
		}else if($transferAmount == ''){
			$('#transferAmount_error').html('Please Enter Transfer Amount');
			return false;
		}else{	
			if(confirm('Are you sure to Transfer this member?')){
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "transferMember", transferDate: $transferDate, memberCode: $memberCode, fromGroupSB: $fromGroupSB, toGroupSB: $toGroupSB, transferAmount: $transferAmount, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				alert($res1.error_msg);
				if($res1.status == true){	
					$('#transferMember').hide();
					$('#transferDate').val('');
					$('#memberCode').val('');
					$('#fromGroupSB').val('');
					$('#toGroupSB').val('');
					$('#transferAmount').val('');	
					
					$('#FrmGrpNm').val('');
					$('#ToGrpNm').val('');
					$('#MemNm').val('');
					$('#MemBal').val('');			
				}else{
					return false;
				}
			});
		}//end if
		}//end if
	});

	//Livelihood Activity
	$( "#getLivelihoodActivity" ).on( "click", function() {
		$collectionDate = $('#collectionDate').val();
		$groupCode = $('#groupCode').val();
		$StfId = $('#StfId').val();
		
		$('#collectionDate_success').html('');
		$('#collectionDate_error').html('');
		$('#groupCode_success').html('');
		$('#groupCode_error').html('');
		$('#GrpNm').html('Group Name: ');
		$('#GrpAdd').html('Group Address: ');
		$html = '';
		$('#group_members_list').html($html);
		$('#part_two').hide();
		$('#part_three').hide();
		$('#table_1').hide();
		$('#table_2').hide();

		if($collectionDate == ''){
			$('#collectionDate_error').html('Please Enter Collection Date');
			return false;
		}else if($groupCode == ''){
			$('#groupCode_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{	
			$('#collectionDate_error').html('');
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "getGroupMembersLD", collectionDate: $collectionDate, groupCode: $groupCode, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					if($res1.GrpNm != ''){
						$('#GrpNm').html('Group Name: ' + $res1.GrpNm);
						$('#GrpAdd').html('Group Address: ' + $res1.GrpAdd);					
						
						$group_members = $res1.group_members;
						$ll_list = $res1.ll_list;					

						if($group_members.length > 0){
							$sl = 1;
							for(var i = 0; i < $group_members.length; i++){
								$Act1 = $group_members[i].Act1;
								$Act2 = $group_members[i].Act2;

								$select_html1 = '';
								$select_html1 += '<select id="Act1Id_'+$group_members[i].MemId+'" name="Act1Id[]" class="form-control">';
									$select_html1 += '<option value="0">Select</option>'; 
									if($ll_list.length > 0){
										for(var j = 0; j < $ll_list.length; j++){
											$selected_text1 = '';
											if($ll_list[j].Id == $Act1){
												$selected_text1 = 'selected';
											}
											$select_html1 += '<option value="'+$ll_list[j].Id+'" '+$selected_text1+'>'+$ll_list[j].LiveNm+'</option>'; 
										}
									}
								$select_html1 += '</select>'; 

								$select_html2 = '';
								$select_html2 += '<select id="Act2Id_'+$group_members[i].MemId+'" name="Act2Id[]" class="form-control">';
									$select_html2 += '<option value="0">Select</option>'; 
									if($ll_list.length > 0){
										for(var k = 0; k < $ll_list.length; k++){
											$selected_text2 = '';
											if($ll_list[k].Id == $Act2){
												$selected_text2 = 'selected';
											}
											$select_html2 += '<option value="'+$ll_list[k].Id+'" '+$selected_text2+'>'+$ll_list[k].LiveNm+'</option>'; 
										}
									}
								$select_html2 += '</select>'; 

								$html += '<tr> <td style="text-align: center;">'+$sl+'</td><td style="text-align: center;">'+$group_members[i].MemId+'</td> <td style="text-align: center;">'+$group_members[i].MemNm+'</td> <td style="text-align: center;">'+$select_html1+'</td> <td style="text-align: center;">'+$select_html2+'</td> <td style="text-align: right;width: 100px;"><input type="number" name="Act1Amt[]" id="Act1Amt_'+$group_members[i].MemId+'" value="'+$group_members[i].Amt+'" class="form-control" onblur="calculateSubtotalAct1Amt()"> <input type="hidden" name="collectionDate[]" id="collectionDate_'+$group_members[i].MemId+'" value="'+$collectionDate+'"><input type="hidden" name="my_id[]" id="my_id_'+$group_members[i].MemId+'" value="'+$group_members[i].MemId+'"></td></tr>';
								$sl++;
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="6">No data Available</td> </tr>';
						}
						/*if($group_members.length > 0){
							$html += '<tr> <td style="text-align: right;" colspan="5">Subtotal</td><td style="text-align: right;"><input type="number" name="sub_total" id="sub_total" value="0.00" class="form-control" readonly></td> </tr>';
						}*/

						$('#group_members_list').html($html);
						$('#GrpSBAc').val($groupCode);
						//calculateSubtotal();
						$('#part_two').show();
						$('#table_1').show();
					}else{					
						$('#part_three').show();
					}
				}
			});

			//Check group id
			$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "usp_GetGroup", savings_ac_no: $groupCode }
			  })
			.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#GroupId').val($res1.GrpId);
				}
			});
		}//end if
	});
	
	//Search Sansad Meeting
	$( "#searchSansadMeeting" ).on( "click", function() {
		$FrmDate = $('#FrmDate').val();
		$UptoDate = $('#UptoDate').val();
		$StfId = $('#StfId').val();

		if($FrmDate == ''){
			$('#FrmDate_error').html('Please Enter Collection Date');
			return false;
		}else if($UptoDate == ''){
			$('#UptoDate_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{	
			$html = '';
			$('#FrmDate_error').html($html);
			$('#UptoDate_error').html(''); 
			$("#sansad_meet_ser_1 > tbody").html(""); 
			
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "searchSansadMeeting", FrmDate: $FrmDate, UptoDate: $UptoDate, StfId: $StfId }
			})
			  .done(function( res ) {
				
				$res1 = JSON.parse(res);
				if($res1.status == true){
					if($res1.GrpNm != ''){	
						$group_reports = $res1.group_reports;					
						
						if($group_reports.length > 0){
							$sl = 1;
							for(var i = 0; i < $group_reports.length; i++){
								$html += '<tr> <td style="text-align: center;">'+$sl+'</td><td style="text-align: center;">'+$group_reports[i].MetDate+'</td> <td style="text-align: center;">'+$group_reports[i].SName+'</td> <td style="text-align: right;width: 100px;">'+$group_reports[i].GrpNo+'</td><td style="text-align: right;width: 100px;">'+$group_reports[i].MemNo+'</td> </tr>';
								$sl++;
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="5">No data Available</td>$res1.ColAmt_st </tr>';
						}
						//console.log($html);
						$('#sansad_meet_ser_1 > tbody').append($html); 
					} 
				}
			}); 
		}//end if
	});
	
	//Livelyhood Data
	$( "#searchLiveHooData" ).on( "click", function() {
		$savingsAccNo = $('#savingsAccNo').val();
		$FrmDate = $('#FrmDate').val();
		$UptoDate = $('#UptoDate').val();
		$StfId = $('#StfId').val();

		if($savingsAccNo == ''){
			$('#savingsAccNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else if($FrmDate == ''){
			$('#FrmDate_error').html('Please Enter Collection Date');
			return false;
		}else if($UptoDate == ''){
			$('#UptoDate_error').html('Please Enter Savings A/c. No.');
			return false;
		}else{	
			$html = '';
			$('#FrmDate_error').html($html);
			$('#UptoDate_error').html(''); 
			$("#sansad_meet_ser_1 > tbody").html(""); 
			
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "searchLiveHooData", savingsAccNo: $savingsAccNo, FrmDate: $FrmDate, UptoDate: $UptoDate, StfId: $StfId }
			})
			  .done(function( res ) {
				
				$res1 = JSON.parse(res);
				if($res1.status == true){
					if($res1.GrpNm != ''){	
						$group_reports = $res1.group_reports;					
						
						if($group_reports.length > 0){ 
							for(var i = 0; i < $group_reports.length; i++){
								$html += '<tr> <td style="text-align: center;">'+$group_reports[i].Sl+'</td><td style="text-align: center;">'+$group_reports[i].MemNm+'</td> <td style="text-align: center;">'+$group_reports[i].Act1+'</td> <td style="text-align: right;width: 100px;">'+$group_reports[i].Act2+'</td><td style="text-align: right;width: 100px;">'+$group_reports[i].Amt+'</td> </tr>'; 
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="5">No data Available</td> </tr>';
						}
						//console.log($html);
						$('#sansad_meet_ser_1 > tbody').append($html); 
					} 
				}
			}); 
		}//end if
	});

	$('#formColDel').on('submit', function(){
		event.preventDefault();

		if(confirm('Are you sure to delete the collection data?')){
			$collectionDate = $('#collectionDate').val();
			$savingsAcNo = $('#savingsAcNo').val();

			$.ajax({
				method: "POST",
				url: "assets/php/function.php",
				data: { fn: "formColDel", collectionDate: $collectionDate, savingsAcNo: $savingsAcNo}
			})
				.done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					alert('Data deleted successfully');					
				}					
			});
		}

	})
	
	//Loading screen
	$body = $("body");
	$(document).on({
		ajaxStart: function() { $body.addClass("loading");    },
		 ajaxStop: function() { $body.removeClass("loading"); }    
	});