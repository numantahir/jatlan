<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$salary_amount			= trim($_POST['salary_amount']);
	$salary_type			= trim($_POST['salary_type']);
	$apply_from				= trim($_POST['apply_from']);
	$isActive				= trim($_POST['isActive']);
	$employee_id			= trim($_POST['employee_id']);
	$cutting_mode			= trim($_POST["cutting_mode"]);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("salary_amount", _SALARYAMOUNT . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_salary_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_salary_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_salary", "user_salary_id");
				//
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_salary_id", $user_salary_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("salary_amount", $objBF->encrypt($salary_amount, ENCRYPTION_KEY));
				$objQayaduser->setProperty("salary_type", $salary_type);
				$objQayaduser->setProperty("salary_mode", $salary_mode);
				$objQayaduser->setProperty("cutting_mode", $cutting_mode);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actSalary($mode)){
				
				$objQayadUserFullName = new Qayaduser;
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Employee Salary Added By ".$LoginUserInfo["fullname"]." -> (". $objQayadUserFullName->GetUserFullName(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY))). $salary_amount .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Employee Salary BY ".$LoginUserInfo["fullname"]." -> (".$objQayadUserFullName->GetUserFullName(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY))). $salary_amount .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_EMPLOYEE_SALARY_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=employesalary&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_salary_id = $_GET['ei'];
	else if(isset($_POST['user_salary_id']) && !empty($_POST['user_salary_id']))
		$user_salary_id = $_POST['user_salary_id'];
	if(isset($user_salary_id) && !empty($user_salary_id)){
		$objQayaduser->setProperty("user_salary_id", trim($objBF->decrypt($user_salary_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstSalary();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}