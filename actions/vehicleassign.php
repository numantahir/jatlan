<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$driver_id				= trim($_POST['driver_id']);
	
	$vehicle_id				= trim($_POST['vehicle_id']);
	$cdi					= trim($_POST['cdi']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("driver_id", 'Driver Selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				if(trim($objBF->decrypt($_POST['cdi'], 1, ENCRYPTION_KEY)) != $driver_id){
					
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("vehicle_assign_id", trim($objBF->decrypt($_POST["vehicle_assign_id"], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("isActive", 2);
				$objSSSjatlan->actVehicleAssigned('U');
				
				/********************************************************************************************************/
				/********************************************************************************************************/
				/********************************************************************************************************/
				
				$objSSSjatlan->resetProperty();
				$vehicle_assign_id = $objSSSjatlan->genCode("rs_tbl_jt_vehicle_assigned", "vehicle_assign_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("vehicle_assign_id", $vehicle_assign_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("vehicle_id", trim($objBF->decrypt($_POST["vehicle_id"], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("driver_id", $driver_id);
				
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", 1);
				if($objSSSjatlan->actVehicleAssigned('I')){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 11);
				$objQayaduser->setProperty("entity_id", $vehicle_assign_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Assign New Vehicle Driver -> (". $driver_id .")");
				
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('New driver assigned successfully.', 'Info');
						$link = Route::_('show=vehicle');
						redirect($link);
				}
				
				}
				
			}
	}



$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("vehicle_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
$objSSSjatlan->setProperty("isNot", 3);
$objSSSjatlan->lstVehicle();
$VehicleDetail = $objSSSjatlan->dbFetchArray(1);


$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("vehicle_id", $VehicleDetail["vehicle_id"]);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->lstVehicleAssignDriver();
$VehicleDriver = $objSSSjatlan->dbFetchArray(1);
?>