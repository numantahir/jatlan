<?php
if(trim(DecData($_GET["md"], 1, $objBF)) == 'change_teamlead' && trim(DecData($_GET["tli"], 1, $objBF)) != '' && trim(DecData($_GET["agi"], 1, $objBF)) != ''){
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", trim(DecData($_GET["agi"], 1, $objBF)));
		$objQayaduser->setProperty("teamlead_id", trim(DecData($_GET["tli"], 1, $objBF)));
		$objQayaduser->actUser('U');
		
			$objCommon->setMessage(_AGENT_TEAM_LEAD_CHANGE_SUCCESSFULLY, 'Info');
			$link = Route::_('show=teamlead&li='.EncData($LoginUserInfo["location_id"], 2, $objBF));
			redirect($link);
		
}
if(trim(DecData($_GET["md"], 1, $objBF)) == 'remove' && trim(DecData($_GET["agi"], 1, $objBF)) != ''){

		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", trim(DecData($_GET["agi"], 1, $objBF)));
		$objQayaduser->setProperty("teamlead_id_zero", 'YES');
		$objQayaduser->actUser('U');
		
			$objCommon->setMessage(_AGENT_REMOVE_TEAMLEAD_SUCCESSFULLY, 'Info');
			$link = Route::_('show=teamlead&li='.EncData($LoginUserInfo["location_id"], 2, $objBF));
			redirect($link);
}
?>