<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$no_of_items				= trim($_POST['no_of_items']);
	$destination_id				= trim($_POST['destination_id']);
	$final_amount				= trim($_POST["final_amount"]);
	$vechile_id					= trim($_POST["vechile_id"]);
	$delivery_chagres_pbag		= trim($_POST['delivery_chagres']);
	$delivery_required_date		= trim($_POST['delivery_required_date']);
	$extra_note					= trim($_POST["extra_note"]);
	$d_invoice_no				= trim($_POST["d_invoice_no"]);
	$d_date						= trim($_POST["d_date"]);
	$da_date_convert			= $d_date.' '.date('H:i:s');
	$TransactionCode			= date("md").rand(1,9).rand(99,999);
	
	$pay_mode					= trim($_POST["pay_mode"]);
	$transfer_head_id			= trim($_POST["transfer_head_id"]);
	$trans_title				= trim($_POST["trans_title"]);
	$trans_note					= trim($_POST["trans_note"]);
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	
	$objValidate->setArray($_POST);
	//$objValidate->setCheckField("customer_id", 'Customer Selection' . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("product_id", 'Product Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("no_of_items", 'No of Items' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("destination_id", 'Destination Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("delivery_chagres", 'Delivery Charges' . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("unloading_price", 'Unloading Charges' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$delivery_chagres = $delivery_chagres_pbag * $no_of_items;
				//$unloading_price = $unloading_price_pbag * $no_of_items;
				
				/*$delivery_chagres = $delivery_chagres_pbag;
				$unloading_price = $unloading_price_pbag;*/
				
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
				
				//$objSSSjatlan->setProperty("customer_id", $customer_id);
				//$objSSSjatlan->setProperty("product_id", $product_id);
				
				$objSSSjatlan->setProperty("per_item_amount", $selling_price);
				$objSSSjatlan->setProperty("final_amount", $final_amount);
				
				
				$objSSSjatlan->setProperty("no_of_items", $no_of_items);
				$objSSSjatlan->setProperty("destination_id", $destination_id);
				//$objSSSjatlan->setProperty("vendor_id", $GetProductVendorId["vendor_id"]);
				$objSSSjatlan->setProperty("vehicle_id", $vechile_id);
				$objSSSjatlan->setProperty("delivery_chagres", $delivery_chagres);
				//$objSSSjatlan->setProperty("unloading_price", $unloading_price);
				$objSSSjatlan->setProperty("delivery_required_date", $delivery_required_date);
				$objSSSjatlan->setProperty("order_process_status", 1);
				$objSSSjatlan->setProperty("replace_order_status", 1);
				$objSSSjatlan->setProperty("order_delivery_status", 1);
				$objSSSjatlan->setProperty("order_request_type", 3);
				$objSSSjatlan->setProperty("request_order_no", CreateOrderRequestNo($order_request_id));
				
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				
				//$objSSSjatlan->setProperty("cof_no", $cof_no);
				$objSSSjatlan->setProperty("d_invoice_no", $d_invoice_no);
				$objSSSjatlan->setProperty("d_date", $d_date);
				$objSSSjatlan->setProperty("order_status", 1);
				$objSSSjatlan->setProperty("extra_note", $extra_note);
				$objSSSjatlan->setProperty("tran_code", $TransactionCode);
				if($objSSSjatlan->actOrderRequestDetail($mode)){
				
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
						
						if($d_date != ''){
							$TransactionDateProcess = $d_date;
						} else {
							$TransactionDateProcess = date('Y-m-d');
						}
						
						
				
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				//Get Vehicle Head ID
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("entity_id", $vechile_id);
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
				$objQayadaccount->setProperty("trans_title", $no_of_items.' Items order has been delivered.');
				$objQayadaccount->setProperty("item_qty", $no_of_items);
				$objQayadaccount->setProperty("trans_note", '');
				$objQayadaccount->setProperty("trans_mode", 1);
				$objQayadaccount->setProperty("trans_type", 9);
				//$objQayadaccount->setProperty("pay_mode", 9);
				$objQayadaccount->setProperty("entery_id", $GetVehicleHead["head_id"]);
				$objQayadaccount->setProperty("trans_amount", $delivery_chagres);
				$objQayadaccount->setProperty("trans_date",$TransactionDateProcess);
				//$objQayadaccount->setProperty("aplic_mode", 8);
				$objQayadaccount->setProperty("aplic_mode", 6);
				$objQayadaccount->setProperty("pay_mode", $pay_mode);
				$objQayadaccount->setProperty("trans_status", 1);
				$objQayadaccount->setProperty("location_id", $vechile_id);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", 1);
				
				$objQayadaccount->setProperty("transfer_head_id", trim($objBF->decrypt($transfer_head_id, 1, ENCRYPTION_KEY)));
					
					
				$objQayadaccount->setProperty("transfer_mode", 1);
				$objQayadaccount->setProperty("tran_code", $TransactionCode);
				$objQayadaccount->actAccountTransaction('I');
				
							
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				/////////////////////////////////////////////////////////////////////
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				$objQayadaccount->resetProperty();
				$transaction_id_new = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
				$objQayadaccount->setProperty("transaction_id", $transaction_id_new);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_id", trim($objBF->decrypt($transfer_head_id, 1, ENCRYPTION_KEY)));
				//$objQayadaccount->setProperty("item_id", trim($objBF->decrypt($transfer_item_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id_vehicle));
				$objQayadaccount->setProperty("trans_title", $trans_title);
				$objQayadaccount->setProperty("trans_note", $trans_note);
				$objQayadaccount->setProperty("trans_mode", 2);
				$objQayadaccount->setProperty("trans_type", 1);
				$objQayadaccount->setProperty("aplic_mode", 4);
				$objQayadaccount->setProperty("pay_mode", $pay_mode);
				$objQayadaccount->setProperty("pay_mode_no", $payment_mode_no);
				$objQayadaccount->setProperty("entery_id", $GetVehicleHead["head_id"]);
				$objQayadaccount->setProperty("trans_amount", $delivery_chagres);
				$objQayadaccount->setProperty("trans_date", $TransactionDateProcess);
				$objQayadaccount->setProperty("trans_status", 1);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->setProperty("transfer_head_id", $GetVehicleHead["head_id"]);
				$objQayadaccount->setProperty("transfer_mode", 1);
				//$objQayadaccount->setProperty("location_id", $objQayaduser->location_id);
				$objQayadaccount->setProperty("trans_position", 2);
				$objQayadaccount->setProperty("tran_code", $TransactionCode);
				$objQayadaccount->actAccountTransaction('I');
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				/////////////////////////////////////////////////////////////////////
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/	
					
					
					
					
					
					
					
					
					
					
					
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 25);
				$objQayaduser->setProperty("entity_id", $order_request_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." New Outside Order Create for Vendor -> (". CreateOrderRequestNo($order_request_id) .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Outside Order Request of -> (". CreateOrderRequestNo($order_request_id) .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('New Outside Order Request information has been saved successfully.', 'Info');
						$link = Route::_('show=outsideorder');
						redirect($link);
				}
				
			}
	} else {
			
if($_GET["i"] != "" && trim($objBF->decrypt($_GET["ac"], 1, ENCRYPTION_KEY)) == 'ordercomplete'){
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("order_status", 2);
				if($objSSSjatlan->actOrderRequestDetail('U')){
					
					$objCommon->setMessage('Select Order information has been updated successfully.', 'Info');
					$link = Route::_('show=outsideorder');
					redirect($link);
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
}