<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$person_name			= trim($_POST['person_name']);
	$contact_number			= trim($_POST['contact_number']);
	$employee_id			= trim($_POST['employee_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("person_name", _PERSONENAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_emergency_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_emergency_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_emergency", "user_emergency_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_emergency_id", $user_emergency_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("person_name", $person_name);
				$objQayaduser->setProperty("contact_number", $contact_number);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserEmergencyNumber($mode)){
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Holiday by ".$LoginUserInfo["fullname"]." -> (".$person_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Holiday info -> (".$person_name .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage(_EMPLOYEE_EMERGENCY_NUMBER_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=employemrgncy&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_emergency_id = $_GET['ei'];
	else if(isset($_POST['user_emergency_id']) && !empty($_POST['user_emergency_id']))
		$user_emergency_id = $_POST['user_emergency_id'];
	if(isset($user_emergency_id) && !empty($user_emergency_id)){
		$objQayaduser->setProperty("user_emergency_id", trim($objBF->decrypt($user_emergency_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserEmergency();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}