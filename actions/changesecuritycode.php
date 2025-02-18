<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$objQayaduser->resetProperty();
	$user_c_s_code		= trim($_POST['user_c_s_code']);
	$user_s_code		= trim($_POST['user_s_code']);
	$user_ncf_s_code	= trim($_POST['user_ncf_s_code']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("user_c_s_code", "Current Security Code" . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("user_s_code", "New Security Code" . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	
	// See if any error are not returned
	if(!$vResult){
		$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->setProperty("user_security_code", $objBF->encrypt($user_c_s_code, ENCRYPTION_KEY));
		if(!$objQayaduser->checkSecurityCode()){
			$vResult['user_c_s_code'] = "Invalid current security code.";
			$objCommon->setMessage("Invalid current security code.", 'Error');
		}
		else{
			$objQayaduser->setProperty("user_security_code", $objBF->encrypt($user_s_code, ENCRYPTION_KEY));
			$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			if($objQayaduser->changeSecurityCode()){
				
				$_SESSION['sd_panel'] = "false";
				unset($_SESSION['sd_code']);	
				
				$objCommon->setMessage("Security code changed successfully.", 'Info');
				$link = Route::_('show=securitycode');
				redirect($link);
			}
			else{
				$objCommon->setMessage("Problem while changing the security code.", 'Error');
				$vResult['invalid_pwd'] = "Problem while changing the security code.";
			}
		}
	}
}