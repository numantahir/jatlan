<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['mode'] == "S"){
	
	$wrong_tran_no			= trim($_POST['wrong_tran_no']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("wrong_tran_no", 'Transaction Number' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
		
		
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("transaction_number", $wrong_tran_no);
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstAccountTransaction();
					if($objQayadaccount->totalRecords() > 0){
                    $GetTransactionDetail = $objQayadaccount->dbFetchArray(1);
					
						$link = Route::_('show=openingbalanceform&rc='.EncData('get', 2, $objBF).'&tn='.EncData($wrong_tran_no, 2, $objBF).'&ti='.EncData($GetTransactionDetail["transaction_id"], 2, $objBF));
						redirect($link);
						
					} else {
						$link = Route::_('show=openingbalanceform&e='.EncData('wrong', 2, $objBF).'&tn='.EncData($wrong_tran_no, 2, $objBF));
						redirect($link);	
					}
		
		
	}
	
}

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['mode'] == "Remove"){
	
	$Credit_Tran_id			= trim($objBF->decrypt($_POST['cti'], 1, ENCRYPTION_KEY));
	$Debit_tran_id			= trim($objBF->decrypt($_POST['dti'], 1, ENCRYPTION_KEY));
	$Transaction_no			= trim($objBF->decrypt($_POST['tn'], 1, ENCRYPTION_KEY));
	$wrong_reason			= trim($_POST['wrong_reason']);
	$trans_mode				= trim($_POST['trans_mode']);
	$opening_balance		= trim($_POST['opening_balance']);
	$isActive				= trim($_POST['isActive']);
	$entery_date			= date('Y-m-d H:i:s');
	

	$objValidate->setArray($_POST);
	$objValidate->setCheckField("wrong_reason", 'Wrong Reason' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadaccount->resetProperty();
				$wrong_transaction_id = $objQayadaccount->genCode("rs_tbl_wrong_tranasction_detail", "wrong_transaction_id");
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("wrong_transaction_id", $wrong_transaction_id);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("transaction_no", $Transaction_no);
				$objQayadaccount->setProperty("credit_tran_id", $Credit_Tran_id);
				$objQayadaccount->setProperty("debit_tran_id", $Debit_tran_id);
				$objQayadaccount->setProperty("transaction_date", date("Y-m-d"));
				$objQayadaccount->setProperty("wrong_reason", $wrong_reason);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("wrong_tran_type", 1);
				$objQayadaccount->setProperty("isActive", 1);
				if($objQayadaccount->actWrongTransactions('I')){
						
						if($Credit_Tran_id != '' && $Credit_Tran_id !=0){
							if(is_numeric($Credit_Tran_id)){
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("transaction_id", $Credit_Tran_id);
							$objQayadaccount->setProperty("trans_mode", $trans_mode);
							$objQayadaccount->setProperty("trans_amount", $opening_balance);
							$objQayadaccount->actAccountTransaction('U');
							}
						}
						
						if($Debit_tran_id != '' && $Debit_tran_id !=0){
							if(is_numeric($Debit_tran_id)){
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("transaction_id", $Debit_tran_id);
							$objQayadaccount->setProperty("trans_mode", $trans_mode);
							$objQayadaccount->setProperty("trans_amount", $opening_balance);
							
							
							$objQayadaccount->actAccountTransaction('U');
							}
						}
						
						
						
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 25);
				$objQayaduser->setProperty("entity_id", $location_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $Transaction_no." Removed");
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Selected transaction successfully removed.', 'Info');
						$link = Route::_('show=openingbalance');
						redirect($link);
				}
				
			}
}
?>