<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$agents_id				= $_POST['agents_id'];
	$teamlead_id			= trim($_POST['teamlead_id']);
	$reg_date				= date('Y-m-d H:i:s');
	
	for($li=0;$li<=count($agents_id);$li++){
		if($agents_id[$li] != ''){
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", $agents_id[$li]);
			$objQayaduser->setProperty("teamlead_id", $teamlead_id);
			$objQayaduser->actUser('U');
		}
	}
			
			$objCommon->setMessage(_AGENT_ASSIGN_SUCCESSFULLY, 'Info');
			$link = Route::_('show=myagents&tli='.EncData($teamlead_id, 2, $objBF));
			redirect($link);
}
?>