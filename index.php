<?php
	include('assets/php/sql_conn.php');	
	
	if(isset($_GET["p"])){
	$p = $_GET["p"];
	}else{
		$p = '';
	}
	
	switch($p){
		case 'login':
		include('pages/login.php');
		break;
		
		case 'dashboard':
		$title = "Dashboard";
		include('pages/dashboard.php');		
		break;
		
		case 'dashboard-more':
		$title = "Dashboard";
		include('pages/dashboard_more.php');		
		break;
		
		case 'group-list':
		$title = "Group List";
		include('pages/group_list.php');		
		break;
		
		case 'group-upload':
		$title = "Group Upload";
		include('pages/group_upload.php');		
		break;		
		case 'member-upload':
		$title = "Member Upload";
		include('pages/member_upload.php');		
		break;		
		case 'loan-upload':
		$title = "Loan Upload";
		include('pages/loan_upload.php');		
		break;

		case 'meeting-data':
		$title = "Meeting Data";
		include('pages/meeting_data.php');		
		break;

		case 'sansad-meeting':
		$title = "Sansad Meeting";
		include('pages/sansad_meeting.php');		
		break;

		case 'update-data':
		$title = "Update Data";
		include('pages/update_data.php');		
		break;
		
		case 'opening-data':
		$title = "Opening Data";
		include('pages/opening_data.php');		
		break;
		
		case 'meeting-data-report':
		$title = "Meeting Data Report";
		include('pages/meeting_data_report.php');		
		break;

		//		
		case 'group-opening-data':
		$title = "Group Opening Data";
		include('pages/group_opening_data.php');		
		break;	

		case 'voucher-entry':
		$title = "Voucher Entry";
		include('pages/voucher_entry.php');		
		break;	

		case 'social-activity':
		$title = "Social Activity";
		include('pages/social_activity.php');		
		break;

		case 'cash-book':
		$title = "Cash Book";
		include('pages/cash_book.php');		
		break;	
		case 'link-group':
		$title = "Link Group";
		include('pages/link_group.php');		
		break;
		//
		
		case 'link-member':
		$title = "Link Member";
		include('pages/link_member.php');		
		break;
		
		case 'member-transfer':
		$title = "Member Transfer";
		include('pages/member_transfer.php');		
		break;
		
		case 'member-update':
		$title = "Member Update";
		include('pages/member_update.php');		
		break;
		
		case 'data-export':
		$title = "Meeting Data Export";
		include('pages/data_export.php');		
		break;

		//Reports		
		case 'member-list':
		$title = "Member List";
		include('pages/member_list.php');		
		break;		
		case 'attendance-report':
		$title = "Attendance Report";
		include('pages/attendance_report.php');		
		break;	
		case 'savings-ledger-report':
		$title = "Savings Ledger Report";
		include('pages/savings_ledger_report.php');		
		break;
		case 'loan-register-report':
		$title = "Loan Register Report";
		include('pages/loan_register_report.php');		
		break;
		
		case 'change-password':
		$title = "Change Password";
		include('pages/change_password.php');		
		break;
		
		case 'backup':
		$title = "backup";
		include('pages/backup.php');		
		break;
		
		default:
		include('pages/login.php');
	}

?>