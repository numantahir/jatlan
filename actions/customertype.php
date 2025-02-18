<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$category_name			= trim($_POST['category_name']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("category_name", 'Customer Name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$category_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['category_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_customer_category", "category_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("category_id", $category_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("category_name", $category_name);
				$objSSSjatlan->setProperty("category_type", 1);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actCustomerCategory($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 4);
				$objQayaduser->setProperty("entity_id", $category_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add New Customer Category -> (". $category_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Customer Category of -> (". $category_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Customer category information saved successfully.', 'Info');
						$link = Route::_('show=customertype');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$category_id = $_GET['i'];
	else if(isset($_POST['category_id']) && !empty($_POST['category_id']))
		$category_id = $_POST['category_id'];
	if(isset($category_id) && !empty($category_id)){
		$objSSSjatlan->setProperty("category_id", trim($objBF->decrypt($category_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstCustomerCategory();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}