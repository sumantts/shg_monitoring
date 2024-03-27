
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

	//Opening Data
	$( "#getGroupMembers1" ).on( "click", function() {
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
		$('#group_members_list1').html($html);
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
						
						$group_members1 = $res1.group_members;				

						if($group_members1.length > 0){
							for(var i = 0; i < $group_members1.length; i++){
								$html += '<tr> <td style="text-align: center;">'+$group_members1[i].MemId+'</td> <td style="text-align: center;">'+$group_members1[i].MemNm+'</td> <td style="text-align: right;width: 100px;"><input type="number" name="CAmt[]" id="CAmt_'+$group_members1[i].MemId+'" value="0" class="form-control"> <input type="hidden" name="hiddenCAmt[]" id="hiddenCAmt_'+$group_members1[i].MemId+'" value="'+$group_members1[i].CAmt+'" class="form-control"><input type="hidden" name="collectionDate[]" id="collectionDate_'+$group_members1[i].MemId+'" value="'+$collectionDate+'">  <input type="hidden" name="my_id[]" id="my_id_'+$group_members1[i].MemId+'" value="'+$group_members1[i].MemId+'"> </td> </tr>';
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="4">No data Available</td> </tr>';
						}

						$('#group_members_list1').html($html);
						$('#GroupId').val($groupCode);
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
				$sub_total = parseFloat($sub_total) + parseFloat($myFormData[$i].value);
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
		$intRcptDate = $('#intRcptDate').val();
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
					$('#ir_GroupName').html('Group Name: '+$res1.GrpNm);
					$('#ir_GroupAddress').html('Group Address: '+$res1.GrpAdd);
					
					$('#part_two').show();
				}else{
					alert('No Data Found');
				}
			});
		}//end if
	});
	//Save Interest Amount	
	$( "#saveInterestAmount" ).on( "click", function() {
		$intRcptDate = $('#intRcptDate').val();
		$groupAcNo = $('#groupAcNo').val();
		$intAmount = $('#intAmount').val();
		$StfId = $('#StfId').val();
		
		$('#intRcptDate_error').html('');
		$('#groupAcNo_error').html('');	
		$('#intAmount_error').html('');		
		
		$('#interestAmount').html('Interest Amount: ');
		//$('#part_two').hide();		

		if($intRcptDate == ''){
			$('#intRcptDate_error').html('Please Select Date');
			return false;
		}else if($groupAcNo == ''){
			$('#groupAcNo_error').html('Please Enter Savings A/c. No.');
			return false;
		}else if($intAmount <= 0){
			$('#intAmount_error').html('Please Enter Interest Amount');
			return false;
		}else{
			$.ajax({
			  method: "POST",
			  url: "assets/php/function.php",
			  data: { fn: "saveInterestAmount", intRcptDate: $intRcptDate, groupAcNo: $groupAcNo, intAmount: $intAmount, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#groupAcNo').val('');
					$('#intAmount').val('');
					alert('Interest Amount Saved');
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
			  data: { fn: "saveVoucher", entryDate: $entryDate, groupAcNo: $groupAcNo, voucherType: $voucherType, voucherAmount: $voucherAmount, particulars: $particulars, StfId: $StfId }
			})
			  .done(function( res ) {
				//console.log(res);
				$res1 = JSON.parse(res);
				if($res1.status == true){
					$('#entryDate').val('');
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
		$groupAcNo = $('#groupAcNo').val();
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
					
					$('#part_two').show();
				}else{
					alert('No Data Available');
				}
			});
		}//end if
	});
	//Link Group 2nd part	
	$( "#linkGroupSave" ).on( "click", function() {
		$groupAcNo = $('#groupAcNo').val();
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
					
					$('#part_two').show();
				}else{
					alert('No Data Found');
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