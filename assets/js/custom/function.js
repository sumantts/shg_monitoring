
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
							$html += '<tr> <td style="text-align: center;" colspan="3">No data Available</td> </tr>';
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
							for(var i = 0; i < $group_members.length; i++){
								$html += '<tr> <td style="text-align: center;">'+$group_members[i].MemId+'</td> <td style="text-align: center;">'+$group_members[i].MemNm+'</td> <td style="text-align: center;"><input type="checkbox" name="attendance[]" id="attendance_'+$group_members[i].MemId+'" checked class="check_class" data-member_id="'+$group_members[i].MemId+'" /><input type="hidden" name="attendance_text[]" id="attendance_text_'+$group_members[i].MemId+'" value="1" /></td> <td style="text-align: right;width: 100px;"><input type="number" name="CAmt[]" id="CAmt_'+$group_members[i].MemId+'" value="'+$group_members[i].CAmt+'" class="form-control"> <input type="hidden" name="hiddenCAmt[]" id="hiddenCAmt_'+$group_members[i].MemId+'" value="'+$group_members[i].CAmt+'" class="form-control"><input type="hidden" name="collectionDate[]" id="collectionDate_'+$group_members[i].MemId+'" value="'+$collectionDate+'">  <input type="hidden" name="my_id[]" id="my_id_'+$group_members[i].MemId+'" value="'+$group_members[i].MemId+'"> </td> </tr>';
							}
						}else{
							$html += '<tr> <td style="text-align: center;" colspan="4">No data Available</td> </tr>';
						}

						//$html += '<tr> <td style="text-align: center;"> </td> <td style="text-align: center;">Total </td> <td style="text-align: center;"> </td> <td style="text-align: right;">'+$res1.grantCAmt+'</td> </tr>';

						$('#group_members_list').html($html);
						//$('#GroupId').val($groupCode);
						$('#part_two').show();
					}else{					
						$('#part_three').show();
					}
				}else{
					/*$('#collectionDate_success').html('');
					$('#collectionDate_error').html($res1.error_msg);
					return false;*/
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
	
	
	//Loading screen
	$body = $("body");
	$(document).on({
		ajaxStart: function() { $body.addClass("loading");    },
		 ajaxStop: function() { $body.removeClass("loading"); }    
	});