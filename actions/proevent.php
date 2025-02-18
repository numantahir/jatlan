<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$event_name				= trim($_POST['event_name']);
	$event_descripton		= trim($_POST['event_descripton']);
	$expected_date			= trim($_POST['expected_date']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("event_name", _EVENT_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("expected_date", _EXPECTED_DATE . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				$ExpectedDateretutn = dateFormate_10($expected_date);			
				$objQayadProerty->resetProperty();
				$project_event_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['project_event_id'], 1, ENCRYPTION_KEY)) : $objQayadProerty->genCode("rs_tbl_property_project_event", "project_event_id");
				
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("project_event_id", $project_event_id);
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("event_name", $event_name);
				$objQayadProerty->setProperty("event_descripton", $event_descripton);
				$objQayadProerty->setProperty("expected_date", $ExpectedDateretutn);
				$objQayadProerty->setProperty("enter_date", $entery_date);
				$objQayadProerty->setProperty("isActive", $isActive);
				if($objQayadProerty->actPropertyProjectEvent($mode)){
				
				if($mode == 'U'){
				
				$objQayadapplication->setProperty("instalment_date", $ExpectedDateretutn);
				$objQayadapplication->setProperty("ini_eventid", $project_event_id);
				$objQayadapplication->setProperty("ini_status", 2);
				$objQayadapplication->actApplicationInstalmentDetail('U');
				
				}
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", $project_event_id);
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadProerty->setProperty("log_desc", "Add New Project Event -> (". $event_name .")");
				} else {
				$objQayadProerty->setProperty("log_desc", "Modify Project Event -> (". $event_name .")");
				}
				$objQayadProerty->actPropertyLog("I");
				
						//$objCommon->setMessage(_GROUP_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=proevent');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$project_event_id = $_GET['i'];
	else if(isset($_POST['project_event_id']) && !empty($_POST['project_event_id']))
		$project_event_id = $_POST['project_event_id'];
	if(isset($project_event_id) && !empty($project_event_id)){
		$objQayadProerty->setProperty("project_event_id", trim($objBF->decrypt($project_event_id, 1, ENCRYPTION_KEY)));
		$objQayadProerty->lstPropertyProjectEvent();
		$data = $objQayadProerty->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}