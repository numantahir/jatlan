<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$location_name			= trim($_POST['location_name']);
	$deliver_chagres		= trim($_POST['deliver_chagres']);
	$unloading_charges		= trim($_POST['unloading_charges']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("location_name", 'Location Name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$location_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['location_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_location", "location_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("location_id", $location_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("location_name", $location_name);
				$objSSSjatlan->setProperty("deliver_chagres", $deliver_chagres);
				$objSSSjatlan->setProperty("unloading_charges", $unloading_charges);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actLocation($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 2);
				$objQayaduser->setProperty("entity_id", $location_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add New Location -> (". $location_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Location Info of -> (". $location_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_LOCATION_INFO_SUCCESSFULLY, 'Info');
						$link = Route::_('show=location');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$location_id = $_GET['i'];
	else if(isset($_POST['location_id']) && !empty($_POST['location_id']))
		$location_id = $_POST['location_id'];
	if(isset($location_id) && !empty($location_id)){
		$objSSSjatlan->setProperty("location_id", trim($objBF->decrypt($location_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstLocation();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}