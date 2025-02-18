<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$client_name			= trim($_POST['client_name']);
	$client_phone_number	= trim($_POST['client_phone_number']);
	$client_email			= trim($_POST['client_email']);
	$client_message			= trim($_POST['client_message']);
	$lead_from_id			= trim($_POST['lead_from_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	$lead_date				= date('Y-m-d');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("client_name", _CLIENT.' '._NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("client_phone_number", _CLIENT.' '._OFFERTE_PRD_NO . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_type_id", '13');
		$objQayaduser->setProperty("isActive", 1);
		$objQayaduser->lstUsers();
		$RegionalManager = $objQayaduser->dbFetchArray(1);
		
				$objQayaduser->resetProperty();
				$leads_id = $objQayaduser->genCode("rs_tbl_leads", "leads_id");							
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("leads_id", $leads_id);
				$objQayaduser->setProperty("dmm_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("client_name", $client_name);
				$objQayaduser->setProperty("client_phone_number", $client_phone_number);
				$objQayaduser->setProperty("client_email", $client_email);
				$objQayaduser->setProperty("client_message", $client_message);
				$objQayaduser->setProperty("lead_date", $lead_date);
				$objQayaduser->setProperty("lead_from_id", $lead_from_id);
				$objQayaduser->setProperty("entery_datetime", $entery_date);
				$objQayaduser->setProperty("rm_user_id", $RegionalManager["user_id"]);
				$objQayaduser->setProperty("rm_lead_status", 1);
				$objQayaduser->setProperty("rm_lead_fwd_status", 1);
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("assign_location_id", $LoginUserInfo["location_id"]);
				$objQayaduser->actLeads('I');
						
					$objCommon->setMessage(_LEAD_ADDED_SUCCESSFULLY, 'Info');
					$link = Route::_('show=assignleads');
					redirect($link);
				
			}
}