<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$leads_id				= $_POST['leads_id'];
	$forward_to_option		= trim($_POST['forward_to_option']);
	$assign_location_id		= trim($_POST['assign_location_id']);
	$assign_agent_id		= trim($_POST['assign_agent_id']);
	$reg_date				= date('Y-m-d H:i:s');
	
	for($li=0;$li<=count($leads_id);$li++){
		if($leads_id[$li] != ''){
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("leads_id", $leads_id[$li]);
			$objQayaduser->setProperty("rm_lead_fwd_status", 2);
			if($forward_to_option == 1){
			$objQayaduser->setProperty("assign_location_id", $assign_location_id);
			} 
			$objQayaduser->setProperty("rm_lead_fwd_datetime", date('Y-m-d H:i:s'));
			$objQayaduser->actLeads('U');
		}
	}
			$objCommon->setMessage(_LEAD_ASSIGN_SUCCESSFULLY, 'Info');
			$link = Route::_('show=assignleads');
			redirect($link);
}
?>