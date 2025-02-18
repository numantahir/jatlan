<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$vechile_id			= trim($_POST['vechile_id']);
	$driver_id			= trim($_POST['driver_id']);
	$order_remarks		= trim($_POST['order_remarks']);
	$Order_Number		= trim($_POST["odn"]);
	
	$Old_vehicle_no		= trim($_POST["ovn"]);
	$new_vehicle_no		= trim($_POST["op_number"]);
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("vechile_id", 'Vehicle Selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST["order_id"], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("vechile_id", $vechile_id);
				$objSSSjatlan->setProperty("driver_id", $driver_id);
				if($objSSSjatlan->actOrders('U')){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 17);
				$objQayaduser->setProperty("entity_id", trim($objBF->decrypt($_POST["order_id"], 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Change Order Vehicle ".$Old_vehicle_no." -> ". $new_vehicle_no);
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Order vehicle has been changed successfully.', 'Info');
						$link = Route::_('show=uporders&i='.EncData(trim($objBF->decrypt($_POST["order_id"], 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->setProperty("order_status", 2);
$objSSSjatlan->lstOrders();
$OrderDetail = $objSSSjatlan->dbFetchArray(1);
}