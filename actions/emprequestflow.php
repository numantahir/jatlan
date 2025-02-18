<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$employee_id			= trim($_POST['employee_id']);
	$leave_request_to		= trim($_POST['leave_request_to']);
	$overtime_request_to	= trim($_POST['overtime_request_to']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("employee_id", "Employee Select" . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$request_flow_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['request_flow_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_request_flow", "request_flow_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("request_flow_id", $request_flow_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("request_flow_type", 2);
				$objQayaduser->setProperty("employee_id", $employee_id);
				$objQayaduser->setProperty("leave_request_to", $leave_request_to);
				$objQayaduser->setProperty("overtime_request_to", $overtime_request_to);				
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserRequestFlow($mode)){
				
				$objQayaduser->resetProperty();
				$request_flow_log_id = $objQayaduser->genCode("rs_tbl_user_request_flow_log", "request_flow_log_id");
				$objQayaduser->resetProperty();
				if($mode == "I"){
				$activity_detail = "Assign new employee to department";
				} else {
				$activity_detail = "Modify employee to department";
				}
				$objQayaduser->setProperty("request_flow_log_id", $request_flow_log_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("request_flow_id", $request_flow_id);
				$objQayaduser->setProperty("activity_detail", $activity_detail);
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->actUserRequestFlowLog("I");
				
						$objCommon->setMessage("User requested flow structure modification changed successfully.", 'Info');
						$link = Route::_('show=emprequestflow');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$request_flow_id = $_GET['i'];
	else if(isset($_POST['request_flow_id']) && !empty($_POST['request_flow_id']))
		$request_flow_id = $_POST['request_flow_id'];
	if(isset($request_flow_id) && !empty($request_flow_id)){
		$objQayaduser->setProperty("request_flow_id", trim($objBF->decrypt($request_flow_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserRequestFlow();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}