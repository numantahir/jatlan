<?php
                                                                                                                                                                                                            
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$device_name			= trim($_POST['device_name']);
	$device_location		= trim($_POST['device_location']);
	$device_ip				= trim($_POST['device_ip']);
	$device_port			= trim($_POST['device_port']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("device_name", _DEVICE_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("device_location", _DEVICE_LOCATION . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("device_ip", _DEVICE_IP . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("device_port", _DEVICE_PORT . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaddevice->resetProperty();
				$device_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['device_id'], 1, ENCRYPTION_KEY)) : $objQayaddevice->genCode("rs_tbl_device", "device_id");
				
				$objQayaddevice->resetProperty();
				$objQayaddevice->setProperty("device_id", $device_id);
				$objQayaddevice->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaddevice->setProperty("device_name", $device_name);
				$objQayaddevice->setProperty("device_location", $device_location);
				$objQayaddevice->setProperty("device_ip", $device_ip);
				$objQayaddevice->setProperty("device_port", $device_port);
				$objQayaddevice->setProperty("entery_date", $entery_date);
				$objQayaddevice->setProperty("isActive", $isActive);
				if($objQayaddevice->actDevice($mode)){
						
				$objQayaddevice->resetProperty();
				$objQayaddevice->setProperty("device_id", $device_id);
				$objQayaddevice->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaddevice->setProperty("device_log", "Add New Device Added By ".$objQayaduser->fullname." for -> (". $device_name.' / '.$device_location .") Office");
				$objQayaddevice->setProperty("fetch_status", 3);
				} else {
				$objQayaddevice->setProperty("device_log", "Device Edit By ".$objQayaduser->fullname." for -> (". $device_name.' / '.$device_location .") Office");
				$objQayaddevice->setProperty("fetch_status", 4);
				}
				$objQayaddevice->actDeviceLog("I");
				
						$objCommon->setMessage(_Device_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=device');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$device_id = $_GET['i'];
	else if(isset($_POST['device_id']) && !empty($_POST['device_id']))
		$device_id = $_POST['device_id'];
	if(isset($device_id) && !empty($device_id)){
		$objQayaddevice->setProperty("device_id", trim($objBF->decrypt($device_id, 1, ENCRYPTION_KEY)));
		$objQayaddevice->lstDevice();
		$data = $objQayaddevice->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}
