<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$head_code				= trim($_POST['head_code']);
	$head_title				= trim($_POST['head_title']);
	$head_group_id			= $_POST['head_group_id'];
	$head_type_id			= $_POST['head_type_id'];
	$head_description		= trim($_POST['head_description']);
	$head_option			= trim($_POST["head_option"]);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$actr					= trim($_POST["actr"]);
	$trans_mode				= trim($_POST["trans_mode"]);
	$entery_date			= date('Y-m-d H:i:s');
	$opening_balance		= trim($_POST["opening_balance"]);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("head_title", _HEAD_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadaccount->resetProperty();
				$head_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['head_id'], 1, ENCRYPTION_KEY)) : $objQayadaccount->genCode("rs_tbl_account_head", "head_id");
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("head_id", $head_id);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_code", $head_code);
				$objQayadaccount->setProperty("head_title", $head_title);
				$objQayadaccount->setProperty("head_group_id", $head_group_id);
				$objQayadaccount->setProperty("head_type_id", $head_type_id);
				$objQayadaccount->setProperty("head_option", $head_option);
				$objQayadaccount->setProperty("head_description", $head_description);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", $isActive);
				if($objQayadaccount->actHead($mode)){
				
					if($actr == 1){
					$objQayadaccount->resetProperty();
					$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("transaction_id", $transaction_id);
					$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("head_id", $head_id);
					$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
					$objQayadaccount->setProperty("trans_title", 'Opening Balance of '.$head_title);
					$objQayadaccount->setProperty("trans_mode", $trans_mode	);
					$objQayadaccount->setProperty("trans_type", 8);
					$objQayadaccount->setProperty("aplic_mode", 4);
					$objQayadaccount->setProperty("pay_mode", 7);
					$objQayadaccount->setProperty("trans_amount", $opening_balance);
					$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
					$objQayadaccount->setProperty("trans_status", 1);
					$objQayadaccount->setProperty("entery_date", $entery_date);
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("transfer_mode", 1);
					$objQayadaccount->actAccountTransaction('I');
					} /*elseif($head_type_id == 3 && $mode == 'I'){
					$objQayadaccount->resetProperty();
					$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("transaction_id", $transaction_id);
					$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("head_id", $head_id);
					$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
					$objQayadaccount->setProperty("trans_title", 'Opening Balance of '.$head_title);
					$objQayadaccount->setProperty("trans_mode", 2);
					$objQayadaccount->setProperty("trans_type", 8);
					$objQayadaccount->setProperty("aplic_mode", 4);
					$objQayadaccount->setProperty("pay_mode", 7);
					$objQayadaccount->setProperty("trans_amount", $opening_balance);
					$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
					$objQayadaccount->setProperty("trans_status", 1);
					$objQayadaccount->setProperty("entery_date", $entery_date);
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("transfer_mode", 1);
					$objQayadaccount->actAccountTransaction('I');
					} elseif($head_type_id == 13 && $mode == 'I'){
					$objQayadaccount->resetProperty();
					$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("transaction_id", $transaction_id);
					$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("head_id", $head_id);
					$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
					$objQayadaccount->setProperty("trans_title", 'Opening Balance of '.$head_title);
					$objQayadaccount->setProperty("trans_mode", 2);
					$objQayadaccount->setProperty("trans_type", 8);
					$objQayadaccount->setProperty("aplic_mode", 4);
					$objQayadaccount->setProperty("pay_mode", 7);
					$objQayadaccount->setProperty("trans_amount", $opening_balance);
					$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
					$objQayadaccount->setProperty("trans_status", 1);
					$objQayadaccount->setProperty("entery_date", $entery_date);
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("transfer_mode", 1);
					$objQayadaccount->actAccountTransaction('I');
					}*/
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("entery_id", $head_id);
				$objQayadaccount->setProperty("entery_type", 2);
				$objQayadaccount->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadaccount->setProperty("log_desc", "Add New Account Head -> (". $head_title .")");
				} else {
				$objQayadaccount->setProperty("log_desc", "Modify Account Head -> (". $head_title .")");
				}
				$objQayadaccount->actAccountLog("I");
				
						$objCommon->setMessage('Head information has been saved successfully.', 'Info');
						$link = Route::_('show=achead');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$head_id = $_GET['i'];
	else if(isset($_POST['head_id']) && !empty($_POST['head_id']))
		$head_id = $_POST['head_id'];
	if(isset($head_id) && !empty($head_id)){
		$objQayadaccount->setProperty("head_id", trim($objBF->decrypt($head_id, 1, ENCRYPTION_KEY)));
		$objQayadaccount->lstHead();
		$data = $objQayadaccount->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}