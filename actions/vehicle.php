<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$vehicle_name			= trim($_POST['vehicle_name']);
	
	$vehicle_number			= trim($_POST['vehicle_number']);
	$vehicle_source			= trim($_POST['vehicle_source']);
	$vehicle_type_id		= trim($_POST['vehicle_type_id']);
	$loading_capacity		= trim($_POST['loading_capacity']);
	$opening_balance		= trim($_POST["opening_balance"]);
	$trans_mode				= trim($_POST["trans_mode"]);
	$TranMode				= trim($_POST["actr"]);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("vehicle_number", 'Vechile Number' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$vehicle_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['vehicle_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_vehicle", "vehicle_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("vehicle_id", $vehicle_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("vehicle_name", $vehicle_name);
				$objSSSjatlan->setProperty("vehicle_number", $vehicle_number);
				$objSSSjatlan->setProperty("vehicle_source", $vehicle_source);
				$objSSSjatlan->setProperty("vehicle_type_id", $vehicle_type_id);
				$objSSSjatlan->setProperty("loading_capacity", $loading_capacity);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actVehicle($mode)){
						
						if($mode == 'I'){
							$head_code = 'JTV-'.$vehicle_id;
							$Head_Title = $vehicle_number;
							$head_description = $vehicle_number. ' Vehicle Head';
							$objQayadaccount->resetProperty();
							$head_id = $objQayadaccount->genCode("rs_tbl_account_head", "head_id");
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("head_id", $head_id);
							$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayadaccount->setProperty("head_code", $head_code);
							$objQayadaccount->setProperty("head_title", $Head_Title);
							$objQayadaccount->setProperty("head_type_id", 7); //Vehicle Type
							$objQayadaccount->setProperty("head_description", $head_description);
							$objQayadaccount->setProperty("entity_id", $vehicle_id);
							$objQayadaccount->setProperty("entery_date", $entery_date);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->actHead('I');	
						} else {
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("entity_id", $vehicle_id);
							$objQayadaccount->setProperty("head_type_id", 7);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->lstHead();
							if($objQayadaccount->totalRecords() == 0){
								$head_code = 'JTV-'.$vehicle_id;
								$Head_Title = $vehicle_number;
								$head_description = $vehicle_number. ' Vehicle Head';
								$objQayadaccount->resetProperty();
								$head_id = $objQayadaccount->genCode("rs_tbl_account_head", "head_id");
								$objQayadaccount->resetProperty();
								$objQayadaccount->setProperty("head_id", $head_id);
								$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
								$objQayadaccount->setProperty("head_code", $head_code);
								$objQayadaccount->setProperty("head_title", $Head_Title);
								$objQayadaccount->setProperty("head_type_id", 7); //Vehicle Type
								$objQayadaccount->setProperty("head_description", $head_description);
								$objQayadaccount->setProperty("entity_id", $vehicle_id);
								$objQayadaccount->setProperty("entery_date", $entery_date);
								$objQayadaccount->setProperty("isActive", 1);
								$objQayadaccount->actHead('I');		
							}
							/*$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
							$head_id = 	$GetCustomerHead["head_id"];
							$head_code = 'JT-'.$customer_id;
							$Head_Title = $GetCustomerHead["head_title"];
							$head_description = $GetCustomerHead["head_title"]. ' Vehicle Head';*/
						}
						
						/*if($TranMode == 1){
							$objQayadaccount->resetProperty();
							$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("transaction_id", $transaction_id);
							$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayadaccount->setProperty("head_id", $head_id);
							$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
							$objQayadaccount->setProperty("trans_title", 'Opening Balance of '.$Head_Title);
							$objQayadaccount->setProperty("trans_mode", $trans_mode);
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
						}*/
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 10);
				$objQayaduser->setProperty("entity_id", $vehicle_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add New Vehicle -> (". $vehicle_number .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Vehicle of -> (". $vehicle_number .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Vehicle information saved successfully.', 'Info');
						$link = Route::_('show=vehicle');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$vehicle_id = $_GET['i'];
	else if(isset($_POST['vehicle_id']) && !empty($_POST['vehicle_id']))
		$vehicle_id = $_POST['vehicle_id'];
	if(isset($vehicle_id) && !empty($vehicle_id)){
		$objSSSjatlan->setProperty("vehicle_id", trim($objBF->decrypt($vehicle_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstVehicle();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}