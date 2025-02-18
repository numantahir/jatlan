<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$head_id				= $_POST['head_id'];
	$item_title				= trim($_POST['item_title']);
	$head_type				= trim($_POST['head_type']);
	$item_description		= trim($_POST['item_description']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	$head_type_id			= trim($_POST["head_type_id"]);
	$opening_balance		= trim($_POST["opening_balance"]);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("item_title", _HEAD_ITEM . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadaccount->resetProperty();
				$item_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['item_id'], 1, ENCRYPTION_KEY)) : $objQayadaccount->genCode("rs_tbl_account_head_items", "item_id");
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("item_id", $item_id);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_id", $head_id);
				$objQayadaccount->setProperty("head_type", $head_type);
				$objQayadaccount->setProperty("item_title", $item_title);
				$objQayadaccount->setProperty("item_description", $item_description);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", $isActive);
				if($objQayadaccount->actHeadItems($mode)){
					
					if($head_type_id == 3 && $mode == 'I'){
					$objQayadaccount->resetProperty();
					$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("transaction_id", $transaction_id);
					$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("head_id", $head_id);
					$objQayadaccount->setProperty("item_id", $item_id);
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
					}
					
					
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("entery_id", $item_id);
				$objQayadaccount->setProperty("entery_type", 3);
				$objQayadaccount->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadaccount->setProperty("log_desc", "Add New Head Item -> (". $item_title .")");
				} else {
				$objQayadaccount->setProperty("log_desc", "Modify Head Item -> (". $item_title .")");
				}
				$objQayadaccount->actAccountLog("I");
				
				
						$objCommon->setMessage(_ITEM_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=headitem');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$item_id = $_GET['i'];
	else if(isset($_POST['item_id']) && !empty($_POST['item_id']))
		$item_id = $_POST['item_id'];
	if(isset($item_id) && !empty($item_id)){
		$objQayadaccount->setProperty("item_id", trim($objBF->decrypt($item_id, 1, ENCRYPTION_KEY)));
		$objQayadaccount->lstHeadItems();
		$data = $objQayadaccount->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}