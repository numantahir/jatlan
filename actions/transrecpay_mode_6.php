<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayadProerty->resetProperty();
	
	$apm_id						= trim($_POST["apm_id"]);
	$trans_type					= trim($_POST["trans_type"]);
	$aplic_mode					= trim($_POST["aplic_mode"]);
	$head_id					= trim($_POST["head_id"]);
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
	$var_property_share_id		= trim($_POST["var_property_share_id"]);
	////////////////////////////////////////////////////////////////////////////
	$instalment_pay_as			= trim($_POST["instalment_pay_as"]);
	$DefaultNoOfInstalment		= 10;
	$DefaultNoOfMonthStarter	= 3;
	////////////////////////////////////////////////////////////////////////////
	/******************** Tokent Amount Return Transaction ********************/
	////////////////////////////////////////////////////////////////////////////
	$var_lock_property_counter	= trim($_POST["var_lock_property_counter"]);
	$var_lock_property_id		= trim($_POST["var_lock_property_id"]);
	$token_transfer_mode		= trim($_POST["token_transfer_mode"]);
	$token_transfer_head_id		= trim($_POST["token_transfer_head_id"]);
	$token_transfer_item_id		= trim($_POST["token_transfer_item_id"]);
	$last_transaction_number	= trim($_POST["last_transaction_number"]);
	$temp_lock_id				= trim($_POST["temp_lock_id"]);
	////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////
	$entery_date				= date('Y-m-d H:i:s');
	$app_reg_date				= trim($_POST["app_reg_date"]);
	$TransactionCode			= date("md").rand(1,9).rand(99,999);
	
	$objValidate->setArray($_POST);
	//$objValidate->setCheckField("entery_id", _PROPERTY_PROJECT . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("trans_amount", _PROPERTY_FLOOR_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
			

			/****************************************************************************************************/
			//////////////////////////////////////////////////////////////////////////////////////////////////////
			/****************************************************************************************************/
			if($var_payment_mode == 1){
				$ReturnAplicMode = 1;
			} else {
				$ReturnAplicMode = $var_payment_mode;
			}
			
			$objQayadProerty->resetProperty();
			$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
			$objQayadaccount->resetProperty();
			$objQayadaccount->setProperty("transaction_id", $transaction_id);
			$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			$objQayadaccount->setProperty("head_id", trim($objBF->decrypt($head_id, 1, ENCRYPTION_KEY)));
			$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
			$objQayadaccount->setProperty("trans_title", $trans_title);
			$objQayadaccount->setProperty("trans_note", $trans_note);
			$objQayadaccount->setProperty("trans_mode", 1);
			$objQayadaccount->setProperty("trans_type", 1);
			/*if($ReturnAplicMode == 2){
			$objQayadaccount->setProperty("aplic_mode", 4);
			} else {
			$objQayadaccount->setProperty("aplic_mode", $ReturnAplicMode);
			}*/
			$objQayadaccount->setProperty("aplic_mode", 4);
			$objQayadaccount->setProperty("pay_mode", $pay_mode);
			$objQayadaccount->setProperty("pay_mode_no", $payment_mode_no);
			$objQayadaccount->setProperty("entery_id", trim($objBF->decrypt($entery_id, 1, ENCRYPTION_KEY)));
			$objQayadaccount->setProperty("trans_amount", $trans_amount);
			$objQayadaccount->setProperty("trans_date", dateFormate_10($trans_date));
			$objQayadaccount->setProperty("trans_status", 1);
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
				/////////////////////////////////////////////////////////////////////
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				$objQayadaccount->resetProperty();
				$transaction_id_new = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
				$objQayadaccount->setProperty("transaction_id", $transaction_id_new);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_id", trim($objBF->decrypt($transfer_head_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("item_id", trim($objBF->decrypt($transfer_item_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
				$objQayadaccount->setProperty("trans_title", $trans_title);
				$objQayadaccount->setProperty("trans_note", $trans_note);
				$objQayadaccount->setProperty("trans_mode", 1);
				$objQayadaccount->setProperty("trans_type", 1);
				if($ReturnAplicMode == 2){
				$objQayadaccount->setProperty("aplic_mode", 4);
				} else {
				$objQayadaccount->setProperty("aplic_mode", $ReturnAplicMode);
				}
				$objQayadaccount->setProperty("pay_mode", $pay_mode);
				$objQayadaccount->setProperty("pay_mode_no", $payment_mode_no);
				$objQayadaccount->setProperty("entery_id", trim($objBF->decrypt($entery_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("trans_amount", $trans_amount);
				$objQayadaccount->setProperty("trans_date", dateFormate_10($trans_date));
				$objQayadaccount->setProperty("trans_status", 1);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->setProperty("transfer_head_id", trim($objBF->decrypt($head_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("transfer_mode", $transfer_mode);
				//$objQayadaccount->setProperty("location_id", $objQayaduser->location_id);
				$objQayadaccount->setProperty("trans_position", 1);
				$objQayadaccount->setProperty("tran_code", $TransactionCode);
				$objQayadaccount->actAccountTransaction('I');
				/*******************************************************************
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				/////////////////////////////////////////////////////////////////////
				\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
				********************************************************************/
				
				///////////////////////////////////////////////////
				///////////////////////////////////////////////////
				 // END if($var_payment_mode == 2){
					
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