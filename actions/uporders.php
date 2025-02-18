<?php
if(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)) != "" && trim($objBF->decrypt($_GET["rq"], 1, ENCRYPTION_KEY)) == 'cancel'){
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("order_status", 4);
				if($objSSSjatlan->actOrders('U')){
					
					$objSSSUPOrderDetail = new SSSjatlan;
					$objSSSGetOrderDetailList = new SSSjatlan;
					
					$objSSSGetOrderDetailList->resetProperty();
                    $objSSSGetOrderDetailList->setProperty("order_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
					$objSSSGetOrderDetailList->setProperty("isActive", 1);
					$objSSSGetOrderDetailList->setProperty("order_status", 2);
                    $objSSSGetOrderDetailList->lstOrderDetail();
                    while($OrderDetailLsit = $objSSSGetOrderDetailList->dbFetchArray(1)){

						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/	
						if($OrderDetailLsit["transaction_no"] != ''){		
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("transaction_id", $OrderDetailLsit["transaction_no"]);
						$objQayadaccount->setProperty("isActive", 3);
						$objQayadaccount->actAccountTransaction('U');
						}
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/	

						$objSSSUPOrderDetail->resetProperty();
						$objSSSUPOrderDetail->setProperty("order_detail_id", $OrderDetailLsit["order_detail_id"]);
						$objSSSUPOrderDetail->setProperty("order_id", $OrderDetailLsit["order_id"]);
						$objSSSUPOrderDetail->setProperty("order_status", 4);
						$objSSSUPOrderDetail->setProperty("update_date", date('Y-m-d H:i:s'));
						$objSSSUPOrderDetail->actOrderDetail('U');

					}
					
				}
				
				
				$objSSSOrderTranDetailUpdate = new SSSjatlan;
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->lstOrderTransactionDetail();
				while($OrderTransactionList = $objSSSjatlan->dbFetchArray(1)){
				
					if($OrderTransactionList["transaction_id"] != ''){
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("transaction_id", $OrderTransactionList["transaction_id"]);
						$objQayadaccount->setProperty("isActive", 3);
						$objQayadaccount->actAccountTransaction('U');
					}
					if($OrderTransactionList["order_tran_id"] != ''){
						/******************************************************************************/
						$objSSSOrderTranDetailUpdate->resetProperty();
						$objSSSOrderTranDetailUpdate->setProperty("order_tran_id", $OrderTransactionList["order_tran_id"]);
						$objSSSOrderTranDetailUpdate->setProperty("isActive", 3);
						$objSSSOrderTranDetailUpdate->actOrderTransactionDetail('U');
						/******************************************************************************/
					}
				
				}
				
		
				
				
				
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 18);
				$objQayaduser->setProperty("entity_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." cancel Order -> (". trim($objBF->decrypt($_GET["odn"], 1, ENCRYPTION_KEY)) .")");
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Selected Order has been cancel successfully.', 'Info');
						$link = Route::_('show=uporders');
						redirect($link);
						
} else {
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
?>