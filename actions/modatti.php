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
			$link = Route::_('show=modatti&rt='.EncData('yes', 2, $objBF).'&ati='.EncData($AttendanceDetail["attendance_id"], 2, $objBF));
			redirect($link);
		} else {
			$objCommon->setMessage(_NORECORDFOUND, 'Error');
			$link = Route::_('show=modatti&rt='.EncData('no', 2, $objBF));
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
		if($att_in != ''){
		$objQayadAttendance->setProperty("att_in", date("G:i", strtotime($att_in)).':00');
		}
		if($att_out != ''){
		$objQayadAttendance->setProperty("att_out", date("G:i", strtotime($att_out)).':00');
		}
		$objQayadAttendance->actAttendance('U');
		
		$objCommon->setMessage(_ATTENDANCE_ADDED_SUCCESSFULLY, 'Info');
		$link = Route::_('show=modatti&rt='.EncData('yes', 2, $objBF).'&ati='.EncData(trim(DecData($attendance_id, 1, $objBF)), 2, $objBF));
		redirect($link);
}
?>