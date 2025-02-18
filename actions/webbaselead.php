<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$leads_id				= $_POST['leads_id'];
	$reg_date				= date('Y-m-d H:i:s');
	
	for($li=0;$li<=count($leads_id);$li++){
		if($leads_id[$li] != ''){
			echo $leads_id[$li].'<br>';
			
			$objQayaduser->setProperty("prospect_id", trim($leads_id[$li]));
			$objQayaduser->lstProspectDetail();
			$Leadslist = $objQayaduser->dbFetchArray(1);
			print_r($Leadslist);
			
			$objQayaduser->resetProperty();
			$leads_id = $objQayaduser->genCode("rs_tbl_leads", "leads_id");							
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("leads_id", $leads_id);
			$objQayaduser->setProperty("dmm_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			$objQayaduser->setProperty("client_name", trim($Leadslist["prospect_name"]));
			$objQayaduser->setProperty("client_phone_number", trim($Leadslist["prospect_phone"]));
			$objQayaduser->setProperty("client_email", trim($Leadslist["prospect_email"]));
			$objQayaduser->setProperty("client_message", trim($Leadslist["prospect_msg"]));
			$objQayaduser->setProperty("lead_date", $LeadDate);
			$objQayaduser->setProperty("lead_from_id", $lfi);
			$objQayaduser->setProperty("entery_datetime", $entery_date);
			$objQayaduser->setProperty("rm_lead_status", 1);
			$objQayaduser->setProperty("rm_lead_fwd_status", 1);
			$objQayaduser->setProperty("isActive", 1);
			$objQayaduser->actLeads('I');
				
		}
	}
			$objCommon->setMessage(_LEAD_ASSIGN_SUCCESSFULLY, 'Info');
			$link = Route::_('show=assignleads');
			//redirect($link);
}
if(trim(DecData($_GET["mode"], 1, $objBF)) == 'Hot' && trim(DecData($_GET["li"], 1, $objBF)) != ''){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("leads_id", trim(DecData($_GET["li"], 1, $objBF)));
$objQayaduser->setProperty("rm_lead_status", 2);
$objQayaduser->setProperty("rm_action_datetime", date('Y-m-d H:i:s'));
$objQayaduser->actLeads('U');
$objCommon->setMessage(_LEAD_STATUS_HOT_CHANGE_SUCCESSFULLY, 'Info');
$link = Route::_('show=newleads');
redirect($link);
}
?>