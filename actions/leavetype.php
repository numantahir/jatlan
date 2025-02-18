<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$leave_name				= trim($_POST['leave_name']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("leave_name", _TYPEOFLEAVE_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$leave_type_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['leave_type_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_leave_type", "leave_type_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("leave_type_id", $leave_type_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("leave_name", $leave_name);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actLeaveType($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Type of Leave by ".$LoginUserInfo["fullname"]." -> (".$leave_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Type of Leave info -> (".$leave_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_TYPEOFLEAVE, 'Info');
						$link = Route::_('show=leavetype');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$leave_type_id = $_GET['i'];
	else if(isset($_POST['leave_type_id']) && !empty($_POST['leave_type_id']))
		$leave_type_id = $_POST['leave_type_id'];
	if(isset($leave_type_id) && !empty($leave_type_id)){
		$objQayaduser->setProperty("leave_type_id", trim($objBF->decrypt($leave_type_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstLeaveTypes();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}