<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$migration_user_id		= trim($_POST['migration_user_id']);
	$current_location_id	= trim($_POST['current_location_id']);
	$migration_location_id	= trim($_POST['migration_location_id']);
	$migration_reason		= trim($_POST['migration_reason']);
	$migration_date			= date('Y-m-d');
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("migration_location_id", _MIGRATION_LOCATION_TO . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$migration_id = $objQayaduser->genCode("rs_tbl_user_migration", "migration_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("migration_id", $migration_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("migration_user_id", $migration_user_id);
				$objQayaduser->setProperty("current_location_id", $current_location_id);
				$objQayaduser->setProperty("migration_location_id", $migration_location_id);
				$objQayaduser->setProperty("migration_reason", $migration_reason);
				$objQayaduser->setProperty("migration_date", $migration_date);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserMigration($mode)){
						
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_id", $migration_user_id);
					$objQayaduser->setProperty("location_id", $migration_location_id);
					$objQayaduser->actUser('U');
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Migrate user (".$objQayaduser->GetUserFullName($migration_user_id).") to location (". $objQayaduser->GetLocation($migration_location_id).")");
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_MIGRATION_DONE_SUCCESSFULLY, 'Info');
						$link = Route::_('show=migration');
						redirect($link);
				}
				
			}
}