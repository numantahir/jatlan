<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$customer_name			= trim($_POST['customer_name']);
	$customer_number		= trim($_POST['customer_number']);
	
	$customer_cnic			= trim($_POST['customer_cnic']);
	$customer_note			= trim($_POST['customer_note']);
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("customer_name", _SMS_NON_REG_CONTACT_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("customer_number", _SMS_NON_REG_CONTACT_NUMBER . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
			
		if($mode == 'I'){
		$objQayadsms->resetProperty();
		$objQayadsms->setProperty("customer_number", $customer_number);
		$objQayadsms->CheckContactMobile();
		$CountCustomerMobile = $objQayadsms->totalRecords();
		} else {
			$CountCustomerMobile = 0;
		}	
		
			if($CountCustomerMobile < 1){
						
				$objQayadsms->resetProperty();
				$contact_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['contact_id'], 1, ENCRYPTION_KEY)) : $objQayadsms->genCode("rs_tbl_sms_nr_contact_list", "contact_id");
				
				$objQayadsms->resetProperty();
				$objQayadsms->setProperty("contact_id", $contact_id);
				$objQayadsms->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadsms->setProperty("customer_name", $customer_name);
				$objQayadsms->setProperty("customer_number", $customer_number);
				
				$objQayadsms->setProperty("customer_cnic", $customer_cnic);
				$objQayadsms->setProperty("customer_note", $customer_note);
				
				
				$objQayadsms->setProperty("entery_date", $entery_date);
				$objQayadsms->setProperty("isActive", $isActive);
				$objQayadsms->setProperty("location_id", trim($objQayaduser->location_id));
				if($objQayadsms->actSMSNRContactList($mode)){
						
				$objQayadsms->resetProperty();
				$objQayadsms->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadsms->setProperty("contact_id", $contact_id);
				$objQayadsms->setProperty("type_of_log", 2);
				$objQayadsms->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadsms->setProperty("log_detail", $objQayaduser->fullname." has been added new contact info of -> (". $customer_name .")");
				} else {
				$objQayadsms->setProperty("log_detail", $objQayaduser->fullname." modify contact info of -> (". $customer_name .")");
				}
				$objQayadsms->actSMSLog("I");
				
						$objCommon->setMessage(_SMS_CONTACT_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=smscontactlist');
						redirect($link);
				}
				
			} else {
				$vResult['mobile_ext'] = _CUSTOMER_MOBILE_ALREADY_EXISTS;
				$objCommon->setMessage(_CUSTOMER_MOBILE_ALREADY_EXISTS, 'Error');	
			}
		
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$contact_id = $_GET['i'];
	else if(isset($_POST['contact_id']) && !empty($_POST['contact_id']))
		$contact_id = $_POST['contact_id'];
	if(isset($contact_id) && !empty($contact_id)){
		$objQayadsms->setProperty("contact_id", trim($objBF->decrypt($contact_id, 1, ENCRYPTION_KEY)));
		$objQayadsms->lstSMSNRContactList();
		$data = $objQayadsms->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}