
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
								$html += '<tr> <td style="text-align: center;">'+$group_members1[i].MemId+'</td> <td style="text-align: center;">'+$group_members1[i].MemNm+'</td> <td style="text-align: right;width: 100px;"><input type="number" name="CAmt[]" id="CAmt_'+$group_members1[i].MemId+'" value="'+$group_members1[i].OpnAmt+'" class="form-control"> <input type="hidden" name="hiddenCAmt[]" id="hiddenCAmt_'+$group_members1[i].MemId+'" value="'+$group_members1[i].CAmt+'" class="form-control"><input type="hidden" name="collectionDate[]" id="collectionDate_'+$group_members1[i].MemId+'" value="'+$collectionDate+'">  <input type="hidden" name="my_id[]" id="my_id_'+$group_members1[i].MemId+'" value="'+$group_members1[i].MemId+'"> </td><td style="text-align: right;width: 100px;"><input type="number" name="Opening_Dues[]" id="Opening_Dues_'+$group_members1[i].MemId+'" value="'+$group_members1[i].Opening_Dues+'" class="form-control"></td> </tr>';
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="5">No data Available</td> </tr>';
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
				//console.log(res);
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
					//$('#entryDate').val('');
					$('#groupAcNo').val('');
					$('#voucherType').val('0').trigger('change');
					$('#voucherAmount').val('');
					$('#particulars').val('0').trigger('change');
					$('#part_two').hide();
					alert('Particular saved successfully');
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
							$html += '<tr> <td>'+$memlist_rows[$i].Sl+'</td> <td>'+$memlist_rows[$i].MemId+'</td> <td class="text-left">'+$memlist_rows[$i].MemNm+'</td> <td class="text-left">'+$memlist_rows[$i].GurdNm+'</td> <td class="text-left">'+$memlist_rows[$i].Village+'</td> <td class="text-left">'+$memlist_rows[$i].Aadhar+'</td> <td class="text-left">'+$memlist_rows[$i].PAN+'</td> <td class="text-left">'+$memlist_rows[$i].Voter+'</td> </tr>';
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

	
	//Loading screen
	$body = $("body");
	$(document).on({
		ajaxStart: function() { $body.addClass("loading");    },
		 ajaxStop: function() { $body.removeClass("loading"); }    
	});