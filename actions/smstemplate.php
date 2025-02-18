<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$sms_title				= trim($_POST['sms_title']);
	$sms_content			= trim($_POST['sms_content']);
	$sms_type_id			= trim($_POST['sms_type_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("sms_title", _SMS_TEMPLATE_TITLE . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("sms_content", _SMS_TEMPLATE_CONTENT . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadsms->resetProperty();
				$sms_template_id = ($_POST['mode'] == "U") ? trim(DecData($_POST['sms_template_id'], 1, $objBF)) : $objQayadaccount->genCode("rs_tbl_sms_template", "sms_template_id");
				
				$objQayadsms->resetProperty();
				$objQayadsms->setProperty("sms_template_id", $sms_template_id);
				$objQayadsms->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadsms->setProperty("sms_title", $sms_title);
				$objQayadsms->setProperty("sms_content", $sms_content);
				$objQayadsms->setProperty("sms_type_id", $sms_type_id);
				$objQayadsms->setProperty("entery_date", $entery_date);
				$objQayadsms->setProperty("isActive", $isActive);
				if($objQayadsms->actSMSTemplate($mode)){
						
				$objQayadsms->resetProperty();
				$objQayadsms->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadsms->setProperty("sms_template_id", $sms_template_id);
				$objQayadsms->setProperty("type_of_log", 2);
				$objQayadsms->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadsms->setProperty("log_detail", "Add New SMS Template -> (". $sms_title .")");
				} else {
				$objQayadsms->setProperty("log_detail", "Modify SMS Template -> (". $sms_title .")");
				}
				$objQayadsms->actSMSLog("I");
				
						$objCommon->setMessage(_SMS_TEMPATE_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=smstemplate');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$sms_template_id = $_GET['i'];
	else if(isset($_POST['sms_template_id']) && !empty($_POST['sms_template_id']))
		$sms_template_id = $_POST['sms_template_id'];
	if(isset($sms_template_id) && !empty($sms_template_id)){
		$objQayadsms->setProperty("sms_template_id", trim($objBF->decrypt($sms_template_id, 1, ENCRYPTION_KEY)));
		$objQayadsms->lstSMSTemplate();
		$data = $objQayadsms->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}