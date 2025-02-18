<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$head_item_id			= trim($_POST['head_item_id']);
	$item_qty				= trim($_POST['item_qty']);
	$requested_amount		= trim($_POST['requested_amount']);
	$reason_note			= trim($_POST["reason_note"]);
	$PaymentRequestFwdTo	= trim($_POST["pri"]);
	$AccountDepUserId		= trim($_POST["aci"]);
	$apply_type_id			= 4;
	$isActive				= 1;
	$entery_date			= date('Y-m-d H:i:s');
	//print_r($_POST);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("requested_amount", 'Required Amount' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$payment_request_id = $objQayaduser->genCode("rs_tbl_payment_requests", "payment_request_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("payment_request_id", $payment_request_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("requested_amount", $requested_amount);
				$objQayaduser->setProperty("apply_type_id", $apply_type_id);
				$objQayaduser->setProperty("apply_date", $entery_date);
				$objQayaduser->setProperty("request_status", 2);
				$objQayaduser->setProperty("request_stage", 2);
				$objQayaduser->setProperty("request_stage_status", 2);
				$objQayaduser->setProperty("request_fwd_dep_to", $PaymentRequestFwdTo);
				$objQayaduser->setProperty("request_fwd_dep_status", 6);
				$objQayaduser->setProperty("request_fwd_finance_to", $AccountDepUserId);
				$objQayaduser->setProperty("request_fwd_finance_status", 2);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actPaymentRequestsList($mode)){
				
					$objQayaduser->resetProperty();
					$misc_item_req_id = $objQayaduser->genCode("rs_tbl_payment_requests_items", "misc_item_req_id");
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("misc_item_req_id", $misc_item_req_id);
					$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->setProperty("payment_request_id", $payment_request_id);
					$objQayaduser->setProperty("item_id", $head_item_id);
					$objQayaduser->setProperty("item_qty", $item_qty);
					$objQayaduser->setProperty("required_amount", $requested_amount);
					$objQayaduser->setProperty("reason_note", $reason_note);
					$objQayaduser->setProperty("item_req_status", 1);
					$objQayaduser->setProperty("entery_date", $entery_date);
					$objQayaduser->setProperty("isActive", $isActive);
					$objQayaduser->actPaymentRequestsItemsList($mode);
								
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
						$objQayaduser->setProperty("activity_detail", "Miscellaneous Items Payment Request has been submitted by ".$LoginUserInfo["fullname"]);
						$objQayaduser->actUserLog("I");
						
								$objCommon->setMessage($LoginUserInfo["user_fname"].' '._MISCELLANEOUS_ITEM_REQUEST_ADDED_SUCCESSFULLY, 'Info');
								$link = Route::_('show=payreq');
								redirect($link);
				}
				
			}
	}