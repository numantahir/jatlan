<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$from_customer_id			= trim($_POST['from_customer_id']);
	$to_customer_id				= trim($_POST['to_customer_id']);
	$product_id					= trim($_POST['product_id']);
	$no_of_items				= trim($_POST['no_of_items']);
	$destination_id				= trim($_POST['destination_id']);
	$final_amount				= trim($_POST["final_amount"]);
	
	$to_final_amount			= trim($_POST["to_final_amount"]);
	
	
	$vehicle_id					= trim($_POST["vehicle_id"]);
	$delivery_chagres			= trim($_POST['delivery_chagres']);
	$unloading_price			= trim($_POST['unloading_price']);
	$delivery_required_date		= trim($_POST['delivery_required_date']);
	$selling_price				= trim($_POST["selling_price"]);
	$to_selling_price			= trim($_POST["to_selling_price"]);
	$d_date						= trim($_POST["d_date"]);
	$TransactionCode			= date("md").rand(1,9).rand(99,999);
	
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("from_customer_id", 'From Customer Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("to_customer_id", 'To Customer Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("product_id", 'Product Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("no_of_items", 'No of Items' . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("destination_id", 'Destination Selection' . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("delivery_chagres", 'Delivery Charges' . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("unloading_price", 'Unloading Charges' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				/*$objSSSGetProductVendorID = new SSSjatlan;
				$objSSSGetProductVendorID->resetProperty();
				$objSSSGetProductVendorID->setProperty("product_id", $product_id);
				$objSSSGetProductVendorID->setProperty("isActive", 1);
				$objSSSGetProductVendorID->lstProducts();
				$GetProductVendorId = $objSSSGetProductVendorID->dbFetchArray(1);	*/
							
				$objSSSjatlan->resetProperty();
				$cc_order_request_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['cc_order_request_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_customer_contra_order_detail", "cc_order_request_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("cc_order_request_id", $cc_order_request_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				
				$objSSSjatlan->setProperty("from_customer_id", $from_customer_id);
				$objSSSjatlan->setProperty("to_customer_id", $to_customer_id);
				
				$objSSSjatlan->setProperty("product_id", $product_id);
				
				$objSSSjatlan->setProperty("per_item_amount", $selling_price);
				$objSSSjatlan->setProperty("to_per_item_amount", $to_selling_price);
				
				$objSSSjatlan->setProperty("final_amount", $final_amount);
				$objSSSjatlan->setProperty("to_final_amount", $to_final_amount);
				
				
				$objSSSjatlan->setProperty("no_of_items", $no_of_items);
				$objSSSjatlan->setProperty("destination_id", $destination_id);
				$objSSSjatlan->setProperty("vehicle_id", $vehicle_id);
				$objSSSjatlan->setProperty("delivery_chagres", $delivery_chagres);
				$objSSSjatlan->setProperty("unloading_price", $unloading_price);
				$objSSSjatlan->setProperty("delivery_required_date", $delivery_required_date);
				$objSSSjatlan->setProperty("order_process_status", 1);
				$objSSSjatlan->setProperty("replace_order_status", 1);
				$objSSSjatlan->setProperty("order_delivery_status", 1);
				$objSSSjatlan->setProperty("order_request_type", 1);
				$objSSSjatlan->setProperty("request_order_no", CreateOrderRequestNo($cc_order_request_id));
				$objSSSjatlan->setProperty("d_date", $d_date);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				$objSSSjatlan->setProperty("tran_code", $TransactionCode);
				if($objSSSjatlan->actCustomerContraOrderDetail($mode)){
				
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
						// From Customer
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("entity_id", $from_customer_id);
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
						$objQayadaccount->setProperty("trans_mode", 2);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $cc_order_request_id);
						$objQayadaccount->setProperty("trans_amount", $final_amount);
						$objQayadaccount->setProperty("trans_date", $d_date);
						$objQayadaccount->setProperty("aplic_mode", 4);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						//$objSSSjatlan->setProperty("trans_date", date('Y-m-d H:i:s'));
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("tran_code", $TransactionCode);
						$objQayadaccount->actAccountTransaction('I');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						
						
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						// To Customer
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("entity_id", $to_customer_id);
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
						$objQayadaccount->setProperty("entery_id", $cc_order_request_id);
						$objQayadaccount->setProperty("trans_amount", $to_final_amount);
						$objQayadaccount->setProperty("trans_date", $d_date);
						$objQayadaccount->setProperty("aplic_mode", 5);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						//$objSSSjatlan->setProperty("trans_date", date('Y-m-d H:i:s'));
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("tran_code", $TransactionCode);
						$objQayadaccount->actAccountTransaction('I');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
				
				
				
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 23);
				$objQayaduser->setProperty("entity_id", $cc_order_request_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." New Order Create for Customer -> (". CreateOrderRequestNo($cc_order_request_id) .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Order Request of -> (". CreateOrderRequestNo($cc_order_request_id) .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('New Order Request information has been saved successfully.', 'Info');
						$link = Route::_('show=customercontra');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$cc_order_request_id = $_GET['i'];
	else if(isset($_POST['cc_order_request_id']) && !empty($_POST['cc_order_request_id']))
		$cc_order_request_id = $_POST['cc_order_request_id'];
	if(isset($cc_order_request_id) && !empty($cc_order_request_id)){
		$objSSSjatlan->setProperty("cc_order_request_id", trim($objBF->decrypt($cc_order_request_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstOrderRequestDetail();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}