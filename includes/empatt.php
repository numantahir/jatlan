<style>
/*body{margin:10px;}*/
td {
	padding: 25px !important;
	text-align: center;
	border: solid 1px #cccccc;
	color: #FFF !important;
	font-weight: bold;
	letter-spacing: 1px;
	font-family: monospace;
	font-size: 11px;
	height: 135px;
	width: 14%;
}
th {
	text-align: center;
}
span {
	color: #FFF;
}
 @keyframes LI {
50% {
opacity: .1;
}
 100% {
opacity: 1;
}
}
.LI {
	color: #FFF;
	animation: LI 1s alternate infinite;
	border-radius: 5px;
	background-color: #6A0003;
}
code {
	background-color: #FFF !important;
	color: #000 !important;
}
.overtime_request {
	width: 100%;
	float: left;
	margin-top: 5px;
	margin-bottom: 5px;
}
table.table.table-striped.table-no-bordered.table-hover.calendar tr th {
	width: 12%;
	float: left;
	margin: 0 5px;
	background: transparent;
	border: 0;
	color: #000;
}
table.table.table-striped.table-no-bordered.table-hover.calendar tr td {
	height: 85px;
	float: left;
	width: 12%;
	border-radius: 10px;
	padding: 0 !important;
	margin: 5px 5px;
	position: relative;
	text-align: left;
	border: 0;
	color: #FFF !important;
	font-size: 11px !important;
}
table.table.table-striped.table-no-bordered.table-hover.calendar tr:hover {
	background-color: transparent;
}
table.table.table-striped.table-no-bordered.table-hover.calendar tr td .time {
	position: relative;
	z-index: 1;
	margin: 5px 0px 0 5px;
	display: inline-block;
}
table.table.table-striped.table-no-bordered.table-hover.calendar>tbody>tr:nth-of-type(odd) {
	background-color: transparent;
}
.sunday {
	background: #5B2566;
	overflow:hidden;
}
.absent {
	background: #F56955;
	overflow:hidden;
}
.present {
	background: #00C56B;
	position: relative;
	overflow: hidden;
}
.leave {
	background: #2B4492;
	overflow:hidden;
}
.holiday {
	background: #F39B19;
	overflow:hidden;
}
.short-time {
	background: #7C539F;
	overflow:hidden;
}
.over-time {
	background: #8C4647;
	overflow:hidden;
}
.late-in  .shot-leave, .time-over, .late-in, .half-leave-f, .half-leave-s, .present.late-in .present, .present.early-out .absent {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: 10px;
	top: 70px;
}
.present.late-in .present {
	background: #00C56B
}
.late-in {
	background: #F56955
}
.half-leave-f {
	background: #2B4492;
}
.half-leave-s {
	background: #2B4492;
}
.color-box.half-leave-f {
	position: static;
	transform: inherit;
}
.color-box.half-leave-S {
	position: static;
	transform: inherit;
}
.late-in-50 {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: -100px;
	top: -100px;
}
.late-in-100 {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: -7px;
	top: -36px;
}
.half-leave-f {
	background: #2B4492;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: -100px;
	top: -100px;
}
.half-leave-s {
	background: #2B4492;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: 10px;
	top: 30px;
}
.late-in-25 {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: -140px;
	top: -100px;
}
.early-out-10 {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: 25px;
	top: 75px;
}
.early-out-25 {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: 5px;
	top: 75px;
}
.early-out-50 {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: 5px;
	top: 36px;
}
.early-out-100 {
	background: #7C539F;
	width: 170px;
	height: 170px;
	float: right;
	transform: rotate(38deg);
	position: absolute;
	right: -40px;
	top: -40px;
}
.time-over {
	background: #8C4647
}
.early-out {
	background: #7C539F
}
.half-leave-f {
	background: #2B4492;
}
.half-leave-s {
	background: #2B4492;
}
.late-in-50, .late-in-25, .late-in-100 {
	background: #F56955;
}
.early-out-10, .early-out-25, .early-out-50, .early-out-100 {
	background: #F56955;
}
.cal-date {
	position: absolute;
	bottom: 5px;
	right: 10px;
	font-size: 20px;
}
.blank {
	background: #EAEAEA;
	color: #99928
}
.blank .cal-date {
	color: #999;
}
.cal-month {
	font-size: 20px;
	font-weight: 600;
	margin-bottom: 5px;
}
.login-time {
	display: inline-block;
	width: 100%;
	margin: 0 0 5px 0;
}
.login-time span {
	color: #414042;
	font-weight: 600;
	font-size: 15px;/*border-bottom: 1px solid #414042;*/

}
.total-time {
	display: inline-block;
	margin: 15px 0 15px 0;
}
.total-time span {
	color: #231F20;
	border: 2px solid #ED978C;
	padding: 5px 20px;
	border-radius: 5px;
	font-size: 20px;
	font-weight: 600;
	margin: 0 0 0 20px;
}
.late-time span {
	color: #414042;
	font-weight: 600;
	border-bottom: 1px solid #414042;
}
.left-side {
	border-right: 2px dashed #F2F2F3;
}
.attends-detail {
	font-size: 12px;
	margin-top: 50px;
	border-bottom: 2px dashed #676668;
	padding-bottom: 40px;
}
.attends-detail:last-child {
	border-bottom: 0
}
.cal-day {
	font-weight: 600;
	font-size: 14px;
	margin: 0 0 5px 0;
}
.legend-heading {
	color: #A7A9AC;
	font-weight: 700;
	font-size: 18px;
	margin: 15px 0 10px 0;
	display: inline-block;
}
ul.lagends {
	padding: 0
}
ul.lagends li {
	list-style: none;
	display: inline-block;
	margin: 0 20px 0 0px;
}
ul.lagends li .color-box {
	width: 20px;
	height: 20px;
	border-radius: 6px;
	float: left;
	margin: 0 5px 0px 0;
}
ul.lagends li .color-box.weekend {
	background: #5B2566;
}
ul.lagends li .color-box.time-over {
	position: static;
	transform: rotate(0deg);
}
td.present.late-in {
	transform: inherit;
	top: 0;
	right: 0;
}
ul.lagends li .color-box.late-in {
	position: static;
	transform: rotate(0deg);
	background: #F56955
}
ul.lagends li .color-box.late-in-25 {
	position: static;
	transform: rotate(0deg);
}
table.table.table-striped.table-no-bordered.table-hover.calendar tr td.leave, table.table.table-striped.table-no-bordered.table-hover.calendar tr td.absent, table.table.table-striped.table-no-bordered.table-hover.calendar tr td.holiday {
	font-size: 14px;
	text-align: left;
	margin-top: 5px !important;
	display: inline-block;
	font-weight: normal;
	font-family: inherit;
}
table.table.table-striped.table-no-bordered.table-hover.calendar tr td.leave span, table.table.table-striped.table-no-bordered.table-hover.calendar tr td.absent span, table.table.table-striped.table-no-bordered.table-hover.calendar tr td.holiday span {
	margin-top: 12px;
	display: inline-block;
}
.present.early-out {
	background: #00C56B;
}
.present.early-out .absent {
	background: #F56955;
}
.cal-arrow {
	width: 100%;
	;
	text-align: center
}
.cal-arrow span {
	text-align: center;
	margin-bottom: 20px;
	font-size: 30px;
	font-weight: 600;
	color: #231F20;
	display: inline-block;
	margin-top: 8px;
}
.cal-arrow a {
	display: inline-block;
	color: #fff;
	position: relative;
	border-radius: 5px;
	margin: 0 20px;
}
.cal-arrow a .fas {
	padding: 7px 0;
	font-size: 16px
}
.arrows {
	width: 30%;
	margin: auto;
}
.arrows a.left-arrow {
	float: left;
	margin-top: 7px;
}
.arrows a.right-arrow {
	float: right;
	margin-top: 7px;
}
.HolidayModifiy {
	width: 95%;
	float: left;
	text-align: left;
	margin-left: 5px;
}
</style>
<?php
/***********************************************/
//$GetRequestMonth = trim(DecData($_GET["m"], 1, $objBF));
$GetRequestMonth = trim($_GET["m"]);
//echo $GetRequestMonth.'<br>';
//echo date("Y-m-d",strtotime("-".$GetRequestMonth." month")).'<br>';

if($GetRequestMonth != ''){
if($GetRequestMonth <= 0){
$LastMonth = 01;
} else {
$LastMonth = (int)trim($GetRequestMonth) - 1;
}
$NextMonth = (int)trim($GetRequestMonth) + 1;
//echo $GetRequestMonth.'<br>';
//echo 'Next = '.date("Y-m-d",strtotime("+".$NextMonth." month")).'<br>';
//echo 'Last = '.date("Y-m-d",strtotime("-".$LastMonth." month")).'<br>';
//echo $NextMonth.' - '.$LastMonth.'<br>';

$RequestedMonth = MonthList($GetRequestMonth);
$ts = strtotime($RequestedMonth.' '.date("Y"));
$RequestedStartDate = date("Y").'-'.$GetRequestMonth.'-01';
$RequestedEndDate =  date("Y").'-'.$GetRequestMonth.'-'.date('t', $ts);
//echo date("Y-m-d",strtotime("-2 month")).'<br>';
//echo $RequestedStartDate.'<br>';
//echo $RequestedEndDate;
$AttStartDate = strtotime($RequestedStartDate);
$AttEndDate = strtotime($RequestedEndDate);
} else {
$AttStartDate = strtotime('first day of this month');

$AttEndDate = strtotime('last day of this month');

$LastMonth = date("m") - 1;
$NextMonth = date("m") + 1;
}



$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
//$objQayaduser->setProperty("user_id", 16);
$objQayaduser->setProperty("isActive", '1');
$objQayaduser->lstUsers();
$GetUserDetail = $objQayaduser->dbFetchArray(1);
	
$TempDeviceUserID = $GetUserDetail["device_uid"];
$Temp_user_id = $GetUserDetail["user_id"];
$FilterStartDate = date('Y-m-d', $AttStartDate);
$FilterENDDate = date('Y-m-d', $AttEndDate);
$LateComingCutting = 0;
$OverTimeFirstShiftCount = 0;
$OverTimeSecondShiftCount = 0;
$OverTimeThirdShiftCount = 0;
$TotalNumberofAbsent = 0;
$TotalNumberofLeave = 0;
$ShortTimeCuttingValue = 0;
$ShortTotalTimeMint = 0;
$LateInTotalTimeMint = 0;
/***********************************************/
$ReturnDaysList=array();
//$month = date("m");
//$year = date("Y");
$month = date('m', $AttStartDate);
$year = date("Y");
for($d=1; $d<=date('d', $AttEndDate); $d++){
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
		$ReturnEmptyBox .= '<td class="blank">'.$DayNumberFLop[$d].'</td>';
	}
}
/***********************************************************************************/
/////////////////////////////////////////////////////////////////////////////////////
/***********************************************************************************/
$GetUserAttendance = array();
$objQayadAttendance->resetProperty();
$objQayadAttendance->setProperty("device_uid", $TempDeviceUserID);
$objQayadAttendance->setProperty("DATEFILTER", 'YES');
$objQayadAttendance->setProperty("STARTDATE", $FilterStartDate);
$objQayadAttendance->setProperty("ENDDATE", $FilterENDDate);
$objQayadAttendance->lstAttendance();
while($AttendanceIDGet = $objQayadAttendance->dbFetchArray(2)){
	$GetUserAttendance[$AttendanceIDGet["att_date"]] = $AttendanceIDGet;
}

//print_r($GetUserAttendance);
//die();

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
			$GetUserShifts[GetDayName($GetUserShiftsList["day_id"])] = array('day_status' => $GetUserShiftsList["day_status"], 'shift_st' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_st"], 'shift_et' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_et"], 'shift_ligt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_ligt"], 'shift_logt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_logt"], 'shift_eigt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_eigt"], 'shift_eogt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_eogt"], 'shift_name' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_name"], 'full_off_bef' => $GetShifts[$GetUserShiftsList["shift_id"]]["full_off_bef"], 'half_off_bef_start' => $GetShifts[$GetUserShiftsList["shift_id"]]["half_off_bef_start"], 'half_off_bef_end' => $GetShifts[$GetUserShiftsList["shift_id"]]["half_off_bef_end"], 'qutr_off_bef_start' => $GetShifts[$GetUserShiftsList["shift_id"]]["qutr_off_bef_start"], 'qutr_off_bef_end' => $GetShifts[$GetUserShiftsList["shift_id"]]["qutr_off_bef_end"], 'ten_off_bef_start' => $GetShifts[$GetUserShiftsList["shift_id"]]["ten_off_bef_start"], 'ten_off_bef_end' => $GetShifts[$GetUserShiftsList["shift_id"]]["ten_off_bef_end"], 'full_late_in' => $GetShifts[$GetUserShiftsList["shift_id"]]["full_late_in"], 'half_late_in' => $GetShifts[$GetUserShiftsList["shift_id"]]["half_late_in"], 'qutr_late_in' => $GetShifts[$GetUserShiftsList["shift_id"]]["qutr_late_in"], 'ligt_status' => $GetShifts[$GetUserShiftsList["shift_id"]]["ligt_status"], 'eogt_status' => $GetShifts[$GetUserShiftsList["shift_id"]]["eogt_status"]);
		} else {
			$GetUserShifts[GetDayName($GetUserShiftsList["day_id"])] = array('day_status' => $GetUserShiftsList["day_status"]);
		}
}

//print_r($GetUserShifts);
//die();

$GetLeaveRequest = array();
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $Temp_user_id);
$objQayaduser->setProperty("leave_status", '2');
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
	/************************************************/
	//////////////////////////////////////////////////
	/************************************************/
	$PassTodayDayName = '';
	$PassTodayInTime = '';
	$PassTodayOutTime = '';
	$HolidayArray = '';
	$EmpInTime = '';
	$EmpImInOffice = '';
	$EmpOutTime = '';
	$LateIn = '';
	$LateIn_25 = '';
	$LateIn_50 = '';
	$LeaveDetail = '';
	$AbsentDetail = '';
	$EarlyOut_10 = '';
	$EarlyOut_25 = '';
	$EarlyOut_50 = '';
	$EarlyOut_100 = '';
	$OverTimePass = '';
	$HalfDayLeaveShow = '';
	$PassTodayNumberofHours = '';
	$TodayOverTimePass = '0:00';
	$TodayShortTimePass = '0:00';
	$TodayLateInTimePass = '';

	$p_HolidayArray = '';
	$p_EmpInTime = '';
	$p_EmpImInOffice = '';
	$p_EmpOutTime = '';
	$p_LateIn = '';
	$p_LateIn_25 = '';
	$p_LateIn_50 = '';
	$p_LeaveDetail = '';
	$p_AbsentDetail = '';
	$p_EarlyOut = '';
	$p_TNoOfHoursToday = '';
	$p_OverTimePass = '';
	$p_OverTimePass_request = 0;
	$p_attendance_id = '';
	$p_totalnof_mint_ot = '';
	$LeaveCheckerPerDay = 0;
	/************************************************/
	//////////////////////////////////////////////////
	/************************************************/
?>
