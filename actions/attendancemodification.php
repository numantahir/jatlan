<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "ST-1"){

	$modification_date		= trim($_POST['modification_date']);
	$employee_id			= trim($_POST['employee_id']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("modification_date", 'Modification date' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("employee_id", 'Employee selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		$GetUserDeviceId = $objQayaduser->GetUserDeviceId($employee_id);
		//echo dateFormate_10($modification_date);
		$objQayadAttendance->setProperty("att_date", dateFormate_10($modification_date));
		$objQayadAttendance->setProperty("device_uid", $GetUserDeviceId);
		$objQayadAttendance->lstAttendance();
		if($objQayadAttendance->totalRecords() > 0){
		$AttendanceDetail = $objQayadAttendance->dbFetchArray(1);
			$link = Route::_('show=attendancemodification&rt='.EncData('yes', 2, $objBF).'&ati='.EncData($AttendanceDetail["attendance_id"], 2, $objBF));
			redirect($link);
		} else {
			$objCommon->setMessage(_NORECORDFOUND, 'Error');
			$link = Route::_('show=attendancemodification&rt='.EncData('no', 2, $objBF));
			redirect($link);
		}
	}
}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "ST-2"){
	
	$attendance_id			= trim($_POST['attendance_id']);
	$att_in					= trim($_POST['att_in']);
	$att_out				= trim($_POST['att_out']);
		
		
		$objQayadAttendance->resetProperty();
		$objQayadAttendance->setProperty("attendance_id", trim(DecData($attendance_id, 1, $objBF)));
		$objQayadAttendance->lstAttendance();
		$AttDetail = $objQayadAttendance->dbFetchArray(1);
		
			$objQayadAttendance->resetProperty();
			$objQayadAttendance->setProperty("manual_attendance_id", $AttDetail["attendance_id"]);
			$objQayadAttendance->setProperty("user_id", $AttDetail["user_id"]);
			$objQayadAttendance->setProperty("device_uid", $AttDetail["device_uid"]);
			$objQayadAttendance->setProperty("att_in", $AttDetail["att_in"]);
			$objQayadAttendance->setProperty("att_out", $AttDetail["att_out"]);
			$objQayadAttendance->setProperty("att_date", $AttDetail["att_date"]);
			$objQayadAttendance->setProperty("day_id", $AttDetail["day_id"]);
			$objQayadAttendance->setProperty("modify_by_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			$objQayadAttendance->setProperty("isActive", 1);
			$objQayadAttendance->setProperty("entery_date", date('Y-m-d H:i:s'));
			$objQayadAttendance->actManualAttendance('I');
		
		$objQayadAttendance->resetProperty();
		$objQayadAttendance->setProperty("attendance_id", trim(DecData($attendance_id, 1, $objBF)));
		if($att_in != ''){
		$objQayadAttendance->setProperty("att_in", date("G:i", strtotime($att_in)).':00');
		}
		if($att_out != ''){
		$objQayadAttendance->setProperty("att_out", date("G:i", strtotime($att_out)).':00');
		}
		$objQayadAttendance->setProperty("att_mode", 2);
		$objQayadAttendance->setProperty("att_process", 1);
		$objQayadAttendance->actAttendance('U');
			
				$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("att_id", trim(DecData($attendance_id, 1, $objBF)));
				$objQayadAttendance->lstUserAttLeaves();
				if($objQayadAttendance->totalRecords() > 0){
					$AttLeaveID = $objQayadAttendance->dbFetchArray(1);
					$objQayadAttendance->resetProperty();
					$objQayadAttendance->setProperty("att_leave_id", $AttLeaveID["att_leave_id"]);
					$objQayadAttendance->actUserAttLeavs('D');	
				}
			
			
		$objCommon->setMessage(_ATTENDANCE_ADDED_SUCCESSFULLY, 'Info');
		$link = Route::_('show=attendancemodification&rt='.EncData('yes', 2, $objBF).'&ati='.EncData(trim(DecData($attendance_id, 1, $objBF)), 2, $objBF));
		redirect($link);
}
?>