<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$bank_id				= trim($_POST['bank_id']);
	$account_no				= trim($_POST['account_no']);
	$account_title			= trim($_POST['account_title']);
	$employee_id			= trim($_POST['employee_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("account_no", "Account No" . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$employee_bank_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['employee_bank_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_bank_account_detail", "employee_bank_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("employee_bank_id", $employee_bank_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("bank_id", $bank_id);
				$objQayaduser->setProperty("account_no", $account_no);
				$objQayaduser->setProperty("account_title", $account_title);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserBankDetail($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Employee Bank info by ".$LoginUserInfo["fullname"]." -> (".$account_title .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Bank Account info -> (".$account_title .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_EMPLOYEE_BANK_ACCOUNT_DETIL_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=employbank&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$employee_bank_id = $_GET['ei'];
	else if(isset($_POST['employee_bank_id']) && !empty($_POST['employee_bank_id']))
		$employee_bank_id = $_POST['employee_bank_id'];
	if(isset($employee_bank_id) && !empty($employee_bank_id)){
		$objQayaduser->setProperty("employee_bank_id", trim($objBF->decrypt($employee_bank_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserBankAccountDetail();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}