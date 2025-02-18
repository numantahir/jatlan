<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$search_type			= trim($_POST['search_type']);
	$search_vale			= trim($_POST['search_vale']);
	$monthly_rent_id		= trim(DecData($_POST["mri"], 1, $objBF));
	$collection_amount		= trim($_POST['collection_amount']);
	
	$PostedOption			= trim(DecData($_POST["md"], 1, $objBF));
	if($PostedOption == 'search'){
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("search_vale", 'Search Text' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){

			$link = Route::_('show=getcollection&rs='.EncData('view', 2, $objBF).'&s='.EncData($search_type, 2, $objBF).'&v='.EncData($search_vale, 2, $objBF));
			redirect($link);
				
			}
	} elseif($PostedOption == 'ca'){
			
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("collection_amount", 'Amount' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){

				$objMonthlyAmountUpdate = new SSSinventory;
				$objBatchDetailInsert = new SSSinventory;
				$objPropertyCounter = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
				$objSSSinventory->lstMonthlyRent();
				$MonthlyRentDetail = $objSSSinventory->dbFetchArray(1);
				if($collection_amount == $MonthlyRentDetail["total_rent_amount"]){
					$PropertyBaseAmount = 0;
					$PaymentModeType = 1;
				} else {
				
				$objPropertyCounter->resetProperty();
				$objPropertyCounter->setProperty("monthly_rent_id", $monthly_rent_id);
				$objPropertyCounter->lstMonthlyRentAmount();
				$NoOfProperties = $objPropertyCounter->totalRecords();
				$DevideEachProperty = $collection_amount / $NoOfProperties;
					$PropertyBaseAmount = 0;
					$PaymentModeType = 2;
				}
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
				$objSSSinventory->setProperty("received_amount", $collection_amount);
				$objSSSinventory->setProperty("rent_status", 1);
				$objSSSinventory->setProperty("received_by", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				if($objSSSinventory->actMonthlyRent('U')){
				
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("batch_code", $BatchCode);
					$objSSSinventory->setProperty("batch_status", 1);
					$objSSSinventory->lstBatchList();
					if($objSSSinventory->totalRecords() > 0){
						$TodayBatchDetail = $objSSSinventory->dbFetchArray(1);
						
						/**/ $batch_id = $TodayBatchDetail["batch_id"];
						/**/ $CurrentNoofBills = $TodayBatchDetail["no_of_bills"];
						/**/ $CurrentAmountRecevied = $TodayBatchDetail["received_amount"];
						/**/ $UpdatedNoOfBills = $CurrentNoofBills + 1;
						/**/ $UpdatedAmountReceived = $CurrentAmountRecevied + $collection_amount;
						
								/*************************************************************************************************/
								/**/ $objSSSinventory->resetProperty();
								/**/ $objSSSinventory->setProperty("batch_id", $TodayBatchDetail["batch_id"]);
								/**/ $objSSSinventory->setProperty("no_of_bills", $UpdatedNoOfBills);
								/**/ $objSSSinventory->setProperty("received_amount", $UpdatedAmountReceived);
								/**/ $objSSSinventory->actBatch('U');
								/*************************************************************************************************/
					} else {
						
						/**/ $UpdatedNoOfBills = 1;
						/**/ $UpdatedAmountReceived = $collection_amount;
						
								/*************************************************************************************************/
								/**/ $objSSSinventory->resetProperty();
								/**/ $batch_id = $objSSSinventory->genCode("rs_tbl_inv_batch", "batch_id");
								/**/ $objSSSinventory->resetProperty();
								/**/ $objSSSinventory->setProperty("batch_id", $batch_id);
								/**/ $objSSSinventory->setProperty("no_of_bills", $UpdatedNoOfBills);
								/**/ $objSSSinventory->setProperty("received_amount", $UpdatedAmountReceived);
								/**/ $objSSSinventory->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
								/**/ $objSSSinventory->setProperty("batch_code", $BatchCode);
								/**/ $objSSSinventory->setProperty("batch_date", date("Y-m-d"));
								/**/ $objSSSinventory->setProperty("batch_status", 1);
								/**/ $objSSSinventory->actBatch('I');
								/*************************************************************************************************/
					}
				
				
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
						$objSSSinventory->lstMonthlyRentAmount();
						while($MonthlyAmountList = $objSSSinventory->dbFetchArray(1)){
								if($PaymentModeType == 1){
								$PendingAmount = $collection_amount;
								$Set_rent_status = 2;
								} else {
								//$PendingAmount = $MonthlyAmountList["total_amount"] - round($DevideEachProperty, 2);
								//$PendingAmount = $collection_amount - round($DevideEachProperty, 2);
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
										/**/ $objBatchDetailInsert->setProperty("monthly_rent_id", $monthly_rent_id);
										/**/ $objBatchDetailInsert->setProperty("received_amount", $PendingAmount);
										/**/ $objBatchDetailInsert->setProperty("entery_date", date('Y-m-d H:i:s'));
										/**/ $objBatchDetailInsert->setProperty("property_id", $MonthlyAmountList["property_id"]);
										/**/ $objBatchDetailInsert->setProperty("tenant_id", $MonthlyAmountList["tenant_id"]);
										/**/ $objBatchDetailInsert->setProperty("isActive", 1);
										/**/ $objBatchDetailInsert->actBatchDetail('I');
										/*************************************************************************************************/
						}
				}
			
			//die('<br>----------------------------------------------------Final Stage');
			//$link = Route::_('show=getcollection&rs='.EncData('view', 2, $objBF).'&s='.EncData($search_type, 2, $objBF).'&v='.EncData($search_vale, 2, $objBF));
			$objCommon->setMessage('Requested Bill amount has been received successfully.', 'Info');
			$link = Route::_('show=getcollection');
			redirect($link);
				
			}
		
		
	}
	}