<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$salary_amount			= trim($_POST['salary_amount']);
	$advance_month			= trim($_POST['advance_month']);
	$advance_reason			= trim($_POST['advance_reason']);
	$payback_option			= trim($_POST["payback_option"]);
	$payback_in_months		= trim($_POST["payback_in_months"]);
	$isActive				= 1;
	$mode 					= trim($_POST['mode']);
	$paying_date			= date('Y-m-d');
	$entery_date			= date('Y-m-d H:i:s');
	//print_r($_POST);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("salary_amount", _SALARYAMOUNT . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				if($payback_option == 1){
					$NoOfMonthlyInstalment = 1;
				} else {
					$NoOfMonthlyInstalment = $payback_in_months;
				}
				$Calculate_MonthlyAmount = $salary_amount / $NoOfMonthlyInstalment;
				
				$objQayaduser->resetProperty();
				$advance_salary_id = $objQayaduser->genCode("rs_tbl_user_advance_salary", "advance_salary_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("advance_salary_id", $advance_salary_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("salary_amount", $salary_amount);
				$objQayaduser->setProperty("paying_date", $paying_date);
				$objQayaduser->setProperty("advance_month", $advance_month);
				$objQayaduser->setProperty("advance_reason", $advance_reason);
				$objQayaduser->setProperty("payback_option", $payback_option);
				$objQayaduser->setProperty("payback_in_months", $NoOfMonthlyInstalment);
				$objQayaduser->setProperty("advance_salary_status", 1);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actAdvanceSalaryDetail($mode)){
				
				
					for($MI=1;$MI<=$NoOfMonthlyInstalment;$MI++){
							$objQayaduser->resetProperty();
							$payback_monthly_id = $objQayaduser->genCode("rs_tbl_user_advance_salary_payback", "payback_monthly_id");
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("payback_monthly_id", $payback_monthly_id);
							$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayaduser->setProperty("advance_salary_id", $advance_salary_id);
							$objQayaduser->setProperty("monthly_amount", $Calculate_MonthlyAmount);
							$objQayaduser->setProperty("payback_status", 1);
							$objQayaduser->setProperty("payback_date", date('Y-m-d', strtotime(date("Y-m-01"). ' + '.$MI.' month')));
							$objQayaduser->setProperty("isActive", 2);
							$objQayaduser->setProperty("entery_date", $entery_date);
							$objQayaduser->actAdvanceSalaryPayBackDetail($mode);
					}
				
								
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", "New Advance salary request submitted by ".$LoginUserInfo["fullname"]);
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage($LoginUserInfo["user_fname"].' '._ADVANCE_SALARY_REQUEST_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=advancesalary');
						redirect($link);
				}
				
			}
	} 

if(trim(DecData($_GET["rq"], 1, $objBF)) == "Delete" && trim(DecData($_GET["i"], 1, $objBF)) != ''){
		$objQayaduser->setProperty("advance_salary_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayaduser->setProperty("isActive", 3);
		$objQayaduser->actAdvanceSalaryDetail('U');
			$objCommon->setMessage($LoginUserInfo["user_fname"].' '._ADVANCE_SALARY_REQUEST_DELETED_SUCCESSFULLY, 'Info');
			$link = Route::_('show=advancesalary');
			redirect($link);
}