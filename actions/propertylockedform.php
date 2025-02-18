<?php
$mode = 'I';
$DummyArray = array();
if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 1){
	
	$AppStage 				= trim(DecData($_POST["stage"], 1, $objBF));
	$PropertyRegisterId		= trim($_POST["property_registered_id"]);
	$floor_number			= trim($_POST["floor_number"]);
	$property_type_id		= trim($_POST["property_type_id"]);
	$GetLockStatus			= trim($_POST["st"]);
	$GetOldLockTempId		= trim($_POST["tli"]);
	if($GetLockStatus == 'ad'){
		$AdjustmentValuePass = '&st='.EncData($GetLockStatus, 2, $objBF).'&tli='.EncData($GetOldLockTempId, 2, $objBF);
	}
	$BuildLink = $PropertyRegisterId.'&'.$floor_number.'&'.$property_type_id;
	$link = Route::_('show=unitlockedform&stage='.EncData('2', 2, $objBF).'&bl='.EncData($BuildLink, 2, $objBF).$AdjustmentValuePass);
	redirect($link);
}

if(trim(DecData($_GET["stage"], 1, $objBF)) != 1 && trim(DecData($_GET["stage"], 1, $objBF)) !=''){

	$Getbbl = trim(DecData($_GET["bl"], 1, $objBF));
	list($pri,$fn,$pti)= explode('&', $Getbbl);

	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("property_type_id", $pti);
	$objQayadProerty->lstPropertyType();
	$PropertyTypeDetail = $objQayadProerty->dbFetchArray(1);
	
	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("propety_floor_id", $fn);
	$objQayadProerty->lstPropertyFloorPlan();
	$FloorNumber = $objQayadProerty->dbFetchArray(1);
	if(trim(DecData($_GET["pi"], 1, $objBF)) !=''){
	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("property_id", trim(DecData($_GET["pi"], 1, $objBF)));
	$objQayadProerty->lstProperties();
	$SelectivePropertyDetail = $objQayadProerty->dbFetchArray(1);
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("floor_id", $fn);
	$objQayadProerty->lstFloorPaymentDetail();
	$SelectiveFloorPriceDetail = $objQayadProerty->dbFetchArray(1);
	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////
	}
	if(trim(DecData($_GET["ui"], 1, $objBF)) !=''){
	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("property_share_id", trim(DecData($_GET["ui"], 1, $objBF)));
	$objQayadProerty->lstPropertyShares();
	$SelectiveUnitDetail = $objQayadProerty->dbFetchArray(1);
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 3){
//	$objQayadproperty->resetProperty();
 	
	$property_id			= trim(DecData($_POST["pi"], 1, $objBF));
	$property_share_id		= trim(DecData($_POST["ui"], 1, $objBF));
	$customer_fname			= trim($_POST['customer_fname']);
	$customer_lname			= trim($_POST['customer_lname']);
	$customer_father		= trim($_POST['customer_father']);
	$customer_cnic			= trim($_POST['customer_cnic']);
	$customer_passport		= trim($_POST['customer_passport']);
	$customer_email			= trim($_POST['customer_email']);
	$customer_c_address		= trim($_POST['customer_c_address']);
	$customer_p_address		= trim($_POST['customer_p_address']);
	$customer_phone			= trim($_POST['customer_phone']);
	$customer_mobile		= trim($_POST['customer_mobile']);
	$customer_mobile_2		= trim($_POST['customer_mobile_2']);
	$received_amount		= trim($_POST['received_amount']);
	$till_lock_duration		= $_POST["till_lock_duration"];
	$customer_mode			= trim($_POST["customer_mode"]);
	$customer_old_id		= trim($_POST["customer_old_id"]);
	
	$AdjustmentStatus		= trim($_POST["st"]);
	$OldTempLockId			= trim($_POST["tli"]);
	$AdjustmentCode			= trim($_POST["adc"]);
	
	$isActive				= $_POST['isActive'];
	$reg_date				= date('Y-m-d H:i:s');
	
	
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("ui", 'Unit selection ' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("customer_fname", _REG_FIRST_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("customer_lname", _REG_LAST_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("customer_cnic", _REG_CNIC . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("customer_mobile", _REG_MOBILE . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		/*
		if($AdjustmentStatus == 'ad' && $OldTempLockId != '' && $AdjustmentCode !=''){
			
			$objQayadProerty->resetProperty();
			$objQayadProerty->setProperty("temp_lock_id", $OldTempLockId);
			$objQayadProerty->setProperty("adjustment_code", $AdjustmentCode);
			$objQayadProerty->setProperty("property_id", $property_id);
			$objQayadProerty->setProperty("till_lock_duration", date('Y-m-d', strtotime(date("Y-m-d"). ' + '.$till_lock_duration.' days')));
			$objQayadProerty->setProperty("lock_status", 1);
			$objQayadProerty->actPropertyTempLock("U");
		
			$objQayadProerty->resetProperty();
			$objQayadProerty->setProperty("property_id", $property_id);
			$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			$objQayadProerty->setProperty("property_status", 4);
			$objQayadProerty->setProperty("book_duration", $till_lock_duration);
			$objQayadProerty->actProperties("U");
			
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("property_id", $property_id);
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayadProerty->setProperty("log_desc", $objQayaduser->fullname." has been locked this property for next ".$till_lock_duration." Day's");
				$objQayadProerty->setProperty("isActive", 1);
				$objQayadProerty->actPropertyLog("I");
			
			$objCommon->setMessage(_ADJ_LOCKED_PROPERTY_MSG_SUCCESS, 'Info');
			$link = Route::_('show=propertylocked');
			redirect($link);
			
		} else {
		*/
		
		$objQayadProerty->resetProperty();
		$temp_lock_id = $objQayadProerty->genCode("rs_tbl_unit_temp_lock", "temp_lock_id");
		$objQayadProerty->resetProperty();
		$objQayadProerty->setProperty("temp_lock_id", $temp_lock_id);
		$objQayadProerty->setProperty("property_share_id", $property_share_id);
		//$objQayadProerty->setProperty("property_id", $property_id);
		$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
		$objQayadProerty->setProperty("customer_old_id", $customer_old_id);
		$objQayadProerty->setProperty("customer_fname", $customer_fname);
		$objQayadProerty->setProperty("customer_lname", $customer_lname);
		$objQayadProerty->setProperty("customer_father", $customer_father);
		$objQayadProerty->setProperty("customer_cnic", $customer_cnic);
		$objQayadProerty->setProperty("customer_email", $customer_email);
		$objQayadProerty->setProperty("customer_c_address", $customer_c_address);
		$objQayadProerty->setProperty("customer_p_address", $customer_p_address);
		$objQayadProerty->setProperty("customer_phone", $customer_phone);
		$objQayadProerty->setProperty("customer_mobile", $customer_mobile);
		$objQayadProerty->setProperty("customer_mobile_2", $customer_mobile_2);
		$objQayadProerty->setProperty("received_amount", $received_amount);
		$objQayadProerty->setProperty("till_lock_duration", date('Y-m-d', strtotime(date("Y-m-d"). ' + '.$till_lock_duration.' days')));
		$objQayadProerty->setProperty("lock_status", 5);
		$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
		if($objQayadProerty->actUnitTempLock("I")){
		
			$objQayadProerty->resetProperty();
			$objQayadProerty->setProperty("property_share_id", $property_share_id);
			$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			$objQayadProerty->setProperty("property_share_status", 6);
			$objQayadProerty->setProperty("property_lock_days", $till_lock_duration);
			$objQayadProerty->setProperty("property_lock_till_date", date('Y-m-d', strtotime(date("Y-m-d"). ' + '.$till_lock_duration.' days')));
			$objQayadProerty->actPropertyShares("U");
			
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("property_id", $property_share_id);
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayadProerty->setProperty("log_desc", $objQayaduser->fullname." has been locked this unit for next ".$till_lock_duration." Day's");
				$objQayadProerty->setProperty("isActive", 1);
				$objQayadProerty->actPropertyLog("I");
			
		$objCommon->setMessage(_LOCKED_PROPERTY_MSG_SUCCESS, 'Info');
		$link = Route::_('show=unitslocked');
		redirect($link);
		
		}
		
		
		//}
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["stage"] == 6 && $_POST["typemode"] == 'searchcnic'){
	$GetCustomerCnic = trim($_POST["customer_old_cnic"]);
	$objQayadapplication->resetProperty();
	$objQayadapplication->setProperty("customer_cnic", $GetCustomerCnic);
	$objQayadapplication->lstApplicationCustomer();
	if($objQayadapplication->totalRecords() > 0){
	$data = $objQayadapplication->dbFetchArray(1);
	$customer_old_id = $data["customer_id"];
	$customer_mode = "U";
	$EXC_ReadOnlyApply = ' readonly';
	$FieldOption = 1;
	extract($data);
	} else {
	$objCommon->setMessage('No record found.', 'Error');
	}
	$customer_nominee_mode = 'I';
}
if(trim(DecData($_GET["st"], 1, $objBF)) == 'ad' && trim(DecData($_GET["tli"], 1, $objBF)) !=''){

	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("temp_lock_id", trim(DecData($_GET["tli"], 1, $objBF)));
	$objQayadProerty->VwLockedPropertyDetail();
	if($objQayadProerty->totalRecords() > 0){
	$GetOldCustomerRecord = $objQayadProerty->dbFetchArray(1);
	
	$customer_old_id 		= $GetOldCustomerRecord["customer_old_id"];
	$customer_fname 		= $GetOldCustomerRecord["customer_fname"];
	$customer_lname 		= $GetOldCustomerRecord["customer_lname"];
	$customer_father 		= $GetOldCustomerRecord["customer_father"];
	$customer_cnic 			= $GetOldCustomerRecord["customer_cnic"];
	$customer_passport 		= $GetOldCustomerRecord["customer_passport"];
	$customer_email 		= $GetOldCustomerRecord["customer_email"];
	$customer_c_address 	= $GetOldCustomerRecord["customer_c_address"];
	$customer_p_address 	= $GetOldCustomerRecord["customer_p_address"];
	$customer_phone 		= $GetOldCustomerRecord["customer_phone"];
	$customer_mobile 		= $GetOldCustomerRecord["customer_mobile"];
	$customer_mobile_2 		= $GetOldCustomerRecord["customer_mobile_2"];
	$received_amount		= $GetOldCustomerRecord["received_amount"];
	$AdjustmentCode			= $GetOldCustomerRecord["adjustment_code"];
	$ReadOnlyApply = ' readonly';
	$customer_mode = "U";
	$FieldOption = 1;
	} else {
	$objCommon->setMessage('No record found.', 'Error');
	$ReadOnlyApply = '';
	}
}
?>