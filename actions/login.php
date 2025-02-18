<?php
require_once("config/config.php");
require_once('lang/' . strtolower(SITE_LANG) . '/rs_lang.website.php');
$objCommon 			= new Common;
$objMail 			= new Mail;
$objValidate 		= new Validate;
$objQayaduser 		= new Qayaduser;
$objBF 				= new Crypt_Blowfish('CBC');
//$objBF->setKey($cipher_key);

$resp = array();
if($_SERVER['REQUEST_METHOD'] == "POST"){
 	$user_mobile	= $_POST['user_mobile'];
 	$user_pass		= $_POST['user_pass'];

	//$BackLink	= $_POST['BKLINK'];
	//echo strlen($user_mobile);
	//die();
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("user_mobile", _VLD_INVALID_Mobile, "S");
	$objValidate->setCheckField("user_pass", _VLD_PASSWORD, "S");
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		$objQayaduser->setProperty("user_mobile", $user_mobile);
		$objQayaduser->setProperty("user_pass", $objBF->encrypt($user_pass, ENCRYPTION_KEY));
		$objQayaduser->setProperty("login_required", 1);
		$objQayaduser->checkUserLogin();
		//echo $objQayaduser->totalRecords();
		if($objQayaduser->totalRecords() >= 1){
			$rows = $objQayaduser->dbFetchArray(1);
			if($rows['isActive'] != 1){
				$vResult['invalid_login'] = _CUST_ACCOUNT_SUSPENDED;
				$objCommon->setMessage(_CUST_ACCOUNT_SUSPENDED, 'Error');
			}
			else{
				if($rows['sms_verification']==1){
					
					$VerificationCodeGen = rand(9999,99999);
					$TextMessageVerification = $VerificationCodeGen.' is your verification code.';
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_mobile", $rows['user_mobile']);
					$objQayaduser->setProperty("short_code", $VerificationCodeGen);
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
						$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessageVerification, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
						
						}
						$link = Route::_('show=verification&vi='.EncData($user_mobile, 2, $objBF));
						redirect($link);
					}

				} else {
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", $objBF->encrypt($rows['user_id'], ENCRYPTION_KEY));
				$objQayaduser->setProperty("user_mobile", $objBF->encrypt($rows['user_mobile'], ENCRYPTION_KEY));
				$objQayaduser->setProperty("login_time", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("fullname", $rows['fullname']);
				$objQayaduser->setProperty("first_name", $rows['user_fname']);
				$objQayaduser->setProperty("user_type", $rows['user_type_id']);
				$objQayaduser->setProperty("profile_img", $rows['user_profile_img']);
				$objQayaduser->setProperty("location_id", $rows['location_id']);
				$objQayaduser->setLogin();				
					
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("user_id", $rows['user_id']);
						$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
						$objQayaduser->setProperty("log_type", 3);
						$objQayaduser->setProperty("entity_id", $rows['user_id']);
						$objQayaduser->setProperty("activity_detail", $rows['fullname']. " User login. (".date('Y-m-d H:i:s').")");
						$objQayaduser->actUserLog("I");
				
					$objCommon->setMessage('Hello '.' '.$rows['fullname'].' '._LOGIN_SUCCESSFULLY, 'Info');
					$link = Route::_('');
					redirect($link);
					
				}
				/*$GetSecurityCode = rand(100000, 999999);
				$UpdateSecurityCode = new Customer;
				$UpdateSecurityCode->setProperty("customer_id", $rows['customer_id']);
				$UpdateSecurityCode->setProperty("security_code", $GetSecurityCode);
				$UpdateSecurityCode->actCustomer("U");
				*/
				
			}
		}
		else{
		$vResult['invalid_login'] = _LOGIN_INVALID_LOGIN;
		$objCommon->setMessage(_LOGIN_INVALID_LOGIN, 'Error');
		}
		//$resp['login_status'] = $login_status;
	}
}