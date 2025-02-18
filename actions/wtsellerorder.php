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
			// $objSSSCountTransactionRec->setProperty("order_request_type", 2);
			$objSSSCountTransactionRec->setProperty("isActive", 1);
			$objSSSCountTransactionRec->lstOrderCenterArea();
			if($objSSSCountTransactionRec->totalRecords() > 0){
			$GetProductVendorId = $objSSSCountTransactionRec->dbFetchArray(1);	
				
				$link = Route::_('show=wtsellerorder&lod=sec&tr='.EncData($GetProductVendorId["order_center_id"], 2, $objBF).'&i='.$GetProductVendorId["order_id"]);
						redirect($link);
				
			} else {
				
				$objCommon->setMessage('Order Transaction Code Invalid Please check your Order code', 'Error');
						$link = Route::_('show=wtsellerorder');
						redirect($link);
				
			}	
	}
}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["area"] == 'act'){
	
	$order_center_id			= trim($_POST["order_center_id"]);
	$order_tran_id				= trim($_POST['order_tran_id']);
	$vechile_tran_id			= trim($_POST['vechile_tran_id']);
	$main_order_id				= trim($_POST['ord_id']);
	$no_of_items				= trim($_POST["no_of_items"]);
	$selling_price				= trim($_POST["selling_price"]);
	$cof_no						= trim($_POST['cof_no']);
	$delivery_chagres_pbag		= trim($_POST['delivery_chagres']);
	$d_invoice_no				= trim($_POST["d_invoice_no"]);
	$destination_id				= trim($_POST["destination_id"]);
	$final_amount				= trim($_POST["final_amount"]);

	$transferamount_opt			= trim($_POST["transferamount_opt"]);
	$trans_id_vehicle_second	= trim($_POST["trans_id_vehicle_second"]);
	$trans_id_vehicle_one		= trim($_POST["trans_id_vehicle_one"]);

	// print_r($_POST);
	// die();
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("selling_price", 'Selling Price' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		



		$delivery_chagres = $delivery_chagres_pbag * $no_of_items;
		// $unloading_price = $unloading_price_pbag * $no_of_items;
		
	
		$objSSSjatlan->resetProperty();
		$objSSSjatlan->setProperty("order_request_id", $main_order_id);

		$objSSSjatlan->setProperty("per_item_amount", $selling_price);
		$objSSSjatlan->setProperty("final_amount", $final_amount);
		$objSSSjatlan->setProperty("destination_id", $destination_id);
		$objSSSjatlan->setProperty("delivery_chagres", $delivery_chagres);
		$objSSSjatlan->setProperty("cof_no", $cof_no);
		$objSSSjatlan->setProperty("d_invoice_no", $d_invoice_no);
		if($objSSSjatlan->actOrderRequestDetail('U')){
				
				
				//Vendor Transaction
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("transaction_id", $order_tran_id);
				$objQayadaccount->setProperty("trans_amount", $final_amount);
				$objQayadaccount->actAccountTransaction('U');
				// $objOrderCenter->setProperty("order_tran_id", $transaction_id);
				/*******************************************************************
				/////////////////////////////////////////////////////////////////////
				********************************************************************/
		
		/*******************************************************************
		\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
		********************************************************************/
		
		//////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("transaction_id", $vechile_tran_id);
		$objQayadaccount->setProperty("trans_amount", $delivery_chagres);
		$objQayadaccount->actAccountTransaction('U');
		

		if($transferamount_opt == 1){
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("transaction_id", $trans_id_vehicle_second);
		$objQayadaccount->setProperty("trans_amount", $delivery_chagres);
		$objQayadaccount->actAccountTransaction('U');	

		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("transaction_id", $trans_id_vehicle_one);
		$objQayadaccount->setProperty("trans_amount", $delivery_chagres);
		$objQayadaccount->actAccountTransaction('U');
		}


	}





		$objCommon->setMessage('Order amunt modification has been saved successfully.', 'Info');
						$link = Route::_('show=wtsellerorder');
						redirect($link);
		
	}
}
if($_GET["lod"]=="sec" && trim(DecData($_GET["tr"], 1, $objBF)) != ''){

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

// $objSSSCountTransactionRec = new SSSjatlan;
// $objSSSCountTransactionRec->resetProperty();
// $objSSSCountTransactionRec->setProperty("tran_code", trim(DecData($_GET["tr"], 1, $objBF)));
// $objSSSCountTransactionRec->setProperty("isActive", 1);
// $objSSSCountTransactionRec->lstOrderRequestDetail();
// $GetOrderRequest = $objSSSCountTransactionRec->dbFetchArray(1);	

				
}