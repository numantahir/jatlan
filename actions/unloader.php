<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$customer_category		= trim($_POST['customer_category']);
	$customer_name			= trim($_POST['customer_name']);
	$customer_phone			= trim($_POST['customer_phone']);
	$customer_mobile		= trim($_POST['customer_mobile']);
	$customer_email			= trim($_POST['customer_email']);
	$location_id			= trim($_POST['location_id']);
	$customer_address		= trim($_POST['customer_address']);
	$customer_business_name	= trim($_POST["customer_business_name"]);
	$opening_balance		= trim($_POST["opening_balance"]);
	$opening_date			= trim($_POST["opening_date"]);
	$trans_mode				= trim($_POST["trans_mode"]);
	$TranMode				= trim($_POST["actr"]);
	$isActive				= trim($_POST["isActive"]);
	$mode					= trim($_POST["mode"]);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setCheckField("customer_name", 'Customer Name' . _IS_REQUIRED_FLD, "S");
	
	if($opening_date == ''){
		$OpeningDate = date('Y-m-d');	
	} else {
		$OpeningDate = $opening_date;
	}
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$customer_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['customer_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_customers", "customer_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("customer_id", $customer_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("customer_name", $customer_name);
				$objSSSjatlan->setProperty("customer_type", 3);
				$objSSSjatlan->setProperty("customer_phone", $customer_phone);
				$objSSSjatlan->setProperty("customer_mobile", $customer_mobile);
				$objSSSjatlan->setProperty("customer_address", $customer_address);
				$objSSSjatlan->setProperty("customer_business_name", $customer_business_name);
				if($objSSSjatlan->actCustomers($mode)){
				
						if($mode == 'I'){
							$head_code = 'JTU-'.$customer_id;
							$Head_Title = $customer_name . '('.$customer_business_name.')';
							$head_description = $customer_name . '('.$customer_business_name.')'. ' Unloader Head';
							$objQayadaccount->resetProperty();
							$head_id = $objQayadaccount->genCode("rs_tbl_account_head", "head_id");
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("head_id", $head_id);
							$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayadaccount->setProperty("head_code", $head_code);
							$objQayadaccount->setProperty("head_title", $Head_Title);
							$objQayadaccount->setProperty("head_type_id", 8); // Unloader Type
							$objQayadaccount->setProperty("head_description", $head_description);
							$objQayadaccount->setProperty("entity_id", $customer_id);
							$objQayadaccount->setProperty("entery_date", $entery_date);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->actHead('I');	
						} else {
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("entity_id", $customer_id);
							$objQayadaccount->setProperty("head_type_id", 8);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->lstHead();
							$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
							$head_id = 	$GetCustomerHead["head_id"];
							$head_code = 'JT-'.$customer_id;
							$Head_Title = $GetCustomerHead["head_title"];
							$head_description = $GetCustomerHead["head_title"]. ' Unloader Head';
						}
						
						if($TranMode == 1){
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
							$objQayadaccount->setProperty("trans_date", $OpeningDate);
							$objQayadaccount->setProperty("trans_status", 1);
							$objQayadaccount->setProperty("entery_date", $entery_date);
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->setProperty("transfer_mode", 1);
							$objQayadaccount->actAccountTransaction('I');
						}
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 19);
				$objQayaduser->setProperty("entity_id", $location_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add Unloader -> (". $customer_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Unloader Info of -> (". $customer_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Unloader information saved successfully.', 'Info');
						$link = Route::_('show=unloader');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$customer_id = $_GET['i'];
	else if(isset($_POST['customer_id']) && !empty($_POST['customer_id']))
		$customer_id = $_POST['customer_id'];
	if(isset($customer_id) && !empty($customer_id)){
		$objSSSjatlan->resetProperty();
		$objSSSjatlan->setProperty("customer_id", trim($objBF->decrypt($customer_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstCustomers();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}