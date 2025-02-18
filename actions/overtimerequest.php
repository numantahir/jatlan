<?php
if(trim(DecData($_GET["rq"], 1, $objBF)) == 'Approved' && trim(DecData($_GET["ati"], 1, $objBF)) != ''){
		
		$objQayadAttendance->setProperty("attendance_id", trim(DecData($_GET["ati"], 1, $objBF)));
		$objQayadAttendance->setProperty("overtime_status", 3);
		$objQayadAttendance->actAttendance('U');
		
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", trim(DecData($_GET["ui"], 1, $objBF)));
			$objQayaduser->setProperty("att_id", trim(DecData($_GET["ati"], 1, $objBF)));
			$objQayaduser->setProperty("overtime_approved", 1);
			$objQayaduser->actEmployeeOverTimeDetail('U');
		
		
		$objCommon->setMessage(_OVERTIME_STATUS_MODE_APROVED, 'Info');
		$link = Route::_('show=overtimerequest');
		redirect($link);
}
if(trim(DecData($_GET["rq"], 1, $objBF)) == 'Reject' && trim(DecData($_GET["ati"], 1, $objBF)) != ''){
		
		$objQayadAttendance->setProperty("attendance_id", trim(DecData($_GET["ati"], 1, $objBF)));
		$objQayadAttendance->setProperty("overtime_status", 4);
		$objQayadAttendance->actAttendance('U');
			
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", trim(DecData($_GET["ui"], 1, $objBF)));
			$objQayaduser->setProperty("att_id", trim(DecData($_GET["ati"], 1, $objBF)));
			$objQayaduser->setProperty("overtime_approved", 3);
			$objQayaduser->actEmployeeOverTimeDetail('U');
		
		
		$objCommon->setMessage(_OVERTIME_STATUS_MODE_REJECT, 'Info');
		$link = Route::_('show=overtimerequest');
		redirect($link);
}
?>