<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$buy_price			= trim($_POST['buy_price']);
	$selling_price		= trim($_POST['selling_price']);
	$product_id			= trim($objBF->decrypt($_POST['product_id'], 1, ENCRYPTION_KEY));
	$isActive			= trim($_POST['isActive']);
	$mode 				= trim($_POST['mode']);
	$entery_date		= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("buy_price", 'Buy Price' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("selling_price", 'Selling Price' . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("product_id", $product_id);
				$objSSSjatlan->setProperty("isActive", 2);
				$objSSSjatlan->actProductPrice('U');
					
				$objSSSjatlan->resetProperty();
				$product_price_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['product_price_id'], 1, ENCRYPTION_KEY)) : $objSSSjatlan->genCode("rs_tbl_jt_product_price", "product_price_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("product_price_id", $product_price_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("buy_price", $buy_price);
				$objSSSjatlan->setProperty("selling_price", $selling_price);
				$objSSSjatlan->setProperty("product_id", $product_id);
				$objSSSjatlan->setProperty("entery_date", $entery_date);
				$objSSSjatlan->setProperty("isActive", $isActive);
				if($objSSSjatlan->actProductPrice($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("log_type", 8);
				$objQayaduser->setProperty("entity_id", $product_id);
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Add New Product Price -> (". $buy_price .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $objQayaduser->fullname." Modify Product Price Info of -> (". $buy_price .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Product price information saved successfully.', 'Info');
						$link = Route::_('show=productprice&i='.$objBF->encrypt($product_id, ENCRYPTION_KEY));
						redirect($link);
				}
				
			}
	} else {
		
$PriductID = trim($objBF->decrypt($_GET['p'], 1, ENCRYPTION_KEY));
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("product_id", $PriductID);
$objSSSjatlan->lstProducts();
$GetProductInfo = $objSSSjatlan->dbFetchArray(1);
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$product_price_id = $_GET['i'];
	else if(isset($_POST['product_price_id']) && !empty($_POST['product_price_id']))
		$product_price_id = $_POST['product_price_id'];
	if(isset($product_price_id) && !empty($product_price_id)){
		$objSSSjatlan->setProperty("product_price_id", trim($objBF->decrypt($product_price_id, 1, ENCRYPTION_KEY)));
		$objSSSjatlan->lstProductPrice();
		$data = $objSSSjatlan->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}