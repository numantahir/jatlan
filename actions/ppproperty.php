<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$objRoute 			= new Route;
	$objQayadProerty->resetProperty();

	$floor_payment_id		= trim($_POST['floor_payment_id']);
	$project_id				= trim($_POST['project_id']);
	$floor_id				= trim($_POST['floor_id']);
	$user_id				= trim($_POST['user_id']);
	/************************************************************/
	$project_name			= trim($_POST["project_name"]);
	$floor_name				= trim($_POST["floor_name"]);
	/************************************************************/
	$rate_per_sq_ft			= trim($_POST['rate_per_sq_ft']);
	$payback_cutting		= trim($_POST['payback_cutting']);
	$pb_cutting_value		= trim($_POST['pb_cutting_value']);
	$unit_transfer_fee		= trim($_POST['unit_transfer_fee']);
	$registration_fee		= trim($_POST['registration_fee']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date 			= date('Y-m-d H:i:s');

	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("rate_per_sq_ft", _PROPERTY_SQFT_RATE . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadProerty->resetProperty();
				$floor_payment_id = ($_POST['mode'] == "U") ? trim(DecData($_POST['floor_payment_id'], 1, $objBF)) : $objQayadProerty->genCode("rs_tbl_projects_floor_payment_detail", "floor_payment_id");
				
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("floor_payment_id", $floor_payment_id);
				$objQayadProerty->setProperty("project_id", trim($objBF->decrypt($project_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("floor_id", trim($objBF->decrypt($floor_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("rate_per_sq_ft", $rate_per_sq_ft);
				$objQayadProerty->setProperty("payback_cutting", $payback_cutting);
				$objQayadProerty->setProperty("pb_cutting_value", $pb_cutting_value);
				$objQayadProerty->setProperty("unit_transfer_fee", $unit_transfer_fee);
				$objQayadProerty->setProperty("registration_fee", $registration_fee);
				$objQayadProerty->setProperty("entery_date", $entery_date);
				$objQayadProerty->setProperty("isActive", $isActive);
				if($objQayadProerty->actFloorPaymentPlan($mode)){
						
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("floor_payment_id_not", $floor_payment_id);
					$objQayadProerty->setProperty("isActive", 2);
					$objQayadProerty->actFloorPaymentPlan('U');
						
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", trim($objBF->decrypt($project_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadProerty->setProperty("log_desc", "Add New ".$project_name.', Floor:'.$floor_name." Price & Plan Detail");
				} else {
				$objQayadProerty->setProperty("log_desc", "Edit ".$project_name.', Floor:'.$floor_name." Price & Plan Detail");
				}
				
				$objQayadProerty->actPropertyLog("I");
						$proptyid = trim($objBF->decrypt($property_id, 1, ENCRYPTION_KEY));
						$link = Route::_('show=ppproperties&i='.EncData(trim($objBF->decrypt($project_id, 1, ENCRYPTION_KEY)), 2, $objBF).'&fi='.EncData(trim($objBF->decrypt($floor_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}			
			}
	} else {
			
if(isset($_GET['pi']) && !empty($_GET['pi']))
		$floor_payment_id = $_GET['pi'];
	else if(isset($_POST['floor_payment_id']) && !empty($_POST['floor_payment_id']))
		$floor_payment_id = $_POST['floor_payment_id'];
	if(isset($floor_payment_id) && !empty($floor_payment_id)){
		$objQayadProerty->setProperty("floor_payment_id", trim(DecData($floor_payment_id, 1, $objBF)));
		$objQayadProerty->lstFloorPaymentDetail();
		$data = $objQayadProerty->dbFetchArray(1);
		$mode	= "U";
		extract($data);
	}
}