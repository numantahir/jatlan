<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$group_title			= trim($_POST['group_title']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("group_title", _HEAD_GROUP_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadaccount->resetProperty();
				$head_group_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['head_group_id'], 1, ENCRYPTION_KEY)) : $objQayadaccount->genCode("rs_tbl_account_head_group", "head_group_id");
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("head_group_id", $head_group_id);
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("group_title", $group_title);
				$objQayadaccount->setProperty("entery_date", $entery_date);
				$objQayadaccount->setProperty("isActive", $isActive);
				if($objQayadaccount->actHeadGroup($mode)){
						
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("entery_id", $head_group_id);
				$objQayadaccount->setProperty("entery_type", 1);
				$objQayadaccount->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadaccount->setProperty("log_desc", "Add New Head Group -> (". $group_title .")");
				} else {
				$objQayadaccount->setProperty("log_desc", "Modify Head Group -> (". $group_title .")");
				}
				$objQayadaccount->actAccountLog("I");
				
						$objCommon->setMessage(_GROUP_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=headgroup');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$head_group_id = $_GET['i'];
	else if(isset($_POST['head_group_id']) && !empty($_POST['head_group_id']))
		$head_group_id = $_POST['head_group_id'];
	if(isset($head_group_id) && !empty($head_group_id)){
		$objQayadaccount->setProperty("head_group_id", trim($objBF->decrypt($head_group_id, 1, ENCRYPTION_KEY)));
		$objQayadaccount->lstHeadGroup();
		$data = $objQayadaccount->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}