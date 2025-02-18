<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
//print_r($_POST);
//die();
	//$objQayadproperty->resetProperty();
	
	$apm_id						= trim($_POST["apm_id"]);
	$trans_type					= trim($_POST["trans_type"]);
	$aplic_mode					= trim($_POST["aplic_mode"]);
	$head_id_emp_id				= trim($objBF->decrypt($_POST["head_id"], 1, ENCRYPTION_KEY));
	$item_id					= trim($_POST["item_id"]);
	$entery_id					= trim($_POST["entery_id"]);
	$var_payment_mode			= trim($_POST["var_payment_mode"]);
	////////////////////////////////////////////////////////////////////////////
	$var_full_amount			= trim($_POST["var_full_amount"]);
	$var_down_payment			= trim($_POST["var_down_payment"]);
	$var_monthly_instalment		= trim($_POST["var_monthly_instalment"]);
	$var_price_per_sq_ft		= trim($_POST["var_price_per_sq_ft"]);
	////////////////////////////////////////////////////////////////////////////
	$discount_apply				= trim($_POST["discount_apply"]);
	////////////////////////////////////////////////////////////////////////////
	$discount_on				= trim($_POST["discount_on"]);
	$discount_value				= trim($_POST["discount_value"]);
	$var_d_discounted_amount	= trim($_POST["var_d_discounted_amount"]);
	$var_d_new_full_payment		= trim($_POST["var_d_new_full_payment"]);
	$var_d_down_payment			= trim($_POST["var_d_down_payment"]);
	$var_d_remaining_amount		= trim($_POST["var_d_remaining_amount"]);
	$var_d_monthly_instalment	= trim($_POST["var_d_monthly_instalment"]);
	////////////////////////////////////////////////////////////////////////////
	$trans_amount				= trim($_POST["trans_amount"]);
	////////////////////////////////////////////////////////////////////////////
	$instalment_option			= trim($_POST["instalment_option"]);
	////////////////////////////////////////////////////////////////////////////
	$no_of_instalment			= trim($_POST["no_of_instalment"]);
	$instalment_due_on			= trim($_POST["instalment_due_on"]);
	////////////////////////////////////////////////////////////////////////////
	$noofdues					= $_POST["noofdues"];
	//Under Loop
	//instalment_amount_1
	//instalment_amount_date_1
	////////////////////////////////////////////////////////////////////////////
	$pay_mode					= trim($_POST["pay_mode"]);
	$payment_mode_no			= trim($_POST["payment_mode_no"]);
	////////////////////////////////////////////////////////////////////////////
	$trans_date					= trim($_POST["trans_date"]);
	$trans_title				= trim($_POST["trans_title"]);
	$trans_note					= trim($_POST["trans_note"]);
	////////////////////////////////////////////////////////////////////////////
	$transfer_head_id			= trim($_POST["transfer_head_id"]);
	$transfer_item_id			= trim($_POST["transfer_item_id"]);
	$transfer_mode				= trim($_POST["transfer_mode"]);
	////////////////////////////////////////////////////////////////////////////
	$discount_option			= 1; /* 1=>% Base, 2=>Fix Value */
	$var_property_id			= trim($_POST["var_property_id"]);
	////////////////////////////////////////////////////////////////////////////
	$instalment_pay_as			= trim($_POST["instalment_pay_as"]);
	$DefaultNoOfInstalment		= 10;
	$DefaultNoOfMonthStarter	= 3;
	$Get_instalment_id			= trim($_POST["instalment_id"]);
	$item_qty					= trim($_POST["item_qty"]);
	////////////////////////////////////////////////////////////////////////////
	$PaymentRequestId			= trim($_POST["pri"]);
	$AdvanceSalaryId			= trim($_POST["asi"]);
	$TransactionCode			= date("md").rand(1,9).rand(99,999);
	
	
	$entery_date				= date('Y-m-d H:i:s');
	
	list($head_id,$employee_id)= explode('-', $head_id_emp_id);
	//die($head_id_emp_id);
	$objValidate->setArray($_POST);
	//$objValidate->setCheckField("entery_id", _PROPERTY_PROJECT . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("trans_amount", _PROPERTY_FLOOR_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
			
			if($var_payment_mode == 1){
				$ReturnAplicMode = 1;
			} else {
				$ReturnAplicMode = $var_payment_mode;
			}
			
		//	$objQayadproperty->resetProperty();
			//$transaction_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['transaction_id'], 1, ENCRYPTION_KEY)) : $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("head_id", $head_id);
				$objQayadaccount->lstHead();
				$GetEmployeeID = $objQayadaccount->dbFetchArray(1);
				
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				//////////////////////// First Case of Debit ////////////////////////
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
			$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
			$TransactionNumberGen = CreateTransactionNumber($transaction_id);
			$objQayadaccount->resetProperty();
			$objQayadaccount->setProperty("transaction_id", $transaction_id);
			$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			$objQayadaccount->setProperty("head_id", $head_id);
			$objQayadaccount->setProperty("transaction_number", $TransactionNumberGen);
			$objQayadaccount->setProperty("trans_title", $trans_title);
			$objQayadaccount->setProperty("trans_note", $trans_note);
			$objQayadaccount->setProperty("trans_mode", 2);
			$objQayadaccount->setProperty("trans_type", $trans_type);
			$objQayadaccount->setProperty("aplic_mode", 7);
			$objQayadaccount->setProperty("pay_mode", $pay_mode);
			$objQayadaccount->setProperty("entery_id", $employee_id);
			$objQayadaccount->setProperty("pay_mode_no", $payment_mode_no);
			$objQayadaccount->setProperty("trans_amount", $trans_amount);
			$objQayadaccount->setProperty("trans_date", dateFormate_10($trans_date));
			$objQayadaccount->setProperty("trans_status", 1);
			$objQayadaccount->setProperty("item_qty", $item_qty);
			$objQayadaccount->setProperty("entery_date", $entery_date);
			$objQayadaccount->setProperty("isActive", 1);
			$objQayadaccount->setProperty("transfer_head_id", trim($objBF->decrypt($transfer_head_id, 1, ENCRYPTION_KEY)));
			$objQayadaccount->setProperty("transfer_item_id", trim($objBF->decrypt($transfer_item_id, 1, ENCRYPTION_KEY)));
			$objQayadaccount->setProperty("transfer_mode", $transfer_mode);
			//$objQayadaccount->setProperty("location_id", $objQayaduser->location_id);
			$objQayadaccount->setProperty("trans_position", 2);
			$objQayadaccount->setProperty("tran_code", $TransactionCode);
			if($objQayadaccount->actAccountTransaction('I')){
			
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				/////////////////////// Second Case of Credit ///////////////////////
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				$objQayadaccount->resetProperty();
				$credit_transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("transaction_id", $credit_transaction_id);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_id", trim($objBF->decrypt($transfer_head_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("transaction_number", $TransactionNumberGen);
				$objQayadaccount->setProperty("trans_title", $trans_title);
				$objQayadaccount->setProperty("trans_note", $trans_note);
				$objQayadaccount->setProperty("trans_mode", 1);
				$objQayadaccount->setProperty("trans_type", $trans_type);
				$objQayadaccount->setProperty("aplic_mode", 7);
				$objQayadaccount->setProperty("item_qty", $item_qty);
				$objQayadaccount->setProperty("pay_mode", $pay_mode);
				$objQayadaccount->setProperty("entery_id", $employee_id);
				$objQayadaccount->setProperty("pay_mode_no", $payment_mode_no);
				$objQayadaccount->setProperty("trans_amount", $trans_amount);
				$objQayadaccount->setProperty("trans_date", dateFormate_10($trans_date));
				$objQayadaccount->setProperty("trans_status", 1);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->setProperty("transfer_head_id", $head_id);
				$objQayadaccount->setProperty("transfer_item_id", trim($objBF->decrypt($item_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("transfer_mode", $transfer_mode);
				//$objQayadaccount->setProperty("location_id", $objQayaduser->location_id);
				$objQayadaccount->setProperty("trans_position", 1);
				$objQayadaccount->setProperty("tran_code", $TransactionCode);
				$objQayadaccount->actAccountTransaction('I');
				
					/*******************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					/////////////////////// Update Status of PayR ///////////////////////
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					********************************************************************/
					/*$objQayaduser->resetProperty();
					$objQayaduser->setProperty("payment_request_id", $PaymentRequestId);
					$objQayaduser->setProperty("request_status", 1);
					$objQayaduser->setProperty("request_stage_status", 1);
					$objQayaduser->setProperty("request_fwd_finance_status", 1);
					$objQayaduser->actPaymentRequestsList('U');
					
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("advance_salary_id", $AdvanceSalaryId);
					$objQayaduser->setProperty("advance_salary_status", 2);
					$objQayaduser->actPaymentRequestsAdvanceSalary('U');
					
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("payment_request_id", $PaymentRequestId);
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->actPaymentRequestsAdvanceSalaryPayBack('U'); */
					
					
				$objQayaduser->resetProperty();
				$payment_request_id = $objQayaduser->genCode("rs_tbl_payment_requests", "payment_request_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("payment_request_id", $payment_request_id);
				$objQayaduser->setProperty("user_id", $GetEmployeeID["entity_id"]);
				$objQayaduser->setProperty("requested_amount", $trans_amount);
				$objQayaduser->setProperty("apply_type_id", 1);
				$objQayaduser->setProperty("apply_date", $entery_date);
				$objQayaduser->setProperty("request_status", 1);
				$objQayaduser->setProperty("request_stage", 2);
				$objQayaduser->setProperty("request_stage_status", 1);
				$objQayaduser->setProperty("request_fwd_dep_to", 1);
				$objQayaduser->setProperty("request_fwd_dep_status", 1);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->actPaymentRequestsList('I');
				///////////////////////////////////////////////////////////////////////////////////////////////////
				$objQayaduser->resetProperty();
				$advance_salary_id = $objQayaduser->genCode("rs_tbl_payment_requests_advance_salary", "advance_salary_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("advance_salary_id", $advance_salary_id);
				$objQayaduser->setProperty("user_id", $GetEmployeeID["entity_id"]);
				$objQayaduser->setProperty("payment_request_id", $payment_request_id);
				$objQayaduser->setProperty("salary_amount", $trans_amount);
				$objQayaduser->setProperty("paying_date", date('Y-m-d'));
				$objQayaduser->setProperty("advance_month", date("M"));
				$objQayaduser->setProperty("advance_reason", 'Advance Salary.');
				$objQayaduser->setProperty("payback_option", 1);
				$objQayaduser->setProperty("payback_in_months", 1);
				$objQayaduser->setProperty("advance_salary_status", 1);
				$objQayaduser->setProperty("advance_type", 1);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", 1);
				if($objQayaduser->actPaymentRequestsAdvanceSalary('I')){
				
					$objQayaduser->resetProperty();
					$payback_monthly_id = $objQayaduser->genCode("rs_tbl_payment_requests_advance_salary_payback", "payback_monthly_id");
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("payback_monthly_id", $payback_monthly_id);
					$objQayaduser->setProperty("user_id", $GetEmployeeID["entity_id"]);
					$objQayaduser->setProperty("advance_salary_id", $advance_salary_id);
					$objQayaduser->setProperty("payment_request_id", $payment_request_id);
					$objQayaduser->setProperty("monthly_amount", $trans_amount);
					$objQayaduser->setProperty("payback_status", 1);
					$objQayaduser->setProperty("payback_date", date('Y-m-d', strtotime(date("Y-m-01"). ' + 1 month')));
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("entery_date", $entery_date);
					$objQayaduser->actPaymentRequestsAdvanceSalaryPayBack('I');
				}	
					
					/*******************************************************************/
					/*******************************************************************/
					
				
				$objCommon->setMessage(_TRANSACTION_MSG_SUCCESS, 'Info');
				// $link = Route::_('show=transaction');
				if($mode == 'I'){
					$link = Route::_('show=transrecpay&apm='.EncData($apm_id, 2, $objBF));
				} else {
					$link = Route::_('show=transaction');
					}
				redirect($link);
				
			} // END if($objQayadaccount->actAccountTransaction('I')){	
			
	} // END if(!$vResult){
		
} // END if($_SERVER['REQUEST_METHOD'] == "POST"){