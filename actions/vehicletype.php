<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$type_name			= trim($_POST['type_name']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("type_name", 'Customer Name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$vechile_type_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['vechile_type_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_vehicle_type", "vechile_type_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("vechile_type_id", $vechile_type_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("type_name", $type_name);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actVehicleType($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 9);
				$objQayaduser->setProperty("entity_id", $vechile_type_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add New Vehicle Type -> (". $type_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Vehicle Type of -> (". $type_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Vehicle Type information saved successfully.', 'Info');
						$link = Route::_('show=vehicletype');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$vechile_type_id = $_GET['i'];
	else if(isset($_POST['vechile_type_id']) && !empty($_POST['vechile_type_id']))
		$vechile_type_id = $_POST['vechile_type_id'];
	if(isset($vechile_type_id) && !empty($vechile_type_id)){
		$objSSSjatlan->setProperty("vechile_type_id", trim($objBF->decrypt($vechile_type_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstVehicleType();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}