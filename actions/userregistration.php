<?php
$mode = 'I';
include("classes/thumbnail.class.php");
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objRoute 			= new Route;
	$objQayaduser->resetProperty();
	$user_email			= trim($_POST['user_email']);
	$user_mobile		= trim($_POST['user_mobile']);
	$user_pass			= trim($_POST['user_pass']);
	$user_fname			= trim($_POST['user_fname']);
	$user_lname			= trim($_POST['user_lname']);
	$user_address		= trim($_POST['user_address']);
	$user_phone			= trim($_POST['user_phone']);
	$user_cnic			= trim($_POST['user_cnic']);
	$user_type_id		= $_POST['user_type_id'];
	//$location_id		= $_POST['location_id'];
	$user_designation	= trim($_POST['user_designation']);
	$mode 				= trim($_POST['mode']);
	//$user_signature	= $_POST['user_signature'];
	//$user_profile_img	= $_POST['user_profile_img'];
	
	$sms_verification	= $_POST['sms_verification'];
	$login_required		= $_POST['login_required'];
	$isActive			= $_POST['isActive'];
	$reg_date			= date('Y-m-d H:i:s');
	
	if($sms_verification == 1){
		$SMSVerificatinCode = rand(9999,99999);
		} else {
			$SMSVerificatinCode = '';
			}
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("user_fname", _REG_FIRST_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("user_lname", _REG_LAST_NAME . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("user_email", _REG_EMAIL . _IS_REQUIRED_FLD, "E");
	if($mode == 'I'){
	$objValidate->setCheckField("user_pass", _REG_PASSWD . _IS_REQUIRED_FLD, "S");
	}
	$objValidate->setCheckField("user_mobile", _REG_MOBILE . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("user_cnic", _REG_CNIC . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		//Check whether the Mobile Number already exists/registered		
		if($mode == 'I'){
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_mobile", $user_mobile);
		$objQayaduser->CheckUserMobile();
		$CountUserMobile = $objQayaduser->totalRecords();
		} else {
			$CountUserMobile = 0;
		}
			if($CountUserMobile < 1){
				
				// Register the user.
				$objQayaduser->resetProperty();
				$user_id = $objQayaduser->genCode("rs_tbl_users", "user_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", $user_id);
				$objQayaduser->setProperty("enter_user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("user_email", $user_email);
				$objQayaduser->setProperty("user_mobile", $user_mobile);
				if($mode == 'U' && $user_pass!=''){
				$objQayaduser->setProperty("user_pass", $objBF->encrypt($user_pass, ENCRYPTION_KEY));	
				} elseif($mode == 'I'){
				$objQayaduser->setProperty("user_pass", $objBF->encrypt($user_pass, ENCRYPTION_KEY));
				}
				$objQayaduser->setProperty("user_fname", $user_fname);
				$objQayaduser->setProperty("user_lname", $user_lname);
				$objQayaduser->setProperty("user_address", $user_address);
				$objQayaduser->setProperty("user_phone", $user_phone);
				$objQayaduser->setProperty("user_cnic", $user_cnic);
				$objQayaduser->setProperty("user_type_id", $user_type_id);
				$objQayaduser->setProperty("user_designation", $user_designation);
				$objQayaduser->setProperty("sms_verification", $sms_verification);
				if($mode == 'I'){
				$objQayaduser->setProperty("short_code", $SMSVerificatinCode);
				}
				$objQayaduser->setProperty("login_required", $login_required);
				//$objQayaduser->setProperty("location_id", $location_id);
				$objQayaduser->setProperty("isActive", $isActive);
				$objQayaduser->setProperty("reg_date", $reg_date);
				if($objQayaduser->actUser($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Create New User by Admin -> (".$user_fname ." ".$user_lname.")");
				} else {
				$objQayaduser->setProperty("activity_detail", "Admin Edit user info -> (".$user_fname ." ".$user_lname.")");
				}
				$objQayaduser->actUserLog("I");
				
				/*		
				if(is_uploaded_file($_FILES['user_signature']['tmp_name'])){
				$objQayaduser->resetProperty();
				$signature_name = $objQayaduser->getImagename($_FILES['user_signature']['type'], $user_id);
				if(move_uploaded_file($_FILES['user_signature']['tmp_name'], USER_SIGNATURE_PATH . $signature_name)){
				$Signaturefolder = USER_SIGNATURE_PATH . $signature_name;
				$SignatureThumbFolder = USER_SIGNATURE_THUMB_PATH;
				$SigThumbPath = USER_SIGNATURE_THUMB_PATH . $signature_name;
				copy($Signaturefolder, $SigThumbPath);
				$ResizeSig = new Thumbnail($SigThumbPath, 165, 0, 100);
				$ResizeSig->save($SigThumbPath);						
				}
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_signature", $signature_name);
				$objQayaduser->setProperty("user_mobile", $user_mobile);
				$objQayaduser->actUser("U");
				}
				*/
				
				if(is_uploaded_file($_FILES['user_profile_img']['tmp_name'])){
				$objQayaduser->resetProperty();
				$profile_name = $objQayaduser->getImagename($_FILES['user_profile_img']['type'], $user_id);
				if(move_uploaded_file($_FILES['user_profile_img']['tmp_name'], USER_PROFILE_PATH . $profile_name)){
				$Profilefolder = USER_PROFILE_PATH . $profile_name;
				$ProfileThumbPath = USER_PROFILE_THUMB_PATH . $profile_name;
				copy($Profilefolder, $ProfileThumbPath);
				$ResizePros = new Thumbnail($ProfileThumbPath, 165, 0, 100);
				$ResizePros->save($ProfileThumbPath);						
				}
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_profile_img", $profile_name);
				$objQayaduser->setProperty("user_mobile", $user_mobile);
				$objQayaduser->actUser("U");
				}
					
						if($mode == 'I'){
						$objCommon->setMessage(_NEW_ACCOUNT_MSG_SUCCESS, 'Info');
						} else {
						$objCommon->setMessage(_EDIT_ACCOUNT_MSG_SUCCESS, 'Info');
						}
						$link = Route::_('show=users');
						redirect($link);
				}
				
			} else {
				$vResult['mobile_ext'] = _REG_MOBILE_ALREADY_EXISTS;
				$objCommon->setMessage(_REG_MOBILE_ALREADY_EXISTS, 'Error');
			}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$user_id = $_GET['i'];
	else if(isset($_POST['user_id']) && !empty($_POST['user_id']))
		$user_id = $_POST['user_id'];
	if(isset($user_id) && !empty($user_id)){
		$objQayaduser->setProperty("user_id", trim($objBF->decrypt($user_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUsers();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);
	}
}