<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$order_id			= trim($_POST['order_id']);
	$d_invoice_no		= trim($_POST['d_invoice_no']);
	$d_cof_number		= trim($_POST['d_cof_number']);
	$d_loading_advice_no= trim($_POST['d_loading_advice_no']);
	$deliver_date		= trim($_POST["deliver_date"]);
	$order_status		= trim($_POST['order_status']);
	$Order_Number		= trim($_POST["odn"]);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("order_status", 'Order Status' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("d_invoice_no", $d_invoice_no);
				$objSSSjatlan->setProperty("d_cof_number", $d_cof_number);
				$objSSSjatlan->setProperty("d_loading_advice_no", $d_loading_advice_no);
				$objSSSjatlan->setProperty("order_status", 3);
				$objSSSjatlan->setProperty("deliver_date", $deliver_date);
				
				if($objSSSjatlan->actOrders('U')){
					
					$objSSSUPOrderDetail = new SSSjatlan;
					$objSSSGetOrderDetailList = new SSSjatlan;
					$objSSSUpdateRequestOrder = new SSSjatlan;
					
					$objSSSGetOrderDetailList->resetProperty();
                    $objSSSGetOrderDetailList->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
					$objSSSGetOrderDetailList->setProperty("isActive", 1);
					$objSSSGetOrderDetailList->setProperty("order_status", 2);
                    $objSSSGetOrderDetailList->lstOrderDetail();
                    while($OrderDetailLsit = $objSSSGetOrderDetailList->dbFetchArray(1)){
						
						$objSSSUPOrderDetail->resetProperty();
						$objSSSUPOrderDetail->setProperty("order_detail_id", $OrderDetailLsit["order_detail_id"]);
						$objSSSUPOrderDetail->setProperty("order_id", $OrderDetailLsit["order_id"]);
						$objSSSUPOrderDetail->setProperty("order_status", 3);
						$objSSSUPOrderDetail->setProperty("update_date", $entery_date);
						$objSSSUPOrderDetail->actOrderDetail('U');
						
						$objSSSUpdateRequestOrder->resetProperty();
						$objSSSUpdateRequestOrder->setProperty("order_request_id", $OrderDetailLsit["request_order_id"]);
						$objSSSUpdateRequestOrder->setProperty("order_process_status", 3);
						$objSSSUpdateRequestOrder->setProperty("order_delivery_status", 2);
						$objSSSUpdateRequestOrder->actOrderRequestDetail('U');
					
					}
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 16);
				$objQayaduser->setProperty("entity_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Order Delivery Update of -> (". $Order_Number .")");
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Order delivery information has been saved successfully.', 'Info');
						$link = Route::_('show=uporders');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i'])){
$RequestedOrderId = trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY));
$objSSSDestination = new SSSjatlan;
$objSSSCustomers = new SSSjatlan;
$objSSSProducts = new SSSjatlan;
$objSSSVehicleType = new SSSjatlan;
$objSSSOrderCounter = new SSSjatlan;

$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_id", $RequestedOrderId);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->lstOrders();
$OrderProcess = $objSSSjatlan->dbFetchArray(1);

$objSSSCustomers->resetProperty();
$objSSSCustomers->setProperty("vehicle_id", $OrderProcess["vechile_id"]);
$objSSSCustomers->lstVehicle();
$VehicleNumber = $objSSSCustomers->dbFetchArray(1);

$objSSSVehicleType->resetProperty();
$objSSSVehicleType->setProperty("driver_id", $OrderProcess["driver_id"]);
$objSSSVehicleType->setProperty("isActive", 1);
$objSSSVehicleType->lstVehicleAssignDriver();
$DriverDetail = $objSSSVehicleType->dbFetchArray(1);

$objSSSDestination->resetProperty();
$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
$objSSSDestination->lstLocation();
$DestinationInfo = $objSSSDestination->dbFetchArray(1);

$objSSSOrderCounter->resetProperty();
$objSSSOrderCounter->setProperty("order_id", $OrderProcess["order_id"]);
$objSSSOrderCounter->setProperty("isActive", 1);
$objSSSOrderCounter->setProperty("order_status", 2);
$objSSSOrderCounter->lstOrderDetail();
$TotalNoOfOrders = $objSSSOrderCounter->totalRecords();	
}
	}