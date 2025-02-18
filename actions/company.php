<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$company_name			= trim($_POST['company_name']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("company_name", _company_name . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$company_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['company_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_companies", "company_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("company_id", $company_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("company_name", $company_name);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actCompanies($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Company -> (". $company_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", "Modify Company Info -> (". $company_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_COMPANY_INFO_SUCCESSFULLY, 'Info');
						$link = Route::_('show=companies');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$company_id = $_GET['i'];
	else if(isset($_POST['company_id']) && !empty($_POST['company_id']))
		$company_id = $_POST['company_id'];
	if(isset($company_id) && !empty($company_id)){
		$objQayaduser->setProperty("company_id", trim($objBF->decrypt($company_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstCompanies();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}