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
		$objQayadattendance->setProperty("att_date", dateFormate_10($modification_date));
		$objQayadattendance->setProperty("device_uid", $GetUserDeviceId);
		$objQayadattendance->lstAttendance();
		if($objQayadattendance->totalRecords() > 0){
		$AttendanceDetail = $objQayadattendance->dbFetchArray(1);
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
		
		
		$objQayadattendance->resetProperty();
		$objQayadattendance->setProperty("attendance_id", trim(DecData($attendance_id, 1, $objBF)));
		$objQayadattendance->lstAttendance();
		$AttDetail = $objQayadattendance->dbFetchArray(1);
		
			$objQayadattendance->resetProperty();
			$objQayadattendance->setProperty("manual_attendance_id", $AttDetail["attendance_id"]);
			$objQayadattendance->setProperty("user_id", $AttDetail["user_id"]);
			$objQayadattendance->setProperty("device_uid", $AttDetail["device_uid"]);
			$objQayadattendance->setProperty("att_in", $AttDetail["att_in"]);
			$objQayadattendance->setProperty("att_out", $AttDetail["att_out"]);
			$objQayadattendance->setProperty("att_date", $AttDetail["att_date"]);
			$objQayadattendance->setProperty("day_id", $AttDetail["day_id"]);
			$objQayadattendance->setProperty("isActive", 1);
			$objQayadattendance->setProperty("entery_date", date('Y-m-d H:i:s'));
			$objQayadattendance->actManualAttendance('U');
		
		$objQayadattendance->resetProperty();
		$objQayadattendance->setProperty("attendance_id", trim(DecData($attendance_id, 1, $objBF)));
		if($att_in != ''){
		$objQayadattendance->setProperty("att_in", date("G:i", strtotime($att_in)).':00');
		}
		if($att_out != ''){
		$objQayadattendance->setProperty("att_out", date("G:i", strtotime($att_out)).':00');
		}
		$objQayadattendance->setProperty("att_mode", 2);
		$objQayadattendance->setProperty("att_process", 1);
		$objQayadattendance->actAttendance('U');
			
				$objQayadattendance->resetProperty();
				$objQayadattendance->setProperty("att_id", trim(DecData($attendance_id, 1, $objBF)));
				$objQayadattendance->lstUserAttLeaves();
				if($objQayadattendance->totalRecords() > 0){
					$AttLeaveID = $objQayadattendance->dbFetchArray(1);
					$objQayadattendance->resetProperty();
					$objQayadattendance->setProperty("att_leave_id", $AttLeaveID["att_leave_id"]);
					$objQayadattendance->actUserAttLeavs('D');	
				}
			
			
		$objCommon->setMessage(_ATTENDANCE_ADDED_SUCCESSFULLY, 'Info');
		$link = Route::_('show=attendancemodification&rt='.EncData('yes', 2, $objBF).'&ati='.EncData(trim(DecData($attendance_id, 1, $objBF)), 2, $objBF));
		redirect($link);
}
?>