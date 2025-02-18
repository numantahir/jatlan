<?php
/*echo trim($objBF->decrypt($_GET['apm'], 1, ENCRYPTION_KEY)).'<br>';
echo trim($objBF->decrypt($_GET['ori'], 1, ENCRYPTION_KEY)).'<br>';
list($ExtraText, $OrderRequestID)= explode('-', trim($objBF->decrypt($_GET['ori'], 1, ENCRYPTION_KEY)));
echo $OrderRequestID;
die();*/

$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$order_request_id			= trim($_POST['order_request_id']);
	$vo_date					= trim($_POST['vo_date']);
	//$head_id					= trim($_POST['head_id']);
	$option_type				= trim($_POST['option_type']);
	$exp_amount					= trim($_POST["exp_amount"]);
	$exp_detail					= trim($_POST["exp_detail"]);
	$quantity_detail			= trim($_POST["quantity_detail"]);
	$head_type_id				= trim($objBF->decrypt($_POST['hti'], 1, ENCRYPTION_KEY));
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	//$objValidate->setCheckField("customer_id", 'Customer Selection' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("exp_amount", 'Amount' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_id", trim($objBF->decrypt($_POST['head_id'], 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("ORDERBY", 'head_title');
					$objQayadaccount->lstHead();
					$RequestedHeadID = $objQayadaccount->dbFetchArray(1);
					
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($_POST['order_request_id'], 1, ENCRYPTION_KEY)));
					$objSSSjatlan->lstOrderRequestDetail();
					$OrderRequest = $objSSSjatlan->dbFetchArray(1);

				$objSSSjatlan->resetProperty();
				$vendor_exp_detail_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['vendor_exp_detail_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_vehicle_exp_supplier_trans", "vendor_exp_detail_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("vendor_exp_detail_id", $vendor_exp_detail_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("vendor_exp_id", $RequestedHeadID["entity_id"]);
				$objSSSjatlan->setProperty("option_type", trim($objBF->decrypt($_POST['option_type'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($_POST['order_request_id'], 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("exp_detail", $exp_detail);
				$objSSSjatlan->setProperty("exp_amount", $exp_amount);
				$objSSSjatlan->setProperty("exp_date", $vo_date);
				$objSSSjatlan->setProperty("quantity_detail", $quantity_detail);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				$objSSSjatlan->setProperty("tran_code", $OrderRequest["tran_code"]);
				if($objSSSjatlan->actVehicleExpSupplierTrans($mode)){
				
						//Vendor Transaction
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("entity_id", $RequestedHeadID["entity_id"]);
						$objQayadaccount->setProperty("head_type_id", $head_type_id);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->lstHead();
						$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
						$head_id = 	$GetCustomerHead["head_id"];
						//////////////////////////////////////////////////////////////////////
						//////////////////////////////////////////////////////////////////////
						$objQayadaccount->resetProperty();
						$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
						$CreateTransactionNumber = CreateTransactionNumber($transaction_id);
						$objQayadaccount->setProperty("transaction_id", $transaction_id);
						$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayadaccount->setProperty("head_id", $GetCustomerHead["head_id"]);
						$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
						$objQayadaccount->setProperty("trans_title", $exp_detail);
						$objQayadaccount->setProperty("trans_note", '');
						$objQayadaccount->setProperty("item_qty", $quantity_detail);
						$objQayadaccount->setProperty("trans_mode", 1);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $OrderRequest["vehicle_id"]);
						$objQayadaccount->setProperty("trans_amount", $exp_amount);
						//$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
						$objQayadaccount->setProperty("aplic_mode", 2);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						$objQayadaccount->setProperty("trans_date", $vo_date);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("location_id", trim($objBF->decrypt($_POST['order_request_id'], 1, ENCRYPTION_KEY)));
						$objQayadaccount->setProperty("tran_code", $OrderRequest["tran_code"]);
						$objQayadaccount->actAccountTransaction('I');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						
						
						
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("entity_id", $OrderRequest["vehicle_id"]);
						$objQayadaccount->setProperty("head_type_id", 7);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->lstHead();
						$GetVehicleHeadId = $objQayadaccount->dbFetchArray(1);
						//$head_id = 	$GetCustomerHead["head_id"];
						//////////////////////////////////////////////////////////////////////
						//////////////////////////////////////////////////////////////////////
						$objQayadaccount->resetProperty();
						$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
						$objQayadaccount->setProperty("transaction_id", $transaction_id);
						$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayadaccount->setProperty("head_id", $GetVehicleHeadId["head_id"]);
						$objQayadaccount->setProperty("transaction_number", $CreateTransactionNumber);
						$objQayadaccount->setProperty("trans_title", $exp_detail);
						$objQayadaccount->setProperty("trans_note", '');
						$objQayadaccount->setProperty("item_qty", $quantity_detail);
						$objQayadaccount->setProperty("trans_mode", 2);
						$objQayadaccount->setProperty("trans_type", 9);
						$objQayadaccount->setProperty("pay_mode", 8);
						$objQayadaccount->setProperty("entery_id", $OrderRequest["vehicle_id"]);
						$objQayadaccount->setProperty("trans_amount", $exp_amount);
						//$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
						$objQayadaccount->setProperty("aplic_mode", 2);
						$objQayadaccount->setProperty("trans_status", 1);
						$objQayadaccount->setProperty("entery_date", $entery_date);
						$objQayadaccount->setProperty("trans_date", $vo_date);
						$objQayadaccount->setProperty("isActive", 1);
						$objQayadaccount->setProperty("transfer_mode", 1);
						$objQayadaccount->setProperty("location_id", trim($objBF->decrypt($_POST['order_request_id'], 1, ENCRYPTION_KEY)));
						$objQayadaccount->setProperty("tran_code", $OrderRequest["tran_code"]);
						$objQayadaccount->actAccountTransaction('I');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						
						
			
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 22);
				$objQayaduser->setProperty("entity_id", trim($objBF->decrypt($_POST['order_request_id'], 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." New Supplier Expense of -> (". CreateOrderRequestNo($vendor_exp_detail_id) .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Supplier Expense  of -> (". CreateOrderRequestNo($vendor_exp_detail_id) .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('New Supplier Expense information has been saved successfully.', 'Info');
						$link = Route::_('show=outsideexpns&i='.EncData(trim($objBF->decrypt($_POST['order_request_id'], 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$order_request_id = $_GET['i'];
	else if(isset($_POST['vendor_exp_detail_id']) && !empty($_POST['vendor_exp_detail_id']))
		$vendor_exp_detail_id = $_POST['vendor_exp_detail_id'];
	if(isset($vendor_exp_detail_id) && !empty($vendor_exp_detail_id)){
		$objSSSjatlan->setProperty("vendor_exp_detail_id", trim($objBF->decrypt($vendor_exp_detail_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstVehicleExpSupplierTrans();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}
list($ExtraText, $OrderRequestID)= explode('-', trim($objBF->decrypt($_GET['ori'], 1, ENCRYPTION_KEY)));

if(trim($objBF->decrypt($_GET['apm'], 1, ENCRYPTION_KEY)) == 2){
$HeadTypeId = "10";
$MainTitle = 'Diesel Expense';
$VendorExpendOptionType = "1";
} elseif(trim($objBF->decrypt($_GET['apm'], 1, ENCRYPTION_KEY)) == 3){
$HeadTypeId = "11";
$MainTitle = 'Mobil Oil Expense';
$VendorExpendOptionType = "2";
} elseif(trim($objBF->decrypt($_GET['apm'], 1, ENCRYPTION_KEY)) == 4){
$HeadTypeId = "12";
$MainTitle = 'Tyre Expense';
$VendorExpendOptionType = "3";
}

$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
$objSSSjatlan->lstOrderRequestDetail();
$OrderRequest = $objSSSjatlan->dbFetchArray(1);