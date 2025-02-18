<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$customer_id				= trim($_POST['customer_id']);
	$product_id_detail			= trim($_POST['product_id']);
	$no_of_items				= trim($_POST['no_of_items']);
	$destination_id				= trim($_POST['destination_id']);
	$final_amount				= trim($_POST["final_amount"]);
	$vechile_id					= trim($_POST["vechile_id"]);
	$delivery_chagres			= trim($_POST['delivery_chagres']);
	$unloading_price			= trim($_POST['unloading_price']);
	$delivery_required_date		= trim($_POST['delivery_required_date']);
	$selling_price				= trim($_POST["selling_price"]);
	$unloading_option			= trim($_POST["unloading_option"]);
	$d_date						= trim($_POST["d_date"]);
	$TransactionCode			= date("md").rand(1,9).rand(99,999);
	$objOrderCenter	 			= new SSSjatlan;
	/*
	Customer
	800 -> Credit
	Driver
	800 -> Debit
	*/
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("customer_id", 'Customer Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("product_id", 'Product Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("no_of_items", 'No of Items' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("destination_id", 'Destination Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("delivery_chagres", 'Delivery Charges' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("unloading_price", 'Unloading Charges' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		
				
				//$objOrderCenter
				//actOrderCenterArea
				$objOrderCenter->resetProperty();
				$objOrderCenter->setProperty("order_type", 1);
				$objOrderCenter->setProperty("unloader_option", $unloading_option);
				/*$delivery_chagres = $delivery_chagres_pbag;
				$unloading_price = $unloading_price_pbag;*/
				
				//$delivery_chagres = $delivery_chagres_pbag * $no_of_items;
				//$unloading_price = $unloading_price_pbag * $no_of_items;
				
				/*$delivery_chagres = $delivery_chagres_pbag;
				$unloading_price = $unloading_price_pbag;*/
				$CalculateUnloaderFinalAmount = $no_of_items * $unloading_price;
				$FinalRemainingAmount = $final_amount - $CalculateUnloaderFinalAmount;
				
				$FinalChargestoCustomer = $FinalRemainingAmount;
				list($Purchase_id,$product_id)=explode('-',$product_id_detail);
				$objSSSGetProductVendorID = new SSSjatlan;
				$objSSSGetProductVendorID->resetProperty();
				$objSSSGetProductVendorID->setProperty("product_id", $product_id);
				$objSSSGetProductVendorID->setProperty("isActive", 1);
				$objSSSGetProductVendorID->lstProducts();
				$GetProductVendorId = $objSSSGetProductVendorID->dbFetchArray(1);	
							
				$objSSSjatlan->resetProperty();
				$order_request_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['order_request_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_order_request_detail", "order_request_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_request_id", $order_request_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				
				$objSSSjatlan->setProperty("customer_id", $customer_id);
				$objSSSjatlan->setProperty("product_id", $product_id);
				$objSSSjatlan->setProperty("purchase_id", $Purchase_id);
				$objSSSjatlan->setProperty("per_item_amount", $selling_price);
				$objSSSjatlan->setProperty("final_amount", $final_amount);
				
				
				$objSSSjatlan->setProperty("no_of_items", $no_of_items);
				$objSSSjatlan->setProperty("destination_id", $destination_id);
				$objSSSjatlan->setProperty("vendor_id", $GetProductVendorId["vendor_id"]);
				$objSSSjatlan->setProperty("vehicle_id", $vechile_id);
				$objSSSjatlan->setProperty("delivery_chagres", $delivery_chagres);
				$objSSSjatlan->setProperty("unloading_price", $unloading_price);
				$objSSSjatlan->setProperty("delivery_required_date", $delivery_required_date);
				$objSSSjatlan->setProperty("order_process_status", 1);
				$objSSSjatlan->setProperty("replace_order_status", 1);
				$objSSSjatlan->setProperty("order_delivery_status", 1);
				$objSSSjatlan->setProperty("order_request_type", 1);
				$objSSSjatlan->setProperty("request_order_no", CreateOrderRequestNo($order_request_id));
				$objSSSjatlan->setProperty("d_date", $d_date);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				$objSSSjatlan->setProperty("tran_code", $TransactionCode);
				if($objSSSjatlan->actOrderRequestDetail($mode)){
				
					
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_request_id", $Purchase_id);
					$objSSSjatlan->setProperty("update_remaining_qty", $no_of_items);
					$objSSSjatlan->actOrderRequestDetail('U');
				
					$objOrderCenter->setProperty("order_id", $order_request_id);
					$objOrderCenter->setProperty("purchase_id", $Purchase_id);
					$objOrderCenter->setProperty("order_code", $TransactionCode);
				
				
				
						if($delivery_chagres > 0){
							$AddDeliverChargesTitle = '<code>D/Chagres Rs.'.$delivery_chagres.'</code>';
						} else {
							$AddDeliverChargesTitle = '';
						}
						if($unloading_price > 0){
							$AddUnloadingChargesTitle = ' <code>U/Chagres Rs.'.$unloading_price.'</code>';
						} else {
							$AddUnloadingChargesTitle = '';
						}
						$FinalExtraNote = $AddDeliverChargesTitle.''.$AddUnloadingChargesTitle;
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("entity_id", $customer_id);
						$objQayadaccount->setProperty("head_type_id", 4);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->lstHead();
						$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
						$head_id = 	$GetCustomerHead["head_id"];
						//////////////////////////////////////////////////////////////////////
						$objSSSjatlan->resetProperty();
						$objSSSjatlan->setProperty("product_id", $product_id);
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
						//$objQayadaccount->setProperty("trans_title", $GetProductDetail["product_name"].' order has been delivered.');
						$objQayadaccount->setProperty("trans_title", $GetProductDetail["product_name"]);
						$objQayadaccount->setProperty("trans_note", '');
						$objQayadaccount->setProperty("item_qty", $no_of_items);
						$objQayadaccount->setProperty("trans_mode", 1);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $order_request_id);
						$objQayadaccount->setProperty("trans_amount", $FinalRemainingAmount);
						//$objQayadaccount->setProperty("trans_amount", $final_amount);
						$objQayadaccount->setProperty("trans_date", $d_date);
						$objQayadaccount->setProperty("aplic_mode", 2);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						//$objSSSjatlan->setProperty("trans_date", date('Y-m-d H:i:s'));
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("tran_code", $TransactionCode);
						$objQayadaccount->actAccountTransaction('I');
						$objOrderCenter->setProperty("order_tran_id", $transaction_id);
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						if($unloading_option == 1){
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$CalculateUnloadingAmount = $no_of_items * $unloading_price;
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
						$objQayadaccount->setProperty("trans_title", $no_of_items.' bag unloading order has been delivered.');
						$objQayadaccount->setProperty("item_qty", $no_of_items);
						$objQayadaccount->setProperty("trans_note", '');
						$objQayadaccount->setProperty("trans_mode", 1);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $GetUnloaderHead["head_id"]);
						$objQayadaccount->setProperty("trans_amount", $CalculateUnloadingAmount);
						$objQayadaccount->setProperty("trans_date", $d_date);
						$objQayadaccount->setProperty("aplic_mode", 2);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						$objQayadaccount->setProperty("location_id", $vechile_id);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("tran_code", $TransactionCode);
						$objQayadaccount->actAccountTransaction('I');
						$objOrderCenter->setProperty("unloader_tran_id", $transaction_id_Unloader);
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						} elseif($unloading_option == 2){
						$CalculateUnloadingAmount = $no_of_items * $unloading_price;
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$objQayadaccount->resetProperty();
						$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
						$objQayadaccount->setProperty("transaction_id", $transaction_id);
						$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayadaccount->setProperty("head_id", $GetCustomerHead["head_id"]);
						$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
						//$objQayadaccount->setProperty("trans_title", $GetProductDetail["product_name"].' order has been delivered.');
						$objQayadaccount->setProperty("trans_title", 'Unloading Amount by Client Side.');
						$objQayadaccount->setProperty("trans_note", '');
						$objQayadaccount->setProperty("item_qty", $no_of_items);
						$objQayadaccount->setProperty("trans_mode", 2);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $order_request_id);
						$objQayadaccount->setProperty("trans_amount", $CalculateUnloadingAmount);
						$objQayadaccount->setProperty("trans_date", $d_date);
						$objQayadaccount->setProperty("aplic_mode", 9);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						//$objSSSjatlan->setProperty("trans_date", date('Y-m-d H:i:s'));
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("tran_code", $TransactionCode);
						$objQayadaccount->actAccountTransaction('I');
						$objOrderCenter->setProperty("unloader_tran_id", $transaction_id);
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						} elseif($unloading_option == 3){
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$CalculateUnloadingAmount = $no_of_items * $unloading_price;
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("entity_id", $vechile_id);
						$objQayadaccount->setProperty("head_type_id", 7);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->lstHead();
						$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
						$head_id = 	$GetCustomerHead["head_id"];
						//////////////////////////////////////////////////////////////////////
						$objSSSjatlan->resetProperty();
						$objSSSjatlan->setProperty("product_id", $product_id);
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
						//$objQayadaccount->setProperty("trans_title", $GetProductDetail["product_name"].' order has been delivered.');
						$objQayadaccount->setProperty("trans_title", $GetProductDetail["product_name"].' Unloading amount paid by Driver.');
						$objQayadaccount->setProperty("trans_note", '');
						$objQayadaccount->setProperty("item_qty", $no_of_items);
						$objQayadaccount->setProperty("trans_mode", 1);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $order_request_id);
						$objQayadaccount->setProperty("trans_amount", $CalculateUnloadingAmount);
						$objQayadaccount->setProperty("trans_date", $d_date);
						$objQayadaccount->setProperty("aplic_mode", 10);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						//$objSSSjatlan->setProperty("trans_date", date('Y-m-d H:i:s'));
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("tran_code", $TransactionCode);
						$objQayadaccount->actAccountTransaction('I');
						$objOrderCenter->setProperty("unloader_tran_id", $transaction_id);
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						}
						
						$objOrderCenter->actOrderCenterArea('I');
				
				
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 12);
				$objQayaduser->setProperty("entity_id", $order_request_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." New Order Create for Customer -> (". CreateOrderRequestNo($order_request_id) .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Order Request of -> (". CreateOrderRequestNo($order_request_id) .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('New Order Request information has been saved successfully.', 'Info');
						if($mode == 'I'){
							$link = Route::_('show=orderrequestform');
						} else {
						$link = Route::_('show=orderrequest');
						}
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$order_request_id = $_GET['i'];
	else if(isset($_POST['order_request_id']) && !empty($_POST['order_request_id']))
		$order_request_id = $_POST['order_request_id'];
	if(isset($order_request_id) && !empty($order_request_id)){
		$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($order_request_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstOrderRequestDetail();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}