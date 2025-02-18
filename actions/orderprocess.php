<?php
$mode = 'I';

	$vechile_id			= trim($_POST['vechile_id']);
	$driver_id			= trim($_POST['driver_id']);
	$order_remarks		= trim($_POST['order_remarks']);
	
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("vechile_id", 'Vehicle Selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$order_id = $objSSSjatlan->genCode("rs_tbl_jt_order", "order_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", $order_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("order_no", CreateOrderNumber($order_id));
				$objSSSjatlan->setProperty("vechile_id", $vechile_id);
				//$objSSSjatlan->setProperty("driver_id", $driver_id);
				$objSSSjatlan->setProperty("create_date", $entery_date);
				$objSSSjatlan->setProperty("order_status", 1);
				$objSSSjatlan->setProperty("order_remarks", $order_remarks);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actOrders('I')){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 13);
				$objQayaduser->setProperty("entity_id", $order_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." New Order Generate -> (". CreateOrderNumber($order_id) .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Generated Order -> (". CreateOrderNumber($order_id) .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('New Order has been Generated successfully. Please select the customer requested order for shipment.', 'Info');
						$link = Route::_('show=orderprocessform&oi='.EncData($order_id, 2, $objBF));
						redirect($link);
				}
				
			}
	
if($_SERVER['REQUEST_METHOD'] == "POST"){} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$order_id = $_GET['i'];
	else if(isset($_POST['order_id']) && !empty($_POST['order_id']))
		$order_id = $_POST['order_id'];
	if(isset($order_id) && !empty($order_id)){
		$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($order_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstOrders();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}