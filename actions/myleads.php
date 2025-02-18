<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$lead_id				= trim($_POST['lead_id']);
	$assign_lead_id			= trim($_POST['assign_lead_id']);
	$assign_action_status	= trim($_POST['assign_action_status']);
	$lead_comment			= trim($_POST['lead_comment']);
	$reg_date				= date('Y-m-d H:i:s');
	
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("lead_comment_id", $objQayaduser->genCode("rs_tbl_lead_comments", "lead_comment_id"));
		$objQayaduser->setProperty("leads_id", $lead_id);
		$objQayaduser->setProperty("assign_lead_id", $assign_lead_id);
		$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->setProperty("lead_comment", $lead_comment);
		$objQayaduser->setProperty("assign_lead_status", $assign_action_status);
		$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
		$objQayaduser->setProperty("isActive", 1);
		if($objQayaduser->actLeadComments('I')){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("assign_lead_id", $assign_lead_id);
				$objQayaduser->setProperty("assign_action_status", $assign_action_status);
				$objQayaduser->actLeadsAssign('U');
				
			$objCommon->setMessage(_LEAD_COMMENT_SUCCESSFULLY, 'Info');
			$link = Route::_('show=myleads');
			redirect($link);
		
		}
}
?>