<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST" && trim($objBF->decrypt($_POST['t'], 1, ENCRYPTION_KEY)) == 'search'){

	$bill_no				= trim($_POST['bill_no']);

	$objValidate->setArray($_POST);
	$objValidate->setCheckField("bill_no", 'Bill no.' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("bill_no", $bill_no);
				$objSSSinventory->lstMonthlyRent();
				if($objSSSinventory->totalRecords() > 0){
				$GetMonthlyBillID = $objSSSinventory->dbFetchArray(1);
						
					//$objCommon->setMessage('Block information detail has been saved successfully.', 'Info');
					$link = Route::_('show=modifyrequestform&i='.EncData($GetMonthlyBillID["monthly_rent_id"], 2, $objBF).'&b='.EncData($GetMonthlyBillID["bill_no"], 2, $objBF));
					redirect($link);

				} else {
					
					$objCommon->setMessage('Unable to find '.$bill_no.' bill number information.', 'Error');
					$link = Route::_('show=modifyrequestform');
					redirect($link);
					
				}
				
			}
	} 
if($_SERVER['REQUEST_METHOD'] == "POST" && trim($objBF->decrypt($_POST['t'], 1, ENCRYPTION_KEY)) == 'modification'){
	

	$bill_no				= trim(DecData($_POST["b"], 1, $objBF));
	$monthly_bill_id		= trim(DecData($_POST["i"], 1, $objBF));
	$request_type			= trim($_POST['request_type']);
	$original_bill_no		= trim($_POST['original_bill_no']);
	$arrear_amount_remove	= trim($_POST['arrear_amount_remove']);
	$original_amount		= trim($_POST['original_amount']);
	$request_extra_note		= trim($_POST['request_extra_note']);
	$entery_date			= date('Y-m-d H:i:s');
	$isActive				= 1;
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("request_type", 'Requested type' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		
			if($request_type == 1){
				
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("monthly_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->lstBatchDetailList();
				if($objSSSinventory->totalRecords() > 0){
				$GetMainBatchNumber = $objSSSinventory->dbFetchArray(1);
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("batch_id", $GetMainBatchNumber["batch_id"]);
				$objSSSinventory->lstBatchList();
				$GetBatchDetail = $objSSSinventory->dbFetchArray(1);
							
					if($GetBatchDetail["batch_status"] != 3){
						
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("isActive", 1);
						$objSSSinventory->setProperty("bill_no", $original_bill_no);
						$objSSSinventory->lstMonthlyRent();
						if($objSSSinventory->totalRecords() > 0){
						//$OriginalBillNo = $objSSSinventory->dbFetchArray(1);
						
						
						$objSSSinventory->resetProperty();
						$bill_modify_req_id = $objSSSinventory->genCode("rs_tbl_inv_bill_modification_request", "bill_modify_req_id");
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("monthly_bill_id", $monthly_bill_id);
						$objSSSinventory->setProperty("request_code", CreateInvoiceNumber($bill_modify_req_id));
						$objSSSinventory->setProperty("request_date", $entery_date);
						$objSSSinventory->setProperty("request_type", $request_type);
						$objSSSinventory->setProperty("request_status", 1);
						$objSSSinventory->setProperty("request_extra_note", $request_extra_note);
						$objSSSinventory->setProperty("original_bill_no", $original_bill_no);
						$objSSSinventory->setProperty("entery_date", $entery_date);
						$objSSSinventory->setProperty("isActive", 1);
						$objSSSinventory->actBillModificationRequest('I');
						
						$objCommon->setMessage('Your modification request has been forward successfully. Please contact finance department.', 'Info');
						$link = Route::_('show=modifyrequest');
						redirect($link);
						
						} else {
							
						$objCommon->setMessage('Sorry application unable to find original bill. Please check Original bill number.', 'Error');
						$link = Route::_('show=modifyrequestform&i='.EncData($monthly_bill_id, 2, $objBF).'&b='.EncData($bill_no, 2, $objBF));
						redirect($link);	
						
						}
							
						
						
					} else {
						
						$objCommon->setMessage('Sorry this requested bill number batch already process complete.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
					}
						
				
				} else {
					
						$objCommon->setMessage('No transaction found under this '.$bill_no.' bill number.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
				}
				
				
				
				
			// END $request_type == 1
			} elseif($request_type == 2){
				
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("monthly_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->lstBatchDetailList();
				if($objSSSinventory->totalRecords() > 0){
				$GetMainBatchNumber = $objSSSinventory->dbFetchArray(1);
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("batch_id", $GetMainBatchNumber["batch_id"]);
				$objSSSinventory->lstBatchList();
				$GetBatchDetail = $objSSSinventory->dbFetchArray(1);
							
					if($GetBatchDetail["batch_status"] != 3){
						
						$objSSSinventory->resetProperty();
						$bill_modify_req_id = $objSSSinventory->genCode("rs_tbl_inv_bill_modification_request", "bill_modify_req_id");
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("monthly_bill_id", $monthly_bill_id);
						$objSSSinventory->setProperty("request_code", CreateInvoiceNumber($bill_modify_req_id));
						$objSSSinventory->setProperty("request_date", $entery_date);
						$objSSSinventory->setProperty("request_type", $request_type);
						$objSSSinventory->setProperty("request_status", 1);
						$objSSSinventory->setProperty("request_extra_note", $request_extra_note);
						$objSSSinventory->setProperty("arrear_amount_remove", $arrear_amount_remove);
						$objSSSinventory->setProperty("entery_date", $entery_date);
						$objSSSinventory->setProperty("isActive", 1);
						$objSSSinventory->actBillModificationRequest('I');
						
						$objCommon->setMessage('Your modification request has been forward successfully. Please contact finance department.', 'Info');
						$link = Route::_('show=modifyrequest');
						redirect($link);
						
						
					} else {
						
						$objCommon->setMessage('Sorry this requested bill number batch already process complete.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
					}
						
				
				} else {
					
						$objCommon->setMessage('No transaction found under this '.$bill_no.' bill number.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
				}
				
				
			// END $request_type == 2	
			} elseif($request_type == 3){
			
			
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("monthly_rent_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->lstBatchDetailList();
				if($objSSSinventory->totalRecords() > 0){
				$GetMainBatchNumber = $objSSSinventory->dbFetchArray(1);
				
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("batch_id", $GetMainBatchNumber["batch_id"]);
				$objSSSinventory->lstBatchList();
				$GetBatchDetail = $objSSSinventory->dbFetchArray(1);
							
					if($GetBatchDetail["batch_status"] != 3){
						
						$objSSSinventory->resetProperty();
						$bill_modify_req_id = $objSSSinventory->genCode("rs_tbl_inv_bill_modification_request", "bill_modify_req_id");
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("monthly_bill_id", $monthly_bill_id);
						$objSSSinventory->setProperty("request_code", CreateInvoiceNumber($bill_modify_req_id));
						$objSSSinventory->setProperty("request_date", $entery_date);
						$objSSSinventory->setProperty("request_type", $request_type);
						$objSSSinventory->setProperty("request_status", 1);
						$objSSSinventory->setProperty("request_extra_note", $request_extra_note);
						$objSSSinventory->setProperty("original_amount", $original_amount);
						$objSSSinventory->setProperty("entery_date", $entery_date);
						$objSSSinventory->setProperty("isActive", 1);
						$objSSSinventory->actBillModificationRequest('I');
						
						$objCommon->setMessage('Your modification request has been forward successfully. Please contact finance department.', 'Info');
						$link = Route::_('show=modifyrequest');
						redirect($link);
						
						
					} else {
						
						$objCommon->setMessage('Sorry this requested bill number batch already process complete.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
					}
						
				
				} else {
					
						$objCommon->setMessage('No transaction found under this '.$bill_no.' bill number.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
				}
			
			
			// END $request_type == 3
			} elseif($request_type == 4){
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("monthly_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->lstBatchDetailList();
				if($objSSSinventory->totalRecords() > 0){
				$GetMainBatchNumber = $objSSSinventory->dbFetchArray(1);
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("batch_id", $GetMainBatchNumber["batch_id"]);
				$objSSSinventory->lstBatchList();
				$GetBatchDetail = $objSSSinventory->dbFetchArray(1);
							
					if($GetBatchDetail["batch_status"] != 3){
						
						$objSSSinventory->resetProperty();
						$bill_modify_req_id = $objSSSinventory->genCode("rs_tbl_inv_bill_modification_request", "bill_modify_req_id");
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("monthly_bill_id", $monthly_bill_id);
						$objSSSinventory->setProperty("request_code", CreateInvoiceNumber($bill_modify_req_id));
						$objSSSinventory->setProperty("request_date", $entery_date);
						$objSSSinventory->setProperty("request_type", $request_type);
						$objSSSinventory->setProperty("request_status", 1);
						$objSSSinventory->setProperty("request_extra_note", $request_extra_note);
						$objSSSinventory->setProperty("entery_date", $entery_date);
						$objSSSinventory->setProperty("isActive", 1);
						$objSSSinventory->actBillModificationRequest('I');
						
						$objCommon->setMessage('Your modification request has been forward successfully. Please contact finance department.', 'Info');
						$link = Route::_('show=modifyrequest');
						redirect($link);
						
						
					} else {
						
						$objCommon->setMessage('Sorry this requested bill number batch already process complete.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
					}
						
				
				} else {
					
						$objCommon->setMessage('No transaction found under this '.$bill_no.' bill number.', 'Error');
						$link = Route::_('show=modifyrequestform');
						redirect($link);	
				}
			
			// END $request_type == 4
			}
		
		
	}
	
	
	
	
	
}

if($_SERVER['REQUEST_METHOD'] == "POST" && trim($objBF->decrypt($_POST['t'], 1, ENCRYPTION_KEY)) == 'action' && $objCheckLogin->user_type == 3){

	

	$bill_modify_req_id		= trim(DecData($_POST["i"], 1, $objBF));
	$monthly_bill_id		= trim(DecData($_POST["m"], 1, $objBF));
	$request_type			= trim(DecData($_POST["rqt"], 1, $objBF));
	$arrear_amount_remove	= trim($_POST['arrear_amount_remove']);
	//$arrear_amount_remove	= trim($_POST['arrear_amount_remove']);
	//$original_amount		= trim($_POST['original_amount']);
	$extra_note				= trim($_POST['extra_note']);
	$request_status			= trim($_POST['request_status']);
	$original_bill_no		= trim(DecData($_POST["obn"], 1, $objBF));
	$batch_id				= trim(DecData($_POST["bi"], 1, $objBF));
	$original_amount		= trim($_POST["original_amount"]);
	$entery_date			= date('Y-m-d H:i:s');
	$isActive				= 1;
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("request_status", 'Requested status' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){


		if($request_type == 1){
		// Start Request Type Section => 1	
			/**********************************************************************************************/
			/**********************************************************************************************/
			/**********************************************************************************************/
			$objSSSBillPropertyList = new SSSinventory;
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("isAcitve", 1);
			$objSSSinventory->setProperty("monthly_rent_id", $monthly_bill_id);
			$objSSSinventory->lstMonthlyRent();
			if($objSSSinventory->totalRecords() > 0){
			$GetMonthlyBillRequest = $objSSSinventory->dbFetchArray(1);
		
				$OldBillTotalPaidAmount = $GetMonthlyBillRequest["received_amount"];
				
				/*******************************************************************************************************/
				/**/ $objSSSinventory->resetProperty();
				/**/ //$objSSSinventory->setProperty("isActive", 1);
				/**/ $objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
				/**/ $objSSSinventory->lstBatchDetailList();
				/**/ $GetBatchId = $objSSSinventory->dbFetchArray(1);	
				/**/ $batch_id = $GetBatchId["batch_id"];
				/*******************************************************************************************************/
				
				/*************************************************************************************************/
				/*************************************************************************************************/
				/*************************************************************************************************/
				/**/ $objSSSinventory->resetProperty();
				/**/ $objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
				/**/ $objSSSinventory->setProperty("isActive", 2);
				/**/ $objSSSinventory->setProperty("extra_note", $extra_note);
				/**/ $objSSSinventory->actBatchDetail('U');
				/*************************************************************************************************/
				/*************************************************************************************************/
				/*************************************************************************************************/
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
				$objSSSinventory->setProperty("received_amount", 0);
				$objSSSinventory->setProperty("rent_status", 2);
				$objSSSinventory->setProperty("received_by", '0');
				$objSSSinventory->actMonthlyRent('U');
				
				$objUpdateOldMonthlyRentAmount = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
				$objSSSinventory->lstMonthlyRentAmount();
				while($MonthlyAmountList = $objSSSinventory->dbFetchArray(1)){
					/*************************************************************************************************/
					/**/ $objUpdateOldMonthlyRentAmount->resetProperty();
					/**/ $objUpdateOldMonthlyRentAmount->setProperty("rent_amount_id", $MonthlyAmountList["rent_amount_id"]);
					/**/ $objUpdateOldMonthlyRentAmount->setProperty("received_amount", 0);
					/**/ $objUpdateOldMonthlyRentAmount->setProperty("pending_amount", $MonthlyAmountList["total_amount"]);
					/**/ $objUpdateOldMonthlyRentAmount->setProperty("rent_status", 1);
					/**/ $objUpdateOldMonthlyRentAmount->setProperty("received_date", '0000-00-00');
					/**/ $objUpdateOldMonthlyRentAmount->actMonthlyRentAmount('U');
					/*************************************************************************************************/
				}
				
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
				
				
				$collection_amount = $GetMonthlyBillRequest["received_amount"];
				$objMonthlyAmountUpdate = new SSSinventory;
				$objBatchDetailInsert = new SSSinventory;
				$objPropertyCounter = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("bill_no", $original_bill_no);
				$objSSSinventory->lstMonthlyRent();
				$MonthlyRentDetail = $objSSSinventory->dbFetchArray(1);
				if($collection_amount == $MonthlyRentDetail["total_rent_amount"]){
					$PropertyBaseAmount = 0;
					$PaymentModeType = 1;
				} else {
				
				$objPropertyCounter->resetProperty();
				$objPropertyCounter->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
				$objPropertyCounter->lstMonthlyRentAmount();
				$NoOfProperties = $objPropertyCounter->totalRecords();
				$DevideEachProperty = $collection_amount / $NoOfProperties;
					$PropertyBaseAmount = 0;
					$PaymentModeType = 2;
				}
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
				$objSSSinventory->setProperty("received_amount", $collection_amount);
				$objSSSinventory->setProperty("rent_status", 1);
				$objSSSinventory->setProperty("received_by", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				if($objSSSinventory->actMonthlyRent('U')){
				
					
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
						$objSSSinventory->lstMonthlyRentAmount();
						while($MonthlyAmountList = $objSSSinventory->dbFetchArray(1)){
								if($PaymentModeType == 1){
								$PendingAmount = $collection_amount;
								$Set_rent_status = 2;
								} else {
								$PendingAmount = round($DevideEachProperty, 2);
								$Set_rent_status = 3;
								}
								
								/*************************************************************************************************/
								/**/ $objMonthlyAmountUpdate->resetProperty();
								/**/ $objMonthlyAmountUpdate->setProperty("rent_amount_id", $MonthlyAmountList["rent_amount_id"]);
								/**/ $objMonthlyAmountUpdate->setProperty("received_amount", $PendingAmount);
								/**/ $objMonthlyAmountUpdate->setProperty("pending_amount", 0);
								/**/ $objMonthlyAmountUpdate->setProperty("rent_status", $Set_rent_status);
								/**/ $objMonthlyAmountUpdate->setProperty("received_date", date("Y-m-d"));
								/**/ $objMonthlyAmountUpdate->actMonthlyRentAmount('U');
								/*************************************************************************************************/
								
										/*************************************************************************************************/
										/**/ $objBatchDetailInsert->resetProperty();
										/**/ $batch_detail_id = $objBatchDetailInsert->genCode("rs_tbl_inv_batch_detail", "batch_detail_id");
										/**/ $objBatchDetailInsert->resetProperty();
										/**/ $objBatchDetailInsert->setProperty("batch_detail_id", $batch_detail_id);
										/**/ $objBatchDetailInsert->setProperty("batch_id", $batch_id);
										/**/ $objBatchDetailInsert->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
										/**/ $objBatchDetailInsert->setProperty("rent_amount_id", $MonthlyAmountList["rent_amount_id"]);
										/**/ $objBatchDetailInsert->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
										/**/ $objBatchDetailInsert->setProperty("received_amount", $PendingAmount);
										/**/ $objBatchDetailInsert->setProperty("entery_date", date('Y-m-d H:i:s'));
										/**/ $objBatchDetailInsert->setProperty("property_id", $MonthlyAmountList["property_id"]);
										/**/ $objBatchDetailInsert->setProperty("tenant_id", $MonthlyAmountList["tenant_id"]);
										/**/ $objBatchDetailInsert->setProperty("isActive", 1);
										/**/ $objBatchDetailInsert->actBatchDetail('I');
										/*************************************************************************************************/
						}
				}
				
					
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("extra_note", $extra_note);
						$objSSSinventory->setProperty("request_status", $request_status);
						$objSSSinventory->setProperty("resolved_date", $entery_date);
						$objSSSinventory->setProperty("resolved_by", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->actBillModificationRequest('U');
				
					$objCommon->setMessage('Requested bill has been updated successfully.', 'Info');
					$link = Route::_('show=modifyrequest');
					redirect($link);
				
				
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
				
		
			} else {
				$objCommon->setMessage('Please check this bill already remove or regenerate new bill please ask to generate a new request for arrear removal.', 'Error');
				$link = Route::_('show=modifyrequest');
				redirect($link);	
			}
		// End Request Type Section => 1
		} elseif($request_type == 2){
		// Start Request Type Section => 2	
			/**********************************************************************************************/
			/**********************************************************************************************/
			/**********************************************************************************************/
			$objSSSBillPropertyList = new SSSinventory;
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("isAcitve", 1);
			$objSSSinventory->setProperty("monthly_rent_id", $monthly_bill_id);
			$objSSSinventory->lstMonthlyRent();
			if($objSSSinventory->totalRecords() > 0){
			$GetMonthlyBillRequest = $objSSSinventory->dbFetchArray(1);
		
		
				if($GetMonthlyBillRequest["arrears_rent"] >= $arrear_amount_remove){
					
					$CurrentMonthBillAmount = $GetMonthlyBillRequest["within_monthly_rent"];
					$AfterArrearAmountRemoveBill = $CurrentMonthBillAmount - $GetMonthlyBillRequest["arrears_rent"];
					$TotalAmountUpdate = $GetMonthlyBillRequest["total_rent_amount"] - $arrear_amount_remove;
					$FinalArrearAmount = $GetMonthlyBillRequest["arrears_rent"] - $arrear_amount_remove;
					
					if($request_status == 2){

						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
						$objSSSinventory->setProperty("within_monthly_rent", $AfterArrearAmountRemoveBill);
						$objSSSinventory->setProperty("after_monthly_rent", $AfterArrearAmountRemoveBill + 250);
						$objSSSinventory->setProperty("arrears_rent", $FinalArrearAmount);
						$objSSSinventory->setProperty("total_rent_amount", $TotalAmountUpdate);
						$objSSSinventory->actMonthlyRent('U');
					
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("isAcitve", 1);
						$objSSSinventory->setProperty("monthly_rent_id", $monthly_bill_id);
						$objSSSinventory->lstMonthlyRentAmount();
						while($ListofBillProperty = $objSSSinventory->dbFetchArray(1)){
						
							$objSSSBillPropertyList->resetProperty();
							$objSSSBillPropertyList->setProperty("monthly_rent_id", $monthly_rent_id);
							$objSSSBillPropertyList->setProperty("arrears_amount", 0);
							$objSSSBillPropertyList->setProperty("total_amount", $ListofBillProperty["monthly_amount"]);
							$objSSSBillPropertyList->actMonthlyRentAmount('U');
						
						}
					
					$objCommon->setMessage('Requested arrear amount bill has been updated.', 'Info');
					} else {
					$objCommon->setMessage('Requested arrear amount status has been updated.', 'Info');
					}

						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("extra_note", $extra_note);
						$objSSSinventory->setProperty("request_status", $request_status);
						$objSSSinventory->setProperty("resolved_date", $entery_date);
						$objSSSinventory->setProperty("resolved_by", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->actBillModificationRequest('U');
				
					$link = Route::_('show=modifyrequest');
					redirect($link);

				} else {
					
					$objCommon->setMessage('Requested arrear amount more than selected bill arrear amount. Please check and submit again.', 'Error');
				$link = Route::_('show=modifyrequest&i='.EncData($bill_modify_req_id, 2, $objBF).'&m='.EncData($monthly_bill_id, 2, $objBF));
				redirect($link);	
					
				}
		
			} else {
				$objCommon->setMessage('Please check this bill already remove or regenerate new bill please ask to generate a new request for arrear removal.', 'Error');
				$link = Route::_('show=modifyrequest');
				redirect($link);	
			}
		
		
		// End Request Type Section => 2	
		} elseif($request_type == 3){
		// Start Request Type Section => 3
			/**********************************************************************************************/
			/**********************************************************************************************/
			/**********************************************************************************************/
			$objSSSBillPropertyList = new SSSinventory;
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("isAcitve", 1);
			$objSSSinventory->setProperty("monthly_rent_id", $monthly_bill_id);
			$objSSSinventory->lstMonthlyRent();
			if($objSSSinventory->totalRecords() > 0){
			$GetMonthlyBillRequest = $objSSSinventory->dbFetchArray(1);
				
				/*******************************************************************************************************/
				/**/ $objSSSinventory->resetProperty();
				/**/ //$objSSSinventory->setProperty("isActive", 1);
				/**/ $objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
				/**/ $objSSSinventory->lstBatchDetailList();
				/**/ $GetBatchId = $objSSSinventory->dbFetchArray(1);	
				/**/ $batch_id = $GetBatchId["batch_id"];
				/*******************************************************************************************************/
				
				/*************************************************************************************************/
				/*************************************************************************************************/
				/*************************************************************************************************/
				/**/ $objSSSinventory->resetProperty();
				/**/ $objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
				/**/ $objSSSinventory->setProperty("isActive", 2);
				/**/ $objSSSinventory->setProperty("extra_note", $extra_note);
				/**/ $objSSSinventory->actBatchDetail('U');
				/*************************************************************************************************/
				/*************************************************************************************************/
				/*************************************************************************************************/
				
				
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
				
				
				$collection_amount = $original_amount;
				$objMonthlyAmountUpdate = new SSSinventory;
				$objBatchDetailInsert = new SSSinventory;
				$objPropertyCounter = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $monthly_bill_id);
				$objSSSinventory->lstMonthlyRent();
				$MonthlyRentDetail = $objSSSinventory->dbFetchArray(1);
				if($collection_amount == $MonthlyRentDetail["total_rent_amount"]){
					$PropertyBaseAmount = 0;
					$PaymentModeType = 1;
				} else {
				
				$objPropertyCounter->resetProperty();
				$objPropertyCounter->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
				$objPropertyCounter->lstMonthlyRentAmount();
				$NoOfProperties = $objPropertyCounter->totalRecords();
				$DevideEachProperty = $collection_amount / $NoOfProperties;
					$PropertyBaseAmount = 0;
					$PaymentModeType = 2;
				}
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
				$objSSSinventory->setProperty("received_amount", $collection_amount);
				if($objSSSinventory->actMonthlyRent('U')){
				
					
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
						$objSSSinventory->lstMonthlyRentAmount();
						while($MonthlyAmountList = $objSSSinventory->dbFetchArray(1)){
								if($PaymentModeType == 1){
								$PendingAmount = $collection_amount;
								$Set_rent_status = 2;
								} else {
								$PendingAmount = round($DevideEachProperty, 2);
								$Set_rent_status = 3;
								}
								
								/*************************************************************************************************/
								/**/ $objMonthlyAmountUpdate->resetProperty();
								/**/ $objMonthlyAmountUpdate->setProperty("rent_amount_id", $MonthlyAmountList["rent_amount_id"]);
								/**/ $objMonthlyAmountUpdate->setProperty("received_amount", $PendingAmount);
								/**/ $objMonthlyAmountUpdate->setProperty("pending_amount", 0);
								/**/ $objMonthlyAmountUpdate->actMonthlyRentAmount('U');
								/*************************************************************************************************/
								
										/*************************************************************************************************/
										/**/ $objBatchDetailInsert->resetProperty();
										/**/ $batch_detail_id = $objBatchDetailInsert->genCode("rs_tbl_inv_batch_detail", "batch_detail_id");
										/**/ $objBatchDetailInsert->resetProperty();
										/**/ $objBatchDetailInsert->setProperty("batch_detail_id", $batch_detail_id);
										/**/ $objBatchDetailInsert->setProperty("batch_id", $batch_id);
										/**/ $objBatchDetailInsert->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
										/**/ $objBatchDetailInsert->setProperty("rent_amount_id", $MonthlyAmountList["rent_amount_id"]);
										/**/ $objBatchDetailInsert->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
										/**/ $objBatchDetailInsert->setProperty("received_amount", $PendingAmount);
										/**/ $objBatchDetailInsert->setProperty("entery_date", date('Y-m-d H:i:s'));
										/**/ $objBatchDetailInsert->setProperty("property_id", $MonthlyAmountList["property_id"]);
										/**/ $objBatchDetailInsert->setProperty("tenant_id", $MonthlyAmountList["tenant_id"]);
										/**/ $objBatchDetailInsert->setProperty("isActive", 1);
										/**/ $objBatchDetailInsert->actBatchDetail('I');
										/*************************************************************************************************/
						}
				}
				
				/*******************************************************************************************************/
				/**/ $objSSSinventory->resetProperty();
				/**/ $objSSSinventory->setProperty("isActive", 1);
				/**/ $objSSSinventory->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
				/**/ $objSSSinventory->lstBatchDetailList();
				/**/ $GetBatchId = $objSSSinventory->dbFetchArray(1);	
				/*******************************************************************************************************/
				/**/ $objSSSinventory->resetProperty();
				/**/ $UpdatedBatchSum = $objSSSinventory->GetBatchSum($GetBatchId["batch_id"]);
				/*******************************************************************************************************/
				/**/ $objSSSinventory->resetProperty();
				/**/ $objSSSinventory->setProperty("batch_id", $GetBatchId["batch_id"]);
				/**/ $objSSSinventory->setProperty("received_amount", $UpdatedBatchSum);
				/**/ $objSSSinventory->actBatch('U');
				/*******************************************************************************************************/
					
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("extra_note", $extra_note);
						$objSSSinventory->setProperty("request_status", $request_status);
						$objSSSinventory->setProperty("resolved_date", $entery_date);
						$objSSSinventory->setProperty("resolved_by", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->actBillModificationRequest('U');
				
					$objCommon->setMessage('Requested bill has been updated successfully.', 'Info');
					$link = Route::_('show=modifyrequest');
					redirect($link);
				
				
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
		
			} else {
				$objCommon->setMessage('Please check this bill already remove or regenerate new bill please ask to generate a new request for arrear removal.', 'Error');
				$link = Route::_('show=modifyrequest');
				redirect($link);	
			}
		// End Request Type Section => 3
		} elseif($request_type == 4){
		// Start Request Type Section => 4
			/**********************************************************************************************/
			/**********************************************************************************************/
			/**********************************************************************************************/
			$objSSSTenantPropertyChecker = new SSSinventory;
			$objSSSUpdateTenantPropertyStatus = new SSSinventory;
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("isAcitve", 1);
			$objSSSinventory->setProperty("monthly_rent_id", $monthly_bill_id);
			$objSSSinventory->lstMonthlyRent();
			if($objSSSinventory->totalRecords() > 0){
			$GetMonthlyBillRequest = $objSSSinventory->dbFetchArray(1);
				
				if($request_status == 2){
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isAcitve", 1);
				$objSSSinventory->setProperty("monthly_rent_id", $monthly_bill_id);
				$objSSSinventory->lstMonthlyRentAmount();
				while($ListofBillProperty = $objSSSinventory->dbFetchArray(1)){
					//echo $ListofBillProperty["rent_amount_id"].'-'.$ListofBillProperty["property_id"].'-'.$ListofBillProperty["tenant_id"].'-'.$ListofBillProperty["monthly_rent_id"].'<br>';
					if($ListofBillProperty["property_id"] != '' && $ListofBillProperty["tenant_id"] != ''){
						$objSSSTenantPropertyChecker->resetProperty();
						$objSSSTenantPropertyChecker->setProperty("isActive", 1);
						$objSSSTenantPropertyChecker->setProperty("tenant_status", 1);
						$objSSSTenantPropertyChecker->setProperty("tenant_id", $ListofBillProperty["tenant_id"]);
						$objSSSTenantPropertyChecker->setProperty("property_id", $ListofBillProperty["property_id"]);
						$objSSSTenantPropertyChecker->lstTenantAssignProperty();
						if($objSSSTenantPropertyChecker->totalRecords() > 0){
							$GetTenantPropertyAssignID = $objSSSTenantPropertyChecker->dbFetchArray(1);
							
							/*******************************************************************************************************************/
							$objSSSUpdateTenantPropertyStatus->resetProperty();
							$objSSSUpdateTenantPropertyStatus->setProperty("assign_property_id", $GetTenantPropertyAssignID["assign_property_id"]);
							$objSSSUpdateTenantPropertyStatus->setProperty("leave_date", date("Y-m-d"));
							$objSSSUpdateTenantPropertyStatus->setProperty("tenant_status", 2);
							$objSSSUpdateTenantPropertyStatus->actTenantAssignProperty('U');
							/*******************************************************************************************************************/
							/*******************************************************************************************************************/
							$objSSSUpdateTenantPropertyStatus->resetProperty();
							$objSSSUpdateTenantPropertyStatus->setProperty("property_id", $ListofBillProperty["property_id"]);
							$objSSSUpdateTenantPropertyStatus->setProperty("tenant_status", 2);
							$objSSSUpdateTenantPropertyStatus->actProperty('U');
							/*******************************************************************************************************************/
							
						}
					}
				}
				
							/**************************************************************************************/
							/**/ $objSSSinventory->resetProperty();
							/**/ $objSSSinventory->setProperty("tenant_id", $GetMonthlyBillRequest["tenant_id"]);
							/**/ $objSSSinventory->setProperty("isActive", 2);
							/**/ $objSSSinventory->actTenantInformation('U');
							/**************************************************************************************/
							/**/ $objSSSinventory->resetProperty();
							/**/ $objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
							/**/ $objSSSinventory->setProperty("tenant_id", $GetMonthlyBillRequest["tenant_id"]);
							/**/ $objSSSinventory->actBillModificationRequest('U');
							/***************************************************************************************************/
							/**/$objSSSinventory->resetProperty();
							/**/$objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
							/**/$objSSSinventory->setProperty("isAcitve", 4);
							/**/$objSSSinventory->actMonthlyRent('U');
							/***************************************************************************************************/
							/**/$objSSSinventory->resetProperty();
							/**/$objSSSinventory->setProperty("monthly_rent_id", $GetMonthlyBillRequest["monthly_rent_id"]);
							/**/$objSSSinventory->setProperty("isActive", 4);
							/**/$objSSSinventory->actMonthlyRentAmount('U');
							/***************************************************************************************************/

		
				$objCommon->setMessage('Requested tenant leave status has been updated.', 'Info');
				} else {
				$objCommon->setMessage('Requested tenant leave status has been updated.', 'Info');
				}
				
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("bill_modify_req_id", $bill_modify_req_id);
						$objSSSinventory->setProperty("extra_note", $extra_note);
						$objSSSinventory->setProperty("request_status", $request_status);
						$objSSSinventory->setProperty("resolved_date", $entery_date);
						$objSSSinventory->setProperty("resolved_by", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->actBillModificationRequest('U');
				
					$link = Route::_('show=modifyrequest');
					redirect($link);
					
					
			} else {
				$objCommon->setMessage('Please check this bill already remove or regenerate new bill please ask to generate a new request for arrear removal.', 'Error');
				$link = Route::_('show=modifyrequest');
				redirect($link);	
			}
		//die();
		// End Request Type Section => 4
		}









	
	}
}











if(trim(DecData($_GET["i"], 1, $objBF)) != '' && trim(DecData($_GET["rq"], 1, $objBF)) == 'remove' && trim(DecData($_GET["ts"], 1, $objBF)) == 'request'){
	
$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("bill_modify_req_id", trim(DecData($_GET["i"], 1, $objBF)));
$objSSSinventory->actBillModificationRequest('D');

$objCommon->setMessage('Your requested modification bill has been deleted successfully.', 'Info');
$link = Route::_('show=modifyrequest');
redirect($link);

}