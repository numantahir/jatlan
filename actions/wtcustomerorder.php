<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["area"] == 'search'){
	
	$order_tran_code				= trim($_POST["order_tran_code"]);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("order_tran_code", 'Order Transaction Code ' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		
			$objSSSCountTransactionRec = new SSSjatlan;
			$objSSSCountTransactionRec->resetProperty();
			$objSSSCountTransactionRec->setProperty("order_code", $order_tran_code);
			$objSSSCountTransactionRec->setProperty("order_type", 1);
			// $objSSSCountTransactionRec->setProperty("isActive", 1);
			$objSSSCountTransactionRec->lstOrderCenterArea();
			if($objSSSCountTransactionRec->totalRecords() > 0){
			$GetProductVendorId = $objSSSCountTransactionRec->dbFetchArray(1);	
				
				$link = Route::_('show=wtcustomerorder&lod=sec&tr='.EncData($GetProductVendorId["order_center_id"], 2, $objBF).'&i='.$GetProductVendorId["order_id"]);
						redirect($link);
				
			} else {
				
				$objCommon->setMessage('Order Transaction Code Invalid Please check your Order code', 'Error');
						$link = Route::_('show=wtcustomerorder');
						redirect($link);
				
			}	
	}
}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["area"] == 'act'){
	
	// $trans_code					= trim($_POST['tr']);
	$order_center_id			= trim($_POST["order_center_id"]);
	$order_tran_id				= trim($_POST['order_tran_id']);
	$unloader_tran_id			= trim($_POST['unloader_tran_id']);
	$main_order_id				= trim($_POST['ord_id']);
	$no_of_items				= trim($_POST["no_of_items"]);
	$selling_price				= trim($_POST["selling_price"]);
	$unloading_price			= trim($_POST['unloading_price']);
	$delivery_chagres			= trim($_POST['delivery_chagres']);
	$final_amount				= trim($_POST["final_amount"]);
	$unloading_option			= trim($_POST["unloading_option"]);

	
	// print_r($_POST);
	// die();
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("selling_price", 'Selling Price' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){

				
				$CalculateUnloaderFinalAmount = $no_of_items * $unloading_price;
				$FinalRemainingAmount = $final_amount - $CalculateUnloaderFinalAmount;
				
				$FinalChargestoCustomer = $FinalRemainingAmount;
							
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("order_request_id", $main_order_id);
				$objSSSjatlan->setProperty("per_item_amount", $selling_price);
				$objSSSjatlan->setProperty("final_amount", $final_amount);
				$objSSSjatlan->setProperty("delivery_chagres", $delivery_chagres);
				$objSSSjatlan->setProperty("unloading_price", $unloading_price);
				if($objSSSjatlan->actOrderRequestDetail('U')){
				
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("transaction_id", $order_tran_id);
						$objQayadaccount->setProperty("trans_amount", $FinalRemainingAmount);
						$objQayadaccount->actAccountTransaction('U');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						if($unloading_option == 1){
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$CalculateUnloadingAmount = $no_of_items * $unloading_price;
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("transaction_id", $unloader_tran_id);
						$objQayadaccount->setProperty("trans_amount", $CalculateUnloadingAmount);
						$objQayadaccount->actAccountTransaction('U');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						} elseif($unloading_option == 2){
						$CalculateUnloadingAmount = $no_of_items * $unloading_price;
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("transaction_id", $unloader_tran_id);
						$objQayadaccount->setProperty("trans_amount", $CalculateUnloadingAmount);
						$objQayadaccount->actAccountTransaction('U');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						} elseif($unloading_option == 3){
						/*******************************************************************
						\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
						********************************************************************/
						$CalculateUnloadingAmount = $no_of_items * $unloading_price;
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("transaction_id", $unloader_tran_id);
						$objQayadaccount->setProperty("trans_amount", $CalculateUnloadingAmount);
						$objQayadaccount->actAccountTransaction('U');
						/*******************************************************************
						/////////////////////////////////////////////////////////////////////
						********************************************************************/
						}
					}

		
		$objCommon->setMessage('Order amunt modification has been saved successfully.', 'Info');
						$link = Route::_('show=wtcustomerorder');
						redirect($link);
		
	}
}
if($_GET["lod"]=="sec" && trim(DecData($_GET["tr"], 1, $objBF)) != ''){
	// echo trim(DecData($_GET["i"], 1, $objBF));
	// die();
	$objSSSCountTransactionRec = new SSSjatlan;
	$objSSSCountTransactionRec->resetProperty();
	$objSSSCountTransactionRec->setProperty("order_center_id", trim(DecData($_GET["tr"], 1, $objBF)));
	$objSSSCountTransactionRec->lstOrderCenterArea();
	$GetOrderCenterArea = $objSSSCountTransactionRec->dbFetchArray(1);	


$objSSSCountTransactionRec->resetProperty();
$objSSSCountTransactionRec->setProperty("order_request_id", trim($_GET["i"]));
$objSSSCountTransactionRec->setProperty("isActive", 1);
$objSSSCountTransactionRec->lstOrderRequestDetail();
$GetOrderRequest = $objSSSCountTransactionRec->dbFetchArray(1);	

				
}