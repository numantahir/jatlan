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

$resp = array();
if($_SERVER['REQUEST_METHOD'] == "POST"){
 	$short_code		= trim($_POST['short_code']);
 	$requested_vi	= $objBF->decrypt($_POST['vi'], ENCRYPTION_KEY);
	list($Req_Mobile_no,$Req_User_id)= explode(',', $requested_vi);
	//$BackLink	= $_POST['BKLINK'];
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("short_code", _REG_SHORTCODE . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	
	// See if any error are not returned
	if(!$vResult){
		//$objQayaduser->setProperty("user_id", $Req_User_id);
		$objQayaduser->setProperty("user_mobile", trim($objBF->decrypt($_POST['vi'], ENCRYPTION_KEY)));
		$objQayaduser->setProperty("short_code", $short_code);
		$objQayaduser->checkUserLogin();
		if($objQayaduser->totalRecords() >= 1){
			$rows = $objQayaduser->dbFetchArray(1);
			
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
				$objQayaduser->setProperty("activity_detail", $rows['fullname']. " User login. (".date('Y-m-d H:i:s').")");
				$objQayaduser->actUserLog("I");
					//$objCommon->setMessage(_LOGIN_SUCCESSFULLY, 'Info');
					$objCommon->setMessage('Hello '.' '.$rows['fullname'].' '._LOGIN_SUCCESSFULLY, 'Info');
					$link = Route::_('');
					redirect($link);
				
		} else {
			$vResult['invalid_login'] = _VERIFICATION_INVALID_;
			$objCommon->setMessage(_VERIFICATION_INVALID_, 'Error');
		}
	}
}