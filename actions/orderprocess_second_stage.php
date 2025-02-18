<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$order_id			= trim($_POST['order_id']);
	$order_request_id	= $_POST['order_request_id'];
	$order_number		= trim($_POST['on']);
	
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("order_request_id", 'Vehicle Selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$TotalDeliveryCharges = 0;
				$TotalUnloadingCharges = 0;
				$TotalOrderCost = 0;
				$TotalOrderSellCost = 0;
				$TotalOrderItems = 0;
				$objSSSRequestedDetail = new SSSjatlan;
				for($ori=0;$ori<=count($order_request_id);$ori++){
					if($order_request_id[$ori] != ''){
						//echo $ori.'->'.$order_request_id[$ori].'<br>';
				$objSSSRequestedDetail->resetProperty();
				$objSSSRequestedDetail->setProperty("order_request_id", $order_request_id[$ori]);
				$objSSSRequestedDetail->setProperty("isActive", 1);
				$objSSSRequestedDetail->lstOrderRequestDetail();
				$RequestedOrderDetail = $objSSSRequestedDetail->dbFetchArray(1);	
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("product_price_id", $RequestedOrderDetail["product_price_id"]);
				$objSSSjatlan->lstProductPrice();
				$ProductPriceDetail = $objSSSjatlan->dbFetchArray(1);	
				/**************************************************************************/
				
				$PurchasePrice = $ProductPriceDetail["buy_price"] * $RequestedOrderDetail["no_of_items"];
				$SellingPrice = $ProductPriceDetail["selling_price"] * $RequestedOrderDetail["no_of_items"];
				$ShippingCharges = $RequestedOrderDetail["delivery_chagres"] * $RequestedOrderDetail["no_of_items"];
				$UnloadingCharges = $RequestedOrderDetail["unloading_price"] * $RequestedOrderDetail["no_of_items"];
				
				
				
				$objSSSjatlan->resetProperty();
				$order_detail_id = $objSSSjatlan->genCode("rs_tbl_jt_order_detail", "order_detail_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_detail_id", $order_detail_id);
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("request_order_id", $order_request_id[$ori]);
				$objSSSjatlan->setProperty("customer_id", $RequestedOrderDetail["customer_id"]);
				$objSSSjatlan->setProperty("product_id", $RequestedOrderDetail["product_id"]);
				$objSSSjatlan->setProperty("vendor_id", $RequestedOrderDetail["vendor_id"]);
				$objSSSjatlan->setProperty("product_price_id", $RequestedOrderDetail["product_price_id"]);
				$objSSSjatlan->setProperty("purchase_price", $PurchasePrice);
				$objSSSjatlan->setProperty("selling_price", $SellingPrice);
				$objSSSjatlan->setProperty("freight_price", $ShippingCharges);
				$objSSSjatlan->setProperty("unloading_price", $UnloadingCharges);
				$objSSSjatlan->setProperty("order_qty", $RequestedOrderDetail["no_of_items"]);
				//$objSSSjatlan->setProperty("transaction_no", $transaction_id);
				$objSSSjatlan->setProperty("order_status", 2);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actOrderDetail('I')){
						
						
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("entity_id", $RequestedOrderDetail["customer_id"]);
						$objQayadaccount->setProperty("head_type_id", 4);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->lstHead();
						$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
						$head_id = 	$GetCustomerHead["head_id"];
						//////////////////////////////////////////////////////////////////////
						$objSSSjatlan->resetProperty();
						$objSSSjatlan->setProperty("product_id", $RequestedOrderDetail["product_id"]);
						$objSSSjatlan->lstProducts();
						$GetProductDetail = $objSSSjatlan->dbFetchArray(1);
						//////////////////////////////////////////////////////////////////////
						//////////////////////////////////////////////////////////////////////
						$objQayadaccount->resetProperty();
						$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
						$objQayadaccount->setProperty("transaction_id", $transaction_id);
						$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayadaccount->setProperty("head_id", $GetCustomerHead["head_id"]);
						$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
						$objQayadaccount->setProperty("trans_title", 'Qty '.$RequestedOrderDetail["no_of_items"].' '. $GetProductDetail["product_name"].' order has been generated.');
						$objQayadaccount->setProperty("item_qty", $RequestedOrderDetail["no_of_items"]);
						$objQayadaccount->setProperty("trans_note", '');
						$objQayadaccount->setProperty("trans_mode", 1);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $order_detail_id);
						$objQayadaccount->setProperty("trans_amount", $SellingPrice);
						$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
						$objQayadaccount->setProperty("aplic_mode", 2);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						$objSSSjatlan->setProperty("trans_date", date('Y-m-d H:i:s'));
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->actAccountTransaction('I');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						
						/******************************************************************************/
						$objSSSjatlan->resetProperty();
						$objSSSjatlan->setProperty("order_detail_id", $order_detail_id);
						$objSSSjatlan->setProperty("transaction_no", $transaction_id);
						$objSSSjatlan->actOrderDetail('U');
						/******************************************************************************/
						
						
				$TotalDeliveryCharges += $ShippingCharges;
				$TotalUnloadingCharges += $UnloadingCharges;
				$TotalOrderCost += $PurchasePrice;
				$TotalOrderSellCost += $SellingPrice;
				$TotalOrderItems += $RequestedOrderDetail["no_of_items"];
				
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("log_type", 14);
					$objQayaduser->setProperty("entity_id", $order_id);
					$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
					$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Requested Order Linked With -> (". $order_number .")");
					$objQayaduser->actUserLog("I");
					
					/******************************************************************************/
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_request_id", $order_request_id[$ori]);
					$objSSSjatlan->setProperty("order_process_status", 2);
					$objSSSjatlan->actOrderRequestDetail('U');
					/******************************************************************************/
					
				}	
					}
					
				}
				
				
				$objSSSjatlanProList = new SSSjatlan;
				$objSSSGetProName = new SSSjatlan;
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("isActive", 1);
				$objSSSjatlan->setProperty("order_status", 2);
				$objSSSjatlan->setProperty("GROUPBY", 'vendor_id');
				$objSSSjatlan->lstOrderDetail();
				while($OrderDetailList = $objSSSjatlan->dbFetchArray(1)){
					$OrderSellingPrice = 0;
					$ProductTitle = '';
					$TotalQtyOrder = 0;
					$objSSSjatlanProList->resetProperty();
					$objSSSjatlanProList->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
					$objSSSjatlanProList->setProperty("vendor_id", $OrderDetailList["vendor_id"]);
					$objSSSjatlanProList->setProperty("isActive", 1);
					$objSSSjatlanProList->setProperty("order_status", 2);
					$objSSSjatlanProList->setProperty("ORDERBY", 'order_detail_id');
					$objSSSjatlanProList->lstOrderDetail();
					while($ProductDetail = $objSSSjatlanProList->dbFetchArray(1)){
						$ProductTitle .= $objSSSGetProName->GetProductName($ProductDetail["product_id"]).' Qty:' . $ProductDetail["order_qty"].'<br>';
						$OrderPurchasePrice += $ProductDetail["purchase_price"];
						$TotalQtyOrder += $ProductDetail["order_qty"];
					}
					
					/*******************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					********************************************************************/					
					//Get Vendor Head ID
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("entity_id", $OrderDetailList["vendor_id"]);
					$objQayadaccount->setProperty("head_type_id", 6);
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->lstHead();
					$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
					$head_id = 	$GetCustomerHead["head_id"];
					//////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////
					$objQayadaccount->resetProperty();
					$transaction_id_Vendor = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
					$objQayadaccount->setProperty("transaction_id", $transaction_id_Vendor);
					$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("head_id", $GetCustomerHead["head_id"]);
					$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id_Vendor));
					$objQayadaccount->setProperty("trans_title", 'New order has been created.');
					$objQayadaccount->setProperty("trans_note", $ProductTitle);
					$objQayadaccount->setProperty("item_qty", $TotalQtyOrder);
					$objQayadaccount->setProperty("trans_mode", 1);
					$objQayadaccount->setProperty("trans_type", 9);
					$objQayadaccount->setProperty("pay_mode", 8);
					$objQayadaccount->setProperty("entery_id", $GetCustomerHead["entity_id"]);
					$objQayadaccount->setProperty("trans_amount", $OrderPurchasePrice);
					$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
					$objQayadaccount->setProperty("aplic_mode", 2);
					$objQayadaccount->setProperty("trans_status", 1);
					$objQayadaccount->setProperty("entery_date", $entery_date);
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("transfer_mode", 1);
					$objQayadaccount->actAccountTransaction('I');
					/*******************************************************************
					/////////////////////////////////////////////////////////////////////
					********************************************************************/	
					
					if($transaction_id_Vendor != ''){
					/******************************************************************************/
					//Purchase Transaction ID linked with Order
					$objSSSjatlan->resetProperty();
					$order_tran_id = $objQayadaccount->genCode("rs_tbl_jt_order_transaction_detail", "order_tran_id");
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_tran_id", $order_tran_id);
					$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
					$objSSSjatlan->setProperty("transaction_id", $transaction_id_Vendor);
					$objSSSjatlan->setProperty("id_type", 1);
					$objSSSjatlan->setProperty("entery_date", $entery_date);
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->actOrderTransactionDetail('I');
					/******************************************************************************/
					}
					
					
					$OrderSellingPrice = 0;
					$TotalQtyOrder = 0;
				}
				
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("isActive", 1);
				$objSSSjatlan->lstOrders();
				$OrderDetail = $objSSSjatlan->dbFetchArray(1);
				
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				//Get Vehicle Head ID
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("entity_id", $OrderDetail["vechile_id"]);
				$objQayadaccount->setProperty("head_type_id", 7);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHead();
				$GetVehicleHead = $objQayadaccount->dbFetchArray(1);
				$head_id = 	$GetVehicleHead["head_id"];
				//////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////
				$objQayadaccount->resetProperty();
				$transaction_id_vehicle = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
				$objQayadaccount->setProperty("transaction_id", $transaction_id_vehicle);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_id", $GetVehicleHead["head_id"]);
				$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id_vehicle));
				$objQayadaccount->setProperty("trans_title", $TotalOrderItems.' bag delivery order has been generated.');
				$objQayadaccount->setProperty("item_qty", $TotalOrderItems);
				$objQayadaccount->setProperty("trans_note", '');
				$objQayadaccount->setProperty("trans_mode", 1);
				$objQayadaccount->setProperty("trans_type", 9);
				$objQayadaccount->setProperty("pay_mode", 8);
				$objQayadaccount->setProperty("entery_id", $GetVehicleHead["entity_id"]);
				$objQayadaccount->setProperty("trans_amount", $TotalDeliveryCharges);
				$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
				$objQayadaccount->setProperty("aplic_mode", 2);
				$objQayadaccount->setProperty("trans_status", 1);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->setProperty("transfer_mode", 1);
				$objQayadaccount->actAccountTransaction('I');
				/*******************************************************************
				/////////////////////////////////////////////////////////////////////
				********************************************************************/
				
					if($transaction_id_vehicle != ''){
					/******************************************************************************/
					//Purchase Transaction ID linked with Order
					$objSSSjatlan->resetProperty();
					$order_tran_id = $objQayadaccount->genCode("rs_tbl_jt_order_transaction_detail", "order_tran_id");
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_tran_id", $order_tran_id);
					$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
					$objSSSjatlan->setProperty("transaction_id", $transaction_id_vehicle);
					$objSSSjatlan->setProperty("id_type", 2);
					$objSSSjatlan->setProperty("entery_date", $entery_date);
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->actOrderTransactionDetail('I');
					/******************************************************************************/
					}
				
				
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				//Get Unloader Head ID
				$objQayadaccount->resetProperty();
				//$objQayadaccount->setProperty("entity_id", $OrderDetail["customer_id"]);
				$objQayadaccount->setProperty("head_type_id", 8);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHead();
				$GetUnloaderHead = $objQayadaccount->dbFetchArray(1);
				$head_id = 	$GetUnloaderHead["head_id"];
				//////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////
				$objQayadaccount->resetProperty();
				$transaction_id_Unloader = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
				$objQayadaccount->setProperty("transaction_id", $transaction_id_Unloader);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_id", $GetUnloaderHead["head_id"]);
				$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id_Unloader));
				$objQayadaccount->setProperty("trans_title", $TotalOrderItems.' bag unloading order has been generated.');
				$objQayadaccount->setProperty("item_qty", $TotalOrderItems);
				$objQayadaccount->setProperty("trans_note", '');
				$objQayadaccount->setProperty("trans_mode", 1);
				$objQayadaccount->setProperty("trans_type", 9);
				$objQayadaccount->setProperty("pay_mode", 8);
				$objQayadaccount->setProperty("entery_id", $GetUnloaderHead["entity_id"]);
				$objQayadaccount->setProperty("trans_amount", $TotalUnloadingCharges);
				$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
				$objQayadaccount->setProperty("aplic_mode", 2);
				$objQayadaccount->setProperty("trans_status", 1);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->setProperty("transfer_mode", 1);
				$objQayadaccount->actAccountTransaction('I');
				/*******************************************************************
				/////////////////////////////////////////////////////////////////////
				********************************************************************/
				
				
					if($transaction_id_Unloader != ''){
					/******************************************************************************/
					//Purchase Transaction ID linked with Order
					$objSSSjatlan->resetProperty();
					$order_tran_id = $objQayadaccount->genCode("rs_tbl_jt_order_transaction_detail", "order_tran_id");
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_tran_id", $order_tran_id);
					$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
					$objSSSjatlan->setProperty("transaction_id", $transaction_id_Unloader);
					$objSSSjatlan->setProperty("id_type", 3);
					$objSSSjatlan->setProperty("entery_date", $entery_date);
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->actOrderTransactionDetail('I');
					/******************************************************************************/
					}
				
				
				
				/******************************************************************************/
				/******************************************************************************/
				/******************************************************************************/
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("total_feright_cost", $TotalDeliveryCharges);
				$objSSSjatlan->setProperty("total_unloading_cost", $TotalUnloadingCharges);
				$objSSSjatlan->setProperty("total_order_cost", $TotalOrderCost);
				$objSSSjatlan->setProperty("total_order_sell_cost", $TotalOrderSellCost);
				$objSSSjatlan->setProperty("total_quantity_order", $TotalOrderItems);
				$objSSSjatlan->setProperty("order_status", 2);
				$objSSSjatlan->actOrders('U');
				/******************************************************************************/
				/******************************************************************************/
				/******************************************************************************/
				
					$objCommon->setMessage('Your order has been placed successfully.', 'Info');
					$link = Route::_('show=orderprocess');
					redirect($link);
				
			}
	} else {
			
/*if(isset($_GET['i']) && !empty($_GET['i']))
		$order_id = $_GET['i'];
	else if(isset($_POST['order_id']) && !empty($_POST['order_id']))
		$order_id = $_POST['order_id'];
	if(isset($order_id) && !empty($order_id)){
		$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($order_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstOrders();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}*/
if($_GET['oi'] != '' && trim($objBF->decrypt($_GET["od"], 1, ENCRYPTION_KEY)) == 'canceled'){
$RequedtedOrderId = trim($objBF->decrypt($_GET["oi"], 1, ENCRYPTION_KEY));

if($RequedtedOrderId != ''){
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_id", $RequedtedOrderId);
$objSSSjatlan->lstOrders();
$OrderDetail = $objSSSjatlan->dbFetchArray(1);

/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_id", $RequedtedOrderId);
$objSSSjatlan->setProperty("update_date", date('Y-m-d H:i:s'));
$objSSSjatlan->setProperty("isActive", 3);
$objSSSjatlan->actOrders('U');

$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("log_type", 20);
$objQayaduser->setProperty("entity_id", $RequedtedOrderId);
$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Cancel this under processing order. Order no is ". $OrderDetail["order_no"]);
$objQayaduser->actUserLog("I");
/******************************************************************************/
/******************************************************************************/
/******************************************************************************/
	
	$objCommon->setMessage('Your order has been removed successfully.', 'Info');
	$link = Route::_('show=orderprocess');
	redirect($link);			
}

}
if(isset($_GET['oi']) && !empty($_GET['oi'])){
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_id", trim(DecData($_GET['oi'], 1, $objBF)));
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->setProperty("order_status", 1);
$objSSSjatlan->lstOrders();
$OrderDetail = $objSSSjatlan->dbFetchArray(1);

$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("vechile_id", $OrderDetail["vechile_id"]);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->VehicleOrderProcess();
$VehicleDetail = $objSSSjatlan->dbFetchArray(1);	
}
	}