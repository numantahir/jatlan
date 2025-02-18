<?php
$objCommon 				= new Common;
$objMail 				= new Mail;
$objValidate 			= new Validate;
$objQayaduser 			= new Qayaduser;
$objQayadProerty 		= new Qayadproperty;
$objQayadapplication	= new Qayadapplication;
$objQayadaccount		= new Qayadaccount;
$objQayadsms			= new Qayadsms;
$objQayaduserProfile	= new Qayaduser;
$objQayaddevice 		= new Qayaddevice;
$objQayadAttendance		= new Qayadattendance;
$objBF 					= new Crypt_Blowfish('CBC');
$objQayadProjectReg 	= new Qayadproperty;
$objSSSjatlan	 		= new SSSjatlan;
$EmployeeMenu 			= '';

$objBF->setKey($cipher_key);


$CurrentIPArray = array(getenv('HTTP_CLIENT_IP'), getenv('HTTP_X_FORWARDED_FOR'), getenv('HTTP_X_FORWARDED'), getenv('HTTP_FORWARDED_FOR'), substr(getenv('HTTP_FORWARDED'),4,20) , getenv('REMOTE_ADDR'));
$StaticOfficeIP = '124.109.56.95';
$BatchCode				= trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)).'-'.date("dmy");

$objQayaduserProfile->setProperty("user_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
$objQayaduserProfile->VwUserDetail();
$LoginUserInfo = $objQayaduserProfile->dbFetchArray(1);
$SalarySecurityCode = trim(DecData($LoginUserInfo["user_security_code"], 1, $objBF));


$objLeaveApprovalGet_Pro = new Qayaduser;
$MakeLeaveDepartmentArray = '';
$objLeaveApprovalGet_Pro->setProperty("leave_request_to", $LoginUserInfo["user_id"]);
$objLeaveApprovalGet_Pro->lstUserRequestFlow();
$CountofLeaveApprovalChecker = $objLeaveApprovalGet_Pro->totalRecords();
while($GetListLEaveOffList = $objLeaveApprovalGet_Pro->dbFetchArray(2)){
	if($GetListLEaveOffList["department_id"] != ""){
	$MakeLeaveDepartmentArray .= $GetListLEaveOffList["department_id"].',';
	}
}

$objOverTimeApprovalChecker = new Qayaduser;
$objOverTimeApprovalChecker->setProperty("GROUPBY", "overtime_request_to");
$objOverTimeApprovalChecker->setProperty("overtime_request_to", $LoginUserInfo["user_id"]);
$objOverTimeApprovalChecker->lstUserRequestFlow();
$CountofOverTimeApprovalChecker = $objOverTimeApprovalChecker->totalRecords();
$EmployeeMenu .= '<hr>';
if($CountofLeaveApprovalChecker > 0){
$AllowLeavePermissionThisUser = $LoginUserInfo["user_type_id"];
$MakeLeaveDepartmentArray_main = '';

$objQayaduser->resetProperty();
$objQayaduser->setProperty("isActive_not", 3);
$objQayaduser->setProperty("department_id_array", substr($MakeLeaveDepartmentArray,0,-1));
$objQayaduser->setProperty("forward_director", 1);
$objQayaduser->setProperty("user_id_not", $LoginUserInfo["user_id"]);
$objQayaduser->lstUserLeaveRequest();
$CountofLeaveRequest = $objQayaduser->totalRecords();
//die();
if($CountofLeaveRequest > 0){ $ShowLeaveRequestCounter = '<span class="notification_menu">'.$CountofLeaveRequest.'</span>'; }
$EmployeeMenu .= '<li> <a href="'.Route::_('show=leaverequests').'"> <i class="material-icons">access_time</i> '.$ShowLeaveRequestCounter.' <p> Leave Request </p> </a></li>';
$EmployeeMenu .= '<li> <a href="'.Route::_('show=approvedleavelist').'"> <i class="material-icons">access_time</i> <p> Approved Leaves </p> </a></li>';

}






if($CountofOverTimeApprovalChecker > 0){
$AllowOverTimePermissionThisUser = $LoginUserInfo["user_type_id"];

$objCountofOverTimeRequest = new Qayaduser;
$objCountofOverTimeRequest->setProperty("request_fwd_dep_to", $LoginUserInfo["user_id"]);
$objCountofOverTimeRequest->setProperty("request_fwd_dep_status", 2);
$objCountofOverTimeRequest->setProperty("isActive", 1);
$objCountofOverTimeRequest->lstPaymentRequestsList();
$CountofOverTimeRequest = $objCountofOverTimeRequest->totalRecords();
if($CountofOverTimeRequest > 0){ $ShowOverTimeRequestCounter = '<span class="notification_menu">'.$CountofOverTimeRequest.'</span>'; }

$EmployeeMenu .= '<li> <a href="'.Route::_('show=payreqproc').'"> <i class="material-icons">access_time</i> '.$ShowOverTimeRequestCounter.' <p> Payment Request </p> </a></li>';
//$EmployeeMenu .= '<li> <a href="'.Route::_('show=overtimelist').'"> <i class="material-icons">access_time</i> <p> Approved Leaves </p> </a></li>';

}

if($LoginUserInfo["user_type_id"] == 3){
$objCountPaymentRequests = new Qayaduser;
$objCountPaymentRequests->setProperty("request_fwd_finance_to", $LoginUserInfo["user_id"]);
$objCountPaymentRequests->setProperty("request_fwd_finance_status_array", '2, 4');
$objCountPaymentRequests->setProperty("isActive", 1);
$objCountPaymentRequests->lstPaymentRequestsList();
$CountFWDPaymentRequests = $objCountPaymentRequests->totalRecords();
if($CountFWDPaymentRequests > 0){ $ShowFWDPaymentCounter = '<span class="notification_menu">'.$CountFWDPaymentRequests.'</span>'; }
}


if($objCheckLogin->user_type != 10){ }

if($CountofLeaveApprovalChecker > 0 or $CountofOverTimeApprovalChecker > 0){
$EmployeeMenu .= '<hr>';
}


$EmployeeMenu .= '<li> <a href="'.Route::_('show=checkinout').'"> <i class="material-icons">access_time</i> <p> Check In/Out </p> </a></li>';
$EmployeeMenu .= '<li> <a href="'.Route::_('show=myattendance').'"> <i class="material-icons">access_time</i> <p> My Attendance </p> </a></li>';
//$EmployeeMenu .= '<li> <a href="'.Route::_('show=overtime').'"> <i class="material-icons">access_time</i> <p> My Overtime</p> </a></li>';
$EmployeeMenu .= '<li> <a href="'.Route::_('show=leaverequest').'"> <i class="material-icons">time_to_leave</i> <p> Leave Request </p> </a></li>';
$EmployeeMenu .= '<li> <a href="'.Route::_('show=availableleaves').'"> <i class="material-icons">all_inbox</i> <p> Available Leaves </p> </a></li>';
$EmployeeMenu .= '<li> <a href="'.Route::_('show=profile').'"> <i class="material-icons">people</i> <p> My Profile </p> </a></li>';
$EmployeeMenu .= '<li> <a href="'.Route::_('show=payreq').'"> <i class="material-icons">receipt</i> <p> Payment Request </p> </a></li>';
if($objCheckLogin->sd_panel == 'false' && $objCheckLogin->sd_code == ''){
$EmployeeMenu .= '<li style="background-color:#EFEFEF"> <a href="'.Route::_('show=securitycode').'"><i class="material-icons">attach_money</i> <p> Salary Detail</p> </a></li>';	
} else {
$EmployeeMenu .= '<li style="background-color:#EFEFEF"> <a href="'.Route::_('show=salarydetail').'"><i class="material-icons">attach_money</i> <p> Salary Detail</p> </a></li>';
$EmployeeMenu .= '<li style="border-top:solid 1px #fff; background-color:#EFEFEF"> <a href="'.Route::_('show=salaryhistory').'"><i class="material-icons">attach_money</i> <p> Salary History</p> </a></li>';
}

if($LoginUserInfo["teamlead_status"] == 2 && $LoginUserInfo["user_type_id"] == 10){
$objCountofOverTimeRequest = new Qayadattendance;
$objCountofOverTimeRequest->setProperty("teamlead_status", 1);
$objCountofOverTimeRequest->setProperty("department_id", $LoginUserInfo["department_id"]);
$objCountofOverTimeRequest->lstOvertimeRequest();
$CountofOverTimeRequest = $objCountofOverTimeRequest->totalRecords();
}
if($LoginUserInfo["user_type_id"] == 8){



}
if($LoginUserInfo["user_type_id"] == 1){
$objCountofLeaveRequest = new Qayaduser;
$objCountofLeaveRequest->setProperty("forward_director", 1);
$objCountofLeaveRequest->lstUserLeaveRequest();
//$CountofLeaveRequest = $objCountofLeaveRequest->totalRecords();
}

if(trim(DecData($objQayadProjectReg->reg_pro, 1, $objBF)) !=""){
	$CurrentPorjectId = trim(DecData($objQayadProjectReg->reg_pro, 1, $objBF));	
}
if(trim(DecData($_GET["reg"], 1, $objBF)) == "project" && trim(DecData($_GET["pi"], 1, $objBF)) != ""){
$objQayadProjectReg->setProperty("reg_pro", $objBF->encrypt(trim(DecData($_GET["pi"], 1, $objBF)), ENCRYPTION_KEY));
$objQayadProjectReg->setRegisterProject();
if(trim(DecData($_GET["rt"], 1, $objBF)) != "NUL"){
	$link = Route::_('show='.trim(DecData($_GET["rt"], 1, $objBF)));
} else {
	$link = Route::_('');
}	
	redirect($link);
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
if($_GET["show"] == ''){
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'users'){
PageCheckerOpt($_GET["show"],'users',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
//} elseif($_GET["show"] == 'newappreg'){
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'newappreg'){
PageCheckerOpt($_GET["show"],'newappreg',array(1,2,4),$objCheckLogin);
include_once(ACTION_PATH.'newapplication.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'invoice'){
PageCheckerOpt($_GET["show"],'invoice',array(1,2,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'unitlockedform'){
PageCheckerOpt($_GET["show"],'unitlockedform',array(1,2,4),$objCheckLogin);
include_once(ACTION_PATH.'propertylockedform.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'transrecpay'){
PageCheckerOpt($_GET["show"],'transrecpay',array(1,3,9,18),$objCheckLogin);
//////////////////////////////////////////////////////////////////////////
if(trim($_POST["aplic_mode"]) == 1){
include_once(ACTION_PATH.'transrecpay.php');
} elseif(trim($_POST["aplic_mode"]) == 2){
include_once(ACTION_PATH.'transrecpay_mode_2.php');
} elseif(trim($_POST["aplic_mode"]) == 3){
include_once(ACTION_PATH.'transrecpay_mode_3.php');
} elseif(trim($_POST["aplic_mode"]) == 6){
include_once(ACTION_PATH.'transrecpay_mode_4.php');
} elseif(trim($_POST["aplic_mode"]) == 7){
include_once(ACTION_PATH.'transrecpay_mode_24.php');
} elseif(trim($_POST["aplic_mode"]) == 8){
include_once(ACTION_PATH.'transrecpay_mode_4.php');
} elseif(trim($_POST["aplic_mode"]) == 9){
include_once(ACTION_PATH.'transrecpay_mode_5.php');
} elseif(trim($_POST["aplic_mode"]) == 10){
include_once(ACTION_PATH.'transrecpay_mode_6.php');
} elseif(trim($_POST["aplic_mode"]) == 12){
include_once(ACTION_PATH.'transrecpay_mode_9.php');
} elseif(trim($_POST["aplic_mode"]) == 13){
include_once(ACTION_PATH.'transrecpay_mode_13.php');
} elseif(trim($_POST["aplic_mode"]) == 14){
include_once(ACTION_PATH.'transrecpay_mode_8.php');
} elseif(trim($_POST["aplic_mode"]) == 15){
include_once(ACTION_PATH.'transrecpay_mode_10.php');
} elseif(trim($_POST["aplic_mode"]) == 16){ // For Diesel, Mobil Oil, Tyre
include_once(ACTION_PATH.'transrecpay_mode_16.php');
} elseif(trim($_POST["aplic_mode"]) == 17){ 
include_once(ACTION_PATH.'transrecpay_mode_17.php');
} elseif(trim($_POST["aplic_mode"]) == 18){ 
include_once(ACTION_PATH.'transrecpay_mode_18.php');
} elseif(trim($_POST["aplic_mode"]) == 20){ 
include_once(ACTION_PATH.'transrecpay_mode_20.php');
} elseif(trim($_POST["aplic_mode"]) == 21){ 
include_once(ACTION_PATH.'transrecpay_mode_21.php');
} elseif(trim($_POST["aplic_mode"]) == 22){ 
include_once(ACTION_PATH.'transrecpay_mode_22.php');
} elseif(trim($_POST["aplic_mode"]) == 23){ 
include_once(ACTION_PATH.'transrecpay_mode_23.php');
} elseif(trim($_POST["aplic_mode"]) == 25){ 
include_once(ACTION_PATH.'transrecpay_mode_25.php');
} elseif(trim($_POST["aplic_mode"]) == 26){ 
	include_once(ACTION_PATH.'transrecpay_mode_26.php');
} elseif(trim($_POST["aplic_mode"]) == 27){ 
	include_once(ACTION_PATH.'transrecpay_mode_27.php');
} elseif(trim($_POST["aplic_mode"]) == 28){ 
	include_once(ACTION_PATH.'transrecpay_mode_28.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'print'){
include_once(ACTION_PATH.'ledgerfilter.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'ledgerheaddetail'){
PageCheckerOpt($_GET["show"],'ledgerheaddetail',array(1,3,9,18),$objCheckLogin);
include_once(ACTION_PATH.'ledgerfilter.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'smstemplateform'){
PageCheckerOpt($_GET["show"],'smstemplateform',array(1,6),$objCheckLogin);
include_once(ACTION_PATH.'smstemplate.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'smstemplate'){
PageCheckerOpt($_GET["show"],'smstemplate',array(1,6),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'userform'){
PageCheckerOpt($_GET["show"],'userform',array(1),$objCheckLogin);
include_once(ACTION_PATH.'userregistration.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'mysale'){
PageCheckerOpt($_GET["show"],'mysale',array(1,4),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'fdpaplic'){
PageCheckerOpt($_GET["show"],'fdpaplic',array(1,2,4),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'unitslocked'){
PageCheckerOpt($_GET["show"],'unitslocked',array(1,2,3,4),$objCheckLogin);
include_once(ACTION_PATH.'unitslocked.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'transactionmode'){
PageCheckerOpt($_GET["show"],'transactionmode',array(1,3,9,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'newappregjoint'){
PageCheckerOpt($_GET["show"],'newappregjoint',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'newapplication.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'transaction'){
PageCheckerOpt($_GET["show"],'transaction',array(1,3,9,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'properties'){
PageCheckerOpt($_GET["show"],'properties',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'properties.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'pppropertyform'){
PageCheckerOpt($_GET["show"],'pppropertyform',array(1,3),$objCheckLogin);
if($_GET['i']==''){ redirect(Route::_('show=properties')); } 
include_once(ACTION_PATH.'ppproperty.php');
$objQayadProerty->resetProperty();
$objQayadProerty->setProperty("project_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadProerty->lstProjects();
$GetProjectDetail = $objQayadProerty->dbFetchArray(1);
/********************************************************************************************/
$objQayadProerty->resetProperty();
$objQayadProerty->setProperty("propety_floor_id", trim(DecData($_GET["fi"], 1, $objBF)));
$objQayadProerty->lstPropertyFloorPlan();
$GetFloorDetail = $objQayadProerty->dbFetchArray(1);
/********************************************************************************************/
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'spppropertyform'){
PageCheckerOpt($_GET["show"],'spppropertyform',array(1),$objCheckLogin);
if($_GET['i']==''){ redirect(Route::_('show=properties')); } 
include_once(ACTION_PATH.'sppproperty.php');
$objQayadProerty->resetProperty();
$objQayadProerty->setProperty("property_type_id", $_GET["i"]);
$objQayadProerty->lstPropertyType();
$GetPropertyInfo = $objQayadProerty->dbFetchArray(1);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'proevent'){
PageCheckerOpt($_GET["show"],'proevent',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'payaplic'){
PageCheckerOpt($_GET["show"],'payaplic',array(1,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'ppgallery'){
if($_GET['i']==''){ redirect(Route::_('show=properties')); } 
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'ppproperties'){
PageCheckerOpt($_GET["show"],'ppproperties',array(1,3),$objCheckLogin);
if($_GET['i']==''){ redirect(Route::_('show=properties')); } 
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'printdoc'){
PageCheckerOpt($_GET["show"],'printdoc',array(1,2,7),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'caplic'){
PageCheckerOpt($_GET["show"],'caplic',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'ledgerhead'){
PageCheckerOpt($_GET["show"],'ledgerhead',array(1,3,9,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'propertytype'){
PageCheckerOpt($_GET["show"],'propertytype',array(1,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstaplic'){
PageCheckerOpt($_GET["show"],'lstaplic',array(1,2,7),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'headitem'){
PageCheckerOpt($_GET["show"],'headitem',array(1,3,9,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'achead'){
PageCheckerOpt($_GET["show"],'achead',array(1,3,9,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'npaplic'){
PageCheckerOpt($_GET["show"],'npaplic',array(1,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'propertyform'){
PageCheckerOpt($_GET["show"],'propertyform',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'propertyregister.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'headitemform'){
PageCheckerOpt($_GET["show"],'headitemform',array(1,3,9,18),$objCheckLogin);
include_once(ACTION_PATH.'headitem.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'acheadform'){
PageCheckerOpt($_GET["show"],'acheadform',array(1,3,9,18),$objCheckLogin);
include_once(ACTION_PATH.'head.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'headgroupform'){
PageCheckerOpt($_GET["show"],'headgroupform',array(1,3,9,18),$objCheckLogin);
include_once(ACTION_PATH.'headgroup.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'headgroup'){
PageCheckerOpt($_GET["show"],'headgroup',array(1,3,9,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'propertylog'){
PageCheckerOpt($_GET["show"],'propertylog',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'propertytypeform'){
PageCheckerOpt($_GET["show"],'propertytypeform',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'propertytype.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'floorplanform'){
PageCheckerOpt($_GET["show"],'floorplanform',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'floorplan.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'floorplan'){
PageCheckerOpt($_GET["show"],'floorplan',array(1,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'smslog'){
PageCheckerOpt($_GET["show"],'smslog',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'proeventform'){
PageCheckerOpt($_GET["show"],'proeventform',array(1),$objCheckLogin);
include_once(ACTION_PATH.'proevent.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'changepass'){
include_once(ACTION_PATH.'changepass.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'changesecuritycode'){
include_once(ACTION_PATH.'changesecuritycode.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'logout'){
include_once(ACTION_PATH . 'logout.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'paymentinfoform'){
PageCheckerOpt($_GET["show"],'paymentinfoform',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'paymentinfo.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'paymentinfo'){
PageCheckerOpt($_GET["show"],'paymentinfo',array(1,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'paymentrequest'){
PageCheckerOpt($_GET["show"],'paymentrequest',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'paymentrequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'accountlog'){
PageCheckerOpt($_GET["show"],'accountlog',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'userlog'){
PageCheckerOpt($_GET["show"],'userlog',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'apliclog'){
PageCheckerOpt($_GET["show"],'apliclog',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'smscontactlist'){
PageCheckerOpt($_GET["show"],'smscontactlist',array(1,4,6,7),$objCheckLogin);
include_once(ACTION_PATH.'smscontactcomment.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'smscontactlistform'){
PageCheckerOpt($_GET["show"],'smscontactlistform',array(1,4,7),$objCheckLogin);
include_once(ACTION_PATH.'smscontactlist.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'agent'){
PageCheckerOpt($_GET["show"],'agent',array(1,7),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'agentform'){
PageCheckerOpt($_GET["show"],'agentform',array(1,7),$objCheckLogin);
include_once(ACTION_PATH.'agent.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'migration'){
PageCheckerOpt($_GET["show"],'migration',array(1,7),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'migrationform'){
PageCheckerOpt($_GET["show"],'migrationform',array(1,7),$objCheckLogin);
include_once(ACTION_PATH.'migration.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'smsmarketing'){
PageCheckerOpt($_GET["show"],'smsmarketing',array(1,7),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'smsmarketingform'){
PageCheckerOpt($_GET["show"],'smsmarketingform',array(1,7),$objCheckLogin);
include_once(ACTION_PATH.'smsmarketing.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'companies'){
PageCheckerOpt($_GET["show"],'companies',array(1),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'companyform'){
PageCheckerOpt($_GET["show"],'companyform',array(1),$objCheckLogin);
include_once(ACTION_PATH.'company.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employees'){
PageCheckerOpt($_GET["show"],'employees',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeopt'){
PageCheckerOpt($_GET["show"],'employeopt',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeform'){
PageCheckerOpt($_GET["show"],'employeform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employees.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeojobdetail'){
PageCheckerOpt($_GET["show"],'employeojobdetail',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employeejobdetail.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeedu'){
PageCheckerOpt($_GET["show"],'employeedu',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeeduform'){
PageCheckerOpt($_GET["show"],'employeeduform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employeedu.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employmenthistory'){
PageCheckerOpt($_GET["show"],'employmenthistory',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employmenthistoyform'){
PageCheckerOpt($_GET["show"],'employmenthistoyform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employmenthistoy.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employereference'){
PageCheckerOpt($_GET["show"],'employereference',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employereferenceform'){
PageCheckerOpt($_GET["show"],'employereferenceform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employereference.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeskills'){
PageCheckerOpt($_GET["show"],'employeskills',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeskillform'){
PageCheckerOpt($_GET["show"],'employeskillform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employeskill.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employemrgncy'){
PageCheckerOpt($_GET["show"],'employemrgncy',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employemrgncyform'){
PageCheckerOpt($_GET["show"],'employemrgncyform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employemrgncy.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employbank'){
PageCheckerOpt($_GET["show"],'employbank',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employbankform'){
PageCheckerOpt($_GET["show"],'employbankform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employbank.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeshift'){
PageCheckerOpt($_GET["show"],'employeshift',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employeshift.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'device'){
PageCheckerOpt($_GET["show"],'device',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'deviceform'){
PageCheckerOpt($_GET["show"],'deviceform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'device.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'department'){
PageCheckerOpt($_GET["show"],'department',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'modatti'){
PageCheckerOpt($_GET["show"],'modatti',array(1,10),$objCheckLogin);
include_once(ACTION_PATH.'modatti.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'departmentform'){
PageCheckerOpt($_GET["show"],'departmentform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'department.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'jobtitle'){
PageCheckerOpt($_GET["show"],'jobtitle',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'jobtitleform'){
PageCheckerOpt($_GET["show"],'jobtitleform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'jobtitle.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'holidays'){
PageCheckerOpt($_GET["show"],'holidays',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'holidaysform'){
PageCheckerOpt($_GET["show"],'holidaysform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'holidays.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leavetype'){
PageCheckerOpt($_GET["show"],'leavetype',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leavetypeform'){
PageCheckerOpt($_GET["show"],'leavetypeform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'leavetype.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'shift'){
PageCheckerOpt($_GET["show"],'shift',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'shiftform'){
PageCheckerOpt($_GET["show"],'shiftform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'shift.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'yearlyleave'){
PageCheckerOpt($_GET["show"],'yearlyleave',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'yearlyleaveform'){
PageCheckerOpt($_GET["show"],'yearlyleaveform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'yearlyleave.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'demoatt'){
//PageCheckerOpt($_GET["show"],'yearlyleaveform',array(1,9),$objCheckLogin);
include_once(ACTION_PATH.'sig_att_view.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leads'){
PageCheckerOpt($_GET["show"],'leads',array(1,7,12),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leadform'){
PageCheckerOpt($_GET["show"],'leadform',array(1,7,12),$objCheckLogin);
include_once(ACTION_PATH.'leads.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'newleads'){
PageCheckerOpt($_GET["show"],'newleads',array(1,7,12,13),$objCheckLogin);
include_once(ACTION_PATH.'newleads.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'assignleads'){
PageCheckerOpt($_GET["show"],'assignleads',array(1,7,12,13),$objCheckLogin);
include_once(ACTION_PATH.'assignleads.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'assignto'){
PageCheckerOpt($_GET["show"],'assignto',array(1,7,12,13),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'reassignleads'){
PageCheckerOpt($_GET["show"],'reassignleads',array(1,7,12,13),$objCheckLogin);
include_once(ACTION_PATH.'reassignleads.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'teamlead'){
PageCheckerOpt($_GET["show"],'teamlead',array(1,7,13),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'tloption'){
PageCheckerOpt($_GET["show"],'tloption',array(1,7,13),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'agoption'){
PageCheckerOpt($_GET["show"],'agoption',array(1,7,13),$objCheckLogin);
include_once(ACTION_PATH.'agoption.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'myagents'){
PageCheckerOpt($_GET["show"],'myagents',array(1,7,13),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'newagents'){
PageCheckerOpt($_GET["show"],'newagents',array(1,7,13),$objCheckLogin);
include_once(ACTION_PATH.'newagents.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'setteamlead'){
PageCheckerOpt($_GET["show"],'setteamlead',array(1,7,13),$objCheckLogin);
include_once(ACTION_PATH.'setteamlead.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'newleadsreceived'){
PageCheckerOpt($_GET["show"],'newleadsreceived',array(1,4),$objCheckLogin);
if($LoginUserInfo["teamlead_status"] != 2){
	redirect(Route::_('show=logout'));
}
include_once(ACTION_PATH.'newleadsreceived.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'assignedleads'){
PageCheckerOpt($_GET["show"],'assignedleads',array(1,4,7,12,13),$objCheckLogin);
if($LoginUserInfo["user_type_id"] == 7){
	//redirect(Route::_('show=checkassignedleads'));
}
if($LoginUserInfo["teamlead_status"] != 2){
//	redirect(Route::_('show=logout'));
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'newleadreassign'){
PageCheckerOpt($_GET["show"],'newleadreassign',array(1,4,7,12,13),$objCheckLogin);
if($LoginUserInfo["teamlead_status"] != 2 && $LoginUserInfo["user_type_id"] != 7){
//	redirect(Route::_('show=logout'));
}
include_once(ACTION_PATH.'newleadreassign.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'myleads'){
PageCheckerOpt($_GET["show"],'myleads',array(1,4),$objCheckLogin);
include_once(ACTION_PATH.'myleads.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'rpempsalary'){
PageCheckerOpt($_GET["show"],'rpempsalary',array(1,9),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'restaction'){
PageCheckerOpt($_GET["show"],'restaction',array(1,9),$objCheckLogin);
include_once(ACTION_PATH.'restaction.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'generatedsalary'){
PageCheckerOpt($_GET["show"],'generatedsalary',array(1,9),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employesalary'){
PageCheckerOpt($_GET["show"],'employesalary',array(1,9),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employesalaryform'){
PageCheckerOpt($_GET["show"],'employesalaryform',array(1,9),$objCheckLogin);
include_once(ACTION_PATH.'employesalary.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employebonus'){
PageCheckerOpt($_GET["show"],'employebonus',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employebonusform'){
PageCheckerOpt($_GET["show"],'employebonusform',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'employebonus.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'attendance'){
PageCheckerOpt($_GET["show"],'attendance',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'monthlyattendancechecker.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'attendancemodification'){
PageCheckerOpt($_GET["show"],'attendancemodification',array(1,9,16),$objCheckLogin);
include_once(ACTION_PATH.'attendancemodification.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'myattendance'){
PageCheckerOpt($_GET["show"],'myattendance',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'otrequestform'){
PageCheckerOpt($_GET["show"],'otrequestform',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'otrequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'overtime'){
PageCheckerOpt($_GET["show"],'overtime',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leaverequest'){
PageCheckerOpt($_GET["show"],'leaverequest',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'leaverequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leaverequestform'){
PageCheckerOpt($_GET["show"],'leaverequestform',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'leaverequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'availableleaves'){
PageCheckerOpt($_GET["show"],'availableleaves',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'checkassignedleads'){
PageCheckerOpt($_GET["show"],'checkassignedleads',array(1,7,12,13),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'tlassignedleads'){
PageCheckerOpt($_GET["show"],'tlassignedleads',array(1,7,12,13),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'webbaselead'){
PageCheckerOpt($_GET["show"],'webbaselead',array(1,12),$objCheckLogin);
include_once(ACTION_PATH.'webbaselead.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'profile'){
PageCheckerOpt($_GET["show"],'profile',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'profileform'){
PageCheckerOpt($_GET["show"],'profileform',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'profile.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'mysalary'){
PageCheckerOpt($_GET["show"],'mysalary',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'advancesalary'){
PageCheckerOpt($_GET["show"],'advancesalary',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'advsalary.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'advsalaryform'){
PageCheckerOpt($_GET["show"],'advsalaryform',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'advsalary.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'overtimerequest'){
PageCheckerOpt($_GET["show"],'overtimerequest',array(1,10,29,30,$AllowOverTimePermissionThisUser),$objCheckLogin);
if($LoginUserInfo["teamlead_status"] != 2){
	if($LoginUserInfo["user_type_id"] != 8){
	//redirect(Route::_('show=logout'));
	}
}
include_once(ACTION_PATH.'overtimerequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'overtimelist'){
PageCheckerOpt($_GET["show"],'overtimelist',array(1,29,30,$AllowOverTimePermissionThisUser),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leaverequests'){
PageCheckerOpt($_GET["show"],'leaverequests',array(1,29,30,$AllowLeavePermissionThisUser),$objCheckLogin);
include_once(ACTION_PATH.'leaverequests.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'approvedleavelist'){
PageCheckerOpt($_GET["show"],'approvedleavelist',array(1,29,30,$AllowLeavePermissionThisUser),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'departmentpage'){
PageCheckerOpt($_GET["show"],'departmentpage',array(1,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'employeeleave'){
PageCheckerOpt($_GET["show"],'employeeleave',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'modifyemployeeleave'){
PageCheckerOpt($_GET["show"],'modifyemployeeleave',array(1,9,16,8),$objCheckLogin);
include_once(ACTION_PATH.'modifyemployeeleave.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'eattend'){
PageCheckerOpt($_GET["show"],'eattend',array(1,9,16,8),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'noactionleads'){
PageCheckerOpt($_GET["show"],'noactionleads',array(1,7,15),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'empndleads'){
PageCheckerOpt($_GET["show"],'empndleads',array(1,7,15),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'empdetail'){
PageCheckerOpt($_GET["show"],'empdetail',array(1,7,15),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'reqleads'){
PageCheckerOpt($_GET["show"],'reqleads',array(1,4,5,7,12,13,14,15),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'noaction12'){
PageCheckerOpt($_GET["show"],'noaction12',array(1,7,15),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'leadopt'){
PageCheckerOpt($_GET["show"],'leadopt',array(1,12),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'manualleadform'){
PageCheckerOpt($_GET["show"],'manualleadform',array(1,12),$objCheckLogin);
include_once(ACTION_PATH.'manuallead.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'outtimemissing'){
PageCheckerOpt($_GET["show"],'outtimemissing',array(1,9,16),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'addattendance'){
PageCheckerOpt($_GET["show"],'addattendance',array(1,9,16),$objCheckLogin);
include_once(ACTION_PATH.'addattendance.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'inactiveemployee'){
PageCheckerOpt($_GET["show"],'inactiveemployee',array(1,9,16),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'salarydetail'){
if($objCheckLogin->sd_panel == 'false' && $objCheckLogin->sd_code == ''){
redirect(Route::_('show=securitycode'));
} else {
PageCheckerOpt($_GET["show"],'salarydetail',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'salarydetail.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'salaryhistory'){
if($objCheckLogin->sd_panel == 'false' && $objCheckLogin->sd_code == ''){
redirect(Route::_('show=securitycode'));
} else {
PageCheckerOpt($_GET["show"],'salaryhistory',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
//include_once(ACTION_PATH.'salarydetail.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'securitycode'){
PageCheckerOpt($_GET["show"],'securitycode',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'securitycode.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'salaryreport'){
PageCheckerOpt($_GET["show"],'salaryreport',array(1,9),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'genreport'){
PageCheckerOpt($_GET["show"],'genreport',array(1,9),$objCheckLogin);
include_once(ACTION_PATH.'genreport.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'monthlysalaryhr'){
PageCheckerOpt($_GET["show"],'monthlysalaryhr',array(1,9),$objCheckLogin);
include_once(ACTION_PATH.'monthlysalaryhr.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'manualatt'){
PageCheckerOpt($_GET["show"],'manualatt',array(1,9,16),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'repemplist'){
PageCheckerOpt($_GET["show"],'repemplist',array(1,9,16),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'repemplistgen'){
PageCheckerOpt($_GET["show"],'repemplistgen',array(1,9,16),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'deprequestflow'){
PageCheckerOpt($_GET["show"],'deprequestflow',array(1,9,16),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'deprequestflowform'){
PageCheckerOpt($_GET["show"],'deprequestflowform',array(1,9,16),$objCheckLogin);
include_once(ACTION_PATH.'deprequestflow.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'emprequestflow'){
PageCheckerOpt($_GET["show"],'emprequestflow',array(1,9,16),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'emprequestflowform'){
PageCheckerOpt($_GET["show"],'emprequestflowform',array(1,9,16),$objCheckLogin);
include_once(ACTION_PATH.'emprequestflow.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'projects'){
PageCheckerOpt($_GET["show"],'projects',array(1,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'projectform'){
PageCheckerOpt($_GET["show"],'projectform',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'projects.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'projectgallery'){
PageCheckerOpt($_GET["show"],'projectgallery',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'projectgallery.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'newlstaplic'){
PageCheckerOpt($_GET["show"],'newlstaplic',array(1,28),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'updoc'){
PageCheckerOpt($_GET["show"],'updoc',array(1,28),$objCheckLogin);
include_once(ACTION_PATH.'uploaddocument.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'aplicdoc'){
PageCheckerOpt($_GET["show"],'aplicdoc',array(1,28),$objCheckLogin);
include_once(ACTION_PATH.'aplicdocument.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'ddfdpaplic'){
PageCheckerOpt($_GET["show"],'ddfdpaplic',array(1,28),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstaplicdoc'){
PageCheckerOpt($_GET["show"],'lstaplicdoc',array(1,28),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'unitssold'){
PageCheckerOpt($_GET["show"],'unitssold',array(1,2,3,28),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'ddpaplic'){
PageCheckerOpt($_GET["show"],'ddpaplic',array(1,2,4,28),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstblock'){
PageCheckerOpt($_GET["show"],'lstblock',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstblockform'){
PageCheckerOpt($_GET["show"],'lstblockform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'lstblock.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstbuilding'){
PageCheckerOpt($_GET["show"],'lstbuilding',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstbuildingform'){
PageCheckerOpt($_GET["show"],'lstbuildingform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'lstbuilding.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstfloor'){
PageCheckerOpt($_GET["show"],'lstfloor',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstfloorform'){
PageCheckerOpt($_GET["show"],'lstfloorform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'lstfloor.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstproperty'){
PageCheckerOpt($_GET["show"],'lstproperty',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstpropertyform'){
PageCheckerOpt($_GET["show"],'lstpropertyform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'lstproperty.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lsttenants'){
PageCheckerOpt($_GET["show"],'lsttenants',array(1,2,3),$objCheckLogin);
include_once(ACTION_PATH.'lsttenant.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lsttenantform'){
PageCheckerOpt($_GET["show"],'lsttenantform',array(1,2,3),$objCheckLogin);
include_once(ACTION_PATH.'lsttenant.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'assigntentproty'){
PageCheckerOpt($_GET["show"],'assigntentproty',array(1,2,3),$objCheckLogin);
include_once(ACTION_PATH.'assigntentproty.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstassigntoemp'){
PageCheckerOpt($_GET["show"],'lstassigntoemp',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'assigntoemp'){
PageCheckerOpt($_GET["show"],'assigntoemp',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'assigntoemp.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'reassignblock'){
PageCheckerOpt($_GET["show"],'reassignblock',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'reassignblock.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstoccupiedpro'){
PageCheckerOpt($_GET["show"],'lstoccupiedpro',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstvacantpro'){
PageCheckerOpt($_GET["show"],'lstvacantpro',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstpendingchrg'){
PageCheckerOpt($_GET["show"],'lstpendingchrg',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'lstpendingchrg.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstpaidchrg'){
PageCheckerOpt($_GET["show"],'lstpaidchrg',array(1,2,3,4,5,6),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'myinvt'){
PageCheckerOpt($_GET["show"],'myinvt',array(1,4),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'pendingcoll'){
PageCheckerOpt($_GET["show"],'pendingcoll',array(1,4),$objCheckLogin);
include_once(ACTION_PATH.'pendingcoll.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'getcollection'){
PageCheckerOpt($_GET["show"],'getcollection',array(1,2,4),$objCheckLogin);
include_once(ACTION_PATH.'getcollection.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'pendcollbatch'){
PageCheckerOpt($_GET["show"],'pendcollbatch',array(1,2,4),$objCheckLogin);
include_once(ACTION_PATH.'pendcollbatch.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'collbatch'){
PageCheckerOpt($_GET["show"],'collbatch',array(1,2,4),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'pendingfrm'){
PageCheckerOpt($_GET["show"],'pendingfrm',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'pendingamount.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'getbillrequest'){
PageCheckerOpt($_GET["show"],'getbillrequest',array(1,2,4),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'getbillreqfrm'){
PageCheckerOpt($_GET["show"],'getbillreqfrm',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'getbillreq.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'printbill'){
PageCheckerOpt($_GET["show"],'printbill',array(1,2,4),$objCheckLogin);
include_once(ACTION_PATH.'printbill.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'billmodification'){
PageCheckerOpt($_GET["show"],'billmodification',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'extracharges'){
PageCheckerOpt($_GET["show"],'extracharges',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'extcform'){
PageCheckerOpt($_GET["show"],'extcform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'extcform.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstinstallment'){
PageCheckerOpt($_GET["show"],'lstinstallment',array(1,2,3,4),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'installmentform'){
PageCheckerOpt($_GET["show"],'installmentform',array(1,2,3),$objCheckLogin);
include_once(ACTION_PATH.'installment.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lsttenantpendings'){
PageCheckerOpt($_GET["show"],'lsttenantpendings',array(1,2,3,4),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'tenantpendingform'){
PageCheckerOpt($_GET["show"],'tenantpendingform',array(1,2,3),$objCheckLogin);
include_once(ACTION_PATH.'tenantpending.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstpendingrequest'){
PageCheckerOpt($_GET["show"],'lstpendingrequest',array(1,2,3),$objCheckLogin);
include_once(ACTION_PATH.'pendingrequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
//

} elseif($_GET["show"] == 'report'){
PageCheckerOpt($_GET["show"],'report',array(1,2,3,4),$objCheckLogin);
include_once(ACTION_PATH.'report.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'payreq'){
PageCheckerOpt($_GET["show"],'payreq',array(1,2,3,4,5,6,7,8,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
include_once(ACTION_PATH.'payreq_del.php');	
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'payreqform'){
PageCheckerOpt($_GET["show"],'payreqform',array(1,2,3,4,5,6,7,8,29,30,9,10,11,12,13,14,16,18),$objCheckLogin);
if(trim($_POST["aplic_mode"]) == 1){
include_once(ACTION_PATH.'payreq_1.php');
} elseif(trim($_POST["aplic_mode"]) == 2){
include_once(ACTION_PATH.'payreq_2.php');
} elseif(trim($_POST["aplic_mode"]) == 3){
} elseif(trim($_POST["aplic_mode"]) == 4){
include_once(ACTION_PATH.'payreq_4.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'payreqproc'){
PageCheckerOpt($_GET["show"],'payreqproc',array(1,29,30,$AllowOverTimePermissionThisUser),$objCheckLogin);
include_once(ACTION_PATH.'payreqproc.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'fwdpayreqproc'){
PageCheckerOpt($_GET["show"],'fwdpayreqproc',array(1,3),$objCheckLogin);
include_once(ACTION_PATH.'fwdpayreqproc.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'complain'){
PageCheckerOpt($_GET["show"],'complain',array(1,2,3,4,5,6,7,8,9,10),$objCheckLogin);
include_once(ACTION_PATH.'complaincomment.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'complainform'){
PageCheckerOpt($_GET["show"],'complainform',array(1,2,3,4,6,7,8,9,10),$objCheckLogin);
include_once(ACTION_PATH.'complain.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'assigncomplain'){
PageCheckerOpt($_GET["show"],'assigncomplain',array(1,2,3,4,5,6,7,8,9,10),$objCheckLogin);
include_once(ACTION_PATH.'complain.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'complncat'){
PageCheckerOpt($_GET["show"],'complncat',array(1,2,3,4,6),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'complcatform'){
PageCheckerOpt($_GET["show"],'complcatform',array(1,2,3,4,6,7,8,9,10),$objCheckLogin);
include_once(ACTION_PATH.'complncat.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'rescomplain'){
PageCheckerOpt($_GET["show"],'rescomplain',array(1,2,3,4,5,6,7,8,9,10),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'modifyrequest'){
PageCheckerOpt($_GET["show"],'modifyrequest',array(1,2,3,4,5),$objCheckLogin);
include_once(ACTION_PATH.'modifyrequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'modifyrequestform'){
PageCheckerOpt($_GET["show"],'modifyrequestform',array(1,2,3,4,5),$objCheckLogin);
include_once(ACTION_PATH.'modifyrequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'pendassignpro'){
PageCheckerOpt($_GET["show"],'pendassignpro',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'pendassignpro.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'help'){
PageCheckerOpt($_GET["show"],'help',array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18),$objCheckLogin);












































/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'location'){
PageCheckerOpt($_GET["show"],'location',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'locationform'){
PageCheckerOpt($_GET["show"],'locationform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'location.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'customertype'){
PageCheckerOpt($_GET["show"],'customertype',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'customertypeform'){
PageCheckerOpt($_GET["show"],'customertypeform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'customertype.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'customers'){
PageCheckerOpt($_GET["show"],'customers',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'customerform'){
PageCheckerOpt($_GET["show"],'customerform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'customer.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'suppliers'){
PageCheckerOpt($_GET["show"],'suppliers',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'suppliersform'){
PageCheckerOpt($_GET["show"],'suppliersform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'suppliers.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'products'){
PageCheckerOpt($_GET["show"],'products',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'productsform'){
PageCheckerOpt($_GET["show"],'productsform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'products.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'productprice'){
PageCheckerOpt($_GET["show"],'productprice',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'productpriceform'){
PageCheckerOpt($_GET["show"],'productpriceform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'productprice.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vehicletype'){
PageCheckerOpt($_GET["show"],'vehicletype',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vehicletypeform'){
PageCheckerOpt($_GET["show"],'vehicletypeform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'vehicletype.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vehicle'){
PageCheckerOpt($_GET["show"],'vehicle',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vehicleform'){
PageCheckerOpt($_GET["show"],'vehicleform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'vehicle.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vehicleassign'){
PageCheckerOpt($_GET["show"],'vehicleassign',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'vehicleassign.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'orderrequest'){
PageCheckerOpt($_GET["show"],'orderrequest',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'orderrequestform'){
PageCheckerOpt($_GET["show"],'orderrequestform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'orderrequest.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vendororder'){
PageCheckerOpt($_GET["show"],'vendororder',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vendororderform'){
PageCheckerOpt($_GET["show"],'vendororderform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'vendororder.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'orderreqprocess'){
PageCheckerOpt($_GET["show"],'orderreqprocess',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'orderprocess'){
PageCheckerOpt($_GET["show"],'orderprocess',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'orderprocessform'){
PageCheckerOpt($_GET["show"],'orderprocessform',array(1,2),$objCheckLogin);
if(isset($_GET['oi']) && !empty($_GET['oi'])){
include_once(ACTION_PATH.'orderprocess_second_stage.php');
} else {
include_once(ACTION_PATH.'orderprocess.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'uporders'){
PageCheckerOpt($_GET["show"],'uporders',array(1,2),$objCheckLogin);
if(isset($_GET['i']) && !empty($_GET['i'])){
include_once(ACTION_PATH.'uporders.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'uporderswap'){
PageCheckerOpt($_GET["show"],'uporderswap',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'uporderswap.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'upodeliverd'){
PageCheckerOpt($_GET["show"],'upodeliverd',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'upodeliverd.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'dorders'){
PageCheckerOpt($_GET["show"],'dorders',array(1,2),$objCheckLogin);
if(isset($_GET['i']) && !empty($_GET['i'])){
include_once(ACTION_PATH.'dorders.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'cvehicle'){
PageCheckerOpt($_GET["show"],'cvehicle',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'cvehicle.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'cancelorders'){
PageCheckerOpt($_GET["show"],'cancelorders',array(1,2),$objCheckLogin);
if(isset($_GET['i']) && !empty($_GET['i'])){
include_once(ACTION_PATH.'cancelorders.php');
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'unloader'){
PageCheckerOpt($_GET["show"],'unloader',array(1,2),$objCheckLogin);
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("customer_type", 3);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->lstCustomers();
$unloadercounter = $objSSSjatlan->totalRecords();
if($unloadercounter == 0){
$link = Route::_('show=unloaderform');
redirect($link);
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'unloaderform'){
PageCheckerOpt($_GET["show"],'unloaderform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'unloader.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstdiesel'){
PageCheckerOpt($_GET["show"],'lstdiesel',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'dieselform'){
PageCheckerOpt($_GET["show"],'dieselform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'diesel.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lstmobiloil'){
PageCheckerOpt($_GET["show"],'lstmobiloil',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'mobiloilform'){
PageCheckerOpt($_GET["show"],'mobiloilform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'mobiloil.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'lsttyre'){
PageCheckerOpt($_GET["show"],'lsttyre',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'tyreform'){
PageCheckerOpt($_GET["show"],'tyreform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'tyre.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vendorexpns'){
if(isset($_GET['i']) && !empty($_GET['i'])){
PageCheckerOpt($_GET["show"],'vendorexpns',array(1,2),$objCheckLogin);
} else {
redirect(Route::_('show=logout'));
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'vendorexpnsform'){
PageCheckerOpt($_GET["show"],'vendorexpnsform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'vendorexpns.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'completevendororder'){
PageCheckerOpt($_GET["show"],'completevendororder',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'completeoutsideorder'){
	PageCheckerOpt($_GET["show"],'completeoutsideorder',array(1,2),$objCheckLogin);
	/******************************************************************************/
	////////////////////////////////////////////////////////////////////////////////
	/******************************************************************************/
} elseif($_GET["show"] == 'customercontra'){
PageCheckerOpt($_GET["show"],'customercontra',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'customercontraform'){
PageCheckerOpt($_GET["show"],'customercontraform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'customercontra.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'wrongtransaction'){
PageCheckerOpt($_GET["show"],'wrongtransaction',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'wrongtransactionform'){
PageCheckerOpt($_GET["show"],'wrongtransactionform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'wrongtransaction.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'printreport'){
PageCheckerOpt($_GET["show"],'printreport',array(1,2,3),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'openingbalance'){
PageCheckerOpt($_GET["show"],'openingbalance',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'openingbalanceform'){
PageCheckerOpt($_GET["show"],'openingbalanceform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'openingbalance.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'removesctran'){
PageCheckerOpt($_GET["show"],'removesctran',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'removesctran.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'outsideorder'){
PageCheckerOpt($_GET["show"],'outsideorder',array(1,2),$objCheckLogin);
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'outsideorderform'){
PageCheckerOpt($_GET["show"],'outsideorderform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'outsideorder.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'outsideexpns'){
if(isset($_GET['i']) && !empty($_GET['i'])){
PageCheckerOpt($_GET["show"],'outsideexpns',array(1,2),$objCheckLogin);
} else {
redirect(Route::_('show=logout'));
}
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'outsideexpnsform'){
PageCheckerOpt($_GET["show"],'outsideexpnsform',array(1,2),$objCheckLogin);
include_once(ACTION_PATH.'outsideexpns.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'wtcustomerorder'){
	PageCheckerOpt($_GET["show"],'wtcustomerorder',array(1,2),$objCheckLogin);
	include_once(ACTION_PATH.'wtcustomerorder.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'wtsellerorder'){
	PageCheckerOpt($_GET["show"],'wtsellerorder',array(1,2),$objCheckLogin);
	include_once(ACTION_PATH.'wtsellerorder.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'modifypriceso'){
	PageCheckerOpt($_GET["show"],'modifypriceso',array(1,2),$objCheckLogin);
	include_once(ACTION_PATH.'modifypriceso.php');
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/










/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} elseif($_GET["show"] == 'checkinout'){

/*if(array_search('124.109.56.95', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('110.93.246.199', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('110.93.246.210', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('182.191.94.97', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('110.93.226.63', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('39.50.119.143', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('39.50.119.142', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('39.50.73.225', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('39.50.18.70', $CurrentIPArray, strict_parameter)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('39.50.85.178', $CurrentIPArray, true)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('119.159.144.119', $CurrentIPArray, true)){
include_once(ACTION_PATH.'checkinout.php');
} elseif(array_search('39.32.94.75', $CurrentIPArray, true)){
include_once(ACTION_PATH.'checkinout.php');
} else {*/
include_once(ACTION_PATH.'checkinout.php');
//}

/*
if(array_search($StaticOfficeIP, $CurrentIPArray, strict_parameter)){
PageCheckerOpt($_GET["show"],'checkinout',array(1,2,3,4,5,6,7,29,30,9,10,11,12,13,14,16,18,19,20,21,22,23,24,25,26,27,28,29,30),$objCheckLogin);
include_once(ACTION_PATH.'checkinout.php');
} else {
redirect(Route::_('show=logout'));
}
*/
/******************************************************************************/
////////////////////////////////////////////////////////////////////////////////
/******************************************************************************/
} else {
redirect(Route::_('show=logout'));
}
?>