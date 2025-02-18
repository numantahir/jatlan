<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$leads_id				= $_POST['leads_id'];
	$assign_agent_id		= trim($_POST['assign_agent_id']);
	$reg_date				= date('Y-m-d H:i:s');
	
	for($li=0;$li<=count($leads_id);$li++){
		if($leads_id[$li] != ''){
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("leads_id", $leads_id[$li]);
			$objQayaduser->setProperty("assign_agent_status", 2);
			$objQayaduser->setProperty("assign_datetime", date('Y-m-d H:i:s'));
			$objQayaduser->setProperty("lead_status", 4);
			$objQayaduser->actLeads('U');
				
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("assign_lead_id", $objQayaduser->genCode("rs_tbl_leads_assign", "assign_lead_id"));
					$objQayaduser->setProperty("lead_id", $leads_id[$li]);
					$objQayaduser->setProperty("assign_user_id", $assign_agent_id);
					$objQayaduser->setProperty("assign_from_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->setProperty("assign_by", 1);
					$objQayaduser->setProperty("assign_date", date('Y-m-d'));
					$objQayaduser->setProperty("assign_time", date('H:i:s'));
					$objQayaduser->setProperty("assign_lead_status", 1);
					$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("assign_action_status", 1);
					$objQayaduser->actLeadsAssign('I');
					
		}
	}
			$objCommon->setMessage(_LEAD_ASSIGN_SUCCESSFULLY, 'Info');
			$link = Route::_('show=newleadsreceived');
			redirect($link);
}
?>