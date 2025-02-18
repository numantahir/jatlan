<?php
if($_GET['mode'] == "c" && trim(DecData($_GET["st"], 1, $objBF)) == "in" && trim(DecData($_GET["i"], 1, $objBF)) != "" && trim(DecData($_GET["psi"], 1, $objBF)) != ""){

	$objQayadProerty->resetProperty();
	$temp_lock_id		= trim(DecData($_GET["i"], 1, $objBF));
	$property_share_id	= trim(DecData($_GET["psi"], 1, $objBF));
	$entery_date		= date('Y-m-d H:i:s');

		$objQayadProerty->setProperty("temp_lock_id", $temp_lock_id);
		$objQayadProerty->setProperty("lock_status", 7);
		if($objQayadProerty->actUnitTempLock('U')){

				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("property_share_id", $property_share_id);
				$objQayadProerty->setProperty("property_share_status", 7);
				$objQayadProerty->actPropertyShares("U");
					
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", $property_share_id);
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayadProerty->setProperty("log_desc", "Agent (".$objQayaduser->fullname.") send request to Unlock Share.");
				$objQayadProerty->actPropertyLog("I");
					
					$objCommon->setMessage(_UNLOCKED_SHARE_MSG_SUCCESS, 'Info');
					$link = Route::_('show=unitslocked');
						redirect($link);
						
				}
	
	
} elseif($_GET['mode'] == "c" && trim(DecData($_GET["st"], 1, $objBF)) == "ad" && trim(DecData($_GET["i"], 1, $objBF)) != "" && trim(DecData($_GET["pi"], 1, $objBF)) != ""){

	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("temp_lock_id", trim(DecData($_GET["i"], 1, $objBF)));
	$objQayadProerty->VwLockedPropertyDetail();
	$RequestedLockProperty = $objQayadProerty->dbFetchArray(1);
	
	$adjustment_code = date('dm').'/'.$RequestedLockProperty["property_id"].'/'.$RequestedLockProperty["user_id"].'/'.substr($RequestedLockProperty["ledger_code"],3,50).'/'.$RequestedLockProperty["temp_lock_id"];
		if($RequestedLockProperty["temp_lock_id"] != ''){
		$objQayadProerty->resetProperty();
		$objQayadProerty->setProperty("temp_lock_id", $RequestedLockProperty["temp_lock_id"]);
		$objQayadProerty->setProperty("lock_status", 6);
		$objQayadProerty->setProperty("adjustment_code", $adjustment_code);
		$objQayadProerty->setProperty("adjustment_status", 1);
		$objQayadProerty->setProperty("adjustment_date", date("Y-m-d"));
		if($objQayadProerty->actPropertyTempLock('U')){
			$objQayadProerty->resetProperty();
			$objQayadProerty->setProperty("property_id", $RequestedLockProperty["property_id"]);
			$objQayadProerty->setProperty("property_status", 1);
			$objQayadProerty->actProperties("U");
		}
		}
		$objCommon->setMessage(_ADJESMENT_PROPERTY_MSG_SUCCESS, 'Info');
		$link = Route::_('show=propertylocked');
		redirect($link);
	
}
?>