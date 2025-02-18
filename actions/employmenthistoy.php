<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$company_name			= trim($_POST['company_name']);
	$job_title				= trim($_POST['job_title']);
	$employee_id			= trim($_POST['employee_id']);
	$from_date				= trim($_POST['from_date']);
	$end_date				= trim($_POST['end_date']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("company_name", _COMPANYNAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_employment_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_employment_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_employment", "user_employment_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_employment_id", $user_employment_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("company_name", $company_name);
				$objQayaduser->setProperty("job_title", $job_title);
				$objQayaduser->setProperty("from_date", dateFormate_10($from_date));
				$objQayaduser->setProperty("end_date", dateFormate_10($end_date));				
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserEmployment($mode)){
				
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Holiday by ".$LoginUserInfo["fullname"]." -> (".$company_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Holiday info -> (".$company_name .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage(_EMPLOYEE_EDUCATION_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=employmenthistory&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_employment_id = $_GET['ei'];
	else if(isset($_POST['user_employment_id']) && !empty($_POST['user_employment_id']))
		$user_employment_id = $_POST['user_employment_id'];
	if(isset($user_employment_id) && !empty($user_employment_id)){
		$objQayaduser->setProperty("user_employment_id", trim($objBF->decrypt($user_employment_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserEmploymentHistory();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}