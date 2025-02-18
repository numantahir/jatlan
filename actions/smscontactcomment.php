<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayadsms->resetProperty();
	$contact_id				= trim($_POST['contact_id']);
	$contact_comment		= trim($_POST['contact_comment']);
	$contact_status			= trim($_POST['contact_status']);
	$recheck_date			= trim($_POST['recheck_date']);
	$reg_date				= date('Y-m-d H:i:s');
	
		$objQayadsms->resetProperty();
		$objQayadsms->setProperty("contact_comment_id", $objQayadsms->genCode("rs_tbl_sms_contact_comments", "contact_comment_id"));
		$objQayadsms->setProperty("contact_id", $contact_id);
		$objQayadsms->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
		$objQayadsms->setProperty("contact_comment", $contact_comment);
		$objQayadsms->setProperty("contact_status", $contact_status);
		$objQayadsms->setProperty("recheck_date", dateFormate_10($recheck_date));
		$objQayadsms->setProperty("entery_date", date('Y-m-d H:i:s'));
		$objQayadsms->setProperty("isActive", 1);
		if($objQayadsms->actSMSContactComment('I')){
				
			$objCommon->setMessage("Contact comment & status update successfully.", 'Info');
			$link = Route::_('show=smscontactlist');
			redirect($link);
		
		}
}
?>