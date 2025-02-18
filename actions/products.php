<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$product_name		= trim($_POST['product_name']);
	$product_size		= trim($_POST['product_size']);
	$vendor_id			= trim($_POST['vendor_id']);
	$isActive			= trim($_POST['isActive']);
	$mode 				= trim($_POST['mode']);
	$entery_date		= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("product_name", 'Product Name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$product_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['product_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_products", "product_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("product_id", $product_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("product_name", $product_name);
				$objSSSjatlan->setProperty("product_size", $product_size);
				$objSSSjatlan->setProperty("vendor_id", $vendor_id);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actProducts($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 7);
				$objQayaduser->setProperty("entity_id", $product_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add New Product -> (". $product_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Product Info of -> (". $product_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Product information saved successfully.', 'Info');
						$link = Route::_('show=products');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$product_id = $_GET['i'];
	else if(isset($_POST['product_id']) && !empty($_POST['product_id']))
		$product_id = $_POST['product_id'];
	if(isset($product_id) && !empty($product_id)){
		$objSSSjatlan->setProperty("product_id", trim($objBF->decrypt($product_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstProducts();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}