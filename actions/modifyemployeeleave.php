<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["mode"], 1, $objBF)) == "SecOne"){

	$employee_id			= trim($_POST['employee_id']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("employee_id", 'Employee Selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				$link = Route::_('show=modifyemployeeleave&ld='.EncData("List", 2, $objBF).'&i='.EncData($employee_id, 2, $objBF));
				redirect($link);				
				}
}

if(trim(DecData($_GET["ld"], 1, $objBF)) == "FormLoad" && trim(DecData($_GET["i"], 1, $objBF)) != ""){
	
	$objQayaduser->resetProperty();
	$objQayaduser->setProperty("isActive_not", 3);
	$objQayaduser->setProperty("leave_request_id", trim(DecData($_GET["i"], 1, $objBF)) );
	$objQayaduser->lstUserLeaveRequest();
	$MyLeaveRequest = $objQayaduser->dbFetchArray(1);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["mode"], 1, $objBF)) == "TwoOne"){
	
	$leave_sd				= trim($_POST['leave_sd']);
	$leave_ed				= trim($_POST['leave_ed']);
	$leave_of				= trim($_POST['leave_of']);
	$leave_request_id		= trim(DecData($_POST['leave_request_id'], 1, $objBF));
	$User_ID				= trim($_POST["ui"]);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("leave_sd", 'Start Date' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("leave_ed", 'End Date' . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				
				$objQayaduser->setProperty("leave_request_id", $leave_request_id);
				$objQayaduser->setProperty("leave_sd", dateFormate_10($leave_sd));
				$objQayaduser->setProperty("leave_ed", dateFormate_10($leave_ed));
				$objQayaduser->setProperty("leave_of", $leave_of);
				$objQayaduser->actUserLeaveRequest('U');
				
				$link = Route::_('show=modifyemployeeleave&ld='.EncData("List", 2, $objBF).'&i='.EncData($User_ID, 2, $objBF));
				redirect($link);				
				}
				
}
?>