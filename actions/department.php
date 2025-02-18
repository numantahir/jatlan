<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$department_name		= trim($_POST['department_name']);
	$company_id				= trim($_POST['company_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("department_name", _DEPARTMENT_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$department_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['department_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_department", "department_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("department_id", $department_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("department_name", $department_name);
				$objQayaduser->setProperty("company_id", $company_id);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actDepartments($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Department by ".$LoginUserInfo["fullname"]." -> (".$department_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit department info -> (".$department_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_DEPARTMENT_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=department');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$department_id = $_GET['i'];
	else if(isset($_POST['department_id']) && !empty($_POST['department_id']))
		$department_id = $_POST['department_id'];
	if(isset($department_id) && !empty($department_id)){
		$objQayaduser->setProperty("department_id", trim($objBF->decrypt($department_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstDepartments();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}