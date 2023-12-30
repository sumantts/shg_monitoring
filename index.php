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
		
		case 'group-upload':
		$title = "Group Upload";
		include('pages/group_upload.php');		
		break;
		
		case 'member-upload':
		$title = "Member Upload";
		include('pages/member_upload.php');		
		break;
		
		case 'meeting-data':
		$title = "Meeting Data";
		include('pages/meeting_data.php');		
		break;
		
		case 'opening-data':
		$title = "Opening Data";
		include('pages/opening_data.php');		
		break;
		
		case 'link-member':
		$title = "Link Member";
		include('pages/link_member.php');		
		break;
		
		case 'data-export':
		$title = "Meeting Data Export";
		include('pages/data_export.php');		
		break;
		
		case 'change-password':
		$title = "Change Password";
		include('pages/change_password.php');		
		break;
		
		default:
		include('pages/login.php');
	}

?>