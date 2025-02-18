<?php
require_once("config/config.php");
require_once('lang/' . strtolower(SITE_LANG) . '/rs_lang.website.php');
//require_once("config/rewrite.php");
$objCommon 			= new Common;
$objMail 			= new Mail;
$objValidate 		= new Validate;
$objQayaduser 	= new Qayaduser;
$objBF 				= new Crypt_Blowfish('CBC');
$objBF->setKey($cipher_key);

if($_SERVER['REQUEST_METHOD'] == "POST"){
 	$user_mobile	= $_POST['user_mobile'];
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("user_mobile", _VLD_INVALID_Mobile, "S");
	$vResult = $objValidate->doValidate();
	
	// See if any error are not returned
	if(!$vResult){
		$objQayaduser->setProperty("user_mobile", $user_mobile);
		$objQayaduser->checkUserLogin();
		if($objQayaduser->totalRecords() >= 1){
			$rows = $objQayaduser->dbFetchArray(1);
			
			if($rows['isActive'] != 1){
				$vResult['invalid_login'] = _CUST_ACCOUNT_SUSPENDED;
			}
			else{
					$NewPassword = rand(10,99).rand(111,999);
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_mobile", $rows['user_mobile']);
					$objQayaduser->setProperty("user_pass", $objBF->encrypt($NewPassword, ENCRYPTION_KEY));
					if($objQayaduser->actUser("U")){	
						
						$MobileNumber = $rows['user_mobile'];
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
						$TextMessageVerification = "New Password is ".$NewPassword;						
						$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessageVerification, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
						$MessageSendYES = 'oky';
						} else {
						$MessageSendYES = 'no';	
						}
						
						
						$vResult['invalid_login'] = _CUST_ACCOUNT_SUSPENDED;
						$objCommon->setMessage(_FORGOT_PASS_SEND, 'Info');
						//$link = Route::_('&np='.$NewPassword.'&s='.$MessageSendYES);
						$link = Route::_('');
						redirect($link);
					}

				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", $rows['user_id']);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $rows['fullname']. " send short code request for change password. (".date('Y-m-d H:i:s').")");
				$objQayaduser->actUserLog("I");
				
			}
		}
		else{
		$vResult['invalid_login'] = _LOGIN_INVALID_LOGIN;
		$objCommon->setMessage(_FORGOT_PHONE_NOT_VALID, 'Error');
		}
		//$resp['login_status'] = $login_status;
	}
}