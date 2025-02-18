<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$location_id			= trim($_POST['location_id']);
	$leave_type_id			= trim($_POST['leave_type_id']);
	$yearly_leave_id		= trim($_POST['yearly_leave_id']);
	$leave_reason			= trim($_POST['leave_reason']);
	$leave_sd				= trim($_POST['leave_sd']);
	$leave_ed				= trim($_POST['leave_ed']);
	$leave_of				= trim($_POST['leave_of']);
	$isActive				= trim($_POST['isActive']);
	$company_id				= trim($_POST["company_id"]);
	$department_id			= trim($_POST["department_id"]);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	if($location_id == 3){
		$PassLocationId = 2;	
	} else {
		$PassLocationId = $location_id;
	}
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("leave_reason", _LEAVE_REASON . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("leave_sd", _LEAVE_START_DATE . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("leave_ed", _LEAVE_END_DATE . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$leave_request_id = $objQayaduser->genCode("rs_tbl_user_leave_request", "leave_request_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("leave_request_id", $leave_request_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("location_id", $PassLocationId);
				$objQayaduser->setProperty("leave_type_id", $leave_type_id);
				$objQayaduser->setProperty("yearly_leave_id", $yearly_leave_id);
				$objQayaduser->setProperty("leave_reason", $leave_reason);
				$objQayaduser->setProperty("leave_sd", dateFormate_10($leave_sd));
				$objQayaduser->setProperty("leave_ed", dateFormate_10($leave_ed));				
				$objQayaduser->setProperty("leave_of", $leave_of);
				$objQayaduser->setProperty("forward_director", 1);
				$objQayaduser->setProperty("company_id", $company_id);
				$objQayaduser->setProperty("department_id", $department_id);
				$objQayaduser->setProperty("leave_status", 1);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserLeaveRequest($mode)){
				
					
				
				
				
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("request_flow_type", 2);
				$objQayaduser->lstUserRequestFlow();
				if($objQayaduser->totalRecords() > 0){
					$GetEmpDetail = $objQayaduser->dbFetchArray(1);
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("user_id", $GetEmpDetail["leave_request_to"]);
						$objQayaduser->lstUsers();
						$ReceiverEmpDetail = $objQayaduser->dbFetchArray(1);
						$leave_request_to = $ReceiverEmpDetail["user_mobile"];
				} else {					
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("company_id", $LoginUserInfo["company_id"]);
					$objQayaduser->setProperty("department_id", $LoginUserInfo["department_id"]);
					$objQayaduser->setProperty("request_flow_type", 1);
					$objQayaduser->lstUserRequestFlow();
					if($objQayaduser->totalRecords() > 0){
						$GetEmpDetail = $objQayaduser->dbFetchArray(1);
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("user_id", $GetEmpDetail["leave_request_to"]);
							$objQayaduser->lstUsers();
							$ReceiverEmpDetail = $objQayaduser->dbFetchArray(1);
							$leave_request_to = $ReceiverEmpDetail["user_mobile"];
					} else {
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("user_id", 48);
							$objQayaduser->lstUsers();
							$ReceiverEmpDetail = $objQayaduser->dbFetchArray(1);
							$leave_request_to = $ReceiverEmpDetail["user_mobile"];
					}
				}
				
				if($leave_request_to != ""){
				
					$MobileNumber = $leave_request_to;
					if(strlen($MobileNumber) >= 10){
						
						if(trim(substr($MobileNumber,0,1)) == 0){
							$ReturnNumber = trim(substr($MobileNumber,1, 13));
						} elseif(trim(substr($MobileNumber,0,3)) == '920'){
							$ReturnNumber = trim(substr($MobileNumber,3, 13));
						} elseif(trim(substr($MobileNumber,0,2)) == '92'){
							$ReturnNumber = trim(substr($MobileNumber,2, 13));
						} else {
							$ReturnNumber = $MobileNumber;
						}
					
				$ZongSmSAPI = 'http://cbs.zong.com.pk/reachcwsv2/corporatesms.svc?wsdl';
				$ZongAPI = new SoapClient($ZongSmSAPI, array("trace" =>1, "exception" =>0));
				$TextMessageVerification = "New leave request has been submited by ".$LoginUserInfo["fullname"].". Please check portal";
				//$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessageVerification, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
				//$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '923214641174', 'Mask' => 'Qayad', 'Message' => $TextMessageVerification, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
					}
				}
				
				
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
					$objQayaduser->setProperty("activity_detail", "New Leave request submitted by ".$LoginUserInfo["fullname"]." Forward To ".$leave_request_to);
					$objQayaduser->actUserLog("I");
					
					$objCommon->setMessage($LoginUserInfo["user_fname"].' '._LEAVE_REQUEST_ADDED_SUCCESSFULLY, 'Info');
					$link = Route::_('show=leaverequest');
					redirect($link);
				}
				
			}
	} 

if(trim(DecData($_GET["rq"], 1, $objBF)) == "Delete" && trim(DecData($_GET["i"], 1, $objBF)) != ''){
		$objQayaduser->setProperty("leave_request_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayaduser->setProperty("isActive", 3);
		$objQayaduser->actUserLeaveRequest('U');
		
			$objCommon->setMessage($LoginUserInfo["user_fname"].' '._LEAVE_REQUEST_DELETED_SUCCESSFULLY, 'Info');
			$link = Route::_('show=leaverequest');
			redirect($link);
}