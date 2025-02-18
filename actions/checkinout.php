<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == 'CI'){
	
	$employee_id				= $LoginUserInfo["device_uid"];
	$device_id					= 1;
	
	$objQayadAttendanceAdd	= new Qayadattendance;
	$objQayaduser->resetProperty();
	$ReturnUserMainId = $objQayaduser->GetUserIdByDeviceId($employee_id);
			
		$objQayadAttendance->resetProperty();
		$objQayadAttendance->setProperty("device_id", $device_id);
		$objQayadAttendance->setProperty("device_uid", $employee_id);
		$objQayadAttendance->setProperty("att_date", date("Y-m-d"));
		$objQayadAttendance->lstAttendance();
		$objQayadAttendance->totalRecords();
		if($objQayadAttendance->totalRecords() == 0){
			list($AttYear,$AttMonth,$AttDay)= explode('-', date("Y-m-d"));
			$EnteryDateFormate = $AttYear.'-'.$AttMonth.'-'.$AttDay;
			$GetDateRawFormate = gregoriantojd($AttMonth,$AttDay,$AttYear);
			
			$objQayadAttendanceAdd->setProperty("device_uid", $employee_id);
			$objQayadAttendanceAdd->setProperty("att_in", date("H:i:s"));
			$objQayadAttendanceAdd->setProperty("att_date", date("Y-m-d"));
			$objQayadAttendanceAdd->setProperty("day_id", GetDayNumber(jddayofweek($GetDateRawFormate,1)));
			$objQayadAttendanceAdd->setProperty("att_mode", 2);
			$objQayadAttendanceAdd->setProperty("device_id", $device_id);
			$objQayadAttendanceAdd->setProperty("entery_date", date('Y-m-d H:i:s'));
			$objQayadAttendanceAdd->actAttendance('I');	
			
				$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("device_id", trim($employee_id));
				$objQayadAttendance->setProperty("att_date", date("Y-m-d"));
				$objQayadAttendance->lstUserAttLeaves();
				if($objQayadAttendance->totalRecords() > 0){
					$AttLeaveID = $objQayadAttendance->dbFetchArray(1);
					$objQayadAttendance->resetProperty();
					$objQayadAttendance->setProperty("att_leave_id", $AttLeaveID["att_leave_id"]);
					$objQayadAttendance->actUserAttLeavs('D');	
				}
		
		$objCommon->setMessage(_ATTENDANCE_ADDED_SUCCESSFULLY, 'Info');
		$link = Route::_('show=checkinout');
		redirect($link);
		} else {
		$objCommon->setMessage(_ATTENDANCE_ALREADY_SUCCESSFULLY, 'Error');
		$link = Route::_('show=checkinout');
		redirect($link);
		}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == 'CO'){
	
	$employee_id				= $LoginUserInfo["device_uid"];
	$device_id					= 1;
	$Attendance_ID				= trim(DecData($_POST["ati"], 1, $objBF));
		
		if($Attendance_ID!=''){
				
			$objQayadAttendance->setProperty("attendance_id", $Attendance_ID);
			$objQayadAttendance->lstAttendance();
			if($objQayadAttendance->totalRecords() == 1){
				$Attendance_ID = $objQayadAttendance->dbFetchArray(1);
				$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("attendance_id", $Attendance_ID["attendance_id"]);
				$objQayadAttendance->setProperty("att_out", date("H:i:s"));
				$objQayadAttendance->actAttendance('U');
			}
		}
		
		$objCommon->setMessage(_ATTENDANCE_ADDED_SUCCESSFULLY, 'Info');
		$link = Route::_('show=checkinout');
		redirect($link);
		
}
?>