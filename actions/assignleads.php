<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$leads_id				= $_POST['leads_id'];
	$forward_to_option		= trim($_POST['forward_to_option']);
	$assign_location_id		= trim($_POST['assign_location_id']);
	$assign_agent_id		= trim($_POST['assign_agent_id']);
	$reg_date				= date('Y-m-d H:i:s');
	
	
	if($forward_to_option == 1){
	$CountPassLeadsToAssign = count($leads_id);	
	$objQayaduser->resetProperty();
	$objQayaduser->setProperty("location_id", $assign_location_id);
	$objQayaduser->setProperty("teamlead_status", 2);
	$objQayaduser->lstUsers();
	$CountTeamLeads = $objQayaduser->totalRecords();
	$ArrayID = 0;
	while($Leadslist = $objQayaduser->dbFetchArray(1)){	
		$ArrayID++;
		$TeamLeadArray[$ArrayID] = array("user_id" => $Leadslist["user_id"], "location_id" => $Leadslist["location_id"]);
	}
	$DivLeadsOnTL = $CountPassLeadsToAssign / $CountTeamLeads;
	list($GetFirstCounter,$Rawcounter)= explode('.', $DivLeadsOnTL);
	$GetNoodLeadAsTL = $GetFirstCounter * $CountTeamLeads;
	$GetRemainingLeads = $CountPassLeadsToAssign - $GetNoodLeadAsTL;
		for($tl=1;$tl<=count($TeamLeadArray);$tl++){
			$CurrentID = $TeamLeadArray[$tl];	
			$PassLeadCounter = $GetFirstCounter * $tl;
				if($tl == 1){
					$StartingLopMode = 0;	
				} else {
					$GetMultiplyMode = $tl - 1;
					$MultiplyLDLoopCounter = $GetFirstCounter * $GetMultiplyMode;
					$StartingLopMode = $MultiplyLDLoopCounter + 1;
				}   for($ld=$StartingLopMode;$ld<=$PassLeadCounter;$ld++){
						if($leads_id[$ld] != ''){
							//echo $tl.'->'.$TeamLeadArray[$tl]["user_id"]."(".$TeamLeadArray[$tl]["location_id"].') --> '.$GetFirstCounter .' >> '.$ld.' > '.$leads_id[$ld].'<br>';
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("leads_id", $leads_id[$ld]);
							$objQayaduser->setProperty("assign_location_id", $TeamLeadArray[$tl]["location_id"]);
							$objQayaduser->setProperty("assign_team_lead_id", $TeamLeadArray[$tl]["user_id"]);
							$objQayaduser->setProperty("assign_teamlead_datetime", date('Y-m-d H:i:s'));
							$objQayaduser->setProperty("lead_status", 2);
							$objQayaduser->setProperty("rm_lead_fwd_status", 2);
							$objQayaduser->setProperty("rm_lead_fwd_datetime", date('Y-m-d H:i:s'));
							$objQayaduser->actLeads('U');
						}
					}
					
					
			if($TeamLeadArray[$tl]["user_id"] != ''){
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", $TeamLeadArray[$tl]["user_id"]);
			$objQayaduser->lstUsers();
			$GetUserInfo = $objQayaduser->dbFetchArray(1);
						$TotalLeadsAssign = count($leads_id);
						$MobileNumber = $GetUserInfo['user_mobile'];
						if(strlen($MobileNumber) >= 10){
							
						if(trim(substr($MobileNumber,0,1)) == 0){
							$ReturnNumber = trim(substr($MobileNumber,1, 13));
						} elseif(trim(substr($MobileNumber,0,3)) == '920'){
							$ReturnNumber = trim(substr($MobileNumber,3, 13));
						} elseif(trim(substr($MobileNumber,0,2)) == '92'){
							$ReturnNumber = trim(substr($MobileNumber,2, 13));
						} else {
							$ReturnNumber = $MobileNumber;
						}
						/*
						$ZongSmSAPI = 'http://cbs.zong.com.pk/reachcwsv2/corporatesms.svc?wsdl';
						$ZongAPI = new SoapClient($ZongSmSAPI, array("trace" =>1, "exception" =>0));
						$TextMessageTitle = 'Alert to Team Lead received new leads.';
						$TextMessage = "Hey ".$GetUserInfo['fullname'].", \nYou have been assigned leads on ".date("d-M-Y").". Please login to your portal and follow up";
						
						$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessage, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
						
						$objQayadsms->resetProperty();
						$objQayadsms->setProperty("sending_option", 2);
						$objQayadsms->setProperty("login_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayadsms->setProperty("sms_send_user_id", $TeamLeadArray[$tl]["user_id"]);
						$objQayadsms->setProperty("sms_send_type", 1);
						$objQayadsms->setProperty("sms_send_for", $TextMessageTitle);
						$objQayadsms->setProperty("sms_send_to", $MobileNumber);
						$objQayadsms->setProperty("sms_text_msg", $TextMessage);
						$objQayadsms->setProperty("sms_send_at", date('Y-m-d H:i:s'));
						$objQayadsms->setProperty("isActive", 1);
						$objQayadsms->actSMSSendingLog('I');
						*/
						}
				}
					
					
					
			}
	}
	
	// This Option If Admin Select Agent Option
	if($forward_to_option == 2){
	
	for($li=0;$li<=count($leads_id);$li++){
		if($leads_id[$li] != ''){
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("leads_id", $leads_id[$li]);
			$objQayaduser->setProperty("rm_lead_fwd_status", 2);
			list($AgentLocationId,$AgentUserId)= explode('-', $assign_agent_id);
			$objQayaduser->setProperty("assign_location_id", $AgentLocationId);
			$objQayaduser->setProperty("assign_agent_status", 2);
			$objQayaduser->setProperty("assign_datetime", date('Y-m-d H:i:s'));
			$objQayaduser->setProperty("lead_status", 3);
			$objQayaduser->setProperty("rm_lead_fwd_datetime", date('Y-m-d H:i:s'));
			$objQayaduser->actLeads('U');
				
					list($AgentLocationId,$AgentUserId)= explode('-', $assign_agent_id);
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("assign_lead_id", $objQayaduser->genCode("rs_tbl_leads_assign", "assign_lead_id"));
					$objQayaduser->setProperty("lead_id", $leads_id[$li]);
					$objQayaduser->setProperty("assign_user_id", $AgentUserId);
					$objQayaduser->setProperty("assign_from_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->setProperty("assign_by", 2);
					
					$objQayaduser->setProperty("assign_date", date('Y-m-d'));
					$objQayaduser->setProperty("assign_time", date('H:i:s'));
					$objQayaduser->setProperty("assign_lead_status", 1);
					$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->actLeadsAssign('I');
		}
	}
	
	}
			if($forward_to_option == 2){
			list($AgentLocationId,$AgentUserId)= explode('-', $assign_agent_id);
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", $AgentUserId);
			$objQayaduser->lstUsers();
			$GetUserInfo = $objQayaduser->dbFetchArray(1);
						$TotalLeadsAssign = count($leads_id);
						$MobileNumber = $GetUserInfo['user_mobile'];
						if(strlen($MobileNumber) >= 10){
							
						if(trim(substr($MobileNumber,0,1)) == 0){
							$ReturnNumber = trim(substr($MobileNumber,1, 13));
						} elseif(trim(substr($MobileNumber,0,3)) == '920'){
							$ReturnNumber = trim(substr($MobileNumber,3, 13));
						} elseif(trim(substr($MobileNumber,0,2)) == '92'){
							$ReturnNumber = trim(substr($MobileNumber,2, 13));
						} else {
							$ReturnNumber = $MobileNumber;
						}
						$ZongSmSAPI = 'http://cbs.zong.com.pk/reachcwsv2/corporatesms.svc?wsdl';
						$ZongAPI = new SoapClient($ZongSmSAPI, array("trace" =>1, "exception" =>0));
						$TextMessageTitle = 'Alert to agent received new leads.';
						$TextMessage = "Hey ".$GetUserInfo['fullname'].", \nYou have been assigned leads on ".date("d-M-Y").". Please login to your portal and follow up";
						
						$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessage, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
						
						$objQayadsms->resetProperty();
						$objQayadsms->setProperty("sending_option", 2);
						$objQayadsms->setProperty("login_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayadsms->setProperty("sms_send_user_id", $AgentUserId);
						$objQayadsms->setProperty("sms_send_type", 1);
						$objQayadsms->setProperty("sms_send_for", $TextMessageTitle);
						$objQayadsms->setProperty("sms_send_to", $MobileNumber);
						$objQayadsms->setProperty("sms_text_msg", $TextMessage);
						$objQayadsms->setProperty("sms_send_at", date('Y-m-d H:i:s'));
						$objQayadsms->setProperty("isActive", 1);
						$objQayadsms->actSMSSendingLog('I');
						
						}
			
			} 
			
			$objCommon->setMessage(_LEAD_ASSIGN_SUCCESSFULLY, 'Info');
			$link = Route::_('show=assignleads');
			redirect($link);
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
if(trim(DecData($_GET["mode"], 1, $objBF)) == 'Cold' && trim(DecData($_GET["li"], 1, $objBF)) != ''){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("leads_id", trim(DecData($_GET["li"], 1, $objBF)));
$objQayaduser->setProperty("rm_lead_status", 3);
$objQayaduser->setProperty("rm_action_datetime", date('Y-m-d H:i:s'));
$objQayaduser->actLeads('U');
$objCommon->setMessage(_LEAD_STATUS_COLD_CHANGE_SUCCESSFULLY, 'Info');
$link = Route::_('show=newleads');
redirect($link);
}
?>