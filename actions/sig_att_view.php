<?php
/***********************************************/
$GetMobileNumber = $_GET["m"];
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_mobile", $_GET["m"]);
$objQayaduser->setProperty("isActive", '1');
$objQayaduser->lstUsers();
$GetUserDetail = $objQayaduser->dbFetchArray(1);
	
$TempDeviceUserID = $GetUserDetail["device_uid"];
$Temp_user_id = $GetUserDetail["user_id"];
$FilterStartDate = date('Y-m-d', strtotime('first day of this month'));
$FilterENDDate = date('Y-m-d', strtotime('last day of this month'));
$LateComingCutting = 0;
$OverTimeFirstShiftCount = 0;
$OverTimeSecondShiftCount = 0;
$TotalNumberofAbsent = 0;
$TotalNumberofLeave = 0;
$ShortTimeCuttingValue = 0;
/***********************************************/
$ReturnDaysList=array();
//$month = date("m");
//$year = date("Y");
$month = date('m', strtotime('first day of this month'));
$year = date("Y");
for($d=1; $d<=date('d', strtotime('last day of this month')); $d++){
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month)       
        $ReturnDaysList[]=date('Y-m-d', $time);
}
/***********************************************************************************/
/////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************************/
list($CRtYear,$CRTMonth,$CRTDay)= explode('-',$ReturnDaysList[0]);
$DayNumberFLop = jddayofweek(gregoriantojd($CRTMonth,$CRTDay,$CRtYear));
if($DayNumberFLop > 0){
	$ReturnEmptyBox = '';
	for($d=1;$d<=$DayNumberFLop;$d++){
		$ReturnEmptyBox .= '<td style="background-color:#F3F3F3;">'.$DayNumberFLop[$d].'</td>';
	}
}
/***********************************************************************************/
/////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************************/
$GetUserAttendance = array();
$objQayadattendance->setProperty("device_uid", $TempDeviceUserID);
$objQayadattendance->setProperty("DATEFILTER", 'YES');
$objQayadattendance->setProperty("STARTDATE", $FilterStartDate);
$objQayadattendance->setProperty("ENDDATE", $FilterENDDate);
$objQayadattendance->lstAttendance();
while($AttendanceIDGet = $objQayadattendance->dbFetchArray(2)){
	$GetUserAttendance[$AttendanceIDGet["att_date"]] = $AttendanceIDGet;
}
$GetHlidays = array();
$objQayaduser->resetProperty();
$objQayaduser->setProperty("DATEFILTER", 'YES');
$objQayaduser->setProperty("STARTDATE", $FilterStartDate);
$objQayaduser->setProperty("ENDDATE", $FilterENDDate);
$objQayaduser->lstHolidays();
while($GetHolidaysList = $objQayaduser->dbFetchArray(2)){
	if($GetHolidaysList["holiday_sd"] == $GetHolidaysList["holiday_ed"]){
	$GetHlidays[$GetHolidaysList["holiday_sd"]] = $GetHolidaysList;
	} else {
	$GetHlidays[$GetHolidaysList["holiday_sd"]] = $GetHolidaysList;	
	$earlier = new DateTime($GetHolidaysList["holiday_sd"]);
	$later = new DateTime($GetHolidaysList["holiday_ed"]);
	$diff = $later->diff($earlier)->format("%a"); 
		for($hd=1;$hd<=$diff;$hd++){
			$GetHlidays[date('Y-m-d', strtotime($GetHolidaysList["holiday_sd"]. ' + '.$hd.' days'))] = $GetHolidaysList;	
		}	
	}
}

$GetShifts = array();
$objQayaduser->resetProperty();
$objQayaduser->setProperty("isActive", '1');
$objQayaduser->lstShifts();
while($GetShiftsList = $objQayaduser->dbFetchArray(2)){
	$GetShifts[$GetShiftsList["shift_id"]] = $GetShiftsList;
}

$GetUserShifts = array();
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $Temp_user_id);
$objQayaduser->lstUserShifts();
while($GetUserShiftsList = $objQayaduser->dbFetchArray(2)){
		if($GetUserShiftsList["day_status"] == 1){
			$GetUserShifts[GetDayName($GetUserShiftsList["day_id"])] = array('day_status' => $GetUserShiftsList["day_status"], 'shift_st' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_st"], 'shift_et' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_et"], 'shift_ligt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_ligt"], 'shift_logt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_logt"], 'shift_eigt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_eigt"], 'shift_eogt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_eogt"], 'shift_name' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_name"]);
		} else {
			$GetUserShifts[GetDayName($GetUserShiftsList["day_id"])] = array('day_status' => $GetUserShiftsList["day_status"]);
		}
}
//print_r($GetUserShifts);

$GetLeaveRequest = array();
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $Temp_user_id);
$objQayaduser->setProperty("isActive", '1');
$objQayaduser->lstUserLeaveRequest();
while($GetLeaveRequestList = $objQayaduser->dbFetchArray(2)){
	if($GetLeaveRequestList["leave_sd"] == $GetLeaveRequestList["leave_ed"]){
	$GetLeaveRequest[$GetLeaveRequestList["leave_sd"]] = $GetLeaveRequestList;
	} else {
	$GetLeaveRequest[$GetLeaveRequestList["leave_sd"]] = $GetLeaveRequestList;	
	$earlier = new DateTime($GetLeaveRequestList["leave_sd"]);
	$later = new DateTime($GetLeaveRequestList["leave_ed"]);
	$diff = $later->diff($earlier)->format("%a"); 
		for($ld=1;$ld<=$diff;$ld++){
			$GetLeaveRequest[date('Y-m-d', strtotime($GetLeaveRequestList["leave_sd"]. ' + '.$ld.' days'))] = $GetLeaveRequestList;	
		}	
	}
}
//print_r($GetLeaveRequest);


?>