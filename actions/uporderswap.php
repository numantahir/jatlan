<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$order_id			= trim($_POST['order_id']);
	$order_detail_id	= trim($_POST['order_detail_id']);
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
				
				/**********************************************************************/
				/**********************************************************************/
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_detail_id", trim($objBF->decrypt($_POST['order_detail_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("order_status", 5);
				$objSSSjatlan->actOrderDetail('U');
				
				/*******************************************************************
				********************************************************************/
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_detail_id", trim($objBF->decrypt($_POST['order_detail_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->lstOrderDetail();
				$Old_OrderDetailID = $objSSSjatlan->dbFetchArray(1);
				//////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("transaction_id", $Old_OrderDetailID["transaction_no"]);
				$objQayadaccount->setProperty("isActive", 3);
				$objQayadaccount->actAccountTransaction('U');
				/*******************************************************************
				********************************************************************/
				
				
				//////////////////////////////////////////////////////////////////////////
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($_POST['roi'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("order_process_status", 1);
				$objSSSjatlan->actOrderRequestDetail('U');
				//////////////////////////////////////////////////////////////////////////
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 15);
				$objQayaduser->setProperty("entity_id", $order_detail_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Requested Order Item SWAP");
				$objQayaduser->actUserLog("I");
					
				/**********************************************************************/
				/**********************************************************************/
								
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
				$objSSSjatlan->setProperty("order_status", 2);
				$objSSSjatlan->setProperty("trans_date", date('Y-m-d H:i:s'));
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
					$objQayadaccount->setProperty("trans_note", '');
					$objQayadaccount->setProperty("trans_mode", 1);
					$objQayadaccount->setProperty("trans_type", 9);
					$objQayadaccount->setProperty("pay_mode", 8);
					$objQayadaccount->setProperty("entery_id", $order_detail_id);
					$objQayadaccount->setProperty("trans_amount", $SellingPrice);
					$objQayadaccount->setProperty("trans_date", dateFormate_10($trans_date));
					$objQayadaccount->setProperty("aplic_mode", 2);
					$objQayadaccount->setProperty("trans_status", 1);
					$objQayadaccount->setProperty("entery_date", $entery_date);
					$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("transfer_mode", 1);
					$objQayadaccount->actAccountTransaction('I');
					/*******************************************************************
					/////////////////////////////////////////////////////////////////////
					********************************************************************/
				
				
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
				
				$TotalDeliveryCharges = 0;
				$TotalUnloadingCharges = 0;
				$TotalOrderCost = 0;
				$TotalOrderSellCost = 0;
				$TotalOrderItems = 0;
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_id", trim($objBF->decrypt($_POST['order_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("isActive", 1);
				$objSSSjatlan->setProperty("order_status", 2);
				$objSSSjatlan->lstOrderDetail();
				while($OrderDetailLsit = $objSSSjatlan->dbFetchArray(1)){
					$TotalDeliveryCharges += $OrderDetailLsit["freight_price"];
					$TotalUnloadingCharges += $OrderDetailLsit["unloading_price"];
					$TotalOrderCost += $OrderDetailLsit["purchase_price"];
					$TotalOrderSellCost += $OrderDetailLsit["selling_price"];
					$TotalOrderItems += $OrderDetailLsit["order_qty"];
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
				//$objSSSjatlan->setProperty("order_status", 2);
				$objSSSjatlan->actOrders('U');
				/******************************************************************************/
				/******************************************************************************/
				/******************************************************************************/
				
					$objCommon->setMessage('Your order item swap successfully.', 'Info');
					$link = Route::_('show=uporders');
					redirect($link);
				
			}
	} else {

$RequestedOrderId = trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY));
$RequestedOrderDetailId = trim($objBF->decrypt($_GET["odi"], 1, ENCRYPTION_KEY));

$objSSSDestination = new SSSjatlan;
$objSSSCustomers = new SSSjatlan;
$objSSSProducts = new SSSjatlan;
$objSSSProductPrice = new SSSjatlan;

$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_id", $RequestedOrderId);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->lstOrders();
$OrderProcess = $objSSSjatlan->dbFetchArray(1);

$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_detail_id", $RequestedOrderDetailId);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->lstOrderDetail();
$OrderDetailInfo = $objSSSjatlan->dbFetchArray(1);

$objSSSCustomers->resetProperty();
$objSSSCustomers->setProperty("customer_id", $OrderDetailInfo["customer_id"]);
$objSSSCustomers->lstCustomers();
$CustomerInfo = $objSSSCustomers->dbFetchArray(1);

$objSSSProducts->resetProperty();
$objSSSProducts->setProperty("product_id", $OrderDetailInfo["product_id"]);
$objSSSProducts->lstProducts();
$ProductInfo = $objSSSProducts->dbFetchArray(1);

$objSSSDestination->resetProperty();
$objSSSDestination->setProperty("location_id", $OrderDetailInfo["destination_id"]);
$objSSSDestination->lstLocation();
$DestinationInfo = $objSSSDestination->dbFetchArray(1);

$objSSSProductPrice->resetProperty();
$objSSSProductPrice->setProperty("product_price_id", $OrderDetailInfo["product_price_id"]);
$objSSSProductPrice->lstProductPrice();
$ProductPriceDetail = $objSSSProductPrice->dbFetchArray(1);

$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("vechile_id", $OrderProcess["vechile_id"]);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->VehicleOrderProcess();
$VehicleDetail = $objSSSjatlan->dbFetchArray(1);

}
?>