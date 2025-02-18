<?php
if(trim(DecData($_GET["mode"], 1, $objBF)) == 'add_teamlead' && trim(DecData($_GET["li"], 1, $objBF)) != '' && trim(DecData($_GET["ui"], 1, $objBF)) != ''){
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", trim(DecData($_GET["ui"], 1, $objBF)));
		$objQayaduser->setProperty("teamlead_status", 2);
		$objQayaduser->setProperty("teamlead_date", date('Y-m-d H:i:s'));
		$objQayaduser->actUser('U');
		
			$objCommon->setMessage(_TEAM_LEAD_CHANGE_SUCCESSFULLY, 'Info');
			$link = Route::_('show=teamlead&li='.$_GET["li"]);
			redirect($link);
		
}

if(trim(DecData($_GET["mode"], 1, $objBF)) == 'change_teamlead' && trim(DecData($_GET["ci"], 1, $objBF)) != '' && trim(DecData($_GET["ui"], 1, $objBF)) != ''){

	$objQayaduser->resetProperty();
	$objQayaduserUpdate = new Qayaduser;
	$objQayaduser->setProperty("teamlead_id", trim(DecData($_GET["ci"], 1, $objBF)));
	$objQayaduser->lstUsers();
	if($objQayaduser->totalRecords() > 0){
		while($CurrentTeamLeadID = $objQayaduser->dbFetchArray(1)){
			$objQayaduserUpdate->setProperty("user_id", $CurrentTeamLeadID["user_id"]);
			$objQayaduserUpdate->setProperty("teamlead_id", trim(DecData($_GET["ui"], 1, $objBF)));
			$objQayaduserUpdate->actUser('U');
		}
	}
		/***********************/
		/////////////////////////
		/***********************/
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", trim(DecData($_GET["ui"], 1, $objBF)));
		$objQayaduser->setProperty("teamlead_status", 2);
		$objQayaduser->setProperty("teamlead_date", date('Y-m-d H:i:s'));
		$objQayaduser->actUser('U');
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", trim(DecData($_GET["ci"], 1, $objBF)));
		$objQayaduser->setProperty("teamlead_status", 1);
		$objQayaduser->setProperty("teamlead_date", date('Y-m-d H:i:s'));
		$objQayaduser->actUser('U');

			$objCommon->setMessage(_TEAM_LEAD_CHANGE_SUCCESSFULLY, 'Info');
			$link = Route::_('show=teamlead&li='.EncData($objQayaduser->location_id, 2, $objBF));
			redirect($link);
		
}
if(trim(DecData($_GET["mode"], 1, $objBF)) == 'remove' && trim(DecData($_GET["ui"], 1, $objBF)) != ''){

	$objQayaduser->resetProperty();
	$objQayaduserUpdate = new Qayaduser;
	$objQayaduser->setProperty("teamlead_id", trim(DecData($_GET["ui"], 1, $objBF)));
	$objQayaduser->lstUsers();
	if($objQayaduser->totalRecords() > 0){
		while($CurrentTeamLeadID = $objQayaduser->dbFetchArray(1)){
			$objQayaduserUpdate->setProperty("user_id", $CurrentTeamLeadID["user_id"]);
			$objQayaduserUpdate->setProperty("teamlead_id", 0);
			$objQayaduserUpdate->actUser('U');
		}
	}
	
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", trim(DecData($_GET["ui"], 1, $objBF)));
		$objQayaduser->setProperty("teamlead_status", 1);
		$objQayaduser->setProperty("teamlead_date", date('Y-m-d H:i:s'));
		$objQayaduser->actUser('U');
	
			$objCommon->setMessage(_TEAM_LEAD_CHANGE_SUCCESSFULLY, 'Info');
			$link = Route::_('show=teamlead&li='.EncData($objQayaduser->location_id, 2, $objBF));
			redirect($link);
			
}
?>