<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$exp_title				= trim($_POST['exp_title']);	
	$supplier_name			= trim($_POST['supplier_name']);
	$supplier_contact_no	= trim($_POST['supplier_contact_no']);
	$supplier_location		= trim($_POST['supplier_location']);
	$opening_balance		= trim($_POST["opening_balance"]);
	$trans_mode				= trim($_POST["trans_mode"]);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("exp_title", 'Title' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$vehicle_exp_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['vehicle_exp_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_vehicle_exp_supplier", "vehicle_exp_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("vehicle_exp_id", $vehicle_exp_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("exp_title", $exp_title);
				$objSSSjatlan->setProperty("supplier_name", $supplier_name);
				$objSSSjatlan->setProperty("supplier_contact_no", $supplier_contact_no);
				$objSSSjatlan->setProperty("supplier_location", $supplier_location);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				$objSSSjatlan->setProperty("option_type", 2);
				if($objSSSjatlan->actVehicleExpSupplier($mode)){
						
						if($mode == 'I'){
							$head_code = 'JTVS-'.$vehicle_exp_id;
							$Head_Title = $exp_title;
							$head_description = $exp_title. ' Head';
							$objQayadaccount->resetProperty();
							$head_id = $objQayadaccount->genCode("rs_tbl_account_head", "head_id");
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("head_id", $head_id);
							$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayadaccount->setProperty("head_code", $head_code);
							$objQayadaccount->setProperty("head_title", $Head_Title);
							$objQayadaccount->setProperty("head_type_id", 11); //Mobil Oil Supplier
							$objQayadaccount->setProperty("head_description", $head_description);
							$objQayadaccount->setProperty("entity_id", $vehicle_exp_id);
							$objQayadaccount->setProperty("entery_date", $entery_date);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->actHead('I');	
							
							
							$objQayadaccount->resetProperty();
							$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("transaction_id", $transaction_id);
							$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayadaccount->setProperty("head_id", $head_id);
							$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
							$objQayadaccount->setProperty("trans_title", 'Opening Balance of '.$Head_Title);
							$objQayadaccount->setProperty("trans_mode", $trans_mode);
							$objQayadaccount->setProperty("entery_id", $vehicle_exp_id);
							$objQayadaccount->setProperty("trans_type", 8);
							$objQayadaccount->setProperty("aplic_mode", 1);
							$objQayadaccount->setProperty("pay_mode", 7);
							$objQayadaccount->setProperty("trans_amount", $opening_balance);
							$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
							$objQayadaccount->setProperty("trans_status", 1);
							$objQayadaccount->setProperty("entery_date", $entery_date);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->setProperty("transfer_mode", 1);
							$objQayadaccount->actAccountTransaction('I');
							
							
						} /*else {
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("entity_id", $diesel_id);
							$objQayadaccount->setProperty("head_type_id", 8);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->lstHead();
							$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
							$head_id = 	$GetCustomerHead["head_id"];
							$head_code = 'JT-'.$customer_id;
							$Head_Title = $GetCustomerHead["head_title"];
							$head_description = $GetCustomerHead["head_title"]. ' Vehicle Head';
						}*/
						
						/*if($TranMode == 1){
							
						}*/
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 21);
				$objQayaduser->setProperty("entity_id", $vehicle_exp_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add New -> (". $exp_title .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify of -> (". $exp_title .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage($exp_title.' information saved successfully.', 'Info');
						$link = Route::_('show=lstmobiloil');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$vehicle_exp_id = $_GET['i'];
	else if(isset($_POST['vehicle_exp_id']) && !empty($_POST['vehicle_exp_id']))
		$vehicle_exp_id = $_POST['vehicle_exp_id'];
	if(isset($vehicle_exp_id) && !empty($vehicle_exp_id)){
		$objSSSjatlan->setProperty("vehicle_exp_id", trim($objBF->decrypt($vehicle_exp_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstVehicleExpSupplier();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}