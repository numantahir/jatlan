<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
 	$user_security_code	= $_POST['user_security_code'];

	$objValidate->setArray($_POST);
	$objValidate->setCheckField("user_security_code", _VLD_INVALID_SECURITYCODE, "S");
	$vResult = $objValidate->doValidate();
	
	// See if any error are not returned
	if(!$vResult){
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", trim(DecData($objCheckLogin->user_id, 1, $objBF)));
		$objQayaduser->setProperty("user_security_code", $objBF->encrypt($user_security_code, ENCRYPTION_KEY));
		$objQayaduser->checkUserSecurityCode();
		if($objQayaduser->totalRecords() >= 1){
			$rows = $objQayaduser->dbFetchArray(1);
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("sd_code", $objBF->encrypt($user_security_code, ENCRYPTION_KEY));
				$objQayaduser->setSecurityCode();				
					
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("user_id", trim(DecData($objCheckLogin->user_id, 1, $objBF)));
						$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
						$objQayaduser->setProperty("activity_detail", $objCheckLogin->fullname. " User Access Salary Detail. (".date('Y-m-d H:i:s').")");
						$objQayaduser->actUserLog("I");
				
					$link = Route::_('show=salarydetail');
					redirect($link);
					
				}
			}else{
		$vResult['user_security_code'] = _LOGIN_INVALID_SECURITY;
		$objCommon->setMessage(_LOGIN_INVALID_SECURITY, 'Error');
		}
		}
if($_GET['mode'] == "csd"){
	
	
	$NEwSecurityCode = rand(10,99).rand(111,999);
	$objQayaduser->resetProperty();
	$objQayaduser->setProperty("user_id", trim(DecData($objCheckLogin->user_id, 1, $objBF)));
	$objQayaduser->setProperty("user_security_code", $objBF->encrypt($NEwSecurityCode, ENCRYPTION_KEY));
	if($objQayaduser->actUser("U")){	
		
		$MobileNumber = trim(DecData($objCheckLogin->user_mobile, 1, $objBF));
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
		
		//$ZongSmSAPI = 'http://cbs.zong.com.pk/reachcwsv2/corporatesms.svc?wsdl';
		//$ZongAPI = new SoapClient($ZongSmSAPI, array("trace" =>1, "exception" =>0));
		//$TextMessageVerification = "Security Code is ".$NEwSecurityCode;						
		//$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessageVerification, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
		$MessageSendYES = 'oky';
		} else {
		$MessageSendYES = 'no';	
		}
		
		$objCommon->setMessage(_FORGOT_SECURITY_CODE_SEND, 'Info');
		$link = Route::_('show=securitycode');
		redirect($link);
	}
	
	
	
}