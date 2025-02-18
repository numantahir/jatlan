<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$bonus_amount			= trim($_POST['bonus_amount']);
	$bonus_status			= trim($_POST['bonus_status']);
	$isActive				= trim($_POST['isActive']);
	$employee_id			= trim($_POST['employee_id']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("bonus_amount", _BONUSAMOUNT . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_bonus_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_bonus_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_salary_bonus", "user_bonus_id");
				//
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_bonus_id", $user_bonus_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("bonus_amount", $bonus_amount);
				$objQayaduser->setProperty("bonus_status", $bonus_status);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actSalaryBonus($mode)){
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Holiday by ".$LoginUserInfo["fullname"]." -> (".$bonus_amount .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Holiday info -> (".$bonus_amount .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage(_EMPLOYEE_SALARY_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=employebonus&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_bonus_id = $_GET['ei'];
	else if(isset($_POST['user_bonus_id']) && !empty($_POST['user_bonus_id']))
		$user_bonus_id = $_POST['user_bonus_id'];
	if(isset($user_bonus_id) && !empty($user_bonus_id)){
		$objQayaduser->setProperty("user_bonus_id", trim($objBF->decrypt($user_bonus_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstBonus();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}