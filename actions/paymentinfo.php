<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$pm_mode_id				= trim($_POST['pm_mode_id']);
	$pm_mode_title			= trim($_POST['pm_mode_title']);
	$m_mode_detail			= trim($_POST['m_mode_detail']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("pm_mode_title", _PAYMENT_MODE_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadaccount->resetProperty();
				$pm_info_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['pm_info_id'], 1, ENCRYPTION_KEY)) : $objQayadaccount->genCode("rs_tbl_account_payment_mode_info", "pm_info_id");
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("pm_info_id", $pm_info_id);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("pm_mode_id", $pm_mode_id);
				$objQayadaccount->setProperty("pm_mode_title", $pm_mode_title);
				$objQayadaccount->setProperty("m_mode_detail", $m_mode_detail);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", $isActive);
				if($objQayadaccount->actAccountPaymentModeInfo($mode)){
						
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("entery_id", $pm_info_id);
				$objQayadaccount->setProperty("entery_type", 5);
				$objQayadaccount->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadaccount->setProperty("log_desc", "Add New Payment Mode Info -> (". $pm_mode_title .")");
				} else {
				$objQayadaccount->setProperty("log_desc", "Modify Payment Mode Info -> (". $pm_mode_title .")");
				}
				$objQayadaccount->actAccountLog("I");
				
						$objCommon->setMessage(_GROUP_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=paymentinfo');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$pm_info_id = $_GET['i'];
	else if(isset($_POST['pm_info_id']) && !empty($_POST['pm_info_id']))
		$pm_info_id = $_POST['pm_info_id'];
	if(isset($pm_info_id) && !empty($pm_info_id)){
		$objQayadaccount->setProperty("pm_info_id", trim($objBF->decrypt($pm_info_id, 1, ENCRYPTION_KEY)));
		$objQayadaccount->lstPaymentModeInfo();
		$data = $objQayadaccount->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}