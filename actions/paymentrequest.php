<?php
if($_GET["i"] != '' && trim(DecData($_GET["c"], 1, $objBF)) == 'm' && trim(DecData($_GET["d"], 1, $objBF)) == 'Accept'){

	$objQayadapplication->resetProperty();
	$objQayadapplication->setProperty("cpt_id", trim(DecData($_GET["i"], 1, $objBF)));
	$objQayadapplication->lstAplicCustomerPaymentTransfer();
	$TransferPayment = $objQayadapplication->dbFetchArray(1);
	
		$objQayadapplication->resetProperty();
		$objQayadapplication->setProperty("cpt_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadapplication->setProperty("transfer_status", 2);
		$objQayadapplication->actAplicCustomerPaymentTransfer('U');
		
		$objQayadapplication->resetProperty();
		$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
		$objQayadapplication->setProperty("aplic_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadapplication->setProperty("customer_id", $TransferPayment["customer_id"]);
		$objQayadapplication->setProperty("entery_date", date('Y-m-d H:i:s'));
		$objQayadapplication->setProperty("log_desc", "Customer Payment Transfer Request has been Accepted Application#". $TransferPayment["reg_number"]);
		$objQayadapplication->actApplicationLog("I");
		
		$objCommon->setMessage(_TRANSFER_PAYMENT_MODE_ACCEPT, 'Info');
		$link = Route::_('show=paymentrequest');
		redirect($link);
		
}
if($_GET["i"] != '' && trim(DecData($_GET["c"], 1, $objBF)) == 'm' && trim(DecData($_GET["d"], 1, $objBF)) == 'Reject'){
	$objQayadapplication->resetProperty();
	$objQayadapplication->setProperty("cpt_id", trim(DecData($_GET["i"], 1, $objBF)));
	$objQayadapplication->lstAplicCustomerPaymentTransfer();
	$TransferPayment = $objQayadapplication->dbFetchArray(1);
	
		$objQayadapplication->resetProperty();
		$objQayadapplication->setProperty("cpt_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadapplication->setProperty("transfer_status", 4);
		$objQayadapplication->actAplicCustomerPaymentTransfer('U');
		
		$objQayadapplication->resetProperty();
		$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
		$objQayadapplication->setProperty("aplic_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadapplication->setProperty("customer_id", $TransferPayment["customer_id"]);
		$objQayadapplication->setProperty("entery_date", date('Y-m-d H:i:s'));
		$objQayadapplication->setProperty("log_desc", "Customer Payment Transfer Request has been Rejected Application#". $TransferPayment["reg_number"]);
		$objQayadapplication->actApplicationLog("I");
		
		$objCommon->setMessage(_TRANSFER_PAYMENT_MODE_REJECT, 'Info');
		$link = Route::_('show=paymentrequest');
		redirect($link);
}
if($_GET["i"] != '' && trim(DecData($_GET["c"], 1, $objBF)) == 'm' && trim(DecData($_GET["d"], 1, $objBF)) == 'Process'){
	$aplic_id = trim(DecData($_GET["api"], 1, $objBF));
	$Installment_id = trim(DecData($_GET["ini"], 1, $objBF));
	$cpt_id = trim(DecData($_GET["i"], 1, $objBF));
	$link = Route::_('show=transrecpay&apm='.EncData('2', 2, $objBF).'&p='.EncData('a', 2, $objBF).'&api='.EncData($aplic_id, 2, $objBF).'&ini='.EncData($Installment_id, 2, $objBF).'&cpti='.EncData($cpt_id, 2, $objBF));
	redirect($link);
}
?>