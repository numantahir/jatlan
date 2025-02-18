<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "ST-1"){

	$att_in						= trim($_POST['att_in']);
	$att_out					= trim($_POST['att_out']);
	$att_date					= trim($_POST["att_date"]);
	$employee_id				= trim($_POST["employee_id"]);
	$device_id					= trim($_POST["device_id"]);
	$objQayadAttendanceAdd	= new Qayadattendance;
	$objQayaduser->resetProperty();
	$ReturnUserMainId = $objQayaduser->GetUserIdByDeviceId($employee_id);
			
		$objQayadAttendance->resetProperty();
		$objQayadAttendance->setProperty("device_id", $device_id);
		$objQayadAttendance->setProperty("device_uid", trim($employee_id));
		$objQayadAttendance->setProperty("att_date", dateFormate_10($att_date));
		$objQayadAttendance->lstAttendance();
		$objQayadAttendance->totalRecords();
		if($objQayadAttendance->totalRecords() == 0){
			list($AttYear,$AttMonth,$AttDay)= explode('-', dateFormate_10($att_date));
			$EnteryDateFormate = $AttYear.'-'.$AttMonth.'-'.$AttDay;
			$GetDateRawFormate = gregoriantojd($AttMonth,$AttDay,$AttYear);
			
			$objQayadAttendanceAdd->setProperty("device_uid", $employee_id);
			$objQayadAttendanceAdd->setProperty("att_in", date("H:i:s", strtotime($att_in)));
			if($att_out != ""){
			$objQayadAttendanceAdd->setProperty("att_out", date("H:i:s", strtotime($att_out)));
			}
			$objQayadAttendanceAdd->setProperty("att_date", dateFormate_10($att_date));
			$objQayadAttendanceAdd->setProperty("day_id", GetDayNumber(jddayofweek($GetDateRawFormate,1)));
			$objQayadAttendanceAdd->setProperty("att_mode", 2);
			$objQayadAttendanceAdd->setProperty("device_id", $device_id);
			$objQayadAttendanceAdd->setProperty("entery_date", date('Y-m-d H:i:s'));
			$objQayadAttendanceAdd->actAttendance('I');	
			
				$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("device_id", trim($employee_id));
				$objQayadAttendance->setProperty("att_date", dateFormate_10($att_date));
				$objQayadAttendance->lstUserAttLeaves();
				if($objQayadAttendance->totalRecords() > 0){
					$AttLeaveID = $objQayadAttendance->dbFetchArray(1);
					$objQayadAttendance->resetProperty();
					$objQayadAttendance->setProperty("att_leave_id", $AttLeaveID["att_leave_id"]);
					$objQayadAttendance->actUserAttLeavs('D');	
				}
		
		$objCommon->setMessage(_ATTENDANCE_ADDED_SUCCESSFULLY, 'Info');
		$link = Route::_('show=eattend&i='.EncData($ReturnUserMainId, 2, $objBF));
		redirect($link);
		} else {
		$objCommon->setMessage(_ATTENDANCE_ALREADY_SUCCESSFULLY, 'Error');
		$link = Route::_('show=addattendance');
		redirect($link);
		}
}
?>