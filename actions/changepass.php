<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$objQayaduser->resetProperty();
	$user_c_pass	= $_POST['user_c_pass'];
	$user_pass		= $_POST['user_pass'];
	$user_ncf_pass	= $_POST['user_ncf_pass'];
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("user_c_pass", _CP_CURRENT_PWD . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("user_pass", _CP_NEW_PWD . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	
	// See if any error are not returned
	if(!$vResult){
		$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->setProperty("user_pass", $objBF->encrypt($user_c_pass, ENCRYPTION_KEY));
		if(!$objQayaduser->checkPassword()){
			$vResult['user_c_pass'] = _VLD_INVALID_CURRENT_PASSWORD;
			$objCommon->setMessage(_VLD_INVALID_CURRENT_PASSWORD, 'Error');
		}
		else{
			$objQayaduser->setProperty("user_pass", $objBF->encrypt($user_pass, ENCRYPTION_KEY));
			$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			if($objQayaduser->changePassword()){
				$objCommon->setMessage(_CP_MSG_SUCCEESS, 'Info');
				$link = Route::_('show=changepass');
				redirect($link);
			}
			else{
				$objCommon->setMessage(_VLD_PROBLEM_CHANGE, 'Error');
				$vResult['invalid_pwd'] = _VLD_PROBLEM_CHANGE;
			}
		}
	}
}
//800c61b6