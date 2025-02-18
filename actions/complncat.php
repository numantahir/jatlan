<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$category_title			= trim($_POST['category_title']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("category_title", 'Category Title' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSinventory->resetProperty();
				$complain_category_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['complain_category_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_complain_category", "complain_category_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("complain_category_id", $complain_category_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("category_title", $category_title);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isActive", $isActive);
				if($objSSSinventory->actComplainCategory($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Category Title by ".$LoginUserInfo["fullname"]." -> (".$category_title .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Category Title info -> (".$category_title .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Complain Category Title information detail has been saved successfully.', 'Info');
						$link = Route::_('show=complncat');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$complain_category_id = $_GET['i'];
	else if(isset($_POST['complain_category_id']) && !empty($_POST['complain_category_id']))
		$complain_category_id = $_POST['complain_category_id'];
	if(isset($complain_category_id) && !empty($complain_category_id)){
		$objSSSinventory->setProperty("complain_category_id", trim($objBF->decrypt($complain_category_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstComplainCategory();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}