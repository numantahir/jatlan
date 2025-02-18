<?php
if(trim(DecData($_GET["rq"], 1, $objBF)) == 'View' && trim(DecData($_GET["i"], 1, $objBF)) != ''){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("isActive_not", 3);
$objQayaduser->setProperty("payment_request_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayaduser->lstPaymentRequestsList();
$PaymentRequest = $objQayaduser->dbFetchArray(1);	

$objQayaduser->resetProperty();
$GetRequestedUserName = $objQayaduser->GetUserFullName($PaymentRequest["user_id"]);

if($PaymentRequest["apply_type_id"] == 1){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("isActive_not", 3);
$objQayaduser->setProperty("payment_request_id", $PaymentRequest["payment_request_id"]);
$objQayaduser->lstPaymentRequestsAdvanceSalary();
$AdvanceSalaryDetail = $objQayaduser->dbFetchArray(1);
} elseif($PaymentRequest["apply_type_id"] == 2){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("isActive_not", 3);
$objQayaduser->setProperty("payment_request_id", $PaymentRequest["payment_request_id"]);
$objQayaduser->lstPaymentRequestsAdvanceSalary();
$AdvanceSalaryDetail = $objQayaduser->dbFetchArray(1);
}

} elseif(trim(DecData($_GET["s"], 1, $objBF)) == 'ati_1' && trim(DecData($_GET["rq"], 1, $objBF)) == 1 && trim(DecData($_GET["i"], 1, $objBF)) != '' && trim(DecData($_GET["rd"], 1, $objBF)) == date("Ymd") && trim(DecData($_GET["rb"], 1, $objBF)) == $LoginUserInfo["user_id"]){

				/********************************************************************/
				/**/ $objQayaduser->resetProperty();
				/**/ $objQayaduser->setProperty("user_type_id", 3);
				/**/ $objQayaduser->lstUsers();
				/**/ $GetFinanceUserID = $objQayaduser->dbFetchArray(1);
				/********************************************************************/
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("payment_request_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayaduser->setProperty("request_status", 4);
				$objQayaduser->setProperty("request_stage", 2);
				$objQayaduser->setProperty("request_stage_status", 4);
				$objQayaduser->setProperty("request_fwd_dep_status", 1);
				$objQayaduser->setProperty("request_fwd_finance_to", $GetFinanceUserID["user_id"]);
				$objQayaduser->setProperty("request_fwd_finance_status", 2);
				$objQayaduser->actPaymentRequestsList('U');


				$objCommon->setMessage('Advance salary request has been approved successfully.', 'Info');
				$link = Route::_('show=payreqproc');
				redirect($link);

} elseif(trim(DecData($_GET["s"], 1, $objBF)) == 'ati_1' && trim(DecData($_GET["rq"], 1, $objBF)) == 2 && trim(DecData($_GET["i"], 1, $objBF)) != '' && trim(DecData($_GET["rb"], 1, $objBF)) == $LoginUserInfo["user_id"]){

				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("payment_request_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayaduser->setProperty("request_status", 3);
				$objQayaduser->setProperty("request_stage", 1);
				$objQayaduser->setProperty("request_stage_status", 3);
				$objQayaduser->setProperty("request_fwd_dep_status", 3);
				$objQayaduser->actPaymentRequestsList('U');

				$objCommon->setMessage('Advance salary request has been reject successfully.', 'Info');
				$link = Route::_('show=payreqproc');
				redirect($link);
} elseif(trim(DecData($_GET["s"], 1, $objBF)) == 'ati_2' && trim(DecData($_GET["rq"], 1, $objBF)) == 1 && trim(DecData($_GET["i"], 1, $objBF)) != '' && trim(DecData($_GET["rd"], 1, $objBF)) == date("Ymd") && trim(DecData($_GET["rb"], 1, $objBF)) == $LoginUserInfo["user_id"]){
				
				/********************************************************************/
				/**/ $objQayaduser->resetProperty();
				/**/ $objQayaduser->setProperty("user_type_id", 3);
				/**/ $objQayaduser->lstUsers();
				/**/ $GetFinanceUserID = $objQayaduser->dbFetchArray(1);
				/********************************************************************/
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("payment_request_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayaduser->setProperty("request_status", 4);
				$objQayaduser->setProperty("request_stage", 2);
				$objQayaduser->setProperty("request_stage_status", 4);
				$objQayaduser->setProperty("request_fwd_dep_status", 1);
				$objQayaduser->setProperty("request_fwd_finance_to", $GetFinanceUserID["user_id"]);
				$objQayaduser->setProperty("request_fwd_finance_status", 2);
				$objQayaduser->actPaymentRequestsList('U');


				$objCommon->setMessage('Personal loan request has been approved successfully.', 'Info');
				$link = Route::_('show=payreqproc');
				redirect($link);
} elseif(trim(DecData($_GET["s"], 1, $objBF)) == 'ati_2' && trim(DecData($_GET["rq"], 1, $objBF)) == 2 && trim(DecData($_GET["i"], 1, $objBF)) != '' && trim(DecData($_GET["rb"], 1, $objBF)) == $LoginUserInfo["user_id"]){
	
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("payment_request_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayaduser->setProperty("request_status", 3);
				$objQayaduser->setProperty("request_stage", 1);
				$objQayaduser->setProperty("request_stage_status", 3);
				$objQayaduser->setProperty("request_fwd_dep_status", 3);
				$objQayaduser->actPaymentRequestsList('U');

				$objCommon->setMessage('Personal loan request has been reject successfully.', 'Info');
				$link = Route::_('show=payreqproc');
				redirect($link);
}
